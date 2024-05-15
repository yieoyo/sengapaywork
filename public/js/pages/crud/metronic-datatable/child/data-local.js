'use strict';
// Class definition
var KTDatatableChildDataLocalDemo = function() {
	// Private functions

	var subTableInit = function(e) {
		$('<div/>').attr('id', 'child_data_local_' + e.data.RecordID).appendTo(e.detailCell).KTDatatable({
			data: {
				type: 'local',
				source: e.data.Orders,
				pageSize: 5,
			},

			// layout definition
			layout: {
				scroll: true,
				height: 400,
				footer: false,
			},

			sortable: true,

			// columns definition
			columns: [
				{
					field: 'GuestName',
					title: 'Guest Name',
					template: function(row) {
						return '<span>' + row.OrderID + ' </span>';
					},
				}, {
					field: 'BookingDate',
					title: 'Booking Date',
					width: 150
				}, {
					field: 'PackageName',
					title: 'Package Name',
				}, {
					field: 'DepartureDate',
					title: 'Departure Date',
				}, {
					field: 'TotalPayment',
					title: 'Payment',
					type: 'number',
				}, {
					field: 'Status',
					title: 'Status',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Deposit', 'class': 'kt-badge--brand'},
							2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
							3: {'title': 'Cancelled', 'class': ' kt-badge--primary'},
							4: {'title': 'Paid', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Danger', 'class': ' kt-badge--danger'},
							7: {'title': 'Cancelled', 'class': ' kt-badge--warning'},
						};
						return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
					},
				}, {
					field: 'Type',
					title: 'Method',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'QR Code', 'state': 'danger'},
							2: {'title': 'CDM', 'state': 'primary'},
							3: {'title': 'Cash', 'state': 'success'},
						};
						return '<span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' +
							status[row.Type].state + '">' +
							status[row.Type].title + '</span>';
					},
				}],
		});
	};

	// demo initializer
	var mainTableInit = function() {

		var dataJSONArray = JSON.parse(
			'[{"RecordID":1,"FirstName":"Tommie", "Branches":"Branch HQ","Company":"Roodel","Email":"tpee0@slashdot.org", "ReferralID":"3321","Phone":"103-891-3486","Status":4,"Type":1,"Orders":[{"OrderID":"Sit Sarah bte Haji Mael.","BookingDate":"04/11/2019","PackageName":"Package 1","DepartureDate":"04/03/2020","OrderDate":"3/7/2017","TotalPayment":"RM3000/RM4800","Status":1,"Type":1},{"OrderID":"Maaf b. Hujan","BookingDate":"04/11/2019","PackageName":"Package 1","DepartureDate":"04/03/2020","OrderDate":"5/12/2017","TotalPayment":"RM900/RM5200","Status":1,"Type":1},{"OrderID":"Yaakob b. Hasan","BookingDate":"04/11/2019","PackageName":"Package 1","DepartureDate":"04/03/2020","OrderDate":"2/12/2017","TotalPayment":"RM5200/RM5200","Status":4,"Type":1},{"OrderID":"Suazaaan bte. Jihan","BookingDate":"04/11/2019","PackageName":"Package 1","DepartureDate":"04/03/2020","OrderDate":"6/6/2017","TotalPayment":"RM300/RM3200","Status":7,"Type":3},{"OrderID":"Rumi bte. Jawi","BookingDate":"04/11/2019","PackageName":"Package 1","DepartureDate":"04/03/2020","OrderDate":"9/1/2017","TotalPayment":"RM0/RM1500","Status":7,"Type":2},{"OrderID":"42023-131","ShipCountry":"BR","ShipAddress":"4238 Roth Drive","ShipName":"Boehm LLC","OrderDate":"4/23/2016","TotalPayment":"$300684.31","Status":6,"Type":3},{"OrderID":"14290-350","ShipCountry":"CN","ShipAddress":"41950 Troy Point","ShipName":"Windler, Larkin and Collier","OrderDate":"4/17/2017","TotalPayment":"$467794.40","Status":4,"Type":1}]},\n' +
			'{"RecordID":2,"FirstName":"Scott","Branches":"Branch 1","Email":"scoldbreath1@zdnet.com","ReferralID":"2212","Phone":"143-179-5104","Status":4,"Type":1,"Orders":[{"OrderID":"55316-029","ShipCountry":"ID","ShipAddress":"56955 Rusk Street","ShipName":"Paucek, Dietrich and Bergnaum","OrderDate":"9/27/2016","TotalPayment":"$662732.49","Status":2,"Type":3},{"OrderID":"68462-467","ShipCountry":"CN","ShipAddress":"13005 Bultman Court","ShipName":"Stamm Group","OrderDate":"3/22/2017","TotalPayment":"$653958.68","Status":4,"Type":2},{"OrderID":"55154-8270","ShipCountry":"UG","ShipAddress":"6 Brentwood Place","ShipName":"Stroman, Schowalter and Bogan","OrderDate":"8/20/2016","TotalPayment":"$57166.20","Status":3,"Type":2},{"OrderID":"63736-002","ShipCountry":"ID","ShipAddress":"51 Banding Junction","ShipName":"Crona-Konopelski","OrderDate":"2/5/2017","TotalPayment":"$733681.16","Status":3,"Type":2},{"OrderID":"54868-5182","ShipCountry":"CN","ShipAddress":"629 Oxford Alley","ShipName":"Lindgren LLC","OrderDate":"5/21/2016","TotalPayment":"$921137.56","Status":3,"Type":2},{"OrderID":"55714-4529","ShipCountry":"JP","ShipAddress":"9 Melvin Point","ShipName":"Kris-Will","OrderDate":"4/29/2016","TotalPayment":"$184624.81","Status":1,"Type":2},{"OrderID":"63736-305","ShipCountry":"CN","ShipAddress":"84196 New Castle Junction","ShipName":"Lockman-Luettgen","OrderDate":"9/7/2016","TotalPayment":"$922821.30","Status":2,"Type":2}]},\n' +
			'{"RecordID":3,"FirstName":"Flss","Branches":"Branch 2","Email":"fthake2@ifeng.com","ReferralID":"4321","Phone":"695-591-2075","Status":2,"Type":1,"Orders":[{"OrderID":"0113-0461","ShipCountry":"PS","ShipAddress":"797 Crownhardt Junction","ShipName":"Eichmann and Sons","OrderDate":"3/16/2016","TotalPayment":"$241462.16","Status":2,"Type":3},{"OrderID":"51824-023","ShipCountry":"BR","ShipAddress":"3066 Emmet Drive","ShipName":"Strosin, Lehner and Gislason","OrderDate":"9/17/2016","TotalPayment":"$194555.85","Status":3,"Type":2},{"OrderID":"57520-0221","ShipCountry":"BR","ShipAddress":"2 Havey Trail","ShipName":"Lang, Anderson and Keebler","OrderDate":"6/18/2016","TotalPayment":"$386865.72","Status":2,"Type":1},{"OrderID":"56062-388","ShipCountry":"CN","ShipAddress":"9 Boyd Avenue","ShipName":"Hegmann-Kemmer","OrderDate":"7/1/2016","TotalPayment":"$837648.17","Status":1,"Type":1},{"OrderID":"35356-723","ShipCountry":"UA","ShipAddress":"35 Chive Lane","ShipName":"Konopelski-Cummings","OrderDate":"7/17/2017","TotalPayment":"$730238.90","Status":5,"Type":2},{"OrderID":"35356-491","ShipCountry":"SE","ShipAddress":"6343 Talmadge Street","ShipName":"Wolf Inc","OrderDate":"1/18/2017","TotalPayment":"$777918.32","Status":6,"Type":1},{"OrderID":"76369-4001","ShipCountry":"CN","ShipAddress":"8737 Dunning Plaza","ShipName":"Cruickshank, Gleichner and Gerlach","OrderDate":"9/20/2016","TotalPayment":"$1197505.61","Status":1,"Type":3},{"OrderID":"0378-5042","ShipCountry":"TH","ShipAddress":"1 Old Shore Plaza","ShipName":"Olson-Stark","OrderDate":"8/2/2016","TotalPayment":"$661232.02","Status":5,"Type":2}]},\n' +
			'{"RecordID":4,"FirstName":"Vincents","Branches":"Branch 5","Email":"vfrearson3@amazon.de","ReferralID":"3221","Phone":"197-717-7100","Status":4,"Type":2,"Orders":[{"OrderID":"68084-502","ShipCountry":"BR","ShipAddress":"0814 Briar Crest Plaza","ShipName":"Olson-Connelly","OrderDate":"4/8/2016","TotalPayment":"$494707.94","Status":3,"Type":2},{"OrderID":"76167-002","ShipCountry":"SE","ShipAddress":"7 Quincy Road","ShipName":"Heaney, Lemke and McCullough","OrderDate":"1/10/2017","TotalPayment":"$372281.64","Status":5,"Type":3},{"OrderID":"0517-9702","ShipCountry":"RU","ShipAddress":"948 Granby Lane","ShipName":"Abshire-Cartwright","OrderDate":"1/17/2017","TotalPayment":"$720235.30","Status":1,"Type":1},{"OrderID":"53499-7272","ShipCountry":"UA","ShipAddress":"2553 Ronald Regan Point","ShipName":"Hudson-Breitenberg","OrderDate":"4/29/2017","TotalPayment":"$590146.91","Status":3,"Type":3},{"OrderID":"23155-001","ShipCountry":"ID","ShipAddress":"0237 Larry Park","ShipName":"Fahey, Fritsch and Boyer","OrderDate":"12/7/2016","TotalPayment":"$918885.26","Status":6,"Type":3},{"OrderID":"24909-162","ShipCountry":"AR","ShipAddress":"338 Prentice Road","ShipName":"Yost-Kunde","OrderDate":"4/17/2016","TotalPayment":"$320952.62","Status":6,"Type":3},{"OrderID":"59078-031","ShipCountry":"CN","ShipAddress":"23409 Gale Court","ShipName":"Jenkins-Dickens","OrderDate":"9/28/2016","TotalPayment":"$374124.12","Status":1,"Type":3},{"OrderID":"30142-822","ShipCountry":"VE","ShipAddress":"64 Boyd Center","ShipName":"Bartell Group","OrderDate":"2/12/2016","TotalPayment":"$11592.95","Status":2,"Type":2},{"OrderID":"36987-3147","ShipCountry":"PK","ShipAddress":"66010 Express Pass","ShipName":"Cole, Wilkinson and Macejkovic","OrderDate":"1/28/2016","TotalPayment":"$594910.09","Status":3,"Type":2},{"OrderID":"65841-626","ShipCountry":"PH","ShipAddress":"9 West Way","ShipName":"Batz, Nienow and Spencer","OrderDate":"2/7/2016","TotalPayment":"$742058.75","Status":1,"Type":2},{"OrderID":"57520-0025","ShipCountry":"AU","ShipAddress":"18 Hanover Place","ShipName":"Bode, Upton and Christiansen","OrderDate":"3/28/2016","TotalPayment":"$555669.10","Status":2,"Type":2},{"OrderID":"24236-786","ShipCountry":"BG","ShipAddress":"29471 Kim Alley","ShipName":"Lakin-Murazik","OrderDate":"7/9/2016","TotalPayment":"$164304.08","Status":6,"Type":3}]},\n' +
			'{"RecordID":5,"FirstName":"Antony","Branches":"Branch 3","Email":"astranger4@sfgate.com","ReferralID":"2222","Phone":"165-466-2893","Status":2,"Type":3,"Orders":[{"OrderID":"53462-175","ShipCountry":"CL","ShipAddress":"6 Spohn Way","ShipName":"O\'Connell Inc","OrderDate":"2/3/2016","TotalPayment":"$749928.82","Status":1,"Type":3},{"OrderID":"53808-0733","ShipCountry":"VN","ShipAddress":"3 Warbler Point","ShipName":"Willms, Glover and O\'Keefe","OrderDate":"5/16/2016","TotalPayment":"$632155.47","Status":1,"Type":1},{"OrderID":"0054-0252","ShipCountry":"CN","ShipAddress":"65 Havey Alley","ShipName":"Deckow, Runolfsson and Kemmer","OrderDate":"4/10/2016","TotalPayment":"$1116585.99","Status":6,"Type":1},{"OrderID":"0093-9660","ShipCountry":"CN","ShipAddress":"2 Maple Drive","ShipName":"Padberg, Powlowski and Brekke","OrderDate":"4/11/2017","TotalPayment":"$513356.12","Status":3,"Type":3},{"OrderID":"63739-047","ShipCountry":"EC","ShipAddress":"0 Talmadge Junction","ShipName":"Rosenbaum-Yundt","OrderDate":"2/19/2016","TotalPayment":"$655497.21","Status":2,"Type":2},{"OrderID":"63323-370","ShipCountry":"ID","ShipAddress":"0 Ramsey Hill","ShipName":"Ankunding, Walsh and Stiedemann","OrderDate":"9/13/2017","TotalPayment":"$380382.26","Status":1,"Type":1},{"OrderID":"57237-040","ShipCountry":"CN","ShipAddress":"945 Golf View Junction","ShipName":"Gulgowski, Feil and Bosco","OrderDate":"2/3/2016","TotalPayment":"$545464.59","Status":3,"Type":1},{"OrderID":"62584-741","ShipCountry":"PY","ShipAddress":"82775 Prairieview Lane","ShipName":"Kihn-Barton","OrderDate":"10/16/2016","TotalPayment":"$571182.87","Status":3,"Type":2},{"OrderID":"0268-0196","ShipCountry":"RU","ShipAddress":"20712 Prentice Terrace","ShipName":"Spencer-Powlowski","OrderDate":"6/7/2017","TotalPayment":"$207925.11","Status":1,"Type":1},{"OrderID":"76214-002","ShipCountry":"US","ShipAddress":"587 Mccormick Parkway","ShipName":"King, O\'Hara and White","OrderDate":"11/14/2016","TotalPayment":"$751439.27","Status":1,"Type":1}]},\n' +
			'{"RecordID":94,"FirstName":"Tom","Branches":"Branch 3","Email":"toneill2l@twitter.com","ReferralID":"5321","Phone":"913-201-6258","Status":4,"Type":3,"Orders":[{"OrderID":"55111-154","ShipCountry":"PH","ShipAddress":"62 Little Fleur Avenue","ShipName":"Kris, Cronin and Ebert","OrderDate":"1/21/2016","TotalPayment":"$683381.79","Status":1,"Type":1},{"OrderID":"11822-0348","ShipCountry":"CN","ShipAddress":"140 Nancy Street","ShipName":"Mraz-Cole","OrderDate":"11/13/2017","TotalPayment":"$847098.44","Status":3,"Type":3},{"OrderID":"35356-473","ShipCountry":"PL","ShipAddress":"44 Mariners Cove Way","ShipName":"Rosenbaum Group","OrderDate":"2/21/2016","TotalPayment":"$788055.20","Status":4,"Type":1},{"OrderID":"60512-9300","ShipCountry":"VN","ShipAddress":"8 Dwight Terrace","ShipName":"Borer, Renner and McClure","OrderDate":"3/11/2017","TotalPayment":"$678113.91","Status":6,"Type":2},{"OrderID":"68084-055","ShipCountry":"BR","ShipAddress":"4 Farragut Crossing","ShipName":"McGlynn Inc","OrderDate":"3/28/2017","TotalPayment":"$1126780.70","Status":1,"Type":3},{"OrderID":"62499-535","ShipCountry":"PH","ShipAddress":"18 Anniversary Parkway","ShipName":"Toy LLC","OrderDate":"9/21/2016","TotalPayment":"$116014.63","Status":1,"Type":2},{"OrderID":"17433-9877","ShipCountry":"ZA","ShipAddress":"2 Hoepker Parkway","ShipName":"Wolff Inc","OrderDate":"8/17/2017","TotalPayment":"$976577.47","Status":3,"Type":2},{"OrderID":"10056-306","ShipCountry":"CN","ShipAddress":"97 Tennessee Plaza","ShipName":"Kautzer LLC","OrderDate":"7/8/2016","TotalPayment":"$1145695.83","Status":5,"Type":2},{"OrderID":"60505-6025","ShipCountry":"RU","ShipAddress":"168 Sycamore Way","ShipName":"Wisoky, Schuppe and Monahan","OrderDate":"10/7/2016","TotalPayment":"$903744.35","Status":6,"Type":3},{"OrderID":"54973-2906","ShipCountry":"CN","ShipAddress":"6 Porter Hill","ShipName":"Crist, Gaylord and Gerlach","OrderDate":"12/25/2017","TotalPayment":"$770673.33","Status":5,"Type":1},{"OrderID":"0603-1584","ShipCountry":"PH","ShipAddress":"697 Moland Trail","ShipName":"Koepp Group","OrderDate":"7/30/2016","TotalPayment":"$860539.83","Status":6,"Type":2},{"OrderID":"36987-1178","ShipCountry":"AM","ShipAddress":"73 Ruskin Lane","ShipName":"Hansen Group","OrderDate":"6/20/2017","TotalPayment":"$834647.39","Status":6,"Type":3},{"OrderID":"21695-228","ShipCountry":"CN","ShipAddress":"0722 Arapahoe Circle","ShipName":"Kuhic Group","OrderDate":"2/10/2016","TotalPayment":"$499027.62","Status":5,"Type":1}]},\n' +
			'{"RecordID":350,"FirstName":"Teddie","Branches":"Branch 5","Company":"Dabtype","Email":"tferneley9p@oakley.com","ReferralID":"1133","Phone":"284-728-5534","Status":4,"Type":2,"Orders":[{"OrderID":"13734-023","ShipCountry":"CN","ShipAddress":"3434 Gulseth Plaza","ShipName":"Hauck LLC","OrderDate":"7/12/2016","TotalPayment":"$707730.01","Status":3,"Type":2},{"OrderID":"64406-008","ShipCountry":"ID","ShipAddress":"4 Boyd Avenue","ShipName":"Dickens-Mann","OrderDate":"7/31/2016","TotalPayment":"$675692.10","Status":1,"Type":3},{"OrderID":"64117-596","ShipCountry":"IR","ShipAddress":"40 Katie Circle","ShipName":"Cremin, D\'Amore and Rowe","OrderDate":"12/4/2017","TotalPayment":"$479956.28","Status":1,"Type":2},{"OrderID":"0591-2784","ShipCountry":"CA","ShipAddress":"42 Sutherland Pass","ShipName":"Hermann-Schroeder","OrderDate":"6/25/2016","TotalPayment":"$242558.93","Status":3,"Type":2},{"OrderID":"55154-4029","ShipCountry":"PT","ShipAddress":"801 Badeau Alley","ShipName":"Cole, King and Crona","OrderDate":"10/12/2017","TotalPayment":"$641687.48","Status":6,"Type":2},{"OrderID":"65862-208","ShipCountry":"ID","ShipAddress":"325 Birchwood Alley","ShipName":"Anderson, Corkery and Gleason","OrderDate":"3/3/2016","TotalPayment":"$1180528.08","Status":5,"Type":3}]}]');

		var datatable = $('.kt-datatable').KTDatatable({
			// datasource definition
			data: {
				type: 'local',
				source: dataJSONArray,
				pageSize: 10, // display 20 records per page
			},

			// layout definition
			layout: {
				scroll: false,
				height: null,
				footer: false,
			},

			sortable: true,

			filterable: false,

			pagination: true,

			detail: {
				title: 'Load sub table',
				content: subTableInit,
			},

			search: {
				input: $('#generalSearch'),
			},

			// columns definition
			columns: [
				{
					field: 'RecordID',
					title: '',
					sortable: false,
					width: 30,
					textAlign: 'center',
				}, {
					field: 'FirstName',
					title: 'Sales Person Name',
				}, {
					field: 'Branches',
					title: 'Branches',
				}, {
					field: 'Email',
					title: 'Email',
				},  {
					field: 'ReferralID',
					title: 'Referral ID',
				}, {
					field: 'Status',
					title: 'Status',
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Pending', 'class': 'kt-badge--brand'},
							2: {'title': 'Not Active', 'class': ' kt-badge--danger'},
							3: {'title': 'Cancelled', 'class': ' kt-badge--primary'},
							4: {'title': 'Active', 'class': ' kt-badge--success'},
							5: {'title': 'Info', 'class': ' kt-badge--info'},
							6: {'title': 'Danger', 'class': ' kt-badge--danger'},
							7: {'title': 'Warning', 'class': ' kt-badge--warning'},
						};
						return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
					},
				}, {
					field: 'Type',
					title: 'Type',
					autoHide: false,
					// callback function support for column rendering
					template: function(row) {
						var status = {
							1: {'title': 'Agent', 'state': 'danger'},
							2: {'title': 'PU', 'state': 'primary'},
							3: {'title': 'FrontDesk', 'state': 'success'},
						};
						return '<span class="kt-badge kt-badge--' + status[row.Type].state + ' kt-badge--dot"></span>&nbsp;<span class="kt-font-bold kt-font-' + status[row.Type].state +
							'">' +
							status[row.Type].title + '</span>';
					},
				}, {
					field: 'Actions',
					width: 130,
					title: 'Actions',
					sortable: false,
					overflow: 'visible',
					template: function() {
						return '\
		                  <div class="dropdown">\
		                      <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
		                          <i class="la la-ellipsis-h"></i>\
		                      </a>\
		                      <div class="dropdown-menu dropdown-menu-right">\
		                          <a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\
		                          <a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\
		                          <a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\
		                      </div>\
		                  </div>\
		                  <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\
		                      <i class="la la-trash"></i>\
		                  </a>\
		              ';
					},
				}],
		});

		$('#kt_form_status').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Status');
		});

		$('#kt_form_type').on('change', function() {
			datatable.search($(this).val().toLowerCase(), 'Type');
		});

		$('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// Public functions
		init: function() {
			// init dmeo
			mainTableInit();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableChildDataLocalDemo.init();
});
