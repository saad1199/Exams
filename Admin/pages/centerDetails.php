<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Simple Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="layout" content="main" />

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script src="../js/jquery/jquery-1.8.2.min.js" type="text/javascript"></script>
    <link href="../css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />

    <style>
        #collapse1 {
            overflow-y: scroll;
            overflow-x: scroll;
            height: 500px;
        }
      
    </style>

    <script>



    </script>
</head>

<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="dashboard.html" class="brand"><i class="icon-leaf">Clean Dashboard</i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">TRY ME!
                                <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="dashboard.html">Dashboard</a>
                                </li>
                                <li>
                                    <a href="form.html">Form</a>
                                </li>
                                <li>
                                    <a href="custom-view.html">Custom View</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">CHANGE NAV BAR
                                <b class="caret hidden-phone"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="demo-horizontal-nav.html">Horizontal</a>
                                </li>
                                <li>
                                    <a href="demo-horizontal-fixed-nav.html">Horizontal Fixed</a>
                                </li>
                                <li>
                                    <a href="demo-vertical-nav.html">Vertical</a>
                                </li>
                                <li>
                                    <a href="demo-vertical-fixed-nav.html">Vertical Fixed</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                    <ul class="nav pull-right">
                        <li>
                            <a href="login.html">Logout</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="body-container">
        <div id="body-content">

            <div class="body-nav body-nav-horizontal body-nav-fixed">
                <div class="container">
                <ul>
                                
                                <li>
                                    <a href="dashboard.php">
                                        <i class="icon-dashboard icon-large"></i> Dashboard
                                    </a>
                                </li>
                                <li>
                                    <a href="centersSummary.php">
                                        <i class="icon-list-alt icon-large"></i> Center Report
                                    </a>
                                </li>
                                <li>
                                    <a href="allocatedCenterDetails.php">
                                        <i class="icon-list-alt icon-large"></i> Center Details
                                    </a>
                                </li>
                                <li>
                                    <a href="centerDetails.php">
                                        <i class="icon-list-alt icon-large"></i> Institute Report
                                    </a>
                                </li>
                                <li>
                                    <a href="editStudent.php">
                                        <i class="icon-search icon-large"></i> Search / Edit
                                    </a>
                                </li>
                                <li>
                                    <a href="challanUpdate.php">
                                        <i class="icon-cloud icon-large"></i> Challan Entry
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="icon-cogs icon-large"></i> Settings
                                    </a>
                                </li>
                            </ul>
                </div>
            </div>


            <section class="nav-page">
                <div class="container">
                    <div class="row">
                        <div class="span7">
                            <header class="page-header">
                                <h3>Institute wise<br />
                                    <small>Registered Student List</small>
                                </h3>
                            </header>
                        </div>
                        <div class="span9">
                            <ul class="nav nav-pills">
                                <li>
                                    <a href="#" rel="tooltip" data-placement="left" title="Create New Person">
                                        <i class="icon-group icon-large"></i>
                                    </a>

                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <section class="page container">
                <div class="row">
                    <div class="span4">
                        <div class="blockoff-right">
                            <input type="text" id="search-text" placeholder="Search" />
                            <ul id="inst-list" class="nav nav-list" style=" height: 700px; overflow: auto">
                            </ul>
                        </div>
                    </div>


                    <div class="span12">
                        <div  class="box" style="display:block;">
               
                            <div class="box-header">
                                <i class="icon-user icon-large"></i>
                                <h5 >Search (Name/ CNIC/ Father Name/ Contact No.) </h5>
                            </div>
                            <div class="box-content">
                            <input id="uni-search-text" type="text" placeholder="Search Student"><br><button class="btn btn-info" onclick="universalSearch()">Search</button>
                            </div>
                        </div>
                    </div>


                    <div class="span12">
                        <div id="upper-table" class="box" style="display:block;">
                    
                            <div class="box-header">
                                <i class="icon-user icon-large"></i>
                                <h5 id="table-header">Overview</h5>
                            </div>
                            <div class="box-header" style="margin-bottom:4px;">
                               
                                <h5><input onchange="toggleLock(this)" class="checkbox" id="insLockCheck" type="checkbox" value=""> Lock / Unlock Editing</h5>
                           
                       
                            </div>
                            <div class="box-content box-table">
                                <table class="table table-hover tablesorter">
                                    <thead>
                                        <tr>
                                            <th class="bg-info text-white">Class 5th Male</th>
                                            <th class="text-white" style="background-color:#356894;">Class 5th Female</th>
                                            <th class="bg-info text-white">Class 8th Male</th>
                                            <th class="text-white" style="background-color:#356894;">Class 8th Female</th>
                                            <th class="bg-danger text-white">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body-ins">
                                    </tbody>
                                </table>
                            </div>
                        </div>








                        <div id="" class="box">
                            <div class="box-header">
                                <i class="icon-user icon-large"></i>
                                <h5 id="table-header">Registered Student Details</h5>
                             
                            </div>

                            <div class="box-content box-table">
                           
                                <div id="collapse1" class="panel-collapse collapse">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>CNIC</th>
                                                <th>Roll No</th>
                                                <th>Class</th>
                                                <th>DOB</th>
                                                <th>Gender</th>
                                                <th>Contact</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody id="table-body" style=" height: 700px; overflow:scroll">
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div style="width:100%; text-align:center; " id="page-btns"></div>

                    </div>
                </div>
            </section>


        </div>
    </div>

    <div id="spinner" class="spinner" style="display:block;">
        Loading&hellip;
    </div>

    <footer class="application-footer">
        <div class="container">
            <p>Application Footer</p>
            <div class="disclaimer">
                <p>This is an example disclaimer. All right reserved.</p>
                <p>Copyright © keaplogik 2011-2012</p>
            </div>
        </div>
    </footer>

    <script src="../js/bootstrap/bootstrap-transition.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-alert.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-modal.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-dropdown.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-scrollspy.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-tab.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-tooltip.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-popover.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-button.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-collapse.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-carousel.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-affix.js" type="text/javascript"></script>
    <script src="../js/bootstrap/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="../js/jquery/jquery-tablesorter.js" type="text/javascript"></script>
    <script src="../js/jquery/jquery-chosen.js" type="text/javascript"></script>
    <script src="../js/jquery/virtual-tour.js" type="text/javascript"></script>
    <script type="text/javascript">
        //paging buttons variable

        var page_b = 0;
        var page_mul = 500;
        var page_f = 500;



function toggleLock(x){

if(x.checked){
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../Engine/admin_lockInstitute.php?token=<?php echo $_SESSION['session_token']; ?>&emis='+ x.value);
                xhr.setRequestHeader('Content-Type', 'application/text');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                            alert("Status - LOCKED");
                    }else{
                        alert("Unknown Error");
                    }
                }
}else{
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '../Engine/admin_unlockInstitute.php?token=<?php echo $_SESSION['session_token']; ?>&emis='+ x.value);
                xhr.setRequestHeader('Content-Type', 'application/text');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                            alert("Status - UNLOCKED");
                    }else{
                        alert("Unknown Error");
                    }
                }
}

}



        function universalSearch(){
            var toSearch=document.getElementById('uni-search-text').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../Engine/admin_universalSearch.php?token=<?php echo $_SESSION['session_token']; ?>&tosearch='+toSearch);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                        myJson = JSON.parse(myJson);

                      

                        var code = "";
                        for (var i = 0; i < myJson.length; i++) {


                            code += '<tr>';
                            code += '<td>' + (i + 1) + '</td>';
                            code += '<td>' + myJson[i].student_name + '</td>';
                            code += '<td>' + myJson[i].student_b_form + '</td>';
                            code += '<td>' + myJson[i].reg_roll_no + '</td>';
                            code += '<td>' + myJson[i].cls_name + '</td>';
                            code += '<td>' + myJson[i].student_date_of_birth + '</td>';
                            code += '<td>' + myJson[i].gender_det + '</td>';
                            code += '<td>0' + myJson[i].student_contact_number + '</td>';
                            code += '<td><a href="#" class="btn btn-info">View</a></td>';
                            code += '</tr>';
                        }

                        document.getElementById('table-body').innerHTML = code;
                       
                        document.getElementById('page-btns').innerHTML = "";
                        document.getElementById('table-body-ins').innerHTML = "";
                        document.getElementById('upper-table').style.display="none";
                        document.getElementById('table-header').innerHTML = " Searched (Registered Students)";


                    }
                }
            



        }





        $.ajax({
            url: '../Engine/admin_getInstitutes.php',
            data: {
                "token": "<?php echo $_SESSION['session_token']; ?>"
            },
            type: "GET",
            async: false,
            dataType: "json",
            success: function(myJson) {
                var code = "";

                code += '<li class="nav-header">ALL</li>';
                code += '  <li class="active">';
                code += '          <a id="view-all" href="#" name="ALL" onclick="makeStudentRequest(this,0)">';
                code += ' <i class="icon-chevron-right pull-right"></i>';
                code += '     <b>View All</b>';
                code += '              </a>';
                code += '          </li>';
                code += '';

                code += '<li class="nav-header">Institutes</li>';
                code += '  <li class="active">';
                code += '          ';
                code += '          </li>';


                for (var i = 0; i < myJson.length; i++) {


                    code += '    <li>';
                    code += '        <a href="#" class="inst_venom" name="' + myJson[i].inst_id + '" onclick="makeStudentRequest(this,0)">';
                    code += '          <i class="icon-chevron-right pull-right"></i>';
                    code += (i + 1) + ". " + myJson[i].inst_name;
                    code += '       </a>';
                    code += '                  </li> ';
                }

                document.getElementById('inst-list').innerHTML = code;

            }
        });

        var current_ = null;

        function makeStudentRequest(x, a) {
            var pagingbtns = '<button class="btn btn-info" value="" onclick="makeRequestBackward();">< PREVIOUS </button> <button class="btn btn-success" value="" onclick="makeRequestForward();">NEXT ></button><br><h5>Page ' + ((page_f / page_mul) + 1) + ' of 87</h5>';
            var xhr = new XMLHttpRequest();

            if (x.name == "ALL") {
                current_ = x;
                page_f = a;
                xhr.open('GET', '../Engine/admin_getStudents.php?token=<?php echo $_SESSION['session_token']; ?>&emis=ALL&slimit=' + a);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                        myJson = JSON.parse(myJson);

                        var code = "";
                        for (var i = 0; i < myJson.length; i++) {


                            code += '<tr>';
                            code += '<td>' + (i + 1) + '</td>';
                            code += '<td>' + myJson[i].student_name + '</td>';
                            code += '<td>' + myJson[i].student_b_form + '</td>';
                            code += '<td>' + myJson[i].reg_roll_no + '</td>';
                            code += '<td>' + myJson[i].cls_name + '</td>';
                            code += '<td>' + myJson[i].student_date_of_birth + '</td>';
                            code += '<td>' + myJson[i].gender_det + '</td>';
                            code += '<td>0' + myJson[i].student_contact_number + '</td>';
                            code += '<td><a href="#" class="btn btn-info">View</a></td>';
                            code += '</tr>';
                        }

                        document.getElementById('table-body').innerHTML = code;
                        document.getElementById('page-btns').innerHTML = pagingbtns;
                        document.getElementById('table-body-ins').innerHTML = "";
                        document.getElementById('upper-table').style.display="none";
                        document.getElementById('table-header').innerHTML = " ALL (Registered Students)";


                    }
                }

            } else {
                document.getElementById('page-btns').innerHTML = "";
                xhr.open('GET', '../Engine/admin_getStudents.php?token=<?php echo $_SESSION['session_token']; ?>&emis=' + x.name);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                        myJson = JSON.parse(myJson);

                        var code = "";
                        var ins_code = "";

                        var mfcount = 0;
                        var mecount = 0;
                        var ffcount = 0;
                        var fecount = 0;
                        var total = 0;


                        for (var i = 0; i < myJson.length; i++) {
                            if (myJson[i].class == 5 && myJson[i].gender_det == "Male") {
                                mfcount++;
                            } else if (myJson[i].class == 5 && myJson[i].gender_det == "Female") {
                                ffcount++;
                            } else if (myJson[i].class == 8 && myJson[i].gender_det == "Male") {
                                mecount++;
                            } else if (myJson[i].class == 8 && myJson[i].gender_det == "Female") {
                                fecount++;
                            }

                            code += '<tr>';
                            code += '<td>' + (i + 1) + '</td>';
                            code += '<td>' + myJson[i].student_name + '</td>';
                            code += '<td>' + myJson[i].student_b_form + '</td>';
                            code += '<td>' + myJson[i].reg_roll_no + '</td>';
                            code += '<td>' + myJson[i].cls_name + '</td>';
                            code += '<td>' + myJson[i].student_date_of_birth + '</td>';
                            code += '<td>' + myJson[i].gender_det + '</td>';
                            code += '<td>0' + myJson[i].student_contact_number + '</td>';
                            code += '<td><a href="editStudent.php?cnic='+myJson[i].student_b_form+'" class="btn btn-info">View</a></td>';
                            code += '</tr>';
                        }

                        total = mecount + mfcount + ffcount + fecount;
                        ins_code = "<tr><td><strong>" + mfcount + "</strong></td><td><strong>" + ffcount + "</strong></td><td><strong>" + mecount + "</strong></td><td><strong>" + fecount + "</strong></td><td><strong>" + total + "</strong></td></tr>";

                        document.getElementById('table-body').innerHTML = code;
                        document.getElementById('table-body-ins').innerHTML = ins_code;
                        document.getElementById('upper-table').style.display="block";
                        document.getElementById('table-header').innerHTML = myJson[0].inst_name + " (Registered Students)";
                       
                xhr.open('GET', '../Engine/admin_getLockStatus.php?token=<?php echo $_SESSION['session_token']; ?>&emis=' + x.name);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                        myJson = JSON.parse(myJson);
                        if(myJson[0].isRegistered==0){
                            document.getElementById('insLockCheck').checked=false;
                            document.getElementById('insLockCheck').value=x.name;
                        }else{
                            document.getElementById('insLockCheck').checked=true;
                            document.getElementById('insLockCheck').value=x.name;
                        }
                   
                    }else{
                        document.getElementById('insLockCheck').disabled=true;
                        document.getElementById('insLockCheck').value=x.name;
                    }
                
                }














                    }
                }
            }
        }










        function makeRequestBackward() {
            if (page_f == 0) {
                makeStudentRequest(current_, 0);
            } else {
                page_f = page_f - page_mul;
                makeStudentRequest(current_, page_f);
            }
        }

        function makeRequestForward() {
            page_f += page_mul;
            makeStudentRequest(current_, page_f);
        }
        document.getElementById('search-text').addEventListener('keyup', function() {

            var searchQuery = this.value;
            var list = document.getElementById('inst-list');
            var items = list.getElementsByTagName('li');
            for (var i = 0; i < items.length; i++) {
                if (items[i].textContent.toLowerCase().indexOf(searchQuery.toLowerCase()) !== -1) {
                    items[i].style.display = 'block';
                } else {
                    items[i].style.display = 'none';
                }
            }
        });
    </script>

</body>

</html>