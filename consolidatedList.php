<?php session_start();  
if (!isset($_SESSION['session_token']) || !isset($_SESSION['inst_code'])) {
  header('location:login.html?status=EXPIRED');
}
include "Engine/dbutils.php";
$conn = OpenCon();
$x = getInstituteChallanNumber($conn,$_SESSION['inst_code']);
if($x=="-"){
  header("location:index.php?status=CHALLAN_NOT_GENERATED");
  exit();
}

$sequence = array(32, 83, 121, 115, 116, 101, 109, 32, 100, 101, 115, 105, 103, 110, 101, 100, 32, 98, 121, 32, 83, 97, 97, 100, 32, 83, 97, 100, 105, 113, 32, 45, 32, 83, 121, 115, 116, 101, 109, 32, 80, 114, 111, 103, 114, 97, 109, 109, 101, 114, 32, 45, 32, 70, 68, 69, 32, 40, 73, 84, 41);

 makeStrictLog($_SESSION['inst_code'],"CONSOLIDATED LIST","Student Consolidated","Generated","N/A",$conn);
    
 ?>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>All Students</title>
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
  <!-- Tweaks for older IEs-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    @media print {
      table {
        page-break-after: auto
      }
      tr {
        page-break-inside: avoid;
        page-break-after: auto
      }
      td {
        page-break-inside: avoid;
        page-break-after: auto
      }
      thead {
        display: table-header-group
      }
      tfoot {
        display: table-footer-group
      }
    }
  </style>

  <script>

function formatDate(dateString) {
   const [year, month, day] = dateString.split('-');
  const formattedDate = `${day}/${month}/${year}`;
    return formattedDate;
}


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
      document.body.innerHTML += "<style>.pagebreak { page-break-before: always; } #footer-signature{ break-inside: avoid; } body{ background-image:url(\"assets\img\govwinv.png\"); font-family: 'Montserrat', sans-serif;} .footer {opacity:0.6; position: sticky;left: 0;bottom: 0;width: 100%;text-align: center; margin-top:30px;}  </style>";
      document.body.innerHTML += '<br><br><br><br><br>';
      document.body.innerHTML += printContents;
      document.body.innerHTML += '<h5 class="footer" style="font-size:5px;">System Designed by Saad Sadiq System Programmer IT-FDE Web generated Report / Generated on ' + new Date().toLocaleString() + '<h5>';
      window.print();

      document.body.innerHTML = originalContents;
    }

    function Print() {
      PrintElem("report");
    }
    $(document).on('keydown', function(e) {
      if ((e.ctrlKey || e.metaKey) && (e.key == "p" || e.charCode == 16 || e.charCode == 112 || e.keyCode == 80)) {
        alert("Please use the Print button below for a better rendering on the document");
        e.cancelBubble = true;
        e.preventDefault();

        e.stopImmediatePropagation();
      }
    });

    document.addEventListener('contextmenu', event => event.preventDefault());
  </script>
</head>

<body>

<div class="row d-flex justify-content-center">
                            <div class="col-sm-9">
                              <br><br>
                              <label class="text-danger"><strong>INFORMATION ! </strong>Print in LANDSCAPE MODE</label>
                              <br>
                             <button class="btn btn-danger text-white w-50"  onclick="Print()">Print</button><br><br>
                             <input class="btn btn-success text-white w-50" action="action" onclick="window.history.go(-1); return false;" type="submit" value="Back"/>
                              <br><br>
                            </div>
                          </div>


  <div id="report" class="container" >
       <div class="pagebreak"> </div>
    <div id="fifthdiv">
    <div class="d-flex justify-content-center">
      <div >
        <h1>Federal Directorate of Education</h1>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <h3 id="FschoolName">School Name</h3>
      <br><br>
      
    </div>
    <div class="d-flex justify-content-center pt-100">
      <h3>CENTRALIZED ANNUAL EXAMINATION CLASS-V 2024</h3>
      <h3>
        <?php 
      $x = getInstituteChallanNumber($conn,$_SESSION['inst_code']);
      if($x=="-"){
        echo "<br>CHALLAN NO. (GENERATE CHALLAN)";
      }else{
        echo "<br>CHALLAN NO. ".$x;
      }
      ?></h3>
    </div>
   
    <section class="tables">
      <div class="container-fluid">
        <div class="table-responsive">
          <table class="table mb-0 table-hover" style="text-align:left;" id="student_tbody" style="border:1px; border-style:solid;">
            <thead>
              <th>S.No</th>
              <th>Profile</th>
              <th>Registration #</th>
              <th>Student name</th>
              <th>Father Name</th>
              <th>Date of Birth</th>
              <th>Form B. Number</th>
              <th>Contact</th>
                  <th>Center</th>
              <th>Subject Category</th>
            </thead>
            <tbody id="list-fifth"></tbody>
          </table>
        </div>
      </div>
    </section>

    <div id="footer-signature">
      <table class="" style="width:100%;">
        <th style="width:50%;">
          <div>
            <h3>Focal Person</h3>
            <label style="width:100%; ">Full Name<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Signature<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
          </div>
        </th>
        <th style="width:50%; text-align:left;">
          <div>
            <h3 style="width:100%; ">Head of Institution</h3>
            <label style="width:100%; ">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
          </div>
        </th>
      </table>
    </div>

    </div>


    <div class="pagebreak"> </div>

    <div id="eighthdiv">
    <div class="d-flex justify-content-center">
      <div>
        <h1>Federal Directorate of Education</h1>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <h3 id="SschoolName"></h3>
    </div>
    <div class="d-flex justify-content-center pt-100">
      <h3>CENTRALIZED ANNUAL EXAMINATION CLASS-VIII 2024</h3>
      <h3>
        <?php 
      $x = getInstituteChallanNumber($conn,$_SESSION['inst_code']);
      if($x=="-"){
        echo "<br>CHALLAN NO. (GENERATE CHALLAN)";
      }else{
        echo "<br>CHALLAN NO. ".$x;
      }
      ?></h3>
    </div>
    <section class="tables">
      <div class="container-fluid">
        <div class="table-responsive">
          <table class="table mb-0 table-hover" style="text-align:left;" style="border:1px; border-style:solid;">
            <thead>
            <th>S.No</th>
              <th>Profile</th>
              <th>Registration #</th>
              <th>Student name</th>
              <th>Father Name</th>
              <th>Date of Birth</th>
              <th>Form B. Number</th>
              <th>Contact</th>
                  <th>Center</th>
              <th>Subject Category</th>
            </thead>
            <tbody id="list-eighth"></tbody>
          </table>
        </div>
      </div>
    </section>


    <div id="footer-signature">
      <table class="" style="width:100%;">
        <th style="width:50%;">
          <div>
            <h3>Focal Person</h3>
            <label style="width:100%; ">Full Name<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Signature<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
          </div>
        </th>
        <th style="width:50%; text-align:left;">
          <div>
            <h3 style="width:100%; ">Head of Institution</h3>
            <label style="width:100%; ">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
            <br><br><label style="width:100%; ">Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label>
          </div>
        </th>
      </table>
    </div>
    </div>
  </div>



  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

<script>
  $.ajax({
    url: 'Engine/getFinalStudents.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function(myJson) {
        
        if(myJson=="Locked"){
            window.location.replace('index.php?status=FINAL_ERROR');
        }
        
        
      var str = "";
      var stre = "";
      var countF=0;
      var countE=0;

      for (var i = 0; i < myJson.length; i++) {

        if(myJson[i].class=="5"){
          str += '<tr >';
        str += '<td>' + (i + 1) + '</td>';
        str += '<td><img width="60" src="uploads-new/<?php echo $_SESSION['inst_code'];?>/' +myJson[i].student_img+ '"></img></td>';
        str += '<td>' +'051'+ myJson[i].student_id+ '</td>';
        str += '<td>' + myJson[i].student_name + '</td>';
        str += '<td>' + myJson[i].student_father_name + '</td>';
        str += '<td>' + myJson[i].student_date_of_birth + '</td>';
        str += '<td>' + myJson[i].student_b_form + '</td>';
        str += '<td>0' + myJson[i].student_contact_number + '</td>';
        str += '<td>' + myJson[i].pins_name + '</td>';
        str += '<td>' + myJson[i].cls_name + '</td>';
        str += '</tr>';
        countF++;
        
        }else if( myJson[i].class=="8"){
          stre += '<tr>';
        stre += '<td>' + (i + 1) + '</td>';
        stre += '<td><img width="60" src="uploads-new/<?php echo $_SESSION['inst_code'];?>/' +myJson[i].student_img+ '"></img></td>';
        stre += '<td>' +'051'+  myJson[i].student_id + '</td>';
        stre += '<td>' + myJson[i].student_name + '</td>';
        stre += '<td>' + myJson[i].student_father_name + '</td>';
        stre += '<td>' + myJson[i].student_date_of_birth + '</td>';
        stre += '<td>' + myJson[i].student_b_form + '</td>';
        stre += '<td>0' + myJson[i].student_contact_number + '</td>';
          stre += '<td>' + myJson[i].pins_name + '</td>';
        stre += '<td>' + myJson[i].cls_name + '</td>';
        stre += '</tr>';
countE++;
        }
      }

      if(countF!=0){
        document.getElementById('list-fifth').innerHTML = str;
      }else{
        document.getElementById('fifthdiv').style.display='none';
      }

      if (countE!=0){
        document.getElementById('list-eighth').innerHTML = stre;
      }else {
        document.getElementById('eighthdiv').style.display='none';
      }
   
      
    }
  });



  $.ajax({
    url: 'Engine/getInstitute.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function(myJson) {

document.getElementById('FschoolName').innerHTML=myJson[0].inst_name;
document.getElementById('SschoolName').innerHTML=myJson[0].inst_name;

    } 
  });





</script>


</html>