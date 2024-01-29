<?php session_start();  
include '../Engine/dbutils.php';
$conn = OpenCon();
?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Simple Dashboard</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta name="layout" content="main" />

  <script type="text/javascript" src="http://www.google.com/jsapi"></script>

  <script src="../js/jquery/jquery-1.8.2.min.js" type="text/javascript"></script>
  <link href="../css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Questrial&display=swap');

    .pagebr {
      page-break-inside: avoid;
    }

    body {
      font-family: 'Questrial', sans-serif;
    }

    thead {
      display: table-header-group;
    }

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

    table,
    td,
    th {
      border: 1px solid;
      line-height: 22px;
      font-size:13px;
    }



    table {
      width: 100%;
      border-collapse: collapse;
      page-break-inside: auto;
      text-align:left;
      
    }


    tr {
      page-break-inside: avoid;
      page-break-after: auto;
      
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
      document.body.innerHTML += "<style>.pagebreak { page-break-before: always; } table {break-inside: avoid; text-align:left;}   #footer-signature{ break-inside: avoid; } body{ background-image:url(\"assets\img\govwinv.png\"); font-family: 'Montserrat', sans-serif;} .footer {opacity:0.6; position: sticky;left: 0;bottom: 0;width: 100%;text-align: center; margin-top:30px;} thead {display: table-header-group;}  </style>";
      
      document.body.innerHTML += '<br><br><br><br><br>';
      document.body.innerHTML += printContents;
      document.body.innerHTML += '<h5 class="footer" style="font-size:5px;">System Designed by Saad Sadiq IT-FDE Web generated Report / Generated on ' + new Date().toLocaleString() + '<h5>';
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

  <div class="row">
    <div class="span16">
      <br><br>
      <label class="text-danger"><strong>INFORMATION ! </strong>Print in LANDSCAPE MODE</label>
      <br>
      <button class="btn btn-danger text-white w-100" onclick="Print()">Print</button><br><br>
      <input class="btn btn-success text-white w-100" action="action" onclick="window.history.go(-1); return false;" type="submit" value="Back" />
      <br><br>
    </div>
  </div>


  <div id="report" class="container">
    <div class="pagebreak"> </div>
    <div id="fifthdiv">
      
      

      <section class="tables">
          
          
          
        <div class="container-fluid">
          <div class="table-responsive">
             
             
             
             
            <table class="table mb-0 table-hover " style="text-align:left;" id="student_tbody" style="border:1px; border-style:solid;">
                <caption>
                    
                    <div class="d-flex justify-content-center text-center">
        <div style="width:100%; text-align:center;">
          <h1>Federal Directorate of Education</h1>
          <h4><?php echo getCenterName($_GET['emis'],$conn);?><br>CENTRALIZED ANNUAL EXAMINATION CLASS-V 2024</h4>
       
        </div>
        <div style="width:100%;">
            
            <table>
                <thead>
                    <th style="width:50%; text-align:left;">
                       <h3>Date:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h3>
           
                    </th>
                    <th style="width:50%; text-align:right;">
                        <h3>Subject:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h3>
                    </th>
                </thead>
            </table>
        </div>
          
      </div>
                </caption>
                
               
              <thead>
                <th>S.No</th>
                <th>Reg #</th>
                <th>Roll No.</th>
                <th>Student name</th>
                <th>Sheet No.</th>
                <th>Signature</th>
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
              <div style="width:100%; text-align:center;"><h3>Deputy Superintendent</h3></div>
              <label style="width:100%; ">Full Name<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Signature<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
            </div>
          </th>
          <th style="width:50%; text-align:left;">
            <div>
              <div style="width:100%; text-align:center;"><h3 style="width:100%; ">Superintendent</h3></div>
              <label style="width:100%; ">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
            </div>
          </th>
        </table>
      </div>

    </div>


    <div class="pagebreak"> </div>

    <div id="eighthdiv">
     
      
      
      <section class="tables">
        <div class="container-fluid">
          <div class="table-responsive">
            <table class="table mb-0 table-hover" style="text-align:left;" style="border:1px; border-style:solid;">
                <caption>
                    
                    <div class="d-flex justify-content-center text-center">
        <div style="width:100%; text-align:center;">
          <h1>Federal Directorate of Education</h1>
          <h4><?php echo getCenterName($_GET['emis'],$conn);?><br>CENTRALIZED ANNUAL EXAMINATION CLASS-VIII 2024</h4>
        
        </div>
           <div style="width:100%;">
            
            <table>
                <thead>
                    <th style="width:50%; text-align:left;">
                       <h3>Date:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h3>
           
                    </th>
                    <th style="width:50%; text-align:right;">
                        <h3>Subject:<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></h3>
                    </th>
                </thead>
            </table>
        </div>
      </div>
                </caption>
              <thead>
                <th>S.No</th>
                <th>Reg #</th>
                <th>Roll No.</th>
                <th>Student name</th>
                <th>Sheet No.</th>
                <th>Signature</th>
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
              <div style="width:100%; text-align:center;"><h3>Deputy Superintendent</h3></div>
              <label style="width:100%; ">Full Name<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Signature<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
            </div>
          </th>
          <th style="width:50%; text-align:left;">
            <div>
              <div style="width:100%; text-align:center;"><h3 style="width:100%; ">Superintendent</h3></div>
              <label style="width:100%; ">Full Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Designation<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
              <br><label style="width:100%; ">Signature&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></label><br>
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
    url: '../Engine/admin_getCenterStudents.php',
    data: {
      "token": "<?php echo $_SESSION['session_token']; ?>",
      "emis": "<?php echo $_GET['emis']; ?>"
    },
    type: "GET",
    async: false,
    dataType: "json",
    success: function(myJson) {

      if (myJson == "Locked") {
        window.location.replace('index.php?status=FINAL_ERROR');
      }


      var str = "";
      var stre = "";
      var countF = 0;
      var countE = 0;

      for (var i = 0; i < myJson.length; i++) {

        if (myJson[i].class == "5") {
          str += '<tr>';
          str += '<td>' + (countF + 1) + '</td>';
            str += '<td>051' + myJson[i].student_student_id + '</td>';
          if(myJson[i].reg_roll_no<0){
               str += '<td></td>';
          }else{
               str += '<td>' + myJson[i].reg_roll_no + '</td>';
          }
         
          str += '<td>' + myJson[i].student_name.toUpperCase() + '</td>';
          str += '<td></td>';
          str += '<td></td>';
          str += '</tr>';
          countF++;

        } else if (myJson[i].class == "8") {
          stre += '<tr>';
          stre += '<td>' + (countE + 1) + '</td>';
           stre += '<td>051' + myJson[i].student_student_id + '</td>';
     if(myJson[i].reg_roll_no<0){
               stre += '<td></td>';
          }else{
               stre += '<td>' + myJson[i].reg_roll_no + '</td>';
          }
          stre += '<td>' + myJson[i].student_name + '</td>';
          stre += '<td></td>';
          stre += '<td></td>';
          stre += '</tr>';
          countE++;

        }
      }

      if (countF != 0) {
        document.getElementById('list-fifth').innerHTML = str;
      } else {
        document.getElementById('fifthdiv').style.display = 'none';
      }

      if (countE != 0) {
        document.getElementById('list-eighth').innerHTML = stre;
      } else {
        document.getElementById('eighthdiv').style.display = 'none';
      }


    }
  });
</script>


</html>