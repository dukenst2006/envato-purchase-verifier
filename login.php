<?php 
require('config.php');
 session_start(); /* Starts the session */
if(isset($_SESSION['UserData']['Username'])){
  header("location:index.php");
  exit;
}

  /* Check Login form submitted */  
  if(isset($_POST['Submit'])){
    /* Define username and associated password array */
    $logins = array($username => $password,'username1' => 'password1','username2' => 'password2');
    
    /* Check and assign submitted Username and Password to new variable */
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';
    
    /* Check Username and Password existence in defined array */    
    if (isset($logins[$Username]) && $logins[$Username] == $Password){
      /* Success: Set session variables and redirect to Protected page  */
      $_SESSION['UserData']['Username']=$logins[$Username];
      header("location:index.php");
      exit;
    } else {
      /*Unsuccessful attempt: Set error message */
      $msg="<span style='color:red'>Invalid Login Details</span>";
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="author" content="Shameem Reza">
<title>Envato Purchase Verifier</title>

<!-- Bootstrap -->
<link href="assets/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="assets/plugins/nprogress/nprogress.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="assets/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div> <a class="hiddenanchor" id="signup"></a> <a class="hiddenanchor" id="signin"></a>
  <div class="login_wrapper">
    <div class="animate form login_form">
      <section class="login_content">
        <form action="" method="post" name="Login_Form">
          <h1>Login</h1>
          <?php if(isset($msg)){
          echo $msg;
          } ?>
          <div>
            <input type="text" value="admin" name="Username" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input type="password" value="1234" name="Password" class="form-control" placeholder="Password" required="" />
          </div>
          <div>
            <input type="hidden" name="Submit">
            <button type="submit" class="btn btn-success btn-block submit">Login</button>
          </div>
          <div class="clearfix"></div>
          <div class="separator">
            <div class="clearfix"></div>
            <br />
            <div>
              <h1></h1>
              <p>©2017 All Rights Reserved. <a target="_blank" href="https://shameem.me">Shameem Reza</a> </p>
            </div>
          </div>
        </form>
      </section>
    </div>
    <div id="register" class="animate form registration_form">
      <section class="login_content">
        <form>
          <h1>Create Account</h1>
          <div>
            <input type="text" class="form-control" placeholder="Username" required="" />
          </div>
          <div>
            <input type="email" class="form-control" placeholder="Email" required="" />
          </div>
          <div>
            <input type="password" class="form-control" placeholder="Password" required="" />
          </div>
          <div> <a class="btn btn-default submit" href="index.html">Submit</a> </div>
          <div class="clearfix"></div>
          <div class="separator">
            <p class="change_link">Already a member ? <a href="#signin" class="to_register"> Log in </a> </p>
            <div class="clearfix"></div>
            <br />
            <div>
              <h1></h1>
              <p>©2017 All Rights Reserved. <a target="_blank" href="http://shameem.me">Shameem Reza</a> </p>
            </div>
          </div>
        </form>
      </section>
    </div>
  </div>
</div>
</body>
</html>
