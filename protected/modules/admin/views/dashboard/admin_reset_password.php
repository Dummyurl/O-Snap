<!-- Content Wrapper. Contains page content -->
  
 
   	<div class="box box-primary">
   		<!-- Session error show -->
	<?php if(isset(Yii::app()->session['resetsuccess'])){ ?>
		    <div class="alert-custom alert-success alert-dismissable message-box" id="messagebox">
	        	<strong><?php echo Yii::app()->session['resetsuccess']; ?></strong>
	    	</div>
	<?php unset(Yii::app()->session['resetsuccess']); } ?>
	<!-- ./Session error show -->  
    <!-- Session error show -->
	<?php if(isset(Yii::app()->session['resetfail'])){ ?>
		    <div class="alert-custom alert-danger alert-dismissable message-box" id="messagebox">
	        	<strong><?php echo Yii::app()->session['resetfail']; ?></strong>
	    	</div>
	<?php unset(Yii::app()->session['resetfail']); } ?>
	<!-- ./Session error show -->
  
        <div class="box-header with-border">
          <h3 class="box-title">Change Password Here..</h3></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="post" name="admin_change_pass" id="admin_change_pass" enctype="multipart/form-data" action="<?php echo Yii::app()->getBaseUrl(true); ?>/admin/dashboard/admin_reset_password_process">
          <div class="box-body">
            <div class="form-group">
              <label for="">Old Password</label>
              <input type="password" class="form-control" name="admin_old_password" id="admin_old_password" placeholder="Enter Old Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">New Password</label>
              <input type="password" class="form-control" name="admin_new_password" id="admin_new_password" placeholder="Enter New Password">
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Conform New Password</label>
              <input type="password" class="form-control" name="admin_conform_password" id="admin_conform_password" placeholder="Enter New Password">
            </div>
            
          </div>
          <!-- /.box-body -->

          <div class="box-footer">
            <button type="submit" name="admin_reset_password_submit" id="admin_reset_password_submit" <!--class="btn btn-primary-->">Change Now</button>
          </div>
        </form>
      </div>	



  
<script>
	$(document).ready(function(){
		$("#admin_change_pass").validate({
	     	//errorClass: 'error pull-left text-capitalize',
	        //errorElement: 'div',
			rules:
			{
				admin_old_password: {
					required: true,
				},
				admin_new_password: {
					required: true,
				},
				admin_conform_password:{
					required: true,
					equalTo: "#admin_new_password"
				},
			},
			messages:
			{
			    admin_old_password:{
			        required: "Please Enter Old Password"
			    },
			    admin_new_password:{
			    	required: "Please Enter New Password"
			    },
			    admin_conform_password:{
			    	required: "Please Conform New Password",
			    	equalTo: "Password Not Match"
			    },
			},
			/*errorPlacement: function(error, element) {
			    	var div = element.parent("div");
			    	error.appendTo(div);
			    	div.addClass('error');
			},*/
		});
	});
</script>