<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
      <h1>Update Category</h1>
      <br><br>

      <?php
       if(isset($_GET['id']))
       {
         //get id and other details
         $id = $_GET['id'];
         //create quewry
         $sql = "SELECT * FROM tbl_category WHERE id=$id";
         $res = mysqli_query($conn, $sql);
         //count number of rows
         $count = mysqli_num_rows($res);
        
         if($count==1)
         {
           //get all the data
           $row = mysqli_fetch_assoc($res);
           $title = $row['title'];
           $current_image = $row['image_name'];
           $featured = $row['featured'];
           $active = $row['active'];
         }
         else
         {
        //redirect with session message
           $_SESSION['no-category-found'] = "<div class='error'>No Category Found.</div>";
           header('location:'.SITEURL.'admin/manage-category.php');
         } 
      }
        else{
            //redirect to manage category
            header('location:'.SITEURL.'admin/manage-category.php');
         }
      ?>

        <form action=" " method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="title"  value="<?php echo $title?>" ></td>
                     
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                         if($current_image != "")
                         {
                            //display image
                            ?>
                               <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image;?>" width="150px">
                            <?php
                         }
                         else{
                            //error msg is shown
                             echo "<div class='error'>No Image added</div>";
                         }

                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image"  value=" ">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured=="Yes") { echo "checked"; }?> type="radio" name="featured"  value="Yes">Yes

                        <input <?php if($featured=="No") { echo "checked"; }?> type="radio" name="featured"  value="No">No
                    </td> 
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active=="Yes") { echo "checked"; }?>type="radio" name="active"  value="Yes">Yes

                        <input <?php if($active=="No")  { echo "checked"; }?>type="radio" name="active"  value="No">No
                    </td> 
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                       <input type="submit" name="submit"  value="Update Category" class="btn-secondary">
                    </td>   
                </tr>
            </table>
        </form>
      <?php 
        if(isset($_POST['submit']))
        {
           //get all the values from form
           $id = $_POST['id'];
           $title = $_POST['title'];
           $current_image = $_POST['current_image'];
           $featured = $_POST['featured'];
           $active = $_POST['active'];

            //update the new image
            //check whether image is selected
            if(isset($_FILES['image']['name']))
            {
              //get the image details
             $image_name = $_FILES['image']['name'];
              //check wther image is avai;ab;e or not
              
              if($image_name != "")
              {
                //Get the extension ofour image(png,jpg,gif,etc) e.g "food.jpg"
                //A.upload new img
                $ext = end(explode('.', $image_name));

                //rename the img
                $image_name = "Food_Category_".random_int(000,999).'.'.$ext;

                $source_path = $_FILES ['image'] ['tmp_name'];
                $destination_path = "../images/category/".$image_name;
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination_path)) 
                {
                //echo "The file " .$image( $_FILES['image']['name']). " has been uploaded.";
                  echo "The file has been uploaded.";

                } 
                else
                {
                  echo "Sorry, there was an error uploading your file.";
                }
                 
               //B.remove current img if available
                if($current_image != "")
                {
                 unlink('../images/category/'.$current_image);

                }

              }
              else
              {
                $image_name = $current_image;
              }
                
            
            }

            else
            {
               //not available
              $image_name = $current_image;
            }
           
           //updating the database
              $sql2 = "UPDATE tbl_category SET
              title = '$title',
              image_name = '$image_name',
              featured = '$featured',
              active = '$active'
              WHERE id='$id'
              ";

              //execute the query
              $res2 = mysqli_query($conn, $sql2);
            
              if($res2==true){
               //category updated
                $_SESSION['update']= "<div class='success'>Category Updated Successfully</div>";
                header('location:'.SITEURL.'admin/manage-category.php');
              }
              else{
                //failed to update cateory
               $_SESSION['update'] = "<div class'error'>Failed tp Update Category</div>";
               header('location:'.SITEURL.'admin/manage-category.php');
              }

        }
       ?>


    </div>
</div>
<?php include('partials/footer.php'); ?>
