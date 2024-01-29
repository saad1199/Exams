<?php session_start();
if (!isset($_SESSION['session_token']) && !isset($_SESSION['inst_code'])) {
   
   header('location:main.html');
}

 if($_SESSION['inst_code']!="11111"){
          header('location:main.html');
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration (Institute)</title>
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
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
  <div class="login-page">
      <div class="container d-flex align-items-center position-relative py-5">
        <div class="card shadow-sm w-100 rounded overflow-hidden bg-none">
          <div class="card-body p-0">
            <div class="row gx-0 align-items-stretch">
              <!-- Logo & Information Panel-->
              <div class="col-lg-6">
                <div class="info d-flex justify-content-center flex-column p-4 h-100" style="background-color:#123b05">
                  <div class="py-5" style="text-align: center;">
                    <img src="img/govw.png">
                    <h1 class="display-6 fw-bold">Examinations</h1>
                    <p class="fw-light mb-0">Federal Directorate of Education Islamabad</p>
                  </div>
                </div>
              </div>
              <!-- Form Panel    -->
              <div class="col-lg-6 bg-white">
                <div class="d-flex align-items-center px-4 px-lg-5 h-100">
                  <form class="register-form py-5 w-100" action="Engine/rs_ins_signup.php" method="GET">

                  <div class="text-center w-100"><h1>Register PEIRA Institute</h1></div>
                    <div class="input-material-group mb-3">
                      <input class="input-material" id="instName" type="text" name="instName" required data-validate-field="instName">
                      <label class="label-material" for="register-username">Institue Name</label>
                    </div>
                    <div class="input-material-group mb-3">
                      <input class="input-material" pattern="^[0-9]{5,5}$" type="text" id="instCode" name="instCode" required data-validate-field="instCode">
                      <label class="label-material">Institue EMIS Number</label>
                    </div>
                    
                  <div class="input-material-group mb-3">
                  <input class="input-material" type="text" id="instAddress" name="instAddress" required data-validate-field="instAddress">
                  <label class="label-material">Institue Address </label>
                </div>
                <div class="alert alert-danger" id="danger-alert" style="display:none;"></div>
                   <div class="alert alert-success" id="success-alert" style="display:none;"></div>
                   <br>
                    <button class="btn btn-primary mb-3 text-white" id="volcanoSubmit" name="volcanoSubmit" type="submit" value="Register">Register</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center position-absolute bottom-0 start-0 w-100 z-index-20">
       
        <p class="text-white"><a class="external text-white" href="mailto:saad.ee.dev@gmail.com">Designed and Developed in IT Section FDE - Suggestion and Queries may sent to Saad Sadiq (Software Developer IT) via Email</a>     </p>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
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
if(status){
  if(status=="EXISTS"){
    document.getElementById("danger-alert").style.display="block";
    document.getElementById("danger-alert").innerHTML="<strong>ERROR !</strong> INSTITUTE ALREADY EXISTS";
  }
  if(status=="LENGTH_ERROR"){
    document.getElementById("danger-alert").style.display="block";
    document.getElementById("danger-alert").innerHTML="<strong>ERROR !</strong> INCORRECT EMIS NUMBER";
  }
  if(status=="REGISTERED"){
    document.getElementById('success-alert').style.display="block";
    document.getElementById('success-alert').innerHTML="<strong>SUCCESS ! Successfully Registered</strong>"
  }
}
</script>
</html>