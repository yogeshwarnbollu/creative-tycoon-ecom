<?php 

//$con =mysqli_connect('shareddb-z.hosting.stackcp.net', 'check_work','shri#123','check_work-3136358080');
$con =mysqli_connect('localhost', 'root','','naitik');
 
 mysqli_set_charset( $con, 'utf8');
  if($con === false){
                die("ERROR: Could not connect. " . mysqli_connect_error());
            }


?>