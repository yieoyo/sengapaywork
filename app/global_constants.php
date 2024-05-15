<?php
/* Global constants for site */
define('FFMPEG_CONVERT_COMMAND', '');


define("ADMIN_FOLDER", "admin/");
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', base_path());
define('APP_PATH', app_path());


define("IMAGE_CONVERT_COMMAND", "");
define('WEBSITE_URL', url('/').'/');
define('WEBSITE_JS_URL', WEBSITE_URL . 'js/');
define('WEBSITE_CSS_URL', WEBSITE_URL . 'css/');
define('WEBSITE_IMG_URL', WEBSITE_URL . 'img/');
define('WEBSITE_UPLOADS_ROOT_PATH', ROOT . DS . 'uploads' .DS );
define('WEBSITE_UPLOADS_URL', WEBSITE_URL . 'uploads/');

define('WEBSITE_ADMIN_URL', WEBSITE_URL.ADMIN_FOLDER );
define('WEBSITE_ADMIN_IMG_URL', WEBSITE_ADMIN_URL . 'img/');
define('WEBSITE_ADMIN_JS_URL', WEBSITE_ADMIN_URL . 'js/');
define('WEBSITE_ADMIN_FONT_URL', WEBSITE_ADMIN_URL . 'fonts/');
define('WEBSITE_ADMIN_CSS_URL', WEBSITE_ADMIN_URL . 'css/');


define('SETTING_FILE_PATH', APP_PATH . DS . 'settings.php');
define('MENU_FILE_PATH', APP_PATH . DS . 'menus.php');

define('CK_EDITOR_URL', WEBSITE_UPLOADS_URL . 'ckeditor_images/');
define('CK_EDITOR_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'ckeditor_images' . DS);

define('SLIDER_URL', WEBSITE_UPLOADS_URL . 'slider/');
define('SLIDER_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'slider' . DS); 

define('BLOCK_URL', WEBSITE_UPLOADS_URL . 'block/');
define('BLOCK_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'block' . DS); 

define('BLOG_IMG_URL', WEBSITE_UPLOADS_URL . 'blog_images/');
define('BLOG_IMG_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'blog_images' . DS); 

define('TESTIMONIAL_URL', WEBSITE_UPLOADS_URL . 'testimonial_images/');
define('TESTIMONIAL_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'testimonial_images' . DS); 

define('HOWITWORK_URL', WEBSITE_UPLOADS_URL . 'how_it_works_images/');
define('HOWITWORK_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'how_it_works_images' . DS); 

define('BLOG_IMAGE_URL', WEBSITE_UPLOADS_URL . 'blog/');
define('BLOG_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'blog' . DS); 

define('USER_PROFILE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'user_profile/');
define('USER_PROFILE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'user_profile' . DS);

define('CATEGORY_IMAGE_URL', WEBSITE_UPLOADS_URL . 'categories_images/');
define('CATEGORY_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'categories_images' . DS); 

define('MASTERS_IMAGE_URL', WEBSITE_UPLOADS_URL . 'masters/');
define('MASTERS_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'masters' . DS); 

define('SERVICE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'service_images/');
define('SERVICE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'service_images' . DS); 


define('PACKAGE_FILE_URL', WEBSITE_UPLOADS_URL . 'package_files/');
define('PACKAGE_FILE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'package_files' . DS); 

define('CMS_IMG_URL', WEBSITE_UPLOADS_URL . 'cms_images/');
define('CMS_IMG_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'cms_images' . DS); 

define('TEMPLATE_IMG_URL', WEBSITE_UPLOADS_URL . 'template_images/');
define('TEMPLATE_IMG_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'template_images' . DS); 

define('VIDEO_DEMO_IMAGE_URL', WEBSITE_UPLOADS_URL . 'video_demos/');
define('VIDEO_DEMO_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'video_demos' . DS);


define('ARTIST_VIDEO_DEMO_IMAGE_URL', WEBSITE_UPLOADS_URL . 'artist_video_demos/');
define('ARTIST_VIDEO_DEMO_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'artist_video_demos' . DS);


define('ARTIST_UPDATE_IMAGE_URL', WEBSITE_UPLOADS_URL . 'artist_updates/');
define('ARTIST_UPDATE_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'artist_updates' . DS);

define('CONTENT_IMAGE_URL', WEBSITE_UPLOADS_URL . 'franchises_content/');
define('CONTENT_IMAGE_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'franchises_content' . DS);

define('PAYMENT_RECEIPT_URL', WEBSITE_UPLOADS_URL . 'payment_receipts/');
define('PAYMENT_RECEIPT_ROOT_PATH', WEBSITE_UPLOADS_ROOT_PATH .  'payment_receipts' . DS);



/**  System document url path **/
if (!defined('SYSTEM_IMAGE_URL')) {
    define('SYSTEM_IMAGE_URL', WEBSITE_UPLOADS_URL . 'system_images/');
}

/**  System document upload directory path **/
if (!defined('SYSTEM_IMAGE_DIRECTROY_PATH')){
    define('SYSTEM_IMAGE_DIRECTROY_PATH', WEBSITE_UPLOADS_ROOT_PATH . 'system_images' . DS);
}

$config	=	array();

define('ALLOWED_TAGS_XSS', '<a><strong><b><p><br><figure><i><font><img><h1><h2><h3><h4><h5><h6><span><div><em><table><ul><li><section><thead><tbody><tr><td>');

define('ADMIN_ID', 1);
define('SUPER_ADMIN_ROLE_ID', 1);
define('ARTIST_USER_ROLE_ID', 3);
define('SITE_USER_ROLE_ID', 2);

Config::set("Site.currency", "$");
Config::set("Site.currencyCode", "USD");

Config::set('defaultLanguage', 'English');
Config::set('defaultLanguageCode', 'en');


Config::set('default_language.message', 'All the fields in English language are mandatory.');

Config::set('newsletter_template_constant',array('USER_NAME'=>'USER_NAME','TO_EMAIL'=>'TO_EMAIL','WEBSITE_URL'=>'WEBSITE_URL','UNSUBSCRIBE_LINK'=>'UNSUBSCRIBE_LINK'));


Config::set('lesson_duration',array("20"=>"20","30"=>"30","40"=>"40","60"=>"60"));

//////////////// extension 

define('IMAGE_EXTENSION','jpeg,jpg,png,gif,bmp');
define('PDF_EXTENSION','pdf');
define('DOC_EXTENSION','doc,xls');
define('VIDEO_EXTENSION','mpeg,avi,mp4,webm,flv,3gp,m4v,mkv,mov,moov');


define('TEXT_ADMIN_ID',1);
define('TEXT_FRONT_USER_ID',2);
define('FRONT_USER',2);
define('IS_ACTIVE',1);
define('Currency',"RM");
define('CURRENCY',"RM");


Config::set("Site.default_min_deposite_amount", "300");
Config::set("Site.default_sms_hub", "307b23e8940d302e61041000dae98fdd");


/**  Active Inactive global constant **/
define('ACTIVE',1);
define('INACTIVE',0);
define('MINUTES_TEXT',"Minutes");

define('IMAGE_INFO', '<div class="mws-form-message info">
	<a class="close pull-right" href="javascript:void(0);">&times;</a>
	<ul style="padding-left:12px">
		<li>Allowed file types are gif, jpeg, png, jpg.</li>
		<li>Large files may take some time to upload so please be patient and do not hit reload or your back button</li>
	</ul>
</div>');

/* Notifications */
define('LESSON_BOOKED',"lesson_booked");
define('BOOKED_LESSON_REJECTED',"booked_lesson_rejected");
define('BOOKED_LESSON_ACCEPTED',"booked_lesson_accepted");
define('BOOKED_LESSON_COMPLETED',"booked_lesson_completed");
define('LESSON_REQUEST',"lesson_request");
define('VIDEO_QUESION_ANSWER_RECEIVED',"video_quesion_answer_received");
define('VIDEO_FEEDBACK_RECEIVED',"video_feedback_received");
define('VIDEO_RATING_RECEIVED',"video_rating_received");
define('MASTERCLASS_PURCHASED',"masterclass_purchased");
define('LESSON_ADDED_BY_ARTIST',"lesson_added_by_artist");

Config::set('notification_type',array(
	'LESSON_BOOKED'=>'Lesson has been booked.',
	'BOOKED_LESSON_ACCEPTED'=>'Lesson has been accepted.',
	'BOOKED_LESSON_REJECTED'=>'Lesson has been rejected.',
	'BOOKED_LESSON_COMPLETED'=>'Lesson has been completed.',
	'LESSON_REQUEST'=>'Private lesson request has been received.',
	'VIDEO_QUESION_ANSWER_RECEIVED'=>'Answer received on your video.',
	'VIDEO_QUESION_ANSWER_RECEIVED'=>'Answer received on your video.',
	'VIDEO_FEEDBACK_RECEIVED'=>'Feedback received on your video.',
	'VIDEO_RATING_RECEIVED'=>'Rating given on your video.',
	'MASTERCLASS_PURCHASED'=>'MasterClass Purchased.',
	'LESSON_ADDED_BY_ARTIST'=>'Lesson added by artist.',
));

Config::set("Opentok.live_api_key", "45959212");
Config::set("Opentok.live_api_secret", "14fbbc673dd1dece0fedba62588cab45fc671760");
Config::set("Opentok.sandbox_api_key", "45959212");
Config::set("Opentok.sandbox_api_secret", "14fbbc673dd1dece0fedba62588cab45fc671760");
Config::set("Opentok.sandbox_mode", "1");

//Config::set('Authorize.api_login_id','5hRbV5n44');
//Config::set('Authorize.api_login_id','6dVcq3Fn4P');
Config::set('Authorize.api_login_id','9K4jF8cv');
//Config::set('Authorize.transaction_key','89KBSh4tVms532JR');
//Config::set('Authorize.transaction_key','5D89f6x99veW7ZPy');
Config::set('Authorize.transaction_key','9cY3TEH6253yq7vf');
Config::set('Authorize.sandboxMode',1);

Config::set('subtitle_language',array(
	'en'=>"English",
	"zh"=>"Chinese"
));

Config::set('currency',array(
	'$'=>"$",
	"£"=>"£"
));

Config::set('timezone',array
(
    1 => 'Africa/Abidjan',
    2 => 'Africa/Accra',
    3 => 'Africa/Addis_Ababa',
    4 => 'Africa/Algiers',
    5 => 'Africa/Asmara',
    6 => 'Africa/Bamako',
    7 => 'Africa/Bangui',
    8 => 'Africa/Banjul',
    9 => 'Africa/Bissau',
    10 => 'Africa/Blantyre',
    11 => 'Africa/Brazzaville',
    12 => 'Africa/Bujumbura',
    13 => 'Africa/Cairo',
    14 => 'Africa/Casablanca',
    15 => 'Africa/Ceuta',
    16 => 'Africa/Conakry',
    17 => 'Africa/Dakar',
    18 => 'Africa/Dar_es_Salaam',
    19 => 'Africa/Djibouti',
    20 => 'Africa/Douala',
    21 => 'Africa/El_Aaiun',
    22 => 'Africa/Freetown',
    23 => 'Africa/Gaborone',
    24 => 'Africa/Harare',
    25 => 'Africa/Johannesburg',
    26 => 'Africa/Juba',
    27 => 'Africa/Kampala',
    28 => 'Africa/Khartoum',
    29 => 'Africa/Kigali',
    30 => 'Africa/Kinshasa',
    31 => 'Africa/Lagos',
    32 => 'Africa/Libreville',
    33 => 'Africa/Lome',
    34 => 'Africa/Luanda',
    35 => 'Africa/Lubumbashi',
    36 => 'Africa/Lusaka',
    37 => 'Africa/Malabo',
    38 => 'Africa/Maputo',
    39 => 'Africa/Maseru',
    40 => 'Africa/Mbabane',
    41 => 'Africa/Mogadishu',
    42 => 'Africa/Monrovia',
    43 => 'Africa/Nairobi',
    44 => 'Africa/Ndjamena',
    45 => 'Africa/Niamey',
    46 => 'Africa/Nouakchott',
    47 => 'Africa/Ouagadougou',
    48 => 'Africa/Porto-Novo',
    49 => 'Africa/Sao_Tome',
    50 => 'Africa/Tripoli',
    51 => 'Africa/Tunis',
    52 => 'Africa/Windhoek',
    53 => 'America/Adak',
    54 => 'America/Anchorage',
    55 => 'America/Anguilla',
    56 => 'America/Antigua',
    57 => 'America/Araguaina',
    58 => 'America/Argentina/Buenos_Aires',
    59 => 'America/Argentina/Catamarca',
    60 => 'America/Argentina/Cordoba',
    61 => 'America/Argentina/Jujuy',
    62 => 'America/Argentina/La_Rioja',
    63 => 'America/Argentina/Mendoza',
    64 => 'America/Argentina/Rio_Gallegos',
    65 => 'America/Argentina/Salta',
    66 => 'America/Argentina/San_Juan',
    67 => 'America/Argentina/San_Luis',
    68 => 'America/Argentina/Tucuman',
    69 => 'America/Argentina/Ushuaia',
    70 => 'America/Aruba',
    71 => 'America/Asuncion',
    72 => 'America/Atikokan',
    73 => 'America/Bahia',
    74 => 'America/Bahia_Banderas',
    75 => 'America/Barbados',
    76 => 'America/Belem',
    77 => 'America/Belize',
    78 => 'America/Blanc-Sablon',
    79 => 'America/Boa_Vista',
    80 => 'America/Bogota',
    81 => 'America/Boise',
    82 => 'America/Cambridge_Bay',
    83 => 'America/Campo_Grande',
    84 => 'America/Cancun',
    85 => 'America/Caracas',
    86 => 'America/Cayenne',
    87 => 'America/Cayman',
    88 => 'America/Chicago',
    89 => 'America/Chihuahua',
    90 => 'America/Costa_Rica',
    91 => 'America/Creston',
    92 => 'America/Cuiaba',
    93 => 'America/Curacao',
    94 => 'America/Danmarkshavn',
    95 => 'America/Dawson',
    96 => 'America/Dawson_Creek',
    97 => 'America/Denver',
    98 => 'America/Detroit',
    99 => 'America/Dominica',
    100 => 'America/Edmonton',
    101 => 'America/Eirunepe',
    102 => 'America/El_Salvador',
    103 => 'America/Fort_Nelson',
    104 => 'America/Fortaleza',
    105 => 'America/Glace_Bay',
    106 => 'America/Godthab',
    107 => 'America/Goose_Bay',
    108 => 'America/Grand_Turk',
    109 => 'America/Grenada',
    110 => 'America/Guadeloupe',
    111 => 'America/Guatemala',
    112 => 'America/Guayaquil',
    113 => 'America/Guyana',
    114 => 'America/Halifax',
    115 => 'America/Havana',
    116 => 'America/Hermosillo',
    117 => 'America/Indiana/Indianapolis',
    118 => 'America/Indiana/Knox',
    119 => 'America/Indiana/Marengo',
    120 => 'America/Indiana/Petersburg',
    121 => 'America/Indiana/Tell_City',
    122 => 'America/Indiana/Vevay',
    123 => 'America/Indiana/Vincennes',
    124 => 'America/Indiana/Winamac',
    125 => 'America/Inuvik',
    126 => 'America/Iqaluit',
    127 => 'America/Jamaica',
    128 => 'America/Juneau',
    129 => 'America/Kentucky/Louisville',
    130 => 'America/Kentucky/Monticello',
    131 => 'America/Kralendijk',
    132 => 'America/La_Paz',
    133 => 'America/Lima',
    134 => 'America/Los_Angeles',
    135 => 'America/Lower_Princes',
    136 => 'America/Maceio',
    137 => 'America/Managua',
    138 => 'America/Manaus',
    139 => 'America/Marigot',
    140 => 'America/Martinique',
    141 => 'America/Matamoros',
    142 => 'America/Mazatlan',
    143 => 'America/Menominee',
    144 => 'America/Merida',
    145 => 'America/Metlakatla',
    146 => 'America/Mexico_City',
    147 => 'America/Miquelon',
    148 => 'America/Moncton',
    149 => 'America/Monterrey',
    150 => 'America/Montevideo',
    151 => 'America/Montserrat',
    152 => 'America/Nassau',
    153 => 'America/New_York',
    154 => 'America/Nipigon',
    155 => 'America/Nome',
    156 => 'America/Noronha',
    157 => 'America/North_Dakota/Beulah',
    158 => 'America/North_Dakota/Center',
    159 => 'America/North_Dakota/New_Salem',
    160 => 'America/Ojinaga',
    161 => 'America/Panama',
    162 => 'America/Pangnirtung',
    163 => 'America/Paramaribo',
    164 => 'America/Phoenix',
    165 => 'America/Port-au-Prince',
    166 => 'America/Port_of_Spain',
    167 => 'America/Porto_Velho',
    168 => 'America/Puerto_Rico',
    169 => 'America/Punta_Arenas',
    170 => 'America/Rainy_River',
    171 => 'America/Rankin_Inlet',
    172 => 'America/Recife',
    173 => 'America/Regina',
    174 => 'America/Resolute',
    175 => 'America/Rio_Branco',
    176 => 'America/Santarem',
    177 => 'America/Santiago',
    178 => 'America/Santo_Domingo',
    179 => 'America/Sao_Paulo',
    180 => 'America/Scoresbysund',
    181 => 'America/Sitka',
    182 => 'America/St_Barthelemy',
    183 => 'America/St_Johns',
    184 => 'America/St_Kitts',
    185 => 'America/St_Lucia',
    186 => 'America/St_Thomas',
    187 => 'America/St_Vincent',
    188 => 'America/Swift_Current',
    189 => 'America/Tegucigalpa',
    190 => 'America/Thule',
    191 => 'America/Thunder_Bay',
    192 => 'America/Tijuana',
    193 => 'America/Toronto',
    194 => 'America/Tortola',
    195 => 'America/Vancouver',
    196 => 'America/Whitehorse',
    197 => 'America/Winnipeg',
    198 => 'America/Yakutat',
    199 => 'America/Yellowknife',
    200 => 'Antarctica/Casey',
    201 => 'Antarctica/Davis',
    202 => 'Antarctica/DumontDUrville',
    203 => 'Antarctica/Macquarie',
    204 => 'Antarctica/Mawson',
    205 => 'Antarctica/McMurdo',
    206 => 'Antarctica/Palmer',
    207 => 'Antarctica/Rothera',
    208 => 'Antarctica/Syowa',
    209 => 'Antarctica/Troll',
    210 => 'Antarctica/Vostok',
    211 => 'Arctic/Longyearbyen',
    212 => 'Asia/Aden',
    213 => 'Asia/Almaty',
    214 => 'Asia/Amman',
    215 => 'Asia/Anadyr',
    216 => 'Asia/Aqtau',
    217 => 'Asia/Aqtobe',
    218 => 'Asia/Ashgabat',
    219 => 'Asia/Atyrau',
    220 => 'Asia/Baghdad',
    221 => 'Asia/Bahrain',
    222 => 'Asia/Baku',
    223 => 'Asia/Bangkok',
    224 => 'Asia/Barnaul',
    225 => 'Asia/Beirut',
    226 => 'Asia/Bishkek',
    227 => 'Asia/Brunei',
    228 => 'Asia/Chita',
    229 => 'Asia/Choibalsan',
    230 => 'Asia/Colombo',
    231 => 'Asia/Damascus',
    232 => 'Asia/Dhaka',
    233 => 'Asia/Dili',
    234 => 'Asia/Dubai',
    235 => 'Asia/Dushanbe',
    236 => 'Asia/Famagusta',
    237 => 'Asia/Gaza',
    238 => 'Asia/Hebron',
    239 => 'Asia/Ho_Chi_Minh',
    240 => 'Asia/Hong_Kong',
    241 => 'Asia/Hovd',
    242 => 'Asia/Irkutsk',
    243 => 'Asia/Jakarta',
    244 => 'Asia/Jayapura',
    245 => 'Asia/Jerusalem',
    246 => 'Asia/Kabul',
    247 => 'Asia/Kamchatka',
    248 => 'Asia/Karachi',
    249 => 'Asia/Kathmandu',
    250 => 'Asia/Khandyga',
    251 => 'Asia/Kolkata',
    252 => 'Asia/Krasnoyarsk',
    253 => 'Asia/Kuala_Lumpur',
    254 => 'Asia/Kuching',
    255 => 'Asia/Kuwait',
    256 => 'Asia/Macau',
    257 => 'Asia/Magadan',
    258 => 'Asia/Makassar',
    259 => 'Asia/Manila',
    260 => 'Asia/Muscat',
    261 => 'Asia/Nicosia',
    262 => 'Asia/Novokuznetsk',
    263 => 'Asia/Novosibirsk',
    264 => 'Asia/Omsk',
    265 => 'Asia/Oral',
    266 => 'Asia/Phnom_Penh',
    267 => 'Asia/Pontianak',
    268 => 'Asia/Pyongyang',
    269 => 'Asia/Qatar',
    270 => 'Asia/Qyzylorda',
    271 => 'Asia/Riyadh',
    272 => 'Asia/Sakhalin',
    273 => 'Asia/Samarkand',
    274 => 'Asia/Seoul',
    275 => 'Asia/Shanghai',
    276 => 'Asia/Singapore',
    277 => 'Asia/Srednekolymsk',
    278 => 'Asia/Taipei',
    279 => 'Asia/Tashkent',
    280 => 'Asia/Tbilisi',
    281 => 'Asia/Tehran',
    282 => 'Asia/Thimphu',
    283 => 'Asia/Tokyo',
    284 => 'Asia/Tomsk',
    285 => 'Asia/Ulaanbaatar',
    286 => 'Asia/Urumqi',
    287 => 'Asia/Ust-Nera',
    288 => 'Asia/Vientiane',
    289 => 'Asia/Vladivostok',
    290 => 'Asia/Yakutsk',
    291 => 'Asia/Yangon',
    292 => 'Asia/Yekaterinburg',
    293 => 'Asia/Yerevan',
    294 => 'Atlantic/Azores',
    295 => 'Atlantic/Bermuda',
    296 => 'Atlantic/Canary',
    297 => 'Atlantic/Cape_Verde',
    298 => 'Atlantic/Faroe',
    299 => 'Atlantic/Madeira',
    300 => 'Atlantic/Reykjavik',
    301 => 'Atlantic/South_Georgia',
    302 => 'Atlantic/St_Helena',
    303 => 'Atlantic/Stanley',
    304 => 'Australia/Adelaide',
    305 => 'Australia/Brisbane',
    306 => 'Australia/Broken_Hill',
    307 => 'Australia/Currie',
    308 => 'Australia/Darwin',
    309 => 'Australia/Eucla',
    310 => 'Australia/Hobart',
    311 => 'Australia/Lindeman',
    312 => 'Australia/Lord_Howe',
    313 => 'Australia/Melbourne',
    314 => 'Australia/Perth',
    315 => 'Australia/Sydney',
    316 => 'Europe/Amsterdam',
    317 => 'Europe/Andorra',
    318 => 'Europe/Astrakhan',
    319 => 'Europe/Athens',
    320 => 'Europe/Belgrade',
    321 => 'Europe/Berlin',
    322 => 'Europe/Bratislava',
    323 => 'Europe/Brussels',
    324 => 'Europe/Bucharest',
    325 => 'Europe/Budapest',
    326 => 'Europe/Busingen',
    327 => 'Europe/Chisinau',
    328 => 'Europe/Copenhagen',
    329 => 'Europe/Dublin',
    320 => 'Europe/Gibraltar',
    331 => 'Europe/Guernsey',
    332 => 'Europe/Helsinki',
    333 => 'Europe/Isle_of_Man',
    334 => 'Europe/Istanbul',
    335 => 'Europe/Jersey',
    336 => 'Europe/Kaliningrad',
    337 => 'Europe/Kiev',
    338 => 'Europe/Kirov',
    339 => 'Europe/Lisbon',
    340 => 'Europe/Ljubljana',
    341 => 'Europe/London',
    342 => 'Europe/Luxembourg',
    343 => 'Europe/Madrid',
    344 => 'Europe/Malta',
    345 => 'Europe/Mariehamn',
    346 => 'Europe/Minsk',
    347 => 'Europe/Monaco',
    348 => 'Europe/Moscow',
    349 => 'Europe/Oslo',
    350 => 'Europe/Paris',
    351 => 'Europe/Podgorica',
    352 => 'Europe/Prague',
    353 => 'Europe/Riga',
    354 => 'Europe/Rome',
    355 => 'Europe/Samara',
    356 => 'Europe/San_Marino',
    357 => 'Europe/Sarajevo',
    358 => 'Europe/Saratov',
    359 => 'Europe/Simferopol',
    360 => 'Europe/Skopje',
    361 => 'Europe/Sofia',
    362 => 'Europe/Stockholm',
    363 => 'Europe/Tallinn',
    364 => 'Europe/Tirane',
    365 => 'Europe/Ulyanovsk',
    366 => 'Europe/Uzhgorod',
    367 => 'Europe/Vaduz',
    368 => 'Europe/Vatican',
    369 => 'Europe/Vienna',
    370 => 'Europe/Vilnius',
    371 => 'Europe/Volgograd',
    372 => 'Europe/Warsaw',
    373 => 'Europe/Zagreb',
    374 => 'Europe/Zaporozhye',
    375 => 'Europe/Zurich',
    376 => 'Indian/Antananarivo',
    377 => 'Indian/Chagos',
    378 => 'Indian/Christmas',
    379 => 'Indian/Cocos',
    380 => 'Indian/Comoro',
    381 => 'Indian/Kerguelen',
    382 => 'Indian/Mahe',
    383 => 'Indian/Maldives',
    384 => 'Indian/Mauritius',
    385 => 'Indian/Mayotte',
    386 => 'Indian/Reunion',
    387 => 'Pacific/Apia',
    388 => 'Pacific/Auckland',
    389 => 'Pacific/Bougainville',
    390 => 'Pacific/Chatham',
    391 => 'Pacific/Chuuk',
    392 => 'Pacific/Easter',
    393 => 'Pacific/Efate',
    394 => 'Pacific/Enderbury',
    395 => 'Pacific/Fakaofo',
    396 => 'Pacific/Fiji',
    397 => 'Pacific/Funafuti',
    398 => 'Pacific/Galapagos',
    399 => 'Pacific/Gambier',
    400 => 'Pacific/Guadalcanal',
    401 => 'Pacific/Guam',
    402 => 'Pacific/Honolulu',
    403 => 'Pacific/Kiritimati',
    404 => 'Pacific/Kosrae',
    405 => 'Pacific/Kwajalein',
    406 => 'Pacific/Majuro',
    407 => 'Pacific/Marquesas',
    408 => 'Pacific/Midway',
    409 => 'Pacific/Nauru',
    410 => 'Pacific/Niue',
    411 => 'Pacific/Norfolk',
    412 => 'Pacific/Noumea',
    413 => 'Pacific/Pago_Pago',
    414 => 'Pacific/Palau',
    415 => 'Pacific/Pitcairn',
    416 => 'Pacific/Pohnpei',
    417 => 'Pacific/Port_Moresby',
    418 => 'Pacific/Rarotonga',
    419 => 'Pacific/Saipan',
    420 => 'Pacific/Tahiti',
    421 => 'Pacific/Tarawa',
    422 => 'Pacific/Tongatapu',
    423 => 'Pacific/Wake',
    424 => 'Pacific/Wallis',
    425 => 'UTC',
));

define("TIME_DIFFERENCE",29);

define("NUMBERPICKER",'number_picker');
define("QUICKPICK",'quick_pick');

define("PLAY_LOTTERIES",1);
define("SYNDICATE",2);
define("MILLINAIRE_RAFFLE",3);
define("LOTTERY_SYNDICATE",4);
define("RAFFLE_SYNDICATE",5);