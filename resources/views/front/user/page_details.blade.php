@extends('front.layouts.default')
@section('content')
<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<img src='{{WEBSITE_IMG_URL}}bg/frontend2-bg.jpg'  />
	<div style="
		margin: auto;
		text-align: center;
		color: white;
		margin-top: -150px;
		"><span style="
		font-size: 50px;
		font-weight: bold;
	">Ansar</span><br><span style="font-size: 26px;">Ansar Initiative</span></div>
	
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content" style="margin-top:100px;">
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet">
				<div class="kt-portlet__body kt-portlet__body--fit">
					<div class="row">
						<div class="col" style="padding-right:35px;">
							<div class="row" style="background: url('{{WEBSITE_IMG_URL}}users/user1.jpg'); background-size: 100%; width: 100%; height: 80%; margin: 0;"></div>
							<div class="row" style="margin: 0; margin-top: 20px;">
								<a href="#" class="btn btn-facebook col"><i class="socicon-facebook"></i> Facebook</a>&nbsp;
								<a href="#" class="btn btn-twitter col"><i class="socicon-twitter"></i> Twitter</a>&nbsp;
								<a href="#" class="btn btn-google col"><i class="socicon-google"></i> Google</a>&nbsp;
								<a href="#" class="btn btn-instagram col"><i class="socicon-instagram"></i> Instagram</a>&nbsp;
								<a href="#" class="btn btn-linkedin col"><i class="socicon-linkedin"></i> Linkedin</a>&nbsp;
							</div>
							</div>
						<div class="col" style="padding-right:35px; padding-left: 35px;">
							<div class="row" style="font-size: 20px; font-weight:bold;">
								Campaign will end at:&nbsp; <span style="color: red;">30 Days 10 Hours 20 Minutes 32 Seconds</span>
							</div><br>
							<div class="row" style="text-align: center; font-size: 13px;">
								<span style="color: #63cb34; font-size: 35px; font-weight: bold;">RM10,250 &nbsp; </span>       <span style="margin-top: 20px; font-size: 16px;">  out of RM15,000 rasied</span>
							</div><br>
							<div class="kt-widget__container">
								<span class="kt-widget__subtitel">Goal</span>
								<div class="kt-widget__progress d-flex align-items-center flex-fill">
									<div class="progress" style="height: 5px;width: 90%;">
										<div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
									<span class="kt-widget__stat">
										78%
									</span>
								</div>
							</div>
							<div class="form-group">
								<br>
								<label style="font-size: 16px;">Choose Commitment Type : </label>
								<div class="row">
									<div class="col-lg-4">
										<label class="kt-option">
											<span class="kt-option__control">
												<span class="kt-radio" checked="">
													<input type="radio" name="m_option_1" value="1">
													<span></span>
												</span>
											</span>
											<span class="kt-option__label" >
												<span class="kt-option__head">
													<span class="kt-option__title"  style="font-size: 16px;">
														Daily
													</span>
												</span>
												<span class="kt-option__body">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry
												</span>
											</span>
										</label>
									</div>
									<div class="col-lg-4">
										<label class="kt-option">
											<span class="kt-option__control">
												<span class="kt-radio" checked="">
													<input type="radio" name="m_option_1" value="1">
													<span></span>
												</span>
											</span>
											<span class="kt-option__label">
												<span class="kt-option__head">
													<span class="kt-option__title" style="font-size: 16px;">
														Monthly
													</span>
												</span>
												<span class="kt-option__body">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry
												</span>
											</span>
										</label>
									</div>
									<div class="col-lg-4">
										<label class="kt-option">
											<span class="kt-option__control">
												<span class="kt-radio">
													<input type="radio" name="m_option_1" value="1">
													<span></span>
												</span>
											</span>
											<span class="kt-option__label">
												<span class="kt-option__head">
													<span class="kt-option__title" style="font-size: 16px;">
														Yearly
													</span>
												</span>
												<span class="kt-option__body">
													Lorem Ipsum is simply dummy text of the printing and typesetting industry
												</span>
											</span>
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label style="font-size: 16px;">Choose Plan</label>
								<div class="kt-radio-inline" >
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="plan_radio" > RM 30
										<span></span>
									</label>
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="plan_radio" > RM 50
										<span></span>
									</label>
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="plan_radio" > RM 100
										<span></span>
									</label>
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="plan_radio" > Others
										<span></span>
									</label>
								</div>
								<span class="form-text text-muted" style="font-size: 16px;">*This will deduct from your account on monthly basis.</span>
							</div>
							<div class="form-group">
								<label style="font-size: 16px;">Choose Period</label>
								<div class="kt-radio-inline">
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="period_radio" > 12 Months
										<span></span>
									</label>
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="period_radio" > 24 Months
										<span></span>
									</label>
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="period_radio" > 36 Months
										<span></span>
									</label>
									<label class="kt-radio" style="font-size: 16px;">
										<input type="radio" name="period_radio" > Others
										<span></span>
									</label>
								</div>
							</div>
							<a href="ansar-initiative-add-new-contributor.html" class="kt-nav__link">
										<button class="btn btn-label-success" style="float: right; font-size: 16px;">DONATE NOW</button>
										</a>
						</div>
					</div>
					
					<!-- <br><br><br> -->
					<div class="kt-widget kt-widget--project-1" style="padding: 100px;">
						<div class="kt-widget__body" style="margin: auto; text-align: center;">
							<span style="color: #b3df99; font-size: 26px;">Cara Sumbangan</span> <span style="font-size: 26px;">Alternatif</span><br><br>
							<span style="font-size: 20px;">salurkan terus ke akaun bank:</span><br><br>
							<span style="font-size: 26px; color: #97f161; font-weight: bold;">The trustees of <br/>Hidayah Centre Foundation Registered</span><br>
							<br>
							<div>
								<ul style="list-style: none; font-size: 20px;">
									<li><span><strong>Maybank islamic</strong></span> : 5622 0962 4421</li>
									<li><span><strong>Bank islam</strong></span> : 1211 3010 3494 33</li>
									<li><span><strong>Bank Rakyat</strong></span> : 1104 6100 0356</li>
								</ul>
							</div>
							<br>
						</div>
					</div>

					<div class="kt-widget kt-widget--project-1" style="padding: 100px; padding: 0 100px;">
						<div class="kt-widget__body" style="padding: 0 25%; text-align: center;">
							<span style="color: #b3df99; font-size: 26px;">Hubungi Kami</span><br><br>
							<div class="row">
								<div class="col-lg-7">
									<div class="form-group row">
										<label for="example-text-input" class="col-3 col-form-label" style="font-size: 16px;"  >Name</label>
										<div class="col-9">
											<input class="form-control" type="text" value="" placeholder="Enter Name" id="example-text-input1">
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-3 col-form-label" style="font-size: 16px;">Email</label>
										<div class="col-9">
											<input class="form-control" type="text" value="" placeholder="Enter Email" id="example-text-input2">
										</div>
									</div>
									<div class="form-group row">
										<label for="example-text-input" class="col-3 col-form-label" style="font-size: 16px;">Message</label>
										<div class="col-9">
											<textarea class="form-control" type="text" value="" placeholder="Enter Message" ></textarea>
										</div>
									</div>
								</div>
								<div class="col-lg-5" style="font-size: 16px;" align="left">
									Hiday Centre Foundation<br>Let 300.3.Lorong Selangor,<br> Pusal Bandar Melawait KL<br>P : 03 4103 9669<br><br>Email : ansar@hcf.org.my<br><br>Website : hidayachcentre.org.my
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		

		<!-- end:: Content -->
	</div>
</div>

@stop