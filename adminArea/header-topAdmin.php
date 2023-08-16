
<?php
    $pcheck="";
    $mailcheck="";
    $pcaution="";
    if (isset($_POST['signupsig'])) {
        // Process the form
        $options = [
          'cost' => 11,
          'salt' => random_bytes(22),
        ];

        $c_name = escapeString($_POST['c_name']);
        $c_pass = escapeString($_POST['c_pass']);
        $c_pass2 = escapeString($_POST['c_passConf']);
        
        $query3 = "SELECT * FROM adminlog where adm_name like '%$c_name%'";
        $results = mysqli_query($connect, $query3);
        confirm_query($results);

        if (mysqli_num_rows($results) >= 1) {
            $_SESSION['message'] = 'Sorry, this email had been taken. Enter another. Thanks.';

        }elseif ($c_pass !== $c_pass2) {
            $_SESSION['message'] = 'Sorry, password fields do not march. Please correct them.';
        } else{


        

        $hashed_pass = password_hash($c_pass, PASSWORD_BCRYPT, $options);

        $insert_c = "INSERT into adminlog ";
        $insert_c .= " (adm_name, adm_pwd, llogin, signup ";
        $insert_c .= ") values ( ";
        $insert_c .= "'$c_name', '$hashed_pass', now(), now() )";
        
        $run_c = mysqli_query($connect, $insert_c);
        $uid = mysqli_insert_id($connect);

        $_SESSION['message'] = 'Account created. Log in to confirm.';
        
        redirect_to("index.php");
        }

    } 

    if (isset($_POST['addcategory'])) {
        // Process the form
        
        $c_name = escapeString($_POST['c_name']);
        $catdesc = escapeString($_POST['catdesc']);

        $query3 = "SELECT * FROM categories where categ like '%$c_name%'";
        $results = mysqli_query($connect, $query3);
        confirm_query($results);

        if (mysqli_num_rows($results) >= 1) {
            $_SESSION['message'] = 'Sorry, this Category had been entered. Enter another. Thanks.';

        } else{

        $insert_c = "INSERT into categories ";
        $insert_c .= " (categ, catdesc";
        $insert_c .= ") values ( ";
        $insert_c .= "'$c_name', '$catdesc' )";
        
        $run_c = mysqli_query($connect, $insert_c);
        $uid = mysqli_insert_id($connect);

        $_SESSION['message'] = 'Category ADDED';
        
        redirect_to("index.php");
        }

    }

     if (isset($_POST['addsubcategory'])) {
        // Process the form
        
        $sc_name = escapeString($_POST['sc_name']);
        $selectcategory = escapeString($_POST['selectcategory']);
        $subcatdesc = escapeString($_POST['subcatdesc']);
               
        $query3 = "SELECT * FROM subcategories where subcategory like '%$sc_name%'";
        $results = mysqli_query($connect, $query3);
        confirm_query($results);

        if (mysqli_num_rows($results) >= 1) {
            $_SESSION['message'] = 'Sorry, this Subcategory had been entered. Enter another. Thanks.';

        } else{

        $insert_c = "INSERT into subcategories ";
        $insert_c .= " (catId, subcategory, subcatdesc";
        $insert_c .= ") values ( ";
        $insert_c .= " '$selectcategory', '$sc_name', '$subcatdesc' )";
        
        $run_c = mysqli_query($connect, $insert_c);
        $uid = mysqli_insert_id($connect);

        $_SESSION['message'] = 'Subcategory ADDED';
        
        redirect_to("index.php");
        }

    }

?>
<!-- sign up processing end -->

<?php $adm_name = ""; ?>
<?php
  if (isset($_POST['loginlog'])) {
      // Process the form
      // Attempt login

      $s_name = $_POST["adm_name"];
      $s_pass = $_POST["c_pass"];

      $sel_c = "SELECT * from adminlog where adm_pwd='$s_pass' AND adm_name='$s_name'";
      $run_c = mysqli_query($connect, $sel_c);

      $check_customer = attempt_login_staff($s_name, $s_pass);
      
          if($check_customer) {
                  $_SESSION['username'] = $s_name;
                  $_SESSION['message'] = 'You Logged In Successfully, Thanks';

                  $update_login_time = "UPDATE adminlog SET llogin=now() WHERE adm_name='{$s_name}'";
                  $run_update_login_time = mysqli_query($connect, $update_login_time);
                  echo "<script>alert('You Logged In Successfully, Thanks')</script>";
                  echo "<script>window.open('index.php', '_self')</script>";
          }else{
              echo "<script>alert('Password and/or Username is incorrect, Please try again!')</script>";
              $_SESSION['message'] = 'Your Log In Failed, Thanks for trying again!';
              echo "<script>window.open('index.php?home', '_self')</script>";
              exit();
      }
  }
?>



<!-- header start -->
<?php $u = md5(uniqid(mt_rand(), true)); ?>
  <header>
    <!-- header-top-area start -->
    <div class="header-top-area">
      <div class="container">
        <div class="row">
          <!-- header-top-left start -->
          <div class="col-lg-6 col-md-6 col-sm-7">
            <div class="header-top-left">
              <div class="top-message">Welcome, 

                <?php  

                  if (isset($_SESSION['username'])) {

                    $sesmail = $_SESSION['username'];

                    $query = "SELECT * from adminlog where adm_name='$sesmail' LIMIT 1";
                    $run_q = mysqli_query($connect, $query);
                    confirm_query($run_q);

                    $result = mysqli_fetch_assoc($run_q);

                    $adm_name = $result["adm_name"];

                    echo $adm_name .'&nbsp;&nbsp;||&nbsp; &nbsp; <a style="color:#fff;" href="logout.php">LOGOUT</a>'; 
                  } else{
                    
                    echo 'Guest Admin &nbsp;&nbsp;||&nbsp; &nbsp;
                        <span data-toggle="modal" data-target="#cowner"><a href="#" style="color:#fff; "> LOGIN </a></span>';
                  }
                ?>

              </div>
            </div>
          </div>
          <!-- header-top-left end -->
          <!-- header-top-right start -->
          <div class="col-lg-6 col-md-6 col-sm-5">
            <div class="header-top-right">
              <div class="top-menu">
                <ul>
                  <li><a href="#"><?= companyD("compEmail"); ?></a></li>
                </ul>
              </div>
            </div>
          </div>
          <!-- header-top-right end -->
        </div>
      </div>
    </div>
    <!-- header-top-area end -->
    <!-- header-mid-area start -->
    <div class="header-mid-area">
      <div class="container">
        <div class="row">
          <!-- logo start -->
          <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <div class="logo">
              <a href="index.php"><img src="../extrabox/img/logo/<?= companyD("compLogo"); ?>" alt="logo" /></a>
            </div>
          </div>
          <!-- logo end -->
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <!-- header-search start -->
            <div class="header-search">
              
            </div>
            <!-- header-search end -->

              <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner2" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> ADD ADMIN</button></a></p>

              <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner3" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> ADD A CATEGORY</button></a></p>

              <p style="float:left; display:block;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner4" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> ADD A SUBCATEGORY</button></a></p>

              
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <!-- header-search start -->
            <div class="header-search">
              <p><?php echo message(); ?></p>
            </div>
            <!-- header-search end -->
          </div>
        </div>
      </div>
    </div>


    <!-- header-mid-area end -->
    <!-- mainmenu-area start -->
    <div class="mainmenu-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="mainmenu">
              <nav>
                <ul>
                  <li><a href="index.php">ADMIN AREA</a></li>
                </ul>
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- mainmenu-area end -->
    <!-- mobile-menu-area start -->
    <div class="mobile-menu-area">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="mobile-menu">
              <nav id="dropdown">
                <ul>
                  <li><a href="index.php">ADMIN AREA</a></li>
                </ul>
              </nav>
            </div>          
          </div>
        </div>
      </div>
    </div>
    <!-- mobile-menu-area end -->
  </header>
<!-- header end -->


<!-- Modal for log in -->
<div class="modal fade" id="cowner" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header" style="background-color:#3657c9; color: #fff; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="modalLabel" >LOG IN</h5>
            </div>  <!-- modal-header -->
            
            <div class="modal-body" style="background-color:#f0f0f0;">
            <form  action="#" method="post" >
                <div class="form-group" style="text-align: left;">
                    <label for="adm_name" > Name:</label>
                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Name">
                        <input style="width:100%;" class="form-control" type="text" id="adm_name" name="adm_name" value="<?php echo htmlentities($adm_name); ?>" placeholder="Name"  required/>
                    </p>
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="password" > Password:</label>
                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Password">
                    <input style="width:100%;" class="form-control" type="password" id="password" name="c_pass" placeholder="Password"   required/>
                    </p>

                </div>
                    <input style="width:100%; background-color:#3657c9; color: #fff;" class="btn btn-default" type="submit" name="loginlog" value="LOG IN" />
            </form>

            </div>   <!-- modal-body -->
            
            <div class="modal-footer" style="background-color:#3657c9; color: #fff;">
                <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> Close</button>
            </div>
        </div> <!-- modal-content -->
    </div>  <!-- modal-dialog -->
</div>  <!-- end modal -->

<!-- Modal for sign up -->

<div class="modal fade" id="cowner2" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header" style="background-color:#3657c9; color: #fff; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="modalLabel" >ADD ADMIN FORM</h5>
            </div>  <!-- modal-header -->
            
            <div class="modal-body" style="background-color:#f0f0f0;">
            <form  action="#" method="post">
            <div class="form-group" style="text-align: left;">
                    <label for="c_name1" > Name:</label>
                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Name">
                        <input style="width:100%;" class="form-control" type="text" id="c_name1" name="c_name"  placeholder="Name"  required/>
                    </p>
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="password1" > Password:</label>
                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Password">
                    <input style="width:100%;" class="form-control" type="password" id="password1" name="c_pass" placeholder="Password"   required/>
                    </p>
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="password2" > Password Again:</label>
                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Password again">
                    <input style="width:100%;" class="form-control" type="password" id="password2" name="c_passConf" placeholder="Password Again"   required/>
                    </p>
                </div>
                    <input style="width:100%; background-color:#3657c9; color: #fff;" class="btn btn-default" type="submit" name="signupsig" value="SIGN UP" />
            </form>

            </div>   <!-- modal-body -->
            
            <div class="modal-footer" style="background-color:#3657c9; color: #fff;">
                <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> Close</button>
            </div>
        </div> <!-- modal-content -->
    </div>  <!-- modal-dialog -->
</div>  <!-- modal -->


<div class="modal fade" id="cowner3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header" style="background-color:#3657c9; color: #fff; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="modalLabel" >ADD A CATEGORY </h5>
            </div>  <!-- modal-header -->
            
            <div class="modal-body" style="background-color:#f0f0f0;">
            <form  action="#" method="post">
              <div class="form-group" style="text-align: left;">
                  <label for="c_name" > Category Name:</label>
                  <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Category">
                      <input style="width:100%;" class="form-control" type="text" id="c_name" name="c_name"  placeholder="Name"  required/>
                  </p>
              </div>
              <div class="form-group" style="text-align: left;">
              <label for="catdesc"> Category Description </label> 
              <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
                <textarea class="form-control ckeditor" wrap="soft" rows="10" name="catdesc" id="catdesc" placeholder="Please include any other specifications we have to pay attention to."></textarea>
              </p>
                </div>
              <input style="width:100%; background-color:#3657c9; color: #fff;" class="btn btn-default" type="submit" name="addcategory" value="ADD CATEGORY" />
            </form>

            </div>   <!-- modal-body -->
            
            <div class="modal-footer" style="background-color:#3657c9; color: #fff;">
                <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> Close</button>
            </div>
        </div> <!-- modal-content -->
    </div>  <!-- modal-dialog -->
</div>  <!-- modal -->


<div class="modal fade" id="cowner4" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header" style="background-color:#3657c9; color: #fff; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title" id="modalLabel" >ADD A SUBCATEGORY </h5>
            </div>  <!-- modal-header -->
            
            <div class="modal-body" style="background-color:#f0f0f0;">
            <form  action="#" method="post">
              <?php
                $query = "SELECT * FROM categories where catid >= 1 ORDER BY catid asc";
                $run_query = mysqli_query($connect, $query);
                confirm_query($run_query);
                $num_rows = mysqli_num_rows($run_query);
              ?>
                <div class="form-group" style="text-align: left;">
                    <p>Select product's Category</p>
                <select name="selectcategory" id="selectcategory" class="form-control">
                  <option value="">Select a Category</option>
                  <?php 
                    if ($num_rows > 0) {
                      while ($row = mysqli_fetch_array($run_query)) {
                        echo'<option value="'.$row['catid'].'">'.$row['categ'].'</option>';
                      }
                    }else{
                      echo'<option value="">Category not available</option>';
                    }
                  ?>
                </select>
                </div>
                <div class="form-group" style="text-align: left;">
                    <label for="sc_name" > Subcategory Name:</label>
                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Category">
                        <input style="width:100%;" class="form-control" type="text" id="sc_name" name="sc_name"  placeholder="Subcategory Name"  required/>
                    </p>
                </div>
    
              
                <div class="form-group" style="text-align: left;">
                    <label for="subcatdesc"> Subcategory Description </label> 
        <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
          <textarea class="form-control ckeditor" wrap="soft" rows="10" name="subcatdesc" id="subcatdesc" placeholder="Please include any other specifications we have to pay attention to."></textarea>
        </p>
                </div>
                    <input style="width:100%; background-color:#3657c9; color: #fff;" class="btn btn-default" type="submit" name="addsubcategory" value="ADD SUBCATEGORY" />
            </form>

            </div>   <!-- modal-body -->
            
            <div class="modal-footer" style="background-color:#3657c9; color: #fff;">
                <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#3657c9; color: #fff; border: 1px solid #fff;"> Close</button>
            </div>
        </div> <!-- modal-content -->
    </div>  <!-- modal-dialog -->
</div>  <!-- modal -->