<?php include('config/constants.php'); ?>
<?php
//check whether id and image_name value is set or not
if(isset($_GET['id']) && isset($_GET['image_name']))
{
 //get the value and delete
  $id = $_GET['id'];
  $image_name = $_GET['image_name'];
  
  //remove image if available
  // if($image_name != ""){
    //image is available
    /// unlink('images/category/'.$image_name);
  
    //  $_SESSION['delete']="<div class='success'>Category Successfully Deleted</div>";
     // header('location:'.SITEURL.'admin/manage-category.php');

      //die();
   
     // }
   
   
    //if(unlink($root.'foodie-buddy/images/category/'.$image_name)){
  //remove data from database
   $sql = "DELETE FROM tbl_category WHERE id='$id'";
   $res = mysqli_query($conn, $sql);
    //}
   
   //check whether query is executed
  if($res==true){
     $root = $_SERVER['DOCUMENT_ROOT'];
    unlink($root.'foodie-buddy/images/category/'.$image_name);
    //set sucxcess msg
    $_SESSION['delete']="<div class='success'>Successfully Deleted</div>";
     header('location:'.SITEURL.'admin/manage-category.php');
}
  else  
  {
//set fail msg
     $_SESSION['delete']="<div class='error'>Failed to delete</div>";
     //redirect to manage category page with message
     header('location:'.SITEURL.'admin/manage-category.php');
  
  }
}
?>