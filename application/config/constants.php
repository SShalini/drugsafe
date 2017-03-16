<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

if( !defined( "__APP_PATH__" ) )
	define( "__APP_PATH__", realpath( dirname( __FILE__ ) . "/../../" ));
if(ENVIRONMENT == 'development'){
    define("__BASE_URL__", "http://local.drugsafe.com");
}elseif (ENVIRONMENT == 'testing'){
    define("__BASE_URL__", "http://whizsolutionsdev.com/drugsafe");
}
elseif (ENVIRONMENT == 'production'){
    define("__BASE_URL__", "http://drugsafe.dev.mobileconnekt.com.au");
}
define("__BASE_CSS_URL__", __BASE_URL__ . "/css");
define("__APP_PATH_CSS__", __APP_PATH__ . "/css");

define("__BASE_JS_URL__", __BASE_URL__ . "/js");
define("__APP_PATH_JS__", __APP_PATH__ . "/js");

define("__BASE_IMAGES_URL__", __BASE_URL__ . "/images");
define("__APP_PATH_IMAGES__", __APP_PATH__ . "/images");
define("__APP_PATH_UPLOADS__", __APP_PATH__ . "/uploads");

define("__BASE_ASSETS_URL__", __BASE_URL__ . "/assets");
define("__APP_PATH_ASSETS__", __APP_PATH__ . "/assets");
define("__BASE_UPLOADED_SIGN_URL__", __BASE_URL__ . "/uploadsign/");

define("__FRANCHISEE_OWNER_PRICE_1__", 16.5);
define("__FRANCHISEE_OWNER_PRICE_2__", 19.95);
define("__FRANCHISEE_OWNER_PRICE_3__", 0);

define("__RRP_1__", 5.00);
define("__RRP_2__", 75.00);
define("__RRP_3__", 75.00);
define("__RRP_4__", 75.00);

define("__MIN_DROP_DOWN_LIMIT__", 5);
define("__PAGINATION_RECORD_LIMIT__", 20);



define("__APP_PATH_LOGS__", __APP_PATH__ . "/application/logs");

define("__BASE_USER_PRODUCT_IMAGES_URL__", __BASE_URL__ . "/product_img");
define("__APP_PATH_PRODUCT_IMAGES__", __APP_PATH__ . "/product_img");

define("__DBC_SCHEMATA_USERS__", "ds_user");
define("__DBC_SCHEMATA_CORP_FRANCHISEE_MAPPING__", "ds_corpfrmapping");
define("__DBC_SCHEMATA_SITES__", "ds_sites");
define("__DBC_SCHEMATA_CART__", "ds_cart");
define("__DBC_SCHEMATA_ORDER_DETAILS__", "ds_order_details");
define("__DBC_SCHEMATA_ORDER__", "ds_orders");
define("__DBC_SCHEMATA_DONER__", "ds_doner");
define("__DBC_SCHEMATA_USED_KITS__", "ds_usedsoskit");
define( "__DBC_SCHEMATA_COUNTRY__", "tbl_countries");
define( "__DBC_SCHEMATA_STATE__", "tbl_states");
define( "__DBC_SCHEMATA_FRANCHISEE__", "tbl_franchisee");
define( "__DBC_SCHEMATA_USERS_EMAIL_LOG__", "tbl_email_log");
define( "__DBC_SCHEMATA_EMAIL_CMS__", "tbl_email_cms");
define("__DBC_SCHEMATA_FORUM_CATEGORY__", "fo_category");
define("__DBC_SCHEMATA_FORUM_TOPIC__", "fo_topic");
define("__DBC_SCHEMATA_FORUM_COMMENTS__", "fo_cmnt");
define("__DBC_SCHEMATA_FORUM_REPLY__", "fo_reply");
define("__DBC_SCHEMATA_FORUM_DATA__", "fo_data");
define( "__DBC_SCHEMATA_CLIENT__", "tbl_client");
define( "__DBC_SCHEMATA_INDUSTRIES__", "ds_industries");
define( "__DBC_SCHEMATA_PRODUCT__", "tbl_product");
define( "__DBC_SCHEMATA_MANUAL_CAL__", "tbl_manual_calc");
define( "__DBC_SCHEMATA_PRODUCT_CATEGORY__", "tbl_product_category");
define("__CUSTOMER_SUPPORT_EMAIL__", 'support@whiz-solutions.com');
define("__ADMIN_EMAIL__", 'admin@drugsafe.com');
define("__DBC_SCHEMATA_MODEL_STOCK_VALUE__", "fr_modelstock_val");
define("__DBC_SCHEMATA_PRODUCT_STOCK_QUANTITY__", "fr_prodstock_qty");
define("__DBC_SCHEMATA_QUANTITY_TRACKING__", "tbl_qty_tracking");
define("__DBC_SCHEMATA_VALUE_TRACKING__", "tbl_value_tracking");
define("__DBC_SCHEMATA_REQUEST_QUANTITY__", "tbl_stock_request");
define("__DBC_SCHEMATA_SOS_FORM__", "ds_sos");
define("__DBC_SCHEMATA_COC_FORM__", "ds_coc");
define("__DBC_SCHEMATA_STOCK_REQ_TRACKING__", "tbl_stock_assign_tracking");
define("__DBC_SCHEMATA_REGION__", "tbl_region");
define("__DBC_SCHEMATA_OPERATION_STATE_MAPING__", "tbl_operation_state_maping");
define("__DBC_SCHEMATA_AGENT_FRANCHISEE__", "ds_agentmapping");
define("__DBC_SCHEMATA_DISCOUNT__", "tbl_discount");
define("__DBC_SCHEMATA_PROSPECT__", "tbl_prospect");
define("__DBC_SCHEMATA_STATUS__", "tbl_prospect_status");
define("__DBC_SCHEMATA_MEETINGS_NOTE__", "tbl_meetings_note");

/**
 * Validate an int, uses is_numeric
 *
 *
 */
	define( "__VLD_CASE_NUMERIC__", "NUMERIC" );
	
/**
 * Validate an digits, uses /^[0-9]*$/
 *
 *
 */
	define( "__VLD_CASE_DIGITS__", "DIGITS" );
	
/**
 * Validate an credit card, uses is_numeric
 *
 * 
 */
	define( "__VLD_CASE_CARD__", "CARD" );
/**
 * Validate numbers & letters, REGEX: /^[a-z0-9]+$/i
 *
 * 
 */
	define( "__VLD_CASE_ALPHANUMERIC__", "ALPHANUMERIC" );

/**
 * Validate URI, REGEX: /^[a-z0-9\-\_\.]+$/i
 *
 * 
 */
	define( "__VLD_CASE_URI__", "URI" );
/**
 * Validate alpha letters, REGEX: /^[a-z]+$/i
 *
 * 
 */
	define( "__VLD_CASE_ALPHA__", "ALPHA" );
/**
 * Validate anything, allows ANYTHING!
 *
 * 
 */
     define( "__VLD_CASE_NAME__", "NAME" );
/**
 * Validate anything, allows ALPHA AND SPACE ALSO!
 *
 * 
 */
	define( "__VLD_CASE_ANYTHING__", "ANYTHING" );
/**
 * Validate email, REGEX: /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z0-9]{2,3})$/i
 *
 * 
 */
	define( "__VLD_CASE_EMAIL__", "EMAIL" );
/**
 * Validate boolean, uses is_bool || === 0 || === "0"
 *
 * 
 */
	define( "__VLD_CASE_BOOL__", "BOOL" );
/**
 * Validate boolean, uses is_bool
 *
 * 
 */
	define( "__VLD_CASE_STRICTBOOL__", "STRICTBOOL" );
/**
 * Validate address, REGEX: /^[a-z0-9,.#-_\s]+$/i
 *
 * 
 */
	define( "__VLD_CASE_ADDRESS__", "ADDRESS" );
/**
 * Validate name, REGEX: /^[a-z0-9,.#-_\s]+$/i
 *
 * 
 */
	define( "__VLD_CASE_NAME__", "NAME" );
/**
 * Validate url, REGEX: _^(?:([^:/?#]+):)?(?://([^/?#]*))?([^?#]*)(?:\?([^#]*))?(?:#(.*))?$_
 *
 *
 */
	define( "__VLD_CASE_URL__", "URL" );
/**
 * Validate username, REGEX: /^[\S]+$/i
 *
 * 
 */
	define( "__VLD_CASE_USERNAME__", "USERNAME" );
/**
 * Validate password, REGEX: /^[\S]+$/i
 *
 * 
 */
	define( "__VLD_CASE_PASSWORD__", "PASSWORD" );
/**
 * Validate date, uses strtotime
 *
 * 
 */
	define( "__VLD_CASE_DATE__", "DATE" );
/**
 * Validate phone, REGEX: /^\d{3}-\d{3}-\d{4}$/
 *
 * 
 */
        define( "__VLD_CASE_TIME__", "TIME" );
        
	define( "__VLD_CASE_PHONE__", "PHONE" );
/**
 * Validate mobile phone, REGEX: /^\d{3}-\d{3}-\d{4}$/
 *
 * 
 */
	define( "__VLD_CASE_MOBILE_PHONE__", "MOBILE_PHONE" );
/**
 * Validate phone, REGEX: /^\d{10}$/
 *
 *
 */
	define( "__VLD_CASE_PHONE2__", "PHONE_2" );
/**
 * Validate US money, REGEX: /^[0-9]+(\.[0-9]{2})*$/
 *
 * 
 */
	define( "__VLD_CASE_MONEY_US__", "MONEY_US" );
/**
 * Validate DECIMAL, REGEX: /^[0-9]+(\.[0-9]{2})*$/
 *
 *
 */
	define( "__VLD_CASE_DECIMAL__", "DECIMAL" );
/**
 * Validate drop down is selected and > 0
 *
 *
 */
	define( "__VLD_CASE_DD_NON_0__", "DD_NON_0" );
	
/**
 * Validate for a whole number
 *
 *
 */
	define( "__VLD_CASE_WHOLE_NUM__", "WHOLE_NUM" );
	
/**
 * Validate for a file name
 *
 *
 */
define( "__VLD_CASE_FILE_NAME__", "FILE_NAME" );
/**Digit format**/
define("__FORMAT_NUMBER__",'%06d');
define("__REGINOL_CODE__",'%03d');
/**
 * Validate Image is selected and type
 *
 *
 */
define("__FRONT_END_COOKIE__","drugsafe_front");
define("__SESSION_LIFETIME__", "+ 12 Hours");
define("__ENCRYPT_KEY__", "drugSAFE16");

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


defined('__DBC_SCHEMATA_ADMIN__')      OR define('__DBC_SCHEMATA_ADMIN__', 'ds_user'); 

define('__URL_FRANCHISEE_CLIENTRECORD__', '/franchisee/clientRecord');
define('__URL_FRANCHISEE_VIEWCLIENTDETIALS__', '/franchisee/viewClientDetails'); 
