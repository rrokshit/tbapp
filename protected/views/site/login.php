<?php $this->layout = 'main'; ?>

<!--Login form--> 
<?php
$model = new Login;
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableAjaxValidation' => false,
    'action' => Yii::app()->createUrl("Site/login") ,
    'method' => 'post',
        ));
?>

<div class="control-group row-fluid" >
    <label class="row-fluid " for="inputEmail">Username</label>
    <div class="controls row-fluid input-append">
        <input type="text" id="LoginForm_username" name="LoginForm[username]" class="row-fluid">
        <span class="add-on"><i class="icon-user"></i></span>
    </div>
</div>
<div class="control-group row-fluid">
    <label class="row-fluid " for="inputPassword">Password <div class="pull-right"><a class="muted"><small>Forgot your password ?</small></a></div></label>
    <div class="controls row-fluid input-append">
        <input type="password" id="LoginForm_password" name="LoginForm[password]" class="row-fluid">
        <span class="add-on"><i class="icon-lock"></i></span>
    </div>
</div>
<div class="control-group row-fluid"></div>
<div class="control-group row-fluid fluid">
    <div class="controls span6">
        <label class="checkbox">
            <input type="hidden" name="LoginForm[rememberMe]" value="0" id="ytLoginForm_rememberMe">
            <input type="checkbox" value="1" id="LoginForm_rememberMe" name="LoginForm[rememberMe]" checked="true">
            Remember Me
        </label>
    </div>
    <div class="controls span5 offset1">
        <button type="submit" onclick="jQuery('#login-form').submit()" class="btn btn-primary btn-larg1e row-fluid">Take me in <i class="gicon-chevron-right icon-white"></i></button>
    </div>
</div>
<?php $this->endWidget(); ?>

</div><!-- End .container -->
</div> <!-- End .row-fluid -->
</div> <!-- .bb-item  -->






