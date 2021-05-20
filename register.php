<?php
session_start();

include "connect.php";

date_default_timezone_set('Asia/Kolkata'); 
$d_o_c= date("Y-m-d") ; #date of creation
$t_o_c= date("h:ia") ;  #time of creation
  
if(isset($_POST["regist"]))
{           
$first_name = mysqli_real_escape_string($con, trim($_POST["first_name"]));
$last_name = mysqli_real_escape_string($con, trim($_POST["last_name"]));
$email = mysqli_real_escape_string($con, trim($_POST["email"]));
$contact = mysqli_real_escape_string($con, trim($_POST["contact"]));
$password = mysqli_real_escape_string($con, trim(md5($_POST["password"])));
$confirm_password = mysqli_real_escape_string($con, trim(md5($_POST["confirm_password"])));
$address_l1 = mysqli_real_escape_string($con, trim($_POST["address_l1"]));
$address_l2 = mysqli_real_escape_string($con, trim($_POST["address_l2"]));
$state = mysqli_real_escape_string($con, trim($_POST["state"]));
$city = mysqli_real_escape_string($con, trim($_POST["city"]));
if ($password ==$confirm_password) {
 $sql="INSERT INTO customer_details (first_name,last_name,email,contact,password,address_l1,address_l2,state,city,d_o_c,t_o_c) VALUES ('$first_name','$last_name','$email','$contact','$confirm_password','$address_l1','$address_l2','$state','$city','$d_o_c','$t_o_c');";
if(mysqli_query($con,$sql)){
         echo "<script> window.location.href = 'login.php'; </script>";
}
}
else{
  alert('PASSWORDS NOT MATCHED');
  echo "<script>   alert('PASSWORDS NOT MATCHED'); </script>";
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
  <link rel="stylesheet" type="text/css" href="js/datalist/jquery-style.css">

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
          <li><form action="" method="post"><input type="submit" class="log-out-btn" name="log_out" value="LOGOUT" ></form>
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
        <h4>REGISTER here</h4>
       
    
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-10 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info register">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-12">
                <h6>REGISTER</h6>
                <form action="" method="POST">
                  <ul class="row">
                    
                    <!-- Name -->
                    <li class="col-md-6">
                      <label> *FIRST NAME <br>
                        <input type="text" name="first_name" value="" placeholder="First Name" required>
                      </label>
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *LAST NAME<br>
                        <input type="text" name="last_name" value="" placeholder="Last Name" required>
                      </label>
                    </li>
                

                    <!-- EMAIL ADDRESS -->
                    <li class="col-md-6">
                      <label> *EMAIL ADDRESS<br>
                        <input type="email" name="email" id="email_id" value="" placeholder="Email"  required>
                      </label>
                    </li>
                                       <!-- PHONE -->
                    <li class="col-md-6">
                      <label> *PHONE<br>
                        <input type="number" name="contact" value="" placeholder="Phone" required>
                      </label>
                    </li>
                    
                                          <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *PASSWORD<br>
                        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"  onkeyup='check();' value="" placeholder="Password" required>
                      </label>
                    </li>
                    
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *CONFIRM PASSWORD<br>
                        <input type="password" onkeyup='check();' name="confirm_password" id="confirm_password" value="" placeholder="Confirm Password" required><br><br><span id='message'></span>
                      </label>
                    </li>
                    <li class="col-md-6"> 
                      <!-- ADDRESS -->
                      <label>*ADDRESS LINE 1<br>
                        <input type="text" name="address_l1" value="" placeholder="Address 1" required> 
                      </label>
                    </li>
                    <li class="col-md-6"> 
                      <!-- ADDRESS -->
                      <label>*ADDRESS LINE 2<br>
                        <input type="text" name="address_l2" value="" placeholder="Address 2" required>
                      </label>
                    </li>
                    
                    <!-- COUNTRY -->
                    <li class="col-md-6">
                      <label> *STATE <br>
                        <select class="selectpicker" name="state" required>
                          <option>MAHARASHTRA</option>
                          <option>MAHARASHTRA</option>
                          <option>ANDHRA PRADESH</option>
                        </select>
                      </label>
                    </li>
                    
                    <!-- TOWN/CITY -->
                    <li class="col-md-6">
                      <label>*TOWN/CITY<br>
                        <input type="text" name="city"  placeholder="Town / City" required>
                      </label>
                    </li>
                    <!-- PHONE -->
                    <li class="col-md-6">
                      <button type="submit" name="regist" class="btn">REGISTER NOW</button>
                    </li>
                  </ul>
                </form>
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
    <script>
  var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
    </script>

<script type="text/javascript">
  $(document).ready(function() {

$(document).on('change', '#email_id', function(){

        var cat = $("#email_id").val();

        $.ajax({
          url: "email_check11.php",
            type: "POST",
                    dataType: "json", 

            data: {cat:cat},
            success : function(data){
if (data.exist=="yes") {
  alert('Email Already Exists');
  document.getElementById("email_id").value = "";
}
            }
        });


      });


  });

</script>

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