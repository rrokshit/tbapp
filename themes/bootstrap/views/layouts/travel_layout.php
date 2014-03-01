<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Travel Bureau Management Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<!-- Le styles -->
<link href="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/chosen/chosen/chosen.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseurl;?>/css/twitter/bootstrap.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseurl;?>/css/base.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseurl;?>/css/twitter/responsive.css" rel="stylesheet">
<link href="<?php echo Yii::app()->theme->baseurl;?>/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/modernizr.custom.32549.js"></script>
<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseurl;?>/css/images/favicon.png">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>
<div id="loading">
  <img src="<?php echo Yii::app()->theme->baseurl;?>/img/ajax-loader.gif">
</div>
<div id="responsive_part">
    <div class="logo">
      <a href="<?php echo Yii::app()->theme->baseurl;?>/index.html"></a>
    </div>
    <ul class="nav responsive">
      <li>
      <btn class="btn btn-la1rge btn-i1nfo responsive_menu icon_item" data-toggle="collapse" data-target="#sidebar">
       <i class="icon-reorder"></i>
      </btn>
      </li>
    </ul>
</div> <!-- Responsive part -->

<div id="sidebar" class="collapse">
   <div class="logo">
    <a href="<?php echo Yii::app()->theme->baseurl;?>/index.html"></a>
  </div>
  <ul id="sidebar_menu" class="navbar nav nav-list sidebar_box">
    <li class="accordion-group">
    <a class="dashboard" href="<?php echo Yii::app()->theme->baseurl;?>/index.html"><img src="<?php echo Yii::app()->theme->baseurl;?>/img/menu_icons/dashboard.png">Dashboard</a>
    </li>
    <li class="accordion-group active">
    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse1">
    <img src="<?php echo Yii::app()->theme->baseurl;?>/img/menu_icons/forms.png">Masters</a>
    <ul id="collapse1" class="accordion-body collapse in">
   <li><a href="<?php echo Yii::app()->request->baseurl;?>/index.php/branchMaster">Branch Master</a></li>
 <li><a href="<?php echo Yii::app()->request->baseurl;?>/index.php/approvedMaster">Approved Shops Master</a></li>
	    <li><a href="<?php echo Yii::app()->theme->baseurl;?>/agency_master.php">Agency Master</a></li>
		<li><a href="<?php echo Yii::app()->theme->baseurl;?>/hotel_master.html">Hotel Master</a></li>
		<li><a href="<?php echo Yii::app()->theme->baseurl;?>/train_flight_master.html">Train/Flight Master</a></li>
		<li><a href="<?php echo Yii::app()->theme->baseurl;?>/vehicle_master.html">Vehicle Master</a></li>
		<li><a href="<?php echo Yii::app()->theme->baseurl;?>/service_master.html">Service Master</a></li>
		<li><a href="<?php echo Yii::app()->theme->baseurl;?>/staff_master.html">Staff Master</a></li>
		<li><a href="<?php echo Yii::app()->theme->baseurl;?>/driver_master.html">Driver Master</a></li>
    
    </ul>
    </li> <li class="accordion-group">
    <a class="accordion-toggle widgets collapsed" data-toggle="collapse" data-parent="#sidebar_menu" href="#collapse2">
    <img src="<?php echo Yii::app()->theme->baseurl;?>/img/menu_icons/widgets.png">Entries</a>
    <ul id="collapse2" class="accordion-body collapse">
      <li><a href="<?php echo Yii::app()->theme->baseurl;?>/entries.html">Entries</a></li>
    </ul>
    </li>
  </ul>
  <!-- End sidebar_box -->
  <div class="sidebar_box statistics visible-desktop">
    <div class="container">
      <div class="title">
        <i class="gicon-globe"></i> Estimated earnings
      </div>
      <div class="row-fluid fluid">
        <div class="span6 pagination-centered">
          <div class="row-fluid fluid">
            <i class="icon-caret-up green medium span3"></i>
            <span class="percent span3">7%</span>
            <span class="bar1 span6">3,4,10,5,3,6,3</span>
          </div>
          <div class="row-fluid fluid">
            <h2><strong>$11.37</strong></h2>
          </div>
          <div class="row-fluid fluid">
          Today so far
          </div>
        </div>
        <div class="span6 pagination-centered">
          <div class="row-fluid fluid">
            <i class="icon-caret-down red medium span3"></i>
            <span class="percent span3">2%</span>
            <span class="bar2 span6">1, 4, 6, 7,4, 2,4</span>
          </div>
          <div class="row-fluid fluid">
            <h2><strong>$22.84</strong></h2>
          </div>
          <div class="row-fluid fluid">
     Yesterday  <i class="icon-question-sign muted inline" rel="tooltip" data-placement="right" data-original-title="Your total earnings accrued yesterday. This amount is an estimate that is subject to change when your earnings are verified for accuracy at the end of every month."></i>
          </div>
        </div>
      </div>
      <!-- End .title -->
      <div class="title row-fluid fluid">
        <i class="gicon-refresh"></i>Real Time Stats
      </div>
      <div class="row-fluid fluid">
        <div class="span6 pagination-centered">
          <div class="row-fluid">
            <div id="g1" class="gauge">
            </div>
          </div>
        </div>
        <div class="span6 pagination-centered">
          <div class="row-fluid fluid">
            <div id="g2" class="gauge">
            </div>
          </div>
        </div>
        <!-- End row-fluid -->
        <div class="row-fluid fluid">
          <div id="real-time-sidebar" style="width:100%;height:65px;">
          </div>
        </div>
         <div class="row-fluid fluid pagination-centered">
           Page views <i class="icon-question-sign muted inline" rel="tooltip" data-placement="right" data-original-title="This displays the total number of pages that are accessed."></i>
        </div>
      </div>
      <!-- End .title -->
    </div>
  </div>
  <!-- End sidebar_box -->
</div>
<div id="main">
  <div class="container">
    <div class="container_top">
      <div class="row-fluid ">
        <div class="top_bar_stats to_hide_tablet">
          <div class="stats"> <span class="title">Sales:</span> +19,77% <span class="bar_1"></span> </div>
          <div class="stats"> <span class="title">Visits:</span> +23,34% <span class="bar_2"></span> </div>
          <div class="stats"> <span class="title">New Users:</span> +2,84% <span class="bar_3"></span> </div>
        </div>
        <div class="top_right">
          <ul class="nav search">
            <li>
              <form class="form-search">
                <div class="input-append">
                  <input name="text" type="text" class=" search-query" placeholder="Search..">
                </div>
              </form>
            </li>
          </ul>
          <ul class="nav nav_menu">
            <li class="dropdown"> <a class="dropdown-toggle administrator" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"> <span class="icon"><img src="<?php echo Yii::app()->theme->baseurl;?>/img/menu_top/profile-avatar.png"></span><span class="title">Administrator</span></a>
                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                  <li><a href="#"><i class=" icon-user"></i> My Profile</a></li>
                  <li><a href="#"><i class=" icon-cog"></i>Settings</a></li>
                  <li><a href="#"><i class=" icon-unlock"></i>Log Out</a></li>
                  <li><a href="#"><i class=" icon-flag"></i>Help</a></li>
                </ul>
            </li>
            <li class="dropdown"> <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html"> <span class="icon"><img src="<?php echo Yii::app()->theme->baseurl;?>/img/menu_top/profile-messages.png"></span><span class="notifications">3</span> </a>
                <ul class="dropdown-menu messages" aria-labelledby="dLabel">
                  <div class="container">
                    <div class="heading"> <span class="title"><i class="icon-comments"></i>Messages</span><span class="link"><a href="#">Send a new message</a></span> </div>
                    <ul>
                      <li> <a href="#">
                        <div class="avatar"> <img src="<?php echo Yii::app()->theme->baseurl;?>/img/message_avatar1.png"/> </div>
                        <div class="container"> <span class="name">John Smith</span> <span class="message"><i class="icon-share-alt"></i>The first thing I remember.. <br/>
                        </span> <span class="date">Aug 8</span> </div>
                      </a> </li>
                      <li> <a href="#">
                        <div class="avatar"> <img src="<?php echo Yii::app()->theme->baseurl;?>/img/message_avatar2.png"/> </div>
                        <div class="container"> <span class="name">Celeste Holm</span> <span class="message"><i class="icon-share-alt"></i>What have you learned from.. <br/>
                        </span> <span class="date">Aug 6</span> </div>
                      </a> </li>
                      <li> <a href="#">
                        <div class="avatar"> <img src="<?php echo Yii::app()->theme->baseurl;?>/img/message_avatar3.png"/> </div>
                        <div class="container"> <span class="name">Mark Jobs</span> <span class="message"><i class="icon-share-alt"></i>Start it and stick with it.. <br/>
                        </span> <span class="date">Jul 27</span> </div>
                      </a> </li>
                    </ul>
                    <div class="footer"> <a class="see_all">See All Messages <i class="icon-chevron-right"></i></a> </div>
                  </div>
                </ul>
            </li>
          </ul>
        </div>
        <!-- End top-right -->
        <div class="span4"> </div>
      </div>
    </div>
    <!-- End container_top -->
    <div class="row-fluid">
      <div class="span7">
        <div class="box gradient">
          <div class="title">
            <h3> <i class="icon-book"></i><span>Branch Master<span class="botton_mergin"></span> <span class=botton_margin1><a href="<?php echo Yii::app()->theme->baseurl;?>/branch_master_table.html">
              <button class="btn btn-success" rel="tooltip" data-placement="right">List</button>
            </a></span></span> </h3>
          </div>
          <div class="content">
		  
           <?php echo $content?>
          </div>
        </div>
        <!-- End .box -->
        <!-- End .box -->
        <!-- End .box -->
        <!-- End .box -->
        <!-- End .box -->
        <!-- End .box -->
        <!-- End .box -->
      </div>
      <!-- End .span8 
      <div class="span5">
        <div class="box gradient">
          <div class="title">
            <h3> <i class="icon-calendar"></i> <span>Login form</span> </h3>
          </div>
          <div class="content ">
            
          </div>
        </div>
        <!-- End .box -->
      </div>
      <!-- End .span4 -->
    </div>
  </div> 
  <!-- End #container -->
<div id="footer">
    <a href="http://www.travelbureauindia.com/"> <p> &copy; Copyright by Travel Bureau 2013.
    </p></a>
    <span class="company_logo"><a href="http://aspiringteam.com/"></a></span>
  </div> <!-- End #footer -->
</div>
</div>
<!-- /container -->
<!-- Le javascript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquery.sparkline.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-transition.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-alert.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-modal.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-dropdown.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-tab.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-tooltip.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-popover.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-button.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-collapse.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-carousel.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/bootstrap-typeahead.js"></script>

<script src="<?php echo Yii::app()->theme->baseurl;?>/js/fileinput.jquery.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/jquery-ui-1.8.23.custom.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/jquery.touchdown.js"></script>
<!-- Textarea editor https://github.com/jhollingworth/bootstrap-wysihtml5/ -->
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/wysihtml5-0.3.0.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/bootstrap-wysihtml5.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquery.peity.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquery.uniform.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/textarea-autogrow.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/character-limit.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/jquery.maskedinput-1.3.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/chosen/chosen/chosen.jquery.min.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/bootstrap-datepicker.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/bootstrap-colorpicker.js"></script>

<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/flot/jquery.flot.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/flot/jquery.flot.stack.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/flot/jquery.flot.pie.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl;?>/js/plugins/flot/jquery.flot.resize.js"></script>

<script src="<?php echo Yii::app()->theme->baseurl;?>/js/scripts.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("input:checkbox, input:radio, input:file").uniform();
        $('textarea.autogrow').autogrow();
        var elem = $("#chars");
        $("#text").limiter(100, elem);
        // Mask plugin http://digitalbush.com/projects/masked-input-plugin/
        $("#mask-phone").mask("(999) 999-9999");
        $("#mask-date").mask("99-99-9999");
        $("#mask-int-phone").mask("+33 999 999 999");
        $("#mask-tax-id").mask("99-9999999");
        $("#mask-percent").mask("99%");
        // Editor plugin https://github.com/jhollingworth/bootstrap-wysihtml5/
        $('#editor1').wysihtml5({
          "image": false,
          "link": false
          });
        // Chosen select plugin
        $(".chzn-select").chosen({
          disable_search_threshold: 10
        });
        // Datepicker
        $('#datepicker1').datepicker({
          format: 'mm-dd-yyyy'
        });
        $('#datepicker2').datepicker();
        $('.colorpicker').colorpicker()
        $('#colorpicker3').colorpicker();
    });
    </script>
<script type='text/javascript'>
    $(window).load(function() {
     $('#loading').fadeOut();
    });

 $(document).ready(function() {
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