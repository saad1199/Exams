<?php
session_start();
if (!isset($_SESSION['session_token']) || !isset($_SESSION['inst_code'])) {
  header('location:login.html?status=EXPIRED');
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Examinations (FDE)</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
  <!-- Choices CSS-->
  <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
  <!-- theme stylesheet-->
  <link rel="stylesheet" href="css/style.blue.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Include the select2 CSS from CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<!-- Include the select2 JavaScript from CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
 
</head>

<script>
       $(function() {
    $(".preload").fadeOut(2000, function() {
        $(".page").fadeIn(1000);        
    });
});
</script>


<body>
   
 <div class="preload">
            <img src="img/loading.gif">
            </div>

  <div class="page">
    <!-- Main Navbar-->
    <header class="header z-index-50">
      <nav class="navbar py-3 px-0 shadow-sm text-white position-relative">
        <!-- Search Box-->
        <div class="search-box shadow-sm">
          <button class="dismiss d-flex align-items-center">
            <svg class="svg-icon svg-icon-heavy">
              <use xlink:href="#close-1"> </use>
            </svg>
          </button>
          <form id="searchForm" action="#" role="search">
            <input class="form-control shadow-0" type="text" placeholder="What are you looking for...">
          </form>
        </div>
        <div class="container-fluid w-100">
          <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
            <!-- Navbar Header-->
            <div class="navbar-header">
              <!-- Navbar Brand --><a class="navbar-brand d-none d-sm-inline-block" href="index.php">
                <div class="brand-text d-none d-lg-inline-block"><span>Examinations</span><strong>Federal</strong></div>
                <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>EF</strong></div>
              </a>
              <!-- Toggle Button--><a class="menu-btn active" id="toggle-btn" href="#"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Search-->
              <li class="nav-item d-flex align-items-center"><a id="search" href="#">
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#find-1"> </use>
                  </svg></a></li>
              <!-- Logout    -->
              <li class="nav-item"><a class="nav-link text-white" href="logout.php"> <span class="d-none d-sm-inline">Logout</span>
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#security-1"> </use>
                  </svg></a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar z-index-40">
        <!-- Sidebar Header-->
        <div class="sidebar-header d-flex align-items-center py-4 px-3"><img class="avatar shadow-0 img-fluid rounded-circle" src="img/avatar-1.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h4 mb-2">Welcome Back</h1>
            <p class="text-sm text-gray-500 fw-light mb-0 lh-1"><?php echo 'EMIS Number: '.$_SESSION['inst_code']; ?></p>
         
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Main</span>
        <ul class="list-unstyled py-4">
  <li class="sidebar-item">
    <a class="sidebar-link" href="index.php">
      <i class="fa fa-home" aria-hidden="true" style="margin-right: 8px;"></i> Home
    </a>
  </li>
  <li class="sidebar-item active">
    <a class="sidebar-link" href="registration.php">
      <i class="fa fa-user-plus" aria-hidden="true" style="margin-right: 8px;"></i> Registrations
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="search.php">
      <i class="fa fa-search" aria-hidden="true" style="margin-right: 8px;"></i> Students List
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="consolidatedList.php">
      <i class="fa fa-file" aria-hidden="true" style="margin-right: 8px;"></i> Consolidated List
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="downloads.php">
      <i class="fa fa-download" aria-hidden="true" style="margin-right: 8px;"></i> Roll Number Slips
    </a>
  </li>
</ul>
<span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Manage</span>
<ul class="list-unstyled py-4">
  <li class="sidebar-item">
    <a class="sidebar-link" href="admin-profile.php">
      <i class="fa fa-user" aria-hidden="true" style="margin-right: 8px;"></i> Profile
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="complainStatus.php">
      <i class="fa fa-exclamation-circle" aria-hidden="true" style="margin-right: 8px;"></i> Complaint Management
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="requests.php">
      <i class="fa fa-check" aria-hidden="true" style="margin-right: 8px;"></i> Check Requests Status
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="changepassword.php">
      <i class="fa fa-cogs" aria-hidden="true" style="margin-right: 8px;"></i> Change Password
    </a>
  </li>
  <li class="sidebar-item">
    <a class="sidebar-link" href="logout.php">
      <i class="fa fa-sign-out" aria-hidden="true" style="margin-right: 8px;"></i> Logout
    </a>
  </li>
</ul>

      </nav>



      <div class="content-inner w-100" style="background-image:url('assets/img/curved-images/white-curved.jpg');">
        <!-- Page Header-->
        <header class="bg-blue text-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">

            <h2 class="mb-0 p-1">Registration</h2>
          </div>
        </header>
        <!-- Dashboard Counts Section-->
        <section class="forms">
          <div class="container-fluid">
            <div class="row">

              <!-- Form Elements -->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header bg-dark text-white">
                    <div class="card-close">

                    </div>
                    <h3 class="h4 mb-0"> <img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Register Student for Examination</h3><br>
                    <div class="alert alert-success" id="success-alert" style="display:none"></div>
                    <div class="alert alert-danger" id="danger-alert" style="display:none"></div>
                  </div>
                  <div class="card-body">
                  <h2 class="h2 mb-0"> <img src="img/govw.png" width="40">1. Student Profile Information</h2><br>
                   
                    <form class="form-horizontal" method="post" action="Engine/rs_register.php" enctype="multipart/form-data">
                      <div class="row">
                        <label class="col-sm-3 form-label">Student Name</label>
                        <div class="col-sm-9">
                          <input required class="form-control" type="text" name="name" id="name">
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Father Name</label>
                        <div class="col-sm-9">
                          <input required class="form-control" type="text" name="fname" id="fname">
                        </div>

                        <br><br>
                        <label class="col-sm-3 form-label">CNIC / B. Form Number</label>
                        <div class="col-sm-9">
                            <label class="text-info"> Incase if student CNIC/B-Form is not available use Father/Guardian CNIC<br></label>
                                  <br>
                          <input required class="form-control" placeholder="1234512345671" type="text" name="cnic" id="cnic" maxlength="13"  pattern="[0-9]{13}">
                        </div>

                        <br><br><br><br><br>
                        
                        <label class="col-sm-3 form-label">Student Date of Birth (System Date Format)</label>
                        <div class="col-sm-9">
              
                                <input class="form-control" type="date" name="dob" id="dob" required pattern="\d{2}/\d{2}/\d{4}">

                        </div>
                        <div class="border-bottom my-5 border-gray-200"></div>
                        <label class="col-sm-3 form-label">Student Gender</label>
                        <div class="col-sm-9">
                          <select  class="form-select mb-3" name="gender" id="gender" required="required">
                          </select>
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Student Religion</label>
                        <div class="col-sm-9">
                          <select  class="form-select mb-3" name="religion" id="religion" required="required">

                          </select>
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Email</label>
                        <div class="col-sm-9">
                            <label class="text-info"> Valid email addresses of parents of students / class teachers/ institute should be mentioned<br></label><br>
                          <input required class="form-control" type="email" name="email" id="email">
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Contact Number</label>
                        <div class="col-sm-9">
                                     <label class="text-info"> Contact number format should  be +923XXXXXXXXX<br></label><br>
                          <div class="input-group mb-3"><span class="input-group-text">+92</span>
                             
                            <input placeholder="3XX1234567. please follow the mentioned pattern" required class="form-control" pattern="[0-9]{10}" type="text" aria-label="Pakistani Mobile Number" name="contact" id="contact">
                          </div>
                        </div>


                        <br><br>
                        <label class="col-sm-3 form-label">Residential Address</label>
                        <div class="col-sm-9">
                          <input required class="form-control" type="text" name="address" id="address">
                        </div>
                      </div>


                      <div class="border-bottom my-5 border-gray-200"></div>
                  
                      <h2 class="h2 mb-0"> <img src="img/govw.png" width="40">2. Student Academics</h2><br>
                      <!-- <label class="text-danger blink_me"><strong>WARNING ! </strong>You can't change Subjects Category once selected. Select Subject Category in order to load Centers, You can't change the examination center once selected</label><br><br>
                         -->
                      <div class="row">
                        <label class="col-sm-3 form-label">Select Subject Category</label>
                        <div class="col-sm-9">
                        <p class="text-danger">Please select class / subject category to load centers list.</p>
                        
                          <select required class="form-select mb-3" name="subcat" id="subcat">

                          </select>
                          </div>

                        <label class="col-sm-3 form-label">Select Examinations Center (available institutions)</label>
<div class="col-sm-9">
  
  <select required class="form-control form-select mb-3" name="centers" id="centers" style="width:100%;">
   
  </select><br>
  

</div><br><br><br>

                        <label class="col-sm-3 form-label">Select Fee Type</label>
                        <div class="col-sm-9">
                          <select required class="form-select mb-3" name="fee-type" id="fee-type">

                          </select>
                        </div>


                      
                        <br><br>
                        <label class="col-sm-3 form-label" for="formFile">Choose Profile Picture (jpg, png, jpeg only)</label>
                        <div class="col-sm-9">
                                        <label class="text-info"> Picture dimensions of student should be less than 800 x 800 pixels and size less than 500 KB<br></label><br>
                          <input required class="form-control" name="file-input" id="formFile" type="file" accept="image/*">
                        </div>


                      </div>

                      <div class="border-bottom my-5 border-gray-200"></div>
                      <div class="row">
                          <label class="text-danger blink_me"><strong>Alert ! </strong>After click on Register button, Succeassful Registration or error message will be displayed at the top of screen<br></label><br><br><br>
                        <div class="col-lg-12 ms-auto">
                          <h3 class="text-center">Principal Consent</h3>
                          <p class="text-center text-gray-600">I hereby solemnly declare that the provided information is reviewed and found 100% correct</p>
                          <button class="btn btn-primary text-white w-100" type="submit" name="reg-std-submit">Register</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Page Footer-->
        <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs" id="footer">
          <div class="container-fluid">
            <div class="row gy-2">
              <div class="col-sm-6 text-sm-start">
                <p class="mb-0">Federal Directorate of Education Islamabad &copy; 2022</p>
              </div>
              <div class="col-sm-6 text-sm-end">

                <p class="text-white"><a class="external text-white" href="mailto:saad.ee.dev@gmail.com">Designed and Developed in IT Section FDE - Suggestion and Queries may sent to Saad Sadiq (Software Developer IT) via Email</a></p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/chart.js/Chart.min.js"></script>

  <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="js/charts-home.js"></script>
  <!-- Main File-->
  <script src="js/front.js"></script>
  <script>

    function injectSvgSprite(path) {

      var ajax = new XMLHttpRequest();
      ajax.open("GET", path, true);
      ajax.send();
      ajax.onload = function(e) {
        var div = document.createElement("div");
        div.className = 'd-none';
        div.innerHTML = ajax.responseText;
        document.body.insertBefore(div, document.body.childNodes[0]);
      }
    }

    injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
  </script>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>
<script>
  $.ajax({
    url: 'Engine/getGenders.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    cache:false,
    success: function(myJson) {

      var tex = '<option disabled selected value="">Select Gender</option>';
      for (var i = 0; i < myJson.length; i++) {
        tex += '<option value="' + myJson[i].gender_id + '">' + myJson[i].gender_det + '</option>';
      }

      document.getElementById('gender').innerHTML = tex;
    }
  });


  $.ajax({
    url: 'Engine/getReligion.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    cache:false,
    dataType: "json",
    success: function(myJson) {

      var tex = '<option disabled selected value="">Select Religion</option>';
      for (var i = 0; i < myJson.length; i++) {
        tex += '<option value="' + myJson[i].religion_id + '">' + myJson[i].religion_det + '</option>';
      }

      document.getElementById('religion').innerHTML = tex;
    }
  });


  $.ajax({
    url: 'Engine/getSubjectCategory.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    cache:false,
    dataType: "json",
    success: function(myJson) {

      var tex = '<option disabled selected value="">Select Class / Subject</option>';
      for (var i = 0; i < myJson.length; i++) {
        tex += '<option value="' + myJson[i].sub_cat_id + '">' + myJson[i].cls_name + '</option>';
      }

      document.getElementById('subcat').innerHTML = tex;
    }
  });


 

  $.ajax({
    url: 'Engine/getFeeType.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    cache:false,
    dataType: "json",
    success: function(myJson) {

      var tex = '<option disabled selected value="">Select Fee Type</option>';
      for (var i = 0; i < myJson.length; i++) {
        tex += '<option value="' + myJson[i].fee_type_id + '">' + myJson[i].fee_type_det + '</option>';
      }

      document.getElementById('fee-type').innerHTML = tex;
    }
  });



 
$("#subcat").change(function() {
    //get the selected value
    var selectedValue = this.value;
    //make the ajax call
    $.ajax({
    url: 'Engine/getCentersByClass.php',
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

  $(document).ready(function() {
    $('#centers').select2();
  });

</script>
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

  var status = getUrlParameter('status');
  if (status) {
    if (status == "BAD") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Cannot Register Student Something went wrong LOG REPORTED- Please Report IT Section Immediately";
    }
    if (status == "REGISTERED") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>SUCCESS !</strong> Student has Successfully Registered";
    }
    if (status == "ALREADY_EXISTS") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Student Already Exists - If you think this is not correct ! Report us ";

    }
    if (status == "BAD_IMAGE") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> The Image you are trying to upload is not acceptable";
    }
    if (status == "BAD_IMAGE_EXTENSION") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image file format not supported only .jpg or .jpeg is acceptable";
    }
    if (status == "BAD_IMAGE_DIMENSIONS") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image dimension should be less than 800 x 800 ";
    }
    if (status == "BAD_IMAGE_SIZE") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image size should not exceed 500 KB";
    }
    if (status == "LOCK") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>REGISTRATION CLOSED !</strong> SORRY THE REGISTRATION HAS BEEN CLOSED";
    }
    if (status == "DOB") {
    document.getElementById("danger-alert").style.display = "block";
    document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> Your Age is not legal for Registration";
    }
     if (status == "RETRY") {
    document.getElementById("danger-alert").style.display = "block";
    document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> Can't Add Student at this time. But Changes has been reverted TRY ADDING STUDENT AGAIN RE-LOGIN and ADD EACH INFORMATION CAREFULLY ";
    }
     if (status == "NA") {
    document.getElementById("danger-alert").style.display = "block";
    document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> Can't Add Student to selected center. But Changes has been reverted TRY ADDING STUDENT AGAIN RE-LOGIN and ADD EACH INFORMATION CAREFULLY ";
    }
  }
</script>

</html>