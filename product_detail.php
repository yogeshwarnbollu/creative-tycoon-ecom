<?php include "connect.php"; 
error_reporting(0);

session_start();

if (isset($_POST['log_out'])) {

unset($_SESSION['main_user_id']);      
header('location:index.php');

}
$id222="";
if (isset($_GET['id'])) {
    $id222=$_GET['id'];
}
date_default_timezone_set('Asia/Kolkata'); 
$d_o_c= date("Y-m-d") ; #date of creation
$t_o_c= date("h:ia") ;  #time of creation

if(isset($_POST["add_to_cart"]))
    {
$idz = mysqli_real_escape_string($con, trim($_POST["add_to_cart"]));
$qty = mysqli_real_escape_string($con, trim($_POST["quantity"]));
$color = mysqli_real_escape_string($con, trim($_POST["get_color"]));
  
$filename = $_FILES["img_upload"]["name"];
$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
$file_ext = substr($filename, strripos($filename, '.')); // get file name

 if(isset($_SESSION['main_user_id'])){


         $res=mysqli_query($con,"select * from products where id='".$idz."'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
                                  $p_name=$row['name'];
                                  $p_rate=$row['price'];
                                  $p_img=$row['img_1'];
                                  $p_s_desc=$row['short_d'];
                              }
                              $p_total=$qty*$p_rate;

     $newfilename="";
    if (!empty($file_basename)) {
     $newfilename = md5($file_basename).rand(1000, 9999).$file_ext;
     move_uploaded_file($_FILES["img_upload"]["tmp_name"], "admin/user_images/" . $newfilename);
    }
$casdcasd="INSERT INTO hot_order (product_id,product_name,product_color,user_image,product_quantity, product_price,product_total,email_id,d_o_c,t_o_c) VALUES ('$idz','$p_name','$color','$newfilename','$qty','$p_rate','$p_total','".$_SESSION['main_user_id']."','$d_o_c','$t_o_c');";
mysqli_query($con,$casdcasd);
    

 
}
else if(!empty($_SESSION["Naitik_dasari_123"]))
{
      $main_id_s=0;
        foreach($_SESSION["Naitik_dasari_123"] as $keys => $values)
   {

    if($main_id_s<$_SESSION["Naitik_dasari_123"][$keys]['main_id'] )
{
  $main_id_s=$_SESSION["Naitik_dasari_123"][$keys]['main_id'] ;
}
   }
      $main_id_s++;

      $item_array = array(
        'main_id'                 =>     $main_id_s,  
        'product_id'               =>     $idz,  
        'product_quantity'         =>     $qty,
         'product_color'         =>     $color

      );
      $_SESSION["Naitik_dasari_123"][] = $item_array;
    }
      else
    { 
      $main_id_s=1;

      $item_array = array(
        'main_id'                 =>     $main_id_s,  
        'product_id'               =>     $idz,  
        'product_quantity'         =>     $qty,
        'product_color'         =>     $color

      );
      $_SESSION["Naitik_dasari_123"][] = $item_array;
    }

    
       echo '<script>window.location="shopping_cart.php"</script>';

}










if (isset($_POST['sub_review'])) {

$r_name = mysqli_real_escape_string($con, trim($_POST["r_name"]));
$r_email = mysqli_real_escape_string($con, trim($_POST["r_email"]));
$r_mes = mysqli_real_escape_string($con, trim($_POST["r_mes"]));
$sub_review = mysqli_real_escape_string($con, trim($_POST["sub_review"]));

 $sql="INSERT INTO product_review (name,email,message,p_id,d_o_c,t_o_c) VALUES ('$r_name','$r_email','$r_mes','$id222','$d_o_c','$t_o_c');";
if(mysqli_query($con,$sql)){
    echo "<script>  alert('THANK YOU FOR YOUR REVIEW');</script>";

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
              <li> <a href="#">About </a> </li>
              <li class="active"> <a href="shop.php">Shop</a>
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
  <section>

  </section>
  
  <!-- Content -->
  <div id="content"> 




    
    <!-- Popular Products -->
    <section class="padding-top-150 padding-bottom-50">
      <div class="container"> 


          




        <!-- SHOP DETAIL -->
        <div class="shop-detail">
          <?php 
          $axfa="disabled";
          $note_upload='LOGIN REQUIRED - <a href="login.php">CLICK HERE</a> ';
 if(isset($_SESSION['main_user_id'])){
$axfa="";
$note_upload="";
}
$catax="";
              $res=mysqli_query($con,"select * from products where id='$id222'");
                              while($row = mysqli_fetch_array($res)) 
                              {  
                                
$catax=$row['cat'];

                               $raman=$r_text=''; if ($row['user_img'] =="on") { 
                                 if(isset($_SESSION['main_user_id'])){
                                $raman=''; }
                                else{
                                  $raman='disabled';
                                }



                                 
                                }
  if ($row['out_of_stock']=="on") {
                                  $raman='disabled'; $r_text="Product out of Stock";
                                                                      }



                                echo '
          <div class="row"> 
            
            <!-- Popular Images Slider -->
            <div class="col-md-4"> 
              
          
        
              <!-- Images Slider -->
              <div class="images-slider">
                <ul class="slides">
                  <li data-thumb="admin/product_images/'.$row['img_1'].'"> <img class="img-responsive" style="height:auto;" src="admin/product_images/'.$row['img_1'].'" alt="">
                  <div class="papular-block">
                  <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a style="font-size: 200px;" href="admin/product_images/'.$row['img_1'].'" data-lighter><i class="icon-magnifier"></i></a></div>
                </div>
              </div> </li>
                  <li data-thumb="admin/product_images/'.$row['img_2'].'"> <img class="img-responsive" style="height:auto;" src="admin/product_images/'.$row['img_2'].'"  alt=""><div class="papular-block"> <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a style="font-size: 200px;" href="admin/product_images/'.$row['img_2'].'" data-lighter><i class="icon-magnifier"></i></a></div>
                </div>
              </div> </li>
                  <li data-thumb="admin/product_images/'.$row['img_3'].'"> <img class="img-responsive" style="height:auto;" src="admin/product_images/'.$row['img_3'].'"  alt="">
                  <div class="papular-block">
                  <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a style="font-size: 200px;" href="admin/product_images/'.$row['img_3'].'" data-lighter><i class="icon-magnifier"></i></a></div>
                </div>
              </div> </li>
                </ul>
              </div>
            </div>
            
            <!-- COntent -->
            <div class="col-md-5 padding-top-50">
              <h4>'.$row['name'].'</h4>
              <span class="price"><small>₹</small>'.$row['price'].'</span> 
              
              <!-- Sale Tags -->
              <!-- <div class="on-sale"> 10% <span>OFF</span> </div> -->
              <ul class="item-owner">
                <li>Category :<span> '.$row['cat'].'</span></li>
              </ul>
              
              <!-- Item Detail -->
              <p>'.$row['short_d'].'</p>
              
              <!-- Short By -->
              <div class="some-info">
                <ul class="row margin-top-30">
                  <li class="col-xs-4">
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="quinty"> 
                      <!-- QTY -->
                      <select class="selectpicker" name="quantity">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>

                      </select>
                    </div>
                  </li>
                  
                  <!-- COLORS -->
             <br><br><br>
                  
                  <!-- ADD TO CART -->
                  <li class="col-xs-6">
        <button type="submit" name="add_to_cart" class="btn" value="'.$row['id'].'" '.$raman.'>ADD TO CART</button>
     <ul class="item-owner">
                <li>'.$r_text.'</li>
              </ul>
                   </li>
       


                </ul>';
                




                echo'
              </div>
               </div>';
               if ($row['user_img'] =="on") {   
                if ($row['user_img'] =="on") { $aman='required';  }

                echo '   <!-- COntent -->
            <div class="col-md-3">
              <h4>Upload Image</h4>
              
              <!-- Item Detail -->
                 <label for="img" style="color: #fff;">Select image:</label>
                 <input class="choo-file" type="file" onchange="ValidateSize(this.id)"  name="img_upload" accept="image/x-png,image/gif,image/jpeg" '.$aman.' '.$axfa.'  >
                 <p>'.$note_upload.'</p>
              <br>
                         ';
               }
      $aman="";
               if ($row['color'] =="on") {
if ($row['color'] =="on") { $aman='required';  }
echo'
              <!-- Short By -->
    <br>
             

              <label for="img" style="color: #fff;">Select Colors:</label><br>
              <div class="color-btn">
        <input style="    padding: 4px;
    margin-bottom: 10px; width:100%;" type="text" id="get_color" oninvalid="InvalidMsg(this);" 
            class="readonly"  name="get_color" placeholder="Choose color"  title="Pick a Color" '.$aman.'>
<br> 
              <button class="red" id="red" onclick="myFunction(this.id)"></button>
              <button class="green" id="green" onclick="myFunction(this.id)"></button>
              <button class="white" id="white" onclick="myFunction(this.id)"></button>
              <button class="blue" id="blue" onclick="myFunction(this.id)"></button>
              <button class="black" id="black" onclick="myFunction(this.id)"></button>
              <button class="gray" id="gray" onclick="myFunction(this.id)"></button>
              <button class="yellow" id="yellow" onclick="myFunction(this.id)"></button>
              <button class="skyblue" id="skyblue" onclick="myFunction(this.id)"></button>
               </div>
                <ul class="row margin-top-30">
                  ';
                  }
         echo '         
                  <!-- ADD TO CART -->
            </ul>
             </form>   
                <!-- INFOMATION -->
              
         
            </div>
      
          </div>';
        }

              $xxczc=mysqli_query($con,"select * from del_details limit 1");
                              while($www = mysqli_fetch_array($xxczc)) 
                              {         
 echo'              <!-- INFOMATION -->
                <div class="inner-info padding-top-70">
                  <h6>DELIVERY INFORMATION</h6>
                  <p>'.$www['del'].'</p>
                  <h6>SHIPPING & RETURNS</h6>
                  <p>'.$www['ship'].'</p>
                </div>';

}
          ?>
          
        
        <!--======= PRODUCT DESCRIPTION =========-->
        <div class="item-decribe padding-top-50"> 
          <!-- Nav tabs -->
          <ul class="nav nav-tabs animate fadeInUp" data-wow-delay="0.4s" role="tablist">
            <li role="presentation" class="active"><a href="#descr" role="tab" data-toggle="tab">DESCRIPTION</a></li>
            <li role="presentation"><a href="#review" role="tab" data-toggle="tab">REVIEW </a></li>
            <!-- <li role="presentation"><a href="#tags" role="tab" data-toggle="tab">INFORMATION</a></li> -->
          </ul>
          
          <!-- Tab panes -->
          <div class="tab-content animate fadeInUp" data-wow-delay="0.4s"> 
            <!-- DESCRIPTION -->
            <div role="tabpanel" class="tab-pane fade in active" id="descr">
               <?php 

              $res=mysqli_query($con,"select * from products where id='$id222'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
                                echo '
              <p>'.$row['long_d'].'</p>';
        }
          ?>
       <!--        <h6>THE SIMPLE FACTS</h6>
              <ul>
                <li>
                  <p>Praesent faucibus, leo vitae maximus dictum,</p>
                </li>
                <li>
                  <p> Donec porta ut lectus </p>
                </li>
                <li>
                  <p> Phasellus maximus velit id nisl</p>
                </li>
                <li>
                  <p> Quisque a tellus et sapien aliquam sus</p>
                </li>
                <li>
                  <p> Donec porta ut lectus </p>
                </li>
                <li>
                  <p> Phasellus maximus velit id nisl</p>
                </li>
              </ul> -->
            </div>
            
            <!-- REVIEW -->
            <div role="tabpanel" class="tab-pane fade" id="review" style="width: 100%;">
              <h6>REVIEWS </h6>
          
<?php
  $res=mysqli_query($con,"select * from product_review where p_id='$id222'");
                              while($row = mysqli_fetch_array($res)) 
                              { 
echo '
              <!-- REVIEW PEOPLE 1 -->
              <div class="media">
                <div class="media-left"> 
                              <!--  Details -->
                <div class="media-body">
                  <p class="font-playfair">“
'.$row['message'].'
                  ”</p>
                  <h6>'.$row['name'].' <span class="pull-right">'.$row['d_o_c'].'</span> </h6>
                </div>
              </div>
         ';
         }
         ?>

              
              <!-- ADD REVIEW -->
              <h6 class="margin-t-40">ADD REVIEW</h6>
              <form action="" method="post">
                <ul class="row">
                  <li class="col-sm-6">
                    <label> *NAME
                      <input type="text" name="r_name" placeholder="" required>
                    </label>
                  </li>
                  <li class="col-sm-6">
                    <label> *EMAIL
                      <input type="email" name="r_email" placeholder="" required>
                    </label>
                  </li>
                  <li class="col-sm-12">
                    <label> *YOUR REVIEW
                      <textarea name="r_mes" maxlength="250" placeholder="250 chars only" required></textarea>
                    </label>
                  </li>
               
                  <li class="col-sm-6">
                    <button type="submit" name="sub_review" class="btn btn-dark btn-small pull-right no-margin">POST REVIEW</button>
                  </li>
                </ul>
              </form>
            </div>
            
            <!-- TAGS -->
            <div role="tabpanel" class="tab-pane fade" id="tags"> </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Popular Products -->
    <section class="dark-gray-bg padding-top-50 padding-bottom-50">
      <div class="container"> 
        
        <!-- Main Heading -->
        <div class="heading text-center">
          <h4>SIMILAR PRODUCTS</h4>
        </div>
        
        <!-- Popular Item Slide -->
        <div class="papular-block block-slide"> 
          
<?php
$res=mysqli_query($con,"select * from products where cat='$catax' limit 10");
                              while($row = mysqli_fetch_array($res)) 
                              {  
echo'
          <!-- Item -->
          <div class="item"> 
            <!-- Item img -->
            <div class="item-img"> <img class="img-1" src="admin/product_images/'.$row['img_1'].'" alt="" > <img class="img-2" src="admin/product_images/'.$row['img_2'].'" alt="" > 
              <!-- Overlay -->
              <div class="overlay">
                <div class="position-center-center">
                  <div class="inn"><a href="admin/product_images/'.$row['img_1'].'" data-lighter><i class="icon-magnifier"></i></a> <a href="product_detail.php?id='.$row['id'].'"><i class="icon-basket"></i></a></div>
                </div>
              </div>
            </div>
            <!-- Item Name -->
            <div class="item-name"> <a href="product_detail.php?id='.$row['id'].'">'.$row['name'].'</a>
              <p>'.$row['short_d'].'</p>
            </div>
            <!-- Price --> 
            <span class="price"><small>₹</small>'.$row['price'].'</span> </div>
';
}
?>

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
        function InvalidMsg(textbox) { 
  
            if (textbox.value === '') { 
                textbox.setCustomValidity 
                      ('Choose a Color !'); 
            } else { 
                textbox.setCustomValidity(''); 
            } 
  
            return true; 
        } 
    </script> 
<script>
    $(".readonly").on("keydown paste focus mousedown", function(e){
        if(e.keyCode != 9) // ignore tab
            e.preventDefault();
    });
</script>
<script>
  function myFunction(file) {

  document.getElementById('get_color').value=file;
   
}

  function ValidateSize(file) {
    var fileUpload = document.getElementById(file);
        if (typeof (fileUpload.files) != "undefined") {
            var size = parseFloat(fileUpload.files[0].size / 1024).toFixed(2);
            if (size>1000) {
                          alert("File Excceds 1 mb ");
                     $(fileUpload).val(''); //for clearing with Jquery

            }
        } else {
        }

      }
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
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>