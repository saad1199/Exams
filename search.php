<?php session_start(); 
if (!isset($_SESSION['session_token']) || !isset($_SESSION['inst_code'])) {
  header('location:login.html?status=EXPIRED');
}
?>
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
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <style>
    /* for all screens */
    #info {
      display: none;
    }

    /* only when orientation is in portrait mode */
    @media all and (orientation:portrait) {
      #info {
        display: block;
      }
    }
  </style>


  <script>
    function searchTable() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("searchField");
      filter = input.value.toUpperCase();
      table = document.getElementById("student_tbody");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>

  

</head>


<script>
  function PrintElem(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = '';
    document.body.innerHTML += "<style> #list-items{font-size:9px;} #vbtn{display:none;} #ebtn{display:none;} .footer {opacity:0.6; position: sticky;left: 0;bottom: 0;width: 100%;text-align: center;}  </style>";
    document.body.innerHTML += printContents;
    document.body.innerHTML += '<h5 class="footer" style="font-size:7px;">System Designed by Saad Sadiq IT-FDE Web generated Report / Generated on ' + new Date().toLocaleString() + '<h5>';
    window.print();

    document.body.innerHTML = originalContents;
  }

  function Print() {
    PrintElem("list-items");

  }
</script>

<script>
       $(function() {
    $(".preload").fadeOut(2000, function() {
        $(".page").fadeIn(1000);        
    });
});



</script>


<body>
   


<div id="my_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Delete Student</h4>
      </div>
      <div class="modal-body">
        <p id="">Tell us why you want to delete this student ?</p>
        <form action="Engine/rs_request_delete.php" method="post">
        <input hidden type="text" name="stdId" value=""/>
        <input disabled type="text" name="stdName" value=""/><br><br>
        
        <input required placeholder="Reason" type="textarea" name="stdReason"/><br><br>
        <input type="checkbox" required> &nbsp;I agrees that, FDE shall not be responsible for any data loss/change of center, if requested student is deleted. <br><br>
<input class="btn btn-danger" type="submit" value="Submit" />
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




<div id="my_modal_center" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Student Center/Subject/Class</h4>
      </div>
      <div class="modal-body">
        <p id="">Federal Directorate of Education is not responsible for any data loss during changing center.</p>
        <h3 class="blink_me text-danger">Please Note: To change subject only, Select same center</h3>
        <form action="Engine/rs_request_changecenter.php" method="post">
        <input hidden type="text" name="stdId" value=""/>
        <input disabled type="text" name="stdRoll" value=""/><br><br>
      
        <input type="checkbox" id="subOnly" name="subOnly" onclick="checkSubOnly"> Change Subject Only<br>
        <br>
        <select  class="form-select mb-3" placeholder="Class/Subject Category" type="select" name="subcat" id="subcat"></select><br><br>
        <select  class="form-select mb-3" placeholder="Select Center" type="select" name="centers" id="centers"></select><br><br>
      
        <input type="checkbox" required> &nbsp;I agrees that, FDE shall not be responsible for any data loss/change of center, if requested student is deleted. <br><br>
        <input class="btn btn-danger" type="submit" value="Submit" />
        </form>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



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
            <h2 class="mb-0 p-1">Registered Students</h2>
          </div>
        </header>
        <!-- Page Header-->

        <section class="tables">
          <div class="container-fluid">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="card mb-0">
                  <div class="card-header  bg-dark text-white">
                    <div class="card-close">
                      <div class="dropdown">
                        <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                        <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" onClick="Print()"> <i class="fas fa-cog"></i>Print</a></div>
                      </div>
                    </div>
                    <h3 class="h4 mb-0 "> <img src="img/govw.png" width="40">&nbsp;&nbsp;&nbsp;All Registered Students</h3><br><br>
                    <div class="alert alert-success" id="success-alert" style="display:none"></div>
                    <div class="alert alert-danger" id="danger-alert" style="display:none"></div>
                    
                    <div class="alert alert-danger hidden-lg hidden-mg" id="info"><strong>Rotate Mobile Screen !</strong></div>
                    <input type="text" id="searchField" onkeyup="searchTable()" placeholder="Search here!">
                  </div>
                  <div class="card-body" id="list-items">
                    <div class="table-responsive">
                      <table class="table mb-0 table-hover" style="text-align:left;" id="student_tbody">
                      </table>
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

function checkSubOnly(x){
  if(x.checked){
        alert("Yes");
      }
}

$("#subOnly").change(function() {
  if(this.checked){
       document.getElementById("centers").disabled=true;
       document.getElementById("centers").style.display='none';
  }else{
    document.getElementById("centers").disabled=false;
    document.getElementById("centers").style.display='block';
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
    success: function(myJson) {

      var xcode = "";


      xcode += '<tbody>';

      for (var i = 0; i < myJson.length; i++) {
        
                  xcode += '<tr>';
          
    

        //_____________________________STUDENT LOOP_________________________________

        xcode+='<td>';
          if(myJson[i].isPaid==0){
                  xcode += '<h4 style="padding:3px; background-color:#ab2027; color:white">Payment Not Clear</h4>';
          }else{
                  xcode += '<h4 style="padding:3px; background-color:#34913f; color:white">Payment Verified</h4>';
          }
        xcode+='</td>';
        xcode += '<td class="hidden-sm" style="width:15%;"><img class="shadow-0 img-fluid hidden-sm"  src="uploads-new/'+myJson[i].student_institute_inst_id+'/'+myJson[i].student_img+'"/></td>';
        xcode += '<td>';
        xcode += '<div style="width:100%;">';
        xcode += '<table class="table mb-0 table-hover no-wrap"><tbody>';
        xcode += '<tr style="line-height:10px;"><th>Student Name</th><td class="border-bottom-0">' + myJson[i].student_name + '</td></tr>';
        xcode += '<tr style="line-height:10px;"><th>Father Name</th><td class="border-bottom-0">' + myJson[i].student_father_name + '</td></tr>';
        xcode += '<tr style="line-height:10px;"><th>Class</th><td class="border-bottom-0">' + myJson[i].class + 'th</td></tr>';
        xcode += '<tr style="line-height:10px;"><th>Subject Category</th><td class="border-bottom-0">' + myJson[i].cls_name + '</td></tr>';
        xcode += '<tr style="line-height:10px;"><th>Date of Birth</th><td class="border-bottom-0">' + myJson[i].student_date_of_birth + '</td></tr>';
        xcode += '<tr style="line-height:10px;"><th>CNIC/B.Form</th><td class="border-bottom-0">' + myJson[i].student_b_form + '</td></tr>';
        xcode += '<tr style="line-height:10px;"><th></th><td><a id="ebtn" class="btn btn-info text-white w-100" href="edit-ins-student.php?bform=' + myJson[i].student_b_form + '&name=' + myJson[i].student_name + '&rollno=' + myJson[i].reg_roll_no + '&sid=' + myJson[i].student_id + '"/>Edit</a></td><td><a class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-s-name="'+myJson[i].student_name+'" data-s-id="'+myJson[i].student_id+'" data-bs-target="#my_modal" >Delete</a></td><td><a class="btn btn-danger text-white w-100" data-bs-toggle="modal" data-s-roll="'+myJson[i].reg_roll_no+'" data-s-id="'+myJson[i].student_id+'" data-bs-target="#my_modal_center" >Change Class/Center</a></td></tr>';
        //href="Engine/rs_request_delete.php?bform=' + myJson[i].student_b_form + '&name=' + myJson[i].student_name + '&rollno=' + myJson[i].reg_roll_no + '&sid=' + myJson[i].student_id + '"
        xcode += '</div></tbody></table>';
        xcode += '</td>';

        //_____________________________STUDENT LOOP_________________________________
        xcode += '</tr>';
      }

      xcode += '</tbody>';
      document.getElementById('student_tbody').innerHTML = xcode;


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

  var status = getUrlParameter('status');
  if (status) {
    if (status == "ERROR") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Cannot DELETE Student Something went wrong LOG REPORTED- Please Report IT Section Immediately";
    }
    if (status == "BAD") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ERROR !</strong> Cannot Update Student Center/Subject/Class. Something went wrong";
    }
    if (status == "SECURITY_ERROR") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>SECURITY ERROR !</strong> Cannot DELETE Student Something went wrong LOG REPORTED- Please Report IT Section Immediately";
    }
    if (status == "OK") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>SUCCESS !</strong> DELETE Request has Successfully Initiated";
    }
     if (status == "OK_ALL") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>SUCCESS !</strong> Updated Successfully";
    }
    if (status == "OK_CENTER") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>SUCCESS !</strong> Center updated successfully";
    }
    if (status == "OK_SUBJECT") {
      document.getElementById('success-alert').style.display = "block";
      document.getElementById('success-alert').innerHTML = "<strong>SUCCESS !</strong> Subjects updated successfully";
    }
    if (status == "ALREADY") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>ALREADY SUBMITTED !</strong> Request for Deletion ALREADY POSTED to FDE HQ - Please wait for response ";

    }
    if (status == "LOCK") {
      document.getElementById("danger-alert").style.display = "block";
      document.getElementById("danger-alert").innerHTML = "<strong>SORRY !</strong> YOU HAVE SUBMITTED DATA ALREADY CAN'T EDIT / REGISTER / DELETE STUDENTS";
    }
    
  }




</script>
<script type="text/javascript">  

$('#my_modal').on('show.bs.modal', function(e) {
    var sid = $(e.relatedTarget).data('s-id');
    var sname = $(e.relatedTarget).data('s-name');
    $(e.currentTarget).find('input[name="stdId"]').val(sid);
    $(e.currentTarget).find('input[name="stdName"]').val(sname);
});




$('#my_modal_center').on('show.bs.modal', function(e) {
    var sid = $(e.relatedTarget).data('s-id');
    var sroll = $(e.relatedTarget).data('s-roll');
    
    $.ajax({
    url: 'Engine/getSubjectCategory.php',
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




    $(e.currentTarget).find('input[name="stdId"]').val(sid);
    $(e.currentTarget).find('input[name="stdRoll"]').val(sroll);
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

    </script>  
</html>