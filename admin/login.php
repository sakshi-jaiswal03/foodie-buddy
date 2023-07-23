<?php include('config/constants.php'); 

?>

<html>
    <head>
        <title>Login - Foodie Buddy</title>
        <link rel="stylesheet" href="../css/admin.css">

    </head>

    <body>
    <div class="login">
      <h1 class="text-center">LOGIN</h1>
      <br><br>

      <?php
      if(isset($_SESSION['login']))
      {
          echo $_SESSION['login'];
          unset ($_SESSION['login']);
      }

      if(isset($_SESSION['no-login-message'])){
        echo $_SESSION['no-login-message'];
        unset ($_SESSION['no-login-message']);
      }
      ?>
      <br><br>
      <!-- login form starts -->
        <form action="" method="POST">
          Username:<br>
          <input type="text" name="username" placeholder="Enter Username"><br><br>
          
          Password:<br>
          <input type="password" name="password" placeholder="Enter Password"><br><br>
          
          <input type="submit" name="submit" class="btn-secondary" value="Login">
          <br><br>
        </form>
      <!-- login form ends -->
      <p class="text-center"> Created by- <a href=" ">Sakshi Jaiswal </a>
    </div> 
    </body>
</html>

<?php
//check whther the submit button is clicked or not 
if(isset($_POST['submit']))
{
    //process for login
    //1. Get the data from login form
    //$username = $_POST['username'];
    $username =mysqli_real_escape_string($conn, $_POST['username']);
    
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   // $password = md5($_POST['password']);

    //2. create sql query to check whether the user with username and password exists or not
    $sql = " SELECT * FROM tbl_admin WHERE username='$username' AND password='$password' ";
    
    //3. execute the query
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {

    //4. count the number of rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if($count==1)
    {
        //user available and login successful
        $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
        $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

        header('location:'.SITEURL.'admin');
    }
    else
    {
        //user not available and login failed
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
        header('location:'.SITEURL.'admin/login.php');
    }
}
}

?>