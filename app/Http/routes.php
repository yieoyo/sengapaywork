<?php
DB::enableQueryLog() ;
include(app_path().'/global_constants.php');
require_once(APP_PATH.'/libraries/CustomHelper.php');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
	################################################################# Front Routing start here ###################################################
 
	Route::get('/base/uploder','BaseController@saveCkeditorImages');
	Route::post('/base/uploder','BaseController@saveCkeditorImages'); 
	Route::any('/base/cleardb','BaseController@clearDatabase'); 
	Route::get('cron/get_archive_session','CronController@archives');
	Route::group(array('middleware' => 'App\Http\Middleware\GuestFront','namespace'=>'front'), function() {
		/* Route::get('/view-clear', function() {
			$exitCode = Artisan::call('view:clear');
			return 'View cache cleared';
		}); */

		
		Route::get('/', 'UsersController@index');
		Route::get('/login', 'HomeController@newlogin');
		Route::post('/login', 'HomeController@login');
		Route::get('/logout', 'HomeController@logout');
		Route::get('/signup', 'HomeController@signup');
		Route::get('/signup/{email}', 'HomeController@signup');
		Route::post('/signup', 'HomeController@savesignup');
		Route::post('/signup-email', 'HomeController@signupEmail');
		Route::get('/pages/{slug}', 'UsersController@showCms');
		Route::get('/contact', 'HomeController@ContactUs');
		Route::post('/contact', 'HomeController@SubmitContactUs');
		Route::get('/about', array('as'=>'home.about_us','uses'=>'HomeController@aboutUs'));
		Route::get('/details', array('as'=>'user.page_details','uses'=>'UsersController@PageDetails'));
		
		Route::get('/faq', array('as'=>'home.faq','uses'=>'HomeController@faq'));
		Route::get('/terms', array('as'=>'home.terms','uses'=>'HomeController@terms'));
		Route::get('/privacy-policy', array('as'=>'home.privacyPolicy','uses'=>'HomeController@privacyPolicy'));
		Route::get('/follow-us', array('as'=>'home.followUs','uses'=>'HomeController@followUs'));
		Route::post('/subscribe', 'UsersController@subscribe');
		Route::get('/unsubscribe-newsletter/{validate_string}', 'UsersController@unsubscribeNewsletter');
		
		Route::get('/forgot-password',array('as'=>'home.forgetPassword','uses'=>'HomeController@ForgotPasswordView'));
		Route::post('/forgot-password',array('as'=>'home.forgetPassword','uses'=>'HomeController@ForgotPassword'));
		Route::get('reset-password/{validate_string}',array('as'=>'Home.reset_password','uses'=>'HomeController@resetPassword'));
		Route::post('reset-password',array('as'=>'Home.save_reset_password','uses'=>'HomeController@saveResetPassword'));
		Route::get('account-verification/{validate_string}',array('as'=>'Home.save_reset_password','uses'=>'HomeController@Verify'));
		
		Route::get('projects/{page_slug}',array('as'=>'Globaluser.cms_page_details','uses'=>'GlobalusersController@getCmsPageDetails'));
		
		Route::get('page/{page_slug}',array('as'=>'Globaluser.cms_pages_details','uses'=>'GlobalusersController@getCmsPageDetails'));
		
		Route::post('/get-plan-html',array('as'=>'user.get_plan_html','uses'=>'UsersController@GetPlanHtml'));
		Route::post('/get-book-plan-html/{subProjectSlug}',array('as'=>'user.getBookPlanPopup','uses'=>'UsersController@getBookPlanPopup'));
		Route::get('/book-plan/{subProjectSlug}',array('as'=>'user.book_plan','uses'=>'UsersController@BookPlan'));
		Route::post('/add-more-participate',array('as'=>'user.add_more_section_participate','uses'=>'UsersController@AddMoreSectionParticipate'));
		Route::post('/save-donation',array('as'=>'User.saveDonation','uses'=>'UsersController@saveDonation'));
		Route::post('/save-enquiry',array('as'=>'User.saveEnquiry','uses'=>'UsersController@saveEnquiry'));
		
		Route::get('/project-detail/{slug}',array('as'=>'Globaluser.sub_project_detail','uses'=>'GlobalusersController@subProjectDetail'));
		Route::post('/select-donation-plan',array('as'=>'Globaluser.selectDonationPlan','uses'=>'GlobalusersController@selectDonationPlan'));
		
		
		
		Route::get('/qr-code/{ORDERID}',array('as'=>'user.qr_code_generate','uses'=>'UsersController@QrCodeGenerate'));
		Route::get('/invoice/{ORDERID}',array('as'=>'user.invoice_generate','uses'=>'UsersController@InvoiceGenerate'));
		Route::any('/payment-error',array('as'=>'user.payment_error_page','uses'=>'UsersController@PaymentErrorPage'));
		
		Route::post('/final-payment-popup',array('as'=>'User.GetFinalPaymentDetails','uses'=>'UsersController@GetFinalPaymentDetails'));
		Route::post('/pay-now',array('as'=>'User.PayNow','uses'=>'UsersController@PayNow'));
		
		Route::any('/download-itinary/{UNIQUE_PACKAGE_ID}','UsersController@getDownloadFiles');
		
		Route::any('/check-payment','UsersController@CheckPayment');
		Route::any('/payment-success','UsersController@PaymentSuccess');
		Route::any('/payment-webhook','UsersController@PaymentWebHook');
		Route::any('/payment-success-test','UsersController@PaymentSuccessTest'); //only for testing purpose
		
		Route::get('/download-invoice-pdf/{INVOICE_NUMBER}','GlobalusersController@downloadInvoicePDF');
		
	});
	
	/* Route::group(array('middleware' => 'App\Http\Middleware\GuestFront','namespace'=>'front'), function(){
		
	}); */	
		
	Route::group(array('middleware' => 'App\Http\Middleware\GuestFront','namespace'=>'Auth'), function(){
		Route::get('login-with-social/{social_type}','AuthController@redirectToProvider');
		Route::get('handle-provider-callback/{social_type}','AuthController@handleProviderCallback');
	});
	
	Route::group(array('middleware' => 'App\Http\Middleware\Language'), function() {
		Route::get('change-language-settings/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);
	});
	
	
	Route::group(array('middleware' => 'App\Http\Middleware\AuthFront','namespace'=>'front'), function() {
		/* Route::get('/view-clear', function() {
			$exitCode = Artisan::call('view:clear');
			return 'View cache cleared';
		}); */

		Route::get('edit-profile',array('as'=>'User.editProfile','uses'=> 'UsersController@editProfile'));
		Route::post('update-profile',array('as'=>'User.updateUserProfile','uses'=> 'UsersController@updateUserProfile'));
		Route::post('saveprofile','GlobalusersController@saveProfile');
		Route::post('saveprofileimage','GlobalusersController@saveProfileImage');
		Route::get('change-password','GlobalusersController@changePassword');
		Route::post('savechangepassword','GlobalusersController@saveChangePassword');
		Route::post('savechangepassword','GlobalusersController@saveChangePassword');
		
		//Route::get('/change-password',array('as'=>'user.profile_change_password','uses'=>'UsersController@profileChangePassword'));
		
		
		Route::get('/dashboard',array('as'=>'User.dashboard','uses'=> 'UsersController@dashboard'));
		Route::any('/get-order-guest',array('as'=>'user.get_order_guest_table','uses'=>'UsersController@GetOrderGuestTable'));
		
		//Route::get('/home',array('as'=>'user.home_template','uses'=>'UsersController@HomeTemplate'));
		
		
		
		Route::get('/admin-dashboard',array('as'=>'user.admin_dashboard','uses'=>'UsersController@AdminDashboard'));
		Route::any('/admin-dashboard-chart',array('as'=>'User.getDashboardChartData','uses'=>'UsersController@getDashboardChartData'));
		
		/* New*/
		Route::get('/personal-information',array('as'=>'user.personal_information','uses'=>'UsersController@personalInformation'));
		
		Route::get('/overview',array('as'=>'user.profile_overview','uses'=>'UsersController@profileOverview'));
		Route::get('/account-information',array('as'=>'user.profile_account_information','uses'=>'UsersController@profileAccountInformation'));
		Route::get('/email-settings',array('as'=>'user.profile_email_settings','uses'=>'UsersController@profileEmailSettings'));
		
		
		Route::get('/account-admin',array('as'=>'user.account_admin','uses'=>'UsersController@AccountAdmin'));
		Route::get('/add-admin',array('as'=>'user.account_admin_add','uses'=>'UsersController@accountAdminAdd'));
		Route::post('/save-admin',array('as'=>'User.accountAdminSave','uses'=>'UsersController@accountAdminSave'));
		Route::get('/edit-admin/{slug}',array('as'=>'user.account_admin_edit','uses'=>'UsersController@accountAdminEdit'));
		Route::post('/update-admin',array('as'=>'User.accountAdminUpdate','uses'=>'UsersController@accountAdminUpdate'));
		Route::get('/delete-admin/{slug}',array('as'=>'User.accountAdminDelete','uses'=>'UsersController@accountAdminDelete'));
		Route::get('/change-status-admin/{slug}/{status}',array('as'=>'User.accountAdminChangeStatus','uses'=>'UsersController@accountAdminChangeStatus'));
		
		
		Route::get('/account-guest',array('as'=>'user.account_guest','uses'=>'UsersController@AccountGuest'));
		Route::get('/add-guest',array('as'=>'user.account_guest_add','uses'=>'UsersController@AccountGuestAdd'));
		Route::post('/save-guest',array('as'=>'User.AccountGuestSave','uses'=>'UsersController@AccountGuestSave'));
		Route::get('/edit-guest/{slug}',array('as'=>'user.account_guest_edit','uses'=>'UsersController@AccountGuestEdit'));
		Route::post('/update-guest',array('as'=>'User.AccountGuestUpdate','uses'=>'UsersController@AccountGuestUpdate'));
		Route::get('/delete-guest/{slug}',array('as'=>'User.AccountGuestDelete','uses'=>'UsersController@AccountGuestDelete'));
		
		
		Route::get('/account-vendors',array('as'=>'user.account_vendors','uses'=>'UsersController@AccountVendors'));
		Route::get('/vendor-add',array('as'=>'user.account_vendor_add','uses'=>'UsersController@AccountVendorAdd'));
		Route::post('/vendor-save',array('as'=>'User.AccountVendorSave','uses'=>'UsersController@AccountVendorSave'));
		Route::get('/vendor-edit/{slug}',array('as'=>'user.account_vendor_edit','uses'=>'UsersController@AccountVendorEdit'));
		Route::post('/vendor-update',array('as'=>'User.AccountVendorUpdate','uses'=>'UsersController@AccountVendorUpdate'));
		Route::get('/delete-vendor/{slug}',array('as'=>'User.AccountVendorDelete','uses'=>'UsersController@AccountVendorDelete'));
		Route::get('/change-status-vendor/{slug}/{status}',array('as'=>'User.AccountVendorChangeStatus','uses'=>'UsersController@AccountVendorChangeStatus'));
		
		Route::get('/account-contributor',array('as'=>'user.account_contributor','uses'=>'UsersController@AccountContributor'));
		Route::get('/contributor-add',array('as'=>'user.account_contributor_add','uses'=>'UsersController@AccountContributorAdd'));
		Route::post('/contributor-save',array('as'=>'User.AccountContributorSave','uses'=>'UsersController@AccountContributorSave'));
		Route::get('/contributor-edit/{slug}',array('as'=>'user.account_contributor_edit','uses'=>'UsersController@AccountContributorEdit'));
		Route::post('/contributor-update',array('as'=>'User.AccountContributorUpdate','uses'=>'UsersController@AccountContributorUpdate'));
		Route::get('/delete-contributor/{slug}',array('as'=>'User.AccountContributorDelete','uses'=>'UsersController@AccountContributorDelete'));
		Route::get('/change-status-contributor/{slug}/{status}',array('as'=>'User.AccountContributorChangeStatus','uses'=>'UsersController@AccountContributorChangeStatus'));
		
		
		Route::get('/account-sales-type',array('as'=>'user.account_sales_type','uses'=>'UsersController@AccountSalesType'));
		Route::get('/sales-type-add',array('as'=>'user.account_sales_type_add','uses'=>'UsersController@AccountSalesTypeAdd'));
		Route::post('/sales-type-save',array('as'=>'User.AccountSalesTypeSave','uses'=>'UsersController@AccountSalesTypeSave'));
		Route::get('/sales-type-edit/{slug}',array('as'=>'user.account_sales_type_edit','uses'=>'UsersController@AccountSalesTypeEdit'));
		Route::post('/update-sales-type',array('as'=>'User.AccountSalesTypeUpdate','uses'=>'UsersController@AccountSalesTypeUpdate'));
		Route::get('/delete-sales-type/{slug}',array('as'=>'User.SalesTypeDelete','uses'=>'UsersController@AccountSalesTypeDelete'));
		Route::get('/change-status-sales-type/{slug}/{status}',array('as'=>'User.AccountSalesTypeChangeStatus','uses'=>'UsersController@AccountSalesTypeChangeStatus'));
		
		
		
		Route::get('/email-template-edit',array('as'=>'user.general_email_temp_edit','uses'=>'UsersController@GeneralEmailTempEdit'));
		Route::get('/email-template',array('as'=>'user.general_email_template','uses'=>'UsersController@GeneralEmailTemplate'));
		Route::get('/pdf-template',array('as'=>'user.general_pdf_template','uses'=>'UsersController@GeneralPdfTemplate'));
		Route::get('/pdf-template-edit',array('as'=>'user.general_pdf_temp_edit','uses'=>'UsersController@GeneralPdfTempEdit'));
		
		Route::get('/general-setting',array('as'=>'user.general_setting','uses'=>'UsersController@GeneralSetting'));
		Route::any('/add-more-offline-payment-option',array('as'=>'user.add_more_offline_payment','uses'=>'UsersController@AddMoreOfflinePaymentOption'));
		Route::post('/save-general-setting',array('as'=>'User.SaveGeneralSetting','uses'=>'UsersController@SaveGeneralSetting'));
		Route::post('/save-email-setting',array('as'=>'User.SaveGeneralEmailSetting','uses'=>'UsersController@SaveGeneralEmailSetting'));
		Route::post('/save-sms-setting',array('as'=>'User.SaveGeneralSmsSetting','uses'=>'UsersController@SaveGeneralSmsSetting'));
		Route::post('/save-payment-setting',array('as'=>'User.SavePaymentSetting','uses'=>'UsersController@SavePaymentSetting'));
		Route::post('/save-integration-setting',array('as'=>'User.SaveIntegrationSetting','uses'=>'UsersController@SaveIntegrationSetting'));
		
		Route::get('/sms-template',array('as'=>'user.general_sms_template','uses'=>'UsersController@GeneralSmsTemplate'));
		Route::get('/sms-template-edit',array('as'=>'user.general_sms_temp_edit','uses'=>'UsersController@GeneralSmsTempEdit'));
		Route::get('/general-translation',array('as'=>'user.general_translation','uses'=>'UsersController@GeneralTranslation'));
		Route::get('/translation-edit',array('as'=>'user.general_translation_edit','uses'=>'UsersController@GeneralTranslationEdit'));
		
		
		
		Route::get('/delete-order/{ORDERID}',array('as'=>'User.DeleteOrder','uses'=>'UsersController@DeleteOrder'));
		//Route::post('/approve-bulk-payments',array('as'=>'User.ApproveBulkPayments','uses'=>'UsersController@ApproveBulkPayments'));
		
		
		Route::get('accounts/export-admin-excel',array('as'=>'User.exportAdminExcel','uses'=>'UsersController@exportAdminExcel'));	
		Route::get('accounts/export-vendor-excel',array('as'=>'User.exportVendorExcel','uses'=>'UsersController@exportVendorExcel'));	
		Route::get('accounts/export-contributor-excel',array('as'=>'User.exportContributorExcel','uses'=>'UsersController@exportContributorExcel'));	
		Route::get('infaq/export-project-excel/{SUBPROJECTSLUG}',array('as'=>'User.exportProjectExcel','uses'=>'UsersController@exportProjectExcel'));	
		
		
		Route::get('language/export-language-excel',array('as'=>'User.exportLanguageExcel','uses'=>'UsersController@exportLanguageExcel'));	
		
		
		
		/* New*/
		Route::get('/project-template',array('as'=>'user.project_template','uses'=>'UsersController@ProjectTemplate'));
		Route::post('/save-new-project',array('as'=>'User.AddNewProject','uses'=>'UsersController@AddNewProject'));
		Route::post('/save-new-sub-project',array('as'=>'User.AddNewSubProject','uses'=>'UsersController@AddNewSubProject'));
		Route::post('/get-sub-project',array('as'=>'User.GetSubProjects','uses'=>'UsersController@GetSubProjects'));
		Route::get('/project-add/{SLUG}',array('as'=>'user.project_template_add','uses'=>'UsersController@ProjectTemplateAdd'));
		Route::post('/project-add/{SLUG}',array('as'=>'User.SaveProjectTemplate','uses'=>'UsersController@SaveProjectTemplate'));
		Route::get('/project-edit/{SLUG}',array('as'=>'user.project_template_edit','uses'=>'UsersController@ProjectTemplateEdit'));
		Route::post('/project-edit/{SLUG}',array('as'=>'User.UpdateProjectTemplate','uses'=>'UsersController@UpdateProjectTemplate'));
		Route::post('/change-project-order',array('as'=>'User.ChangeProjectOrder','uses'=>'UsersController@ChangeProjectOrder'));
		Route::post('/delete-project-block',array('as'=>'User.DeleteProjectBlock','uses'=>'UsersController@DeleteProjectBlock'));
		Route::post('/delete-sub-project-block',array('as'=>'User.DeleteSubProjectBlock','uses'=>'UsersController@DeleteSubProjectBlock'));
		Route::post('/get-dastination-project-list',array('as'=>'User.getDestinationProjectBlock','uses'=>'UsersController@getDestinationProjectBlock'));
		Route::post('/move-sub-project-block',array('as'=>'User.MoveSubProjectBlock','uses'=>'UsersController@MoveSubProjectBlock'));
		Route::post('/save-project-name',array('as'=>'User.UpdateProjectName','uses'=>'UsersController@UpdateProjectName'));
		
		Route::any('/delete-template-header-image',array('as'=>'User.DeleteHeaderImage','uses'=>'UsersController@DeleteHeaderImage'));
		Route::any('/delete-template-slider-image',array('as'=>'User.DeleteTemplateImage','uses'=>'UsersController@DeleteTemplateImage'));
		
		Route::post('/add-more-daily-plan',array('as'=>'User.AddMoreDailyPlan','uses'=>'UsersController@AddMoreDailyPlan'));
		Route::post('/add-more-daily-period',array('as'=>'User.AddMoreDailyPeriod','uses'=>'UsersController@AddMoreDailyPeriod'));
		Route::post('/add-more-monthly-plan',array('as'=>'User.AddMoreMonthlyPlan','uses'=>'UsersController@AddMoreMonthlyPlan'));
		Route::post('/add-more-monthly-period',array('as'=>'User.AddMoreMonthlyPeriod','uses'=>'UsersController@AddMoreMonthlyPeriod'));
		Route::post('/add-more-yearly-plan',array('as'=>'User.AddMoreYearlyPlan','uses'=>'UsersController@AddMoreYearlyPlan'));
		Route::post('/add-more-yearly-period',array('as'=>'User.AddMoreYearlyPeriod','uses'=>'UsersController@AddMoreYearlyPeriod'));
		
		Route::post('/add-more-default-project-plan',array('as'=>'User.AddMoreDefaultProjectPlan','uses'=>'UsersController@AddMoreDefaultProjectPlan'));
		Route::post('/add-more-seat-reservation-plan',array('as'=>'User.AddMoreSeatReservationPlans','uses'=>'UsersController@AddMoreSeatReservationPlans'));
		Route::post('/add-more-seat-reservation-subtitle',array('as'=>'User.AddMoreSeatReservationSubtitle','uses'=>'UsersController@AddMoreSeatReservationSubtitle'));
		Route::post('/add-more-quantity-project-plan',array('as'=>'User.AddMoreQuantityProjectPlan','uses'=>'UsersController@AddMoreQuantityProjectPlan'));
		Route::post('/add-more-section-project-plan',array('as'=>'User.AddMoreSectionProjectPlan','uses'=>'UsersController@AddMoreSectionProjectPlan'));
		
		Route::post('/upload-template-header-image',array('as'=>'User.UploadTemplateHeaderImage','uses'=>'UsersController@UploadTemplateHeaderImage'));
		Route::post('/upload-template-slider-images',array('as'=>'User.UploadTemplateSliderImages','uses'=>'UsersController@UploadTemplateSliderImages'));
		
		Route::post('/add-more-default-dana-plan',array('as'=>'User.AddMoreDefaultDanaPlan','uses'=>'UsersController@AddMoreDefaultDanaPlan'));
		Route::post('/add-more-dana-property-type',array('as'=>'User.AddMoreDanaPropertyType','uses'=>'UsersController@AddMoreDanaPropertyType'));
		Route::post('/add-more-dana-property-price-range',array('as'=>'User.AddMoreDanaPropertyPriceRange','uses'=>'UsersController@AddMoreDanaPropertyPriceRange'));
		
		
		Route::get('/infaq/{subProjectSlug}',array('as'=>'user.sub_project_lists','uses'=>'UsersController@SubProjectLists'));
		Route::get('/edit-donation-plan/{subProjectSlug}/{orderId}',array('as'=>'user.edit_book_plan','uses'=>'UsersController@EditBookPlan'));
		Route::post('/update-donation',array('as'=>'User.updateDonation','uses'=>'UsersController@updateDonation'));
		Route::any('/delete-donation-order/{subProjectSlug}/{orderId}',array('as'=>'User.DeleteDonationOrder','uses'=>'UsersController@DeleteDonationOrder'));
		Route::post('/add-more-payments',array('as'=>'User.AddMorePayment','uses'=>'UsersController@AddMorePayment'));
		Route::post('/update-payment-status',array('as'=>'User.UpdateBookingPaymentStatus','uses'=>'UsersController@UpdateBookingPaymentStatus'));
		
		Route::any('/get-donation-invoice-list',array('as'=>'user.get_donation_invoice_table','uses'=>'UsersController@GetDonationInvoiceTable'));
		
		Route::any('/cancel-recurring-plan/{donation_id}',array('as'=>'User.cancelRecurringPlan','uses'=>'UsersController@cancelRecurringPlan'));
		Route::any('/send-reminder/{donation_id}',array('as'=>'User.sendRemainder','uses'=>'UsersController@sendRemainder'));
		
		//get data in json
		Route::any('/get-orders-list',array('as'=>'User.getOrderLists','uses'=>'UsersController@getOrderLists'));
		
		
		
		Route::get('/ansar-angkasa-swasta',array('as'=>'user.ansar_angkasa_swasta','uses'=>'UsersController@ansarangkasaswasta'));
		Route::get('/project-template-charity',array('as'=>'user.project_template_charity','uses'=>'UsersController@projecttemplatecharity'));
		Route::get('/special-project-charity',array('as'=>'user.special_project_charity','uses'=>'UsersController@specialprojectcharity'));
		Route::get('/special-project-iftar',array('as'=>'user.special_project_iftar_perdana','uses'=>'UsersController@specialprojectiftarperdana'));
		Route::get('/dana-lestari-hibah-takaful',array('as'=>'user.dana_lestari_hibah_takaful','uses'=>'UsersController@danalestarihibahtakaful'));
		Route::get('/project-templates-dana-lestari',array('as'=>'user.project_templates_dana_lestari','uses'=>'UsersController@projecttemplatesdanalestari'));
		Route::get('/account-admin-list-add',array('as'=>'user.account_admin_list_add','uses'=>'UsersController@accountadminlistadd'));
		Route::get('/dana-lestari-pelaburan-sukuk',array('as'=>'user.dana_lestari_pelaburan_sukuk','uses'=>'UsersController@danalestaripelaburansukuk'));
		
		
		
		/* cms pages start*/
		Route::get('/cms-pages',array('as'=>'user.general_cms_pages','uses'=>'UsersController@GeneralCmsPages'));
		Route::get('/cms-pages-add',array('as'=>'user.general_cms_pages_add','uses'=>'UsersController@GeneralCmsPagesAdd'));
		Route::post('/cms-pages-save',array('as'=>'User.GeneralCmsPagesSave','uses'=>'UsersController@GeneralCmsPagesSave'));
		Route::any('/cms-pages-image-upload',array('as'=>'User.UploadCmsImages','uses'=>'UsersController@UploadCmsImages'));
		Route::any('/cms-pages-image-delete',array('as'=>'User.DeleteCmsImages','uses'=>'UsersController@DeleteCmsImages'));
		Route::any('/cms-image-delete',array('as'=>'User.DeleteCmsImage','uses'=>'UsersController@DeleteCmsImage'));
		Route::get('/cms-pages-edit/{slug}',array('as'=>'user.general_cms_pages_edit','uses'=>'UsersController@GeneralCmsPagesEdit'));
		Route::post('/cms-pages-update',array('as'=>'User.GeneralCmsPagesUpdate','uses'=>'UsersController@GeneralCmsPagesUpdate'));
		Route::get('/delete-cms-pages/{slug}',array('as'=>'User.GeneralCmsPagesDelete','uses'=>'UsersController@GeneralCmsPagesDelete'));
		Route::get('/change-status-cms-pages/{slug}/{status}',array('as'=>'User.GeneralCmsPagesChangeStatus','uses'=>'UsersController@GeneralCmsPagesChangeStatus'));
		/* cms pages end*/
		
		
		/* projects start*/
		Route::get('/projects',array('as'=>'user.project','uses'=>'UsersController@Projects'));
		Route::get('/project-add',array('as'=>'user.project_add','uses'=>'UsersController@ProjectAdd'));
		Route::post('/project-save',array('as'=>'User.ProjectSave','uses'=>'UsersController@ProjectSave'));
		Route::get('/project-edit/{slug}',array('as'=>'user.project_edit','uses'=>'UsersController@ProjectEdit'));
		Route::post('/project-update',array('as'=>'User.ProjectUpdate','uses'=>'UsersController@ProjectUpdate'));
		Route::get('/delete-project/{slug}',array('as'=>'User.ProjectDelete','uses'=>'UsersController@ProjectDelete'));
		Route::get('/change-status-project/{slug}/{status}',array('as'=>'User.ProjectChangeStatus','uses'=>'UsersController@ProjectChangeStatus'));
		/* projects end*/
		
		
		
		
		
		
		
		### Language setting start //
		Route::get('language-settings',array('as'=>'LanguageSetting.index','uses'=>'LanguageSettingsController@listLanguageSetting'));
		Route::get('/language-settings/add-setting',array('as'=>'LanguageSetting.add','uses'=>'LanguageSettingsController@addLanguageSetting'));
		Route::post('/language-settings/add-setting',array('as'=>'LanguageSetting.save','uses'=>'LanguageSettingsController@saveLanguageSetting'));
		Route::any('/language-settings/import/{language_code}',array('as'=>'LanguageSetting.import','uses'=>'LanguageSettingsController@import'));
		
		Route::get('/language-settings/edit-setting/{id}',array('as'=>'LanguageSetting.edit','uses'=>'LanguageSettingsController@editLanguageSetting'));
		Route::any('/language-settings/edit-setting',array('as'=>'LanguageSetting.update','uses'=>'LanguageSettingsController@updateLanguageSetting'));			
		
		Route::any('/language-settings/delete-setting/{SLUG}',array('as'=>'LanguageSetting.delete','uses'=>'LanguageSettingsController@deleteLanguageSetting'));Route::get('/change-status-language/{slug}/{status}',array('as'=>'LanguageSetting.LanguageSettingChangeStatus','uses'=>'LanguageSettingsController@LanguageSettingChangeStatus'));			
		
		
		/** email-manager routing**/
		Route::get('/email-manager',array('as'=>'EmailTemplate.index','uses'=>'EmailtemplateController@listTemplate'));
		Route::get('/email-manager/add-template',array('as'=>'EmailTemplate.add','uses'=>'EmailtemplateController@addTemplate'));
		Route::post('/email-manager/add-template','EmailtemplateController@saveTemplate');
		Route::get('/email-manager/edit-template/{id}',array('as'=>'EmailTemplate.edit','uses'=>'EmailtemplateController@editTemplate'));
		Route::post('/email-manager/edit-template/{id}','EmailtemplateController@updateTemplate');
		Route::post('/email-manager/get-constant','EmailtemplateController@getConstant');
		
		
		/** pdf-manager routing**/
		Route::get('/pdf-manager',array('as'=>'PdfTemplate.index','uses'=>'PdftemplateController@listTemplate'));
		Route::get('/pdf-manager/add-template',array('as'=>'PdfTemplate.add','uses'=>'PdftemplateController@addTemplate'));
		Route::post('/pdf-manager/add-template','PdftemplateController@saveTemplate');
		Route::get('/pdf-manager/edit-template/{id}',array('as'=>'PdfTemplate.edit','uses'=>'PdftemplateController@editTemplate'));
		Route::post('/pdf-manager/edit-template/{id}','PdftemplateController@updateTemplate');
		Route::post('/pdf-manager/get-constant','PdftemplateController@getConstant');
		
		
		/** sms-manager routing**/
		Route::get('/sms-manager',array('as'=>'SmsTemplate.index','uses'=>'SmstemplateController@listTemplate'));
		Route::get('/sms-manager/add-template',array('as'=>'SmsTemplate.add','uses'=>'SmstemplateController@addTemplate'));
		Route::post('/sms-manager/add-template','SmstemplateController@saveTemplate');
		Route::get('/sms-manager/edit-template/{id}',array('as'=>'SmsTemplate.edit','uses'=>'SmstemplateController@editTemplate'));
		Route::post('/sms-manager/edit-template/{id}','SmstemplateController@updateTemplate');
		Route::post('/sms-manager/get-constant','SmstemplateController@getConstant');
		
		
		Route::get('/send-remainder/{ORDERID}',array('as'=>'User.SendRemainder','uses'=>'UsersController@SendRemainder'));
		
		
		Route::post('/send-test-email','UsersController@sendTestEmail');
		Route::post('/send-test-sms','UsersController@sendTestSms');
		
		Route::post('/send-test-email-template','EmailtemplateController@sendTestEmailTemplate');
		
		
		
		
		
	});
	
	
	################################################################# Front Routing end here ###################################################

	################################################################# Admin Routing start here###################################################
	Route::group(array('prefix' => 'admin'), function() {
		Route::group(array('middleware' => 'App\Http\Middleware\GuestAdmin','namespace'=>'admin'), function() {
			Route::get('','AdminLoginController@login');
			Route::any('/login','AdminLoginController@login');
			Route::get('forget_password','AdminLoginController@forgetPassword');
			Route::get('reset_password/{validstring}','AdminLoginController@resetPassword');
			Route::post('send_password','AdminLoginController@sendPassword');
			Route::post('save_password','AdminLoginController@resetPasswordSave');	
		});
	
		Route::group(array('middleware' => 'App\Http\Middleware\AuthAdmin','namespace'=>'admin'), function() {
			Route::get('/logout','AdminLoginController@logout');
			Route::get('dashboard','AdminDashBoardController@showdashboard');
			Route::get('/myaccount','AdminDashBoardController@myaccount');
			Route::post('/myaccount','AdminDashBoardController@myaccountUpdate');
			
			Route::get('/change-password','AdminDashBoardController@change_password');
			Route::post('/changed-password','AdminDashBoardController@changedPassword');
			
			
			Route::post('/ajaxdata/get_more_availability','AjaxdataController@get_more_availability');
			
			
			/** settings routing**/
			Route::any('/settings',array('as'=>'settings.listSetting','uses'=>'SettingsController@listSetting'));
			Route::get('/settings/add-setting','SettingsController@addSetting');
			Route::post('/settings/add-setting','SettingsController@saveSetting');
			Route::get('/settings/edit-setting/{id}','SettingsController@editSetting');
			Route::post('/settings/edit-setting/{id}','SettingsController@updateSetting');
			Route::get('/settings/prefix/{slug}','SettingsController@prefix');
			Route::post('/settings/prefix/{slug}','SettingsController@updatePrefix');
			Route::delete('/settings/delete-setting/{id}','SettingsController@deleteSetting');
			/** settings routing**/
			
			/** cms-manager routing**/
			Route::any('/cms-manager',array('as'=>'Cms.index','uses'=>'CmspagesController@listCms'));
			Route::get('cms-manager/add-cms','CmspagesController@addCms');
			Route::post('cms-manager/add-cms','CmspagesController@saveCms');
			Route::get('cms-manager/edit-cms/{id}','CmspagesController@editCms');
			Route::post('cms-manager/edit-cms/{id}','CmspagesController@updateCms');
			Route::get('cms-manager/update-status/{id}/{status}','CmspagesController@updateCmsStatus');
			/** cms-manager routing**/
			
			
			/** email-manager routing**/
			Route::get('/email-manager',array('as'=>'EmailTemplate.index','uses'=>'EmailtemplateController@listTemplate'));
			Route::get('/email-manager/add-template',array('as'=>'EmailTemplate.add','uses'=>'EmailtemplateController@addTemplate'));
			Route::post('/email-manager/add-template','EmailtemplateController@saveTemplate');
			Route::get('/email-manager/edit-template/{id}',array('as'=>'EmailTemplate.edit','uses'=>'EmailtemplateController@editTemplate'));
			Route::post('/email-manager/edit-template/{id}','EmailtemplateController@updateTemplate');
			Route::post('/email-manager/get-constant','EmailtemplateController@getConstant');
			
			### Email Logs Manager routing
			Route::get('/email-logs',array('as'=>'EmailLogs.listEmail','uses'=>'EmailLogsController@listEmail'));
			Route::any('/email-logs/email_details/{id}','EmailLogsController@EmailDetail');
			/** email-manager routing**/
			
			
			/** Dropdown manager  module  routing start here **/
			Route::get('dropdown-manager/add-dropdown/{type}','DropDownController@addDropDown');
			Route::post('dropdown-manager/add-dropdown/{type}','DropDownController@saveDropDown');
			Route::get('dropdown-manager/edit-dropdown/{id}/{type}','DropDownController@editDropDown');
			Route::post('dropdown-manager/edit-dropdown/{id}/{type}','DropDownController@updateDropDown');
			Route::get('dropdown-manager/update-dropdown/{id}/{status}/{type}',array('as'=>'DropDown.status','uses'=>'DropDownController@updateDropDownStatus'));
			Route::get('dropdown-manager/delete-dropdown/{id}/{type}','DropDownController@deleteDropDown');
			Route::delete('dropdown-manager/delete-dropdown/{id}/{type}','DropDownController@deleteDropDown');
			Route::get('/dropdown-manager/{type}',array('as'=>'DropDown.listDropDown','uses'=>'DropDownController@listDropDown'));
			Route::get('/dropdown-manager/{type}/{isimage}',array('as'=>'DropDown.listDropDown','uses'=>'DropDownController@listDropDown'));
			Route::post('/dropdown-manager/{type}','DropDownController@listDropDown');
			/** Dropdown manager  module  routing start here **/
			
			##Block manager  module  routing start here
			Route::get('/block-manager',array('as'=>'Block.index','uses'=>'BlockController@listBlock'));
			Route::get('block-manager/add-block',array('as'=>'Block.add','uses'=>'BlockController@addBlock'));
			Route::post('block-manager/add-block',array('as'=>'Block.save','uses'=>'BlockController@saveBlock'));
			Route::get('block-manager/edit-block/{id}',array('as'=>'Block.edit','uses'=>'BlockController@editBlock'));
			Route::post('block-manager/edit-block/{id}',array('as'=>'Block.update','uses'=>'BlockController@updateBlock'));
			Route::get('block-manager/update-status/{id}/{status}',array('as'=>'Block.status','uses'=>'BlockController@updateBlockStatus'));
			Route::any('block-manager/delete-block/{id}',array('as'=>'Block.delete','uses'=>'BlockController@deleteBlock'));		
			Route::post('block-manager/multiple-action',array('as'=>'Block.Multipleaction','uses'=>'BlockController@performMultipleAction'));
			
			Route::any('block-manager/change_order',array('as'=>'Block.change_order','uses'=>'BlockController@changeBlockOrder'));
			##Block manager  module  routing end here
			
			
			##HowItWork manager routing 
			Route::any('/how-it-work-manager',array('as'=>'HowItWork.index','uses'=>'HowItWorkController@listHowItWork'));
			Route::get('how-it-work-manager/add-how-it-work',array('as'=>'HowItWork.add','uses'=>'HowItWorkController@addHowItWork'));
			Route::post('how-it-work-manager/add-how-it-work',array('as'=>'HowItWork.save','uses'=>'HowItWorkController@saveHowItWork'));
			Route::get('how-it-work-manager/edit-how-it-work/{id}',array('as'=>'HowItWork.edit','uses'=>'HowItWorkController@editHowItWork'));
			Route::post('how-it-work-manager/edit-how-it-work/{id}',array('as'=>'HowItWork.update','uses'=>'HowItWorkController@updateHowItWork'));
			Route::get('how-it-work-manager/update-status/{id}/{status}',array('as'=>'HowItWork.status','uses'=>'HowItWorkController@updateHowItWorkStatus'));
			Route::get('how-it-work-manager/delete-how-it-work/{id}',array('as'=>'HowItWork.delete','uses'=>'HowItWorkController@deleteHowItWork'));
			Route::delete('how-it-work-manager/delete-how-it-work/{id}',array('as'=>'HowItWork.delete','HowItWorkController@deleteHowItWork'));
			Route::get('how-it-work-manager/mark-highlight/{id}/{status}','HowItWorkController@markHighlight');
			Route::any('how-it-work-manager/change_order',array('as'=>'how.change_order','uses'=>'HowItWorkController@changeBlockOrder'));
			##HowItWork manager routing
			
			### contact manager routing
			Route::any('/contact-manager',array('as'=>'Contact.index','uses'=>'ContactsController@listContact'));
			Route::get('contact-manager/view-contact/{id}',array('as'=>'Contact.view','uses'=>'ContactsController@viewContact'));
			Route::get('contact-manager/delete-contact/{id}',array('as'=>'Contact.delete','uses'=>'ContactsController@deleteContact'));
			Route::any('/contact-manager/reply-to-user/{id}',array('as'=>'Contact.reply','uses'=>'ContactsController@replyToUser'));
			### contact manager routing
			
			##System Doc routing start here
			Route::get('/system-doc-manager',array('as'=>'SystemDoc.index','uses'=>'SystemDocController@listDoc'));
			Route::post('/system-doc-manager','SystemDocController@listDoc');
			Route::get('system-doc-manager/add-doc','SystemDocController@addDoc');
			Route::post('system-doc-manager/add-doc','SystemDocController@saveDoc');
			Route::get('system-doc-manager/edit-doc/{id}','SystemDocController@editDoc');
			Route::post('system-doc-manager/edit-doc/{id}','SystemDocController@updateDoc');
			Route::get('system-doc-manager/update-status/{id}/{status}','SystemDocController@updateDocStatus');
			Route::any('system-doc-manager/delete-doc/{id}','SystemDocController@deleteDoc');		
			Route::post('system-doc-manager/multiple-action','SystemDocController@performMultipleAction');
			##System Doc routing end here
			
			##Seo routing start here
			Route::get('/no-cms-manager',array('as'=>'NoCms.index','uses'=>'NoCmsController@listDoc'));
			Route::post('/no-cms-manager','NoCmsController@listDoc');
			Route::get('no-cms-manager/add-doc','NoCmsController@addDoc');
			Route::post('no-cms-manager/add-doc','NoCmsController@saveDoc');
			Route::get('no-cms-manager/edit-doc/{id}','NoCmsController@editDoc');
			Route::post('no-cms-manager/edit-doc/{id}','NoCmsController@updateDoc');
			Route::get('no-cms-manager/update-status/{id}/{status}','NoCmsController@updateDocStatus');
			Route::any('no-cms-manager/delete-doc/{id}','NoCmsController@deleteDoc');		
			Route::post('no-cms-manager/multiple-action','NoCmsController@performMultipleAction');
			##Seo routing end here
			
			###slider manager routing
			Route::get('/slider-manager',array('as'=>'Slider.index','uses'=>'SlidersController@listSlider'));
			Route::get('slider-manager/add-slider',array('as'=>'Slider.add','uses'=>'SlidersController@addSlider'));
			Route::post('slider-manager/add-slider',array('as'=>'Slider.save','uses'=>'SlidersController@saveSlider'));
			Route::get('slider-manager/edit-slider/{id}',array('as'=>'Slider.edit','uses'=>'SlidersController@editSlider'));
			Route::post('slider-manager/edit-slider',array('as'=>'Slider.update','uses'=>'SlidersController@updateSlider'));
			Route::any('slider-manager/delete-slider/{id}',array('as'=>'Slider.delete','uses'=>'SlidersController@deleteSlider'));
			Route::get('slider-manager/update-status/{id}/{status}',array('as'=>'Slider.status','uses'=>'SlidersController@updateSliderStatus'));
			Route::any('slider-manager/change_order',array('as'=>'Slider.change_order','uses'=>'SlidersController@changeSliderOrder'));
			Route::post('slider-manager/multiple-action',array('as'=>'Slider.Multipleaction','uses'=>'SlidersController@performMultipleAction'));
			###slider manager routing
			
			##Testimonial manager routing
			Route::any('/testimonial-manager',array('as'=>'Testimonial.index','uses'=>'TestimonialController@listTestimonial'));
			Route::get('testimonial-manager/add-testimonial',array('as'=>'Testimonial.add','uses'=>'TestimonialController@addTestimonial'));
			Route::post('testimonial-manager/add-testimonial',array('as'=>'Testimonial.save','uses'=>'TestimonialController@saveTestimonial'));
			Route::get('testimonial-manager/edit-testimonial/{id}',array('as'=>'Testimonial.edit','uses'=>'TestimonialController@editTestimonial'));
			Route::post('testimonial-manager/edit-testimonial/{id}',array('as'=>'Testimonial.update','uses'=>'TestimonialController@updateTestimonial'));
			Route::get('testimonial-manager/update-status/{id}/{status}',array('as'=>'Testimonial.status','uses'=>'TestimonialController@updateTestimonialStatus'));
			Route::get('testimonial-manager/delete-testimonial/{id}',array('as'=>'Testimonial.delete','uses'=>'TestimonialController@deleteTestimonial'));
			Route::delete('testimonial-manager/delete-testimonial/{id}',array('as'=>'Testimonial.delete','TestimonialController@deleteTestimonial'));
			Route::get('testimonial-manager/mark-highlight/{id}/{status}','TestimonialController@markHighlight');
			Route::any('testimonial-manager/change_order',array('as'=>'Testimonial.change_order','uses'=>'TestimonialController@changeBlockOrder'));
			##Testimonial manager routing
			
			# users routing start here //
			Route::get('/users',array('as'=>'Users.index','uses'=>'UsersController@listUsers'));
			Route::post('users','UsersController@listUsers');
			Route::get('users/view-user/{id}','UsersController@viewUser');
			Route::get('users/update-status/{id}/{status}','UsersController@updateUserStatus');
			Route::any('users/delete-user/{id}','UsersController@deleteUser');
			Route::get('users/verify-user/{id}','UsersController@verifiedUser');
			Route::get('users/add-user','UsersController@addUser');
			Route::post('users/add-user','UsersController@saveUser');	
			Route::get('users/edit-user/{id}','UsersController@editUser');
			Route::post('users/edit-user/{id}','UsersController@updateUser');	
			Route::any('users/send-credential/{id}','UsersController@sendCredential');	
			Route::get('users/message/{id}','UsersController@sendMessage');	
			Route::post('users/message/{id}','UsersController@saveMessage');	
			Route::get('users/track-records/{id}','UsersController@listTrack');
			Route::get('users/track-records-view/{id}','UsersController@viewTrack');
			
			Route::get('users/rates-user/{id}','UsersController@rates_user');	
			Route::post('users/rates-user/{id}','UsersController@submitRateUser');	
			# users routing start here //
			
			
			
			// language routing
			Route::get('language',array('as'=>'Language.index','uses'=>'LanguageController@listLanguage'));
			Route::get('language/add-language',array('as'=>'Language.add','uses'=>'LanguageController@addLanguage'));
			Route::post('language/save-language',array('as'=>'Language.save','uses'=>'LanguageController@saveLanguage'));
			Route::any('language/delete-language/{id}',array('as'=>'Language.delete','uses'=>'LanguageController@deleteLanguage'));
			Route::get('language/update-status/{id}/{status}',array('as'=>'Language.status','uses'=>'LanguageController@updateLanguageStatus'));
			Route::any('language/default/{id}/{langCode}/{folderCode}',array('as'=>'Language.update_default','uses'=>'LanguageController@updateDefaultLanguage'));
			Route::any('language/multiple-action',array('as'=>'Language.Multipleaction','uses'=>'LanguageController@performMultipleAction'));
			
			### Language setting start //
			// Route::get('language-settings',array('as'=>'LanguageSetting.index','uses'=>'LanguageSettingsController@listLanguageSetting'));
			// Route::get('/language-settings/add-setting',array('as'=>'LanguageSetting.add','uses'=>'LanguageSettingsController@addLanguageSetting'));
			// Route::post('/language-settings/add-setting',array('as'=>'LanguageSetting.save','uses'=>'LanguageSettingsController@saveLanguageSetting'));
			// Route::any('/language-settings/import/{language_code}',array('as'=>'LanguageSetting.import','uses'=>'LanguageSettingsController@import'));
			
			// Route::get('/language-settings/edit-setting/{id}',array('as'=>'LanguageSetting.edit','uses'=>'LanguageSettingsController@editLanguageSetting'));
			// Route::any('/language-settings/edit-setting',array('as'=>'LanguageSetting.update','uses'=>'LanguageSettingsController@updateLanguageSetting'));			
			
			
			
			### Template  routing start here 
			Route::get('/news-letter','NewsLetterController@listTemplate');
			Route::post('/news-letter','NewsLetterController@listTemplate');
			Route::get('/news-letter/edit-template/{id}','NewsLetterController@editTemplate');
			Route::post('/news-letter/edit-template/{id}','NewsLetterController@updateTemplate');
			
			Route::get('/news-letter','NewsLetterController@listTemplate');
			Route::get('/news-letter',array('as'=>'NewsLetter.listTemplate','uses'=>'NewsLetterController@listTemplate'));
			Route::post('/news-letter','NewsLetterController@listTemplate');
			Route::get('/news-letter/edit-template/{id}','NewsLetterController@editTemplate');
			Route::post('/news-letter/edit-template/{id}','NewsLetterController@updateTemplate');
			Route::get('/news-letter/newsletter-templates',array('as'=>'NewsTemplates.newsletterTemplates','uses'=>'NewsLetterController@newsletterTemplates'));
			Route::get('/news-letter/add-template','NewsLetterController@addTemplates');
			Route::any('/news-letter/add-subscriber','NewsLetterController@addSubscriber');
			Route::post('/news-letter/add-template','NewsLetterController@saveTemplates');
			Route::get('/news-letter/edit-newsletter-templates/{id}','NewsLetterController@editNewsletterTemplate');
			Route::post('/news-letter/edit-newsletter-templates/{id}','NewsLetterController@updateNewsletterTemplate');
			Route::get('/news-letter/send-newsletter-templates/{id}','NewsLetterController@sendNewsletterTemplate');
			Route::post('/news-letter/send-newsletter-templates/{id}','NewsLetterController@updateSendNewsletterTemplate');
			Route::get('/news-letter/subscriber-list',array('as'=>'Subscriber.subscriberList','uses'=>'NewsLetterController@subscriberList'));
			Route::get('/news-letter/subscriber-active/{id}/{status}','NewsLetterController@subscriberActive');
			Route::any('news-letter/subscriber-delete/{id}','NewsLetterController@subscriberDelete');
			Route::any('news-letter/delete-template/{id}','NewsLetterController@templateDelete');
			Route::any('news-letter/view-subscriber/{id}','NewsLetterController@viewSubscrieber');
			Route::any('news-letter/delete-newsletter-template/{id}','NewsLetterController@deleteNewsTemplate');
			Route::post('news-letter/delete-multiple-subscriber','NewsLetterController@deleteMultipleSubscriber');
			
			##blog manager  module  routing start here
			Route::get('/blog-manager',array('as'=>'Blog.index','uses'=>'BlogController@listBlog'));
			Route::get('blog-manager/add-blog',array('as'=>'Blog.add','uses'=>'BlogController@addBlog'));
			Route::post('blog-manager/add-blog',array('as'=>'Blog.save','uses'=>'BlogController@saveBlog'));
			Route::get('blog-manager/edit-blog/{id}',array('as'=>'Blog.edit','uses'=>'BlogController@editBlog'));
			Route::post('blog-manager/edit-blog/{id}',array('as'=>'Blog.update','uses'=>'BlogController@updateBlog'));
			Route::get('blog-manager/update-status/{id}/{status}',array('as'=>'Blog.status','uses'=>'BlogController@updateBlogStatus'));
			Route::any('blog-manager/delete-blog/{id}',array('as'=>'Blog.delete','uses'=>'BlogController@deleteBlog'));		
			Route::post('blog-manager/multiple-action',array('as'=>'Blog.Multipleaction','uses'=>'BlogController@performMultipleAction'));
			
			Route::any('blog-manager/change_order',array('as'=>'Blog.change_order','uses'=>'BlogController@changeBlogOrder'));
			##blog manager  module  routing end here
			
			
			Route::get('/track-records',array('as'=>'Track.index','uses'=>'TrackController@listTrack'));
			Route::any('track-records/delete-track/{id}',array('as'=>'Track.delete','uses'=>'TrackController@deleteTrack'));		
			Route::get('/track-records/view-record/{id}',array('as'=>'Track.view','uses'=>'TrackController@viewTrack'));
			Route::post('track-records/multiple-action',array('as'=>'Track.Multipleaction','uses'=>'TrackController@performMultipleAction'));
			
			
		});
	});
	################################################################# Admin Routing end here###################################################
