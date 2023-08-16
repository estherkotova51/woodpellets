<div class="offcanvas-menu offcanvas-effect">
	<div class="offcanvas-wrap">
        <div class="off-canvas-header">
        	<button type="button" class="close" aria-hidden="true" data-toggle="offcanvas" id="off-canvas-close-btn">&times;</button>
        </div>
        <ul id ="offcanvasMenu" class="list-unstyled visible-xs visible-sm">
			<?php if (isset($_GET['Home'])) { ?>
			<li class="active"><a href="index?<?php echo 'Home'; ?>">Packages<span class="sr-only">(current)</span></a></li>
			<?php }else{ ?>
                  <li><a href="index?<?php echo 'Home'; ?>">Packages</a></li>
            <?php } ?>
			
           
			<?php if (isset($_GET['contact'])) { ?>
			<li class="active"><a href="../contact?<?php echo 'contact'; ?>">Contact<span class="sr-only">(current)</span></a></li>
			<?php   }else{ ?>
			<li><a href="../contact?<?php echo 'contact'; ?>">Contact</a></li>
			<?php } ?>
			
           <?php if (isset($_GET['request'])) { ?>
			<li class="active"><a href="../requestshipping?<?php echo 'request'; ?>">Shipping request<span class="sr-only">(current)</span></a></li>
			<?php   }else{ ?>
			<li><a href="../requestshipping?<?php echo 'request'; ?>">Shipping request</a></li>
			<?php } ?>
		</ul>
	</div>
</div><!-- .offcanvas-menu -->