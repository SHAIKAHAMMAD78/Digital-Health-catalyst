<?php
  include("signcon.php");
  if(isset($_POST['Sign Up']))
  {
    $username=$_POST['name'];
    $mobile=$_POST['mobile'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    $sql="select * from signup where name='$username'";
    $result=mysqli_query($con,$sql);
    $count_name=mysqli_num_rows($result);

    $sql="select * from signup where email='$email'";
    $result=mysqli_query($con,$sql);
    $count_email=mysqli_num_rows($result);

    if($count_name == 0 && $count_email == 0)
    {
        $hash = password_hash($password,PASSWORD_DEFAULT);
        $sql="insert into signup(name,mobile,email,password) values('$username','$mobile','$email','$hash')";
        $result=mysqli_query($con,$sql);
        if($result)
        {
            header("Location:login.html");
        }

    }
    else{
        if($count_name>0)
        {
            echo '<script>
               window.location.href="signup.php";
               alert("Username already exists");
            </script>';
        }
        if($count_email>0)
        {
            echo '<script>
               window.location.href="signup.php";
               alert("Email already exists");
            </script>';
        }
    }
  }
?>