<?php
session_start();

include "connect.php";

if (isset($_POST['log_out'])) {

  unset($_SESSION['main_user_id']);      
header('location:index.php');

}

if (isset($_POST['checkout_to'])) {
$checkout_to = mysqli_real_escape_string($con, trim($_POST["checkout_to"]));

 if(isset($_SESSION['main_user_id'])){
if ($checkout_to==0) {
      echo "<script>alert('CART IS EMPTY, Please Add some Products')</script>";

}
else if($checkout_to>0){
  header('location:checkout.php');
}

}
else{
  if ($checkout_to==0) {
      echo "<script>alert('CART IS EMPTY, Please Add some Products')</script>";

}
else{
  header('location:login.php');
}

}


}




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
        $temp['p_user_img']=$row['user_image'];

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
else if(!empty($_SESSION["Naitik_dasari_123"]))
{
  foreach($_SESSION["Naitik_dasari_123"] as $keys => $values)
  { 
    echo "string";
      echo $p_qty=$values["product_quantity"];

         $res=mysqli_query($con,"select * from products where id='".$values["product_id"]."'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
                                  $p_name=$row['name'];
                                  $p_rate=$row['price'];
                                  $p_img=$row['img_1'];
                                  $p_s_desc=$row['short_d'];
                              }
                              $p_total=$values["product_quantity"]*$p_rate;
         $temp=array();
          $temp['main_id']=$values["main_id"];
        $temp['p_id']=$values["product_id"];
        $temp['p_name']=$p_name;
        $temp['p_color']=$values["product_color"];
        $temp['p_user_img']="";

        $temp['p_rate']=$p_rate;
        $temp['p_qty']=$p_qty;
        $temp['p_tots']=$p_total;
         $temp['p_img']=$p_img;
        $temp['short_d']=$p_s_desc;
array_push($prods,$temp);

}
}

if (isset($_POST['del_product'])) {
 if(isset($_SESSION['main_user_id'])){

$casdcasd="delete from hot_order where id='".$_POST['del_product']."'";
mysqli_query($con,$casdcasd);
     header('location:shopping_cart.php');

}
else if(!empty($_SESSION["Naitik_dasari_123"])){


        foreach($_SESSION["Naitik_dasari_123"] as $keys => $values)
   {

    if($_POST['del_product']==$_SESSION["Naitik_dasari_123"][$keys]['main_id'] )
{

    unset($_SESSION['Naitik_dasari_123'][$keys]);
}

   }


    $_SESSION["Naitik_dasari_123"] = array_values($_SESSION["Naitik_dasari_123"]);
   
     header('location:shopping_cart.php');

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
        <h4>SHOPPING CART</h4>
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="padding-top-10 padding-bottom-50 pages-in chart-page">
      <div class="container"> 



        
        <!-- Payments Steps -->
        <div class="shopping-cart text-center">
          <div class="cart-head">
            <div class="cart-mob">
              <form action="" method="POST">
            <table class="cart-tables">
              <tbody>
                <tr>
                  <th width="50">Product</th>
                  <th>Description</th>
                  <!-- <th>Image</th> -->
                  <th width="10"></th>
                </tr>

         <?php

          foreach ($prods as $array_v) {        
           echo'     <tr>
                  <td style="width: 20%;"><img src="admin/product_images/'.$array_v['p_img'].'">
                  </td>
        
                  <td><p>'.$array_v['p_name'].'</p>
                    <p>Qty : '.$array_v['p_qty'].' <span>Amount : '.$array_v['p_tots'].'</span></p>
                    <p></p>';
  if (!empty($array_v['p_color'])) {
                   echo ' <p>Color : '.$array_v['p_color'].'</p>';
                 }
  if (!empty($array_v['p_user_img'])) {

               echo '     <p>User Image :<a href="admin/user_images/'.$array_v['p_user_img'].'" style="color: red;"> view</a></p>';
             }
                 echo ' </td>
                  <!-- <td><a href="#">Uploaded Image</a></td> -->
                  <td style="text-align: right;"><button type="submit" value="'.$array_v['main_id'].'" name="del_product" class="cart-del-btn">X</button></td>
                </tr>';
}?>

              </tbody>
            </table>
          </form>
          </div>




           <br>
           <div class="cart-wide">
                          <form action="" method="POST">

           <table class="cart-tables">
              <tbody>
                <tr>
                  <th width="50">Product</th>
                  <th style="    padding-left: 50px;">Description</th>
                  <th>User Image</th>
                  <th style="    text-align: center;" width="10">Delete</th>
                </tr>
                 <?php

          foreach ($prods as $array_v) { 
            echo '                <tr>
                  <td style="width: 20%;"><img src="admin/product_images/'.$array_v['p_img'].'">
                  </td>
        
                  <td style="    padding-left: 50px;"><p>'.$array_v['p_name'].'</p>
                    <p>Qty : '.$array_v['p_qty'].' <span>Amount : '.$array_v['p_tots'].'</span></p>
                    <p></p>';
  if (!empty($array_v['p_color'])) {
              echo '  <p>Color : '.$array_v['p_color'].'</p>  ';
}

echo '</td> ';


  if (!empty($array_v['p_user_img'])) {
               echo '       <td style="width: 20%;"><img src="admin/user_images/'.$array_v['p_user_img'].'">    </td>';

}else{
  echo ' <td></td>';
}

                echo '       <td style="    width: 20%;
    text-align: center;"><button type="submit" value="'.$array_v['main_id'].'" name="del_product" class="cart-del-btn">X</button></td>
                </tr>';

              }
              ?>
              </tbody>
            </table>
          </form>
          </div>


        </div>
      </div>
    </section>
    <!--======= PAGES INNER =========-->
    <section class=" padding-bottom-100  shopping-cart small-cart">
      <div class="container"> 
          
        <!-- SHOPPING INFORMATION -->
        <div class="cart-ship-info margin-top-0">


          <div class="row"> 
            <div class="col-sm-12" style="margin-bottom: 20px;">

           <a href="index.php" class="btn" >continue shopping </a>
          </div>
          <br>
            <!-- DISCOUNT CODE -->
          <div class="col-sm-6">
                   <?php   $axfa="disabled";
          $note_upload='LOGIN REQUIRED - <a href="login.php">CLICK HERE</a> ';
 if(isset($_SESSION['main_user_id'])){
$axfa=$note_upload="";
}

// calculate total
                  $tots=0; 
  foreach ($prods as $array_v) {
    $tots+=$array_v['p_tots'];
  }
                


 if(isset($_POST['disc_submit'])){
$code = mysqli_real_escape_string($con, trim($_POST["code"]));
 $amtzz="";
 $rama="";
  $dawd=mysqli_query($con,"select * from hot_discount where email_id='".$_SESSION['main_user_id']."' ");
while($rowa = mysqli_fetch_array($dawd)) 
{
$rama=$rowa['code'];
}

if (empty($rama)) {
 $dawd=mysqli_query($con,"select * from discount where code='$code'");
while($rowa = mysqli_fetch_array($dawd)) 
{     
 $amtzz=$rowa['amount'];

 }
 if (empty($amtzz)) {
       echo "<script>alert('Wrong Code or Code not Exist');</script>";
              echo '<script>window.location="shopping_cart.php"</script>';

       
 }
 else if(!empty($amtzz)){
if ($amtzz>$tots) {
         echo "<script>alert('Discount Cannot be Added');</script>";

}
else{
      $sql="INSERT INTO hot_discount (code,email_id,amount) VALUES ('$code','".$_SESSION['main_user_id']."','$amtzz');";
  mysqli_query($con,$sql);
         echo "<script>alert('Discount Added');</script>";
                echo '<script>window.location="shopping_cart.php"</script>';
}
 }




}
else{
   echo "<script>alert('Only one Discount Code could be applied per Order');</script>";
                echo '<script>window.location="shopping_cart.php"</script>';
}
}
 

 

?>



              <h6>DISCOUNT CODE</h6>
<form action="" method="POST">
                <input style="width: 100%;" name="code" type="text" value="" placeholder="ENTER CODE" <?php echo $axfa?>> 
                <br>
                <button type="submit" name="disc_submit" style="
    margin-top: 20px; margin-bottom: 20px; width: 100%;" class="btn" <?php echo $axfa?>>APPLY CODE</button>
  </form>
    <?php echo $note_upload?>

              <!-- </form> -->
            



          
 
    
  </div>

            
            <!-- SUB TOTAL -->
            <div class="col-sm-5">
              <h6>grand total</h6>
              <div class="grand-total">

                <div class="order-detail">
                <?php
                if (isset($_SESSION['main_user_id'])) {
                  # code...
                
$disc_amount=0;
$cod="";
 $dawd=mysqli_query($con,"select * from hot_discount where email_id='".$_SESSION['main_user_id']."'");
while($rowa = mysqli_fetch_array($dawd)) 
{    
$disc_amount=$rowa['amount'];
$cod=$rowa['code'];
}

                if (isset($_POST['del_disc'])) {
$xwad="delete from hot_discount where email_id='".$_SESSION['main_user_id']."' ";
  if (mysqli_query($con,$xwad)) {
       echo "<script> window.location.href = 'shopping_cart.php'; </script>";
   } 
}
$tots=$tots-$disc_amount;
if (!empty($cod)) {
echo "<form action='' method='POST'>
<p>Discount Code ".$cod." Added - ".$disc_amount." OFF<button type='submit' class='disc-del-btn'  name='del_disc'>X</button></p>
</form>";
}
}
                ?>

                  <!-- SUB TOTAL -->
                  <p class="all-total">TOTAL COST <span> ₹ <?php echo $tots ?></span></p>
                </div>



              </div>
              <form action="" method="POST"> 
              <button class="btn" type="submit" value="<?php echo $tots ?>" name="checkout_to">CHECKOUT</button>
              </form> 
            </div>

          </div>

        </div>

      </div>
    </section>
    
    <!-- About -->
    
    
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