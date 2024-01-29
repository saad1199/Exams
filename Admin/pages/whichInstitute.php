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
    window.onafterprint = function() {
      location.reload();
    }


    function PrintElem(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = '';
      document.body.innerHTML += "<style> body{  font-family: 'Montserrat', sans-serif;} .table{text-align:left; width:100%;} .footer {opacity:0.6; position: sticky;left: 0;bottom: 0;width: 100%;text-align: center;}  </style>";
      document.body.innerHTML += printContents;
      window.print();
      document.body.innerHTML = originalContents;
    }

    function Print() {
      PrintElem("report");

    }
    </script>
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
                            <a href="#">
                                <i class="icon-dashboard icon-large"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-calendar icon-large"></i> Schedule
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-map-marker icon-large"></i> Map It
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-tasks icon-large"></i> Widgets
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-cogs icon-large"></i> Settings
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-list-alt icon-large"></i> Forms
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon-bar-chart icon-large"></i> Charts
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
                   


                    


                    <div class="span16">










                        <div id="" class="box">
                            <div class="box-header" style="background-color:red;">
                                <i class="icon-user icon-large"></i>
                                <h5 id="table-header">Center Allocation Summary</h5>
                                <a href="#" onclick="download_table_as_csv('centerTable',',');"> &nbsp;&nbsp;Download as CSV</a>
                           <button onclick="PrintElem('collapse1');" >Print</button>
                           
                            </div>


                            <div class="box-content box-table">
                           
                                <div id="collapse1" class="panel-collapse collapse">
                                    <table class="table table-bordered" id="centerTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                             
                                                <th>Centers Name</th>
                                                <th>Institutes</th>
                                               
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
                var innerTable="";
                var serial=1;
                for (var i = 0; i < myJson.length; i++) {
                var x = myJson[i].pins_id;
                code+="<tr>";
                code+="<td>"+serial+"</td>";
                
                code+="<td>"+myJson[i].pins_name+"</td>";
                code+="<td>";






               
        $.ajax({
            url: '../Engine/admin_getInstitutesByCenter.php',
            data: {
                "token": "<?php echo $_SESSION['session_token']; ?>",
                "centerCode":x
            },
            type: "GET",
            async: false,
            dataType: "json",
            success: function(myJsonX) {
                      
                        code+= '<table style="width:100%;"><thead><th>#</th><th>Institute Code</th><th>Institute Name</th></thead>';
                       
                        
                          code+="<tbody>";
                          var countinner=1;
                        for (var j = 0; j < myJsonX.length; j++) {
                          code+="<tr>";
                          code+="<td>"+countinner+"</td>";
                          code+="<td>"+myJsonX[j].inst_id+"</td>";
                          code+="<td>"+myJsonX[j].inst_name+"</td>";
                          code+="</tr>";
                          countinner++;
                        }
                        code+="</tbody></table>"
                    

                    
                }});


               
                code+="</td>"
                code+="</tr>";
serial++;
   
                }


             document.getElementById('table-body').innerHTML=code; 
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