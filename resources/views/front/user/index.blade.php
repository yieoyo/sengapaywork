@extends('front.layouts.default')
@section('content')

<div class="kt-body kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-grid--stretch" id="kt_body">
	<img src='{{WEBSITE_IMG_URL}}bg/frontend-bg.jpg'  /><br></br>
	<div class="kt-content kt-content--fit-top  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
		<div class="kt-container  kt-grid__item kt-grid__item--fluid">
			<div class="kt-portlet">
				<div class="kt-portlet__body kt-portlet__body--fit">

					<div class="kt-widget kt-widget--project-1" style="padding: 100px;">
						<div class="kt-widget__body">
							
						</div>
						<div class="row" style="text-align: center; margin: auto; font-size: 26px;font-weight: bold; ">ANSAR</div><p></p>
						<div class="row" style="text-align: center; margin: auto; font-size: 20px;">Donate Regularly</div><p></p>
						<br>
						<hr style="text-align: center; margin: auto; width: 40%; height: 3px; border: 0; background: #9ad260; "><br>
						<div class="row" style='text-align: center; margin: auto; font-size: 16px;' ><p></p>Ansar adalah satu usaha Hidayah Centre Foundation(HCF)<br>untuk mengajak orang ramai menyumbang desgn mudan serendah RMI sehari.Dengan  Ansar  anda dapat bersama sama dalam usaha menyampaikan mesej lslam yang sebenar kepada orang ramai.  Ansar juga bertujuan membantu golongan saudara baru yang baru berhijrah kembail kepada agama lslam sebagai jalan hidup mereka.<p></p><br /><br />Nama Ansar dipilih khusus mengambil semangat golongan  Ansar di Madinah <br />yang membantu golon  Muhajirin  dari Mekah dalam peristiwa Hijrah. Semoga dengan Ansar, sumbangan yang sedikit tetapi berterusan mampu memberrikan kwaN yang signifiken dalam menyokong usaha murni HCF damam melaksanakan kweajipan memperluasaskan penyampaian mesej islam kepata maysaarakat dan elhirkan saudara baru sebagal muslim contoh.<br><br><i style="text-align: center;margin: auto;"><p><br></p>"The most beloved deed to Alah is the most regular and constant even if it were little"*Hodith Narrated by Bukkari</i></div><p></p>
						<hr style="text-align: center; margin: auto; width: 80%; height: 1px; border: 0; background: #9ad260;"><br><br><p></p>
						<div class="row" style="text-align: center; margin: auto;font-size: 16px;">Bantuan Golongan Saudara Baru</div><br><p></p>
						<div class="row" style="text-align: center; margin: auto;">
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-kaaba"></i></div>
								<div class="row" style="margin: auto;font-size: 16px;">Pendidikan<br>Mualaf</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-shopping-basket"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Kebajikan<br>Mualaf</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-calendar"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Aktiviti<br>Dakwah</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-suitcase"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Latihan<br>Dakwah</div>
							</div>
							<div class="col" style="text-align: center;">
								<div class="row" style="margin: auto; font-size:50px;"><i class="fa fa-home"></i></div>
								<div class="row" style="margin: auto; font-size: 16px;">Pusat<br>Komuniti</div>
							</div>
						</div>
						<br>
					</div>
					
					<div class="row" style="margin: auto; font-size: 26px; font-weight: bold;">PROJECTS<p></p></div><p><br><br></p>
					<br>
					<div class="kt-widget kt-widget--project-1">
						<div class="kt-widget__body row">
							<div class="col-lg-3" style="background: url('{{WEBSITE_IMG_URL}}users/user1.jpg'); background-size: 100%; padding:10px;"></div>
							<div class="col-lg-9" style="padding-left: 50px;">
								<div class="row">
									<div class="col">
										<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5"  style="font-size: 25px; font-weight: bold;">
											Ansar Initiative
										</span>
									</div>
									<div class="col">

										<a href="{{route('user.page_details')}}" class="kt-nav__link">
										<button class="btn btn-label-success" style="float: right; font-size: 16px;">DONATE NOW</button>
										</a>


									</div>
								</div>
								<div class="kt-widget__stats kt-margin-t-20">
									<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10" style="font-size: 16px;">
											Start
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-brand btn-sm btn-bold btn-upper" style="font-size: 16px;">07 may, 18</span>
										</div>
									</div>
									<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10 " style="font-size: 16px;">
											Due
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-danger btn-sm btn-bold btn-upper" style="font-size: 16px;">07 0ct, 18</span>
										</div>
									</div>
								</div>
								<div class="kt-widget__container">
									<span class="kt-widget__subtitel" style="font-size: 16px;">Progress</span>
									<div class="kt-widget__progress d-flex align-items-center flex-fill">
										<div class="progress" style="height: 5px;width: 100%;">
											<div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="kt-widget__stat">
											78%
										</span>
									</div>
								</div>
								<div class="kt-widget__container" style="font-size: 16px;">
									Raised : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 10,250 </span> &nbsp; &nbsp; &nbsp;  Goal : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 15,000</span>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-widget kt-widget--project-1">
						<div class="kt-widget__body row">
							<div class="col-lg-3" style="background: url({{WEBSITE_IMG_URL}}users/user2.jpg'); background-size: 100%;"></div>
							<div class="col-lg-9" style="padding-left: 50px;">
								<div class="row">
									<div class="col">
										<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5"  style="font-size: 25px; font-weight: bold;">
											Ansar Corporate
										</span>
									</div>
									<div class="col">
										<a href="{{route('user.page_details')}}" class="kt-nav__link">
										<button class="btn btn-label-success" style="float: right; font-size: 16px;">DONATE NOW</button>
										</a>
									</div>
								</div>
								<div class="kt-widget__stats kt-margin-t-20">
									<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10" style="font-size: 16px;">
											Start
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-brand btn-sm btn-bold btn-upper" style="font-size: 16px;">07 may, 18</span>
										</div>
									</div>
									<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10 " style="font-size: 16px;">
											Due
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-danger btn-sm btn-bold btn-upper" style="font-size: 16px;">07 0ct, 18</span>
										</div>
									</div>
								</div>
								<div class="kt-widget__container">
									<span class="kt-widget__subtitel" style="font-size: 16px;">Progress</span>
									<div class="kt-widget__progress d-flex align-items-center flex-fill">
										<div class="progress" style="height: 5px;width: 100%;">
											<div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="kt-widget__stat">
											78%
										</span>
									</div>
								</div>
								<div class="kt-widget__container" style="font-size: 16px;">
									Raised : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 10,250 </span> &nbsp; &nbsp; &nbsp;  Goal : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 15,000</span>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-widget kt-widget--project-1">
						<div class="kt-widget__body row">
							<div class="col-lg-3" style="background: url('{{WEBSITE_IMG_URL}}users/user3.jpg'); background-size: 100%; padding:10px;"></div>
							<div class="col-lg-9" style="padding-left: 50px;">
								<div class="row">
									<div class="col">
										<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5"  style="font-size: 25px; font-weight: bold;">
											Angkasa
										</span>
									</div>
									<div class="col">
										<a href="{{route('user.page_details')}}" class="kt-nav__link">
										<button class="btn btn-label-success" style="float: right; font-size: 16px;">DONATE NOW</button>
										</a>
									</div>
								</div>
								<div class="kt-widget__stats kt-margin-t-20">
									<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10" style="font-size: 16px;">
											Start
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-brand btn-sm btn-bold btn-upper" style="font-size: 16px;">07 may, 18</span>
										</div>
									</div>
									<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10 " style="font-size: 16px;">
											Due
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-danger btn-sm btn-bold btn-upper" style="font-size: 16px;">07 0ct, 18</span>
										</div>
									</div>
								</div>
								<div class="kt-widget__container">
									<span class="kt-widget__subtitel" style="font-size: 16px;">Progress</span>
									<div class="kt-widget__progress d-flex align-items-center flex-fill">
										<div class="progress" style="height: 5px;width: 100%;">
											<div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="kt-widget__stat">
											78%
										</span>
									</div>
								</div>
								<div class="kt-widget__container" style="font-size: 16px;">
									Raised : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 10,250 </span> &nbsp; &nbsp; &nbsp;  Goal : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 15,000</span>
								</div>
							</div>
						</div>
					</div>
					<div class="kt-widget kt-widget--project-1">
						<div class="kt-widget__body row">
							<div class="col-lg-3" style="background: url('{{WEBSITE_IMG_URL}}users/user4.jpg'); background-size: 100%; padding:10px;"></div>
							<div class="col-lg-9" style="padding-left: 50px;">
								<div class="row">
									<div class="col">
										<span class="kt-widget__text kt-margin-t-0 kt-padding-t-5"  style="font-size: 25px; font-weight: bold;">
											Angkasa Swasta
										</span>
									</div>
									<div class="col">
										<a href="{{route('user.page_details')}}" class="kt-nav__link">
										<button class="btn btn-label-success" style="float: right; font-size: 16px;">DONATE NOW</button>
										</a>
									</div>
								</div>
								<div class="kt-widget__stats kt-margin-t-20">
									<div class="kt-widget__item d-flex align-items-center kt-margin-r-30">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10" style="font-size: 16px;">
											Start
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-brand btn-sm btn-bold btn-upper" style="font-size: 16px;">07 may, 18</span>
										</div>
									</div>
									<div class="kt-widget__item d-flex align-items-center kt-padding-l-0">
										<span class="kt-widget__date kt-padding-0 kt-margin-r-10 " style="font-size: 16px;">
											Due
										</span>
										<div class="kt-widget__label">
											<span class="btn btn-label-danger btn-sm btn-bold btn-upper" style="font-size: 16px;">07 0ct, 18</span>
										</div>
									</div>
								</div>
								<div class="kt-widget__container">
									<span class="kt-widget__subtitel" style="font-size: 16px;">Progress</span>
									<div class="kt-widget__progress d-flex align-items-center flex-fill">
										<div class="progress" style="height: 5px;width: 100%;">
											<div class="progress-bar kt-bg-success" role="progressbar" style="width: 78%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
										</div>
										<span class="kt-widget__stat">
											78%
										</span>
									</div>
								</div>
								<div class="kt-widget__container" style="font-size: 16px;">
									Raised : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 10,250 </span> &nbsp; &nbsp; &nbsp;  Goal : <span style="color: #366cf5; font-size: 16px;"> &nbsp;RM 15,000</span>
								</div>
							</div>
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