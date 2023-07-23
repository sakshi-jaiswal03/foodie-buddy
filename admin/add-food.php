<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>

        <?php 
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <br><br>

        <form action=" " method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:  </td>
                    <td><input type="text" name="title"  placeholder="Food Title"></td>
                     
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of Food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:  </td>
                    <td>
                        <input type="number" name="price" >
                    </td>
                </tr>

                <tr>
                    <td>Select Image:  </td>
                    <td>
                        <input type="file" name="image" >
                    </td> 
                </tr>

                <tr>
                    <td>Category:  </td>
                    <td>
                        <select name="category" >
                         <?php 
                            //display categories from database
                            $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                            $res = mysqli_query($conn, $sql);

                            $count = mysqli_num_rows($res);

                            if($count>0)
                            {
                              while($row = mysqli_fetch_assoc($res))
                              {
                                 $id = $row['id'];
                                 $title = $row['title'];
                                 ?>
                                     <option value="<?php echo $id;?>" ><?php echo $title; ?></option> 

                                 <?php
                              }     
                            }
                            else{
                              ?>
                              <option value="0" >No Category Found</option>
                              <?php
                            }
                         ?>                           

                        </select>
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
                       <input type="submit" name="submit"  value="Add Food" class="btn-secondary">
                    </td>   
                </tr>
            </table>

        </form>

        <?php
            if(isset($_POST['submit']))
            {
              $title = $_POST['title'];
              $description = $_POST['description'];
              $price = $_POST['price'];
              $category = $_POST['category'];

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
           
              //upload img if selected
              if(isset($_FILES['image']['name']))
              {
                //upload image
                //to upload image we need image name, source path and destination path
               $image_name = $_FILES['image']['name'];
                
                //upload img if img is selected
                if($image_name != "")
                {
                  //Get the extension ofour image(png,jpg,gif,etc) e.g "food.jpg"
                 // $ext = end(explode('.', $image_name));
                   $tmp = explode('.', $image_name);
                  $ext = end($tmp);

                  //rename the img
                  $image_name = "Food_Category_".random_int(000,999).'.'.$ext;

                  $source_path = $_FILES ['image'] ['tmp_name'];
                  $destination_path = "../images/food/".$image_name;

                  if (move_uploaded_file($_FILES["image"]["tmp_name"], $destination_path)) {
                    //echo "The file " .$image( $_FILES['image']['name']). " has been uploaded.";
                    echo "The file has been uploaded.";
                    } else {
                    echo "Sorry, there was an error uploading your file.";
                    }
                }
              }
                else
                {
                        //do not upload image and set value as blank
                        $image_name = " ";
                }

            $sql2 = " INSERT INTO `tbl_food` SET
            title = '$title',
            description = '$description',
            price = '$price',
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            ";

            $res2 = mysqli_query($conn, $sql2);
            if($res2 == true)
            {
                //query executed and category added
                $_SESSION['add']= "<div class='success'>Food Added Successfully.</div>";
                //redirect to category page
                header('location:'.SITEURL.'admin/manage-food.php');
            }
            else{
                //failed to execute query
                $_SESSION['add']= "<div class='error'>Failed to add Food.</div>";
                //redirect to category page
                header('location:'.SITEURL.'admin/add-food.php');
            }

            
            }


        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>