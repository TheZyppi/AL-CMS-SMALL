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
 
if(isset($_POST['register']) && !empty($_POST['register']))
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
?>