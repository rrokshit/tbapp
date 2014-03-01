<?php
/* @var $this LoginController */
/* @var $model Login */
/* @var $form CActiveForm */
?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
	
)); ?>

            <div class="control-group row-fluid">
				<label class="row-fluid " for="inputEmail">Username</label>
				<div class="controls row-fluid input-append">
					<?php echo $form->textField($model,'user_name',array('size'=>50,'maxlength'=>50,'class'=>'row-fluid')); ?>
					<span class="add-on"><i class="icon-user"></i></span>
				</div>
            </div>
              <div class="control-group row-fluid">
              <label class="row-fluid " for="inputPassword">Password <div class="pull-right"><a class="muted"><small>Forgot your password ?</small></a></div></label>
              <div class="controls row-fluid input-append">
				<?php echo $form->passwordField($model,'password',array('size'=>3,'maxlength'=>3,'class'=>'row-fluid')); ?>
	            <span class="add-on"><i class="icon-lock"></i></span>
              </div>
            </div>
            <div class="control-group row-fluid"></div>
            <div class="control-group row-fluid fluid">
              <div class="controls span6">
                <label class="checkbox">
               <input onfocus="this.select();">   <input type="checkbox"> Remember me
                </label>
              </div>
              <div class="controls span5 offset1">
             <a href=<?php echo Yii::app()->request->baseurl?>/index.php/branchMaster/index class="btn btn-primary btn-larg1e row-fluid"> Take me in  <i class="gicon-chevron-right icon-white"></i></a>
              </div>
            </div>
          </form>
          </div><!-- End .container -->
          </div> <!-- End .row-fluid -->
        </div> <!-- .bb-item  -->

       <div class="bb-item row-fluid register">
         <div class="top-background row-fluid fluid">
          <div class="fill-background "><div class="bg row-fluid"></div></div>
          <div id="login-corner-shadow" class="left"></div>
        </div>
        <div class="row-fluid fluid container">
          <div class="content">
            <div class="message row-fluid ">
             <h4>Register and Have Fun!</h4>              
            </div>
            <form class="form-horizontal row-fluid">
               <div class="control-group row-fluid">
              <label class="row-fluid " for="inputEmail">Enter your Email</label>
              <div class="controls row-fluid input-append">
                <input type="text" id="inputEmail" placeholder="email.."  class="row-fluid" > <span class="add-on"><i class="icon-globe"></i></span>
              </div>
            </div>
            <div class="control-group row-fluid">
              <label class="row-fluid " for="inputEmail">Pick a username</label>
              <div class="controls row-fluid input-append">
                <input type="text" id="inputEmail" placeholder="username.."  class="row-fluid" autocomplete="off" > <span class="add-on"><i class="icon-user"></i></span>
              </div>
            </div>
              <div class="control-group row-fluid">
              <label class="row-fluid " for="inputPassword">And a password </label>
              <div class="controls row-fluid input-append">
                <input type="password" id="inputPassword" placeholder="password.."  class="row-fluid" autocomplete="off"> <span class="add-on"><i class="icon-lock"></i></span>
              </div>
            </div>
            <div class="control-group row-fluid fluid">
             
              <div class="controls span5 offset7">
                <a href="<?php echo Yii::app()->theme->baseurl;?>/index.html" class="btn btn-info row-fluid">Register <i class="gicon-chevron-right icon-white"></i></a>
              </div>
            </div>
     
<?php $this->endWidget(); ?>




