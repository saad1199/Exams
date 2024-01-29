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
  
    <meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />


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
  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
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
            <p class="text-sm text-gray-500 fw-light mb-0 lh-1"><?php echo "Admin"; ?></p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Main</span>
        <ul class="list-unstyled py-4">
          <li class="sidebar-item">
            <a class="sidebar-link" href="index.php">
              <i class="fa fa-home" aria-hidden="true" style="margin-right: 8px;"></i> Home
            </a>
          </li>
          <li class="sidebar-item">
            <a class="sidebar-link" href="registration.php">
              <i class="fa fa-user-plus" aria-hidden="true" style="margin-right: 8px;"></i> Registrations
            </a>
          </li>
          <li class="sidebar-item active">
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
              <i class="fa fa-exclamation-circle" aria-hidden="true" style="margin-right: 8px;"></i> Complaint
              Management
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
        <header class="bg-white shadow-sm px-4 py-3 z-index-20">
          <div class="container-fluid px-0">
            <h2 class="mb-0 p-1">Edit Profile</h2>
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
                    <h3 class="h4 mb-0"><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Update Student Profile</h3><br>
                    <div class="alert alert-success" id="success-alert" style="display:none"></div>
                    <div class="alert alert-danger" id="danger-alert" style="display:none"></div>
                  </div>
                  <div class="card-body">

                    <div class="mb-2 w-100 d-flex justify-content-center">
                      <img class=" shadow-0 img-fluid " width="200"  id="dp" />
                    </div>
                    <form class="form-horizontal" method="post" action="Engine/rs_update_student.php?sid=<?php echo $_GET['sid'] ?>" enctype="multipart/form-data">
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
                        <input required class="form-control" placeholder="1234512345671" type="text" name="cnic" id="cnic" maxlength="13"  pattern="[0-9]{13}">
                    
                      </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Student Date of Birth (System Date Format)</label>
                        <div class="col-sm-9">
                        <input class="form-control" type="date" name="dob" id="dob" required pattern="\d{2}/\d{2}/\d{4}">

                        </div>
                        <div class="border-bottom my-5 border-gray-200"></div>
                        <label class="col-sm-3 form-label">Student Gender</label>
                        <div class="col-sm-9">
                          <select required class="form-select mb-3" name="gender" id="gender">
                          </select>
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Student Religion</label>
                        <div class="col-sm-9">
                          <select required class="form-select mb-3" name="religion" id="religion">

                          </select>
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Email</label>
                        <div class="col-sm-9">
                          <input required class="form-control" type="email" name="email" id="email">
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Contact Number</label>
                        <div class="col-sm-9">
                          <div class="input-group mb-3"><span class="input-group-text">+92</span>
                            <input placeholder="3XX1234567" required class="form-control"  type="text" aria-label="Pakistani Mobile Number" name="contact" id="contact">
                          </div>
                        </div>
                        <br><br>
                        <label class="col-sm-3 form-label">Address</label>
                        <div class="col-sm-9">
                          <input required class="form-control" type="text" name="address" id="address">
                        </div>
                      </div>


                      <div class="border-bottom my-5 border-gray-200"></div>
                      <div class="row">



                   

                       
                        <br><br>
                        <label class="col-sm-3 form-label" for="formFile">Choose Profile Picture (.jpg only)</label>
                        <div class="col-sm-9">
                          <input class="form-control" name="file-input" id="formFile" type="file" accept="image/*">
                        </div>


                      </div>

                      <div class="border-bottom my-5 border-gray-200"></div>
                      <div class="row">
                        <div class="col-lg-12 ms-auto">
                          <h3 class="text-center">Principal Consent</h3>
                          <p class="text-center text-gray-600">I hereby solemnly declare that I am updating information correctly and accurately. </p>
                          <button class="btn btn-primary text-white w-100" name="edit-ins-submit" type="submit">Update</button>
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
  <script src="vendor/just-validate/js/just-validate.min.js"></script>
  <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
  <script src="js/charts-home.js"></script>
  <!-- Main File-->
  <script src="js/front.js"></script>
  <script>
    // ------------------------------------------------------- //
    //   Inject SVG Sprite - 
    //   see more here 
    //   https://css-tricks.com/ajaxing-svg-sprite/
    // ------------------------------------------------------ //
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
    // this is set to BootstrapTemple website as you cannot 
    // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
    // while using file:// protocol
    // pls don't forget to change to your domain :)
    injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
  </script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
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
    dataType: "json",
    success: function(myJson) {

      var tex = '<option disabled selected value="">Select Religion</option>';
      for (var i = 0; i < myJson.length; i++) {
        tex += '<option value="' + myJson[i].religion_id + '">' + myJson[i].religion_det + '</option>';
      }

      document.getElementById('religion').innerHTML = tex;
    }
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

  $.ajax({
    url: 'Engine/getStudentByID.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>",
      "sid": <?php echo $_GET['sid']; ?>
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function(myJson) {

      try {
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
       
        document.getElementById('dp').src = "uploads-new/"+myJson[0].student_institute_inst_id+"/"+ myJson[0].student_img;
        document.getElementById('dp').onerror = function() { 
    
    alert("No Picture");
  }
        
        
        
        
        
        
      } catch (err) {
        document.getElementById("danger-alert").style.display = "block";
        document.getElementById("danger-alert").innerHTML = '<strong><svg class="svg-icon svg-icon-xs svg-icon-heavy"><use xlink:href="#security-1"> </use></svg>SECURITY ERROR ! </strong>Unauthorized Access';
      }
    }
  });

  var status = getUrlParameter('status');
  if (status) {
    if (status == "BAD") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Cannot Update Student - Please Report IT Section Immediately";
    }
    if (status == "UPDATED") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>SUCCESS !</strong> Successfully Updated Profile";
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
    if (status == "BAD_SELECT_IMAGE") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> You need to select IMAGE if updating NAME or CNIC";
    }
    if (status == "ALREADY_EXISTS") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Student Already Exists";
    }
    if (status == "LOCK") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> YOU HAVE SUBMITTED DATA AND EDITING / REGISTRATION IS LOCKED";
    }
    if (status == "DOB") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> Your Age is not legal for Registration";
    }
  }
</script>

</html>