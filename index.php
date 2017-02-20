<?php
//include "inc/header.php";
include "lib/User.php";
//include "lib/Session.php";
Session::init();
Session::checkLogin();
?>

<?php
$user = new User();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $usrLogin = $user->userLogin($_POST);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
    header("Location: register.php");
}
?>


<!doctype html>
<html class="no-js" lang="" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>জীবনতরী</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <script src="assets/js/jQuery-v3.1.1.js"></script>
    <!--https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js-->
</head>


<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<!-------------------------- Content-------------------------------->

<!--Nav Bar-->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand text-center">জীবনতরী</a>

        </div>



        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <form action="" method="post" class="navbar-form navbar-right">
                <ul class="nav navbar-nav">
                    <li>
                        <div>
                            <?php
                            if (isset($usrLogin))
                                echo $usrLogin;
                            ?>
                        </div>
                    </li>
                    <li>
                        <div class="form-group">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                     </li>
                    <li>
                        <div class="form-group">
                            <input id="password" type="password" class="form-control" name="password"
                                   placeholder="Password">
                        </div>
                    </li>


                    <li><button type="submit" name="login" class="btn btn-primary">Login</button></li>
                    <li><button type="submit" name="register" class="btn btn-danger">Register</button> </li>

                   <!--<li><button class="btn btn-danger"><a href="register.php"></a>Register</button></li>-->
                </ul>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- -------------------------------Extra Section ------------------------------------>
<div class="extra"></div>

<!-- -------------------------------Slider Section ------------------------------------>
<div id="">
    <div id="jssor_1"
         style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 1300px; height: 580px; overflow: hidden; visibility: hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div
                style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div
                style="position:absolute;display:block;background:url('assets/img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>

        <div data-u="slides"
             style="cursor: default; position: relative; top: 0px; left: 0px; width: 1300px; height: 600px; overflow: hidden;">
            <div data-p="225.00">
                <img data-u="image" src="assets/img/slider1.png"/>
            </div>
            <div data-p="225.00" style="display:none;">
                <img data-u="image" src="assets/img/slider2.jpg"/>
            </div>
            <div data-p="225.00" style="display:none;">
                <img data-u="image" src="assets/img/slider3.jpg"/>
            </div>
        </div>

        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;"
              data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;"
              data-autocenter="2"></span>
    </div>
    <!-- #endregion Jssor Slider End -->
</div>

<!-- About Section -->
<div class="about">
    <div class="container">
        <div class="section-title text-center center">
            <h2>About Us</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-4"><img src="assets/img/donatingBlood.jpg" class="img-responsive"></div>
            <div class="col-md-4">
                <div class="about-text">
                    <h4>Who We Are</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.
                        Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare diam
                        commodo nibh.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.
                        Sed commodo nibh ante facilisis bibendum. </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-text">
                    <h4>What We Do</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis sed dapibus leo nec ornare diam.
                        Sed commodo nibh ante facilisis bibendum dolor feugiat at. Duis sed dapibus leo nec ornare
                        diam.</p>
                    <ul>
                        <li>Lorem ipsum dolor sit amet</li>
                        <li>Consectetur adipiscing commodo</li>
                        <li>Duis sed dapibus leo sed dapibus</li>
                        <li>Sed commodo nibh ante bibendum</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blood --->
<div class="about">
    <div class="container">
        <div class="section-title text-center center">
            <h2>Give Blood Save A Life</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="about-text">
                    <h4>Blood</h4>
                    <p>Blood is the red coloured fluid that flows continuously in a human being's circulatory system.
                        Blood comprises more than 8% of the body weight of a healthy individual. On an average, every
                        adult person has about 5 - 6 litres of blood.</p>
                    <p>The major component of blood is a fluid called plasma in which are suspended cellular elements.
                        These are Red Blood Cells or RBC's, White Blood Cells or WBC's and tiny platelets.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-text">
                    <h4>Blood Donation</h4>
                    <p>
                        The body’s functioning can only be normalized with more human blood in cases where
                        substantial loss of blood has occurred due to accidents or surgery. But spare blood can only be
                        preserved for
                        a maximum of 35 days. Therefore voluntary blood donation becomes essential. A person is also
                        compelled to
                        receive blood donation in instances of excessive bleeding during delivery, platelet reducing
                        diseases like the
                        dengue fever, blood cancer and general deficiency of blood.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="about-text">
                    <h4>Any Bad Effects</h4>
                    <p>
                        Blood donation is a completely safe activity. One need not fear anything when donating blood
                        through blood
                        banks approved by the government. Since the body soon makes up for the donated blood the donor
                        does not feel
                        any fatigue or other illness. In fact, blood donation encourages the body to produce new blood
                        components fast.
                        Only completely sterilized, germ-free needles are to be used for bleed. The donor need only rest
                        for a short
                        period and a light snack.
                    </p>
                </div>
            </div>


        </div>
    </div>
</div>


<!-- Donor -->
<div class="team text-center">
    <div class="container">
        <div class="section-title center">
            <h2>Meet The Donors</h2>
            <hr>
            <h4><a href="register.php">JOIN</a> OUR COMMUNITY, BE A HERO IT'S IN YOUR BLOOD!!</h4><br/><br/>
        </div>
        <div id="row">
            <div class="col-xs-6 col-md-3 col-sm-6">
                <div class="thumbnail"><img src="assets/img/03.jpg" alt="..." class="img-thumbnail team-img">
                    <div class="caption">
                        <h3>Shabaz Abdullah</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-sm-6">
                <div class="thumbnail"><img src="assets/img/10.jpg"" alt="..." class="img-thumbnail team-img">
                    <div class="caption">
                        <h3>Rakibul Huda</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-sm-6">
                <div class="thumbnail"><img src="assets/img/013.jpg"" alt="..." class="img-thumbnail team-img">
                    <div class="caption">
                        <h3>Julhasnain</h3>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-sm-6">
                <div class="thumbnail"><img src="assets/img/16.jpg"" alt="..." class="img-thumbnail team-img">
                    <div class="caption">
                        <h3>Imran Hossain</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Contact Section-->

<div>
    <div id="contact" class="contact text-center">
        <div class="container">
            <div class=" center">
                <h2>Contact</h2>
                <hr>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <div class="col-md-4"><i class="fa fa-map-marker fa-2x"></i>
                    <p>4321 Chawkbazer ,<br>
                        Chittagong, Bangladesh</p>
                </div>
                <div class="col-md-4"><i class="fa fa-envelope-o fa-2x"></i>
                    <p>jibontori768@gmail.com</p>
                </div>
                <div class="col-md-4"><i class="fa fa-phone fa-2x"></i>
                    <p> +880 123 456 1234</p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="col-md-8 col-md-offset-2">
                <h3>Leave us a message</h3>
                <form name="sentMessage" id="contactForm" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                       required="required">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                       required="required">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" class="form-control" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="subject" class="form-control" placeholder="Subject"
                                       required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea name="messages" id="message" class="form-control" rows="4" placeholder="Message"
                                  required></textarea>
                    </div>
                    <div style="font-size: 15px;">
                        <?php
                            include("ContactMail.php");
                            if(isset($_POST['submit'])){
                            echo $message;
                            }
                        ?>

                    </div>
                    <button type="submit" name="submit" class="btn btn-default">Send Message</button>



                </form>
                <div class="social">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-wikipedia-w"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Footer Section-->
<div class="footer">
    <div class=" container text-center">
        <p>Copyright &copy; 2017 জীবনতরী  |  Designed and Developed By Team জীবনতরী </p>
    </div>
</div>


<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
<script src="assets/js/plugins.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>



<!--Slider JS-->
<!-- #region Jssor Slider Begin -->
<!-- Generator: Jssor Slider Maker -->
<!-- Source: http://www.jssor.com -->
<!-- This code works with jquery library.
<script src="assets/js/jquery-1.11.3.min.js" type="text/javascript" data-library="jquery" data-version="1.11.3"></script>-->
<script src="assets/js/jssor.slider-22.0.15.mini.js" type="text/javascript" data-library="jssor.slider.mini"
        data-version="22.0.15"></script>
<script type="text/javascript">
    jQuery(document).ready(function ($) {

        var jssor_1_SlideoTransitions = [
            [{b: -1, d: 1, o: -1}, {b: 0, d: 1000, o: 1}],
            [{b: 1900, d: 2000, x: -379, e: {x: 7}}],
            [{b: 1900, d: 2000, x: -379, e: {x: 7}}],
            [{b: -1, d: 1, o: -1, r: 288, sX: 9, sY: 9}, {
                b: 1000,
                d: 900,
                x: -1400,
                y: -660,
                o: 1,
                r: -288,
                sX: -9,
                sY: -9,
                e: {r: 6}
            }, {b: 1900, d: 1600, x: -200, o: -1, e: {x: 16}}]
        ];

        var jssor_1_options = {
            $AutoPlay: true,
            $SlideDuration: 800,
            $SlideEasing: $Jease$.$OutQuint,
            $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
            },
            $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
            },
            $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
            }
        };

        var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

        /*responsive code begin*/
        /*you can remove responsive code if you don't want the slider scales while window resizing*/
        function ScaleSlider() {
            var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
            if (refSize) {
                refSize = Math.min(refSize, 1920);
                jssor_1_slider.$ScaleWidth(refSize);
            }
            else {
                window.setTimeout(ScaleSlider, 30);
            }
        }

        ScaleSlider();
        $(window).bind("load", ScaleSlider);
        $(window).bind("resize", ScaleSlider);
        $(window).bind("orientationchange", ScaleSlider);
        /*responsive code end*/
    });
</script>


</body>
</html>
