



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="M_Adnan">
<title>Creative Tycoon</title>

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
<link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
  <link rel="stylesheet" type="text/css" href="js/datalist/jquery-style.css">

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>

<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Dancing+Script&family=Parisienne&family=Sacramento&display=swap" rel="stylesheet">

</head>
<body>

<!-- LOADER -->
<div id="loader">
  <div class="position-center-center">
    <div class="ldr"></div>
  </div>
</div>

<!-- Wrap -->
<div id="wrap"> 
  
  <!-- header -->
  <header>
    <div class="sticky">
      <div class="container"> 
        
     
        <div class="logo"> <a href="index.php"><img class="img-responsive" src="images/logo.png" alt="" ></a> </div>
        <nav class="navbar ownmenu">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-open-btn" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"><i class="fa fa-navicon"></i></span> </button>
          </div>
          
       
          <div class="collapse navbar-collapse" id="nav-open-btn">
            <ul class="nav">
              <li> <a href="index.php">Home</a>
               
              </li>
                  <li  class="active"> <a href="about_us.php">About </a> </li>
              <li> <a href="shop.php">Shop</a>
                
              </li>
          

             
              

              
              <li> <a href="contact.php"> contact</a> </li>
            </ul>
          </div>
          

          <div class="nav-right">
            <ul class="navbar-right">

              <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ><i class="icon-user"></i> </a>
                <ul class="dropdown-menu">
                  <li>
                    <h6>HELLO! Jhon Smith</h6>
                  </li>
                  <li><a href="#">MY CART</a></li>
                  <li><a href="#">ACCOUNT INFO</a></li>
                  <li><a href="#">LOG OUT</a></li>
                </ul>
              </li>
   
              
              
   
              <li class="dropdown"> <a href="javascript:void(0);" class="search-open"><i class=" icon-magnifier"></i></a>
                <div class="search-inside animated bounceInUp"> <i class="icon-close search-close"></i>
                  <div class="search-overlay"></div>
                  <div class="position-center-center">
                       <div class="search">
                      <?php
                        if (isset($_POST['search_sub'])) {
                        $sear = mysqli_real_escape_string($con, trim($_POST["sear"]));
                          echo "<script>location.href='shop.php?search=".$sear."';</script>";
                       }
                      ?>
                      <form action="" method="POST">
                        <input type="text" id="tags"  name="sear" placeholder="Search Shop">
                        <button type="submit" name="search_sub"><i class="icon-check"></i></button>
                      </form>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>


  
  <!--======= SUB BANNER =========-->
  <section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
      <div class="container">
        <h4>ABOUT Creative Tycoon</h4>

      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!-- History -->
    <section class="history-block padding-top-30 padding-bottom-100">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 center-block">
            <div class="col-xs-11 center-block">
              <h4>Know About Us </h4>
              <p style="font-size: 18px;"> We Creative Tycoons are leading in different fields of work under Goodwill of “Chandra Group” in South-western Region of Solapur Maharashtra. Our constant focus on innovation has helped us to emerge as trendsetter in different markets and be well known for our unbeatable products & services. <br><br>

We endeavour to make our customers experience delightful with the exceptional services. We are a team of Dedicated, Hard work and Creatively talented chaps whose only motive is to offer unique and prominent products and services. 
 <br>
 </p>
            </div>
            
            <!-- IMG --> 
            <div class="padding-top-50">

              <div class="col-sm-11 center-block">
                <h4>Our Vission</h4>
                <p style="font-size: 18px;">We courageously take on challenges, using deep customer insights and suggestion to develop innovative services.
We give you some of the most practical, doable yet beautiful ideas to pick from! </p>
              </div>
            </div>


            <div class="padding-top-50">

              <div class="col-sm-11 center-block">
                <h4>Our mission</h4>
                <p style="font-size: 18px;">Our mission is to offer a customers a "WOW Experience" through the contineous innovation of premium products & services by using  world class technology and processes  </p>
              </div>
            </div>
            </div>


          </div>
        </div>
      </div>
    </section>


        <section class="history-block padding-top-30 padding-bottom-100">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 center-block">
<div class="col-sm-12">
 
              <h3 style="text-align: center;">What Do We Stand For ?</h3>
             
            </div> 
            <div class="adbout_stands">
              <h5 class="text-center">Customer Centricity</h5>
              <div class="position_img">
              <div class="col-lg-4">
                <div class="hex"><img class="hex-img" src="images\Customer-Centricity.jpg" alt="some"></div>
              </div>
            </div>
              <div class="col-lg-8">
                <div class="adbout_stands1">
                <p style="font-size: 18px;">Customer coms first, We think of the customer first is a every business workflow and decision</p></div>
              </div>
            </div>

            <div class="adbout_stands1">
            <div class="adbout_stands2">
              <h5 class="text-center">Trust & Integrity</h5>
              <div class="position_img1">
              <div class="position_img">
              <div class="col-lg-4 ">
                <div class="hex"><img class="hex-img" src="images\Trust-&-Integrity.jpg" alt="some"></div>
              </div>
            </div>
            </div>
              <div class="col-lg-8">
                <div class="adbout_stands1">
                <p class="textalign">Ethical business, honest policies for customers, partners & employees</p></div>
              </div>
              <div class="position_img2">
              <div class="col-lg-4 ">
                <div class="hex"><img class="hex-img" src="images\Trust-&-Integrity.jpg" alt="some"></div>
              </div>
            </div>
            </div>
          </div>
            <div class="adbout_stands1">
            <div class="adbout_stands2">
              <h5 class="text-center">Accountability</h5>
              <div class="position_img">
               <div class="col-lg-4">
                <div class="hex"><img class="hex-img" src="images\Accountability.jpg" alt="some"></div>
              </div>
            </div>
              <div class="col-lg-8">
                <div class="adbout_stands1">
                <p style="font-size: 18px;">100% Ownership of every thing that we do, we respect deadlines</p></div>
              </div>
             
            </div>
          </div>

            <div class="adbout_stands1">
            <div class="adbout_stands2">
              <h5 class="text-center">Profitability</h5>
                <div class="position_img1">
              <div class="position_img">
              <div class="col-lg-4 ">
                <div class="hex"><img class="hex-img" src="images\Profitability.jpg" alt="some"></div>
              </div>
            </div>
            </div>
              <div class="col-lg-8">
                <div class="adbout_stands1">
                <p class="textalign">we aim for profitability everything we do</p></div>
              </div>
              <div class="position_img2">
              <div class="col-lg-4">
                <div class="hex"><img class="hex-img" src="images\Profitability.jpg" alt="some"></div>
              </div>
             </div>
            </div>
          </div>
            <div class="adbout_stands1">
            <div class="adbout_stands2">
              <h5 class="text-center">Cost-Conscious</h5>
              <div class="position_img">
               <div class="col-lg-4">
                <div class="hex"><img class="hex-img" src="images\Cost-Conscious.jpg" alt="some"></div>
              </div>
            </div>
              <div class="col-lg-8">
               <div class="adbout_stands1">
                <p style="font-size: 18px;">We spend wisely, we look at all apportunities to save cost</p></div>
              </div>
              
             
            </div>
          </div>
        </div>
      </div>
    </section>



        
    
   
 

    <!-- News Letter -->
    <section class="news-letter padding-top-30 padding-bottom-30">
      <div class="container">
        <div class="heading light-head text-center margin-bottom-10">
          <h4>SUBSCRIBE TO GET NEW OFFERS</h4>
          <!-- <span>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odi </span> --> </div>

          <?php
          if (isset($_POST['subs'])) {
            date_default_timezone_set('Asia/Kolkata'); 
$d_o_c= date("Y-m-d") ; #date of creation
$t_o_c= date("h:ia") ;  #time of creation
  
             $email=$_POST['email'];
$sql="INSERT INTO subs (email,d_o_c,t_o_c) VALUES ('$email','$d_o_c','$t_o_c');";
  mysqli_query($con,$sql); 
echo "<script>alert('THANK YOU FOR SUBSCRIPTION')</script>";
          }


          ?>
        <form action="" method="post">
          <input type="email" name="email" placeholder="Enter your email address" required>
          <button type="submit" name="subs">SEND ME</button>
        </form>
      </div>
    </section>
  </div>
  
  <!--======= FOOTER =========-->
  <footer>
    <div class="container">  
      
      <!-- ABOUT Location -->
      <div class="col-md-4">
        <div class="about-footer"> <img  src="images/logo.png" alt="" >
         <!--  <p><i class="icon-pointer"></i> Street No. 12, Newyork 12, <br>
            MD - 123, USA.</p>
          <p><i class="icon-call-end"></i> 1.800.123.456789</p>
          <p><i class="icon-envelope"></i> info@creativetycoon.com</p> -->
        </div>
      </div>
      
      <!-- HELPFUL LINKS -->
      <div class="col-md-4">
        <h6>Email Us</h6>
        <a href="">info@creativetycoon.com</a>
      </div>
      
      <!-- SHOP -->
     
      
      <!-- MY ACCOUNT -->
      <div class="col-md-4">
      
       <a href="#">Terms and conditions</a><br>
       <a href="#">Privacy Policy</a>
        
      </div>
      
      <!-- Rights -->
      
      <div class="rights">
        <p>©  2021 Creative Tyconn All right reserved. </p>
        <p>Developed by Strawhats</p>
        <!-- <div class="scroll"> <a href="#wrap" class="go-up"><i class="lnr lnr-arrow-up"></i></a> </div> -->
      </div>
    </div>
  </footer>
</div>
<script src="js/jquery-1.11.3.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/own-menu.js"></script> 
<script src="js/jquery.lighter.js"></script> 
<script src="js/owl.carousel.min.js"></script> 

<!-- SLIDER REVOLUTION 4.x SCRIPTS  --> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.t.min.js"></script> 
<script type="text/javascript" src="rs-plugin/js/jquery.tp.min.js"></script> 
<script src="js/main.js"></script> 

<!-- Begin Map Script --> 
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=false'></script> 
<script type="text/javascript">
/*==========  Map  ==========*/
var map;
function initialize_map() {
if ($('#map').length) {
	var myLatLng = new google.maps.LatLng(-37.814199, 144.961560);
	var mapOptions = {
		zoom: 17,
		center: myLatLng,
		scrollwheel: false,
		panControl: false,
		zoomControl: true,
		scaleControl: false,
		mapTypeControl: false,
		streetViewControl: false
	};
	map = new google.maps.Map(document.getElementById('map'), mapOptions);
	var marker = new google.maps.Marker({
		position: myLatLng,
		map: map,
		tittle: 'Envato',
		icon: './images/map-locator.png'
	});
} else {
	return false;
}}
google.maps.event.addDomListener(window, 'load', initialize_map);
</script>
</body>
</html>



<script src="js/datalist/jquery-ui.js"></script>

<script>
  $( function() {
    var availableTags = [<?php echo $aas;?>];
    $( "#tags" ).autocomplete({
      source: availableTags
    });
   } );
  </script>

      <script>
      $(window).on("scroll", function() {
    if($(window).scrollTop() > 100) {
        $("header").addClass("scrollto");
    } else {
        //remove the background property so it comes transparent again (defined in your css)
       $("header").removeClass("scrollto");
    }
});
    </script>