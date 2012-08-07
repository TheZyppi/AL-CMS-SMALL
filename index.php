<?php
/*
 * AL-CMS-Small -- Gernal Information --
 * 
 * Copyright (C) 2011-2012 Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */
define('ON_ALCMS', true);
// Standart Root Path
$srdp='data/';
// Check the dbcon.php file
if(!file_exists(''.$srdp.'config/dbcon.php'))
{
	echo "No Database Connection.";
	exit;
}
// Check the design.php file
else if(!file_exists(''.$srdp.'system/design/design.php')) {
	echo "Designsystem not ready.";
	exit;
}
// When are all already the files are inlucde and the designsystem run
else {
	require_once(''.$srdp.'config/dbcon.php');
	require_once(''.$srdp.'system/design/design.php');
	design::display($srdp);
}
?>