<?php


class framework_email extends framework_updates {


	public $countrydialingcodes = array(
	
	'AD'=>array('name'=>'ANDORRA','code'=>'376'),
	'AE'=>array('name'=>'UNITED ARAB EMIRATES','code'=>'971'),
	'AF'=>array('name'=>'AFGHANISTAN','code'=>'93'),
	'AG'=>array('name'=>'ANTIGUA AND BARBUDA','code'=>'1268'),
	'AI'=>array('name'=>'ANGUILLA','code'=>'1264'),
	'AL'=>array('name'=>'ALBANIA','code'=>'355'),
	'AM'=>array('name'=>'ARMENIA','code'=>'374'),
	'AN'=>array('name'=>'NETHERLANDS ANTILLES','code'=>'599'),
	'AO'=>array('name'=>'ANGOLA','code'=>'244'),
	'AQ'=>array('name'=>'ANTARCTICA','code'=>'672'),
	'AR'=>array('name'=>'ARGENTINA','code'=>'54'),
	'AS'=>array('name'=>'AMERICAN SAMOA','code'=>'1684'),
	'AT'=>array('name'=>'AUSTRIA','code'=>'43'),
	'AU'=>array('name'=>'AUSTRALIA','code'=>'61'),
	'AW'=>array('name'=>'ARUBA','code'=>'297'),
	'AZ'=>array('name'=>'AZERBAIJAN','code'=>'994'),
	'BA'=>array('name'=>'BOSNIA AND HERZEGOVINA','code'=>'387'),
	'BB'=>array('name'=>'BARBADOS','code'=>'1246'),
	'BD'=>array('name'=>'BANGLADESH','code'=>'880'),
	'BE'=>array('name'=>'BELGIUM','code'=>'32'),
	'BF'=>array('name'=>'BURKINA FASO','code'=>'226'),
	'BG'=>array('name'=>'BULGARIA','code'=>'359'),
	'BH'=>array('name'=>'BAHRAIN','code'=>'973'),
	'BI'=>array('name'=>'BURUNDI','code'=>'257'),
	'BJ'=>array('name'=>'BENIN','code'=>'229'),
	'BL'=>array('name'=>'SAINT BARTHELEMY','code'=>'590'),
	'BM'=>array('name'=>'BERMUDA','code'=>'1441'),
	'BN'=>array('name'=>'BRUNEI DARUSSALAM','code'=>'673'),
	'BO'=>array('name'=>'BOLIVIA','code'=>'591'),
	'BR'=>array('name'=>'BRAZIL','code'=>'55'),
	'BS'=>array('name'=>'BAHAMAS','code'=>'1242'),
	'BT'=>array('name'=>'BHUTAN','code'=>'975'),
	'BW'=>array('name'=>'BOTSWANA','code'=>'267'),
	'BY'=>array('name'=>'BELARUS','code'=>'375'),
	'BZ'=>array('name'=>'BELIZE','code'=>'501'),
	'CA'=>array('name'=>'CANADA','code'=>'1'),
	'CC'=>array('name'=>'COCOS (KEELING) ISLANDS','code'=>'61'),
	'CD'=>array('name'=>'CONGO, THE DEMOCRATIC REPUBLIC OF THE','code'=>'243'),
	'CF'=>array('name'=>'CENTRAL AFRICAN REPUBLIC','code'=>'236'),
	'CG'=>array('name'=>'CONGO','code'=>'242'),
	'CH'=>array('name'=>'SWITZERLAND','code'=>'41'),
	'CI'=>array('name'=>'COTE D IVOIRE','code'=>'225'),
	'CK'=>array('name'=>'COOK ISLANDS','code'=>'682'),
	'CL'=>array('name'=>'CHILE','code'=>'56'),
	'CM'=>array('name'=>'CAMEROON','code'=>'237'),
	'CN'=>array('name'=>'CHINA','code'=>'86'),
	'CO'=>array('name'=>'COLOMBIA','code'=>'57'),
	'CR'=>array('name'=>'COSTA RICA','code'=>'506'),
	'CU'=>array('name'=>'CUBA','code'=>'53'),
	'CV'=>array('name'=>'CAPE VERDE','code'=>'238'),
	'CX'=>array('name'=>'CHRISTMAS ISLAND','code'=>'61'),
	'CY'=>array('name'=>'CYPRUS','code'=>'357'),
	'CZ'=>array('name'=>'CZECH REPUBLIC','code'=>'420'),
	'DE'=>array('name'=>'GERMANY','code'=>'49'),
	'DJ'=>array('name'=>'DJIBOUTI','code'=>'253'),
	'DK'=>array('name'=>'DENMARK','code'=>'45'),
	'DM'=>array('name'=>'DOMINICA','code'=>'1767'),
	'DO'=>array('name'=>'DOMINICAN REPUBLIC','code'=>'1809'),
	'DZ'=>array('name'=>'ALGERIA','code'=>'213'),
	'EC'=>array('name'=>'ECUADOR','code'=>'593'),
	'EE'=>array('name'=>'ESTONIA','code'=>'372'),
	'EG'=>array('name'=>'EGYPT','code'=>'20'),
	'ER'=>array('name'=>'ERITREA','code'=>'291'),
	'ES'=>array('name'=>'SPAIN','code'=>'34'),
	'ET'=>array('name'=>'ETHIOPIA','code'=>'251'),
	'FI'=>array('name'=>'FINLAND','code'=>'358'),
	'FJ'=>array('name'=>'FIJI','code'=>'679'),
	'FK'=>array('name'=>'FALKLAND ISLANDS (MALVINAS)','code'=>'500'),
	'FM'=>array('name'=>'MICRONESIA, FEDERATED STATES OF','code'=>'691'),
	'FO'=>array('name'=>'FAROE ISLANDS','code'=>'298'),
	'FR'=>array('name'=>'FRANCE','code'=>'33'),
	'GA'=>array('name'=>'GABON','code'=>'241'),
	'GB'=>array('name'=>'UNITED KINGDOM','code'=>'44'),
	'GD'=>array('name'=>'GRENADA','code'=>'1473'),
	'GE'=>array('name'=>'GEORGIA','code'=>'995'),
	'GH'=>array('name'=>'GHANA','code'=>'233'),
	'GI'=>array('name'=>'GIBRALTAR','code'=>'350'),
	'GL'=>array('name'=>'GREENLAND','code'=>'299'),
	'GM'=>array('name'=>'GAMBIA','code'=>'220'),
	'GN'=>array('name'=>'GUINEA','code'=>'224'),
	'GQ'=>array('name'=>'EQUATORIAL GUINEA','code'=>'240'),
	'GR'=>array('name'=>'GREECE','code'=>'30'),
	'GT'=>array('name'=>'GUATEMALA','code'=>'502'),
	'GU'=>array('name'=>'GUAM','code'=>'1671'),
	'GW'=>array('name'=>'GUINEA-BISSAU','code'=>'245'),
	'GY'=>array('name'=>'GUYANA','code'=>'592'),
	'HK'=>array('name'=>'HONG KONG','code'=>'852'),
	'HN'=>array('name'=>'HONDURAS','code'=>'504'),
	'HR'=>array('name'=>'CROATIA','code'=>'385'),
	'HT'=>array('name'=>'HAITI','code'=>'509'),
	'HU'=>array('name'=>'HUNGARY','code'=>'36'),
	'ID'=>array('name'=>'INDONESIA','code'=>'62'),
	'IE'=>array('name'=>'IRELAND','code'=>'353'),
	'IL'=>array('name'=>'ISRAEL','code'=>'972'),
	'IM'=>array('name'=>'ISLE OF MAN','code'=>'44'),
	'IN'=>array('name'=>'INDIA','code'=>'91'),
	'IQ'=>array('name'=>'IRAQ','code'=>'964'),
	'IR'=>array('name'=>'IRAN, ISLAMIC REPUBLIC OF','code'=>'98'),
	'IS'=>array('name'=>'ICELAND','code'=>'354'),
	'IT'=>array('name'=>'ITALY','code'=>'39'),
	'JM'=>array('name'=>'JAMAICA','code'=>'1876'),
	'JO'=>array('name'=>'JORDAN','code'=>'962'),
	'JP'=>array('name'=>'JAPAN','code'=>'81'),
	'KE'=>array('name'=>'KENYA','code'=>'254'),
	'KG'=>array('name'=>'KYRGYZSTAN','code'=>'996'),
	'KH'=>array('name'=>'CAMBODIA','code'=>'855'),
	'KI'=>array('name'=>'KIRIBATI','code'=>'686'),
	'KM'=>array('name'=>'COMOROS','code'=>'269'),
	'KN'=>array('name'=>'SAINT KITTS AND NEVIS','code'=>'1869'),
	'KP'=>array('name'=>'KOREA DEMOCRATIC PEOPLES REPUBLIC OF','code'=>'850'),
	'KR'=>array('name'=>'KOREA REPUBLIC OF','code'=>'82'),
	'KW'=>array('name'=>'KUWAIT','code'=>'965'),
	'KY'=>array('name'=>'CAYMAN ISLANDS','code'=>'1345'),
	'KZ'=>array('name'=>'KAZAKSTAN','code'=>'7'),
	'LA'=>array('name'=>'LAO PEOPLES DEMOCRATIC REPUBLIC','code'=>'856'),
	'LB'=>array('name'=>'LEBANON','code'=>'961'),
	'LC'=>array('name'=>'SAINT LUCIA','code'=>'1758'),
	'LI'=>array('name'=>'LIECHTENSTEIN','code'=>'423'),
	'LK'=>array('name'=>'SRI LANKA','code'=>'94'),
	'LR'=>array('name'=>'LIBERIA','code'=>'231'),
	'LS'=>array('name'=>'LESOTHO','code'=>'266'),
	'LT'=>array('name'=>'LITHUANIA','code'=>'370'),
	'LU'=>array('name'=>'LUXEMBOURG','code'=>'352'),
	'LV'=>array('name'=>'LATVIA','code'=>'371'),
	'LY'=>array('name'=>'LIBYAN ARAB JAMAHIRIYA','code'=>'218'),
	'MA'=>array('name'=>'MOROCCO','code'=>'212'),
	'MC'=>array('name'=>'MONACO','code'=>'377'),
	'MD'=>array('name'=>'MOLDOVA, REPUBLIC OF','code'=>'373'),
	'ME'=>array('name'=>'MONTENEGRO','code'=>'382'),
	'MF'=>array('name'=>'SAINT MARTIN','code'=>'1599'),
	'MG'=>array('name'=>'MADAGASCAR','code'=>'261'),
	'MH'=>array('name'=>'MARSHALL ISLANDS','code'=>'692'),
	'MK'=>array('name'=>'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF','code'=>'389'),
	'ML'=>array('name'=>'MALI','code'=>'223'),
	'MM'=>array('name'=>'MYANMAR','code'=>'95'),
	'MN'=>array('name'=>'MONGOLIA','code'=>'976'),
	'MO'=>array('name'=>'MACAU','code'=>'853'),
	'MP'=>array('name'=>'NORTHERN MARIANA ISLANDS','code'=>'1670'),
	'MR'=>array('name'=>'MAURITANIA','code'=>'222'),
	'MS'=>array('name'=>'MONTSERRAT','code'=>'1664'),
	'MT'=>array('name'=>'MALTA','code'=>'356'),
	'MU'=>array('name'=>'MAURITIUS','code'=>'230'),
	'MV'=>array('name'=>'MALDIVES','code'=>'960'),
	'MW'=>array('name'=>'MALAWI','code'=>'265'),
	'MX'=>array('name'=>'MEXICO','code'=>'52'),
	'MY'=>array('name'=>'MALAYSIA','code'=>'60'),
	'MZ'=>array('name'=>'MOZAMBIQUE','code'=>'258'),
	'NA'=>array('name'=>'NAMIBIA','code'=>'264'),
	'NC'=>array('name'=>'NEW CALEDONIA','code'=>'687'),
	'NE'=>array('name'=>'NIGER','code'=>'227'),
	'NG'=>array('name'=>'NIGERIA','code'=>'234'),
	'NI'=>array('name'=>'NICARAGUA','code'=>'505'),
	'NL'=>array('name'=>'NETHERLANDS','code'=>'31'),
	'NO'=>array('name'=>'NORWAY','code'=>'47'),
	'NP'=>array('name'=>'NEPAL','code'=>'977'),
	'NR'=>array('name'=>'NAURU','code'=>'674'),
	'NU'=>array('name'=>'NIUE','code'=>'683'),
	'NZ'=>array('name'=>'NEW ZEALAND','code'=>'64'),
	'OM'=>array('name'=>'OMAN','code'=>'968'),
	'PA'=>array('name'=>'PANAMA','code'=>'507'),
	'PE'=>array('name'=>'PERU','code'=>'51'),
	'PF'=>array('name'=>'FRENCH POLYNESIA','code'=>'689'),
	'PG'=>array('name'=>'PAPUA NEW GUINEA','code'=>'675'),
	'PH'=>array('name'=>'PHILIPPINES','code'=>'63'),
	'PK'=>array('name'=>'PAKISTAN','code'=>'92'),
	'PL'=>array('name'=>'POLAND','code'=>'48'),
	'PM'=>array('name'=>'SAINT PIERRE AND MIQUELON','code'=>'508'),
	'PN'=>array('name'=>'PITCAIRN','code'=>'870'),
	'PR'=>array('name'=>'PUERTO RICO','code'=>'1'),
	'PT'=>array('name'=>'PORTUGAL','code'=>'351'),
	'PW'=>array('name'=>'PALAU','code'=>'680'),
	'PY'=>array('name'=>'PARAGUAY','code'=>'595'),
	'QA'=>array('name'=>'QATAR','code'=>'974'),
	'RO'=>array('name'=>'ROMANIA','code'=>'40'),
	'RS'=>array('name'=>'SERBIA','code'=>'381'),
	'RU'=>array('name'=>'RUSSIAN FEDERATION','code'=>'7'),
	'RW'=>array('name'=>'RWANDA','code'=>'250'),
	'SA'=>array('name'=>'SAUDI ARABIA','code'=>'966'),
	'SB'=>array('name'=>'SOLOMON ISLANDS','code'=>'677'),
	'SC'=>array('name'=>'SEYCHELLES','code'=>'248'),
	'SD'=>array('name'=>'SUDAN','code'=>'249'),
	'SE'=>array('name'=>'SWEDEN','code'=>'46'),
	'SG'=>array('name'=>'SINGAPORE','code'=>'65'),
	'SH'=>array('name'=>'SAINT HELENA','code'=>'290'),
	'SI'=>array('name'=>'SLOVENIA','code'=>'386'),
	'SK'=>array('name'=>'SLOVAKIA','code'=>'421'),
	'SL'=>array('name'=>'SIERRA LEONE','code'=>'232'),
	'SM'=>array('name'=>'SAN MARINO','code'=>'378'),
	'SN'=>array('name'=>'SENEGAL','code'=>'221'),
	'SO'=>array('name'=>'SOMALIA','code'=>'252'),
	'SR'=>array('name'=>'SURINAME','code'=>'597'),
	'ST'=>array('name'=>'SAO TOME AND PRINCIPE','code'=>'239'),
	'SV'=>array('name'=>'EL SALVADOR','code'=>'503'),
	'SY'=>array('name'=>'SYRIAN ARAB REPUBLIC','code'=>'963'),
	'SZ'=>array('name'=>'SWAZILAND','code'=>'268'),
	'TC'=>array('name'=>'TURKS AND CAICOS ISLANDS','code'=>'1649'),
	'TD'=>array('name'=>'CHAD','code'=>'235'),
	'TG'=>array('name'=>'TOGO','code'=>'228'),
	'TH'=>array('name'=>'THAILAND','code'=>'66'),
	'TJ'=>array('name'=>'TAJIKISTAN','code'=>'992'),
	'TK'=>array('name'=>'TOKELAU','code'=>'690'),
	'TL'=>array('name'=>'TIMOR-LESTE','code'=>'670'),
	'TM'=>array('name'=>'TURKMENISTAN','code'=>'993'),
	'TN'=>array('name'=>'TUNISIA','code'=>'216'),
	'TO'=>array('name'=>'TONGA','code'=>'676'),
	'TR'=>array('name'=>'TURKEY','code'=>'90'),
	'TT'=>array('name'=>'TRINIDAD AND TOBAGO','code'=>'1868'),
	'TV'=>array('name'=>'TUVALU','code'=>'688'),
	'TW'=>array('name'=>'TAIWAN, PROVINCE OF CHINA','code'=>'886'),
	'TZ'=>array('name'=>'TANZANIA, UNITED REPUBLIC OF','code'=>'255'),
	'UA'=>array('name'=>'UKRAINE','code'=>'380'),
	'UG'=>array('name'=>'UGANDA','code'=>'256'),
	'US'=>array('name'=>'UNITED STATES','code'=>'1'),
	'UY'=>array('name'=>'URUGUAY','code'=>'598'),
	'UZ'=>array('name'=>'UZBEKISTAN','code'=>'998'),
	'VA'=>array('name'=>'HOLY SEE (VATICAN CITY STATE)','code'=>'39'),
	'VC'=>array('name'=>'SAINT VINCENT AND THE GRENADINES','code'=>'1784'),
	'VE'=>array('name'=>'VENEZUELA','code'=>'58'),
	'VG'=>array('name'=>'VIRGIN ISLANDS, BRITISH','code'=>'1284'),
	'VI'=>array('name'=>'VIRGIN ISLANDS, U.S.','code'=>'1340'),
	'VN'=>array('name'=>'VIET NAM','code'=>'84'),
	'VU'=>array('name'=>'VANUATU','code'=>'678'),
	'WF'=>array('name'=>'WALLIS AND FUTUNA','code'=>'681'),
	'WS'=>array('name'=>'SAMOA','code'=>'685'),
	'XK'=>array('name'=>'KOSOVO','code'=>'381'),
	'YE'=>array('name'=>'YEMEN','code'=>'967'),
	'YT'=>array('name'=>'MAYOTTE','code'=>'262'),
	'ZA'=>array('name'=>'SOUTH AFRICA','code'=>'27'),
	'ZM'=>array('name'=>'ZAMBIA','code'=>'260'),
	'ZW'=>array('name'=>'ZIMBABWE','code'=>'263')
);

	public $wlt_emails_alerts = array( // OLD WILL REMOVE SOON
	
		"wlt_alert_new_order" 		=> array("n" => "New Order"),
		"wlt_alert_login_success" 	=> array("n" => "User Login {success}"),
		"wlt_alert_login_failed" 	=> array("n" => "User Login {failed}"),
		"wlt_alert_register" 		=> array("n" => "User Register"),
		"wlt_alert_listing_new" 	=> array("n" => "Listing {new}"),
		"wlt_alert_listing_edit" 	=> array("n" => "Listing {edit}"),
		
	);
	
public $wlt_email_array = array(



"n99" => array('break' => 'Basic System Emails'),
 

	"welcome" => array(
		'name' => 'Welcome Email',  
		'shortcodes' => array( 'username' => 'username', 'first_name' => 'first_name', 'last_name' => 'last_name', 'user_email' => 'user_email'), 
		'desc' => 'This email is sent when they register and join your website.',
		'default_subject' => 'Welcome to our website.',
		'default_body' => 'Dear User<br><br>Thank you for joining our website.<br><br>Your login details are: <br><br>&nbsp;&nbsp;&nbsp;Email: (user_email) <br>&nbsp;&nbsp;&nbsp;Password: (password)
		<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'Welcome to our website.',
	),
 
	
	"listingcontactform" => array(
		'name' 	=> 'Listing Contact Form',   
		'label'	=>	'label-success', 
		'desc' 	=> 'This email is sent to the listing author when someone uses the listing page contact form.',
		'shortcodes' => array('name' => 'name', 'email' => 'email', 'phone' => 'phone', 'link' => 'link', 'message' => 'message'), 
		
		'default_subject' => "You've received a new message!",
		'default_body' => 'Dear User<br><br>You have received a new message from (name)<br><br>(message) (phone)<br><br> (link)<br><br>Please login to view the message in full.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'Thank you for logging in.',
	),
	
	"login" => array(
		'name' => 'User Login',		 
		'desc' => 'This email is sent when the user logins into your website.',
		'shortcodes' => array( 'username' => 'username'),		
		'default_subject' => 'Thank you',
		'default_body' => 'Dear User<br><br>Thank you for logging into our website.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'Thank you for logging in.',
		
	),

	"msg_new" => array(
		'name' => 'New Message Received',		 
		'desc' => 'This email is sent to the user when they receieve a new message via the built-in message system.',
		'shortcodes' => array('to username' => 'username','from username' => 'from_username','subject' => 'subject','message' => 'message'),
		
		'default_subject' 	=> 'New Message Received',
		'default_body' 		=> 'Dear User<br><br>You have received a new private message from (from_username).<br>Please login to our website;(website)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'You have received a new private message.',
		
	),





"n0" => array('break' => 'Listing Emails'),

	"newlisting" => array(
	
		'name' 				=> 'New Listing Added',
		'desc' 				=> 'This email is sent to the user after they create a new listing.',
		
		'default_subject' 	=> 'New Listing Added',
		'default_body' 		=> 'Dear User<br><br>Your new listing has been created.<br>Listing details;<br><br>Title: (title)<br>Link:(link)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Thank you for adding a new listing.',
		
		'shortcodes' 		=> array('title' => 'title','link' => 'link','date' => 'post_date'),
		
	),

	"expired" => array(
	
		'name' 			=> 'Listing Expired',
		'desc' 			=> 'These emails are sent to the user when their listings are due to expire.',
		
		'shortcodes' 	=> array('title' => 'title','link' => 'link','date' => 'post_date','expired' => 'expired'),		 
		
		'default_subject' 	=> 'Listing Expired',
		'default_body' 		=> 'Dear User<br><br>Your listing has expired, please login to renew it.<br>Listing details;<br><br>Title: (title)<br>Link:(link)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Your listing has expired.',
		
		
	),

	"reminder_30" => array(
		'name' 		=> '30 day renewal reminder', 
		'desc' 		=> 'This email is sent to the user when their listing is due to expire within 30 days.',
		
		'shortcodes' => array('title' => 'title','link' => 'link','date' => 'post_date','expired' => 'expired'),
		
		'default_subject' 	=> '30 Day Reminder',
		'default_body' 		=> 'Dear User<br><br>Your listing is due to expire within the next 30 days.<br>Listing details;<br><br>Title: (title)<br>Link:(link)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Your listing is due to expire within 30 days.',
	),
	
	
	"reminder_15" => array(
	
		'name' 	=> '15 day renewal reminder',   
		'desc' 	=> 'This email is sent to the user when their listing is due to expire within 15 days.',
		
		'shortcodes' => array('title' => 'title','link' => 'link','date' => 'post_date','expired' => 'expired'),
	
		'default_subject' 	=> '15 Day Reminder',
		'default_body' 		=> 'Dear User<br><br>Your listing is due to expire within the next 30 days.<br>Listing details;<br><br>Title: (title)<br>Link:(link)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Your listing is due to expire within 15 days.',
	
	),
	
	"reminder_1" => array(
	
		'name' => '1 day renewal reminder',   		
		'desc' => 'This email is sent to listing owners when their listing is due to expire within 1 day.',
		
		'default_subject' => '24 Hour Notice - Your listing will expire soon.',
		'default_body' => 'Dear User<br><br>Your listing is due to expire within 24 hours.<br><br>Details;<br><br>Listing: (title) <br>Expiry: (post_date)<br><br><br>Kind Regards<br>Management.<a href="(url)">(website)</a>',
		'default_sms' => '24 Hour Notice - Your listing (title) will expire soon.',	
		
		'shortcodes' => array('title' => 'title','link' => 'link','date' => 'post_date','expired' => 'expired'),
	),
	

"n2" => array('break' => 'Membership Emails'),

	"mem_expired" => array(
	
		'name' => 'Membership Expired',
		'desc' => 'These emails are sent to the user when their membership is due to expire.',		
		
		'shortcodes' => array('expired' => 'expired'),
		
		'default_subject' 	=> 'Membership Expired',
		'default_body' 		=> 'Dear User<br><br>Your membership has expired.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Dear User, Your membership has expired',
		
	),

	"mem_reminder_30" => array(
	
		'name' => '30 day reminder',
		'desc' => 'This email is sent to the user when their membership is due to expire within 30 days.',	
		
		'shortcodes' => array('expired' => 'expired'),

		'default_subject' 	=> '30 Day Reminder',
		'default_body' 		=> 'Dear User<br><br>Your membership is due to expire within 30 days.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Dear User, Your membership has expired',

	),
	"mem_reminder_15" => array(


		'name' => '15 day reminder',
		'desc' => 'This email is sent to the user when their membership is due to expire within 15 days.',	
		
		'shortcodes' => array('expired' => 'expired'),

		'default_subject' 	=> '15 Day Reminder',
		'default_body' 		=> 'Dear User<br><br>Your membership is due to expire within 15 days.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Dear User, Your membership has expired',
		
	),
	
	"mem_reminder_1" => array(
	
		'name' => '1 day reminder',
		'desc' => 'This email is sent to the user when their membership is due to expire within 24 hours.',	
		
		'shortcodes' => array('expired' => 'expired'),

		'default_subject' 	=> '1 Day Reminder',
		'default_body' 		=> 'Dear User<br><br>Your membership is due to expire within 24 hours.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Dear User, Your membership has expired',
	),
	
 
 

"n5" => array('break' => 'Order Emails'),
 	
	"order_new_sccuess" => array(
	
		'name' => 'New Successful Order',
		'desc' => 'This email is sent to the user when a new order is placed.',
		 
		'default_subject' 	=> 'New Order Received',
		'default_body' 		=> 'Dear User<br><br>Thank you for your order, we will process it and get back to you ASAP.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' 		=> 'Thank you for your order. We are processing it and will get back to you asap.',
		
		'shortcodes' => array('description', 'order_id', 'order_email', 'username'),
		
	),



"n3" => array('break' => 'Admin Emails'),

	"admin_welcome" => array(
	
		'name' => 'User Registration', 
		'desc' => 'This email is sent to the admin when a new user joins your website.',
	 
		'default_subject' => 'New User Signup',
		'default_body' => 'Dear Admin<br><br>A new user has just joined your website.<br><br>User details are: <br><br>&nbsp;&nbsp;&nbsp;Email: (user_email) <br>&nbsp;&nbsp;&nbsp;Username: (username)
		<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'New user signup.',	
	
		'shortcodes' => array('username', 'email', 'password' ),
	),
	
	
	"admin_newlisting" => array(
	
		'name' => 'New Listing',  
		'desc' => 'This email is sent to the admin when a new listing is added.',
	 
		'default_subject' => 'New Listing Added',
		'default_body' => 'Dear Admin<br><br>A new listing has been added to your website;<br><br>Listing details;<br><br>Title: (item_title)<br>Link:(item_link)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'New  listing has been added to your website.',
			
		'shortcodes' => array('item_title' => 'title', 'item_link' => 'link', 'username', 'date'),
	
	),
	
	
	"admin_editlisting" => array(
	
		'name' => 'Edit Listing',  
		'desc' => 'This email is sent to the admin when a listing is edited by the user.',
	 
		'default_subject' => 'New Listing Added',
		'default_body' => 'Dear Admin<br><br>A listing on your website has been edited;<br><br>Listing details;<br><br>Title: (item_title)<br>Link:(item_link)<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'New  listing has been added to your website.',
			
		'shortcodes' => array('item_title' => 'title', 'item_link' => 'link', 'username', 'date'),
	
	),
	
	//"admin_newclaim" => array('name' => 'New Listing Claim',  'shortcodes' => array('title' => 'title','link' => 'link','date' => 'post_date'), 'label'=>'label-warning'),
	
	"admin_order_new" => array(
	
		'name' => 'New Order Received',  
		'desc' => 'This email is sent to the admin when a new order is received.',
	 
		'default_subject' => 'New Order Received',
		'default_body' => 'Dear Admin<br><br>You have receieved a new order.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'New Order Received',
		
		'shortcodes' => array('description', 'order_id', 'order_email', 'username'),
	
	),
	
	/*
	"order_new_failed" => array(
	
		'name' => 'Failed Order Received',  
		'desc' => 'This email is sent to the admin when a new order is received but payment was not successful.',
	 
		'default_subject' => 'Failed Order Received',
		'default_body' => 'Dear Admin<br><br>You have receieved a new order but payment was not successful.<br><br>Kind Regards<br>Management.<br><br><a href="(url)">(website)</a>',
		'default_sms' => 'Failed Order Recieved.',
		
		'shortcodes' => array('description', 'order_id', 'order_email', 'username'),
	
	),
	*/
	
	
	

/*
"n6" => array('break' => '<i class="fal fa-calendar" aria-hidden="true"></i> Event Emails'),

 	"event_5days" => array(
		'name' => 'Event (5 day notice)',
		'shortcodes' => array('price' => 'Event Price', 'location' => 'Event  Location', 'date' => 'Event Date', 'name' => 'Event Name', 'link' => 'Event Link' ),
		'label'=>'label-info'
	),
		
	"event_1day" => array(
		'name' => 'Event (1 day notice)',
		'shortcodes' => array('username' => 'username'),
		'label'=>'label-info'
	),

*/


"n7" => array('break' => 'Feedback System Email'),

	"newfeedback" => array(
		'name' => 'New Feedback Added',
		'shortcodes' => array('title' => 'title','link' => 'link','date' => 'post_date'),
		'label'=>'label-success',
		'desc' => 'This email is sent to members who recieve new feedback.'
	),

	 
);

function email_list(){
	
	$default_email_array = $this->wlt_email_array;
	
	if(defined('WLT_SHOP')){
	unset($default_email_array['n0']);
	unset($default_email_array['newlisting']);
	unset($default_email_array['subscription_email']);
	unset($default_email_array['n1']);
	unset($default_email_array['reminder_30']);
	unset($default_email_array['reminder_15']);
	unset($default_email_array['reminder_1']);
	unset($default_email_array['expired']);
	unset($default_email_array['n2']);
	unset($default_email_array['mem_reminder_30']);
	unset($default_email_array['mem_reminder_15']);
	unset($default_email_array['mem_reminder_1']);
	unset($default_email_array['mem_expired']);
	unset($default_email_array['n4']);
	unset($default_email_array['msg_new']);
	unset($default_email_array['admin_editlisting']);
	unset($default_email_array['admin_newlisting']);
	unset($default_email_array['contact']);
	}
	
	 
	return hook_email_list_filter($default_email_array);
	
}
	
	
	
/*
	this function sends daily emails to users
	if any are required
*/	
function cron_emails(){ global $wpdb, $CORE;

	if(is_numeric(_ppt(array('emails','event_5days'))) != ""){
	
		// CHECK EVENTS
		/*
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND mt2.meta_key = 'date' AND mt2.meta_value LIKE '%".date("Y-m-d", strtotime( "+5 days") )."%'  ) 
			WHERE ".$wpdb->prefix."posts.post_type = 'event' 
			AND ".$wpdb->prefix."posts.post_status = 'publish'
			LIMIT 50";
		
		$result = $wpdb->get_results($SQL);
		if(!empty($result)){
			foreach($result as $r){
			
			$data = array(			
			"name" => get_the_title($r->ID),
			"link" => get_permalink($r->ID),
			"date" => get_post_meta($r->ID,"date", true),
			"price" => get_post_meta($r->ID,"price", true),
			"location" => get_post_meta($r->ID,"location", true),
			 
			); 
		
			$this->email_system("allusers", 'event_5days', $data);
			
			}// end foreach
		} // end if empty
		
		*/
		
	} // END EMAIL
	
	
	
	if(is_numeric(_ppt(array('emails','event_1day'))) != ""){
	
		// CHECK EVENTS
		// 
		$SQL = "SELECT * FROM ".$wpdb->prefix."posts 
			INNER JOIN ".$wpdb->prefix."postmeta AS mt2 ON (".$wpdb->prefix."posts.ID = mt2.post_id AND mt2.meta_key = 'date' AND mt2.meta_value LIKE '%".date("Y-m-d" )."%'  ) 
			WHERE ".$wpdb->prefix."posts.post_type = 'event' 
			AND ".$wpdb->prefix."posts.post_status = 'publish'
			LIMIT 50";
		
		$result = $wpdb->get_results($SQL);
		if(!empty($result)){
			foreach($result as $r){
			
			$data = array(			
			"name" => get_the_title($r->ID),
			"link" => get_permalink($r->ID),
			"date" => get_post_meta($r->ID,"date", true),
			"price" => get_post_meta($r->ID,"price", true),
			"location" => get_post_meta($r->ID,"location", true),
			 
			); 
		
			$this->email_system("allusers", 'event_1day', $data);
			
			}// end foreach
		} // end if empty
		
	} // END EMAIL
	
	
	
 
	

}
	
	
	
function returnhtml(){ return "text/html"; }
	
	

/*
	this function sends the email
*/
function email_send($email, $subject, $message, $headers = array() ){ global $CORE;

 	// ADD ON EXTRA HEADERS
	$headers[] = "Content-Type: text/html; charset=\"" .get_option('blog_charset') . "\"\n"; 
 	
	// EMAIL FILTERS		 
	add_filter('wp_mail_content_type', array($this, 'returnhtml') );	
	apply_filters( 'wp_mail_content_type', "text/html" );
	
	// CHECK FOR EMAIL HEADER/FOOTERS	
	$finalMessage = stripslashes(get_option('ppt_email_header')).$message.stripslashes(get_option('ppt_email_footer'));
	 
	
	if(_ppt('wordpress_autopdisable') == 1){	
		
		// SEND MESSAGE	
		wp_mail($email, stripslashes($subject), "<html><body>".stripslashes($finalMessage)."</body></html>", $headers); 
	
	}else{
		
		$finalMessage = str_replace("<p>","<p style='margin-bottom:15px;'>", stripslashes(wpautop($finalMessage)));
		 
		// SEND MESSAGE	
		wp_mail($email, stripslashes($subject), "<html><body>".$finalMessage."</body></html>", $headers); 	
	}
 
	// ADD LOG
	$CORE->ADDLOG("Email Sent!", "", "", $subject." / ".$email, "email", $subject ." <br><br>".$finalMessage );
	 
	
}

/*
	this function gets all of the user emails
*/
function email_get_all_user_emails(){ global $wpdb; $STRING = "";


		$SQL = "SELECT DISTINCT user_email FROM ".$wpdb->prefix."users";		 	
		$result = $wpdb->get_results($SQL);
		if(!empty($result)){
		 
			foreach($result as $e){
			$STRING .= $e->user_email.",";
			}		
		}
 
	return substr($STRING,0,-1);
}
 
/*
	this function sets up emails from the built-in
	email templates
*/
function SENDEMAIL($userid = "", $emailid, $data = ""){$this->email_system($userid, $emailid, $data); }

function email_custom($userid = "", $subject, $message){ global $CORE; $headers = array();

		// GET USER EMAIL FROM THEIR ID
		if($userid == "admin"){		
			$user_email = get_option('admin_email');
		}elseif($userid == "allusers"){		
			$user_email = $this->email_get_all_user_emails();
		}elseif(is_numeric($userid)){
			$user_email = get_the_author_meta( 'user_email', $userid );
		}else{
			$user_email = $userid;
		}
			 
		// VALIDATE FOR NO EMAIL SET
		if($user_email == ""){	
			
			$CORE->ADDLOG("Email Error", $userid, "", "error", "email", $emailid );			 
			return;			
		}	
		
		// CLEAN EMAIL WITH SHORTCODES
		$subject = $this->email_message_filter($subject, array());
		$message = $this->email_message_filter($message, array());
			
		// DEFAULT MESSAGE HEADERS
		if(isset($_POST['contact_e1']) && $_POST['contact_n1'] != ""){	
			$headers[] = 'From: '.esc_html($_POST['contact_n1']).' <'.$_POST['contact_e1'].'>';			
		}elseif(isset($wlt_emails[$emailid]['from_name']) && strlen($wlt_emails[$emailid]['from_name']) > 2){ 
			$headers[] = 'From: '.$wlt_emails[$emailid]['from_name'].' <'.$wlt_emails[$emailid]['from_email'].'>';
		}else{ 
			$headers[] = 'From: '.get_option('emailfrom').' <'.get_option('admin_email').'>';
		}
		
		// CHECK FOR BBC HEADERS
		if(isset($wlt_emails[$emailid]['bcc_name']) && strlen($wlt_emails[$emailid]['bcc_name']) > 1){ 
			$headers[] .= 'Bcc: '.$bbc_name.' <'.$wlt_emails[$emailid]['bcc_email'].'>';
		}
  		
		// SEND EMAIL
		$this->email_send($user_email, stripslashes($subject), $message, $headers);
 
}

function email_system($userid = "", $emailid, $data = array() ){ global $CORE; $headers = array(); $default_email_array = $CORE->email_list();

 	// CHECK WE HAVE ASSIGNED AN EMAIL TO THIS
	/// EMAIL ID OTHERWISE LOG NO EMAIL
	
	// GET EMAIL DATA
	$all_emails = _ppt('emails'); 
	  
	// CHECK WE HAVE AN EMAIL SETUP
	if( isset($all_emails[$emailid]) ){ 
	
		// CHECK ITS ENABLED
		if(!isset($all_emails[$emailid]['enable']) || ( isset($all_emails[$emailid]['enable']) && $all_emails[$emailid]['enable'] != 1) ){ return; }
	
		// GET USER EMAIL FROM THEIR ID
		if($userid == "admin"){		
			$user_email = get_option('admin_email');
		}elseif($userid == "allusers"){		
			$user_email = $this->email_get_all_user_emails();
		}elseif(is_numeric($userid)){
			$user_email = get_the_author_meta( 'user_email', $userid );
		}else{
			$user_email = $userid;
		}
			 
		// VALIDATE FOR NO EMAIL SET
		if($user_email == ""){			
			$CORE->ADDLOG("Email Error", $userid, "", "error", "email", $emailid );	
			return;			
		}			
	
		// GET THE EMAIL CONTENT
		$subject = $this->email_message_filter($all_emails[$emailid]['subject'], $data);
		$message = $this->email_message_filter($all_emails[$emailid]['body'], $data);
		
		// IF BLANK GET DEFAULT EMAIL CONTENT
		if($subject == "" && isset($default_email_array[$emailid]['default_subject']) ){
		$subject = $default_email_array[$emailid]['default_subject'];
		}
		
		if($message == "" && isset($default_email_array[$emailid]['default_body']) ){
		$message = $default_email_array[$emailid]['default_body'];
		}
		 
 	
		// DEFAULT MESSAGE HEADERS
		if(isset($_POST['contact_e1']) && $_POST['contact_n1'] != ""){	
			$headers[] = 'From: '.esc_html($_POST['contact_n1']).' <'.$_POST['contact_e1'].'>';					
			$headers[] = 'Reply-To: '.esc_html($_POST['contact_n1']).' <'.$_POST['contact_e1'].'>';
		}elseif(isset($wlt_emails[$emailid]['from_name']) && strlen($wlt_emails[$emailid]['from_name']) > 2){ 
			$headers[] = 'From: '.$wlt_emails[$emailid]['from_name'].' <'.$wlt_emails[$emailid]['from_email'].'>';
		}else{ 
			$headers[] = 'From: '.get_option('emailfrom').' <'.get_option('admin_email').'>';
		}
		
		// CHECK FOR BBC HEADERS
		if(isset($wlt_emails[$emailid]['bcc_name']) && strlen($wlt_emails[$emailid]['bcc_name']) > 1){ 
			$headers[] .= 'Bcc: '.$bbc_name.' <'.$wlt_emails[$emailid]['bcc_email'].'>';
		}
 		
		// SEND EMAIL
		$this->email_send($user_email, stripslashes($subject), $message, $headers);		
		
		// SEND SMS ALERT		
		$this->SENDEMAILALERT($userid, $emailid, $data); 
		
	
	// NO EMAIL SET
	}else{
	
		$CORE->ADDLOG("Email Error", $userid, "", "error", "email", $emailid );		
		return;	
	}
 
}
/*
	this function replaces tags in emails with
	anyting thats available within the system
*/
function email_message_filter($message, $data){ global $userdata;
	
	$extra_shortcodes = array();
	
	if(is_array($data)){
		foreach($data as $key => $val){
			$message = str_replace("(".$key.")",$val, $message);
		}	
	}
	 
	
	// USERNAME
	if(isset($_POST['user_login'])){
	
	$message = str_replace("(username)", $_POST['user_login'], $message);	 
	$message = str_replace("(Username)", $_POST['user_login'], $message);
	
	}elseif(isset($_POST['username'])){
	
	$message = str_replace("(username)", $_POST['username'], $message);	 
	$message = str_replace("(Username)", $_POST['username'], $message);	
	
	}elseif( isset($userdata->display_name) ){
	
	$message = str_replace("(Username)", $userdata->display_name, $message);
	$message = str_replace("(username)", $userdata->display_name, $message);
	 
	}	
	
	// FIRST NAME
	if(isset($_POST['first_name'])){
	$message = str_replace("(first_name)", $_POST['first_name'], $message);	 
	}elseif(isset($userdata->first_name)){
	$message = str_replace("(first_name)", $userdata->first_name, $message);	 
	}
	
	// LAST NAME
	if(isset($_POST['last_name'])){
	$message = str_replace("(last_name)", $_POST['last_name'], $message);	 
	}elseif(isset($userdata->last_name)){
	$_POST['lastname'] 		= $userdata->last_name;
	}
	
	// USER EMAIL
	if(isset($_POST['user_email'])){	
	$message = str_replace("(user_email)", $_POST['user_email'], $message);		 
	}elseif(isset($userdata->user_email) ){	
	$message = str_replace("(user_email)", $userdata->user_email, $message);	 
	}	 
	
	// DISPLAY NAME
	if(isset($userdata->display_name)){
	$_POST['displayname'] 		= $userdata->display_name;
	}
	
	// NAME
	if(isset($_POST['contact_n1'])){
	$message = str_replace("(name)", $_POST['contact_n1'], $message);	
	}
	
	// REGISTERED DATE
	if(!isset($_POST['user_registered']) && isset($userdata->user_registered) ){
	$_POST['user_registered'] 	= hook_date($userdata->user_registered);
	}else{
	$_POST['user_registered'] 	= hook_date(date('Y-m-d'));
	}
	if(!isset($_POST['link'])){
	$extra_shortcodes['link'] 		= get_bloginfo('url'); 
	}
	// ADD IN ADDITONAL SHORTCODES 
	$extra_shortcodes['blog_name'] 	= get_bloginfo('name');	
	$extra_shortcodes['date'] 		= hook_date(date('Y-m-d')); 
	$extra_shortcodes['time'] 		= date('h:i:s A');
	$extra_shortcodes['url'] 		= get_bloginfo('url');
 	$extra_shortcodes['website'] 	= get_bloginfo('name');	
 
	// PERFORM STRING REPLACE ON ENTIRE MESSAGE CONTENT	
	if(is_array($_POST)){
		foreach($_POST as $key=>$value){
			if(is_array($value)){
				foreach($value as $key1=>$val1){
					if(is_array($val1)){
					
					}else{
					$message = str_replace("(".$key1.")",$val1,$message);
					}// end if
				} // end foreach			
			}else{
			if(!is_object($value)){
			$message = str_replace("(".$key.")",$value,$message);
			}
			}		 
		}// end foreach
	}// end if
	
	// CHECK EXTRA SHORTCODES
	foreach($extra_shortcodes as $key=>$val){
	$message = str_replace("(".$key.")",$val,$message);
	}
	
	// CLEAN UPDATE EMPTY TAGS
	if(is_admin()){
	$message = preg_replace("/\([^)]+\)/", '******', $message);
	}else{
	$message = preg_replace("/\([^)]+\)/", '', $message);
	}	

return $message;
}
 
 
	
	
	
	
	
	
	


	
 	// EMAIL FROM
	function _fromname($email){
		return get_option('emailfrom');
	}
	function _fromemail($email){
		$admin_email = get_option('admin_email');
		if($admin_email == ""){
			return $email;
		}else{
			return $admin_email;
		}		
	}
	
	// DEBUG EMAIL OPTION
	function debug_wpmail($query){
	if(defined('WLT_DEBUG_EMAIL')){
		echo "<div style='background:#fafafa; border:1px solid #ddd; padding:15px;'>";
		foreach($query as $k=>$p){
			if(is_array($p)){
			print_r($p);
			}else{
			echo $k.": ".$p."<br />";
			}
		}
		echo "</div>";
		die();
	}
	return $query;
	} 


function SENDSMS_ACTIVATION($num){
	
	$from 	= _ppt('wlt_nexmo_from');
	$msg 	= "SMS CODE ".date('ymd')."";

	$url = "https://rest.nexmo.com/sms/json?api_key="._ppt('wlt_nexmo_api').
						"&api_secret="._ppt('wlt_nexmo_se').
						"&from=".$from .
						"&to=".$num .
						"&text=".urlencode(stripslashes($msg))."&type=unicode"; 
 
	$response = wp_remote_post( $url );	
	if ( is_wp_error( $response ) ) {	
		$error_message = $response->get_error_message();	
		$ERROR = "Something went wrong: $error_message";	
	}else{	
		$ERROR =  "ok";
	}	
	
	// SEND ADMIN A COPY
	if(_ppt('wlt_nexmo_admincopy') == 1){
		$msg." - admincopy";
		//$this->SENDSMS_ADMIN($msg);	
	}	
	return $ERROR;
	
}
function SENDSMS_ADMIN($num = "all", $msg, $from = "ALERT"){ global $CORE, $userdata;

  $i=1; 
  
  if($num == "all"){
  while($i < 6){ 
  
	  if(strlen(_ppt('wlt_nexmo_num_'.$i) > 2) && _ppt('wlt_nexmo_prefix_'.$i) != "" ){
	
			$url = "https://rest.nexmo.com/sms/json?api_key="._ppt('wlt_nexmo_api').
						"&api_secret="._ppt('wlt_nexmo_se').
						"&from=".$from.
						"&to="._ppt('wlt_nexmo_prefix_'.$i)._ppt('wlt_nexmo_num_'.$i).
						"&text=".urlencode(stripslashes($msg)); 
						 
			$response = wp_remote_post( $url );
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				return "Something went wrong: $error_message";
			}else{	
			
				$CORE->ADDLOG("SMS Sent", $userdata->ID, 0, $num, "sms", $msg );
			
				return "SMS Sent\n";
			}		
		}	
	$i++; 	
	}
	
	}else{
	
	$url = "https://rest.nexmo.com/sms/json?api_key="._ppt('wlt_nexmo_api').
						"&api_secret="._ppt('wlt_nexmo_se').
						"&from=".$from.
						"&to=".$num.
						"&text=".urlencode(stripslashes($msg)); 
						
			$response = wp_remote_post( $url );
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();
				
				// ADD LOG				 
				$CORE->ADDLOG("SMS Failed", $userdata->ID, 0, $num, "sms", $error_message );		
				
				return "Something went wrong: $error_message";
			}else{	
			
				// ADD LOG					
				$CORE->ADDLOG("SMS Test Sent", $userdata->ID, 0, $num, "sms", $msg );
			
				return "SMS Sent\n";
			}	
	
	}

}
function SENDEMAILALERT($userid, $emailid, $data = ""){ global $post, $CORE, $userdata; $sms_msg = ""; 

 	// SEND SMS OPTION
	if(_ppt('wlt_email_alert_sendsms') != 1){ return; }
 
	
	// CHECK WE HAVE SMS MESSAGE FOR THIS EMAIL
	$all_emails = _ppt('emails');
 	
	if(!isset($all_emails[$emailid]['sms']) || isset($all_emails[$emailid]['sms']) && $all_emails[$emailid]['sms'] == ""){ return; }
	 
	
	// MAKE SURE VALID USER
	if(!is_numeric($userid) && $userid != "admin"){ return; }
	
	// MESSAGE
	$sms_msg = $all_emails[$emailid]['sms'];
	
	
	// CHECK USER 
	if($userid == "admin"){
	
		// SEND SMS
		$this->SENDSMS_ADMIN('all',$sms_msg);
	
	}else{
	
		// GET USER MOBILE NUM
		$mobilenum = get_user_meta($userid, 'mobile', true);
	
	
		if($mobilenum != ""){
			// GET COUNTRY
			
			$ca = get_user_meta($userid, 'country', true);
			
			// BUILDING MOBILE NUMBER
			$num =  "+".$this->countrydialingcodes[$ca]['code'].$mobilenum;			
			 
			// SEND SMS
			$this->SENDSMS_ADMIN($num, $sms_msg, _ppt('wlt_nexmo_from'));
		}
	}
 
}   


	 
	
}

?>