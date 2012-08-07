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

function login_check() {
session_start(); // Zum Starten der Session
if( (isset($_SESSION['user'])) AND (!empty($_SESSION['user'])) )
{
   // Benutzername vorhanden; $_SESSION['login'] prüfen
   $be=$_SESSION['user']; // Holt aus der aktuellen Session den Benutzername
	db_con(); // Führt die Funktion db_con aus
   $sql = "SELECT GID, session_id, ip_adresse FROM user WHERE username = \"".$be."\" LIMIT 1"; // Fragt den Datensatz vom Benutzer X ab
   $ergebnis = mysql_query($sql);
   $reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC);
    $ipadresse =$_SERVER['REMOTE_ADDR'];// Fragt die aktuelle IP-Adresse des Benutzers ab
   if( (isset($_SESSION['login'])) AND $_SESSION['login'] == true  AND $reihe['session_id']==session_id() AND $reihe['ip_adresse']==$ipadresse)
   {

   }
   else
   {
      // Kein Loginstatus in der Session abgespeichert. Daher ist man nicht eingeloggt.
$_SESSION['group'] = '1';
   }
   }
   else {
   // Kein Benutzername in der Session abgespeichert. Daher ist man nicht eingeloggt.
$_SESSION['group'] = '1';
}
}
?>