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
// Data-Right-Security-Open-Check
if (!defined('ON_ALCMS') || isset($_SESSION['group'])=="")
{
	echo "Error: You are not use ALCMS!";
	exit;
}
else {
function login()
{

// Benutzer und Passwort aus POST-Request holen...
$user = ( isset($_POST['benutzer']) ) ? $_POST['benutzer'] : '';
// Hat der Benutzer abgeschickt?
$absenden = ( isset($_POST['absenden']) ) ? true : false;

if(isset($absenden)==true)
{
  	$username=htmlspecialchars($user , ENT_QUOTES);	
  	db_con(); // Führt die Funktion db_con aus
	$sql = "SELECT UID, username, GID, passwort, passwort_salt FROM user WHERE username = \"".mysql_real_escape_string($username)."\" LIMIT 1"; // Fragt den Datensatz vom Benutzer X ab
   	if($sql==false || !$sql)
	{
	echo "Kein Benutzer mit dem Benutzernamen gefunden.";	
	}
	else {
   	$ergebnis = mysql_query($sql);
   	$reihe = mysql_fetch_array($ergebnis, MYSQL_ASSOC) or die (mysql_error());
   	$passsalt=$reihe['passwort_salt']; // Passwort wird aus der Datenbank geholt
   	$passsaltc=sha1(strtoupper($passsalt)); // Salt Gecryptet
   	$passn=$_POST['passwort']; // Passwort Normal
   	$passnc=sha1(strtoupper($passn)); //Passwort Gecryptet
   	$passall="$passnc $passsaltc"; // Passwort in SHA1 und SALT in SHA1 werden zusammengefügt
   	$passwort = (isset($_POST['passwort']) ) ? sha1($passall) : ''; //Hier werden die beiden SHA1 gecrypteten Passwörter nochmals zusammen SHA1 gecryptet
	}
   if( $reihe['passwort'] == $passwort ) // Schaut nach ob das Passwort auch mit dem Eingegebenden überinstimmt
   {
      session_regenerate_id(); // Generiert aus Sicherheitsgründen eine neue Session
      $ses=session_id(); // Fragt die aktuelle Session ID des Benutzers ab
      $ipadresse =$_SERVER['REMOTE_ADDR']; // Fragt die aktuelle IP-Adresse des Benutzers ab
      $_SESSION['user'] = $benutzer; // Trage Benutzer in die Session ein
      $_SESSION['login'] = true; // Trage Login-Status ein
      $_SESSION['group'] = $reihe['GID']; // Die Gruppen ID wird in die Session abgespeichert
      $_SESSION['uid'] = $reihe['UID']; // BenutzerID wird in der Session abgespeichert
      $sql1 = "UPDATE user SET session_id='$ses', ip_adresse='$ipadresse' WHERE username = '$benutzer' LIMIT 1";
      $ergebnis=mysql_query($sql1);
      // Wichtig ist, dass die Eintragungen in die Session vor der Ausgabe stattfinden.
      // Mit der ersten Ausgabe werden die Header bereits gesendet und können dann nicht mehr
      // verändert werden.
      $eingeloggt = true;
      die("Du wurdest erfolgreich eingeloggt.");
   }
   else
   {
      die("Falsches Passwort");
   }
}

if( !$absenden )
{
   // Der Benutzer hat nicht abgeschickt. Loginformular anzeigen.

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
          "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Login</title>
</head>
<body>
<h1>Login</h1>
<?php
echo $_SESSION['group'];
echo "<p>";
?>
Bitte gib deinen Benutzernamen und dein Passwort ein. (Groß- und Kleinschreibung beachten!)<br />
<form action="index.php?hpl=1&plf=login" method="post">
<strong>Benutzername:</strong> <input type="text" name="benutzer" /><br />
<strong>Passwort:</strong> <input type="password" name="passwort" /><br />
<input type="submit" name="absenden" value="Login" />
</form>
</body>
</html>
<?php

}
}
}
?>