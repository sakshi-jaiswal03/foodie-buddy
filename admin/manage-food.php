<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br><br>
            <!--  button to add -->
            <a href="<?php echo SITEURL?>admin/add-food.php" class="btn-primary">Add Food</a>
            <br>
            <br>

            <?php 
              if(isset($_SESSION['add']))
              {
                  echo $_SESSION['add'];
                  unset($_SESSION['add']);
              }
            ?>

            <?php 
              if(isset($_SESSION['unauthorized']))
              {
                  echo $_SESSION['unauthorized'];
                  unset($_SESSION['unauthorized']);
              }
            ?>

            <?php 
              if(isset($_SESSION['delete']))
              {
                  echo $_SESSION['delete'];
                  unset($_SESSION['delete']);
              }
            ?>

            <?php 
              if(isset($_SESSION['no-food']))
              {
                  echo $_SESSION['no-food'];
                  unset($_SESSION['no-food']);
              }
            ?>

            <?php 
              if(isset($_SESSION['update']))
              {
                  echo $_SESSION['update'];
                  unset($_SESSION['update']);
              }
            ?>

            <table class="tbl-full">
              <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
              </tr>

              <?php 
                 //query to select all food from databas
                 $sql = "SELECT * FROM `tbl_food`";

              //executing query
                 $res = mysqli_query($conn, $sql);
               //count rows
                $count = mysqli_num_rows($res);

               $sn = 1;

            //check whether data is there in databse or not
            if($count>0) {
              //data is present so get data and display it
              while($row=mysqli_fetch_assoc($res)){
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];                
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                ?>
                   
                   <tr>
                      <td><?php echo $sn++;?></td>
                      <td><?php echo $title;?></td>
                      <td><?php echo $price;?></td>
                      <td>
                        <?php 
                          if($image_name == ""){

                             echo "<div class='error'>Image Not Added</div>";
                          }
                          else{
                           ?>

                           <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" width="150px">
                           <?php
                          }
                        ?>
                      </td>
                      <td><?php echo $featured;?></td>
                      <td><?php echo $active;?></td>
                      <td>
                        <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id;?>" class="btn-secondary">Update Food</a>
                        <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                      </td>
                   </tr>


                <?php

              }
            }
              else{
                  echo "<tr><td colspan='7' class='error'>No Food Added.</td></tr>";
              }
            
              ?>

            </table>
    </div>
    <div class="clearfix"></div>
</div>

<?php include('partials/footer.php'); ?>