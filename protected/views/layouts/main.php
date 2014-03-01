<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <title>Travel Bureau Management Application</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseurl;?>/css/images/favicon.png">
  <!-- Le styles -->
  <link href="<?php echo Yii::app()->theme->baseurl;?>/css/twitter/bootstrap.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseurl;?>/css/base.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseurl;?>/css/twitter/responsive.css" rel="stylesheet">
  <link href="<?php echo Yii::app()->theme->baseurl;?>/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
  <script src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/modernizr.custom.32549.js"></script>
  <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
      <![endif]-->
  
</head>

    <body>

      <div id="loading" class="other_pages">
        <!-- Login page -->
        <div id="login">
          <div class="support-note"><!-- let's check browser support with modernizr -->
            <span class="no-csstransforms">CSS transforms are not supported in your browser</span>
            <span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span>
            <span class="no-csstransitions">CSS transitions are not supported in your browser</span>
          </div>

         
     
        
     
        <div class="row-fluid">
       <div class="row-fluid">
          <!--  <div id="arrow_register"></div> -->
           <div class="logo" class="pull-left"><a href="<?php echo Yii::app()->request->baseurl;?>/index.php/entries/create"></a></div>
            <!-- <div class="pull-right spacer-medium not-member members right_offset">Not a member? <a href="#" id="bb-nav-next" class="members_button">Sign up <i class="icon-magic"></i></a></div>
            <div class="pull-right spacer-medium already-member members right_offset" style="display:none;">Already a member? <a href="#" class="members_button" id="bb-nav-prev">Log in <i class="icon-undo"></i></a></div>
          </div> -->

      <div class="row-fluid bb-bookblock" id="bb-bookblock">
        <div class="bb-item row-fluid login">

         <div class="top-background">
          <div class="fill-background right"><div class="bg row-fluid"></div></div>
          <div id="login-corner-shadow"></div>
        </div>
        <div class="row-fluid container">
          <div class="content">
            <div class="message row-fluid">
              <h3>Enter your username and password.</h3>
              
            </div>
           <?php echo $content?>   		  
          
          </div><!-- End .container -->
          </div> <!-- End .row-fluid -->
        </div> <!-- .bb-item  -->

      
        </div> <!-- End #bb-bookblock -->

        <!-- <div class="row-fluid spacer">
            <p class="row-fluid pagination-centered "><span class="muted">Or sign in using</span></p>
            <ul class="row-fluid fluid general_statistics alternative_login">
                <li class="box gradient span6 twitter">
                   <a href="index.html"n class="btn btn-twitter row-fluid"><i class="icon-twitter"></i>Login with Twitter</a>
                </li>
                <li class="box gradient span6 facebook">
                 <a href="index.html" class="btn btn-facebook row-fluid"><i class="icon-facebook"></i>Login with Facebook</a>
              </li>
            </ul>
          </div> --> <!-- End .row-fluid -->

        </div> <!-- End .row-fluid -->

    </div> <!-- End #login -->
        <!-- <img src="img/ajax-loader.gif"> -->
    </div> <!-- End #loading -->


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    
    <!-- Flip effect on login screen -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquerypp.custom.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquery.bookblock.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquery.uniform.min.js"></script>

   <script type="text/javascript">
      $(function() {
        var Page = (function() {

          var config = {
              $bookBlock: $( '#bb-bookblock' ),
              $navNext  : $( '#bb-nav-next' ),
              $navPrev  : $( '#bb-nav-prev' ),

              $navJump  : $( '#bb-nav-jump' ),
              bb        : $( '#bb-bookblock' ).bookblock( {
                speed       : 800,
                shadowSides : 0.8,
                shadowFlip  : 0.7
              } )
            },
            init = function() {

              initEvents();
              
            },
            initEvents = function() {

              var $slides = config.$bookBlock.children(),
                  totalSlides = $slides.length;

              // add navigation events
              config.$navNext.on( 'click', function() {
              $("#arrow_register").fadeOut();
              $(".not-member").slideUp();
              $(".already-member").slideDown();
                config.bb.next();
                return false;

              } );

              config.$navPrev.on( 'click', function() {

                 $(".not-member").slideDown();
                $(".already-member").slideUp();
                config.bb.prev();
                return false;

              } );

              config.$navJump.on( 'click', function() {
                
                config.bb.jump( totalSlides );
                return false;

              } );
              
              // add swipe events
              $slides.on( {

                'swipeleft'   : function( event ) {
                
                  config.bb.next();
                  return false;

                },
                'swiperight'  : function( event ) {
                
                  config.bb.prev();
                  return false;
                  
                }

              } );

            };

            return { init : init };

        })();

        Page.init();

      });
    </script>

    <script type='text/javascript'>
 
    $(window).load(function() {
     $('#loading1').fadeOut();
    });
      $(document).ready(function() {
           $("input:checkbox, input:radio, input:file").uniform();
           $("#LoginForm_username").focus();


      $('[rel=tooltip]').tooltip();
      $('body').css('display', 'none');
      $('body').fadeIn(500);

      $("#logo a, #sidebar_menu a:not(.accordion-toggle), a.ajx").click(function() {
        event.preventDefault();
        newLocation = this.href;
        $('body').fadeOut(500, newpage);
        });
        function newpage() {
        window.location = newLocation;
        }
      });
      
    

    </script>
   
</body>
</html>
