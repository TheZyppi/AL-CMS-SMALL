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
//phpinfo();
if (phpversion()>= '5.3.2')
{
	echo "Sicher <p>";
}
else {
	echo "Nicht Sicher";
}

function bcrypt_encode( $password, $rounds='10' )
{
    $salt = substr ( str_shuffle ( './0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0, 22 );
    return crypt ( $password, '$2a$' . $rounds . '$' . $salt );
}
echo bcrypt_encode('test');
echo "<p>";
echo strlen(bcrypt_encode('test'));
echo "<p>";
if(empty($_POST['submit']))
{
	echo '<form method="post" action="'; print $_SERVER['PHP_SELF']; echo'">';
	echo 'Erzeugen:<input type="text" name="passworto" size="40"><br>
	Passwort:<input type="text" name="passwortt" size="40"><br>
	Salt:<input type="text" name="salt" size="40"><br>
	Beides:<input type="text" name="altpasssalt" size="40"><br>
	<input type="submit" value="Absenden" name="submit">
		</form>';
}
else {
	if($_POST['passworto'])
	{
$rounds='10';
$salt = substr ( str_shuffle ( './0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ' ) , 0, 22 );
echo $salt;
echo "<p>";
echo crypt ( $_POST['passworto'], '$2a$' . $rounds . '$' . $salt );
	}
	else {
		$rounds='10';
		echo $_POST['salt'];
		echo "<p>";
echo $passn=crypt ( $_POST['passwortt'], '$2a$' . $rounds . '$' . $_POST['salt'] );
echo "<p>";
echo $_POST['altpasssalt'];
echo "<p>";
if($passn==$_POST['altpasssalt'])
{
	echo "GLEICH!";
}
else {
	echo "NICHT GLEICH!";
}
		
	}
}
?>