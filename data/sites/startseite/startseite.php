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
function test()
{
$news_a=mysql_query("SELECT GID, name FROM groups");


$test   = array();
while($n_a=mysql_fetch_array($news_a))
{
    $test[] = array( "NID" => $n_a['GID'], "text" => $n_a['name']);
}
return $test;
}
design::assignEach("Meine_Liste", test());
?>