<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add'])) //checking if the session is set or not
        {
            echo $_SESSION['add']; //diplaying the session message if set
            unset($_SESSION['add']); //removing the session message
        }

        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name:  </td>
                    <td><input type="text" name="full_name"  placeholder="Enter  your name"></td>
                     
                </tr>
                <tr>
                    <td>Username:  </td>
                    <td><input type="text" name="username"  placeholder="Enter  Username"></td>
                     
                </tr>
                <tr>
                    <td>Password:  </td>
                    <td><input type="password" name="password"  placeholder="Enter password"></td>
                     
                </tr>
                <tr>
                    <td colspan="2">
                       <input type="submit" name="submit"  value="Add  Admin" class="btn-secondary">
                    </td>   
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>

<?php 
//process the value from form and save it in database
//check whether the submit button is clicked or not

  if(isset($_POST['submit']))
  {
    //button clicked
    //echo "button clicked";
   
   //get the data from form
   $full_name=$_POST['full_name'];
   $username=$_POST['username'];
   $password=md5($_POST['password']); //password encryption done with md5
   
   //sql query to save the data into database
   $sql = "INSERT INTO tbl_admin SET
   full_name='$full_name',
   username='$username',
   password='$password'
   ";

   //execute query and save data in database
   $res = mysqli_query($conn, $sql) or die(mysqli_error( $mysql));

   //check whether the query or data is executed and inserted or not and display the message
   if($res==true)
   {
    //data inserted
    //create session variable to  display message
    $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
    //redirect page to manage admin
    header("Location:".SITEURL.'admin/manage-admin.php');


   }
   else{
    //failed to insert the data
   //create session variable to  display message
   $_SESSION['add'] = "<div class='error'>Failed to add Admin.</div>";
   //redirect page to add admin
   header("Location:".SITEURL.'admin/add-admin.php');

   }
  }
?>