<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Private (Signup)</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
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
                <div class="info d-flex justify-content-center flex-column p-4 h-100" style="background-color:#2069ad">
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
                  <form class="register-form py-5 w-100" method="post" id="rsform" action="Engine/rs_private_signup.php" >
                
                  <h3 style="font-weight:bold; font-size:22px; color:red;">Roll Number Slips 2024 </h3>
                  <h3><strong>Instructions</strong></h3>
                  <p>
                      <strong>1-</strong> Private Students can be registered through this webpage.</p>
  
    <p><strong>2-</strong> Students have to create login through submitting necessary details and than login to complete profile and register for examination </p>
    <p><strong>3-</strong> FDE andministration will not be responsible for any incorrect data
entered by the students/parents.
                      </p>  
                  
                  <div class="input-material-group mb-3">
                      <input class="input-material" id="fullName"type="text" name="fullName" required data-validate-field="fullName">
                      <label class="label-material" for="register-username">Full Name</label>
                    </div>
                    <div class="input-material-group mb-3">
                    <input required class="input-material" type="text" name="cnic" id="cnic" maxlength="13"  pattern="[0-9]{13}">
                        
                       <label class="label-material">CNIC/B-Form (1234512345671)</label>
                    </div>
                    <div class="input-material-group mb-3">
                    <input  required class="input-material" pattern="[0-9]{11}" type="text" aria-label="Pakistani Mobile Number" name="contact" id="contact">
                          
                    <label class="label-material">03XX1234567. please follow the mentioned pattern</label>
</div>
                  <div class="input-material-group mb-3">
                  <input class="input-material" type="text" id="address"name="address" required data-validate-field="address">
                  <label class="label-material">Address </label>
                </div>

                    <div class="input-material-group mb-4">
                      <input class="input-material" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,12}$" id ="password" type="password" name="password" required >
                      <label class="label-material">Password</label>
                    
                    </div>
                    <div>
                      <label class="label-material" style="font-size:12px;"><strong>Password Policy</strong><br>At least 1 Uppercase
                        <br>At least 1 Lowercase
                        <br>At least 1 Number
                        <br>At least 1 Symbol, symbol allowed !@#$%^&*_=+-
                        <br>Min 8 chars and Max 12 chars</label><br><br>
                    </div>

                    <div class="form-check mb-4">
                      <input class="form-check-input" id="register-agree" name="registerAgree" type="checkbox" required value="1" data-validate-field="registerAgree">
                      <label class="form-check-label form-label" for="register-agree">I agree with the terms and policy                        </label>
                    </div>
                    <input class="btn btn-primary mb-3 text-white" id="submit-btn" name="private_submit" value="Register" type="submit"/><br><small class="text-gray-500">Already have an account?  </small><a class="text-sm text-paleBlue" href="private-login.html">Login</a><br><a class="text-sm text-paleBlue" href="main.html">Main Page</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="text-center position-absolute bottom-0 start-0 w-100 z-index-20">
      
      <p class="text-white" style="margin-top:10px;"><a class="external text-white" href="mailto:saad.ee.dev@gmail.com">Designed and Developed in
          IT Section FDE - Queries may sent to Saad Sadiq (Software Engineer) via Email</a><br>
          <a class="external text-white" href="mailto:saad.ee.dev@gmail.com">If found errors/ mistakes in the system or suggestions. Contact us UAN No (051) 111 333 663 ext. 112</a>
       

        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)-->
      </p>  </div>
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
  
</html>