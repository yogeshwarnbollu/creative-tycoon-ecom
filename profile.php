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




if (isset($_POST['pass_sub'])) {
$current_password = mysqli_real_escape_string($con, trim(md5($_POST["current_password"])));
$password = mysqli_real_escape_string($con, trim($_POST["password"]));
$confirm_password = mysqli_real_escape_string($con, trim($_POST["confirm_password"]));

$res=mysqli_query($con,"select * from customer_details where email='".$_SESSION['main_user_id']."' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
                                if($row['password'] == $current_password)
                                {
                                    if($password == $confirm_password){
                     $maaas=md5($password);
                    $sql="UPDATE customer_details SET password='$maaas'  WHERE email='".$_SESSION['main_user_id']."' ";
                                                mysqli_query($con,$sql);
                                              }
                                              else{
                                                 echo "<script> alert('PASSWORDS NOT MATCHED');</script>";
                                              }


                                }
                                else{
                                                 echo "<script> alert('WRONG CURRENT PASSWORD');</script>";

                                }
                              }
}





if (isset($_POST['regist'])) {
$first_name = mysqli_real_escape_string($con, trim($_POST["first_name"]));
$last_name = mysqli_real_escape_string($con, trim($_POST["last_name"]));
$contact = mysqli_real_escape_string($con, trim($_POST["contact"]));
$address_l1 = mysqli_real_escape_string($con, trim($_POST["address_l1"]));
$address_l2 = mysqli_real_escape_string($con, trim($_POST["address_l2"]));
$state = mysqli_real_escape_string($con, trim($_POST["state"]));
$city = mysqli_real_escape_string($con, trim($_POST["city"]));

 $sql="UPDATE customer_details SET first_name='$first_name',last_name='$last_name',contact='$contact',address_l1='$address_l1',address_l2='$address_l2',state='$state',city='$city' WHERE email='".$_SESSION['main_user_id']."' ";

                   if(mysqli_query($con,$sql)){
                                                 echo "<script> alert('Profile Updated');</script>";

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
        <h4>Profile</h4>
      </div>
    </div>
  </section>
   <!-- About -->
    <section class="small-about padding-top-30">
      <div class="container"> 
          <?php
    $res=mysqli_query($con,"select * from customer_details where email='".$_SESSION['main_user_id']."' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
                                $name=$row['first_name']." ".$row['last_name'];
                                $email=$row['email'];
                                $contact=$row['contact'];
                                $idzsd=$row['id'];
                              }
                              ?>
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>Welcome <br><br> <?php echo $name ?> </h4>
          <p>Email : <?php echo $email ?></p>
          <p>Phone : <?php echo $contact ?></p>
         
        </div>

      </div>
    </section>
  </div>

  <!-- Content -->
  <div id="content"> 
<!--      <div class="heading text-center">
          <h3>YOUR ORDERS</h3>
        </div> -->
    <!-- Blog List -->
     <!--======= PRODUCT DESCRIPTION =========-->
      <section class="padding-bottom-50">
      <div class="container"> 
        <div class="item-decribe"> 
          <!-- Nav tabs -->
          <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
            <li role="presentation" class="active"><a href="#descr" role="tab" data-toggle="tab">ORDERS</a></li>
            <li role="presentation"><a href="#review" role="tab" data-toggle="tab">PROFILE DETAILS</a></li>
            <li role="presentation"><a href="#inbox" role="tab" data-toggle="tab">INBOX</a></li>
          </ul>
         
          </div>
          <!-- Tab panes -->
          <div class="tab-content animate fadeInUp" data-wow-delay="0.4s"> 
            <!-- DESCRIPTION -->
            <div role="tabpanel" class="tab-pane fade in active" id="descr" style="width: 100%;">
            
       <div class="container" style="    border: 1px solid #fff;">
        <div class="row">
          <div class="col-md-12"> 
            
            <!-- Article -->
            <?php
    $res=mysqli_query($con,"select * from order_title where email_id='".$_SESSION['main_user_id']."'");
                              while($row = mysqli_fetch_array($res)) 
                              {
                                echo'
            <article>
               <div class="order-box">
                
                  <div class="row">
                     <div class="order-head">

                    <div class="col-md-4">
                        <span>ORDER # <strong>'.$row['id'].'</strong> </span><br>
                        <span> TOTAL : <strong>'.$row['total_amount'].'</strong></span>
                        </div>
                        <div class="col-md-4">
                        <span>ORDER PLACED : <strong>'.date("d F Y", strtotime($row['d_o_c'])).' '.$row['t_o_c'].'</strong> </span><br>
                        <span>DELIVERY ID : <strong>'.$row['delivery_id'].'</strong></span> <br>
<span>DELIVERY URL : <strong>'.$row['delivery_url'].'</strong></span> 
                        
                      </div>
                      <div class="col-md-4">
                        <div class="textrights">';
                        if (!empty($row['delivery_id'])) {
echo'       
<span>DELIVERY DATE: <strong> '.$row['delivery_date'].' </strong></span><br>
';
}


echo'

<span>DELIVERY STATUS : <strong>'.$row['status'].'</strong> </span><br>';
if ($row['payment_status']=='PAID') {

echo'
<form action="" method="post"><span>AMOUNT PAID: </span><button type="submit" value="'.$row['id'].'" name="invoice_print" class="invo_btn">INVOICE BILL</button></form>';
}
echo'

                         
                       </div>
                      </div>

                    </div>
                  </div>
                </div>';
$ccsd=mysqli_query($con,"select * from order_details where bill_no='".$row['id']."' ");
                              while($raw = mysqli_fetch_array($ccsd)) 
                              {

  $dadwd=mysqli_query($con,"select * from products where id='".$raw['product_id']."'");
                              while($ruw = mysqli_fetch_array($dadwd)) 
                              {                                 $p_id=$ruw['id'];

                                $p_n=$ruw['name'];
                                  $p_img=$ruw['img_1'];
                                  $p_s_desc=$ruw['short_d'];
                                  $p_cat=$ruw['cat'];
                                  $p_ret=$ruw['ret'];
                                  $p_rep=$ruw['rep'];

                             }

      echo '       
      <div class="row">
                <div class="col-sm-3"> 
                 
                  <!-- Post Img --> 
                  <img style="height: 150px;
    width: auto;" class="img-responsive" src="admin/product_images/'.$p_img.'" alt="" > </div>
                <div class="col-sm-2"> 
                  <br>
                  <div class="post-tittle left"> <a href="product_detail.php?id='.$p_id.'" style="    font-size: 18px;"><strong>'.$p_n.'</strong></a> <br><br>
                    <!-- Post Info --> 
                    <div style="color: #fff;">
                  <span>Color '.$p_cat.'</span> </div><br>
                </div>
                </div>
                <div class="col-sm-2">
                  
                  </div>
                  <div class="col-sm-3"> 
                 <p>Your Image</p>
                 
                 <a href="admin/user_images/'.$raw['user_image'].'"> <img style="height: 70px;
    width: auto;" class="img-responsive" src="admin/user_images/'.$raw['user_image'].'" alt="" > </a></div> 
                  
                  <div class="col-sm-2">
                    <div class="text-center">';
                    $asma=$asma_r="";
  $uzumaa=mysqli_query($con,"select * from appeal where o_id='".$raw['id']."'");
                              while($rpw = mysqli_fetch_array($uzumaa)) 
                              {  
$asma=$rpw['r_type'];            
$asma_r=$rpw['r_option'];            

                  }


if ($row['status']=="PENDING"){
  if ($asma=="cancel") {
 echo '
 <p style="font-size: 13px;">ORDER CANCELLED</p>
                      ';

}

  if (empty($asma)) {
  echo '
                      <a href="cancel.php?id='.$raw['id'].'" ><button class="btn" style="margin-top: 5px;
                        line-height: 20px;
                        font-size: 11px;
                        padding:   0px ; width:100%;">CANCEL</button></a>';
}

}


if ($p_ret=="on"){


if ($asma=="return") {
 echo '
 <p style="font-size: 13px;">Return Appealed <br> Reason:'.$asma_r.'.</p>
                      ';

}
else{
  if (empty($asma)) {
  echo '
                      <a href="return.php?id='.$raw['id'].'" ><button class="btn" style="margin-top: 5px;
                        line-height: 20px;
                        font-size: 11px;
                        padding:   0px ; width:100%;">Return</button></a>';
  }

}



}


if ($p_rep=="on"){

if ($asma=="replace") {
 echo ' <p style="font-size: 13px;">Replace Appealed <br> Reason:'.$asma_r.'.</p>
                      ';

}
else{
  if (empty($asma)) {
  echo '
                        <a href="replace.php?id='.$raw['id'].'" ><button class="btn" style="margin-top: 5px;
                        line-height: 20px;
                        font-size: 11px;
                        padding:   0px ; width:100%;">Replace</button></a>
                       ';
                   }
                 }
                     }
                       echo '
                                       
                                        <a href="product_detail.php?id='.$p_id.'" class="btn" style="margin-top: 5px;
                        line-height: 20px;
                        font-size: 10px;
                        padding:   0px ; width:100%;">Write <br>Product Review</a> 
                                    



                    </div>
                
                
              </div>

              <br>
              <br>
              </div>';
}
          

          echo '    
       
       
            </article>';
} ?>
         

</div>
</div>
</div>
</div>
      
          
            
            <!-- REVIEW -->
            <div role="tabpanel" class="tab-pane fade" id="review" style="width: 100%;">
                <form action="" method="POST">
                      <button class="collapsible">Change Password</button>
                      <div class="content1" style="padding-top: 20px;">
                        <div class="contdes">
                        <ul class="row">
                          <li class="col-md-3">

                      <label> CURRENT PASSWORD
                        <input type="password" name="current_password" value="" placeholder="" required>
                      </label>
                    </li>

                    <li class="col-md-3">
                      <label> *PASSWORD
                        <input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters"  onkeyup='check();' value="" placeholder="" required>
                      </label>
                    </li>
                    
                    <!-- LAST NAME -->
                    <li class="col-md-3">
                      <label> *CONFIRM PASSWORD
                        <input type="password" onkeyup='check();' name="confirm_password" id="confirm_password" value="" placeholder="" required><br><br><span id='message'></span>
                      </label>
                    </li>

                    <li class="col-md-3">
                      <lable></lable>
                        <button style="    margin-top: 15px;" class="btn" type="submit" name="pass_sub">SUBMIT</button>
                   
                    </li>
                  </form>
                  </ul>
                </div>
                      </div>
                                      <form action="" method="POST">
                                        <br>
                      <h6 class="margin-t-40">UPDATE PROFILE</h6>
                      <div class="contdes">
                  <ul class="row">

              <?php $res=mysqli_query($con,"select * from customer_details where id='$idzsd' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
                                echo'       
                    
                    <!-- Name -->
                    <li class="col-md-6">
                      <label> *FIRST NAME
                        <input type="text" name="first_name"  placeholder="" value="'.$row['first_name'].'" required>
                      </label>
                    </li>
                    <!-- LAST NAME -->
                    <li class="col-md-6">
                      <label> *LAST NAME
                        <input type="text" name="last_name"  placeholder="" value="'.$row['last_name'].'" required>
                      </label>
                    </li>
                
                    <!-- PHONE -->
                    <li class="col-md-6">
                      <label> *PHONE
                        <input type="number" name="contact"  placeholder="" value="'.$row['contact'].'" required>
                      </label>
                    </li>
                    
                            <li class="col-md-6"> 
                      <!-- ADDRESS -->
                      <label>*ADDRESS LINE 1
                        <input type="text" name="address_l1"  placeholder="" value="'.$row['address_l1'].'" required> 
                      </label>
                    </li>
                    <li class="col-md-6"> 
                      <!-- ADDRESS -->
                      <label>*ADDRESS LINE 2
                        <input type="text" name="address_l2"  placeholder="" value="'.$row['address_l2'].'" required>
                      </label>
                    </li>
                    
                    <!-- COUNTRY -->
                    <li class="col-md-6">
                      <label>*STATE <br>
                        <select class="selectpicker" name="state" required>
                          <option>MAHARASHTRA</option>
                          <option>MAHARASHTRA</option>
                          <option>ANDHRA PRADESH</option>
                        </select>
                      </label>
                    </li>
                    
                    <!-- TOWN/CITY -->
                    <li class="col-md-6">
                      <label>*TOWN/CITY
                        <input type="text" name="city"  placeholder="" value="'.$row['city'].'" required>
                      </label>
                    </li>
                    <!-- PHONE -->
                    <li class="col-md-12">
                    <br>
                      <button type="submit" name="regist" class="btn">UPDATE PROFILE</button>
                    </li>';
                   } ?>
                  </ul>
                </form>
              </div>


          </div>
  
            <!-- TAGS -->
            <div role="tabpanel" class="tab-pane fade" id="inbox" style="width: 100%;">
                <div>
 <?php $res=mysqli_query($con,"select * from messages where cust_id='$idzsd' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
      echo '         <button class="collapsible">'.$row['subject'].'</button>
                      <div class="content2">
                        <p>'.$row['message'].'</p>
                      </div>';
}
?>
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

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
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



    <?php

if (isset($_POST["invoice_print"])) {


$bill_no=$_POST["invoice_print"];

date_default_timezone_set('Asia/Kolkata'); 
$d_o_c= date("d-m-Y") ; #date of creation
$t_o_c= date("h:ia") ;  #time of creation

$printable='  <div class="printer">
  <div class="main-print">
    <div class="print-box">
      <div class="print-header-grid">
        <div class="print-header-img">
        <img src="images/logo.png">
        </div>
        <div class="print-header-grid-title">
          <p>Tax Invoice/Bill of Supply/Cash Memo</p>
          <p>(Original for Recipient)</p>
        </div>
      </div>
      
      
      </div>
    
        <div class="comple-bill-box">
        <div class="print-grid1">
          <div class="grid-item">
          
          <p><strong>Sold By :</strong></p>
          <p>CREATIVE TYCOON</p>
          <p>1913, New Paccha Peth, Opposite To Government Polytechnic College, Solapur - 413005</p>
          <br>
          <br>';
$res=mysqli_query($con,"select * from order_shipping_address where bill_no='$bill_no' ");
                              while($row = mysqli_fetch_array($res)) 
                              {
 
 $dawf=mysqli_query($con,"select * from customer_details where email='".$row['main_email_id']."' ");
                              while($raw = mysqli_fetch_array($dawf)) 
                              {

    $billing_address = $raw['address_l1']." ".$raw['address_l2'];
    $billing_name=$raw['first_name']." ".$raw['last_name'];
    $billing_city=$raw['city'];
    $billing_state=$raw['state'];
  }

$printable.=' 
          <p><strong>Order Number : </strong><span>'.$bill_no.'</span></p>
          <p><strong>Order Date :</strong> <span>'.$row['d_o_c'].'</span></p>
          <br>
          <br>
          </div>
          
          <div class="grid-item1">
            <p><strong>Billing Address :</strong></p>
            <p>'.$billing_name.'</p>
            <p>'.$billing_address.'</p>
            '. $billing_city.', '.$billing_state.'
            <br>
            <p><strong>Shipping Address</strong></p>
            <p>'.$row['first_name'].' '.$row['last_name'].'</p>
            <p>'.$row['address'].'</p>
            '.$row['town'].', '.$row['state'].'
            <br>
            <br>
            <p><strong>Invoice Date :</strong> <span>'.$d_o_c.'</span></p>
            <br>
          </div>
        </div>
        <div >
          <div class="bill-print-table-con">
            <table class="bill-print-table">
            <tr>
                <th width="10">Sr.</th>
                <th>Description</th>
                <th width="30">Qty</th>
                <th width="30">Amount</th>
                <th width="30">Total Amount</th>
              </tr>
              ';
}

$cc=$tot_qty=$main_amt=0;

$res=mysqli_query($con,"select * from order_details where bill_no='$bill_no' ");
                              while($row = mysqli_fetch_array($res)) 
                              {

   $cc++;
 $tot_qty+=$row['product_quantity'];
 $main_amt+=$row['product_total'];
$printable.=' <tr>
                <td>'.$cc.'</td>
                <td>'.$row['product_name'].'</td>
                <td>'.$row['product_quantity'].'</td>
                <td>'.$row['product_rate'].'</td>
                <td>'.$row['product_total'].'</td>
              </tr>';
           
}

$res=mysqli_query($con,"select * from order_title where id='$bill_no' ");
                              while($row = mysqli_fetch_array($res)) 
                              {


if (!empty($row['discount_code'])) {

$printable.='
<tr  style=" border-top: 0.2px solid #808080; border-bottom: 0.2px solid #808080;">
               
                <td style="font-weight: bold;" colspan="5">Discount Code: '.$row['discount_code'].' added. '.$row['discount_amt'].'rs OFF '.$main_amt.'RS </td>
                
              </tr>';

}
$in_words =getIndianCurrency(ceil($row['total_amount']));

$printable.='   <tr  style=" border-top: 0.2px solid #808080; border-bottom: 0.2px solid #808080;">
                <td style="font-weight: bold;"></td>

                <td style="text-align: right; border-right: none; font-weight: bold;  padding-right: 10px;">Total</td>
                
                <td style="font-weight: bold;">'.$tot_qty.'</td>
                <td style="border-right: none;"></td>
                <td style="border-right: none;">'.$row['total_amount'].'</td>
              
              </tr>
              </table>
            <div class="aoum-word">
              <p><strong>Amount in Words : </strong> <span>'.$in_words.'</span></p>
            </div>
            <div class="signa-box">
              <p style="margin-top: 10px;">For Creative Tycoon</p>
              <br>
              <p>Authorized Signature</p>
            </div>
            
          
            
          </div>



        </div>


      </div>
        </div>
        </div>

          <div class="tank-you">
          <p>Thank You!</p>
        </div>
      </div>
    </div>
  
        
      </div>
      


  </div>
</div>
';

}

?>

<div id="divToPrint" style="display:none;">
     <?php 

          echo $printable;  

       // $printable.='<div  style="page-break-after: always;"> </div>'; 
                      // echo $printable;     
  
 // echo $printable;
  ?>      

</div>

<div id="preloader"></div>

 <script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint =  document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=500,height=500');
       popupWin.document.open();
       popupWin.document.write('<html><head><link rel="stylesheet" type="text/css" href="css/print.css"></head><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
                   popupWin.document.close();
                    // popupWin.close();
            }
 </script>

<script type="text/javascript">
     PrintDiv();

window.location.href = 'profile.php';

     </script>



<?php
} 


function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

?> 

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