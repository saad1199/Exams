<?php session_start();
if (!isset($_SESSION['session_token']) || !isset($_SESSION['inst_code'])) {
  header('location:main.html');
  exit();
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
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <!-- Tweaks for older IEs-->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<script>
  $(function () {
    $(".preload").fadeOut(2000, function () {
      $(".page").fadeIn(750);
    });
  });
</script>
<style>
  .card {
    border-radius: 15px;
  }

  .alert {
    border-radius: 15px;
  }
</style>


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
              <!-- Toggle Button--><a class="menu-btn active" id="toggle-btn"
                href="#"><span></span><span></span><span></span></a>
            </div>
            <!-- Navbar Menu -->
            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <!-- Search-->
              <li class="nav-item d-flex align-items-center"><a id="search" href="#">
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#find-1"> </use>
                  </svg></a></li>
              <!-- Logout    -->
              <li class="nav-item"><a class="nav-link text-white" href="logout.php"> <span
                    class="d-none d-sm-inline">Logout</span>
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
        <div class="sidebar-header d-flex align-items-center py-4 px-3"><img
            class="avatar shadow-0 img-fluid rounded-circle" src="img/avatar-1.jpg" alt="...">
          <div class="ms-3 title">
            <h1 class="h4 mb-2">Welcome Back</h1>
            <p class="text-sm text-gray-500 fw-light mb-0 lh-1">
              <?php echo 'EMIS Number: ' . $_SESSION['inst_code']; ?>
            </p>
          </div>
        </div>
        <!-- Sidebar Navidation Menus--><span
          class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Main</span>
        <ul class="list-unstyled py-4">
          <li class="sidebar-item active">
            <a class="sidebar-link" href="index.php">
              <i class="fa fa-home" aria-hidden="true" style="margin-right: 8px;"></i> Home
            </a>
          </li>
          <li class="sidebar-item">
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
              <i class="fa fa-user" aria-hidden="true" style="margin-right: 8px;"></i> Profile (Required)
            </a>
          </li>
           <li class="sidebar-item">
    <a class="sidebar-link" href="requirement_form.php">
      <i class="fa fa-cogs" aria-hidden="true" style="margin-right: 8px;"></i>Teachers Data (FDE Only)
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
        <header id="mheader" class="bg-blue shadow-sm px-4 py-3 z-index-20 text-white">
          <div class="container-fluid px-0">
            <h2 class="mb-0 p-1" id="inst-name">Dashboard</h2>
          </div>
        </header>
        <!-- Dashboard Counts Section-->
        <section class="pb-0">
          <div class="container-fluid">

            <div class="alert alert-success" id="success-alert" style="display:none"></div>
            <div class="alert alert-danger" id="danger-alert" style="display:none"></div>
            <div class="alert alert-warning" id="warning-alert" style="display:none"></div>



<div class="col-lg-12">
  <div class="card mb-0">
    <div class="card-body p-0">
      <!-- Item-->
      <div class="p-3 border-bottom border-gray-200">
        <div class="d-flex">
          <div class="col-lg-6">
            <div style="width:100%; text-align:center;">
              <img src="assets/img/security.png" width="250" />
              <br>
              
              <h1 class="text-danger" style="font-size:22px; "><strong>YOUR ACTIVITY IS STRICTLY MONITORED</strong></h1>
            </div>
          </div>
          
          <!-- Second Column -->
          <div class="col-lg-6 ">
            <p style="font-size:18px; margin-top:10px;"><strong>Dear Examination User,</strong> <br>Your activity and every action is now monitored by FDE. For increased security and data integrity. 
          <br> <br>Please update your account information by clicking the button below or click Profile from Menu.<br>
         <br> <a href="admin-profile.php"  class="btn btn-danger mb-3 text-white w-50">Update Profile</a>
          </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



              <br>





              <div class="card mb-0">
                <div class="card-body">
                  <div class="row gx-5 bg-white">
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-6 py-4 border-lg-end border-gray-200">
                      <div class="d-flex align-items-center">
                        <div class="icon flex-shrink-0 bg-violet">
                          <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                            <use xlink:href="#user-1"> </use>
                          </svg>
                        </div>

                        <div class="mx-3">
                          <h6 class="h4 fw-light text-gray-600 mb-3">Registered</h6>
                          <div class="progress" style="height: 4px">
                            <div class="progress-bar bg-violet" role="progressbar" style="width: 100%; height: 4px;"
                              aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="number"><strong class="text-lg" id="reg-students">0</strong></div>
                      </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-6 py-4 border-lg-end border-gray-200">
                      <div class="d-flex align-items-center">
                        <div class="icon flex-shrink-0 bg-red">
                          <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                            <use xlink:href="#survey-1"> </use>
                          </svg>
                        </div>
                        <div class="mx-3">
                          <h6 class="h4 fw-light text-gray-600 mb-3">5th Class</h6>
                          <div class="progress" style="height: 4px">
                            <div class="progress-bar bg-red" role="progressbar" style="width: 100%; height: 4px;"
                              aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="number"><strong class="text-lg" id="reg-5th">0</strong></div>
                      </div>
                    </div>
                    <!-- Item -->
                    <div class="col-xl-4 col-sm-6 py-4 border-lg-end border-gray-200">
                      <div class="d-flex align-items-center">
                        <div class="icon flex-shrink-0 bg-green">
                          <svg class="svg-icon svg-icon-sm svg-icon-heavy">
                            <use xlink:href="#numbers-1"> </use>
                          </svg>
                        </div>
                        <div class="mx-3">
                          <h6 class="h4 fw-light text-gray-600 mb-3">8th Class</h6>
                          <div class="progress" style="height: 4px">
                            <div class="progress-bar bg-green" role="progressbar" style="width: 100%; height: 4px;"
                              aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                          </div>
                        </div>
                        <div class="number"><strong class="text-lg" id="reg-8th">0</strong></div>
                      </div>
                    </div>
                    <!-- Item -->

                  </div>
                </div>
              </div>
              <br>


              <div class="col-lg-12">
                <div class="card mb-0">
                  <div class="card-header position-relative text-white bg-danger blink_me">
                    <div class="card-close">
                    </div>
                    <h3 class="h4 mb-0 "><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;CHALLAN UPDATE</h3>
                  </div>
                  <div class="card-body p-0">
                    <!-- Item-->
                    <div class="p-3 border-bottom border-gray-200">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex"><a class="flex-shrink-0" href="#"><img class="img-fluid rounded-circle"
                              src="img/msg.png" alt="person" width="50"></a>
                          <div class="ms-3">
                            <h5>CHALLAN UPDATES</h5>
                            <p class="mb-0 text-m text-danger-800 lh-2 overflow-x">Dear user! <br> There is no challan
                              for government institutions, and they just need to submit the consolidated list of
                              students in FDE to lock and submit.
                              <br><br>Please note down the challan number on consolidated list before coming to FDE.
                              <br><br>FOR PRIVATE PEIRA REGISTRATION, Generate Challan form and submit fee in NBP
                              Branch, Verify the submitted Challan through Treasurey office near LAL MASJID,
                              <br><br>Submit the consolidated list of students along with verified slip of challan in
                              FDE Examination Section.
                              <!-- <a class="text-success" href="complainStatus.php">here</a>. <br> -->
                              <br><strong class="text-danger"> </strong><br><br>

                            </p>
                            <br><br>
                            <p class="mb-0 text-xs text-gray-600 lh-2"></p><small class="text-gray-600 fw-light">14th
                              DEC 2023 - 12:05 PM</small>
                          </div>
                        </div>
                        <div class="text-right"><img src="img/dev.gif" width="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

             


         
            </div>
        </section>
        <!-- Dashboard Header Section    -->


        <!-- Updates Section                                                -->
        <section>
          <div class="container-fluid">

            <div class="col-lg-12 col-12">
              <div class="card mb-0">
                <div class="card-body">
                  <div class="d-flex align-items-center">
                    <div class="icon flex-shrink-0 bg-danger"><i class="fas fa-chart-area text-white"></i></div>
                    <div class="ms-3"><strong class="text-lg mb-0 d-block lh-1" id="total-amt">0 PKR</strong><small
                        class="text-gray-500 small text-uppercase">Amount (Expected)</small></div>

                  </div>
                  <form class="d-flex justify-content-center" target="_blank"
                    action="Engine/rs_generate_challan_institution.php?token=<?php echo $_SESSION['session_token']; ?>"
                    method="post">

                    <input type="submit" name="gen-challan-submit" class="btn btn-danger mb-3 text-white w-50"
                      value="Generate Challan">
                  </form>
                </div>
              </div>

              <br>

            </div>


            <!-- <div class="col-lg-12">
                <div class="card mb-0">
                  <div class="card-header position-relative text-white bg-danger blink_me">
                    <div class="card-close">
                    </div>
                    <h3 class="h2 mb-0" ><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Important ! </h3>
                  </div>

                  <div class="card-body p-0">
                 Item-->
            <!-- <div class="p-3 border-bottom border-gray-200">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex"><a class="flex-shrink-0" href="#"><img class="img-fluid rounded-circle" src="img/msg.png" alt="person" width="50"></a>
                          <div class="ms-3">
                            <h5>Message</h5><marquee style="background-color:red; color:white; text-style:bold;">Read Information Carefully</marquee>
                             <p class="mb-0 text-m text-danger-800 lh-2 overflow-x">Dear User ! In registration phase, You will be able to download bank challan. It is visible on this page.</a>. <br>
                         <br><strong class="text-danger"> </strong><br>
                            </p>
                            <marquee style="font-size:22px; color:red;   font-weight: bold;" scrollamount="10">IMPORTANT UPDATE</marquee>
                            <p class="mb-0 text-m text-danger-800 lh-2 overflow-x">
                                
                         <br><strong class="text-danger"> </strong><br><br>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>

                  </div> -->
            <!-- </div>  
                  <br> -->
            <!-- Daily Feeds -->





            <div class="col-lg-12">
              <div class="card mb-0">
                <div class="card-header position-relative text-white bg-dark">
                  <div class="card-close">
                  </div>
                  <h3 class="h4 mb-0"><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;About New Updates</h3>
                </div>
                <div class="card-body p-0">
                  <!-- Item-->
                  <div class="p-3 border-bottom border-gray-200">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex"><a class="flex-shrink-0" href="#"><img class="img-fluid rounded-circle"
                            src="img/msg.png" alt="person" width="50"></a>
                        <div class="ms-3">
                          <h5>FDE Headquarter IT (new)</h5>
                          <p class="mb-0 text-m text-danger-800 lh-2 overflow-x">Dear user! <br>Examinations FDE is
                            updated 16th Oct 2023. Your input is valuable to us. Please report us known bugs/errors by
                            clicking <a class="external text-success" href="mailto:saad.ee.dev@gmail.com">here</a>. <br>
                            <br><strong class="text-danger"> </strong><br><br>
                            <!--<br><strong class="text-danger">Developer Release Notes</strong><br><br>-->
                            <!--<marquee><strong class="text-info">Please Note : Image may take upto 24 hrs to show on browser. Kindly refresh the profile page using CTRL + SHIFT + DEL (Chrome)</strong></marquee><br>-->

                            <!--1- Challan No Message BUG FIXED<br>-->
                            <!--2- LATE Registration Module is implemented<br>-->
                            <!--3- Challan UI Updated<br>-->
                            <!--4- Updated Challan Amount with Difference is Implemented<br>-->
                            <!--4- Optimized Loading Content <br>-->
                            <!--5- Optimized Picture Loading<br>-->
                            <!--6- Minor UI Changes<br>-->
                          </p>
                          <br><br>
                          <p class="mb-0 text-xs text-gray-600 lh-2"></p><small class="text-gray-600 fw-light">14th Dec
                            2023 - 12:05 PM</small>
                        </div>
                      </div>
                      <div class="text-right"><img src="img/dev.gif" width="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br>

            <div class="row gy-4">


              <!-- Recent Updates-->
              <!-- <div class="col-lg-6 col-12">
                <div class="card mb-0 h-100">
                  <div class="card-body bg-dark">
                    <div class="container-fluid">
                      <div class="row gy-4">
                        <div class="col-lg-12 col-12">
                          <h1 class="text-white" style="font-size:55px;">Welcome !</h1>
                        </div>
                        <div class="col-lg-12 col-12">
                          <h3 class="text-center text-white" style="font-size:25px;" id="inst-name"></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="col-lg-6">
                <div class="card mb-0">
                  <div class="card-header position-relative text-white bg-dark">
                    <div class="card-close">
                    </div>
                    <h3 class="h4 mb-0"><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Model Papers</h3>
                  </div>
                  <div class="card-body p-2 ">
                    <div class="mb-2 w-100 d-flex justify-content-center">
                      <div class="row d-flex justify-content-center">
                        <div class="col-sm-12">
                          <a targer="blank" href="uploads/MP5.pdf" class="btn btn-primary text-white w-100">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                              <use xlink:href="#document-saved-1"> </use>
                            </svg>Class-V Model Paper</a>
                          <br><br>
                          <a targer="blank" href="uploads/MP8.pdf" class="btn btn-primary text-white w-100"><svg
                              class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                              <use xlink:href="#document-saved-1"> </use>
                            </svg> Class-VIII Model Paper</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>




              <div class="col-lg-6">
                <div class="card mb-0">
                  <div class="card-header position-relative text-white bg-dark">
                    <div class="card-close">
                    </div>
                    <h3 class="h4 mb-0"><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Key Notes</h3>
                  </div>
                  <div class="card-body p-2 ">
                    <div class="mb-2 w-100 d-flex justify-content-center">
                      <div class="row d-flex justify-content-center">
                        <div class="col-sm-12">
                          <br><br>
                          <a target="_blank" href="uploads/KN5.pdf" class="btn btn-primary text-white w-100">
                            <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                              <use xlink:href="#document-saved-1"> </use>
                            </svg>Class-V Key Notes</a>

                          <!--              <a target="_blank" href="uploads/KN5.pdf" class="btn btn-primary text-white w-100"><svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">-->
                          <!--  <use xlink:href="#document-saved-1"> </use>-->
                          <!--</svg> Class-VIII Key Notes</a>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-12 col-12">
                <div class="card-header position-relative text-white bg-dark">
                  <div class="card-close">
                  </div>
                  <h3 class="h4 mb-0"><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Video-Coming Soon-How to use
                    this portal ? [HELP]</h3>
                </div>
                <iframe class="w-100" style="height:500px;" src="https://www.youtube.com/embed/tf9kNIJfvjY">
                </iframe>
              </div>
            </div>
          </div>
        </section>
        <!-- Page Footer-->
        <footer class="position-absolute bottom-0 bg-darkBlue text-white text-center py-3 w-100 text-xs mt-2"
          id="footer">
          <div class="container-fluid">
            <div class="row gy-2">
              <div class="col-sm-6 text-sm-start">
                <p class="mb-0">Federal Directorate of Education Islamabad &copy; 2022</p>
              </div>
              <div class="col-sm-6 text-sm-end">
                <p class="text-white"><a class="external text-white" href="mailto:saad.ee.dev@gmail.com">Designed and
                    Developed in IT Section FDE - Suggestion and Queries may sent to Saad Sadiq (Software Developer IT)
                    via Email</a>

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
      ajax.onload = function (e) {
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
    // injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
    injectSvgSprite('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/sprites/brands.svg');

  </script>
  <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

<script>

  var x = 0;
  $.ajax({
    url: 'Engine/getInstitute.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function (myJson) {
      x = myJson[0].inst_id.length;
      if (myJson[0].inst_id.length == 5) {
        document.getElementById('inst-name').innerHTML = '<img src="img/govw.png" width="40"> PEIRA - ' + myJson[0].inst_name;
      } else {
        document.getElementById('inst-name').innerHTML = '<img src="img/govw.png" width="40"> FDE - ' + myJson[0].inst_name;
      }


      if (myJson[0].isRegistered == '1') {
        document.getElementById('consent-form').style.display = "none";
        document.getElementById('lock-form').style.display = "block";
      } else {
        document.getElementById('consent-form').style.display = "block";
        document.getElementById('lock-form').style.display = "none";
      }

    }
  });
  $.ajax({
    url: 'Engine/getInstituteAmount.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function (myJson) {

      if (myJson[0].total == null) {
        document.getElementById('total-amt').innerHTML = " No Students Registered";
      } else {

        if (x == 5) {
          document.getElementById('total-amt').innerHTML = myJson[0].total + " PKR";
        } else {
          document.getElementById('total-amt').innerHTML = "1000 PKR";
        }
        //document.getElementById('total-amt').innerHTML = myJson[0].total + " PKR";
      }

    }
  });

  $.ajax({
    url: 'Engine/getStudents.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function (myJson) {

      var ecount = 0;
      var fcount = 0;
      var tcount = 0;

      for (var i = 0; i < myJson.length; i++) {
        if (myJson[i].class == "5") {
          fcount++;
        } else if (myJson[i].class == "8") {
          ecount++;
        }
        tcount++;
      }
      document.getElementById('reg-students').innerHTML = tcount;
      document.getElementById('reg-5th').innerHTML = fcount;
      document.getElementById('reg-8th').innerHTML = ecount;
      alert("SECURITY WARNING ! Please update your password, If not updated yet");
    }

  });

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
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Cannot Register Student - Please Report IT Section Immediately";
    }
    if (status == "CONSENT_OK") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>THANK YOU !</strong> Payment Details Updated, Now you can download list";
    }
    if (status == "BAD_IMAGE") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> The Image you are trying to upload is not acceptable, only .jpg or .jpeg is acceptable";
    }
    if (status == "BAD_IMAGE_EXTENSION") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image file format not supported only .jpg or .jpeg is acceptable";
    }
    if (status == "BAD_IMAGE_DIMENSIONS") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image length x width in pixels should be less than 800 x 800, Resize Image pixels";
    }
    if (status == "BAD_IMAGE_SIZE") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>IMAGE ERROR !</strong> Image size should be less than 80 KB";
    }
    if (status == "INVALID_CHALLAN") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> CHALLAN NUMBER IS INCORRECT";
    }
    if (status == "FINAL_ERROR") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>CONSENT ERROR ! YOU NEED TO SUBMIT CONSENT TO GET CONSOLIDATED STUDENT LIST, YOU CAN SUBMIT CONSENT FROM DASHBOARD BY UPLOADING ORIGINAL CHALLAN IMAGE COPY</strong>";
    }

    if (status == "CHALLAN_NOT_SUBMITTED") {
      document.getElementById("warning-alert").style.display = "block";
      document.getElementById("warning-alert").innerHTML = "<strong>CHALLAN ERROR ! YOU NEED TO SUBMIT CHALLAN TO GET ROLL NUMBER SLIPS STUDENT LIST, YOU CAN SUBMIT CONSENT FROM DASHBOARD BY UPLOADING ORIGINAL CHALLAN IMAGE COPY</strong>";
    }
    if (status == " CHALLAN_NOT_GENERATED") {
      document.getElementById("warning-alert").style.display = "block";
      document.getElementById("warning-alert").innerHTML = "<strong>CHALLAN ERROR ! YOU NEED TO GENERATE CHALLAN TO GET CONSOLIDATED STUDENT LIST, YOU CAN GENERATE CHALLAN FROM DASHBOARD SCROLL DOWN TO CHECK GENERATE CHALLAN OPTION</strong>";
    }
    if (status == "PROFILE_UPDATED") {
      document.getElementById("success-alert").style.display = "block";
      document.getElementById("success-alert").innerHTML = "<strong>ACCOUNT UPDATED ! Account information updated, Thanks</strong>";
    }
    if (status == "PROFILE_UPDATE_FAILED") {
      document.getElementById("warning-alert").style.display = "block";
      document.getElementById("warning-alert").innerHTML = "<strong>ACCOUNT ERROR ! Something went wrong, Please Re-login and try again.</strong>";
    }
       if (status == "CHALLAN_NOT_PAID") {
      document.getElementById("warning-alert").style.display = "block";
      document.getElementById("warning-alert").innerHTML = "<strong>CHALLAN ERROR ! Previous Challan not updated by FDE yet contact 051-9262449</strong>";
    }
   if (status == "CHALLAN_BUSY") {
      document.getElementById("warning-alert").style.display = "block";
      document.getElementById("warning-alert").innerHTML = "<strong>CHALLAN SYSTEM IS BUSY ! Please wait for challan Update</strong>";
    }
  }

</script>





</html>