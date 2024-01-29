<?php
session_start();

if(!isset($_SESSION['_____AUTHENTICATED'])){
  header('location: main.html');
}

include 'Engine/dbutils.php';
$conn = OpenCon();

$subject = getSubjectFromID($_SESSION['_____SUB_____ID'],$conn);

function convertNumberToWord($num = false)
{
   $num = str_replace(array(',', ' '), '', trim($num));
   if (!$num) {
      return false;
   }
   $num = (int) $num;
   $words = array();
   $list1 = array(
      '', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
      'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
   );
   $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
   $list3 = array(
      '', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
      'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
      'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
   );
   $num_length = strlen($num);
   $levels = (int) (($num_length + 2) / 3);
   $max_length = $levels * 3;
   $num = substr('00' . $num, -$max_length);
   $num_levels = str_split($num, 3);
   for ($i = 0; $i < count($num_levels); $i++) {
      $levels--;
      $hundreds = (int) ($num_levels[$i] / 100);
      $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
      $tens = (int) ($num_levels[$i] % 100);
      $singles = '';
      if ($tens < 20) {
         $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '');
      } else {
         $tens = (int)($tens / 10);
         $tens = ' ' . $list2[$tens] . ' ';
         $singles = (int) ($num_levels[$i] % 10);
         $singles = ' ' . $list1[$singles] . ' ';
      }
      $words[] = $hundreds . $tens . $singles . (($levels && (int) ($num_levels[$i])) ? ' ' . $list3[$levels] . ' ' : '');
   } //end for loop
   $commas = count($words);
   if ($commas > 1) {
      $commas = $commas - 1;
   }
   return implode(' ', $words);
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
  <link rel="stylesheet" href="css/style.green.css" id="theme-stylesheet">
  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="css/custom.css">
  <!-- Favicon-->
  <link rel="shortcut icon" href="img/favicon.ico">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script>
     
//      $('body').on('keydown', 'input, select', function(e) {
//     if (e.key === "Enter") {
//           .find('.fmarks')
//         var self = $(' #stdBody tr'), form = self.parents('table:eq(0)'), focusable, next;
//         focusable = form.find('input,a,select,button,textarea').filter(':visible');
//         next = focusable.eq(focusable.index(this)+1);
//         if (next.length) {
//             next.focus();
//         } else {
//             form.submit();
//         }
//         return false;
//     }
// });
 </script>
 
 
 
  <style>
@media print {
  table,th,td {
    border: 1px;
    line-height: 7px;
    page-break-inside: avoid;

  }
  .table{
    width:50%; font-size:10px;
    text-align:left;
    border-collapse: collapse;
    line-height: 7px;
    page-break-inside: avoid;
  }
  .toHide {
    display: none;
  }
  tfoot{
    text-align:left; 
    font-size:11px;
  }
}
  </style>

</head>
<script>
var a = ['','one ','two ','three ','four ', 'five ','six ','seven ','eight ','nine ','ten ','eleven ','twelve ','thirteen ','fourteen ','fifteen ','sixteen ','seventeen ','eighteen ','nineteen '];
var b = ['', '', 'twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety'];

function inWords (num) {
    if ((num = num.toString()).length > 9) return 'overflow';
    n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
    if (!n) return; var str = '';
    str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
    str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lakh ' : '';
    str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
    str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
    str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) + ' ' : '';
    return str;
}
</script>
<script>
  var sroll="";
  var eroll="";

  $(function() {
    $(".preload").fadeOut(2000, function() {
      $(".page").fadeIn(1000);
    });
  });


  function PrintElem(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '';
    document.body.innerHTML += "<style> input{display:hidden;}  .footer {opacity:0.6; position: sticky;left: 0;bottom: 0;width: 100%;text-align: center;}  </style>";
    document.body.innerHTML += printContents;

    //document.body.innerHTML += '<h5 class="footer" style="font-size:7px;">System Designed by Saad Sadiq IT-FDE Web generated Report / Generated on ' + new Date().toLocaleString() + '<h5>';
    window.print();

    document.body.innerHTML = originalContents;
  }

  function Print() {
    PrintElem("marksTableDiv");

  }


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
          <li class="sidebar-item active"><a class="sidebar-link" href="index.php">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#real-estate-1"> </use>
              </svg>Home </a></li>

        </ul>

        <span class="text-uppercase text-gray-400 text-xs letter-spacing-0 mx-3 px-2 heading">Manage</span>
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
            <h2 class="mb-0 p-1">Examination Progress</h2>
            <div class="progress" id="progress-bar">
                          
                          <div  class="progress-bar " role="progressbar" aria-valuenow="25" style="width: 25%" aria-valuemin="0" aria-valuemax="100">25%</div>
                        </div>
          </div>
        </header>
        <!-- Dashboard Counts Section-->
        <section class="forms">
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12">
                <div class="card">
                  <div class="card-header bg-dark text-white">
                    <div class="card-close">
                    </div>
                    <h3 class="h4 mb-0"><img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;Marking Dashboard</h3><br>
                    <div class="alert alert-success" id="success-alert" style="display:none"></div>
                    <div class="alert alert-danger" id="danger-alert" style="display:none"></div>
                  </div>
                  <div class="card-body">

                    <div class="row">
                      
                      <div class="col-sm-9">
                      <label class="col-sm-3 form-label">Enter Roll Number (Starting Roll Number only)</label>
                        <input required class="form-control" type="text" name="toSearchRollStart" id="toSearchRollStart">
                       <br>
                        <!--<label class="col-sm-3 form-label">Enter Roll Number (Ending)</label>-->
                        <!--<input required class="form-control" type="text" name="toSearchRollEnd" id="toSearchRollEnd">-->
                      </div>
                      <div class="col-sm-9">
                        <br>
                        <button class="btn btn-info text-white" onClick="load()">Get List</button><br><br>
                      </div>
                    </div>

                    <div class="row">
                    <h3 class="text-danger blink_me">Dear User ! Enter Marks very carefully.</h3>
                  
                    </div>
                    <div class="row " id="marksTableDiv">
                      

                    <div style="text-align:center;">
                    <table class="table mt-10" >
                   
                    <thead>
                     <tr><th colspan="4">
                     <h6 style="text-align:left; font-size:10px;" class="">Centralized Annual Examination 2023 FDE</h6>
                     <h6 style="text-align:left; font-size: 11px;" class=""> <?php echo "Award List ".$subject." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"?></h6>
                     <h6 style="text-align:left; font-size: 11px;" class=""> CC <u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "printed on :".date("d/m/Y");?></h6>

                     </th></tr>
                     <tr>
                           <th style="width:10%;">#</th>
                        <th style="width:20%;">Roll Number</th>
                        <th style="width:10%;" class="toHide">Input Marks</th>
                        <th style="width:10%;" class="toHide">ABSENT</th>
                        <th style="width:10%;">Marks Obtained</th>
                        <th style="width:40%;">Marks in words</th>
                        <tr>
                      </thead>
                      <tbody id="stdBody">

                      </tbody>
                      <tfoot>
                        <tr>
                          
                    
                      <td colspan="4" style="text-align:left;">
                      <div>Asst.Head&nbsp;&nbsp;&nbsp;<u>&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>
                        <br><br><br><br>
                        Sub.Examiner<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          </u><br><br><br><br>
                          Head Examiner<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u><div>
</td></tr>
                    </tfoot>
                    </table>

                    </div>
                    </div>

                    <div class="row">
                    <button class="btn btn-info text-white" onClick="Print()">Print as Draft</button>
                    
                   
                    </div>
                    <br>
                    <div class="row">

                    
                    <!--<button class="btn btn-success text-white" onClick="finalSubmit()">Lock &amp; Submit this list</button>-->
                    </div>
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
 
 $('#stdBody').on('keydown', 'input', function (event) {
    if (event.which == 13) {
        event.preventDefault();
        var $this = $(event.target);
        var index = parseFloat($this.attr('data-index'));
        $('[data-index="' + (index + 1).toString() + '"]').focus();
    }
});
 
 
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

 function isEmpty( el ){
      return !$.trim(el.html())
  }
   
  function loadProgress(){
  $.ajax({
            url: 'Engine/getProgressExamMarking.php',
            type: "GET",
            async: true,
            cache: false,
            dataType: "json",
            success: function(myJson) {
             var x = myJson[0].marked.marked;
              var y = myJson[0].total.total;
             
              var percent=(x/y)*100;
              
              document.getElementById('progress-bar').innerHTML='<div id="progress-bar" class="progress-bar " role="progressbar" aria-valuenow="'+percent+'" style="width: '+percent+'%" aria-valuemin="0" aria-valuemax="100">'+percent.toFixed(2)+' %</div>';
                
            }
           
            
        });
}
    
loadProgress();

function finalSubmit(){

  var toProceed=1;
  
  

  
$('#stdBody tr').each(function (){
  

    var inpV=$(this).find('.fmarks').text();
    var isCheck=$(this).find('input[type="checkbox"]').prop("checked");

    if(((inpV=="" || inpV==null) && isCheck==false) || (isCheck==true && inpV !=0)){
          $(this).value="";
          toProceed=0;
          return false;
        }
        
  });

if(toProceed==1){
  var xhr = new XMLHttpRequest();
    xhr.open('GET', 'Engine/ms_updateStudentMarksAsFinal.php?toSearchRollEnd='+eRoll+'&toSearchRollStart='+sRoll+'&token=<?php echo $_SESSION['_____USER_____KEY']; ?>');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                      var myJson = JSON.parse(xhr.response);
                     
                      document.getElementById('stdBody').innerHTML="";
                      sRoll="";
                      document.getElementById("toSearchRollStart").value="";
                      eRoll="";
                      document.getElementById("toSearchRollEnd").value="";

                      alert("Updated");

                    }else{
                        alert("Unknown Error");
                    }
                }
}else{
      alert("Enter Marks Carefully, Check Input Fields or Absent Check");
}

}


function updateMarks(x){

        //get the selected value
        var sid = x.id;
        var marks = x.value;
        //make the ajax call

        if(marks.match(/^[0-9]+$/) == null){
          //alert("Numerics only");
          x.value="";
          return;
        }
        $.ajax({
            url: 'Engine/ms_updateStudentMarks.php',
            data: {
                "token": "<?php echo $_SESSION['_____USER_____KEY']; ?>",
                "marks": marks,
                "stdId": sid
            },
            type: "GET",
            async: false,
            cache: false,
            dataType: "json",
            success: function(myJson) {
                document.getElementById('r'+sid).innerHTML=marks;
                document.getElementById('w'+sid).innerHTML=inWords(marks).toUpperCase();
                loadProgress();
            },
             error: function(jqXHR, textStatus, errorThrown) {
                alert("FAILURE - Fail to record marks, Please login again...");
               
            }
        });
    }
   


function updateAbsent(x){

        //get the selected value
        var sid = x.id;
        var marks = -1;
        //make the ajax call

        $.ajax({
            url: 'Engine/ms_updateStudentMarks.php',
            data: {
                "token": "<?php echo $_SESSION['_____USER_____KEY']; ?>",
                "marks": marks,
                "stdId": sid
            },
            type: "GET",
            async: false,
            cache: false,
            dataType: "json",
            success: function(myJson) {
                document.getElementById('r'+sid).innerHTML='0';
                document.getElementById('w'+sid).innerHTML='ABSENT';
                loadProgress();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("FAILURE - Fail to record marks, Please login again...");
               
            }
        });
    }
   

function load(){

 sRoll=document.getElementById("toSearchRollStart").value;
 //eRoll=document.getElementById("toSearchRollEnd").value;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'Engine/ms_getStudentSeries.php?toSearchRollStart='+sRoll+'&token=<?php echo $_SESSION['_____USER_____KEY']; ?>');
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                      var str = '';
                      var stre='';
                      
                      var myJson = JSON.parse(xhr.response);
                      
                   var countf=0;
                   var counte=0;
                   
                      for (var i = 0; i < myJson.length; i++) {
                          

        if (myJson[i].student.class == "5") {
            countf++;
          str += '<tr>';
          str+='<td>'+countf+'</td><td>'+myJson[i].student.reg_roll_no+'</td><td class="toHide"><input onfocusout="updateMarks(this)" data-index="'+(countf+1)+'" class="inpMarks" id="'+myJson[i].student.reg_roll_no+'" type="text"/></td>';
          
          if(myJson[i].marks.length!=0){
              if(myJson[i].marks[0].marking_marks!=-1){
                str+='<td class="toHide"><input type="checkbox" onclick="updateAbsent(this)" class="inpAbsent" id="'+myJson[i].student.reg_roll_no+'"/></td>';
          str+='<td class = "fmarks" id="r'+myJson[i].student.reg_roll_no+'">'+myJson[i].marks[0].marking_marks+'</td>';
          str+='<td id="w'+myJson[i].student.reg_roll_no+'">'+inWords(myJson[i].marks[0].marking_marks).toUpperCase()+'</td>';
              }else{
          str+='<td class="toHide"><input type="checkbox" checked onclick="updateAbsent(this)" class="inpAbsent" id="'+myJson[i].student.reg_roll_no+'"/></td>';
          str+='<td class = "fmarks" id="r'+myJson[i].student.reg_roll_no+'">0</td>';
          str+='<td id="w'+myJson[i].student.reg_roll_no+'">ABSENT</td>';
              
          }
          }else{
          str+='<td class="toHide"><input type="checkbox" onclick="updateAbsent(this)" class="inpAbsent" id="'+myJson[i].student.reg_roll_no+'"/></td>';
          str+='<td class = "fmarks" id="r'+myJson[i].student.reg_roll_no+'"></td>';
          str+='<td id="w'+myJson[i].student.reg_roll_no+'"></td>';
          }
          
          
          str += '</tr>';
    

        } else if (myJson[i].student.class == "8") {
            counte++;
          stre += '<tr>';
          stre+='<td>'+counte+'</td><td>'+myJson[i].student.reg_roll_no+'</td><td class="toHide"><input onfocusout="updateMarks(this)" data-index="'+(counte+1)+'" class="inpMarks" id="'+myJson[i].student.reg_roll_no+'" type="text"/></td>';
        
        
        if(myJson[i].marks.length!=0){
            
        if(myJson[i].marks[0].marking_marks!=-1){
                stre+='<td class="toHide"><input type="checkbox" onclick="updateAbsent(this)" class="inpAbsent" id="'+myJson[i].student.reg_roll_no+'"/></td>';
          stre+='<td class = "fmarks" id="r'+myJson[i].student.reg_roll_no+'">'+myJson[i].marks[0].marking_marks+'</td>';
          stre+='<td id="w'+myJson[i].student.reg_roll_no+'">'+inWords(myJson[i].marks[0].marking_marks).toUpperCase()+'</td>';
              }else{
          stre+='<td class="toHide"><input type="checkbox" checked onclick="updateAbsent(this)" class="inpAbsent" id="'+myJson[i].student.reg_roll_no+'"/></td>';
          stre+='<td class = "fmarks" id="r'+myJson[i].student.reg_roll_no+'">0</td>';
          stre+='<td id="w'+myJson[i].student.reg_roll_no+'">ABSENT</td>';
              
          }
          }
          else{
          stre+='<td class="toHide"><input type="checkbox" onclick="updateAbsent(this)" class="inpAbsent" id="'+myJson[i].student.reg_roll_no+'"/></td>';
          stre+='<td class = "fmarks" id="r'+myJson[i].student.reg_roll_no+'"></td>';
          stre+='<td id="w'+myJson[i].student.reg_roll_no+'"></td>';
          }                
          stre += '</tr>';
        

        }
                      
                      }   
                      
                      str=str+stre;

                    //   for(var i=0;i<myJson.length;i++){
                    //     str+="<tr>";
                    //     str+='<td>'+myJson[i].reg_roll_no+'</td><td class="toHide"><input onfocusout="updateMarks(this)" class="inpMarks" id="'+myJson[i].reg_roll_no+'" type="text"/></td><td id="r'+myJson[i].reg_roll_no+'"></td><td id="w'+myJson[i].reg_roll_no+'"></td>';
                    //     str+="</tr>";
                    //   }
                      document.getElementById('stdBody').innerHTML=str;
                      //loadMarks();
                      //document.getElementById('r'+roll).innerHTML=myJson[0].marking_marks;
                      
                      
                    }else{
                        alert("Unknown Error. Contact FDE Immediately 051-9262449");
                    }
                }

}

function loadMarks(roll){

  $.ajax({
            url: 'Engine/ms_getStudentMarks.php',
            data: {
                "token": "<?php echo $_SESSION['_____USER_____KEY']; ?>",
                "rollno": roll
            },
            type: "GET",
            async: false,
            cache: false,
            dataType: "json",
            success: function(myJson) {
              if(myJson.length!=0){
                return myJson[0].marking_marks;
              }
               return "";
                //document.getElementById('w'+sid).innerHTML='ABSENT';
                
            }
        });


}

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