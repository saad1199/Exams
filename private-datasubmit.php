<?php
session_start();
if (!isset($_SESSION['std_rollno'])) {
  header('location:private-registration.php');
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
  <link rel="stylesheet" href="css/style.green.css" id="theme-stylesheet">
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
          <li class="sidebar-item"><a class="sidebar-link" href="edit-private-student.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#real-estate-1"> </use>
              </svg>Edit Profile </a></li>
          <li class="sidebar-item"><a class="sidebar-link" href="private-profile-view.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#user-1"> </use>
              </svg>Print Profile </a></li>
          <li class="sidebar-item"><a class="sidebar-link" href="generate-challan.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#find-1"> </use>
              </svg>Generate Challan </a></li>
          <li class="sidebar-item active"><a class="sidebar-link" href="private-datasubmit.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#find-1"> </use>
              </svg>Submit Application </a></li>
        </ul><span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Manage</span>
        <ul class="list-unstyled py-4">

          <li class="sidebar-item"> <a class="sidebar-link" href="logout.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#security-1"> </use>
              </svg>Logout</a></li>

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
                  <div class="card-header">
                    <div class="card-close">
                    </div>
                    <h3 class="h4 mb-0">Update Student Profile</h3><br>

                    <div class="alert alert-success" id="success-alert" style="display:none"></div>
                    <div class="alert alert-danger" id="danger-alert" style="display:none"></div>
                  </div>
                  <div class="card-body">
                    

                    <section class="forms">
                      <div class="container-fluid">

                      <div id="lock-form" style="display:none;" >
                        <div class="mb-2 w-100 d-flex justify-content-center">
                          <img id="isLocked" class=" shadow-0 img-fluid " width="300" src="img/locked.png"  />
                        </div>
                        <div class="row">
                          <div class="col-lg-12 ms-auto">
                            <h1 class="text-center text-danger">Submission Consent</h1>
                            <p class="text-center text-danger"><strong>You have already submitted data to Federal Directorate of Education Islamabad</strong></p>
                          </div>
                        </div>
                        </div>


                    <form class="form-horizontal" method="post" action="Engine/rs_private_datasubmit.php" enctype="multipart/form-data" id="consent-form">
                          <div class="mb-2 w-100 d-flex justify-content-center">
                            <img class=" shadow-0 img-fluid  " width="200" src="assets/img/gov.png" />
                          </div>
                          <div class="row">
                            <div class="col-lg-12 ms-auto">
                              <h3 class="text-center text-success">Submission Consent</h3>
                              <p class="text-center text-danger"><strong>After submission you will not be able to register / modify any student</strong></p>
                              <p class="text-justify">Before final submission of admission forms Head of institutions / student should make sure that: </p>
<p class="text-justify">1-    Complete record of all students have been checked and is 100% correct </p>
<p class="text-justify">2-    Date of Birth of student is verified by B-Form/ Birth certificate/ any valid certificate issued by the authorized department.  </p>
<p class="text-justify">3-    All students have registered for examinations and no student is pending to enter.</p>
<p class="text-justify">4-    After submission of forms, if found any mistake/ required any change in the data, correction is subject to fine of Rs 500/- per student </p>
<p class="text-justify">5-    After submission of this data, Head of institutions will submit consolidated list of students (can be downloaded from the download tab) along with original challan form to Exams sections, FDE within three days of closing date  </p>
<p class="text-justify">6-     Fee has been faid in National Bank of Pakistan, its receipt verified and ready to upload/ provided to FDE. </p>
                              <br>

                             </div>
                          </div>

                          <div class="row d-flex justify-content-center">
                          <div class="col-sm-9">
                              <label class="col-sm-3 form-label">Bank Branch Name</label>
                            <input class="form-control" type="text" placeholder="Bank Branch Name" name="challan-bank-name" required/><br>
                            <label class="col-sm-3 form-label">Challan Deposit Date</label>
                            <input class="form-control" type="date" placeholder="Bank Branch Name" name="challan-deposit-date" required/><br>
                            <label class="col-sm-3 form-label">Upload Paid Challan Image</label>
                            <input required class="form-control" name="file-input" id="formFile" type="file" accept="image/jpeg"><br>
                          
                          </div>
                            <div class="col-sm-9">
                                <label class="col-sm-3 form-label">Challan Number</label>
                              <input required class="form-control" type="text" name="challan-input" id="name" placeholder="Challan No.">
                              <br>
                              <input class="form-check-input" id="register-agree" name="registerAgree" type="checkbox" required>
                              <label class="form-check-label form-label" for="register-agree">I have checked / reviewed the provided data of student(s)<br> which is correct. I shall be responsible for any wrong entry <br>and will pay with a corrections request.</label>
                            <br><br>
                              <button class="btn btn-danger text-white w-100" name="consent-submit" type="submit">Final Data Submission</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </section>


















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
    url: 'Engine/getPrivateStudentByID.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>",
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function(myJson) {
      
      if(myJson[0].isSubmit=='1'){
        document.getElementById('consent-form').style.display="none";
        document.getElementById('lock-form').style.display="block";
      }else{
        document.getElementById('consent-form').style.display="block";
        document.getElementById('lock-form').style.display="none";
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
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image size should not exceed 300 KB";
    }
    if (status == "BAD_SELECT_IMAGE") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> You need to select IMAGE if updating NAME or CNIC";
    }
    if (status == "ALREADY_EXISTS") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Student Already Exists";
    }
    if (status == "DOB") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> Your Age is not legal for Registration";
    }
    if(status=="INVALID_CHALLAN"){
    document.getElementById("danger-alert").style.display="block";
     document.getElementById("danger-alert").innerHTML="<strong>SORRY !</strong> CHALLAN NUMBER IS INCORRECT";
   }
  }
</script>

</html>