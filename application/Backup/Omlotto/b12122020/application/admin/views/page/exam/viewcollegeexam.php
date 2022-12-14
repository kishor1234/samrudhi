<style>
    #bannerimg{
        width: 30%;
        height: auto;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark breadcrumb"><?= $title ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <?php
                        foreach ($link as $key => $val) {
                            echo "<li class=\"breadcrumb-item active\"><a href=\"{$val}\">$key</a></li>";
                        }
                        ?>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <?php
//    $curl = curl_init();
//    curl_setopt_array($curl, [
//        CURLOPT_RETURNTRANSFER => 1,
//        CURLOPT_URL => api_url . '/?r=CExam',
//        CURLOPT_USERAGENT => 'Codular Sample cURL Request',
//        CURLOPT_POST => 1,
//        CURLOPT_POSTFIELDS => [
//            id => $this->encript->encTxt($_REQUEST["id"]),
//            action=>"selectExam"
//        ]
//    ]);
//    $resp = curl_exec($curl);
//    curl_close($curl);
    ?>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="progress" id="progresss">
                            <div class="progress-bar bg-primary progress-bar-striped progress-bar-animated" id="inner-progress" style="width:100%">Please wait....</div>
                        </div>
                        <div class="card-header">
                            <div class="card-title mb-2">
                                <!-- Button to Open the Modal -->
                                <h1>Update Exam </h1>
                                <!-- The Modal -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12" id="wait">

                                </div>
                            </div>
                            <form action="#" method="post" id="myForm">
                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Select Company <span class="text-danger">*</span></label>
                                        <select id="compnayid"  class="form-control" required="" title="company id">

                                        </select>
                                        <span id="error_companyid" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Exam Title <span class="text-danger">*</span></label>
                                        <input type="text" id="title" name="title" required="" class="form-control" placeholder="Exam Title" title="Exam Title">
                                        <span id="error_companyid" class=""></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label class="form-control-label">Exam Time Duration in min. <span class="text-danger">*</span></label>
                                        <input type="number" name="examtime"  id="examtime" value="0" placeholder="Exam Time Duration in min." title="Exam Time Duration in min." required autocomplete="off" class="form-control">
                                        <span id="error_examtime" class=""></span>
                                    </div>

                                </div>
                                <div class="card card-primary card-outline">
                                    <div class="card-header">
                                        <span class="cart-title">Exam Subjects</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="addSubject($.session.get('i'))">Add Subject</a>
                                    </div>
                                    <div id="examsubject" class="card-body">

                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Number of Questions <span class="text-danger">*</span></label>
                                        <input type="number" name="noofquestion" readonly="" id="noofquestion" value="0" placeholder="Number of Questions" title="Number of Questions" required autocomplete="off" class="form-control">
                                        <span id="error_a" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Mark for each Question <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="markofeach" id="markofeach" placeholder="Mark for each Question" title="Mark for each Question" required autocomplete="off" class="form-control">
                                        <span id="error_b" class=""></span>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Negative Mark of each <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="negativemarkofeach" id="negativemarkofeach" placeholder="Negative Mark of each" title="Negative Mark of each" required autocomplete="off" class="form-control">
                                        <span id="error_c" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Passing Marks <span class="text-danger">*</span></label>
                                        <input type="text" step="0.01" name="passingmark" id="passingmark"  placeholder="Passing Marks" title="Passing Marks" required autocomplete="off" class="form-control">
                                        <span id="error_d" class=""></span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Exam Start Date <span class="text-danger">*</span></label>
                                        <input type="date"  name="startdate" id="startdate" placeholder="Exam Start Date" title="Negative Mark of each" required autocomplete="off" class="form-control">
                                        <span id="error_c" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Exam End Date <span class="text-danger">*</span></label>
                                        <input type="date" min="<?= date("Y-m-d"); ?>" name="closedate" id="closedate"  placeholder="Exam End Date" title="Exam End Date" required autocomplete="off" class="form-control">
                                        <span id="error_d" class=""></span>
                                    </div>
                                    <div class="col-lg-6">

                                    </div>
                                </div>
                                <div class=" form-group" id="examCriteria">
                                    <div class="card card-primary card-outline">
                                        <div class="card-header">
                                            <label class="form-control-label">Add Exam Criteria <span class="text-danger">*</span></label>
                                            <button type="button" class="btn btn-success btn-sm"  onclick="addExamCriteria('#ext')">Add More Exam Criteria</button>
                                            <input type="hidden" id="noct" value="0">
                                        </div>
                                        <div class="card-body" id="ext">

                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label class="form-control-label">Exam Short Description <span class="text-danger">*</span></label>
                                        <textarea id="sdesc"></textarea>
                                        <input type="hidden" name="short" id="short">
                                        <span id="error_short" class=""></span>
                                    </div>
                                    <div class="col-lg-12 mb-5">
                                        <label class="form-control-label">Exam Full Description <span class="text-danger">*</span></label>
                                        <textarea id="fdesc"></textarea>
                                        <input type="hidden" name="full" id="full">
                                        <span id="error_full" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label class="form-control-label">Banner </label>
                                        <input type="file" name="banner" id="banner" accept="image/jpg,image/png,image/jpeg">
                                        <span id="error_full" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <img scr="" alt="banner" id="bannerimg">
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label">Meta Description <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="metadescription" id="metadescription" placeholder="Meta Description" required=""></textarea>
                                        <span id="error_metadescription" class=""></span>
                                    </div>
                                    <div class="col-lg-12">
                                        <label class="form-control-label">Meta Keyword <span class="text-danger">*</span></label>
                                        <input type="text" name="metakeyword" class="form-control" id="metakeyword" placeholder="Meta Keyword" required=""  >
                                        <span id="error_metakeyword" class=""></span>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="radio" name="isActive" value="1" id="active">Active
                                        <input type="radio" name="isActive" value="0" id="deactive">De-Active
                                    </div>
                                </div>
                                <div class="row">
                                    <br>
                                    <div class="col-lg-12">
                                        <style>
                                            #progress{
                                                display: none;
                                            }
                                        </style>
                                        <div class="progress" id="progress">
                                            <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" id="inner-progress pro1">Please wait....</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <input type="hidden" name="action" id="action" value="update">
                                    <input type="hidden" name="id" id="id" value="0">

                                    <div class="col-lg-12">
                                        <button class="btn btn-primary btn-xs form-control" id="uptbutton">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<datalist id="slist">

</datalist>
<!-- /.content-wrapper -->
<script type="text/javascript">
    var table;
    var edit;
    $.session.set("i", 0);
    $(function () {
        onLoadid();
    });
    function getSearchParams(k) {
        var p = {};
        location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (s, k, v) {
            p[k] = v
        })
        return k ? p[k] : p;
    }
    function onLoadid()
    {
        $("#progresss").show();
        $("#wait").show();
        onLoading("#wait", 1);
        $("#myForm").hide();
        if (getSearchParams("id")) {

            $.post('<?= api_url ?>/?r=CExam', {id: getSearchParams("id"), action: 'selectExam'}, function (data) {
                console.log(data);
                var json = JSON.parse(data);
                setTimeout(function () {
                    if (parseInt(json.rows["isActive"]) === 0)
                    {
                        // $("#uptbutton").attr("disabled", true);
                    }
                    $("#compnayid").attr("disabled", true);
                    $("#title").val(json.rows["title"]);
                    $("#id").val(json.rows["id"]);
                    $("#examtime").val(json.rows["examtime"]);
                    CKEDITOR.instances.sdesc.setData(json.rows["short"]);
                    CKEDITOR.instances.fdesc.setData(json.rows["full"]);
                    $("#compnayid").val(json.rows["companyid"]).change();
                    $("#noofquestion").val(json.rows["noofquestion"]);
                    $("#markofeach").val(json.rows["markofeach"]);
                    $("#negativemarkofeach").val(json.rows["negativemarkofeach"]);
                    $("#passingmark").val(json.rows["passingmark"]);
                    $("#startdate").val(json.rows["startdate"]);
                    $("#closedate").val(json.rows["closedate"]);
                    $("#metadescription").val(json.rows["metadescription"]);
                    $("#metakeyword").val(json.rows["metakeyword"]);
                    $("#bannerimg").attr("src", json.rows["banner"]);
                    if (parseInt(json.rows["isActive"]) === 1)
                    {
                        $("#active").attr("checked", true);
                    } else {
                        $("#deactive").attr("checked", true);
                    }
                }, 2000);
                for (var i = 0; i < json.subject.length; i++)
                {
                    addSubject(i);
                }
                for (var i = 0; i < json.criteria.length; i++)
                {
                    addExamCriteriaSelected('#ext', i);
                }
                setTimeout(function () {
                    for (var i = 0; i < json.subject.length; i++)
                    {
                        $("#smultiple" + i).val(json.subject[i]["subject"]).change();
                        $("#squestion" + i).val(json.subject[i]["squestion"]);
                        $("#sid" + i).val(json.subject[i]["id"]);
                    }
                }, 1000);
                setTimeout(function () {

                    for (var i = 0; i < json.criteria.length; i++)
                    {
                        $("#main_" + i).val(json.criteria[i]["main"]).change();
                        //$('#course_' + i).html("");
                        $("#passingyear_" + i).val(json.criteria[i]["passingyear"]);
                        $("#percentage_" + i).val(json.criteria[i]["percentage"]);
                        $("#eid" + i).val(json.criteria[i]["id"]);
                        //$("#course_" + i).val(json.criteria[i]["sub"]).change();
                    }
                }, 1000);
                setTimeout(function () {
                    for (var i = 0; i < json.criteria.length; i++)
                    {
                        $("#course_" + i).val(json.criteria[i]["sub"]).change();
                    }
                }, 2000);

                setTimeout(function () {
                    var promises = [];
                    for (var i = 0; i < json.criteria.length; i++)
                    {
                        var branch = json.criteria[i]["branch"];

                        var req = $.post('<?= api_url ?>/?r=CCourse', {parentid: $("#course_" + i).val(), action: 'loadMainSelect'}, function (data) {
                            var jsonss = JSON.parse(data);

                            var options = "<option value=''>--select---</option>";
                            if (jsonss.status === 1)
                            {
                                for (var j = 0; j < jsonss.data.length; j++)
                                {
                                    options += "<option value='" + jsonss.data[j]['id'] + "'>" + jsonss.data[j]['name'] + "</option>";
                                }
                            }
                            $('#branch_' + i).html(options);
                            //$("#branch_" + i).val(branch).change();

                        });
                        promises.push(req);
                    }
//                    
                }, 2000);
                setTimeout(function () {

                    for (var i = 0; i < json.criteria.length; i++)
                    {
                        var branch = json.criteria[i]["branch"];
                        $("#branch_" + i).val(branch).change();

                    }
                    $("#progresss").hide();
                    $("#wait").hide();

                    $("#myForm").show();
                }, 3000);
                //addSubject(0);


            });
        }
    }
    function addExamCriteriaSelected(addto, ct)
    {
        var o = '<div class="row" id="ext_' + ct + '">' +
                '<div class="col-lg-2">' +
                '<input type="hidden" id="eid' + ct + '" name="eid[]" value="0">' +
                '<label class="form-control-label">Edu Category<span class="text-danger">*</span></label>' +
                '<select required class="form-control" onchange="loadSub(\'#course_' + ct + ' \',\'#main_' + ct + ' \')" name="main[]" id="main_' + ct + '">' +
                '</select>' +
                '<span class="text-danger" id="error_main_' + ct + '"></span>' +
                ' </div>' +
                '<div class="col-lg-2">' +
                ' <label class="form-control-label">Course <span class="text-danger">*</span></label>' +
                '  <select required class="form-control" onchange="loadBranch(\'#branch_' + ct + ' \',\'#course_' + ct + ' \')" name="sub[]" id="course_' + ct + '">' +
                '  </select>' +
                '  <span class="text-danger" id="error_course_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-3">' +
                '   <label class="form-control-label">Branch<span class="text-danger">*</span></label>' +
                '   <select required class="form-control" name="branch[]" id="branch_' + ct + '">' +
                '   </select>' +
                '   <span class="text-danger" id="error_branch_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-2">' +
                '    <label class="form-control-label">Passing Year <span class="text-danger">*</span></label>' +
                '    <input type="text" maxlength="4" onkeypress="return isNumber(event);" required="" name="passingyear[]" id="passingyear_' + ct + '" class="form-control" autocomplete="off" placeholder="Passing Year" title="Passing Year">' +
                '    <span class="text-danger" id="error_passingyear_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-2">' +
                '    <label class="form-control-label">Percentage <span class="text-danger">*</span></label>' +
                '    <input type="number" step="0.01" required="" name="percentage[]" id="percentage_' + ct + '" class="form-control" autocomplete="off" placeholder="Percentage" title="Percentage">' +
                '    <span class="text-danger" id="error_percentage_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-1">' +
                '    <button type="button" class="btn btn-danger btn-xs" onclick="closeCT(\'' + ct + ' \')">&times;</button>' +
                '</div>' +
                '</div>';
        $(addto).append(o);
        $("#noct").val(ct);
        loadmain("#main_" + ct);
    }
    function addExamCriteria(addto)
    {

        var ct = parseInt($("#noct").val()) + 1;
        var o = '<div class="row" id="ext_' + ct + '">' +
                '<div class="col-lg-2">' +
                '<input type="hidden" id="eid' + ct + '" name="eid[]" value="0">' +
                '<label class="form-control-label">Edu Category<span class="text-danger">*</span></label>' +
                '<select required class="form-control" onchange="loadSub(\'#course_' + ct + ' \',\'#main_' + ct + ' \')" name="main[]" id="main_' + ct + '">' +
                '</select>' +
                '<span class="text-danger" id="error_main_' + ct + '"></span>' +
                ' </div>' +
                '<div class="col-lg-2">' +
                ' <label class="form-control-label">Course <span class="text-danger">*</span></label>' +
                '  <select required class="form-control" onchange="loadBranch(\'#branch_' + ct + ' \',\'#course_' + ct + ' \')" name="sub[]" id="course_' + ct + '">' +
                '  </select>' +
                '  <span class="text-danger" id="error_course_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-3">' +
                '   <label class="form-control-label">Branch<span class="text-danger">*</span></label>' +
                '   <select required class="form-control" name="branch[]" id="branch_' + ct + '">' +
                '   </select>' +
                '   <span class="text-danger" id="error_branch_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-2">' +
                '    <label class="form-control-label">Passing Year <span class="text-danger">*</span></label>' +
                '    <input type="text" maxlength="4" onkeypress="return isNumber(event);" required="" name="passingyear[]" id="passingyear_' + ct + '" class="form-control" autocomplete="off" placeholder="Passing Year" title="Passing Year">' +
                '    <span class="text-danger" id="error_passingyear_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-2">' +
                '    <label class="form-control-label">Percentage <span class="text-danger">*</span></label>' +
                '    <input type="number" step="0.01" required="" name="percentage[]" id="percentage_' + ct + '" class="form-control" autocomplete="off" placeholder="Percentage" title="Percentage">' +
                '    <span class="text-danger" id="error_percentage_' + ct + '"></span>' +
                '</div>' +
                '<div class="col-lg-1">' +
                '    <button type="button" class="btn btn-danger btn-xs" onclick="closeCT(\'' + ct + ' \')">&times;</button>' +
                '</div>' +
                '</div>';
        $(addto).append(o);
        $("#noct").val(ct);
        loadmain("#main_" + ct);
    }
    function closeST(ct)
    {
        var eid = parseInt($("#sid" + ct).val());
        if (eid !== 0) {
            $.post('<?= api_url ?>/?r=CExam', {id: eid, action: "deleteSubject"}, function (data) {
                console.log(data);
                var json = JSON.parse(data);
                $("#noofquestion").val(json.noofquestion);
                $("#subj" + ct).html("");
                $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

            });
        } else {
            $("#subj" + ct).html("");
        }
    }
    function closeCT(ct)
    {
        var eid = parseInt($("#eid" + ct).val());
        if (eid !== 0) {
            $.post('<?= api_url ?>/?r=CExam', {id: eid, action: "deleteCriteria"}, function (data) {
                console.log(data);
                var json = JSON.parse(data);
                $("#ext_" + ct).html("");
                $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});

            });
        } else {
            $("#ext_" + ct).html("");
        }
    }
    function loadmain(id)
    {
        $(id).html("");
        $.post('<?= api_url ?>/?r=CCourse', {id: 0, action: 'loadMain'}, function (data) {
            console.log(data);
            var json = JSON.parse(data);
            var option = "<option value=''>--select---</option>";
            if (json.status === 1)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    option += "<option value='" + json.data[i]['id'] + "'>" + json.data[i]['name'] + "</option>";
                }
            }
            $(id).html(option);
        });
    }
    function loadSub(id, main)
    {

        $(id).html("");
        $.post('<?= api_url ?>/?r=CCourse', {parentid: $(main).val(), action: 'loadMainSelect'}, function (data) {
            console.log(data);
            var json = JSON.parse(data);
            var option = "<option value=''>--select---</option>";
            if (json.status === 1)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    option += "<option value='" + json.data[i]['id'] + "'>" + json.data[i]['name'] + "</option>";
                }
            }
            $(id).html(option);
        });
    }
    function loadBranch(id, main)
    {
        $(id).html("");
        $.post('<?= api_url ?>/?r=CCourse', {parentid: $(main).val(), action: 'loadMainSelect'}, function (data) {
            console.log(data);
            var json = JSON.parse(data);
            var option = "<option value=''>--select---</option>";
            if (json.status === 1)
            {
                for (var i = 0; i < json.data.length; i++)
                {
                    option += "<option value='" + json.data[i]['id'] + "'>" + json.data[i]['name'] + "</option>";
                }
            }
            $(id).html(option);
        });
    }
    $("document").ready(function () {

        CKEDITOR.replace('sdesc', {
            height: 300,
            filebrowserUploadUrl: "upload.php"

        });
        timer = setInterval(updateDiv, 100);
        function updateDiv() {
            var editorText = CKEDITOR.instances.sdesc.getData();
            $('#short').val(editorText);
        }
        CKEDITOR.replace('fdesc', {
            height: 300,
            filebrowserUploadUrl: "upload.php"

        });
        timer = setInterval(updateDivf, 100);
        function updateDivf() {
            var editorText = CKEDITOR.instances.fdesc.getData();
            $('#full').val(editorText);
        }
        clist();
        //addSubject(0);
        function clist() {
            $.post('<?= api_url ?>/?r=CExam', {id: 0, action: 'clglist'}, function (data) {
                // console.log(data);
                var json = JSON.parse(data);
                var dp = "<option value=''>---select---</opton>";
                for (var i = 0; i < json.length; i++)
                {
                    var m = "<option value=" + json[i]["id"] + ">" + json[i]["college"] + "</option>";
                    dp = dp + m;
                }
                $("#compnayid").html(dp);
            });
        }
        function sublist() {
            $.post('<?= api_url ?>/?r=CExam', {id: 0, action: 'sublist'}, function (data) {
                console.log(data);
                var json = JSON.parse(data);
                var dp = "<option value=''>---select---</opton>";
                for (var i = 0; i < json.length; i++)
                {
                    var m = "<option value=" + json[i]["code"] + ">" + json[i]["code"] + "</option>";
                    dp = dp + m;
                }
                $("#smultiple1").html(dp);
                $("#smultiple2").html(dp);
            });
        }

    });
    $(document).ready(function () {



        $("#myForm").submit(function () {
            var formdata = new FormData($("#myForm")[0]);
            $.ajax({
                url: '<?= api_url ?>/?r=CExam',
                type: 'post',
                data: formdata,
                enctype: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                xhr: function () {
                    $("#loadimg").show();
                    $("#progress").show();
                    var xhr = new XMLHttpRequest();
                    xhr.upload.addEventListener('progress', function (e) {
                        var progressbar = Math.round((e.loaded / e.total) * 100);
                        $("#pro1").css('width', progressbar + '%');
                        $("#pro1").html(progressbar + '%');
                    });
                    return xhr;
                },
                success: function (data) {
                    console.log(data);
                    $("#loadimg").hide();
                    $("#progress").hide();
                    var json = JSON.parse(data);
                    if (json.status === 1) {
                        swal("Success", json.msg, "success");
                    } else {
                        swal("Error", json.msg, "error");
                    }
                    $('#myForm')[0].reset();
                    $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
                    $("#pro1").css('width', '0%');
                    $("#pro1").html('0%');
                    $("#pro1").hide();
                    //table.ajax.reload(null, false);
                    setTimeout(function () {
                        //location.reload(true);
                    }, 1000);
                },
                error: function (xhr, error, code)
                {
                    console.log(xhr);
                    console.log(code);
                }
            });
            return false;
        });
    });
    function editExam(id)
    {
        $.post('<?= api_url ?>/?r=CExam', {id: getSearchParams("id"), action: 'selectExam'}, function (data) {
            var json = JSON.parse(data);
            console.log(json.row["question"]);
            $("#id").val(json.row["id"]);
            CKEDITOR.instances['question'].setData(json.row["question"]);
            $("#subject").val(json.row["subject"]);
            $("#a").val(json.row["a"]);
            $("#b").val(json.row["b"]);
            $("#c").val(json.row["c"]);
            $("#d").val(json.row["d"]);
            $("#ans").val($("#" + json.row["answer"]).val());
            $("#answer").val(json.row["answer"]).change();
            $("#action").val("update");
            $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
        });
    }
    function editbusiness(id)
    {
        $.post('<?= api_url ?>/?r=CQuestions', {id: id, action: 'select'}, function (data) {
            var json = JSON.parse(data);
            console.log(json.row["question"]);
            $("#id").val(json.row["id"]);
            CKEDITOR.instances['question'].setData(json.row["question"]);
            $("#subject").val(json.row["subject"]);
            $("#a").val(json.row["a"]);
            $("#b").val(json.row["b"]);
            $("#c").val(json.row["c"]);
            $("#d").val(json.row["d"]);
            $("#ans").val($("#" + json.row["answer"]).val());
            $("#answer").val(json.row["answer"]).change();
            $("#action").val("update");
            $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
        });
    }
    function deletebusiness(id, st)
    {
        swal({
            title: "Are you sure?",
            text: "want to delete comapny?",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, Suspeded it!",
            closeOnConfirm: true
        },
        function () {
            $.post('<?= api_url ?>/?r=CQuestions', {id: id, st: st, action: 'delete'}, function (data) {
                //console.log(data);
                table.ajax.reload(null, false);
                var json = JSON.parse(data);
                $.toaster({priority: json.toast[0], title: json.toast[1], message: json.toast[2]});
            });
        });
    }
    function addSubject(id)
    {

        var sub = '<div id="subj' + id + '" class="row form-group">' +
                '<div class="col-lg-6">' +
                '<input type="hidden" id="sid' + id + '" name="sid[]" value="0">' +
                '<label class = "form-control-label" > Exam Subject <span class = "text-danger" > * </span></label >' +
                '<select id = "smultiple' + id + '" class = "form-control" name = "subject[]" >' +
                '</select>' +
                '<span id = "error_s' + id + '" class = "" > </span>' +
                '</div>' +
                '<div class = "col-lg-5" >' +
                '<label class = "form-control-label" > No. Questions <span class = "text-danger" > * </span></label >' +
                '<input type = "number" name = "squestion[]" id = "squestion' + id + '" onkeyup="calQuestion(' + id + ')" placeholder = "Number of Questions" title = "Number of Questions" required autocomplete = "off" class = "form-control" >' +
                '<span id = "error_m' + id + '" class = "" > </span>' +
                '</div>' +
                '<div class="col-lg-1">' +
                '    <button type="button" class="btn btn-danger btn-xs" onclick="closeST(\'' + id + ' \')">&times;</button>' +
                '</div>' +
                '</div>';
        $.session.set("i", id);
        $("#examsubject").append(sub);
        getSubjectList($.session.get("i"));
        //console.log($.session.get("i"));
    }
    function getSubjectList(id)
    {
        $.post('<?= api_url ?>/?r=CExam', {id: 0, action: 'sublist'}, function (data) {
            console.log(data);
            var json = JSON.parse(data);
            var dp = "<option value=''>---select---</opton>";
            for (var i = 0; i < json.length; i++)
            {
                var m = "<option value='" + json[i]["code"] + "'>" + json[i]["code"] + "</option>";
                dp = dp + m;
            }
            $("#smultiple" + id).html(dp);
            id = parseInt(id) + 1;
            $.session.set("i", id);
        });
    }
    function calQuestion(j) {

        var noq = 0;
        for (var i = 0; i < $.session.get("i"); i++)
        {
            if (!isNaN($("#squestion" + i).val())) {
                noq = noq + parseInt($("#squestion" + i).val());
            }

        }
        $("#noofquestion").val(noq);
    }
</script>
