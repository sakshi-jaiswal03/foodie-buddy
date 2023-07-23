<?php include('partials-front/menu.php'); ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore</h2>

            <?php 
                 
                 $sql = "SELECT * FROM tbl_category WHERE active='Yes' ";
                  $res = mysqli_query($conn, $sql);
                  $count = mysqli_num_rows($res);
                  if($count>0){
                    while($row=mysqli_fetch_assoc($res)){
                      $id = $row['id'];
                      $title = $row['title'];
                      $image_name = $row['image_name'];
                      ?>
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name == ""){
                                        echo "<div class='error'>Image Not Found</div>";
                                    }
                                    else{
                                       ?>
                                          <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>" alt=" " class="img-responsive img-curve">
                                       <?php
                                    }
                                ?>
                              <h3 class="float-text text-white"><?php echo $title; ?></h3>
                             </div>
                        </a>
                      <?php
                    }
                }
                else{
                    echo "<div class='error'>No Category Found</div>";
                }
  
            ?>

         <!--   <a href="category-italian.html">
            <div class="box-3 float-container">
                <img src="images/menu-pizza.jpg" alt=" " class="img-responsive img-curve">

                <h3 class="float-text text-white">Pizza</h3>
            </div>
            </a>

            <a href="category-italian.html">
            <div class="box-3 float-container">
                <img src="images/menu-burger.jpg" alt=" " class="img-responsive img-curve">

                <h3 class="float-text text-white">Burger</h3>
            </div>
            </a>

            <a href="category-chinese.html">
            <div class="box-3 float-container">
                <img src="images/menu-momo.jpg" alt=" " class="img-responsive img-curve">

                <h3 class="float-text text-white">Momo</h3>
            </div>
            </a>

            <a href="category-indian.html">
            <div class="box-3 float-container">
                <img src="images/menu-biryani.jpg" alt=" " class="img-responsive img-curve">

                <h3 class="float-text text-white">Biryani</h3>
            </div>
            </a>

            <a href="category-chinese.html">
            <div class="box-3 float-container">
                <img src="images/noodles.jpg" alt=" " class="img-responsive img-curve">

                <h3 class="float-text text-white">Chinese</h3>
            </div>
            </a>

            <a href="category-starter.html">
            <div class="box-3 float-container">
                <img src="images/starter.jpg" alt="Momo" class="img-responsive img-curve">

                <h3 class="float-text text-white">Starter</h3>
            </div>
            </a>
            <a href="category-desert.html">
            <div class="box-3 float-container">
                <img src="images/desert.jpg" alt="Pizza" class="img-responsive img-curve">

                <h3 class="float-text text-white">Desert</h3>
            </div>
            </a>

            <a href="category-beverages.html">
            <div class="box-3 float-container">
                <img src="images/beverages.jpg" alt="Burger" class="img-responsive img-curve">

                <h3 class="float-text text-white">Beverages</h3>
            </div>
            </a>

            <a href="category-italian.html">
            <div class="box-3 float-container">
                <img src="images/pasta.jpg" alt="Momo" class="img-responsive img-curve">

                <h3 class="float-text text-white">Pasta</h3>
            </div>
            </a> -->

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php'); ?>