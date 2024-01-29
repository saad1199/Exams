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
      <i class="fa fa-user" aria-hidden="true" style="margin-right: 8px;"></i> Profile
    </a>
  </li>
     <li class="sidebar-item active">
    <a class="sidebar-link" href="requirement_form.php">
      <i class="fa fa-cogs" aria-hidden="true" style="margin-right: 8px;"></i>Teachers Data (Required)
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

            <h2 class="mb-0 p-1">Submit Teacher Information for Invigilation</h2>
          </div>
        </header>
        <!-- Dashboard Counts Section-->
        <div class="alert alert-danger" id="danger-alert" style="display:none;"></div>
                   <div class="alert alert-success" id="success-alert" style="display:none;"></div>
                  
        <section class="forms">
          <div class="container-fluid">
            <div class="row">
           
              <!-- Profile Update Form -->
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header bg-dark text-white">
                  <h2>Invigilation Form</h2>
                    <!-- ... Your existing card header content ... -->
                  </div>
                  <div class="card-body">
                    <form class="form-horizontal" id="teacherForm">
                      <div class="row">
                        <!-- Institute Email -->
                        <label class="col-sm-3 form-label">Teacher Full Name</label>
                        <div class="col-sm-9">
                          <input required class="form-control" type="name" name="name" id="name" value="">
                       
                        </div>

                        <br><br>
                        <label class="col-sm-3 form-label"> Designation (Select only teaching Cadre)</label>
                        <div class="col-sm-9">
                          
                      <select class="form-control" name="desg" required>

                        <option selected disabled>--Select Designation--</option>

                        <!-- A section -->
<option value="A.H.M">A.H.M</option>
<option value="Account-Officer">Account Officer</option>
<option value="Accountant">Accountant</option>
<option value="ADPE">ADPE</option>
<option value="Administrator">Administrator</option>
<option value="APS">APS</option>
<option value="Assistant">Assistant</option>
<option value="Assistant-Account-Officer">Assistant Account Officer</option>
<option value="Assistant-AEO">Assistant AEO</option>
<option value="Assistant-Director">Assistant Director</option>
<option value="Assistant-Headmistress">Assistant Headmistress</option>
<option value="Assistant-Incharge">Assistant Incharge</option>
<option value="Assistant-Librarian">Assistant Librarian</option>
<option value="Assistant-Professor">Assistant Professor</option>
<option value="B-one-Employee">B one Employee</option>
<option value="Band-Master">Band Master</option>
<option value="Bearer">Bearer</option>
<option value="Baildar">Baildar</option>
<option value="Burser">Burser</option>

<!-- C section -->
<option value="Carpenter">Carpenter</option>
<option value="Care-Tacker">Care Tacker</option>
<option value="Chowkidar">Chowkidar</option>
<option value="Civil-Engineer">Civil Engineer</option>
<option value="Class-IV">Class IV</option>
<option value="Computer-Lab-Assistant">Computer Lab Assistant</option>
<option value="Computer-Lab-Incharge">Computer Lab. Incharge</option>
<option value="Computer-Lab.-Attendant">Computer Lab. Attendant</option>
<option value="Computer-Teacher">Computer Teacher</option>
<option value="Conductor">Conductor</option>
<option value="Conductor-(Daily-wages)">Conductor (Daily wages)</option>
<option value="Cook">Cook</option>
<option value="Course-Coordinator">Course Coordinator</option>

<!-- D section -->
<option value="Daftari">Daftari</option>
<option value="Daily-Wager">Daily Wager</option>
<option value="Data-Entry-Operator">Data Entry Operator</option>
<option value="Day-Care-Taker">Day care taker</option>
<option value="DDO">DDO</option>
<option value="Deputy-DG">Deputy DG</option>
<option value="Deputy-Director">Deputy Director</option>
<option value="Deputy-Headmistress">Deputy Headmistress</option>
<option value="DHM">DHM</option>
<option value="Director">Director</option>
<option value="Director-Physical-Education">Director Physical Education</option>
<option value="Dispenser">Dispenser</option>
<option value="DM">DM</option>
<option value="DMO">DMO</option>
<option value="Driver">Driver</option>
<option value="Driver-(Temporary)">Driver (Temporary)</option>

<!-- E section -->
<option value="Electrician">Electrician</option>
<option value="Elementary-Teacher">Elementary Teacher</option>
<option value="English-teacher">English teacher</option>
<option value="Estate-Officer">Estate Officer</option>
<option value="EST">EST</option>
<option value="EST-(Deputationest)">EST (Deputationest)</option>
<option value="EST-(Physical)">EST (Physical)</option>
<option value="EST-(Sacked)">EST (Sacked)</option>

<!-- F section -->
<option value="Frash">Frash</option>

<!-- G section -->
<option value="Gas-Mistry">Gas Mistry</option>
<option value="Gastatner-Operator">Gastatner Operator</option>
<option value="Ground-Man">Ground Man</option>
<option value="Ground-Supervisor">Ground Supervisor</option>

<!-- H section -->
<option value="Head-Clerk">Head Clerk</option>
<option value="Head-Mali">Head Mali</option>
<option value="Head-Mistress">Head Mistress</option>
<option value="Honourary">Honourary</option>

<!-- I section -->
<option value="Inspector">Inspector</option>
<option value="Inspector-Evaluation">Inspector Evaluation</option>
<option value="Internee">Internee</option>

<!-- J section -->
<option value="JLT">JLT</option>
<option value="JT">JT</option>
<option value="Junior-Teacher">Junior Teacher</option>

<!-- L section -->
<option value="Lab-Assistant">Lab Assistant</option>
<option value="Lab-Attendant">Lab Attendant</option>
<option value="Lab-Incharge">Lab Incharge</option>
<option value="LDC">LDC</option>
<option value="Library-Assistant">Library Assistant</option>
<option value="Library-Attendant">Library Attendant</option>
<option value="Library-Clerk">Library Clerk</option>
<option value="Librarian">Librarian</option>

<!-- M section -->
<option value="Mali">Mali</option>
<option value="Mechanic">Mechanic</option>
<option value="Montessori-Assistant-Against-EST">Montessori Assistant Against EST</option>
<option value="Montessori-Teacher-(DHM)">Montessori Teacher (DHM)</option>
<option value="Music-Teacher">Music Teacher</option>
<option value="MTT">MTT</option>

<!-- N section -->
<option value="Naib-Qasid">Naib Qasid</option>
<option value="Naib-Qasid-(Daily-Wager)">Naib Qasid (Daily Wager)</option>
<option value="Nurse">Nurse</option>

<!-- O section -->
<option value="OIC">OIC</option>
<option value="Offset-Machine-Operator">Offset Machine Operator</option>

<!-- P section -->
<option value="PMO">PMO</option>
<option value="Plumber">Plumber</option>
<option value="Principal">Principal</option>
<option value="Professor">Professor</option>
<option value="PTC">PTC</option>

<!-- Q section -->
<option value="Qari">Qari</option>
<option value="Qari">Qari</option>
<option value="Qaria">Qaria</option>

<!-- R section -->
<option value="RDE">RDE</option>
<option value="RD-(Exam)">RD (Exam)</option>
<option value="Receptionist">Receptionist</option>
<option value="Research-Center-Attendant">Research Center Attendant</option>

<!-- S section -->
<option value="Sacked-Employees">Sacked Employees</option>
<option value="Sanitory-Worker">Sanitary Worker</option>
<option value="Security-Supervisor">Security Supervisor</option>
<option value="Seinor-Computer-Teacher">Senior Computer Teacher</option>
<option value="Senior-Headmistress">Senior Headmistress</option>
<option value="Senior-Software-Engineer">Senior Software Engineer</option>
<option value="Senior-Teacher">Senior Teacher</option>
<option value="SET">SET</option>
<option value="SET-(Physical)">SET (Physical)</option>
<option value="SET-(Sacked)">SET (Sacked)</option>
<option value="SET-DM">SET DM</option>
<option value="SET-PTI">SET PTI</option>
<option value="SET-(Tech)">SET (Tech)</option>
<option value="SOMO">SOMO</option>
<option value="SST">SST</option>
<option value="SST-(Tech)">SST (Tech)</option>
<option value="SST/Deputy-Director">SST/Deputy Director</option>
<option value="StenoGrapher">StenoGrapher</option>
<option value="StenoTypist">StenoTypist</option>
<option value="Store-Keeper">Store Keeper</option>
<option value="Supervisor">Supervisor</option>
<option value="Supervisor-Monitoring">Supervisor Monitoring</option>
<option value="Superintendant">Superintendent</option>

<!-- T section -->
<option value="Table-Boy">Table Boy</option>
<option value="Teacher-(Daily-Wager)">Teacher (Daily Wager)</option>
<option value="Tech-Assistant">Tech Assistant</option>
<option value="Telephone-Operator">Telephone Operator</option>
<option value="TGT">TGT</option>
<option value="TGT-(Daily-Wager)">TGT (Daily Wager)</option>
<option value="TGT/Assistant-Director">TGT/Assistant Director</option>
<option value="UDC">UDC</option>
<option value="UDC-(Daily-Wages)">UDC (Daily Wages)</option>
<option value="Urdu-Typist">Urdu Typist</option>
<option value="USF-Teacher">USF Teacher</option>

<!-- V section -->
<option value="Visiting-Faculty">Visiting Faculty</option>
<option value="VP">VP</option>
<option value="VP/Head-Master">VP/Head Master</option>

<!-- W section -->
<option value="Watchman">Watchman</option>
<option value="Water-Man">Water Man</option>
<option value="Water-Woman">Water Woman</option>






                      </select>
                      </div>


                      <br><br>
                      <label class="col-sm-3 form-label">CNIC</label>
                        <div class="col-sm-9">
                          <input class="form-control" type="text" name="cnic" id="cnic" value="" required>
                       
                        </div>

                        <br><br>
                      <label class="col-sm-3 form-label">Vendor No.</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="vendor" id="vendor" value="" required>
                       
                        </div>

                        <br><br>
                      <label class="col-sm-3 form-label">AGPR Personal No.</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="agpr" id="agpr" value="" required>
                       
                        </div>



                        <br><br>
                      <label class="col-sm-3 form-label">IBAN No.</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="iban" id="iban" value="" required>
                       
                        </div>


                        <br><br>
                      <label class="col-sm-3 form-label">Bank Name</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="bankname" id="bankname" value="" required>
                        </div>


                        <br><br>
                      <label class="col-sm-3 form-label">Bank Branch Code</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="branchcode" id="branchcode" value="" required>
                       
                        </div>

                        <br><br>
                      <label class="col-sm-3 form-label">Teacher Status</label>
                        <div class="col-sm-9">
                        <select class="form-control" required>
                        <option selected disabled value="">--Select Status--</option>
                        <option value="Regular">Regular</option>
  <option value="Contract">Contract</option>
  <option value="Daily-Wager">Daily Wager</option>
  <option value="NGO/Tenure">NGO/Tenure</option>
  <option value="Deputation">Deputation</option>
  <option value="PM-Assistance-Package">PM Assistance Package</option>
  <option value="Assistance-Package-on-Medical-Ground">Assistance Package on Medical Ground</option>

                      </select>

                        </div>


                        <br><br>
                      <label class="col-sm-3 form-label">DDO Code</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="ddocode" id="ddocode" value="" required>
                      
                        </div>


                        <br><br>
                      <label class="col-sm-3 form-label">Teacher Subject</label>
                        <div class="col-sm-9">
                        <select class="form-control" required>
                        <option selected disabled value="">--Select Subject--</option>
               
  <option value="ENG-LITERATURE">ENG. LITERATURE (In lieu of English)</option>
  <option value="URDU-Compulsory">URDU (Compulsory)</option>
  <option value="ENG-LITERATURE-Urdu">ENG. LITERATURE (In lieu of Urdu)</option>
  <option value="URDU-SALEES">URDU SALEES (In lieu of Urdu)</option>
  <option value="GEO-OF-PAK">GEO OF PAK (In lieu of Urdu)</option>
  <option value="ISLAMIYAT-Compulsory">ISLAMIYAT (Compulsory)</option>
  <option value="IKHLAQIAT-ETHICS">IKHLAQIAT/ETHICS (In lieu of Islamiyat) Only for Non-Muslims)</option>
  <option value="PAKISTAN-STUDIES">PAKISTAN STUDIES (Compulsory)</option>
  <option value="MATHEMATICS-ELECTIVE">MATHEMATICS (ELECTIVE)</option>
  <option value="PHYSICS">PHYSICS</option>
  <option value="CHEMISTRY">CHEMISTRY</option>
  <option value="BIOLOGY">BIOLOGY</option>
  <option value="COMPUTER-SCIENCE">COMPUTER SCIENCE</option>
  <option value="GENERAL-SCIENCE">GENERAL SCIENCE</option>
  <option value="GENERAL-MATHEMATICS">GENERAL MATHEMATICS</option>
  <option value="CIVICS">CIVICS</option>
  <option value="ECONOMICS">ECONOMICS</option>
  <option value="ISLAMIC-HISTORY">ISLAMIC HISTORY</option>
  <option value="ISLAMIC-STUDIES">ISLAMIC STUDIES</option>
  <option value="GEOGRAPHY">GEOGRAPHY</option>
  <option value="ART-MODEL-DRAWING">ART & MODEL DRAWING</option>
  <option value="ARABIC">ARABIC</option>
  <option value="FOOD-NUTRITION">FOOD & NUTRITION</option>
  <option value="CLOTHING-TEXTILE">CLOTHING & TEXTILE</option>
  <option value="ELEMENTS-H-ECONOMICS">ELEMENTS OF H. ECONOMICS</option>
  <option value="ENGLISH-ELECTIVE">ENGLISH ELECTIVE</option>
  <option value="EDUCATION">EDUCATION</option>
  <option value="COMPUTER-STUDIES">COMPUTER STUDIES</option>
  <option value="ELECTRICAL-WIRING">ELECTRICAL WIRING</option>
  <option value="WOOD-WORKING-FURNITURE-MAKING">WOOD WORKING & FURNITURE MAKING</option>
  <option value="WELDING-ARC-GAS">WELDING (ARC & GAS)</option>
  <option value="DRESS-MAKING-FASHION-DESIGNING">DRESS MAKING & FASHION DESIGNING</option>
  <option value="COMPUTER-HARDWARE">COMPUTER HARDWARE</option>
  <option value="MOTOR-WINDING">MOTOR WINDING</option>
  <option value="DRAWING">DRAWING</option>
  <option value="AGRICULTURE">AGRICULTURE</option>
  <option value="GENERAL-KNOWLEDGE">General Knowledge</option>
  <option value="HISTORY-AND-GEOGRAPHY">HISTORY AND GEOGRAPHY</option>
  <option value="HISTORY">HISTORY</option>
  <option value="GAME">GAME</option>
  <option value="SOCIAL-STUDIES">Social Studies</option>
  <option value="LIBRARY">Library</option>
  <option value="SOCIOLOGY">Sociology</option>
  <option value="PERSIAN">Persian</option>
  <option value="PHYSICAL-EDUCATION">Physical Education</option>
  <option value="POLITICAL-SCIENCE">Political Science</option>
  <option value="URDU-LITERATURE">Urdu Literature</option>
  <option value="STATISTICS">Statistics</option>
  <option value="GENERAL-KNOWLEDGE-2">General Knowledge</option>
  <option value="STATISTICS-2">Statistics</option>
  <option value="ARABIC-2">Arabic</option>
  <option value="APPLIED-PSYCHOLOGY">Applied Psychology</option>
  <option value="BIOLOGICAL-SCIENCE">Biological Science</option>
  <option value="ECONOMICS-2">Economics</option>
  <option value="HOME-ECONOMICS">Home Economics</option>
  <option value="JOUR-AND-MASS-COMM">Jour. and Mass Comm</option>
  <option value="ENGLISH-2">English</option>
  <option value="APPLIED-PSYCHOLOGY-2">Applied Psychology</option>
  <option value="FINE-ARTS">Fine Arts</option>
  <option value="FINE-ARTS-2">Fine Arts</option>
  <option value="ACCOUNTING">Accounting</option>
  <option value="COMMERCE">Commerce</option>
  <option value="BUSINESS-MATHS">Business Maths</option>
  <option value="LIBRARY-SCIENCES">Library Sciences</option>
  <option value="BANKING">Banking</option>
  <option value="BUSINESS-STATS">Business Stats</option>
  <option value="MICRO-ECONOMICS">Micro Economics</option>
  <option value="FINANCIAL-ACCOUNTING">Financial Accounting</option>
  <option value="INTRODUCTION-TO-BUSINESS">Introduction to Business</option>
  <option value="FUN-ENGLISH">Fun. English</option>
  <option value="MONEY-BANKING-FINANCE">Money Banking & Finance</option>
  <option value="BUSINESS-MATHS-STATS">Business Maths & Stats</option>
  <option value="BUSINESS-LAW">Business Law</option>
  <option value="COST-ACCOUNTING">Cost Accounting</option>
  <option value="AUDITING">Auditing</option>
  <option value="ADVANCE-ACCOUNTING">Advance Accounting</option>
  <option value="BUSINESS-COMMUNICATION-REPORT-WRITING">Business Communication & Report writing</option>
  <option value="BUSINESS-TAXATION">Business Taxation</option>
  <option value="ECONOMICS-OF-PAKISTAN">Economics of Pakistan</option>
  <option value="FINANCIAL-REPORTING">Financial Reporting</option>
  <option value="MARKETING">Marketing</option>
  <option value="MANAGERIAL-ECONOMICS">Managerial Economics</option>
  <option value="INTERNATIONAL-BUSINESS-FINANCE">International Business Finance</option>
  <option value="BUSINESS-COMMUNICATION-PRESENTATION-SKILLS">Business Communication & Presentation Skills</option>
  <option value="TOTAL-QUALITY-MANAGEMENT">Total Quality Management</option>
  <option value="ORGANIZATIONAL-BEHAVIOR">Organizational Behavior</option>
  <option value="FINANCIAL-MANAGEMENT">Financial Management</option>
  <option value="COST-MANAGEMENT-ACCOUNTING">Cost & Management Accounting</option>
  <option value="NON-BANKING-FINANCIAL-INSTITUTIONS">Non Banking Financial Institutions</option>
  <option value="RESEARCH-METHODS">Research Methods</option>
  <option value="ACCOUNTING-INFORMATION-SYSTEM-E-COMMERCE">Accounting Information System / E.Commerce</option>
  <option value="OPERATION-PRODUCTION-MANAGEMENT">Operation & Production Management</option>
  <option value="LOGIC-CRITICAL-THINKING">Logic & Critical Thinking</option>
  <option value="CORPORATE-FINANCE">Corporate Finance</option>
  <option value="ENTREPRENEURSHIP">Entrepreneurship</option>
  <option value="HEALTH">Health</option>
  <option value="HEALTH-PHYSICAL-EDUCATION">Health and Physical Education</option>
  <option value="OTHERS">Others</option>
  <option value="MATH-STAT-PHYSICS">Math, Stat, Physics</option>


                      </select>
                        </div>

                        <br><br>
                      <label class="col-sm-3 form-label">Contact No.</label>
                        <div class="col-sm-9">
                          <input  class="form-control" type="text" name="teachercontact" id="teachercontact" value="" required>
                      
                        </div>

                        <br><br>
                        <br><br>
                        <label class="col-sm-3 form-label">Consent</label>
                        <div class="col-sm-9">
                         <h5 class="text-danger"><strong>Warning Consent!</strong></h5>
                          <p class="text-danger">   
                          I hereby acknowledge that the provided information is accurate, and I am sharing the details of the teacher. In the event of any inaccuracies or failure to submit the required data, FDE reserves the right to initiate legal actions against the focal person, Principal, or Head Incharge.  
                          <br>
<p><input  type="checkbox" name="consent" id="consent" value="" required>
                        I have read the above and agree to the consent.</p>
                        </div>

                      </div>



                      <!-- Submit Button -->
                      <div class="border-bottom my-5 border-gray-200"></div>
                      <div class="row">
                        <div class="col-lg-12 ms-auto">
                          <button class="btn btn-primary text-white w-100" type="button" id="submitBtn" name="update-profile-submit">Submit Profile</button>
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
      document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> YOU HAVE SUBMITTED DATA ALREADY CAN'T EDIT / REGISTER STUDENTS";
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


<script>
    $(document).ready(function () {
        $("#submitBtn").click(function () {
            
            
             event.preventDefault();

      // Check if all required fields are not empty
      if (
        $("#name").val() === "" ||
        $("#desg").val() === null ||
        $("#cnic").val() === "" ||
        $("#vendor").val() === "" ||
        $("#agpr").val() === "" ||
        $("#iban").val() === "" ||
        $("#bankname").val() === "" ||
        $("#branchcode").val() === "" ||
        $("select[name='status']").val() === null ||
          $("select[name='status']").val() === "" ||
        $("#ddocode").val() === "" ||
        $("select[name='subject']").val() === null ||
         $("select[name='subject']").val() === "" ||
        $("#teachercontact").val() === "" ||
        !$("#consent").prop("checked")
      ) {
        // Display an alert or error message
        alert("Please fill in all required fields and accept the consent.");
      } else {
        // All required fields are filled, proceed with AJAX submission
          
            $.ajax({
                type: "POST",
                url: "Engine/rs_teacher_form.php", // Replace with your PHP processing file
                data: $("#teacherForm").serialize(),
                success: function (response) {

                  $('html, body').animate({ scrollTop: 0 }, 'slow');
                  $("#success-alert").text("SUCCESS ! Teacher has been successfully entered").fadeIn().delay(5000).fadeOut();
                  $("#teacherForm").trigger("reset");
                
   
                },
                error: function (error) {
                  $('html, body').animate({ scrollTop: 0 }, 'slow');
                  $("#danger-alert").text("SORRY ! Can't Add Teachers, TRY ADDING TEACHERS AGAIN BY RE-LOGIN and ADD EACH INFORMATION CAREFULLY ").fadeIn().delay(5000).fadeOut();
    
  
                }
            });
      }
            
            
            
            
         
        });
    });
</script>


</html>