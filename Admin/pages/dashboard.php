<?php session_start();

if (!isset($_SESSION['inst_code'])) {
    header('location:../Pages/index.html');
    exit();
}

if ($_SESSION['role'] != 2) {
    header('location:../Pages/index.html');
    exit();
}


?>
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
    </style>
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

                <a href="dashboard.html" class="brand"> Examinations - Federal Directorate of Education</i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav">

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Menu
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


                    </ul>
                    <ul class="nav pull-right">
                        <li>
                            <a href="logout.php">Logout</a>
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


            <section class="nav nav-page">
                <div class="container">
                    <div class="row">
                        <div class="span7">
                            <header class="page-header">

                                <h3><img src="../images/govw.png" width="40"> Administrator<br />
                                </h3>
                            </header>
                        </div>
                        <div class="page-nav-options">
                            <div class="span9">
                                <ul class="nav nav-pills">
                                    <li>
                                        <a href="#"><i class="icon-home icon-large"></i></a>
                                    </li>
                                </ul>
                                <!-- <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#"><i class="icon-home"></i>Home</a>
                            </li>
                            <li><a href="#">Maps</a></li>
                            <li><a href="#">Admin</a></li>
                        </ul> -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="page container">
                <div class="row">
                    <div class="span16">
                        <div class="box">
                            <div class="box-header">
                                <i class="icon-bookmark"></i>
                                <h5>Overview</h5>
                            </div>
                            <div class="box-content">

                                <table style="width:100%; text-align: left;">
                                    <tr>
                                        <td>
                                            <h4><i class="icon-user icon-large "></i> Registered<br>
                                                <h2 class="bg-success text-white" id="text-totalCount">0</h2>
                                            </h4>
                                        </td>
                                        <td>
                                            <h4><i class="icon-user icon-large"></i> Class V<br>
                                                <h2 class="bg-info text-white" id="text-totalFifth">0</h2>
                                            </h4>
                                        </td>
                                        <td>
                                            <h4><i class="icon-user icon-large"></i> Class VIII<br>
                                                <h2 class="bg-info text-white" id="text-totalEighth">0</h2>
                                            </h4>
                                        </td>
                                        <td>
                                            <h4><i class="icon-user icon-large"></i> Private<br>
                                                <h2 class="bg-danger text-white" id="text-totalPrivate">0</h2>
                                            </h4>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="page container">

                <div class="row">
                    <div class="span16">
                        <div class="box">
                            <div class="box-header">
                                <i class="icon-bar-chart"></i>
                                <h5>Total Revenue</h5>
                            </div>
                            <div style="text-align:left;">
                                <h1 id="totalRev">&nbsp; Total Revenue : Rs. 0/-</h1>
                                <h4 id="expectedRev">&nbsp; Expected Revenue: Rs. 0/-</h4>
                                <h4 id="clearingRev">&nbsp; To be Cleared : Rs. 0/-</h4>
                            </div>
                            <div class="box-content">
                                <div id="piechart-revenue"></div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="span8">
                    <div class="box">
                        <div class="box-header">
                            <i class="icon-book"></i>
                            <h5>Password Recovery</h5>
                        </div>
                        <div class="box-content">
                           
                                <p>Enter Details to get Password</p>
                                <div class="input-prepend">
                                    <input class="span4" type="text" placeholder="CNIC or EMIS" id="query">
                                </div><br><br>
                                <p> <input class="span1" type="checkbox"  id="isInst" />Is Institute ?</p><br>
                               
                                <button type="submit" class="btn btn-primary" id="submitForPassword" onClick="recover()">
                                    <i class="icon-ok"></i>
                                    Recover Password
                                </button><br><br>
                                <p id="passDIV"></p>
                            
                                <br><br>
                              
                           
                        </div>

                    </div>
                </div>



                <div class="row">
                    <div class="span16">
                        <div class="box">
                            <div class="box-header">
                                <i class="icon-bar-chart"></i>
                                <h5>Registered Students</h5>
                            </div>
                            <div class="box-content">
                                <div id="piechart"></div>
                            </div>
                        </div>
                    </div>
                </div>














                <div class="row">
                    <div class="span16">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header">
                                <i class="icon-table"></i>
                                <h5>Delete Requests</h5>
                            </div>
                            <div class="box-content box-table">
                                <div style="max-height: 400px; overflow: auto;">
                                    <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                        <thead>
                                            <tr>
                                                <th>Student Details</th>
                                                <th>Institute Initiated</th>
                                                <th>Reason</th>
                                                <th class="td-actions"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="request_table_body">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">


                    <div class="span16">
                        <div class="box pattern pattern-sandstone">
                            <div class="box-header">
                                <i class="icon-table"></i>
                                <h5>
                                    Complaint Management System Requests
                                </h5>
                            </div>
                            <div class="box-content box-table">
                                <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                    <thead>
                                        <tr>
                                            <th>Complain Date</th>
                                            <th>Complain Institute</th>
                                            <th>Complain Description</th>
                                            <th>Complain Reply</th>
                                            <th class="td-actions"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="requestComplain_table_body">
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </section>
        </div>
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
        $(function () {
            $('#sample-table').tablesorter();
            $('#datepicker').datepicker();
            $(".chosen").chosen();
        });
    </script>

</body>

<script>

function recover(){

            var toSearch=document.getElementById('query').value;
            var isInst =document.getElementById('isInst').checked;
            var tosend=-1;
            if(isInst==true){
                    toSend=1;
            }else{
                toSend=0;
            }
           
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '../Engine/admin_getPassword.php?token=<?php echo $_SESSION['session_token']; ?>&query='+toSearch+'&isInst='+toSend);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        myJson = xhr.response;
                        myJson = JSON.parse(myJson);
                        if(isInst==true){
                            document.getElementById('passDIV').innerHTML='Password is : '+myJson[0].icred_login_special;
             
                        }else{
                            document.getElementById('passDIV').innerHTML='Password is : '+myJson[0].student_login_special;
             
                        }
                        }
                }
            }

    $.ajax({
        url: '../Engine/admin_getDeleteRequests.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {

            var code = "";

            for (var i = 0; i < myJson.length; i++) {
                code += "<tr>";
                code += '<td>' + myJson[i].student_name + '/' + myJson[i].student_b_form + '</td>';
                code += '<td>' + myJson[i].inst_name + '</td>';
                code += '<td>' + myJson[i].del_reason_user + '</td>';
                code += '<td class="td-actions">';
                code += '<form method="POST" action="../Engine/admin_deleteStudent.php?token=<?php echo $_SESSION['session_token']; ?>&sid=' + myJson[i].del_req_std + '&did=' + myJson[i].del_req_id + '">';
                code += '<input type="text" placeholder="Reason" value="Approved" name="reason"/><br><button type="submit" name="del_approve_submit" class="btn btn-small btn-info ">';
                code += '<i class="btn-icon-only icon-ok"></i></button>';
                code += '&nbsp;&nbsp;&nbsp;';
                code += '<button type="submit" name="del_reject_submit" class="btn btn-small btn-danger ">';
                code += '<i class="btn-icon-only icon-remove"></i></button>';
                code += '</form>';
                code += '</td>';

                code += "</tr>";

            }


            document.getElementById('request_table_body').innerHTML = code;

        }


    });



    $.ajax({
        url: '../Engine/admin_getComplaints.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {

            var code = "";

            for (var i = 0; i < myJson.length; i++) {
                code += "<tr>";
                code += '<td>' + myJson[i].complain_date + '</td>';
                code += '<td>' + myJson[i].inst_name + '</td>';
                code += '<td><textarea readonly>' + myJson[i].complain_desc + '</textarea></td>';
                code += '<td class="td-actions">';
                code += '<form method="POST" action="../Engine/admin_replyComplain.php?token=<?php echo $_SESSION['session_token']; ?>&cid=' + myJson[i].complain_id + '">';
                code += '<textarea  placeholder="Reply" value="Approved" name="reason"></textarea><br><button type="submit" name="complain_submit" class="btn btn-small btn-info ">';
                code += '<i class="btn-icon-only icon-ok"></i></button>';
                code += '&nbsp;&nbsp;&nbsp;';

                code += '</form>';
                code += '</td>';

                code += "</tr>";

            }


            document.getElementById('requestComplain_table_body').innerHTML = code;

        }


    });








    var et = 1, ft = 2, pt = 3;
    var expRev, totalRev, clearingRev;


    $.ajax({
        url: '../Engine/admin_getTotalCount.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {
            document.getElementById('text-totalCount').innerHTML = '&nbsp;' + myJson[0].count;
        }
    });





    $.ajax({
        url: '../Engine/admin_getTotalRevenue.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {
            document.getElementById('totalRev').innerHTML = '&nbsp;Total Revenue : Rs. ' + myJson[0].sum + '/-';
            totalRev = parseInt(myJson[0].sum);


        }
    });



    $.ajax({
        url: '../Engine/admin_getExpectedRevenue.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {
            clearingRev = parseInt(myJson[0].sum);
            var t = clearingRev + totalRev;

            document.getElementById('expectedRev').innerHTML = '&nbsp;Expected Revenue : Rs. ' + t + '/-';
            document.getElementById('clearingRev').innerHTML = '&nbsp;To be Cleared Revenue : Rs. ' + clearingRev + '/-';

            google.load('visualization', '1', { 'packages': ['corechart'] });

            google.setOnLoadCallback(drawVisualization);


            function drawVisualization() {
                visualization_data = new google.visualization.DataTable();

                visualization_data.addColumn('string', 'Revenue');

                visualization_data.addColumn('number', 'Rs');

                visualization_data.addRow(['Expexted', t]);

                visualization_data.addRow(['Clearing', clearingRev]);

                visualization = new google.visualization.BarChart(document.getElementById('piechart-revenue'));

                visualization.draw(visualization_data, { title: 'Registered Students', height: 360 });

            }



        }
    });


    $.ajax({
        url: '../Engine/admin_getFifthCount.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {
            document.getElementById('text-totalFifth').innerHTML = '&nbsp;' + myJson[0].count;
            ft = parseInt(myJson[0].count);
        }
    });


    $.ajax({
        url: '../Engine/admin_getEighthCount.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {
            document.getElementById('text-totalEighth').innerHTML = '&nbsp;' + myJson[0].count;
            et = parseInt(myJson[0].count);
        }
    });


    $.ajax({
        url: '../Engine/admin_getPrivateCount.php',
        data: {
            "token": "<?php echo $_SESSION['session_token']; ?>"
        },
        type: "GET",
        async: false,
        dataType: "json",
        success: function (myJson) {
            document.getElementById('text-totalPrivate').innerHTML = '&nbsp;' + myJson[0].count;
            pt = parseInt(myJson[0].count);
        }
    });


    google.load('visualization', '1', { 'packages': ['corechart'] });

    google.setOnLoadCallback(drawVisualization);


    function drawVisualization() {
        visualization_data = new google.visualization.DataTable();

        visualization_data.addColumn('string', 'Registrations');

        visualization_data.addColumn('number', 'Registered');

        visualization_data.addRow(['8th Class', et]);

        visualization_data.addRow(['5th Class', ft]);

        visualization_data.addRow(['Private', pt]);


        visualization = new google.visualization.PieChart(document.getElementById('piechart'));

        visualization.draw(visualization_data, { title: 'Registered Students', height: 360 });

    }


</script>



</html>