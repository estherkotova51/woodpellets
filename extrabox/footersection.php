<div id="notifications"></div>
 <!-- jQuery latest -->
 <script type="text/javascript" src="js/jQuery.2.1.4.js"></script>
	
	<!-- js Modernizr -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	
	<!-- js Modernizr -->
	<script src="../../../cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
	<script src="js/jquery.counterup.min.js"></script>

    <!-- Revolution slider -->
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="rs-plugin/js/jquery.themepunch.revolution.min.js"></script>
	
	<!-- Bootsrap js -->
    <script src="js/bootstrap.min.js"></script>
	
	<!-- Plugins js -->
    <script src="js/plugins.js"></script>
	
	<!-- Owl js -->
    <script src="js/owl.carousel.min.js"></script>
	
	<!-- Custom js -->
    <script src="js/main.js"></script>

<!-- DND -->
<script src="extrabox/notifications.js"></script>
<!-- DND -->


<!-- GetButton.io widget -->
<script type="text/javascript">
    (function () {
        var options = {
            whatsapp: "<?= companyD('compWhatsapp'); ?>", // WhatsApp number
            call_to_action: "Message us", // Call to action
            position: "right", // Position may be 'right' or 'left'
        };
        var proto = document.location.protocol, host = "getbutton.io", url = proto + "//static." + host;
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = url + '/widget-send-button/js/init.js';
        s.onload = function () { WhWidgetSendButton.init(host, proto, options); };
        var x = document.getElementsByTagName('script')[0]; x.parentNode.insertBefore(s, x);
    })();
</script>
<!-- /GetButton.io widget -->