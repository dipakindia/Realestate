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

define('ERROR_OFFER_ID_REQ', "Offer Id Should not be Blank!");
define('SITE_NAME','Canada Lettings');
//define('SITE_LOGO','http://localhost/PropertyApp/uploads/logo.png');
define('SITE_LOGO','http://mysolutions4u.in/PropertyApp/uploads/logo.png');
define('BASE_URLD','http://localhost/blog/Realestate/administrator/');
//define('BASE_URLD','http://realestate.indiainfosystem.com/administrator/');
define('ERROR_USER_AND_PASS_REQ','Mobile/Email and Password should Not be Blank!!');
define('ERROR_USER_REQ','Mobile/Email should Not be Blank!!');
define('ERROR_PASS_REQ','Password should Not be Blank!!');
define('LOGIN_SUCC_MSG','Login Success !!');
define('ERR_LOGIN','Invalid Email And Password!!');
define('ERROR_BANNERID_REQ','Banner Id should Not be Blank!!');
define('ERROR_TAB_REQ','Tab Id should Not be Blank!!');
define('ERROR_ADDRESS_REQ','Address Id should Not be Blank!!');
define('ERROR_MER_REQ','Merchant Id should Not be Blank!!');
define('ERROR_USER_NAME_REQ','User Name should Not be Blank!!');
define('ERROR_EMAIL_REQ','Email should Not be Blank!!');
define('ERROR_MOBILE_REQ','Mobile should Not be Blank!!');
define('ERROR_NAME_REQ','Name should Not be Blank!!');
define('ERROR_GENDER_REQ','Gender should Not be Blank!!');
define('ERROR_DOB_REQ','Date of Birth should Not be Blank!!');
define('ERROR_PINCODE_REQ','Pincode should Not be Blank!!');
define('ERROR_CATEGORY_REQ','Category should Not be Blank!!');
define('ERROR_MOBILE_ALREADY_EXISTS','Mobile No already Exists!!');
define('ERROR_EMAIL_ALREADY_EXISTS','Email Or Mobile already Exists!!');
define('ERROR_UID_REQ','User Id should Not be Blank!!');
define('REGISTER_SUCCESS','Your account is successfully created, please login continue!');
define('REGISTER_ERROR','Error in Register!!');
define('ERROR_EVENT_ALREADY_EXISTS','Event already register!!');
define('EVENT_ADDED_SUCCESS','Event successfully added!!');
define('ERROR_LOCATION_REQ','Location should Not be Blank!!');
define('ERROR_DATE_REQ','Date should Not be Blank!!');
define('ERROR_SEARCH_TEXT_REQ','Search Text should Not be Blank!!');
define('ERROR_DESC_REQ','Description should Not be Blank!!');
define('ERROR_TITLE_REQ','Title should Not be Blank!!');
define('ERROR_PID_REQ','Product Id should Not be Blank!!');
define('ERROR_MERCHENTID_REQ','Merchant Id should Not be Blank!!');
define('ERROR_EVENT_REQ','Event Id should Not be Blank!!');
define('ERROR_EVENT_ACTION_REQ','Event action should Not be Blank!!');
define('EVENT_ADDED_ERROR','Error in adding event!!');
define('POST_ADDED_ERROR','Error in adding post!!');
define('ADDED_SUCCESS','Successfully added!!');
define('UPDATED_SUCCESS','Successfully Updated!');
define('NO_RECORD_FOUND','No Records Found!!');
define('RECORD_FOUND','Records Found!!');
define('FOUND',' Found!!');
define('ERROR_OFFERID_REQ','Offer Id should Not be Blank!!');
define('ERROR_GALLERY_IMG_REQ','Gallery Image should Not be Blank!!');
define('ERROR','Error');
define("OTP_MSG","Your OTP for WhatsNew is:");
define("OTP_USERNAME","sunojii123");
define("OTP_PASSWORD","Sunojii@misc9");
define("PRODUCT_ID_REQUIRED","Product Id should Not be Blank!!");
define("START_DATE_REQUIRED","Start Date should Not be Blank!!");
define("END_DATE_REQUIRED","End Date should Not be Blank!!");
define("OFFER_TITLE_REQUIRED","Offer Title should Not be Blank!!");
define("NOT_ADDED","not Added!!");
define('ERROR_DESCRIPTION_REQ','Description should Not be Blank!!');
define('PRODUCT_NAME_REQ','Product Name should Not be Blank!!');
define('ERROR_CAT_REQ','Category should Not be Blank!!');
define('ERROR_SUB_CAT_REQ','Sub Category should Not be Blank!!');
define('ERROR_COMMENT_TEXT_REQ','Comment Text should Not be Blank!!');
define("USER_SUBSCRIBE_SUCC","User Subscribe Successfully!!");