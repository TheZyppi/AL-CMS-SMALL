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
class rights
{
	// Check the Site ID or Name of reality
	protected static function site_check($srdp)
	{
			if(empty($_GET['sid']))
		{
			$coid='1';
		}
		else
			{
				$coid=$_GET['sid'];
			}
				if(preg_match("/^([0-9]+)$/",$coid))
				{
					$site_check=mysql_query("SELECT SID FROM sites WHERE SID='".mysql_real_escape_string($coid)."' LIMIT 1");
					if(!$site_check || $site_check==false)
					{
						return false;
					}
					else
						{
							$sid_a=mysql_fetch_array($site_check);
							if($sid_a['SID']!=$coid)
							{
						return false;
							}
							else
								{
						return $sid=$sid_a['SID'];
								}
						}
				}
				else
					{
						// Name search 
						$sid_search=mysql_query("SELECT SID, name FROM sites WHERE name='".mysql_real_escape_string($coid)."'");
			if(!$sid_search || $sid_search==false)
			{
				return false;
			}
			else
				{
				$s_n_a=mysql_fetch_array($sid_search);
				if($s_n_a['name']!=$coid)
				{
					return false;
				}
				else
					{
				return	$sid=$s_n_a['SID'];
					}
				}
					}
	}
	
	// Right Check for the Groups
	private static function site_right_check($srdp, $design_id, $main_id, $use_main_design)
	{
	
					if(rights::site_check($srdp)!=false)
					{
					$sid=rights::site_check($srdp);
					$groupid=$_SESSION['group'];
					$group_check=mysql_query("SELECT GID FROM groups WHERE GID='".mysql_real_escape_string($groupid)."'");
					if(!$group_check || $group_check==false)
					{
						design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."right_error.html", $srdp);
						design::settemplate($srdp);
						design::assign("error", "No Group found.");
					}
					else
						{
							$group_r_s_check=mysql_query("SELECT SID, GID, Y_N FROM sites_group WHERE SID='".mysql_real_escape_string($sid)."' AND GID='".mysql_real_escape_string($groupid)."'");
							if(!$group_r_s_check || $group_r_s_check==false)
							{
								design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."right_error.html", $srdp);
						design::settemplate($srdp);
						design::assign("error", "Your grup havent rights on this site. 1");
							}
							else
								{
									$y_n_check=mysql_fetch_array($group_r_s_check);
									if($y_n_check['GID']!=$groupid)
									{
										design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."right_error.html", $srdp);
						design::settemplate($srdp);
						design::assign("error", "Your group havent rights on this site. 2");
									}
									else
										{
											if($y_n_check['Y_N']=='0')
											{
												design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."right_error.html", $srdp);
						design::settemplate($srdp);
						design::assign("error", "Your group cant use this site.");
											}
											else
												{
													$site_datas=mysql_query("SELECT html_file, data FROM sites WHERE SID='".mysql_real_escape_string($sid)."'");
													if(!$site_datas || $site_datas==false)
													{
														return "Error by loading files for the site.";
													}
													else
														{
															$site_d_a=mysql_fetch_array($site_datas);
															if($site_d_a['html_file']=="")
															{
																return "No Html File found.";
															}
															else {
																if($use_main_design==true)
																{
															design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."sites/".$site_d_a['html_file']."", $srdp);
																}
																else
																{
																	design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."".$site_d_a['html_file']."", $srdp);
																}
															design::settemplate($srdp);
															if(!file_exists("".$srdp."functions/".$site_d_a['data']."") || file_exists("".$srdp."functions/".$site_d_a['data']."")==false || $site_d_a['data']=="")
															{
															
															}
															else
																{
															require_once("".$srdp."functions/".$site_d_a['data']."");		
																}
															}
														}
												}
										}
								}
						}
						}
else
	{
			design::load_body_plugin("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."right_error.html", $srdp);
						design::settemplate($srdp);
						design::assign("error", "No Site found. 5");
	}		
}
	public static function body_site($srdp, $design_id, $main_id, $use_main_design)
	{
	rights::site_right_check($srdp, $design_id, $main_id, $use_main_design);
	}
}
?>