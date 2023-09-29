
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!DOCTYPE html>
<html>
<head>
	<title>Signup Page</title>
   <!--Made with love by Mutiullah Samim -->
	<!--Bootsrap 4 CDN-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<!--Custom styles-->
	<!--<link rel="stylesheet" type="text/css" href="styles.css">-->
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card bg-dark text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <div class="mb-md-5 mt-md-4 pb-5">
              <form method="post" action="" > 
                <h2 class="fw-bold mb-2 text-uppercase">Sign up</h2>
                <!-- con esto conecto el post del formulario-->
                <?php 
                include "../models/connection.php";
                include "../controllers/controller_signup.php"
                ?>
                <p class="text-white-50 mb-5">Please enter your data for register</p>
                <div class="form-outline form-white mb-4">
                  <input type="text" id="typeEmailX" class="form-control form-control-lg" name="name" />
                  <label class="form-label" for="typeEmailX">Name</label>
                </div>
                <div class="form-outline form-white mb-4">
                  <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" />
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>
                <div class="form-outline form-white mb-4">
                  <input type="password" id="password" class="form-control form-control-lg" name="password" />
                  <label class="form-label" for="typePasswordX">Password</label>
                  <input type="password" id="confirm_password" class="form-control form-control-lg" name="confirmpassword" />
                  <label class="form-label" for="typePasswordX">Confirm Password</label>
                </div>
                <button class="btn btn-outline-light btn-lg px-5" type="submit" name="signup" value="SIGNUP">Sign up</button>
              </form>
            </div>
            <div>
              <p class="mb-0">Have an account? <a href="login.php" class="text-white-50 fw-bold">Log in</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</php>
<style>
.gradient-custom {
/* fallback for old browsers */
background: #6a11cb;
/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1));
/* W3C, IE 10+/ Edge, Firefox 16+, C hrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgba(106, 17, 203, 1), rgba(37, 117, 252, 1))
}
</style>
<script>var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm_password");
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;</script>