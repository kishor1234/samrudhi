<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author asksoft
 */
//die(APPLICATION);
//require_once getcwd() . '/' . APPLICATION . "/controllers/Crout.php";
require_once controller;

class invoice extends CAaskController
{

    //put your code here
    public $data = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        parent::create();

        return;
    }

    public function initialize()
    {
        parent::initialize();

        return;
    }

    public function execute()
    {
        parent::execute();
        //        $myfile = fopen("data.json", "r") or die("Unable to open file!");
        //        $postdata = fread($myfile, filesize("data.json"));
        //        fclose($myfile);
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata, true);
        $jsonData = json_decode($postdata, true);

        $limit = 0;
        $finalArray = array();
        $temp = array();
        $qty = 0;
        $t = 0;
        $error = array();

        //print_r($jsonData);die;
        $sql = $this->ask_mysqli->select("enduser", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("userid" => $jsonData["main"]["userid"]));
        $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
        if ($row = $result->fetch_assoc()) {
            if (strcmp($jsonData["main"]["advance"], "true") == 0) {

                if ($row["balance"] >= $jsonData["main"]["adtotalamt"]) {

                    $this->adminDB[$_SESSION["db_1"]]->autocommit(FALSE);
                    //calculat princiapl amount removing discount
                    $discountAmount = (float) ($jsonData["main"]["adtotalamt"] * $row["comission"]);
                    $principal_amount = (float) ($jsonData["main"]["adtotalamt"] - $discountAmount);
                    $s = $this->ask_mysqli->_updateINC(array("balance" => "balance-" . $principal_amount), "enduser") . $this->ask_mysqli->whereSingle(array("userid" => $jsonData["main"]["userid"]));
                    $this->adminDB[$_SESSION["db_1"]]->query($s) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    //transaction
                    $sql = $this->ask_mysqli->insert("transaction", array("userid" => $jsonData["main"]["userid"], "debit" => $principal_amount, "remark" => "Buy Ticket at PT {$principal_amount}", "ip" => $_SERVER["REMOTE_ADDR"], "balance" => $this->getData($this->ask_mysqli->select("enduser", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("userid" => $jsonData["main"]["userid"])), "balance")));
                    $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB["db_1"]->error) : true;
                    //end transaction
                    $sql = $this->ask_mysqli->insert("usertranscation", array("drawid" => $jsonData["main"]["drawid"], "enterydate" => date("Y-m-d"), "gid" => 1, "userid" => $jsonData["main"]["userid"], "netamt" => $jsonData["main"]["adtotalamt"], "discount" => $row["comission"], "discountamt" => $discountAmount, "total" => $principal_amount, "ip" => $_SERVER["REMOTE_ADDR"]));
                    $this->adminDB[$_SESSION["db_1"]]->query($sql) != 1 ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    $transaction_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                    $unilast = 9536254 + $transaction_id;
                    $s = $this->ask_mysqli->update(array("trno" => $unilast, "invoiceno" => $unilast), "usertranscation") . $this->ask_mysqli->whereSingle(array("id" => $transaction_id));
                    $this->adminDB[$_SESSION["db_1"]]->query($s) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;

                    foreach ($jsonData as $key => $val) {
                        if (strcmp($key, "main") != 0) {
                            $perPoint = $val["basic"]["perPoint"];
                            //add singel invoice here

                            $unicid = $this->randString(2) . $transaction_id; //. $this->randString(2)
                            $insertSingleInvoice = array(
                                "utrno" => $unilast,
                                "own" => $val["basic"]["userid"],
                                "game" => $unicid,
                                "point" => json_encode($val["data"]),
                                "amount" => $val["basic"]["totalamt"],
                                "enterydate" => date("Y-m-d"),
                                "comission" => $row["comission"],
                                "comissionAMT" => $discountAmount,
                                "totalpoint" => $val["basic"]["totalqty"],
                                "enterydate" => (string) date("Y-m-d"),
                                "winstatus" => (string) 0,
                                "winamt" => (string) 0,
                                "claimstatus" => (string) 0,
                                "ip" => $val["basic"]["ip"],
                                "gametime" => $val["basic"]["start"],
                                "gameendtime" => $val["basic"]["end"],
                                "gametimeid" => $val["basic"]["drawid"]
                            );

                            //insert main ticket using $transaction_id 
                            //$insertSingleInvoice["utrno"] = $last;
                            $sql = $this->ask_mysqli->insert("entry", $insertSingleInvoice);
                            $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                            $last_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;

                            $last = 152671 + $last_id;
                            $s = $this->ask_mysqli->update(array("trno" => $last), "entry") . $this->ask_mysqli->whereSingle(array("id" => $last_id));
                            $this->adminDB[$_SESSION["db_1"]]->query($s) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                            array_push($finalArray, $this->splitPrintDataAdvance($last_id, $error));
                        }
                    }
                    //die;
                    //print_r($insertSingleInvoice);
                    if (empty($error)) {
                        //$this->splitPrintData($last_id);
                        $this->adminDB[$_SESSION["db_1"]]->commit();
                        //$this->adminDB[$_SESSION["db_1"]]->rollback();
                        echo json_encode(array("trno" => $unilast, "status" => "1", "msg" => "Success", "advance" => "true", "print" => (string) $unilast));
                    } else {
                        $this->adminDB[$_SESSION["db_1"]]->rollback();
                        echo json_encode(array("status" => "0", "msg" => "Invalid User", "print" => $error));
                    }
                } else {
                    echo json_encode(array("status" => "0", "msg" => "Insuficent Balance", "print" => $error));
                }
            } else {


                if ($row["balance"] >= $jsonData["main"]["totalamt"]) {
                    $limit = 0;
                    $finalArray = array();
                    $temp = array();
                    $qty = 0;
                    $t = 0;
                    $error = array();
                    $perPoint = $jsonData["main"]["perPoint"];
                    $this->adminDB[$_SESSION["db_1"]]->autocommit(FALSE);
                    //add singel invoice here
                    $discountAmount = (float) ($jsonData["main"]["totalamt"] * $row["comission"]);
                    //$unicid = uniqid();
                    $insertSingleInvoice = array(
                        "own" => $jsonData["main"]["userid"],
                        "game" => "",
                        "point" => json_encode($jsonData["data"]),
                        "amount" => $jsonData["main"]["totalamt"],
                        "enterydate" => date("Y-m-d"),
                        "comission" => $row["comission"],
                        "comissionAMT" => $discountAmount,
                        "totalpoint" => $jsonData["main"]["totalqty"],
                        "enterydate" => (string) date("Y-m-d"),
                        "winstatus" => (string) 0,
                        "winamt" => (string) 0,
                        "claimstatus" => (string) 0,
                        "ip" => $jsonData["main"]["ip"],
                        "gametime" => $jsonData["main"]["start"],
                        "gameendtime" => $jsonData["main"]["end"],
                        "gametimeid" => $jsonData["main"]["drawid"]
                    );
                    //calculat princiapl amount removing discount
                    $principal_amount = (float) ($jsonData["main"]["totalamt"] - $discountAmount);
                    $s = $this->ask_mysqli->_updateINC(array("balance" => "balance-" . $principal_amount), "enduser") . $this->ask_mysqli->whereSingle(array("userid" => $jsonData["main"]["userid"]));
                    $this->adminDB[$_SESSION["db_1"]]->query($s) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    //transaction
                    $sql = $this->ask_mysqli->insert("transaction", array("userid" => $jsonData["main"]["userid"], "debit" => $principal_amount, "remark" => "Buy Ticket at PT {$principal_amount}", "ip" => $_SERVER["REMOTE_ADDR"], "balance" => $this->getData($this->ask_mysqli->select("enduser", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("userid" => $jsonData["main"]["userid"])), "balance")));
                    $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB["db_1"]->error) : true;
                    //end transaction
                    $sql = $this->ask_mysqli->insert("usertranscation", array("drawid" => $jsonData["main"]["drawid"], "enterydate" => date("Y-m-d"), "gid" => 1, "drawid" => $insertSingleInvoice["gametimeid"], "userid" => $insertSingleInvoice["own"], "invoiceno" => $insertSingleInvoice["game"], "netamt" => $insertSingleInvoice["amount"], "discount" => $insertSingleInvoice["comission"], "discountamt" => $insertSingleInvoice["comissionAMT"], "total" => $principal_amount, "ip" => $_SERVER["REMOTE_ADDR"]));
                    $this->adminDB[$_SESSION["db_1"]]->query($sql) != 1 ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    $transaction_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                    $last = 9536254 + $transaction_id;
                    $unicid = $this->randString(2) . $transaction_id; //. $this->randString(2);
                    $s = $this->ask_mysqli->update(array("trno" => $last, "invoiceno" => $last), "usertranscation") . $this->ask_mysqli->whereSingle(array("id" => $transaction_id));
                    $this->adminDB[$_SESSION["db_1"]]->query($s) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;

                    //insert main ticket using $transaction_id 
                    $insertSingleInvoice["utrno"] = $last;
                    $insertSingleInvoice["game"] = $unicid;
                    $sql = $this->ask_mysqli->insert("entry", $insertSingleInvoice);
                    $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    $last_id = $this->adminDB[$_SESSION["db_1"]]->insert_id;
                    //print_r($insertSingleInvoice);
                    $utrno = $last;
                    if (empty($error)) {
                        $this->splitPrintData($last_id, $utrno, $error);
                        //$this->adminDB[$_SESSION["db_1"]]->commit();
                    } else {
                        $this->adminDB[$_SESSION["db_1"]]->rollback();
                        echo json_encode(array("trno" => (string) $utrno, "status" => "0", "msg" => "Invalid User", "print" => $error));
                    }
                } else {
                    echo json_encode(array("status" => "0", "msg" => "Insuficent Balance", "print" => $error));
                }
            }
        } else {
            echo json_encode(array("status" => "0", "msg" => "Invalid User", "print" => $error));
        }


        return;
    }

    public function finalize()
    {
        parent::finalize();
        return;
    }

    public function reader()
    {
        parent::reader();
        return;
    }

    public function distory()
    {
        parent::distory();
        return;
    }

    function splitPrintDataAdvance($last_id, $error)
    {
        try {
            $sql = $this->ask_mysqli->select("entry", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $last_id));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                //print_r($row);
                $t = 0;
                $limit = 1;
                $qty = 0;
                $myPoint = json_decode($row["point"], true);
                $finalArray = array();
                $temp = array();
                foreach ($myPoint as $Key => $Array) {
                    foreach ($Array as $_1key => $_1array) { //1000-1900
                        foreach ($_1array as $_2key => $_2array) { //1800
                            //echo $_2key;
                            foreach ($_2array as $in => $valArray) { //1800
                                foreach ($valArray as $index => $value) { //point
                                    //print_r($value);echo "\n";
                                    $t = $t + $value;
                                    if ($limit == 56) {
                                        $final = array(
                                            "own" => $row["own"],
                                            "totalpoint" => (string) $row["totalpoint"],
                                            "amount" => (string) $row["amount"],
                                            "enterydate" => (string) $row["enterydate"],
                                            "winstatus" => (string) 0,
                                            "winamt" => (string) 0,
                                            "claimstatus" => (string) 0,
                                            "ip" => $row["ip"],
                                            "gametime" => $row["gametime"],
                                            "gameendtime" => $row["gameendtime"],
                                            "gametimeid" => $row["gametimeid"],
                                            "game" => $row["game"],
                                            "point" => $temp
                                        );
                                        array_push($finalArray, $final);
                                        $limit = 1;
                                        $qty = 0;
                                        $temp = array();
                                        $indV = $_2key + $index;
                                        array_push($temp, array($indV => $value));
                                        $qty = $qty + $value;
                                        $sql = $this->ask_mysqli->updateINC(array("`" . $row["gametimeid"] . "`" => $value), "`" . $_2key . "`") . $this->ask_mysqli->whereSingle(array("number" => sprintf("%02d", $index))) . "\n";
                                        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                                    } else {
                                        $indV = $_2key + $index;
                                        array_push($temp, array($indV => $value));
                                        $qty = $qty + $value;
                                        //update query
                                        $sql = $this->ask_mysqli->updateINC(array("`" . $row["gametimeid"] . "`" => $value), "`" . $_2key . "`") . $this->ask_mysqli->whereSingle(array("number" => sprintf("%02d", $index))) . "\n";
                                        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                                        //echo $indV . "=" . $value . "\n";
                                        $limit++;
                                    }
                                }
                            }
                            //print_r($valArray);
                        }
                    }
                }
                //die;
                $final = array(
                    "own" => $row["own"],
                    "totalpoint" => (string) $row["totalpoint"],
                    "amount" => (string) $row["amount"],
                    "enterydate" => (string) $row["enterydate"],
                    "winstatus" => (string) 0,
                    "winamt" => (string) 0,
                    "claimstatus" => (string) 0,
                    "ip" => $row["ip"],
                    "gametime" => $row["gametime"],
                    "gameendtime" => $row["gameendtime"],
                    "gametimeid" => $row["gametimeid"],
                    "game" => $row["game"],
                    "point" => $temp
                );
                array_push($finalArray, $final);

                if (empty($error)) {
                    $trno = 152671 + $last_id;
                    //echo $sql = $this->ask_mysqli->update(array("trno" => $trno), "entry") . $this->ask_mysqli->whereSingle(array("id" => $last_id));
                    //$this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;


                    foreach ($finalArray as $key => $valArray) {
                        $valArray["point"] = json_encode($valArray["point"]);
                        $valArray["comission"] = $row["comission"];
                        $valArray["trno"] = $trno;
                        $amt = $valArray["amount"];
                        $dmt = (float) ($amt * $row["comission"]);
                        $valArray["comissionAMT"] = $dmt;
                        $sql = $this->ask_mysqli->insert("subentry", $valArray);
                        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    }
                }
                $result = $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->select("gametime", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $row["gametimeid"])));
                $row = $result->fetch_assoc();
                // print_r($row);
                if (empty($error) && $row["status"] === "0") {
                    //$this->adminDB[$_SESSION["db_1"]]->commit();
                    return $finalArray;
                    //echo json_encode(array("status" => "1", "msg" => "Success", "print" => $finalArray));
                } else {
                    $this->adminDB[$_SESSION["db_1"]]->rollback();
                    array_push($error, $this->ask_mysqli->select("gametime", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $jsonData["basic"]["drawid"])));
                    echo json_encode(array("status" => "0", "msg" => "Timeout", "print" => $error));
                    die;
                }
            } else {
                $this->adminDB[$_SESSION["db_1"]]->rollback();
                echo json_encode(array("status" => "0", "msg" => "Timeout Error on insertsss", "print" => $error));
                die;
            }
        } catch (Exception $ex) {
        }
    }

    function splitPrintData($last_id, $utrno, $error)
    {
        try {
            $sql = $this->ask_mysqli->select("entry", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $last_id));
            $result = $this->adminDB[$_SESSION["db_1"]]->query($sql);
            if ($row = $result->fetch_assoc()) {
                $myPoint = json_decode($row["point"], true);
                $finalArray = array();
                $temp = array();
                $t = 0;
                $limit = 1;
                $qty = 0;
                foreach ($myPoint as $Key => $Array) {
                    foreach ($Array as $_1key => $_1array) { //1000-1900
                        foreach ($_1array as $_2key => $_2array) { //1800
                            //echo $_2key;
                            foreach ($_2array as $in => $valArray) { //1800
                                foreach ($valArray as $index => $value) { //point
                                    //print_r($value);echo "\n";
                                    $t = $t + $value;
                                    if ($limit == 56) {
                                        $final = array(
                                            "own" => $row["own"],
                                            "totalpoint" => (string) $row["totalpoint"],
                                            "amount" => (string) $row["amount"],
                                            "enterydate" => (string) $row["enterydate"],
                                            "winstatus" => (string) 0,
                                            "winamt" => (string) 0,
                                            "claimstatus" => (string) 0,
                                            "ip" => $row["ip"],
                                            "gametime" => $row["gametime"],
                                            "gameendtime" => $row["gameendtime"],
                                            "gametimeid" => $row["gametimeid"],
                                            "game" => $row["game"],
                                            "point" => $temp
                                        );
                                        array_push($finalArray, $final);
                                        $limit = 1;
                                        $qty = 0;
                                        $temp = array();
                                        $indV = $_2key + $index;
                                        array_push($temp, array($indV => $value));
                                        $qty = $qty + $value;
                                        $sql = $this->ask_mysqli->updateINC(array("`" . $row["gametimeid"] . "`" => $value), "`" . $_2key . "`") . $this->ask_mysqli->whereSingle(array("number" => sprintf("%02d", $index))) . "\n";
                                        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                                    } else {
                                        $indV = $_2key + $index;
                                        array_push($temp, array($indV => $value));
                                        $qty = $qty + $value;
                                        //update query
                                        $sql = $this->ask_mysqli->updateINC(array("`" . $row["gametimeid"] . "`" => $value), "`" . $_2key . "`") . $this->ask_mysqli->whereSingle(array("number" => sprintf("%02d", $index))) . "\n";
                                        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                                        //echo $indV . "=" . $value . "\n";
                                        $limit++;
                                    }
                                }
                            }
                            //print_r($valArray);
                        }
                    }
                }
                //die;
                $final = array(
                    "own" => $row["own"],
                    "totalpoint" => (string) $row["totalpoint"],
                    "amount" => (string) $row["amount"],
                    "enterydate" => (string) $row["enterydate"],
                    "winstatus" => (string) 0,
                    "winamt" => (string) 0,
                    "claimstatus" => (string) 0,
                    "ip" => $row["ip"],
                    "gametime" => $row["gametime"],
                    "gameendtime" => $row["gameendtime"],
                    "gametimeid" => $row["gametimeid"],
                    "game" => $row["game"],
                    "point" => $temp
                );
                array_push($finalArray, $final);
                if (empty($error)) {
                    $trno = 152671 + $last_id;
                    $sql = $this->ask_mysqli->update(array("trno" => $trno), "entry") . $this->ask_mysqli->whereSingle(array("id" => $last_id));
                    $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;


                    foreach ($finalArray as $key => $valArray) {
                        $valArray["point"] = json_encode($valArray["point"]);
                        $valArray["comission"] = $row["comission"];
                        $valArray["trno"] = $trno;
                        $amt = $valArray["amount"];
                        $dmt = (float) ($amt * $row["comission"]);
                        $valArray["comissionAMT"] = $dmt;
                        $sql = $this->ask_mysqli->insert("subentry", $valArray);
                        $this->adminDB[$_SESSION["db_1"]]->query($sql) != true ? array_push($error, $this->adminDB[$_SESSION["db_1"]]->error) : true;
                    }
                }
                $result = $this->adminDB[$_SESSION["db_1"]]->query($this->ask_mysqli->select("gametime", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $row["gametimeid"])));
                $row = $result->fetch_assoc();
                if (empty($error) && $row["status"] === "0") {
                    $this->adminDB[$_SESSION["db_1"]]->commit();
                    echo json_encode(array("trno" => (string) $utrno, "status" => "1", "msg" => "Success", "advance" => "false", "print" => $finalArray));
                } else {
                    $this->adminDB[$_SESSION["db_1"]]->rollback();
                    array_push($error, $this->ask_mysqli->select("gametime", $_SESSION["db_1"]) . $this->ask_mysqli->whereSingle(array("id" => $jsonData["basic"]["drawid"])));
                    echo json_encode(array("status" => "0", "msg" => "Timeout", "print" => $error));
                }
            } else {
                echo json_encode(array("status" => "0", "msg" => "Timeout Error on insert", "print" => $error));
            }
        } catch (Exception $ex) {
        }
    }


    function randString($length)
    {
        $char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $char = str_shuffle($char);
        for ($i = 0, $rand = '', $l = strlen($char) - 1; $i < $length; $i++) {
            $rand .= $char{mt_rand(0, $length)};
        }
        return $rand;
    }
}
