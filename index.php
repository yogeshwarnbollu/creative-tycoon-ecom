<?php include "connect.php";
session_start();
if (isset($_POST['log_out'])) {

  unset($_SESSION['main_user_id']);      
header('location:index.php');

}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="M_Adnan">

<title>Creative Tycoon</title>


<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
 
  <link rel="stylesheet" type="text/css" href="js/datalist/jquery-style.css">

<!-- Custom CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">


<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>




</head>
<body>

<!-- LOADER -->
<div id="loader">
  <div class="position-center-center">
    <div class="ldr"></div>
  </div>
</div>




<!-- Wrap -->
<!-- <div class="main123">
  <div class="nav123"> -->
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
              <li class="active"> <a href="index.php">Home</a>
               
              </li>
              <li> <a href="about_us.php">About </a> </li>
              <li> <a href="shop.php">Shop</a>
              </li>
              <li> <a href="contact.php"> contact</a> </li>
            </ul>
          </div>
          

          <div class="nav-right">
            <ul class="navbar-right">

              <li class="dropdown user-acc"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" ><i class="icon-user"></i> </a>
                <ul class="dropdown-menu">
                  <?php
 if(isset($_SESSION['main_user_id'])){
     $res=mysqli_query($con,"select * from customer_details where email='".$_SESSION['main_user_id']."' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
                                $name=$row['first_name'];
                               }
     echo'          <li>
                    <h6>Hello '.$name.'</h6>
                  </li>
                  <li><a href="profile.php">ACCOUNT INFO</a></li>
          <li><form action="" method="post"><input type="submit" class="log-out-btn" name="log_out" value="LOGOUT" ></form>
                                  </li>';
                   

}
else{
 echo'  <li><a href="register.php">New - Register</a></li>';

                  echo'  <li><a href="login.php">Already a user - LOGIN</a></li>';

}
?>
                
                </ul>
              </li>
   
              <li class="user-basket"> <a href="shopping_cart.php"><i class="icon-basket-loaded"></i> </a>
                
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
             <li>
               <div  class="cust-gift" >
            
            <a href="customgift.php"><button class="btn btn-small">Custom Gift !</button></a>
        <div>
             </li>
            </ul>


          </div>

         
            </div>
          </li>
        </ul>
      </div>
  
            
        </nav>

  </header>
  



<!--======= HOME MAIN SLIDER =========-->
<section class="section" id="one">
<div id="slider">  
	  <?php
    $res=mysqli_query($con,"select * from slideshow ");
                              while($row = mysqli_fetch_array($res)) 
                              {
                              	echo'
<div class="slides">  
  <img src="admin/slideshow_images/'.$row['image'].'" width="100%" />
 </div>';
}
?>
  
<a href="#four"><span></span>Scroll</a>
  
  <div id="dot"><span class="dot"></span><span class="dot"></span><span class="dot"></span><span class="dot"></span></div>
 </div>


</section>






<div id="four"  style="display: flex;">
      <div class="fade">
<img  src="images/sidename.png"></a>

</div>

  <!-- Content -->
  <div style="width: 90%;"> 

    <!-- New Arrival -->
    <section class="padding-top-30">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h2 style="    margin-top: 70px;">Catagories</h2>
        </div>
      </div>

      <div class="category-container">
  <?php
    $res=mysqli_query($con,"select * from category ");
                              while($row = mysqli_fetch_array($res)) 
                              {

echo ' 
      <div class="catag">';
      
$sub_cat=0;
  $dawd=mysqli_query($con,"select * from sub_category where category='".$row['category']."' ");
                              while($raw = mysqli_fetch_array($dawd)) 
                              { $sub_cat=1; }

if ($sub_cat>0) {
  
    echo'   <a href="sub_category.php?cat='.$row['category'].'">';

}
else{
     echo'  <a href="shop.php?cat='.$row['category'].'">';
     }  


        echo '<div class="catag-img">
          <img class="img-123" src="admin/category_images/'.$row['img'].'">
     
        <div class="content-details">
          
        '.$row['category'].'</a>
        </div>
      </div>
      </div>

';


                              }
  ?>


      


    </div>

      
    
    </section>
    
  
    
  
    <!-- Testimonial -->
    <section class="testimonial padding-top-20 padding-bottom-50">
      <div class="container" style="margin-left: 20px; margin-right: 20px;">
        <div class="row">
          <div class="col-sm-4">
            <h3 style="text-align: center;">Customer Review</h3>
           </div>
          <div class="col-sm-8"> 
            
            <!-- SLide -->

            <div class="single-slide"> 
               <div class="testi-in"> <i class="fa fa-quote-left"></i>
                <p>asdasdsa</p>
                <h5>'ccc</h5>
               </div>

              <?php

                  $res=mysqli_query($con,"select * from product_review ");
                              while($row = mysqli_fetch_array($res)) 
                              {
                                if ($row['show_r']=="on") {
                          
echo'             <div class="testi-in"> <i class="fa fa-quote-left"></i>
                <p>'.$row['message'].'</p>
                <h5>'.$row['name'].'</h5>
               </div>';
                                }

            
                 }
            ?>
              
         
              </div>
            </div>
          </div>
          
          
          
        </div>
      </div>
    </section>
 

<div id="modal-content">
  <h2>I Can Haz Email?</h2>
  <label for="yurEmail">Yur Email Adress:</label>
  <input placeholder="I needz it" id="yurEmail">
  <button class="button order-cheezburger">Order Cheezburger</button>
</div>

    

</div>
</a>
</div>
</a>
</div>



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
  
  <!--======= RIGHTS =========--> 
  
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
<script src="js/main.js"></script>

  <script src="js/responsiveslides.min.js"></script>
  <script>
    $(function () {
      $("#slider4").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 1000,
        namespace: "callbacks",
        before: function () {
          $('.events').append("<li>before event fired.</li>");
        },
        after: function () {
          $('.events').append("<li>after event fired.</li>");
        }
      });
    });
  </script>
<script>
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  

  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 2000); // Change image every 2 seconds
}
</script>
</body>
</html>


<?php
  $arrs=array();
    $res=mysqli_query($con,"select * from products ");
                              while($row = mysqli_fetch_array($res)) 
                              {
if (!empty($row['search_tags'])) {
    array_push($arrs, $row['search_tags']);
}
  }
$auto_title=array();

  foreach ($arrs as $value) {
    $getsyu = explode(",",$value);
    foreach ($getsyu as $val) {
        array_push($auto_title,'"'.$val.'"');
}
}

$aas = implode(",",$auto_title);
?>
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
$(window).on("load",function() {
  function fade(pageLoad) {
    var windowTop=$(window).scrollTop(), windowBottom=windowTop+$(window).innerHeight();
    var min=-1, max=1, threshold=0.01;
    
    $(".fade").each(function() {
      /* Check the location of each desired element */
      var objectHeight=$(this).outerHeight(), objectTop=$(this).offset().top, objectBottom=$(this).offset().top+objectHeight;
      
      /* Fade element in/out based on its visible percentage */
      if (objectTop < windowTop) {
        if (objectBottom > windowTop) {$(this).fadeTo(0,min+((max-min)*((objectBottom-windowTop)/objectHeight)));}
        else if ($(this).css("opacity")>=min+threshold || pageLoad) {$(this).fadeTo(0,min);}
      } else if (objectBottom > windowBottom) {
        if (objectTop < windowBottom) {$(this).fadeTo(0,min+((max-min)*((windowBottom-objectTop)/objectHeight)));}
        else if ($(this).css("opacity")>=min+threshold || pageLoad) {$(this).fadeTo(0,min);}
      } else if ($(this).css("opacity")<=max-threshold || pageLoad) {$(this).fadeTo(0,max);}
    });
  } fade(true); //fade elements on page-load
  $(window).scroll(function(){fade(false);}); //fade elements on scroll
});
</script>


<!-- <script>
$("#slideshow > div:gt(0)").hide();

setInterval(function() { 
  $('#slideshow > div:first')
  .fadeOut(1000)
  .next()
  .fadeIn(1000)
  .end()
  .appendTo('#slideshow');
}, 3000);

    </script> -->


    <script>
      
      $(".clear-cookie").on("click", function() {
  Cookies.remove('colorboxShown');
  $(this).replaceWith("<p><em>Cookie cleared. Re-run demo</em></p>");
});

$(".order-cheezburger").on("click", function() {
  $.colorbox.close();
});

function onPopupOpen() {
  $("#modal-content").show();
  $("#yurEmail").focus();
}

function onPopupClose() {
  $("#modal-content").hide();
  Cookies.set('colorboxShown', 'yes', {
    expires: 10
  });
  $(".clear-cookie").fadeIn();
  lastFocus.focus();
}

function displayPopup() {
  $.colorbox({
    inline: true,
    href: "#modal-content",
    className: "cta",
    width: 600,
    height: 350,
    onComplete: onPopupOpen,
    onClosed: onPopupClose
  });
}

var lastFocus;
var popupShown = Cookies.get('colorboxShown');

if (popupShown) {
  console.log("Cookie found. No action necessary");
  $(".clear-cookie").show();
} else {
  console.log("No cookie found. Opening popup in 3 seconds");
  $(".clear-cookie").hide();
  setTimeout(function() {
    lastFocus = document.activeElement;
    displayPopup();
  }, 1000);
}
    </script>


    <script>
      
      (function($){
  var window = $(window),
      one = $('#one'),

      four = $('#four'),
      oneT = one.offset().top,

      fourT = four.offset().top;
  
  function Scroll(div) {
    var tp = $(div).offset().top;
    $('html, body').animate({scrollTop: tp}, 500);
  }

  var tmp=0;
  var mousewheelevt = (/Firefox/i.test(navigator.userAgent)) ? "DOMMouseScroll" : "mousewheel";
  
  $('.section').bind(mousewheelevt, function(e){
    var evt = window.event || e;
    evt = evt.originalEvent ? evt.originalEvent : evt;
    var delta = evt.detail ? evt.detail*(-40) : evt.wheelDelta;
    
    console.log(delta);
    if(delta<0){
      tmp++;
      if(tmp>0){
        var divT = $(this).next();
        Scroll(divT);
        tmp = 0;
      }
    } else if(delta>-1){
      tmp--;
      
      if(tmp<-1){
        var divT = $(this).prev();
        Scroll(divT);
        tmp = 0;
      }
    }
  });
  
})(jQuery);
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

    <script>
      var index = 0;
var slides = document.querySelectorAll(".slides");
var dot = document.querySelectorAll(".dot");

function changeSlide(){

  if(index<0){
    index = slides.length-1;
  }
  
  if(index>slides.length-1){
    index = 0;
  }
  
  for(let i=0;i<slides.length;i++){
    slides[i].style.display = "none";
    dot[i].classList.remove("active");
  }
  
  slides[index].style.display= "block";
  dot[index].classList.add("active");
  
  index++;
  
  setTimeout(changeSlide,4000);
  
}

changeSlide();
    </script>

