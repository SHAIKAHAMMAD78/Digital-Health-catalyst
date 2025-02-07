<?php
  $con = mysqli_connect("localhost","root","","sample");
  if(!$con)
  {
    die("connection error");
  }
  echo "Connection successful";
?>