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

                    Guest Admin &nbsp;&nbsp;||&nbsp; &nbsp;
                        <span data-toggle="modal" data-target="#cowner"><a href="#" style="color:#fff; "> LOGIN </a></span>;
                
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

              <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner2" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD ADMIN</button></a></p>

              <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner3" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD A CATEGORY</button></a></p>

              <p style="float:left; display:block;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner4" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD A SUBCATEGORY</button></a></p>

              
            
          </div>
          <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            <!-- header-search start -->
            <div class="header-search">
              <p><?php //echo message(); ?></p>
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

<div class="modal fade" id="cowner3" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                  <div class="modal-header" style="background-color:#298042; color: #fff; text-align: center;">
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
                      <textarea class="form-control" wrap="soft" rows="10" name="catdesc" id="catdesc" placeholder="Please include any other specifications we have to pay attention to."></textarea>
                    </p>
                      </div>
                    <input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="addcategory" value="ADD CATEGORY" />
                  </form>

                  </div>   <!-- modal-body -->
                  
                  <div class="modal-footer" style="background-color:#298042; color: #fff;">
                      <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
                  </div>
              </div> <!-- modal-content -->
          </div>  <!-- modal-dialog -->
      </div>  <!-- modal -->
