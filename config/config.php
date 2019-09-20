<?php
	ob_start();
	session_start();

	/*Database connection*/
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_NAME','news_530');
	define('DB_PWD','');
	/*Database connection*/

	$url= $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
	// http://localhost/project
	// http://enews.loc

	define('SITE_URL',$url);

	define('SITE_TITLE','Enews.com, An online Nepali Newsportal website');

	define('CMS_URL',SITE_URL.'/cms');

	define('CMS_ASSETS',CMS_URL.'/assets');
	define('CMS_CSS',CMS_ASSETS.'/styles');
	define('CMS_JS',CMS_ASSETS.'/js');
	define('CMS_IMAGES',CMS_ASSETS.'/img');

	define('ERROR_LOG', $_SERVER['DOCUMENT_ROOT'].'/error/error.log');

	define('ALLOWED_EXTS', array('jpg','jpeg','png','bmp','gif','svg'));

	define('UPLOAD_DIR', $_SERVER['DOCUMENT_ROOT'].'/uploads');

	define('UPLOAD_URL', SITE_URL.'/uploads');

?>