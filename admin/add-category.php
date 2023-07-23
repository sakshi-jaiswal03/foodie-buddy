<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>

        <?php 
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        ?>
        <br><br>

       <!-- add category form starts -->
       <form action=" " method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:  </td>
                    <td>
                        <input type="text" name="title"  placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image" value="Upload Image">
                    </td>
                </tr>
                
                <tr>
                    <td>Featured:  </td>
                    <td>
                        <input type="radio" name="featured"  value="Yes">Yes
                        <input type="radio" name="featured"  value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:  </td>
                    <td>
                        <input type="radio" name="active"  value="Yes">Yes
                        <input type="radio" name="active"  value="No">No
                    </td> 
                </tr>

                <tr>
                    <td colspan="2">
                       <input type="submit" name="submit"  value="Add Category" class="btn-secondary">
                    </td>   
                </tr>

            </table>

        </form>
       <!-- add category form ends -->

       <?php 
        //check whther the submit button is clicked or not
        if(isset($_POST['submit']))
        {
            //get the value from the category form
            $title= $_POST['title'];

            //check whther the radio button is clicked or not
            if(isset($_POST['featured']))
            {
               //get value from form
                $featured = $_POST['featured'];
            }
            else{
                //set the default value
                $featured = "No";
            }
            if(isset($_POST['active']))
            {
               //get value from form
                $active = $_POST['active'];
            }
            else{
                //set the default value
                $active = "No";
            }

            //check whther the image is seleted or not and set value for image name accodingly
            //print_r($_FILES['image']);

            //die();//break the code here
           
            if(isset($_FILES['image']['name']))
            {
              //upload image
              //to upload image we need image name, source path and destination path
            $image_name = $_FILES['image']['name'];
              
              //upload img if img is selected
              if($image_name != "")
              {

              
                //Auto rename img
                //Get the extension ofour image(png,jpg,gif,etc) e.g "food.jpg"
                $ext = end(explode('.', $image_name));

                //rename the img
                $image_name = "Food_Category_".random_int(000,999).'.'.$ext;

                $source_path = $_FILES ['image'] ['tmp_name'];
                $destination_path = "../images/category/".$image_name;

                //upload  the image
                //$upload = move_uploaded_file($source_path, $destination_path);

                //check if the image is uploaded or not
                //if($upload==false)
                //{

                //  $_SESSION['upload']= "<div class='error'>Failed to add Image</div>";
                  //redirect to category page
                  //header('location:'.SITEURL.'admin/add-category.php');
                  //stop  process
                  //die();
                //}

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination_path)) {
                //echo "The file " .$image( $_FILES['image']['name']). " has been uploaded.";
                echo "The file has been uploaded.";
                } else {
                echo "Sorry, there was an error uploading your file.";
                }
            
             }
            }
            else{
                //do not upload image and set value as blank
                $image_name = " ";
            }
            //create sql query to add category into database 
            $sql = "INSERT INTO tbl_category SET
            title =  '$title',
            image_name = '$image_name',
            featured = '$featured',
            active = '$active'
            ";

            //execute query and save data in database
            $res = mysqli_query($conn, $sql);

            //check whether the query is executed or not
            if($res==true)
            {
                //query executed and category added
                $_SESSION['add']= "<div class='success'>Category Added Successfully.</div>";
                //redirect to category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else{
                //failed to execute query
                $_SESSION['add']= "<div class='error'>Failed to add Category.</div>";
                //redirect to category page
                header('location:'.SITEURL.'admin/add-category.php');
            }

        }
       ?>
    </div>
</div>

<?php include('partials/footer.php'); ?>