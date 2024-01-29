<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Simple Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="layout" content="main" />

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script src="../js/jquery/jquery-1.8.2.min.js" type="text/javascript"></script>
    <link href="../css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <style>
        #collapse1 {
            overflow-y: scroll;
            overflow-x: scroll;
            height: 200px;
        }
    </style>


    <script>

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

    </script>

</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="dashboard.html" class="brand">Federal Directorate ISB</i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">

                        <li class="dropdown">

                            <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="dashboard.php">Dashboard</a>
                                </li>
                                <li>
                                    <a href="form.html">Form</a>
                                </li>
                                <li>
                                    <a href="custom-view.html">Custom View</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                    <ul class="nav pull-right">
                        <li>
                            <a href="login.html">Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="body-container">
        <div id="body-content">

            <div class="body-nav body-nav-horizontal body-nav-fixed">
                <div class="container">
                <ul>
                                
                                <li>
                                    <a href="dashboard.php">
                                        <i class="icon-dashboard icon-large"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="centersSummary.php">
                                        <i class="icon-list-alt icon-large"></i> Center Report
                                    </a>
                                </li>
                                <li>
                                    <a href="allocatedCenterDetails.php">
                                        <i class="icon-list-alt icon-large"></i> Center Details
                                    </a>
                                </li>
                                <li>
                                    <a href="centerDetails.php">
                                        <i class="icon-list-alt icon-large"></i> Institute Report
                                    </a>
                                </li>
                                <li>
                                    <a href="editStudent.php">
                                        <i class="icon-search icon-large"></i> Search / Edit
                                    </a>
                                </li>
                                <li>
                                    <a href="challanUpdate.php">
                                        <i class="icon-cloud icon-large"></i> Challan Entry
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-cogs icon-large"></i> Settings
                                    </a>
                                </li>
                            </ul>
                </div>
            </div>


            <section class="nav-page" pageVTourUrl="" pageVGuideUrl="">
                <div class="container">
                    <div class="row">
                        <div class="span7">
                            <header class="page-header">
                                <h3>Examinations 2023<br /><small>Edit Student Details</small></h3>
                            </header>
                        </div>
                        <div class="span9">
                            <ul class="nav nav-pills">
                                <li>
                                    <button id="vtour-button" rel="tooltip" title="Launch Virtual Tour" data-placement="bottom">
                                        <i class="icon-magic icon-large"></i>
                                    </button>
                                </li>
                                <li>
                                    <button id="vguide-button" rel="tooltip" title="Launch Guide" data-placement="bottom">
                                        <i class="icon-question-sign icon-large"></i>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>




            <section id="my-account-security-form" class="page container">

                <div class="alert alert-block alert-info">
                    <p>
                        Enter Student Details Edit
                    </p>
                </div>



                <div class="span12">
                    <div class="box" style="display:block;">

                        <div class="box-header">
                            <i class="icon-user icon-large"></i>
                            <h5>Search (Name/ CNIC/ Father Name/ Roll Number) </h5>
                        </div>
                        <div class="box-content">
                            <input id="uni-search-text" type="text" placeholder="Search Student"><br><button class="btn btn-info" onclick="universalSearch()">Search</button>
                        </div>
                    </div>



                    <div id="" class="box">
                        <div class="box-header">
                            <i class="icon-user icon-large"></i>
                            <h5 id="table-header">Registered Student Details</h5>

                        </div>

                        <div class="box-content box-table">

                            <div id="collapse1" class="panel-collapse collapse">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>CNIC</th>
                                            <th>Roll No</th>
                                            <th>Class</th>
                                            <th>DOB</th>
                                            <th>Gender</th>
                                            <th>Contact</th>
                                            <th>Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody id="table-body" style=" height: 700px; overflow:scroll">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="span12">

                    <div class="box" style="display:block;">

                        <div class="box-header">
                            <i class="icon-user icon-large"></i>
                            <h5>Update Student Details </h5>
                        </div>


                        <div class="box-content">

                            <form class="form-horizontal" id="x_form" method="post" action="" enctype="multipart/form-data">



                                <div id="acct-password-row" class="span16">
                                    <p id="bad-msg" class="text-danger" style="display:none;"><strong>Not Results</strong></p>
                                    <p id="success-msg" style="display:none;" class="text-success"><strong>CNIC Verified</strong></p>
                                    
                                </div>



                                <div class="mb-2 w-100 d-flex justify-content-center">
                                    <img class=" shadow-0 img-fluid " width="200" id="dp" /><br><br>
                                </div>

                                <label class="">Student Name</label>
                                <div class="col-sm-9">
                                    <input required class="form-control" type="text" name="name" id="name">
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Father Name</label>
                                <div class="col-sm-9">
                                    <input required class="form-control w-100" style="width:70%;" type="text" name="fname" id="fname">
                                </div>

                                <br><br>
                                <label class="col-sm-3 form-label">CNIC / B. Form Number</label>
                                <div class="col-sm-9">
                                    <input required class="form-control" style="width:70%;" placeholder="1234512345671" type="text" name="cnic" id="cnic" pattern="^[0-9+]{13}$">
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Student Date of Birth</label>
                                <div class="col-sm-9">
                                    <input required class="form-control" style="width:70%;" type="date" name="dob" id="dob">
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Student Gender</label>
                                <div class="col-sm-9">
                                    <select required class="form-select mb-3" style="width:70%;" name="gender" id="gender">
                                    </select>
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Student Religion</label>
                                <div class="col-sm-9">
                                    <select required class="form-select mb-3" style="width:70%;" name="religion" id="religion">

                                    </select>
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Email</label>
                                <div class="col-sm-9">
                                    <input required class="form-control" style="width:70%;" type="email" name="email" id="email">
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Contact Number</label>
                                <div class="col-sm-9">
                                    <div class="input-group mb-3"><span class="input-group-text">+92</span>
                                        <input placeholder="3XX1234567" style="width:65%;" required class="form-control" pattern="3[0-9]{2}(?!1234567)(?!1111111)(?!7654321)[0-9]{7}" type="text" aria-label="Pakistani Mobile Number" name="contact" id="contact">
                                    </div>
                                </div>
                                <br><br>
                                <label class="col-sm-3 form-label">Address</label>
                                <div class="col-sm-9">
                                    <input required class="form-control" style="width:70%;" type="text" name="address" id="address">
                                </div>



                                <div class="border-bottom my-5 border-gray-200"></div>


                                <br><br>
                                <label class="col-sm-3 form-label" for="formFile">Choose Profile Picture (.jpg only)</label>
                                <div class="col-sm-9">
                                    <input class="btn btn-danger" name="file-input" id="formFile" type="file" accept="image/jpeg">
                                </div>




                                <div class="border-bottom my-5 border-gray-200"></div>
                                <br><br>

                                <div class="col-lg-12 ms-auto">

                                    <input class="btn btn-primary text-white w-100" style="width:100%;" name="edit-ins-submit" type="submit" value="Update">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>



                <br>
                <br>
                <br>
                <div class="span12">



                    <div class="box" style="display:block;">

                        <div class="box-header">
                            <i class="icon-user icon-large"></i>
                            <h5>Change Selected Student Class/Center</h5>
                        </div>


                        <div class="box-content">

                            <form id="transferForm" class="form-horizontal" action="" method="post">
                               
                                <p id="info"></p>
                                <select required class="form-select mb-3" placeholder="Class/Subject Category" type="select" name="subcat" id="subcat"></select><br><br>
                                <select required class="form-select mb-3" placeholder="Select Center" type="select" name="centers" id="centers"></select><br><br>
                                <input class="btn btn-primary" style="width:100%;" type="submit" value="Submit" />
                            </form>


                        </div>
                    </div>








                </div>
        </div>


        </footer>



    </div>
    </form>
    </section>

    </div>
    </div>

    <footer class="application-footer">
        <div class="container">
            <p>Federal Directorate of Education G-9/4 Islamabad</p>
            <div class="disclaimer">
                <p>Software designed by Saad Sadiq Asst. Programmer FDE, IT Section,  All right reserved.</p>
                <p>Copyright ©  2022-2023</p>
            </div>
        </div>
    </footer>
    <script src="../js/bootstrap/bootstrap-transition.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-alert.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-modal.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-dropdown.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-scrollspy.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-tab.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-tooltip.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-popover.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-button.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-collapse.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-carousel.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-affix.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../js/jquery/jquery-tablesorter.js" type="text/javascript"></script>
    <script src="../js/jquery/jquery-chosen.js" type="text/javascript"></script>
    <script src="../js/jquery/virtual-tour.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(function() {
            $('.chosen').chosen();
            $("[rel=tooltip]").tooltip();

            $("#vguide-button").click(function(e) {
                new VTour(null, $('.nav-page')).tourGuide();
                e.preventDefault();
            });
            $("#vtour-button").click(function(e) {
                new VTour(null, $('.nav-page')).tour();
                e.preventDefault();
            });
        });
    </script>

</body>
<script>
    function executeEdit(x) {
        $.ajax({
            url: '../Engine/getStudentByID.php',
            data: {
                "token": "<?php echo $_SESSION['session_token']; ?>",
                "stdID": x.name,
            },
            type: "GET",
            async: false,
            cache: false,
            dataType: "json",
            success: function(myJson) {
                try {
                    if (myJson[0].student_id == null) {
                        document.getElementById('success-msg').style.display = 'none';
                        document.getElementById('bad-msg').style.display = 'block';


                    } else {


                        document.getElementById('x_form').action = "../Engine/admin_update_student.php?sid=" + myJson[0].student_id;
                        document.getElementById('name').value = myJson[0].student_name;
                        document.getElementById('fname').value = myJson[0].student_father_name;
                        document.getElementById('gender').value = +myJson[0].gender_id;
                        document.getElementById('cnic').value = myJson[0].student_b_form;
                        document.getElementById('dob').value = myJson[0].student_date_of_birth;
                        document.getElementById('religion').value = myJson[0].religion_id;
                        document.getElementById('email').value = myJson[0].student_email;
                        document.getElementById('address').value = myJson[0].student_address;
                        document.getElementById('contact').value = myJson[0].student_contact_number;
                        // document.getElementById('student-type').value = myJson[0].std_type_id;
                        document.getElementById('transferForm').action = "../Engine/admin_changeStudentCenterExp.php?stdID=" + myJson[0].student_id;
                        
                        var ppInstFolder = '';
                        if(myJson[0].student_institute_inst_id==null){
                            ppInstFolder='000';
                        
                        }else{
                           ppInstFolder=myJson[0].student_institute_inst_id;
                        }
                        document.getElementById('dp').src = "../../uploads-new/" + ppInstFolder + "/" + myJson[0].student_img;

                        var str = "";
                        str += "<br><strong>Center : </strong>" + myJson[0].pins_name;
                        str += "<br><strong>Subject : </strong>" + myJson[0].cls_name;
                        document.getElementById('info').innerHTML = str;

                        document.getElementById('dp').onerror = function() {
                            alert("No Picture");
                        }

                        document.getElementById('success-msg').style.display = 'block';
                        document.getElementById('bad-msg').style.display = 'none';

                    }
                } catch (Exception) {
                    document.getElementById('success-msg').style.display = 'none';
                    document.getElementById('bad-msg').style.display = 'block';

                }
            },
            error: function() {
                document.getElementById('success-msg').style.display = 'none';
                document.getElementById('bad-msg').style.display = 'block';

            }
        });

    }

    $.ajax({
        url: '../Engine/getSubjectCategory.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function(myJson) {

            var tex = '<option disabled selected value="">Select Class / Subject</option>';
            for (var i = 0; i < myJson.length; i++) {
                tex += '<option value="' + myJson[i].sub_cat_id + '">' + myJson[i].cls_name + '</option>';
            }
            document.getElementById('subcat').innerHTML = tex;
        }
    });





    $("#subcat").change(function() {
        //get the selected value
        var selectedValue = this.value;
        //make the ajax call
        $.ajax({
            url: '../Engine/getCentersByClass.php',
            data: {
                "token": "<?php echo $_SESSION['session_token']; ?>",
                "subcat": selectedValue
            },
            type: "GET",
            async: false,
            cache: false,
            dataType: "json",
            success: function(myJson) {
                var tex = '<option disabled selected value="">Select Center</option>';
                for (var i = 0; i < myJson.length; i++) {
                    tex += '<option value="' + myJson[i].pins_id + '">' + myJson[i].pins_name + '</option>';
                }
                document.getElementById('centers').innerHTML = tex;
            }
        });
    });


    $.ajax({
        url: '../Engine/getGenders.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function(myJson) {

            var tex = '<option disabled selected value="">Select Gender</option>';
            for (var i = 0; i < myJson.length; i++) {
                tex += '<option value="' + myJson[i].gender_id + '">' + myJson[i].gender_det + '</option>';
            }

            document.getElementById('gender').innerHTML = tex;
        }
    });


    $.ajax({
        url: '../Engine/getReligion.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function(myJson) {

            var tex = '<option disabled selected value="">Select Religion</option>';
            for (var i = 0; i < myJson.length; i++) {
                tex += '<option value="' + myJson[i].religion_id + '">' + myJson[i].religion_det + '</option>';
            }

            document.getElementById('religion').innerHTML = tex;
        }
    });



    function universalSearch() {
        var toSearch = document.getElementById('uni-search-text').value;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '../Engine/admin_universalSearch.php?token=<?php echo $_SESSION['session_token']; ?>&tosearch=' + toSearch);
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.send();
        xhr.onload = function() {
            if (xhr.status === 200) {
                myJson = xhr.response;
                myJson = JSON.parse(myJson);


                var code = "";
                for (var i = 0; i < myJson.length; i++) {

                    if (myJson[i].reg_roll_no != null) {

                        code += '<tr>';
                        code += '<td>' + (i + 1) + '</td>';
                        code += '<td>' + myJson[i].student_name + '</td>';
                        code += '<td>' + myJson[i].student_b_form + '</td>';
                        code += '<td>' + myJson[i].reg_roll_no + '</td>';
                        code += '<td>' + myJson[i].cls_name + '</td>';
                        code += '<td>' + myJson[i].student_date_of_birth + '</td>';
                        code += '<td>' + myJson[i].gender_det + '</td>';
                        code += '<td>0' + myJson[i].student_contact_number + '</td>';
                        code += '<td><button onclick="executeEdit(this)" id="editNow" name = "' + myJson[i].student_id + '"  class="btn btn-info">View</button></td>';
                        code += '</tr>';
                    }

                }

                document.getElementById('table-body').innerHTML = code;

            }
        }

    }
    var sid = getUrlParameter('cnic');
  if (sid) {
    document.getElementById('uni-search-text').value=sid;
    universalSearch();
  }

</script>

</html>