<?php include('config/constants.php'); ?>
  <?php
  //getting the id of admin to be deleted
  global $id; 
  if(isset($_GET['id'])) 
   {
    $id=$_GET['id'];
   }

//2. create sql query to delete admin
  $sql = "DELETE FROM tbl_admin WHERE id=$id";

  //execute the query
  $res = mysqli_query($conn, $sql);

  //check whether the query is executed succesfully or not
      if($res==TRUE)
      {
        //query executed succesfully and admin deleted
        //create session variable to display the message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully.</div>";
        //redirect to main page
        header('location:'.SITEURL.'admin/manage-admin.php');

      }
      else{
        //failed to delete the admin
        $_SESSION['delete'] = "<div class='error'>Failed to delete Admin. Try again.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
      }


?>