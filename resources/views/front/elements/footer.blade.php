<!-- begin:: Footer -->
<div class="kt-footer  kt-footer--extended  kt-grid__item" id="kt_footer" style="background-image: url('<?php echo WEBSITE_IMG_URL ?>bg/bg-2.jpg');">
	<?php /* <div class="kt-footer__top">
		<div class="kt-container ">
			<div class="row">
				<div class="col-lg-4">
					<div class="kt-footer__section">
						<h3 class="kt-footer__title">About</h3>
						<div class="kt-footer__content">
							Lorem Ipsum is simply dummy text of the printing<br>
							and typesetting and typesetting industry has been the <br>
							industry's standard dummy text ever since the 1500s,<br>
							when an unknown printer took a galley of type.
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="kt-footer__section">
						<h3 class="kt-footer__title">Quick Links</h3>
						<div class="kt-footer__content">
							<div class="kt-footer__nav">
								<div class="kt-footer__nav-section">
									<a href="#">General Reports</a>
									<a href="#">Dashboart Widgets</a>
									<a href="#">Custom Pages</a>
								</div>
								<div class="kt-footer__nav-section">
									<a href="#">User Setting</a>
									<a href="#">Custom Pages</a>
									<a href="#">Intranet Settings</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="kt-footer__section">
						<h3 class="kt-footer__title">Get In Touch</h3>
						<div class="kt-footer__content">
							<form action="" class="kt-footer__subscribe">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Enter Your Email">
									<div class="input-group-append">
										<button class="btn btn-brand" type="button">Join</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div> */ ?>
	<div class="kt-footer__bottom">
		<div class="kt-container ">
			<div class="kt-footer__wrapper">
				<div class="kt-footer__logo">
					<a class="kt-header__brand-logo" href="{{WEBSITE_URL}}">
					<?php
						if(!empty(Config::get("Settings.logo_backend")) && File::exists(SYSTEM_IMAGE_DIRECTROY_PATH . Config::get("Settings.logo_backend"))){
							$logo = SYSTEM_IMAGE_URL . Config::get("Settings.logo_backend");
						}else{
							$logo = WEBSITE_IMG_URL . "logo.png";
						}
					?>
						<img alt="Logo" src="<?php echo $logo; ?>" class="kt-header__brand-logo-sticky">
					</a>
					<div class="kt-footer__copyright">
						2020&nbsp;&copy;&nbsp;
						<a href="{{WEBSITE_URL}}" target="_blank"><?php echo Config::get("Settings.business_name"); ?></a>
					</div>
				</div>
				<?php /* <div class="kt-footer__menu">
					<a href="http://keenthemes.com/metronic" target="_blank">Purchase Lisence</a>
					<a href="http://keenthemes.com/metronic" target="_blank">Team</a>
					<a href="http://keenthemes.com/metronic" target="_blank">Contact</a>
				</div> */ ?>
			</div>
		</div>
	</div>
</div>

<!-- end:: Footer -->