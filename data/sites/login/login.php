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
if(isset($_POST['login']))
{
$security_check=mysql_query("SELECT funktion FROM al_config WHERE CID='4'");
if(!$security_check || $security_check==false)
{
	return "No Security Config found.";
}
else {
	$s_a=mysql_fetch_array($security_check);
	// SHA1
	if($s_a['funktion']=='1')
	{
		
	}
	// Bcrypt
	else if($s_a['funktion']=='2')
	{
		$round_check=mysql_query("SELECT funktion FROM al_config WHERE CID='5'");
		if(!$round_check || $round_check==false)
		{
			return "No rounds found.";
		}
		else {
			$r_a=mysql_fetch_array($round_check);
			$usernameo = strip_tags($_POST['username']);
			$username = htmlentities($usernameo);
			$passwordo = strip_tags($_POST['password']);
			$password = htmlentities($passwordo);
			if($username=="true" || $username=="false" || empty($username))
			{
				return design::assign("message", "No username.");
			}
			else if($password=="true" || $password=="false" || empty($password))
			{
				return design::assign("message", "No Password.");
			}
			else
				{
			$user_check=mysql_query("SELECT username, password, salt FROM user WHERE username='".mysql_real_escape_string($username)."' LIMIT 1");
			if(!$user_check || $user_check==false)
			{
				return design::assign("message", "No user found with this username.");
			}
			else
				{
			$u_a=mysql_fetch_array($user_check);
			if($u_a['username']!=$username)
			{
				return design::assign("message", "No user found with this username.");
			}
			else {
			// $salt = substr ( str_shuffle ( './0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0, 22 );
			$crypt=crypt( $password, '$2a$' . $u_a['rounds'] . '$' . $u_a['salt']);
			if($crypt==$u_a['password'])
			{
				session_regenerate_id(); // Generiert aus Sicherheitsgründen eine neue Session
      			$ses=session_id(); // Fragt die aktuelle Session ID des Benutzers ab
      			$ipadresse =$_SERVER['REMOTE_ADDR']; // Fragt die aktuelle IP-Adresse des Benutzers ab
      			$_SESSION['user'] = $username; // Trage Benutzer in die Session ein
      			$_SESSION['login'] = true; // Trage Login-Status ein
      			$_SESSION['group'] = $u_a['GID']; // Die Gruppen ID wird in die Session abgespeichert
      			$_SESSION['uid'] = $u_a['UID']; // BenutzerID wird in der Session abgespeichert
				$update_user=mysql_query("UPDATE user SET session_id='$ses', ip_adresse='$ipadresse' WHERE username = '$username' LIMIT 1");
				return "You are Login";
			}
			else {
				return "Password wrong.";
			}
				}
				}
				}
		}
	}
	else
		{
			return "No available security funktion found.";
		}
}
}
else
	{
		return "Dont send up.";
	}
?>