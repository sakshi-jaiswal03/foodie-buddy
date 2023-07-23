<?php include('partials/menu.php'); ?>
         
         <!-- Main content Starts -->
        <div class="main-content">
          <div class="wrapper">
            <h1> Manage Admin</h1>
            <br><br>

            <?php
            if(isset($_SESSION['add'])) //checking session is set or not
            {
              echo $_SESSION['add']; //displaying session message
              unset($_SESSION['add']); //removing  session message
            }

            if(isset($_SESSION['delete']))
            {
              echo $_SESSION['delete'];
              unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
              echo $_SESSION['update'];
              unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
              echo $_SESSION['user-not-found'];
              unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
              echo $_SESSION['pwd-not-match'];
              unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
              echo $_SESSION['change-pwd'];
              unset($_SESSION['change-pwd']);
            }

            ?>
            <br><br>

            <!--  button to add -->
            <a href="add-admin.php" class="btn-primary">Add Admin</a>
            <br><br>

            <table class="tbl-full">
              <tr>
                <th>S.No</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
              </tr>
        
              <?php
                  //query to select all from table admin
                  $sql = "SELECT * FROM tbl_admin";
                  //execute the query
                  $res = mysqli_query($conn, $sql);
                  //check whether the query is executed or not
                  if($res==TRUE)
                  {
                    //count rows to chcek whether we have data in database or not
                    $count = mysqli_num_rows($res); //function used to get all number of rows in database that is entered
                    $sno=1; //create a vaiable and assign a value
                    //checking number of rows
                    if($count>0)
                    {
                      //we have data in database
                      while($rows=mysqli_fetch_assoc($res))
                       {
                        ///using while loop to get the data from database
                        //while loop will run as long as we have data in database

                        //getting individual data
                        $id = $rows['id'];
                        $full_name =  $rows['full_name'];
                        $username = $rows['username'];

                        //diplay the values in our table
                        ?>
                           <tr>
                             <td><?php echo $sno++; ?></td>
                             <td><?php echo $full_name; ?></td>
                             <td><?php echo $username; ?></td>
                             <td>
                               <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?> "  class="btn-primary">Change Password</a>
                               <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                               <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                             </td>
                           </tr>

                        <?php 

                      }
                    }

                  }
              ?>

            </table>
          </div>
          <div class="clearfix"></div>
        </div>
         <!-- Main content Ends -->

<?php include('partials/footer.php'); ?>

