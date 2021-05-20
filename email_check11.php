<?php include('connect.php');  


  $email = $_POST['cat'];


  $sql = " select * from  customer_details where email='$email' ";
  $query = mysqli_query($con,$sql);

  $row = mysqli_num_rows($query);
    if($row == 1){
     
      $ans="yes";
    }
    else
    {
    $ans="no";
    }
     

$ccc = array(
  'exist'    =>  $ans,
);  

echo json_encode($ccc);



?>

       