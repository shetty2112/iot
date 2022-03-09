<?php
  
  include "connection.php";

  $data =  $_REQUEST["data"];
  $time = time();
  $reading = explode("@", $data);
  
  $f_id = $reading[0];
  $stop_id = $reading[1];


  $sql1="SELECT * FROM `bus_stops` WHERE id ='$stop_id'";
           $result1=mysqli_query($link,$sql1);
           
           while($row1=mysqli_fetch_assoc($result1))
           {
             $stop=$row1['name'];
           }


      $sql="SELECT * FROM customer WHERE f_id='$f_id'";
           $result=mysqli_query($link,$sql);
           
           while($row=mysqli_fetch_assoc($result))
           {
             $c_id=$row['c_id'];
           }


  $select_path="SELECT * FROM `booking` WHERE `customer_id` = '$c_id' AND `status` = '1'";

  $var=mysqli_query($link,$select_path);

  if(mysqli_num_rows($var) > 0)
  {
    while($row=mysqli_fetch_array($var))
      {
        $id=$row["id"];
        $start_point = $row["start_point"];

           $sql2="SELECT * FROM `bus_stops` WHERE name ='$start_point'";
           $result2=mysqli_query($link,$sql2);
           
           while($row2=mysqli_fetch_assoc($result2))
           {
             $start_id=$row2['name'];
           }

      }

      $cost = 10;

      $update = "UPDATE `booking` SET `end_time`='$time',`end_point`='$stop',`cost`='$cost',`status`='2' WHERE id = '$id'";
      mysqli_query($link,$update);

      echo "%end point updated#";


  }else
    {

      $query_add = "INSERT INTO `booking`( `start_time`,`start_point`, `customer_id`, `status`) VALUES ('$time','$stop','$c_id','1')";
     
      mysqli_query($link,$query_add);

      echo "%start point updated#";

    }

  
?>