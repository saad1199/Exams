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
            height: 750px;
        }
    </style>

    <script>

function download_table_as_csv(table_id, separator = ',') {
    
    // Select rows from table_id
    var rows = document.querySelectorAll('table#' + table_id + ' tr');
    // Construct csv
   
    var csv = [];
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        for (var j = 0; j < cols.length; j++) {
       
            // Clean innertext to remove multiple spaces and jumpline (break csv)
            var data = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').replace(/(\s\s)/gm, ' ')
            // Escape double-quote with double-double-quote (see https://stackoverflow.com/questions/17808511/properly-escape-a-double-quote-in-csv)
            data = data.replace(/"/g, '""');
            // Push escaped string
            row.push('"' + data + '"');
        }
        csv.push(row.join(separator));
    }
    var csv_string = csv.join('\n');
    // Download it
    var filename = 'export_' + table_id + '_' + new Date().toLocaleDateString() + '.csv';
    var link = document.createElement('a');
    link.style.display = 'none';
    link.setAttribute('target', '_blank');
    link.setAttribute('href', 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv_string));
    link.setAttribute('download', filename);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}


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
                                <h3>Allocated Center wise<br />
                                    <small>Registered Student List (Center wise)</small>
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










                        <div id="" class="box">
                            <div class="box-header" style="background-color:red;">
                                <i class="icon-user icon-large"></i>
                                <h5 id="table-header">Center Allocation Summary</h5>
                                <a href="#" onclick="download_table_as_csv('centerTable',',');"> &nbsp;&nbsp;Download as CSV</a>
                            </div>

                            <div class="box-content box-table">
                           
                                <div id="collapse1" class="panel-collapse collapse">
                                    <table class="table table-bordered" id="centerTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <!-- <th>Status</th> -->
                                                <th>Institute Name</th>
                                                <th>5th Male</th>
                                                <th>5th Female</th>
                                                <th>Total 5th</th>

                                                <th>8th Male</th>
                                                <th>8th Female</th>
                                                <th>Total 8th</th>

                                                <th>5th(ME)</th>
                                                <th>8th(ME)</th>

                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody id="table-body" style=" height: 1000px; overflow:scroll">
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                     

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
       


var serial=1;

        function buildCenter(x,name,count) {
              var xhr = new XMLHttpRequest();
                xhr.open('GET', '../Engine/admin_getCenterStudents.php?token=<?php echo $_SESSION['session_token'];?>&emis='+x);
                xhr.setRequestHeader('Content-Type', 'application/json');
                xhr.send();
                xhr.async=false;

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        
                        myJson = xhr.response;
                        myJson = JSON.parse(myJson);
                     

                        var mfcount = 0;
                        var mecount = 0;
                        var ffcount = 0;
                        var fecount = 0;
                        var total = 0;
                        var ikhfifth =0;
                    var ikheighth=0;
                    var totalFCount =0;
                    var totalECount =0;

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


                        if(myJson[i].cls_name=="5th (Ikhlaqiat)"){
                                ikhfifth++;
                        }else if (myJson[i].cls_name=="8th (Ikhlaqiat)"){
                                    ikheighth++;
                        }

                        }
                  
                        total = mecount + mfcount + ffcount + fecount;
                        totalECount= mecount + fecount;
                        totalFCount =mfcount +ffcount;

                        var progressbar='<div class="progress bg-dark"><div class="progress bar bar-success " role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div></div>';
                        document.getElementById('table-body').innerHTML += "<tr><td>"+serial+"</td><td>"+name+"("+x+")</td><td>" + mfcount + "</td><td>" + ffcount + "</td>   <td><strong>" + totalFCount + "</strong></td> <td>" + mecount + "</td><td>" + fecount + "</td> <td><strong>" + totalECount + "</strong></td> <td>"+ikhfifth+"</td> <td>"+ikheighth+"</td> <td><strong>" + total + "</strong></td></tr>";
                serial++;
                        
                }
            }
        }





        $.ajax({
            url: '../Engine/admin_getCenters.php',
            data: {
                "token": "<?php echo $_SESSION['session_token']; ?>"
            },
            type: "GET",
            async: false,
            dataType: "json",
            success: function(myJson) {
                var code = "";
                for (var i = 0; i < myJson.length; i++) {
                   
                    buildCenter(myJson[i].pins_id,myJson[i].pins_name,i);
                   
                }
            }
        });

      
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