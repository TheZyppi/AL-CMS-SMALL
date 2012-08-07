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

function db_con() {
$user="root"; //username
$pass=""; //Passwort
$db="partysuche"; //Database
$adresse="127.0.0.1"; //Adress
if(!@mysql_connect($adresse, $user, $pass)) // Connection
{
	return false;	
}
else
{
if(!@mysql_select_db($db))
{
	return false;
}
else
{		
mysql_connect($adresse, $user, $pass); // Connection
mysql_select_db($db); // Use Database
}
}	
	}
	?>