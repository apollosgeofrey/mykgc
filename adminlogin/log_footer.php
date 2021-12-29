<footer>
	<div class="w3l-footer-bottom">
		<div class="container-fluid">
			<div class="col-md-12 w3-footer-logo">
				<h2 class="pull-left"><a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']);?>">KGCPAY</a></h2>
					<p class="pull-right"> <?php $dater = Date('Y'); if (!empty($dater)) {echo "&copy $dater";} ?> KGCPAY. All Rights Reserved  </p>
			</div>
	 	</div>
	</div>
</footer>