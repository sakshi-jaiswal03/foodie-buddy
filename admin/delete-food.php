<?php include('config/constants.php'); ?>

<?php
   if(isset($_GET['id']) && isset($_GET['image_name']))
   {
    //get the value and delete
      $id = $_GET['id'];
      $image_name = $_GET['image_name'];

      if($image_name != ""){
        unlink("../images/food/".$image_name);

      //  $_SESSION['delete']="<div class='success'>Successfully Deleted</div>";
       // header('location:'.SITEURL.'admin/manage-food.php');
      }

      $sql = "DELETE FROM tbl_food WHERE id='$id'";
      $res = mysqli_query($conn, $sql);

      if($res==true){
        $_SESSION['delete']="<div class='success'>Successfully Deleted</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }
      else{
        $_SESSION['delete']="<div class='success'>Failed To Delete</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
      }

   }
   else{
    //set fail msg
    $_SESSION['unauthorized']="<div class='error'>Unauthorized Access</div>";
    //redirect to manage category page with message
    header('location:'.SITEURL.'admin/manage-food.php');
   }

?>