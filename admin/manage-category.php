<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>
        <!--  button to add -->
        <a href="<?php echo SITEURL ?>admin/add-category.php" class="btn-primary">Add Category</a>
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
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);
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
        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }
        ?>
         <?php 
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
         <?php 
        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.No</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>

            </tr>

            <?php
            //query to select all categories from databas
            $sql = "SELECT * FROM `tbl_category`";

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
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];

            ?>
                <tr>
                <td><?php echo $sn++;?></td>
                <td> <?php echo $title; ?></td>

                <td>
                    <?php 
                    //echo $image_name;
                    //check whether image iis available oor not
                    if($image_name!=""){
                        //display the image
                        ?>
                        
                        <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" width="100px">

                        <?php

                    }
                    else{
                        //display message
                        echo "<div class='error'>Image not added</div>";
                    }
                    
                    ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td> 
                <td>
                  <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id;?>" class="btn-secondary">Update Category</a>
                  <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                </td>
                </tr>

            <?php

              }

            }
            else{
                //data is absent
                ?>
                <tr>
                    <td colspan="6"> <div class="error">No Category Added</td>
                </tr>

                <?php
            }
            ?>
        </table>
    </div>
    <div class="clearfix"></div>
</div>

<?php include('partials/footer.php'); ?>