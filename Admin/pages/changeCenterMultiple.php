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
    </style>
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
                <a href="dashboard.html" class="brand"><i class="icon-leaf">Clean Dashboard</i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">TRY ME!
                                <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="dashboard.html">Dashboard</a>
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
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CHANGE NAV BAR
                                <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="demo-horizontal-nav.html">Horizontal</a>
                                </li>
                                <li>
                                    <a href="demo-horizontal-fixed-nav.html">Horizontal Fixed</a>
                                </li>
                                <li>
                                    <a href="demo-vertical-nav.html">Vertical</a>
                                </li>
                                <li>
                                    <a href="demo-vertical-fixed-nav.html">Vertical Fixed</a>
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
                            <a href="#">
                                <i class="icon-dashboard icon-large"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-calendar icon-large"></i> Schedule
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-map-marker icon-large"></i> Map It
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-tasks icon-large"></i> Widgets
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-cogs icon-large"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-list-alt icon-large"></i> Forms
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-bar-chart icon-large"></i> Charts
                            </a>
                        </li>
                    </ul>
                </div>
            </div>


            <section class="nav-page" pageVTourUrl="guide/tour/form-tour.html" pageVGuideUrl="guide/form-guide.html">
                <div class="container">
                    <div class="row">
                        <div class="span7">
                            <header class="page-header">
                                <h3>My Account<br /><small>Edit My Account Security</small></h3>
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
                <form  class="form-horizontal" action="../Engine/admin_changeStudentCenter.php" method="post">
                    <div class="container">

                        <div class="alert alert-block alert-info">
                            <p>
                                Enter Student Details to Transfer Student
                            </p>
                        </div>
                        <div class="row">
                            <div id="acct-password-row" class="span16">
                                
                            <label>Student CNIC</label>
                            <input type="text" id="stdId" name="stdId" value="" /><br><br>
                            <label>Student Name</label>
                            <input type="text" id="stdName" name="stdName" value="" /><p id="bad-msg" class="text-danger" style="display:none;"><strong >Not Results</strong></p><p id="success-msg" style="display:none;" class="text-success"><strong>CNIC Verified</strong></p><br>
                           
                            <br>
                           
                            </div>
                        </div>
                    </div>
                    <footer id="submit-actions" class="form-actions">
                    <p id="info"></p>
                    <select required class="form-select mb-3" placeholder="Class/Subject Category" type="select" name="subcat" id="subcat"></select><br><br>
                    <select required class="form-select mb-3" placeholder="Select Center" type="select" name="centers" id="centers"></select><br><br>
                    <input class="btn btn-danger" type="submit" value="Submit" />
                    </footer>
        </div>
        </form>
        </section>

    </div>
    </div>

    <footer class="application-footer">
        <div class="container">
            <p>Application Footer</p>
            <div class="disclaimer">
                <p>This is an example disclaimer. All right reserved.</p>
                <p>Copyright © keaplogik 2011-2012</p>
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
      "subcat":selectedValue
    },
    type: "GET",
    async: false,
    cache:false,
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

$("#stdName").keyup(function() {

    //get the selected value
    var selectedValue = this.value;
    var cnic = document.getElementById('stdId').value;
    //make the ajax call
 
    $.ajax({
    url: '../Engine/getStudent.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>",
      "std_cnic":cnic,
      "std_name":selectedValue
    },
    type: "GET",
    async: false,
    cache:false,
    dataType: "json",
    success: function(myJson) {
    try{
        if(myJson[0].student_id==null){
        document.getElementById('success-msg').style.display = 'none';
        document.getElementById('bad-msg').style.display = 'block';
    }else{
        var str = "<h3><strong>Student Information</strong></h3>Student Name : "+myJson[0].student_name;
        str+="<br>Father Name : "+myJson[0].student_father_name;
        str+="<br>Center : "+myJson[0].pins_name;
        str+="<br>Subject : "+myJson[0].cls_name;
       

        document.getElementById('success-msg').style.display = 'block';
      document.getElementById('bad-msg').style.display = 'none';
      document.getElementById('info').innerHTML=str;

    }
    }catch(Exception){
        document.getElementById('success-msg').style.display = 'none';
        document.getElementById('bad-msg').style.display = 'block';
        document.getElementById('info').innerHTML="";
    }
    
     
    },
    error:function(){
        document.getElementById('success-msg').style.display = 'none';
        document.getElementById('bad-msg').style.display = 'block';
        document.getElementById('info').innerHTML="";
    }
    });
});
</script>
</html>