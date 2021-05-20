<?php 
session_start();

if(!isset($_SESSION['main_user_id'])){
header('location:login.php');
}


if (isset($_POST['log_out'])) {

  unset($_SESSION['main_user_id']);      
header('location:login.php');

}
include "connect.php";
date_default_timezone_set('Asia/Kolkata'); 
$d_o_c= date("Y-m-d") ; #date of creation
$t_o_c= date("h:ia") ;  #time of creation


$prods=array();
 if(isset($_SESSION['main_user_id'])){

         $res=mysqli_query($con,"select * from hot_order where email_id='".$_SESSION['main_user_id']."'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
                                $temp=array();
          $temp['main_id']=$row['id'];

        $temp['p_id']=$row['product_id'];
        $temp['p_name']=$row['product_name'];
        $temp['p_color']=$row['product_color'];
        $temp['p_rate']=$row['product_price'];
        $temp['p_qty']=$row['product_quantity'];
        $temp['p_tots']=$row['product_total'];

  $dadwd=mysqli_query($con,"select * from products where id='".$row['product_id']."'");
                              while($raw = mysqli_fetch_array($dadwd)) 
                              { 
                                  $p_img=$raw['img_1'];
                                  $p_s_desc=$raw['short_d'];

                             }

        $temp['p_img']=$p_img;
        $temp['short_d']=$p_s_desc;


array_push($prods,$temp);
}
}



if (isset($_POST['place_order'])) {
$first_name = mysqli_real_escape_string($con, trim($_POST["first_name"]));
$last_name = mysqli_real_escape_string($con, trim($_POST["last_name"]));
$address = mysqli_real_escape_string($con, trim($_POST["address"]));
$town = mysqli_real_escape_string($con, trim($_POST["town"]));
$state = mysqli_real_escape_string($con, trim($_POST["state"]));
$email = mysqli_real_escape_string($con, trim($_POST["email"]));
$contact = mysqli_real_escape_string($con, trim($_POST["contact"]));

$radio1 = mysqli_real_escape_string($con, trim($_POST["radio1"]));


$disc_code = mysqli_real_escape_string($con, trim($_POST["disc_code"]));
$disc_amount = mysqli_real_escape_string($con, trim($_POST["disc_amount"]));

$total_qty = mysqli_real_escape_string($con, trim($_POST["total_qty"]));
$total_amt = mysqli_real_escape_string($con, trim($_POST["total_amt"]));
$total_main_qty = mysqli_real_escape_string($con, trim($_POST["total_main_qty"]));

if (empty($disc_amount)) {
  $disc_amount=0;
}
$total_amt=$total_amt-$disc_amount;

$check_qty_dis=$disc_amount/$total_main_qty;

if ($radio1=="cash_on_delivery") {
// order-title
  $sql="INSERT INTO order_title (email_id,quantity,total_amount,mode_of_pay,status,discount_code,discount_amt,d_o_c,t_o_c) VALUES ('".$_SESSION['main_user_id']."','$total_qty','$total_amt','$radio1','PENDING','$disc_code','$disc_amount','$d_o_c','$t_o_c');";
mysqli_query($con,$sql);

$inserted_id = mysqli_insert_id($con);


// order-details
$res=mysqli_query($con,"select * from hot_order where email_id='".$_SESSION['main_user_id']."'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
$discount_amn=$row['product_total']-$check_qty_dis;

  $sql="INSERT INTO order_details (bill_no,product_id,product_color,user_image,product_rate,product_quantity,product_total,product_name,email_id,d_o_c,t_o_c,product_discount_total) VALUES ('$inserted_id','".$row['product_id']."','".$row['product_color']."','".$row['user_image']."','".$row['product_price']."','".$row['product_quantity']."','".$row['product_total']."','".$row['product_name']."','".$_SESSION['main_user_id']."','$d_o_c','$t_o_c','$discount_amn');";
mysqli_query($con,$sql);
}



// order-shipping-address
  $sql="INSERT INTO order_shipping_address (bill_no, main_email_id,first_name, last_name,address ,town,state,email,contact,d_o_c,t_o_c ) VALUES ('$inserted_id','".$_SESSION['main_user_id']."','$first_name','$last_name','$address','$town','$state','$email','$contact','$d_o_c','$t_o_c');";
mysqli_query($con,$sql);


  $dell="delete from hot_order where email_id='".$_SESSION['main_user_id']."'";
mysqli_query($con,$dell);

  $dell="delete from hot_discount where email_id='".$_SESSION['main_user_id']."'";
mysqli_query($con,$dell);

echo "<script>alert('ORDER PLACED')</script>";
echo '<script>window.location="profile.php"</script>';


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
        <h4>CHECKOUT</h4>

       
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-50 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 


          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">

            <div class="row"> 

              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-7">
                                      <form action="" method="POST">

                <!-- SHIPPING info -->
                <h6>SHIPPING info</h6>
                  <ul class="row">

                             <?php
$first_name=$last_name=$address=$town=$state=$email=$contact="";

if (isset($_POST['address_list'])) {
 $res=mysqli_query($con,"select * from order_shipping_address where id='".$_POST['address_list']."' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
$first_name =$row['first_name'];
$last_name =$row['last_name'];
$address =$row['address'];
$town =$row['town'];
$state =$row['state'];
$email =$row['email'];
$contact =$row['contact'];

                              }

                            }

        ?>

                    <li class="col-md-12">
                      <label>SELECT ADDRESS<br>
                        <select class="selectpicker" name="address_list" onchange="this.form.submit();" >
<option value="" selected="true" disabled="disabled">s e l e c t</option>
                          <?php
 $res=mysqli_query($con,"select distinct(address) from order_shipping_address where main_email_id='".$_SESSION['main_user_id']."' ");
                              while($row = mysqli_fetch_array($res)) 
                              {

 $daw=mysqli_query($con,"select * from order_shipping_address where address='".$row['address']."' limit 1");
                              while($raw = mysqli_fetch_array($daw)) 
                              {


                                    echo '<option value="'.$raw['id'].'" >'.$raw['address'].'</option>';
                              }

                            }
        ?>
                        </select>
                      </form>
                      </label>

                    </li>
                    <!-- Name -->
                                      <form action="" method="POST">




                    <li class="col-md-6">
                      <label> *FIRST NAME
                        <input type="text" name="first_name" value="<?php echo $first_name?>"  required>
                      </label>
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *LAST NAME
                        <input type="text" name="last_name" value="<?php echo $last_name?>"  required>
                      </label>
                    </li>
                    <li class="col-md-12"> 
                      <!-- ADDRESS -->
                      <label>*ADDRESS
                        <input type="text" name="address" value="<?php echo $address?>"  required>
                      </label>
                    </li>
                    <!-- TOWN/CITY -->
                    <li class="col-md-6">
                      <label>*TOWN/CITY
                        <input type="text" name="town" value="<?php echo $town?>"  required>
                      </label>
                    </li>
                    
                    <!-- COUNTRY -->
                    <li class="col-md-6">
                      <label> *STATE
                        <input type="text" name="state" value="<?php echo $state?>"  required>
                      </label>
                    </li>
                    
                    <!-- EMAIL ADDRESS -->
                    <li class="col-md-6">
                      <label> EMAIL ADDRESS
                        <input type="text" name="email" value="<?php echo $email?>"  >
                      </label>
                    </li>
                    <!-- PHONE -->
                    <li class="col-md-6">
                      <label> *PHONE
                        <input type="text" name="contact" value="<?php echo $contact?>"  required>
                      </label>
                    </li>
                    
                    <!-- PHONE -->
                  <!--   <li class="col-md-6">
                      <button type="submit" class="btn">SUBMIT</button>
                    </li> -->
                  </ul>
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-sm-5">
                <h6>YOUR ORDER</h6>
                <div class="order-place">
                  <div class="order-detail"><?php
                                    $tots=0; 
                                    $tot_qty=0; 
                                    $tot_main_qty=0; 

                       foreach ($prods as $array_v) {
                          $tot_main_qty++;
                            $tots+=$array_v['p_tots'];
                            $tot_qty+=$array_v['p_qty'];

                  echo '  <p style="font-size:20px;">'.$array_v['p_name'].'- '.$array_v['p_color'].' x '.$array_v['p_qty'].'<span>'.$array_v['p_tots'].' </span></p>';
                }
                ?>
                                    <input type="hidden" name="total_main_qty" value="<?php echo $tot_main_qty ?>">

                    <input type="hidden" name="total_qty" value="<?php echo $tot_qty ?>">
                    <input type="hidden" name="total_amt" value="<?php echo $tots ?>">
                    <!-- SUB TOTAL -->

                                 <?php
                if (isset($_SESSION['main_user_id'])) {
               
$disc_amount=0;
$cod="";
 $dawd=mysqli_query($con,"select * from hot_discount where email_id='".$_SESSION['main_user_id']."'");
while($rowa = mysqli_fetch_array($dawd)) 
{    
$disc_amount=$rowa['amount'];
$cod=$rowa['code'];
}

//                 if (isset($_POST['del_disc'])) {
// $xwad="delete from hot_discount where email_id='".$_SESSION['main_user_id']."' ";
//   if (mysqli_query($con,$xwad)) {
//        echo "<script> window.location.href = 'checkout.php'; </script>";
//    } 
// }
$tots=$tots-$disc_amount;
if (!empty($cod)) {
echo "
<p>Discount Code ".$cod." Added - ".$disc_amount." OFF</p>
";
}
}
                ?>

                    <p class="all-total">TOTAL COST <span> <?php echo $tots ?></span></p>
                  </div>
                  <div class="pay-meth">
                    <ul>
                           <li>
                            <input type="hidden" name="disc_code" value="<?php echo $cod ?>">
                            <input type="hidden" name="disc_amount" value="<?php echo $disc_amount ?>">
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio2" value="cash_on_delivery" checked>
                          <label for="radio2"> CASH ON DELIVERY</label>
                        </div>
                      </li>
                      <li>
                        <div class="radio">
                          <input type="radio" name="radio1" id="radio1" value="online" >
                          <label for="radio1"> ONLINE PAYMENT</label>
                        </div>
                      </li>
                 
                      
                      <li>
                        <div class="checkbox">
                          <input id="checkbox3-4" class="styled" type="checkbox" required>
                          <label for="checkbox3-4"> I’VE READ AND ACCEPT THE <span class="color"> TERMS & CONDITIONS </span> </label>
                        </div>
                      </li>
                    </ul>
        <button type="submit" name="place_order" class="btn  btn-dark pull-right margin-top-30" >PLACE ORDER</button>
                   </div>
                </div>
              </div>
 </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- About -->
    <section class="small-about padding-top-50 padding-bottom-50">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>about Creative Tycoon</h4>
          <p>Phasellus lacinia fermentum bibendum. Interdum et malesuada fames ac ante ipsumien lacus, eu posuere odio luctus non. Nulla lacinia,
            eros vel fermentum consectetur, risus purus tempc, et iaculis odio dolor in ex. </p>
        </div>
        
        <!-- Social Icons -->
        <ul class="social_icons">
          <li><a href="#."><i class="icon-social-facebook"></i></a></li>
          <li><a href="#."><i class="icon-social-twitter"></i></a></li>
          <li><a href="#."><i class="icon-social-tumblr"></i></a></li>
          <li><a href="#."><i class="icon-social-youtube"></i></a></li>
          <li><a href="#."><i class="icon-social-dribbble"></i></a></li>
        </ul>
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
      $(window).on("scroll", function() {
    if($(window).scrollTop() > 100) {
        $("header").addClass("scrollto");
    } else {
        //remove the background property so it comes transparent again (defined in your css)
       $("header").removeClass("scrollto");
    }
});
    </script>