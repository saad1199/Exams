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
                <a href="dashboard.html" class="brand"><i class="icon-user"></i></a>
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


            <section class="nav-page" pageVTourUrl="guide/tour/form-tour.html" pageVGuideUrl="guide/form-guide.html">
                <div class="container">
                    <div class="row">
                        <div class="span7">
                            <header class="page-header">
                                <h3>Administrator<br /><small>Challan Update Menu</small></h3>
                            </header>
                        </div>
                        <div class="span9">
                            <ul class="nav nav-pills">
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section id="my-account-security-form" class="page container">



            


                <form class="form-horizontal" action="../Engine/admin_challanEntry.php" method="GET">
                    <div class="container">

                        <div class="alert alert-block alert-info">
                            <p>
                                Enter Challan Details 
                            </p>
                        </div>
                        <div class="row">
                            <div id="acct-password-row" class="span16">

                                <label>Enter Challan Number</label>
                                <input type="text" id="challan_number" name="challan_number" value="" /><br><br>
                                <p id="bad-msg" class="text-danger" style="display:none;"><strong>Not Results</strong></p>
                                <p id="success-msg" style="display:none;" class="text-success"><strong id="inner-ammount"></strong></p><br>
                          
                            </div>
                        </div>
                        <div class="row">

                    </div>

                    <footer id="submit-actions" class="form-actions">
                        <p id="info"></p>
                        <input class="btn btn-danger" type="submit" value="Confirm Challan" />
                        
                    </footer>

                </form>

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
        $(function() {
            $('.chosen').chosen();
            $("[rel=tooltip]").tooltip();

            $("#vguide-button").click(function(e) {
                new VTour(null, $('.nav-page')).tourGuide();
                e.preventDefault();
            });
            $("#vtour-button").click(function(e) {
                new VTour(null, $('.nav-page')).tour();
                e.preventDefault();
            });
        });
    </script>

</body>
<script>
   

    $("#challan_number").keyup(function() {

        //get the selected value
        var selectedValue = this.value;
        if(selectedValue.length==10){
            
        
        var challan_num = document.getElementById('challan_number').value;
        //make the ajax call

        $.ajax({
            url: '../Engine/getChallan.php',
            data: {
                "token": "<?php echo $_SESSION['session_token']; ?>",
                "code": challan_num
            },
            type: "GET",
            async: false,
            cache: false,
            dataType: "json",
            success: function(myJson) {
                try {
                    if (myJson[0].challan_id == null) {
                        document.getElementById('success-msg').style.display = 'none';
                        document.getElementById('bad-msg').style.display = 'block';
                    } else {
                        var str = "<h3><strong>Challan Information</strong></h3>Challan ID : " + myJson[0].challan_id;
                        if(myJson[0].challan_identifier==null){
                            str += "<br>Challan Amount: " + myJson[0].fee_type_amount;
                        }else{
                            str += "<br>Challan Amount: " + myJson[0].challan_total_amount;
                        }
                        if(myJson[0].isPaid=='1'){
                            str += "<br>Challan Status: PAID";
                        }else{
                            str += "<br>Challan Status: UN-PAID";
                        }
                        document.getElementById('success-msg').style.display = 'block';
                        document.getElementById('bad-msg').style.display = 'none';
                        document.getElementById('info').innerHTML = str;

                    }
                } catch (Exception) {
                    document.getElementById('success-msg').style.display = 'none';
                    document.getElementById('bad-msg').style.display = 'block';
                    document.getElementById('info').innerHTML = "";
                }


            },
            error: function() {
                document.getElementById('success-msg').style.display = 'none';
                document.getElementById('bad-msg').style.display = 'block';
                document.getElementById('info').innerHTML = "";
            }
        });
        }
    });
</script>

</html>

