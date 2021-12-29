<!--footer-->
<footer>
	<div class="container-fluid">
		<div class="w3-agile-footer-top-at">
			<div class="col-md-2 agileits-amet-sed">
				<h4>Company</h4>
				<ul class="w3ls-nav-bottom">
					<li><a href="#about_us.php">About Us</a></li>
					<li><a href="#suppot.php">Support</a></li>
					<li><a href="#sitemap.php">Sitemap</a></li>
					<li><a href="#terms_conditions.php">Terms &amp; Conditions</a></li>
					<li><a href="#faq.php">Faq</a></li>
				</ul>
			</div>

            <div class="col-md-2 agileits-amet-sed ">
				<h4>Payment Options</h4>
				   <ul class="w3ls-nav-bottom">
						<li>Credit Cards</li>
						<li>Debit Cards</li>
						<li>Any Visa Debit Card (VBV)</li>
						<li>Direct Bank Debits</li>
						<li>Cash Cards</li>
					</ul>
			</div>
		</div>
    </div>
	<div class="w3l-footer-bottom">
		<div class="container-fluid">
			<div class="col-md-4 w3-footer-logo">
				<h2><a href="index.php">KGCPAY</a></h2>
			</div>
			<div class="col-md-8 agileits-footer-class">
				<p> <?php $dater = Date('Y'); if (!empty($dater)) {echo "&copy $dater";} ?> KGCPAY. All Rights Reserved  </p>
			</div>
			<a href="#heading_top" id="" class="scroll" style="display: inline-block; color: red; float: right;">
				<span class="fa fa-level-up" title="Back To Top"></span>
			</a>
	 	</div>
	</div>
</footer>
<!--//footer-->

<!-- for bootstrap working -->
		<script src="WTH-Tax_files/bootstrap.js"></script>
<!-- //for bootstrap working --><!-- Responsive-slider -->
    <!-- Banner-slider -->
<script src="WTH-Tax_files/responsiveslides.min.js"></script>
   <script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
  </script>
    <!-- //Banner-slider -->
<!-- //Responsive-slider -->
<!-- Bootstrap select option script -->
<script src="WTH-Tax_files/bootstrap-select.js"></script>
<script>
  $(document).ready(function () {
    var mySelect = $('#first-disabled2');

    $('#special').on('click', function () {
      mySelect.find('option:selected').prop('disabled', true);
      mySelect.selectpicker('refresh');
    });

    $('#special2').on('click', function () {
      mySelect.find('option:disabled').prop('disabled', false);
      mySelect.selectpicker('refresh');
    });

    $('#basic2').selectpicker({
      liveSearch: true,
      maxOptions: 1
    });
  });
</script>
<!-- //Bootstrap select option script -->

<!-- easy-responsive-tabs -->
<link rel="stylesheet" type="text/css" href="WTH-Tax_files/easy-responsive-tabs.css">
<script src="WTH-Tax_files/easyResponsiveTabs.js"></script>
<!-- //easy-responsive-tabs -->
    <!-- here stars scrolling icon -->
			<script type="text/javascript">
				$(document).ready(function() {
					$().UItoTop({ easingType: 'easeOutQuart' });
					});
			</script>
			<!-- start-smoth-scrolling -->
			<script type="text/javascript" src="WTH-Tax_files/move-top.js."></script>
			<script type="text/javascript" src="WTH-Tax_files/easing.js"></script>
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},5000);
					});
				});
			</script>

<?php
	global $conn;
	if (isset($conn)) {
		mysqli_close($conn);
	}
?>
<!-- //body -->

<!-- //html -->
</body></html>