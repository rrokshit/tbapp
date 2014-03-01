<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">



        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/jquery.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/jquery.sparkline.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-transition.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-alert.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-modal.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-dropdown.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-scrollspy.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-tab.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-tooltip.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-popover.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-button.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-collapse.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-carousel.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/bootstrap-typeahead.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/datetimepicker.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/jquery.timePicker.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/jquery.timePicker.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/timePicker.js"></script>



        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/fileinput.jquery.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/jquery-ui-1.8.23.custom.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/jquery.touchdown.js"></script>
        <!-- Textarea editor https://github.com/jhollingworth/bootstrap-wysihtml5/ -->
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/justGage.1.0.1/resources/js/raphael.2.1.0.min.js"></script>
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/justGage.1.0.1/resources/js/justgage.1.0.1.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/wysihtml5-0.3.0.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/bootstrap-wysihtml5.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/jquery.peity.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/jquery.uniform.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/textarea-autogrow.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/character-limit.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/jquery.maskedinput-1.3.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/chosen/chosen/chosen.jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/bootstrap-datepicker.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/bootstrap-colorpicker.js"></script>

        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/flot/jquery.flot.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/flot/jquery.flot.stack.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/flot/jquery.flot.pie.js"></script>
        <script language="javascript" type="text/javascript" src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/flot/jquery.flot.resize.js"></script>


        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/scripts.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("input:checkbox, input:file").uniform();
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
                $('#datepicker3').datepicker();
                $('#datepicker4').datepicker();
                $('#datepicker5').datepicker();
                $('#datepicker6').datepicker();
                $('#datepicker7').datepicker();
                $('#datepicker8').datepicker();
                $('#datepicker9').datepicker();
                $('#datepicker10').datepicker();
                $('#datepicker11').datepicker();
                $('#datepicker12').datepicker();
                $('#datepicker13').datepicker();
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


        <!-- Le styles -->
        <link href="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/chosen/chosen/chosen.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseurl; ?>/css/twitter/bootstrap.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseurl; ?>/css/base.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseurl; ?>/css/twitter/responsive.css" rel="stylesheet">
        <link href="<?php echo Yii::app()->theme->baseurl; ?>/css/jquery-ui-1.8.23.custom.css" rel="stylesheet">
        <script src="<?php echo Yii::app()->theme->baseurl; ?>/js/plugins/modernizr.custom.32549.js"></script>


        <title>Travel Bureau Management Application</title>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
              <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
    </head>
    <body>
        <div id="loading">
            <img src="<?php echo Yii::app()->theme->baseurl; ?>/img/ajax-loader.gif">
        </div>


        <div id="sidebar" class="collapse">


            <!-- End sidebar_box -->
            <div class="sidebar_box statistics visible-desktop" style="display:none" >
                <div class="container" style="display:none">
                    <div class="title">
                        <i class="gicon-globe"></i> Estimated earnings
                    </div>

                    <!-- End .title -->
                    <div class="title row-fluid fluid">
                        <i class="gicon-refresh"></i>Real Time Stats
                    </div>


                    <div class="row-fluid fluid">
                        <div class="span6 pagination-centered">
                            <div class="row-fluid">
                                <div id="g1" class="gauge" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="span6 pagination-centered">
                            <div class="row-fluid fluid">
                                <div id="g2" class="gauge" style="display:none">
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
        <div id="main2">
            <div class="container">

                <!-- End container_top -->
                <div class="row-fluid">


                    <?php echo $content ?>


                    <textarea id="text" rows= class="" style="display:none"></textarea>

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

        <!-- End #container -->

        <!-- /container -->
        <!-- Le javascript
            ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->


        <style>
            .radio input[type="radio"], .checkbox input[type="checkbox"]{
                margin-top:-2px;
            }

            #fancybox-left{width:20%!important}
            #fancybox-right{width:20%!important}
        </style>

    </body>
</html>