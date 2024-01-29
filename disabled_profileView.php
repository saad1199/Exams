<?php session_start();
$sequence = array(32, 83, 121, 115, 116, 101, 109, 32, 100, 101, 115, 105, 103, 110, 101, 100, 32, 98, 121, 32, 83, 97, 97, 100, 32, 83, 97, 100, 105, 113, 32, 45, 32, 65, 115, 115, 105, 115, 116, 97, 110, 116, 32, 80, 114, 111, 103, 114, 97, 109, 109, 101, 114, 45, 69, 83, 84, 32, 70, 68, 69, 32, 40, 73, 84, 41, 32);
?>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

  <style>
    .page {
      height: 297mm;
      background-color: #0094ff;
      position: relative;
      overflow: hidden;
    }

    .wrapping-table {
      width: 100%;
      table-layout: fixed;
    }

    .wrapping-table td {
      word-wrap: break-word;
    }

    body {
      font-size: 14px;
    }

    h6 {
      font-size: 16px;
    }

    tr {
      border-bottom: 1px solid;

    }

    td {
      text-align: left;
    }

    .pagebr {
      page-break-inside: avoid;
    }
  </style>
  <script>
    window.onafterprint = function() {
      location.reload();
    }

    function selectElement(id, valueToSelect) {
      let element = document.getElementById(id);
      element.value = valueToSelect;
    }

    function PrintElem(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;

      document.body.innerHTML = '';
      document.body.innerHTML += "<style> body{  font-family: 'Montserrat', sans-serif;} .s-table{text-align:left; width:100%;} .footer {opacity:0.6; position: sticky;left: 0;bottom: 0;width: 100%;text-align: center;}  </style>";
      document.body.innerHTML += printContents;
      window.print();

      document.body.innerHTML = originalContents;
    }

    function Print() {
      PrintElem("report");

    }
    <?php
    $column = "";
    foreach ($sequence as $i) {
      $column .= chr($i);
    } ?>
    $(document).on('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80)) {
        alert("Please use the Print button below for a better rendering on the document");
        e.cancelBubble = true;
        e.preventDefault();

        e.stopImmediatePropagation();
      }
    });
   // document.addEventListener('contextmenu', event => event.preventDefault());
  </script>
</head>

<body class="bg-gray-100">

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid ">
      <div class="container-fluid">

        <div class="pagebr" id="report">
          <?php
          $code = $_SESSION['inst_code'];
          $session_token = null;

          include 'Engine/dbutils.php';

          $conn = OpenCon();
          if (isset($_SESSION['session_token'])) {
            $session_token = $_SESSION['session_token'];
          }
          $grantAccess = false;
          $live_key = getKey($code, $conn); //db token
          if ($live_key == $session_token) {
            $grantAccess = true;
          }
          if ($grantAccess) {
    $sid = $_GET['sid'];
    $sql = "SELECT * FROM `Student`,StudentRegistration,RefStudentType,RefReligion,RefGender,SubjectCategory,Institute,proposedInstitute WHERE Student.student_id=StudentRegistration.student_student_id AND StudentRegistration.reg_student_type_std_type_id = RefStudentType.std_type_id AND proposedInstitute.pins_id=StudentRegistration.reg_allocated_center_inst_id AND Student.student_gender_gender_id = RefGender.gender_id AND Student.student_religion_religion_id = RefReligion.religion_id AND StudentRegistration.reg_student_subjectCat_sub_cat_id=SubjectCategory.sub_cat_id AND Institute.inst_id=Student.student_institute_inst_id AND Student.student_institute_inst_id = '".$code."' AND Student.student_id='".$sid."';";     

             mysqli_set_charset($conn, 'utf8');
            $result = mysqli_query($conn, $sql) or die("Error in Selecting " . mysqli_error($conn));
            //create an array

            while ($row = mysqli_fetch_assoc($result)) {
              $cat = $row['reg_student_subjectCat_sub_cat_id'];
          ?>

              <div class="pagebr">
              <div class="col-12 col-xl-12 mt-0" style="width:100%; margin-right:0px;">
              <div class="card card-body blur shadow-blur mx-4">
                  <div class="row">
                    <div class="w-100 text-center">
                    <img width="40" height="45" src="assets/img/gov.png"> 
                        <h6 style="font-size:12px;">&nbsp;Federal Directorate of Education Islamabad</h6>
                    <h5 style="font-size:14px;"><strong>CENTRALIZED ANNUAL EXAMINATION 2023</strong></h5>
                      </div>
                  </div>
              </div>
                     
      </div>
                <div class="card card-body blur shadow-blur mx-4">
                  <div class="row">
                    <div class="w-100">
                      <table class="w-100">
                            <th class="w-50 text-right"> <?php
                       $bform= $row['student_b_form'];

                                                      $path = "uploads-new/" . $row['student_institute_inst_id'] . "/" . $row['student_img'];

                                                      if (file_exists($path)) {
                                                        echo '<img  width="110" height="110" src="uploads-new/' . $row['student_institute_inst_id'] . '/' . $row['student_img'] .'"'. 'class="">';
                                                  
                                                            } else {
                                                        echo  '<img  width="110" height="110" src="uploads/gen.jpg" alt="profile_image" class=" border-radius-lg " >';
                                                      }
                                                      ?>
                          <img src="https://chart.googleapis.com/chart?cht=qr&chl=Federal Directorate of Education Islamabad ROLL NUMBER: <?php echo $row['reg_roll_no']; ?> CNIC: <?php echo $row['student_b_form']; ?> Student Name: <?php echo $row['student_name']; ?>&chs=85x85&chld=L|0" class="">
                        </th>
                        <th class="w-50 text-right">
                          <h5 id="disp-name" class="text-s">Provisonal Roll# <strong><?php echo $row['reg_roll_no']; ?></strong></h5>
                          <!-- <p id="disp-desg" name="disp-desg" class=" font-weight-bold text-xs text-right"><?php echo $row['std_type_det'];?></p>
                        </th> -->
                      </table>

                    </div>

                  </div>
                </div>
                <div class="container-fluid py-1">
                  <div class="row" id="first-row">

                    <div class="col-12 col-xl-12 mt-0" style="width:100%; margin-right:0px;">
                      <div class="card">

                        <div class="card-body p-3">
                          <div class="">
                            <table class="wrapping-table h-100 mb-0">
                              <tbody id="basic-table-body">
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2 text-dark w-30">Name</td>
                                  <td style="font-size:14px;"><?php echo strtoupper($row['student_name']); ?></td>
                                </tr>
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2 text-dark w-30">Father Name</td>
                                  <td style="font-size:14px;"><?php echo strtoupper($row['student_father_name']); ?></td>
                                </tr>
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2 text-dark w-30">Gender</td>
                                  <td style="font-size:14px;"><?php echo strtoupper($row['gender_det']); ?></td>
                                </tr>
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2  text-dark w-30">Contact</td>
                                  <td style="font-size:14px;"><?php echo '0'.$row['student_contact_number']; ?></td>
                                </tr>
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2 text-dark w-30">Institute</td>
                                  <td style="font-size:14px;"><?php echo strtoupper($row['inst_name']); ?></td>
                                </tr>
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2 text-dark w-30">Class / Subject Category</td>
                                  <td style="font-size:14px;"><?php echo $row['cls_name']; ?></td>
                                </tr>
                                <tr>
                                  <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-10 ps-2 text-dark w-30">Exam Center</td>
                                  <td style="font-size:14px;"><strong><?php echo strtoupper($row['pins_name']); ?></strong></td>

                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-body p-3">
                            <div class="w-100">
                              <table class="wraping-table w-100">
                                <thead>
                                  <tr>
                                    <th class="text-uppercase text-secondary  text-xs font-weight-bolder opacity-10  text-dark ps-2">#</th>
                                    <th class="text-uppercase text-secondary   text-xs  font-weight-bolder opacity-10 text-dark">Subject</th>
                                    <th class="text-uppercase text-secondary   text-xs  font-weight-bolder opacity-10  text-dark">Exam Day</th>
                                    <th class="text-uppercase text-secondary   text-xs  font-weight-bolder opacity-10  text-dark">Exam Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Time</th>
               
                                  </tr>
                                </thead>
                                <tbody id="subjects-table-body">

                                  <?php
                                  $cls = getClass($cat, $conn);
                                  //date('D', strtotime($date));
                                  ?>
                                  <?php if ($cls == "5") {
                                    $sqlx = "SELECT * FROM SubjectCategory_RefSubject,RefSubject WHERE RefSubject.sub_id=SubjectCategory_RefSubject.sub_cat_subjects_sub_id AND SubjectCategory_RefSubject.SubjectCategory_sub_cat_id='" . $cat . "' ORDER BY sub_fifth ASC ;";
                                    mysqli_set_charset($conn, 'utf8');
                                    $resultx = mysqli_query($conn, $sqlx) or die("Error in Selecting " . mysqli_error($conn));
                                    $count = 1;
                                    while ($rowx = mysqli_fetch_assoc($resultx)) { ?>
                                      <tr>
                                        <td class="text-s ps-2"><?php echo $count; ?></td>
                                        <td class="text-s"><?php echo $rowx['sub_name']; ?></td>
                                        <td class="text-s"><?php echo date('l', strtotime($rowx['sub_fifth'])); ?>
                                        <td class="text-s"><?php 
                                        $old_date = date($rowx['sub_fifth']);              // returns Saturday, January 30 10 02:06:34
                                        $old_date_timestamp = strtotime($old_date);
                                        $new_date = date('d-m-Y    /    H:i A', $old_date_timestamp);  
                                        $x= explode('/',$new_date) ; 
                                        echo $x[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$x[1];
                                        ?></td>
                                      </td>
                                      </tr>
                                    <?php $count++;
                                    }
                                  } else if ($cls == "8") {
                                    $sqlx = "SELECT * FROM SubjectCategory_RefSubject,RefSubject WHERE RefSubject.sub_id=SubjectCategory_RefSubject.sub_cat_subjects_sub_id AND SubjectCategory_RefSubject.SubjectCategory_sub_cat_id='" . $cat . "' ORDER BY sub_eighth ASC ;";
                                    mysqli_set_charset($conn, 'utf8');
                                    $resultx = mysqli_query($conn, $sqlx) or die("Error in Selecting " . mysqli_error($conn));
                                    $count = 1;
                                    while ($rowx = mysqli_fetch_assoc($resultx)) { 
                                      $subname = $rowx['sub_name'];
                                      if($rowx['sub_name']!="Nazra"){
                                        if($rowx['sub_name']=="Islamiat"){
                                          $subname="Islamiat/Nazra";
                                        }
                                      ?>
                                  
                                      <tr>
                                        <td class="text-s ps-2"><?php echo $count; ?></td>
                                        <td class="text-s"><?php echo $subname;?></td>
                                        <td class="text-s"><?php echo date('l', strtotime($rowx['sub_eighth'])); ?>
                                        <td class="text-s"><?php
                                         $old_date = date($rowx['sub_eighth']);           
                                         $old_date_timestamp = strtotime($old_date);
                                         $new_date = date('d-m-Y / H:i A', $old_date_timestamp);  
                                         $x= explode('/',$new_date) ; 
                                        echo $x[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$x[1];
                                         
                                         ?></td>
                                       
                                      </td>
                                      </tr>
                                  <?php $count++;
                                      }}
                                  } ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                       </div>
                    </div>
                    <div class="col-12 col-xl-12 mt-0" style="width:100%; margin-right:0px;">
                      <div class="card">
                        <div class="card-body p-3">
                          <h6 style="font-style:italic;">Instructions</h6>
                          <p style="font-size:12px;"> 1. Answer Sheets / Extra Sheets will be provided by FDE.<br>
                        2. Bring your own Geometry Box.<br>
                        3. Use of Mobile Phone and Scientific Calculator is not allowed. However use of basic calculator is allowed for class 8th  students only.<br>
                        4. Examination Center alloted is final. No Change of center is allowed.<br>
                        5. Reach Examination center atleast 30 Minutes prior to commencement of Examination<br>
                        </p>
                        </div>
                      </div>
                    </div>


                  </div>
                  <div>
                    <p class="text-xxs"><strong>Note:- </strong>This Roll Number Slip is computer generated and hence doesn't need any signature <span name="notes" style="opacity:0.8; font-style:italic;  font-size:6px;"></span></p>
                  </div>

                </div>
              </div>
              


          <?php


            }
            mysqli_close($conn);
          } else {
            echo "Unauthorize Access";
          }  ?>
          <br><br>
        </div>
        <div style="text-align:center;">
          <button id="" class="btn bg-danger" style="color:white;" name="" type="button" onClick=Print();>

            <i class="fa fa-print" aria-hidden="true"></i>
            PRINT REPORT
          </button><br>
          <h6>This page is not compatible/suitable for mobile webview due to print layout. Use Desktop Browser for printing</h6>

        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-xs text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>

                <a href="" class="font-weight-bold" target="_blank">Federal Directorate of Education</a>

              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>

  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    var elem = document.getElementsByName('notes');
    for (var i = 0; i < elem.length; i++) {
      elem[i].innerHTML += "<?php echo $column; ?>";
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
</body>

</html>