<?php if(isset(Yii::app()->session['loginfail'])){ ?>
	    <div class="alert-custom alert-danger alert-dismissable message-box" id="messagebox">
        	<strong><?php echo Yii::app()->session['loginfail']; ?></strong>
    	</div>
<?php unset(Yii::app()->session['loginfail']); } ?>

<?php
//echo Yii::app()->session['admin_name']; die();
if(isset(Yii::app()->session['admin_name']) && Yii::app()->session['admin_name']!="" ){
	$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin/dashboard');	
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Onsap | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/iCheck/square/blue.css">
  <!-- custom stylesheet --> 
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/css/custom.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
   
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/"><img alt="Onsap"  src="<?php echo Yii::app()->baseUrl . '/upload/image/logo.png' ?>"  height="120px"/></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="admin_login" enctype="multipart/form-data" action="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/index/login_process" method="post">
      <div class="form-group has-feedback"> 
        <input type="text" name="admin_name" id="admin_username" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="admin_password" id="admin_password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="admin_submit" id="admin_submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <!--<a href="#">I forgot my password</a><br>
    <a href="register.html" class="text-center">Register a new membership</a>-->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
<!-- jQuery 2.2.3 -->
<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/js/jquery.validate.min.js"></script>
<script>
	$("#admin_login").validate({
     	errorClass: 'error pull-left text-capitalize',
        errorElement: 'div',
		rules:
		{
			admin_name: {
				required: true,
			},
			admin_password: {
				required: true,
			},
		},
		messages:
		{
		    admin_name:{
		        required: "please enter Username"
		    },
		    admin_password:{
		    	required: "please enter your Password"
		    },
		},
		
  });
</script>
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
