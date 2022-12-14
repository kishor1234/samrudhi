<?php

//use CAaskController;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once controller;

class calculateResult extends CAaskController {

    //put your code here
    public $visState = false;
    public $l = array();
    public $per = 80;
    public $wrate = 180;
    public $min = "0";
    public $blockno;
    public $load = array();
    public $zeroload = array();
    public $nonzeroload = array();

    public function __construct() {
        parent::__construct();
        //die;
    }

    public function create() {
        parent::create();
        //status=0  to all draw active
        if (isset($_REQUEST["id"])) {
            $sql = "select * from gametime where id='" . $_REQUEST["id"] . "'";
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            $row = $result->fetch_assoc();
            $_POST["gameid"] = $row["id"];
            $_POST["stime"] = $row["stime"];
            $_POST["etime"] = $row["etime"];
        } else {
            echo "id required";
            exit;
        }

        $t = 1; //test for manual
        if ($t === 0) {
            echo "Manual Resul<br>";
            $_POST["gameid"] = "10";
            $_POST["stime"] = "12:15:00";
            $_POST["etime"] = "12:45:00";
        }

        return;
    }

    public function initialize() {
        parent::initialize();
        return;
    }

    function getIndex($val2) {
        $i = 0;
        while ($i < 100) {
            $n = rand(0, count($val2) - 1);
            if ($this->checkKeypreset($val2[$n])) {

                return $n;
            }
            $i++;
        }
        return null;
    }

    function checkKeypreset($n) {
        $flag = true;

        foreach ($this->l as $val) {
            if ($n == $val) {
                $flag = false;
            }
        }
        return $flag;
    }

    function getGlobal() {
        $result = $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->select("admin", $_SESSION["db_1"]));
        $row = $result->fetch_assoc();
        //$this->per = rand(10, $row["resultper"]);
        $this->per = $row["resultper"];
        $this->wrate = $row["winrate"];
        $this->min = $row["min"];
        $this->blockno = json_decode($row["blockno"], true);
        if ($row["cron"] == 0) {
            echo "Admin Stop Result";
            die;
        }
    }

    function getSum($subSereis) {
        $sum = 0;
        for ($i = $subSereis[0]; $i <= $subSereis[1]; $i = $i + 100) {
            $s = $this->ask_mysqli->selectSum("`" . $i . "`", "`" . $_POST["gameid"] . "`") . "\n";
            $sum += $this->getData($s, "sum(`" . $_POST["gameid"] . "`)");
        }
        return $sum;
    }

    function getEmptyLoad($subSereis) {
        $load = array();
        //sub series array
        for ($i = $subSereis[0]; $i <= $subSereis[1]; $i = $i + 100) {
            $load[$i] = "";
        }
        return $load;
    }

    function getLoad($subSereis) {
        $this->zeroload = array();
        $this->nonzeroload = array();
        $this->load = array();
        for ($i = $subSereis[0]; $i <= $subSereis[1]; $i = $i + 100) {
            $resutl = $this->adminDB[$_SESSION['db_1']]->query("SELECT `" . $_POST["gameid"] . "` FROM `" . $i . "` ORDER BY `number` ASC");
            $totalLoad = array();
            $zero = array();
            $nonzero = array();
            $k = 0;
            while ($row = $resutl->fetch_assoc()) {
                array_push($totalLoad, $row[$_POST["gameid"]]);
                if ($row[$_POST["gameid"]] == 0) {
                    array_push($zero, $k);
                } else {
                    array_push($nonzero, $k);
                }
                $k++;
            }
            $this->zeroload[$i] = $zero;
            $this->nonzeroload[$i] = $nonzero;
            $this->load[$i] = $totalLoad;
        }
    }

    function emptZeroLoad() {
        $return = false;
        foreach ($this->zeroload as $sr => $point) {
            if (empty($point)) {
                $return = true;
            } else {
                $return = false;
                break;
            }
        }
        return $return;
    }

    public function execute() {
        parent::execute();
        try {
            $this->getGlobal();
            $resultSeries = $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->select("gameseries", $_SESSION["db_1"]));
            while ($rowSereis = $resultSeries->fetch_assoc()) {
                $series = $rowSereis["series"];
                $subSereis = explode("-", $rowSereis["series"]);
                print_r($subSereis);
                $sum = $this->getSum($subSereis);
                $this->load = $this->getEmptyLoad($subSereis);
                $this->getLoad($subSereis);
                $this->load["lottoweight"] = $sum; //$totalLoad;
                $_POST["loadarray"] = json_encode($this->load);
                $point = (float) $sum;
                $_POST["dload"] = $point;
                echo "Total Points: " . $point . "<br>";
                echo "Total Amount: " . $point * 2 . "<br>";
                $per = (float) $this->per;
                echo "Per " . $this->per . "%  <br>";
                $_POST["80per"] = $per;
                echo "<br>winrate {$this->wrate}<br>";
                echo $point * $this->per;
                $pointPerPlat = round((($point*$this->per)/100) / 90);
                echo "<br> Perplat Point : " . $pointPerPlat . "</br>";
                $wamt = (round($per) * 2);
                //die;
                echo "Excepted Wingin amt  " . $wamt . PHP_EOL;
                //$sql="SELECT number ,`".$_REQUEST["id"]."` FROM `".$subSereis[0]."` ";
                $noin = "0";
                $lottery = array();
                $indexArray = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
                shuffle($indexArray);

                for ($j = 0; $j < 10; $j++) {
                    $i = $indexArray[$j];
                    $chile = (int) $subSereis[0] + (100 * $i);
                    if ($noin === "0") {
                        $sql = " SELECT number ,`" . $_REQUEST["id"] . "` FROM `" . $chile . "` WHERE `" . $_REQUEST["id"] . "`<='" . $pointPerPlat . "'  ORDER BY `" . $_REQUEST["id"] . "` DESC";
                    } else {
                        echo $sql = " SELECT number ,`" . $_REQUEST["id"] . "` FROM `" . $chile . "` WHERE `" . $_REQUEST["id"] . "`<='" . $pointPerPlat . "' AND `number` NOT IN (" . $noin . ") ORDER BY `" . $_REQUEST["id"] . "` DESC";
                    }
                    $sresult = $this->adminDB[$_SESSION["db_1"]]->query($sql);
                    $num = array();
                    $zero = array();
                    $var=array();
                    while ($srow = $sresult->fetch_assoc()) {
                        if ((int) $srow[$_REQUEST["id"]] > 0) {
                            array_push($num, $srow["number"]);
                            $var[$srow["number"]]=$srow[$_REQUEST["id"]];
                        } else {
                            array_push($zero, $srow["number"]);
                        }
                    }
                    $flg = array(1, 0);
                    $fkey = array_rand($flg, 1);
                    if ($fkey == 1 && count($num) > 6) {
                        $isSelected = false;
                        foreach ($num as $k => $val) {
                            $random_keys = array_rand($num, 1);
                            $nono = $num[$random_keys];
                            if (!$isSelected) {
                                if (!in_array($nono, $lottery)) {
                                    $lottery[$i] = $nono;
                                    $pointPerPlat=$pointPerPlat-$var[$nono];
                                    $isSelected = true;
                                }
                            }
                        }
                    } else {
                        $isSelecteds = false;
                        foreach ($zero as $k => $val) {
                            $random_keys = array_rand($zero, 1);
                            $nono = $zero[$random_keys];
                            if (!$isSelecteds) {
                                if (!in_array($nono, $lottery)) {
                                    $lottery[$i] = $nono;
                                    $isSelecteds = true;
                                }
                            }
                        }
                    }
                    
                    if ($j == 0) {
                        $noin = " " . $nono;
                    } else if (!empty($nono)) {
                        $noin .= ", " . $nono;
                    }
                    //echo $i."=>".$nono."<br>";
                }
                ksort($lottery);
                //print_r($lottery);die;
                $data = array("gameid" => $_POST["gameid"], "gamestime" => $_POST["stime"], "gameetime" => $_POST["etime"], "gdate" => date("Y-m-d"), "dload" => $_POST["dload"], "80per" => $this->per, "loadarray" => $loadData, "series" => $series);
                $d = array_merge($data, $lottery);
                $query = $this->ask_mysqli->select("winnumber", $_SESSION["db_1"]) . $this->ask_mysqli->where(array("gameid" => $_POST["gameid"], "gamestime" => $_POST["stime"], "gameetime" => $_POST["etime"], "gdate" => date("Y-m-d"), "series" => $series), "AND");
                $rp = $this->adminDB[$_SESSION["db_1"]]->query($query);
                if ($r = $rp->fetch_assoc()) {
                    echo "already Result Disply"; //$this->ResetDrawLoad();
                    //$this->ResetDrawLoad($subSereis);
                } else {
                    $sql = $this->ask_mysqli->insertSpecialChar("winnumber", $d);
                    //echo "<br>";
                    $this->adminDB[$_SESSION["db_1"]]->query($sql);
                    //$this->ResetDrawLoad($subSereis);
                }
            }
            $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->update(array("status" => "1"), "gametime") . $this->ask_mysqli->whereSingle(array("id" => $_POST["gameid"])));
        } catch (Exception $ex) {
            
        }
    }


    public function finalize() {
        parent::finalize();
        return;
    }

    public function reader() {
        parent::reader();

        return;
    }

    function ResetDrawLoad($subSeries) {
        for ($i = $subSeries[0]; $i <= $subSeries[1]; $i = $i + 100) {
            $sql = $this->ask_mysqli->update(array("" . $_POST["gameid"] . "" => 0), "`" . $i . "`");
            $this->adminDB[$_SESSION["db_1"]]->query($sql);
        }
//        $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->update(array("`" . $_POST["gameid"] . "`" => 0), "lottoweight"));
//        for ($i = 1000; $i < 2000; $i = $i + 100) {
//            $this->adminDB[$_SESSION["db_1"]]->query($this->update(array("`" . $_POST["gameid"] . "`" => 0), "`" . $i . "`"));
//        }
    }

    public function distory() {
        parent::distory();
        return;
    }

    function UniqueRandomNumbersWithinRange($min, $max, $quantity) {
        $numbers = range($min, $max);
        shuffle($numbers);
        return array_slice($numbers, 0, $quantity);
    }

    function discard($unicarray, $arr) {
        foreach ($unicarray as $key => $val) {
            
        }
    }

    function paddZeor($val, $s) {
        $s = $s * 1000;
        for ($i = 0; $i < 100; $i++) {
            if ((int) $val[$i] == 0) {
                $val[$i] = $s;
            }
        }
        return $val;
    }

    function getArray($val) {
        $load = array();
        $notload = array();
        foreach ($val as $key => $v) {
            foreach ($v as $k => $vv) {
                if ($vv > 0) {
                    array_push($load, $k);
                } else {
                    array_push($notload, $k);
                }
            }
        }
        shuffle($load);
        shuffle($notload);
        $arr = array_merge($load, $notload);
        return $arr;
    }

    private static function Descending($a, $b) {
        if ($a == $b) {
            return 0;
        }
        return ($a > $b) ? -1 : 1;
    }

}
