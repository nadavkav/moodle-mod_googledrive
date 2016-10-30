<?php

require('../../config.php');

use \mod_googledrive\googledrive;

require_login();

/// Parameters
$cmid   = required_param('cmid', PARAM_INT); // Repository ID

/// Headers to make it not cacheable
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');

/// Wait as long as it takes for this script to finish
core_php_time_limit::raise();

$gdrive = new googledrive($cmid);
$gdrive->callback();

echo "Your Google drive user access is Authenticated :-)";