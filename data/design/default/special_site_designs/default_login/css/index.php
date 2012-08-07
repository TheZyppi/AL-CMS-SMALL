<?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

/*
 * Standart-CSS Include Datei eines jeden Designs
 * 
 * Dient dazu die einzelnden CSS Datein für das Design bereitzustellen.
 * Es können soviele Datein hinzugefügt werden wie man möchte.
 * 
 * 
 */

$path ='<link rel="stylesheet" title="Normal" href="'.$srdp.'design/'.design::design_path($design_id).'css/seite.css" type="text/css">';
return $path;
?>