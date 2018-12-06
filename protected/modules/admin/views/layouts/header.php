<?php
	/*echo Yii::app()->session['admin_pro_pic']; 
	unset(Yii::app()->session['admin_name']);
	die();*/
	if(!isset(Yii::app()->session['admin_name']) && Yii::app()->session['admin_name']=="" ){
		$this->redirect(Yii::app()->getBaseUrl(TRUE).'/admin');	
	}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Osnap</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/css/bootstrap.min.css">
  <!-- Crud Table view, insert, update design file -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/css/old-bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/dist/css/AdminLTE.min.css">
  <!-- custom stylesheet --> 
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/css/custom.css">
  <!-- Datatable jquery -->  
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/datatables/dataTables.bootstrap.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/dist/css/skins/_all-skins.min.css">
  
  
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/dist/css/skins/skin-blue.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  
  <!-- REQUIRED JS SCRIPTS -->
	<?php 
		$controller = Yii::app()->controller->id;
		$action = Yii::app()->controller->action->id;
	?>
	<?php if($action == 'admin') {?>
		
	<?php }else{ ?>
		
		<!-- jQuery 2.2.3 -->
		<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>
	<?php } ?>
	<!-- jQuery 2.2.3 -->
	<!--<script src="<?php //echo Yii::app()->getBaseUrl(true); ?>/plugins/jQuery/jquery-2.2.3.min.js"></script>-->
	<!-- Bootstrap 3.3.6 -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/js/bootstrap.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/dist/js/app.min.js"></script>
	<!-- validation JS file -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/js/jquery.validate.min.js"></script>
	<!-- DataTables -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/datatables/dataTables.bootstrap.min.js"></script>
	<!-- SlimScroll -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!-- FastClick -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="<?php echo Yii::app()->getBaseUrl(true); ?>/admin_assets/dist/js/demo.js"></script>
	
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
	<header class="main-header">

	    <!-- Logo -->
	    <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/dashboard/" class="logo">
	      <!-- mini logo for sidebar mini 50x50 pixels -->
	      <span class="logo-mini"><b>D</b>EMO</span>
	      <!-- logo for regular state and mobile devices -->
	      <span class="logo-lg" style="font-size: 28px;"><b>O'</b> snap</span>
	    </a>

	    <!-- Header Navbar -->
	    <nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>
			<!-- Navbar Right Menu -->
		      
	      	<div class="navbar-custom-menu">
		        <ul class="nav navbar-nav">
		          
		          	<!-- User Account Menu -->
		            <li class="dropdown user user-menu">
			            <!-- Menu Toggle Button -->
			            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				            <!-- The user image in the navbar-->
				            <img src="<?php echo Yii::app()->getBaseUrl(true).'/upload/adminProfilePic/'.Yii::app()->session['admin_pro_pic'];?>" class="user-image" alt="User Image">
				            <!-- hidden-xs hides the username on small devices so only the image appears. -->
				            <span class="hidden-xs"><?php echo Yii::app()->session['admin_name']; ?></span>
			            </a>
			            <ul class="dropdown-menu">
			                <!-- The user image in the menu -->
			              	<li class="user-header">
				                <img src="<?php echo Yii::app()->getBaseUrl(true).'/upload/adminProfilePic/'.Yii::app()->session['admin_pro_pic'];?>" class="img-circle" alt="User Image">

				                <p>
				                    AdminDemo - Web Developer
				                    <!--<small>Member since Nov. 2012</small>-->
									<form name="pro_pic_form" id="pro_pic_form" method="post" enctype="multipart/form-data" action="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/dashboard/admin_pro_pic_edit_process">
										<p onclick="getFile()" class="fa fa-pencil-square-o admin-pro-pic-edit">&nbsp;&nbsp;Edit Profile Pic</p>
										<div style='height:0px; width:0px; overflow:hidden;'>
											<input id="profile_pic" type="file" name="profile_pic" accept="image/*"/>
										</div>
										<!--<button type="submit" name="pro_pic_submit" id="pro_pic_submit" >Upload</button>-->
									</form>
								</p>
			              	</li>
			             
			              <!-- Menu Body -->
			             <!-- <li class="user-body">
			                <div class="row">
			                  <div class="col-xs-4 text-center">
			                    <a href="#">Followers</a>
			                  </div>
			                  <div class="col-xs-4 text-center">
			                    <a href="#">Sales</a>
			                  </div>
			                  <div class="col-xs-4 text-center">
			                    <a href="#">Friends</a>
			                  </div>
			                </div>
			                
			              </li>-->
			              
			              <!-- Menu Footer-->
				            <li class="user-footer">
				                <div class="pull-left">
				                  <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/dashboard/admin_reset_password" class="btn btn-default btn-flat">Reset Password</a>
				                </div>
				                
				                <div class="pull-right">
				                  <a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/index/logout" class="btn btn-default btn-flat">Sign out</a>
				                </div>
				            </li>
			            </ul>
		           	</li>
		            <!-- Control Sidebar Toggle Button -->
		        </ul>
	        </div>
	    </nav>
    </header>
  <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
		
		<!--<img src="<?php echo Yii::app()->getBaseUrl(true); ?>/images/logo.png" style="position: absolute; z-index: 23;opacity: 0.3;top: 67%;left: 21%;">-->
	    <!-- sidebar: style can be found in sidebar.less -->
	    <section class="sidebar">

	        <!-- Sidebar user panel (optional) -->
		    <div class="user-panel">
		        <div class="pull-left image">
		        	<img src="<?php echo Yii::app()->getBaseUrl(true).'/upload/adminProfilePic/'.Yii::app()->session['admin_pro_pic'];?>" style="height:46px;" class="img-circle" alt="User Image">
		        </div>
		        <div class="pull-left info">
					<p><?php echo Yii::app()->session['admin_name']; ?></p>
					<!-- Status -->
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		        </div>
		    </div>

	      <!-- search form (Optional) -->
	      <!--<form action="#" method="get" class="sidebar-form">
	        <div class="input-group">
	          <input type="text" name="q" class="form-control" placeholder="Search...">
	              <span class="input-group-btn">
	                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
	                </button>
	              </span>
	        </div>
	      </form>-->
	      <!-- /.search form -->

	      <!-- Sidebar Menu -->
	        <ul class="sidebar-menu">
		        <!--li class="header">MAIN NAVIGATION</li-->
		        <!-- Optionally, you can add icons to the links -->
		        <!--li id="menu_dashboard"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/dashboard/"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
		        <li id="menu_adminContactus"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/adminContactus/admin"><i class="fa fa-address-book"></i> <span>Contact Us</span></a></li-->
		        <li id="menu_cmsPages"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/cmsPages/admin"><i class="fa fa-file-text"></i> <span>CMS Pages</span></a></li>
		        <li id="menu_multiLanguage"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/multiLanguage/admin"><i class="fa fa-bell"></i> <span>Notification</span></a></li>
		        <li id="menu_businessTypes"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/businessTypes/admin"><i class="fa fa-briefcase"></i> <span>Business Types</span></a></li>
		        <li id="menu_businessCategory"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/businessCategory/admin"><i class="fa fa-briefcase"></i> <span>Business Category</span></a></li>
		        <li id="menu_Category"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/Category/admin"><i class="fa fa-briefcase"></i> <span>Category/Sub category</span></a></li>
		        <!--<li id="menu_ClientUser"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/ClientUser/admin"><i class="fa fa-user"></i> <span>Client User</span></a></li>-->
		        <li id="menu_User"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/User/admin"><i class="fa fa-user"></i> <span>Users</span></a></li>
		        <li id="menu_business"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/User/business"><i class="fa fa-user"></i> <span>Business User</span></a></li>
		        <!--<li id="menu_BusinessUser"><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/BusinessUser/admin"><i class="fa fa-user"></i> <span>Business User</span></a></li>-->
		        <!--li class="treeview">
		            <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
			            <span class="pull-right-container">
			            	<i class="fa fa-angle-left pull-right"></i>
			            </span>
		            </a>
		          	<ul class="treeview-menu">
			            <li><a href="#">Link in level 2</a></li>
			            <li><a href="#">Link in level 2</a></li>
		          	</ul>
		        </li-->
	        </ul>
	        <!-- /.sidebar-menu -->
	    </section>
    <!-- /.sidebar -->
    </aside>

<!---------------------------------------------------------------------->
<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>
			    Dashboard
			    <!--<small>Optional description</small>-->
			</h1>
		  	<ol class="breadcrumb">
			    <li><a href="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/dashboard/"><i class="fa fa-dashboard"></i> Level</a></li>
			    <li class="active">Here</li>
		    </ol>
		</section>

		<!-- Main content -->
		<section class="content">
			<div id="sidebar">
				<?php
					$this->beginWidget('zii.widgets.CPortlet', array(
						'title'=>'Operations',
					));
					$this->widget('zii.widgets.CMenu', array(
						'items'=>$this->menu,
						'htmlOptions'=>array('class'=>'operations'),
					));
					$this->endWidget();
				?>
			</div><!-- sidebar -->

			<?php echo $content; ?>

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
<!---------------------------------------------------------------------->		

    <!-- Main Footer -->
  	<footer class="main-footer">
	    <!-- To the right -->
	    <div class="pull-right hidden-xs">
	    	Anything you want
	    </div>
	    <!-- Default to the left -->
	    <strong>Copyright &copy; 2017 <a href="#">O'snap Admin</a>.</strong> All rights reserved.
  	</footer>
</div>
<!-- ./wrapper -->

</body>
<!-- Get file -->
<script type="text/javascript">
	function getFile()
	{
	    document.getElementById("profile_pic").click();
	}
	$('#profile_pic').change(function() {
	  $('#pro_pic_form').submit();
	});
	//document.getElementById('pro_pic_form').submit();
</script>
<!-- ./ Get file -->

<!-- add class in manu class="active" -->
<script>
	var site_url = window.location.href;
	var url = site_url.split("/")[5];
	var urlNext = site_url.split("/")[6];
	//alert(site_url);
    //alert(url);
    //alert(urlNext);
	if(url){
		
		if(urlNext == 'business'){
			$('#menu_'+urlNext).addClass('active');
		}else{
			$('#menu_'+url).addClass('active');	
		}
		if(urlNext=="adminContactus"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="cmsPages"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="multiLanguage"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="businessTypes"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="businessCategory"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="Category"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="ClientUser"){
			$('#menu_'+urlNext).addClass('active');
		}
		if(urlNext=="BusinessUser"){
			$('#menu_'+urlNext).addClass('active');
		}
	}else{
		$('#menu_home').addClass('active');
	}
	

</script>
<!-- ./ add class in manu class="active" -->
</html>
	
