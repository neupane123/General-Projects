<?php 
  @session_start();
  if(isset($_GET['auth']) && $_GET['auth']==0)
  {
      $loginFail = "you have to login to access the dashboard";
  }

  if(isset($_SESSION['username']))
  {
      header('location:dashboard.php');
      exit();
  }
  require_once "config/config.php";
  require_once "class/formValidation.class.php";
  $validation = new FormValidation;

  if(isset($_POST['btnLogin']))
  {   
      //initializing an empty array variable, on which we store email and password error message if they happened
      $err = [];
      //-------------------------- email validation--------------
      // filter_var() function, checks the format for valid email, returns true if valid, and flase if invalid
      if(isset($_POST['email']) && !empty($_POST['email']) && filter_var($_POST['email'] ,FILTER_VALIDATE_EMAIL)) {
          $email = $validation->sanitize($_POST['email']);
      }elseif(empty($_POST['email'])) {
          $err['email'] = "you must input your email";
      }else {
          $err['email'] = "email is not valid";
      }
      //------------------------------------------------------

      //-------------- password validation----------------------
      if(isset($_POST['pwd']) && !empty($_POST['pwd'])) {
          $pwd = $validation->sanitize($_POST['pwd']);
      }elseif( empty($_POST['pwd']) ) {
          $err['password'] = "you must input password";
      }else{
          $err['password'] = "password is not valid";
      }
      //-------------------------------------

      $remember = (isset($_POST['remember']) && $_POST['remember']=='remember') ? true : false;

      $c = count($err);

      if($c==0)
      {   

          $sql = "select id from users where email = '$email'";
          $res = mysqli_query($validation->get('con'),$sql);
          if($res) {
              if($res->num_rows==1)
              {
                  $sql="select * from users where email = '$email'";
                  $res = mysqli_query($validation->get('con'),$sql);
                  $user_info = mysqli_fetch_assoc($res);
                  if(md5($pwd)===$user_info['password'])
                  { 
                      if($user_info['status']==1) {
                          if($remember){
                              setcookie('username',$user_info['username'],strtotime('+1 days'));
                          }
                          $_SESSION['username'] = $user_info['username'];
                          $_SESSION['name'] = $user_info['name'];
                          header("location:dashboard.php");
                      }else{
                          $loginFail = "you account is not active";
                      }
                  }
                  else{
                      $loginFail = "wrong password !";
                  }

              } else {
                  $loginFail = "wrong credentials";
              }
          }
          
      }
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url()?>/public/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>/public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url()?>/public/plugins/iCheck/square/blue.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url()?>/public/index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg"><?php echo isset($loginFail) ? $loginFail : '';?></p>

    <form action="" method="post" novalidate="">
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        <?php 
          if(isset($err['email'])) {
            echo "<span class='error'>".$err['email']."</span>";
          } 
        ?>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pwd" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        <?php 
          if(isset($err['password'])) {
            echo "<span class='error'>".$err['password']."</span>";
          } 
        ?>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name='remember' value="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btnLogin">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="#">I forgot my password</a><br>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url()?>/public/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url()?>/public/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url()?>/public/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
