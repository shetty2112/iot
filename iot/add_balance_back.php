<?php 
session_start();
if ((isset($_SESSION['username'])) && isset($_SESSION['amount']))
  {
    $username =  $_SESSION['username'];
    $amount = $_SESSION['amount'];
  }
  else{
    // echo"<script>window.location.href='../index.php';</script>";
    
  }


   require_once ('connection.php');

   
   $sql="SELECT * FROM customer WHERE username='$username'";
   $result=mysqli_query($link,$sql);
   
   while($row=mysqli_fetch_assoc($result))
   {
     $name=$row['name'];
     $c_id=$row['c_id'];
     $balance = $row['balance'];
   }
?>



<?php
  
  include "connection.php";
  
  $time = time();

  $final_balance = $amount + $balance;
  
  $sql = "UPDATE `customer` SET `balance` = '$final_balance' WHERE `customer`.`c_id` = '$c_id';";
  


  if(mysqli_query($link, $sql))
  {
  		$sql1 = "INSERT INTO `transactions`(`customer_id`, `time`, `amount`, `type`,`balance`) VALUES ('$c_id','$time','$amount','0','$final_balance')";
  		mysqli_query($link, $sql1);

          echo"<script> alert('Amount Added Successfully') </script>";
		  echo '<script>window.location.href = "user_dashboard.php";</script>';
   
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error();
}

  
   mysqli_close($conn);
?>