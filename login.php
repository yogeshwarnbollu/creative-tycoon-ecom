<?php

session_start();

include "connect.php";

date_default_timezone_set('Asia/Kolkata'); 
$d_o_c= date("Y-m-d") ; #date of creation
$t_o_c= date("h:ia") ;  #time of creation

if(isset($_SESSION['main_user_id'])){
      echo "<script>alert('".$_SESSION['main_user_id']."')</script>";

header('location:profile.php');
}
$messag=0;
if(isset($_POST["login"]))
{           
$email_id = mysqli_real_escape_string($con, trim($_POST["email_id"]));
$password = mysqli_real_escape_string($con, trim(md5($_POST["password"])));
 
 $sql = " select * from  customer_details where email='$email_id' and password='$password' ";
  $query = mysqli_query($con,$sql);

  $row = mysqli_num_rows($query);
    if($row == 1){

      $_SESSION['main_user_id'] = $email_id;

if(!empty($_SESSION["Naitik_dasari_123"]))
{   
  foreach($_SESSION["Naitik_dasari_123"] as $keys => $values)
  { 

      $p_qty=$values["product_quantity"];
      $p_id=$values["product_id"];
      $p_color=$values["product_color"];

         $res=mysqli_query($con,"select * from products where id='".$values["product_id"]."'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
                                  $p_name=$row['name'];
                                  $p_rate=$row['price'];
                                  $p_img=$row['img_1'];
                                  $p_s_desc=$row['short_d'];
                              }
                              $p_total=$values["product_quantity"]*$p_rate;


$casdcasd="INSERT INTO hot_order (product_id,product_name,product_color,product_quantity, product_price,product_total,email_id,d_o_c,t_o_c) VALUES ('$p_id','$p_name','$p_color','$p_qty','$p_rate','$p_total','$email_id','$d_o_c','$t_o_c');";
mysqli_query($con,$casdcasd);

}
}
  unset($_SESSION['Naitik_dasari_123']);      


     echo "<script>location.href='profile.php';</script>";
    }
    else{
      $messag =1;
    // echo "<script>alert('Wrong Email or Password')</script>";
    // echo "<script>location.href='login.php';</script>";
    }


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

<!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
<link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
<link href="css/style1.css" rel="stylesheet" type="text/css" media="all" />
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/ionicons.min.css" rel="stylesheet">
<link href="css/main.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="js/datalist/jquery-style.css">

<!-- JavaScripts -->
<script src="js/modernizr.js"></script>

<!-- Online Fonts -->
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,700,900' rel='stylesheet' type='text/css'>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

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
              <li> <a href="#">About </a> </li>
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
          <li><form action="" method="post"><input type="submit" name="log_out" value="LOGOUT" ></form>
                                  </li>';
                   

}
else{
 echo'  <li><a href="register.php">New - Register</a></li>';

                  echo'  <li><a href="login.php">Already a user - LOGIN</a></li>';

}
?>
                  <!-- <li>
                    <h6>HELLO! Jhon Smith</h6>
                  </li>
                  <li><a href="profile.php">ACCOUNT INFO</a></li>
                  <li><a href="#">LOG OUT</a></li> -->
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
        <h4>LOGIN Here</h4>
        
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-20 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-7">
                <h6>LOGIN YOUR ACCOUNT</h6>
                
                  <ul class="row">
                    <form action="" method="POST">
                    <!-- Name -->
                    <li class="col-md-12">
                      <label> EMAIL <br>
                        <input type="text" name="email_id"  placeholder=" Enter Your Email">
                      </label>
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-12">
                      <label> PASSWORD <br>
                        <input type="password" name="password"  placeholder=" Enter Your Password">
                      </label>
                    </li>
                    <?php 
if ($messag==1) {
echo '                    <li class="col-md-12">
                      <label style="color: yellow">Wrong Username or Password</label>
                    </li>';
                  }

                    ?>
                    <!-- LOGIN -->
                    <li class="col-md-4">
                      <a href="profile.php"><button type="submit" name="login" class="btn">LOGIN</button></a>
                    </li>
                    </form>
                    <!-- CREATE AN ACCOUNT -->
                    
                    
                    <!-- FORGET PASS -->
                    <li class="col-md-4">
                      <div class="checkbox margin-0 margin-top-20 text-right">
                        <a href="forgotpass.php">Forgot Password ?</a>
                      </div>
                    </li>
                  </ul>
             
                
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-sm-5">
                <h6>REGISTER</h6>
                
                <ul class="login-with">
                	<li>
                    	<a href="register.php">REGISTER</a>
                    
                    </li>
                    <li>
                      <a href="register.php">SIGN IN WITH GOOGLE</a>
                    
                    </li>
                   
                
                </ul>
                
                
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
        <p>??  2021 Creative Tyconn All right reserved. </p>
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