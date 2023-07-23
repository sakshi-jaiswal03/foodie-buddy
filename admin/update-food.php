<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
      <h1>Update Food</h1>
      <br><br>

      <?php
       if(isset($_GET['id']))
       {
         //get id and other details
         $id = $_GET['id'];
         //create quewry
         $sql2 = "SELECT * FROM tbl_food WHERE id=$id";
         $res2 = mysqli_query($conn, $sql2);
         //count number of rows
         $count2 = mysqli_num_rows($res2);
          if($count2==1){

         
            $row2 = mysqli_fetch_assoc($res2);
        
           //get all the data
           $title = $row2['title'];
           $description = $row2['description'];
           $price = $row2['price'];
           $current_image = $row2['image_name'];
           $current_category = $row2['category_id'];
           $featured = $row2['featured'];
           $active = $row2['active'];
         }
         else{
            $_SESSION['no-food'] = "<div class='error'>No Category Found.</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
         }
      }
        else{
            //redirect to manage food
            header('location:'.SITEURL.'admin/manage-food.php');
         }
      ?>


      <form action=" " method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:  </td>
                    <td><input type="text" name="title" value="<?php  echo $title;?>" ></td>
                     
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:  </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:  </td>
                    <td>
                       <?php 
                          if($current_image == "")
                          {
                            
                            echo "<div class='error'>Image Not Available</div>";   
                          }
                          else{
                            ?>
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="150px">
                            <?php 
                            
                          }
 
                       ?>
                    </td> 
                </tr>

                <tr>
                    <td>Select New Image:  </td>
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
                                 $category_id = $row['id'];
                                 $category_title = $row['title'];
                                
                                // echo  "<option value='$category_id'>$category_title</option>";
                                ?>
                                  <option <?php if($current_category==$category_id){ echo "selected";}?> value="<?php echo $category_id;?>"><?php echo $category_title; ?></option>
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
                        <input <?php if($featured=="Yes") { echo "checked"; }?> type="radio" name="featured"  value="Yes">Yes
                        <input <?php if($featured=="No") { echo "checked"; }?> type="radio" name="featured"  value="No">No
                    </td>
                </tr>

                <tr>
                    <td>Active:  </td>
                    <td>
                        <input <?php if($active=="Yes") { echo "checked"; }?> type="radio" name="active"  value="Yes">Yes
                        <input <?php if($active=="No") { echo "checked"; }?> type="radio" name="active"  value="No">No
                    </td> 
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                       <input type="submit" name="submit"  value="Update Food" class="btn-secondary">
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
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category =  $_POST['category'];

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
                       $destination_path = "images/food/".$image_name;
                       if(move_uploaded_file($_FILES["image"]["tmp_name"], $destination_path)) 
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
                         unlink('../images/food/'.$current_image);
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
      $sql3 = "UPDATE tbl_food SET
      title = '$title',
      description = '$description',
      price = '$price',
      image_name = '$image_name',
      category_id = '$category',
      featured = '$featured',
      active = '$active'
      WHERE id='$id'
      ";

      //execute the query
      $res3 = mysqli_query($conn, $sql3);
    
                  if($res3==true){
       //category updated
                    $_SESSION['update']= "<div class='success'>Food Updated Successfully</div>";
                  //   header('location:'.SITEURL.'admin/manage-food.php');
                 }
                 else{
        //failed to update cateory
                    $_SESSION['update'] = "<div class='error'>Failed to Update Food</div>";
                   header('location:'.SITEURL.'admin/manage-food.php');
                }

  }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>