<?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php 
                   $sql = "SELECT * FROM tbl_food WHERE active='Yes' ";

                   $res = mysqli_query($conn, $sql);
                   $count = mysqli_num_rows($res);
                   if($count>0)
                   {
                       while($row=mysqli_fetch_assoc($res)){
                           $id = $row['id'];
                           $title = $row['title'];
                           $price = $row['price'];
                           $description= $row['description'];
                           $image_name = $row['image_name'];
   
                           ?>
                           <div class="food-menu-box">
                               <div class="food-menu-img">
   
                                <?php 
                                     if($image_name == ""){
                                       echo "<div class='error'>No Image</div>";
                                    }
                                    else{
                                ?>
                                 <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt=" " class="img-responsive img-curve">
                                <?php
                                      
                                    }
                                ?>
                                </div>

                                    <div class="food-menu-desc">
                                       <h4><?php echo $title;?></h4>
                                       <p class="food-price"><?php echo $price;?></p>
                                       <p class="food-detail">
                                          <?php echo $description; ?>
                                       </p>
                                       <br>
       
                                      <a href="<?php SITEURL?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                   </div>
                            </div>
       
                               
                            <?php
                           }
                       }
                       else{
                              echo "<div class='error'>Food Not Available</div>";
                       }
            ?>

          <!--  <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-pizza.jpg" alt=" " class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken spl Pizza</h4>
                    <p class="food-price">Rs.450</p>
                    <p class="food-detail">
                        Made with Italian Sauce, Chicken, and pepper.
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

        <!--    <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-burger.jpg" alt=" " class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Smoky Burger</h4>
                    <p class="food-price">Rs.300</p>
                    <p class="food-detail">
                        Made with Chicken, mozarella, pepper and hot sauce
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-biryani.jpg" alt=" " class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Chicken Dum Biryani</h4>
                    <p class="food-price">Rs.420</p>
                    <p class="food-detail">
                        Made with Tandoori Chicken and Indie spices
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-tikka.jpg" alt="  " class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Paneer Tikka</h4>
                    <p class="food-price">Rs.280</p>
                    <p class="food-detail">
                        Made with Cottage Cheese, Cream and Spices
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-rice.jpg" alt=" " class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Fried Rice</h4>
                    <p class="food-price">Rs.380</p>
                    <p class="food-detail">
                        Made with Chinese Sausages 
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div>

            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="images/menu-momo.jpg" alt="Steam Momo" class="img-responsive img-curve">
                </div>

                <div class="food-menu-desc">
                    <h4>Veg Steam Momo</h4>
                    <p class="food-price">Rs.250</p>
                    <p class="food-detail">
                        Made with fresh Veggies
                    </p>
                    <br>

                    <a href="order.html" class="btn btn-primary">Order Now</a>
                </div>
            </div> -->

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>