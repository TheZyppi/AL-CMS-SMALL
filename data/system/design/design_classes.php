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
 
 class design
{
	// Design Path Function
	public static function design_css($main_id)
	{
		$css_design=mysql_query("SELECT DID, data FROM design WHERE DID='".mysql_real_escape_string($main_id)."' LIMIT 1");
		if(!$css_design || $css_design==false)
		{
			
			return false;
		}
		else
			{
				$css_design_array=mysql_fetch_array($css_design);
				if($css_design_array['DID']!=$main_id)
				{
					return false;
				}
				else
					{
				return $css_design_array['data'];
					}
					}
	}
	public static function design_path($design_id='', $main_id='', $use_main_design='')
	{
		if($use_main_design==true && $design_id==$main_id)
		{
			$search_main_design=mysql_query("SELECT DID, data FROM design WHERE DID='".mysql_real_escape_string($design_id)."' LIMIT 1");
		if(!$search_main_design || $search_main_design==false)
		{
			return false;
		}
		else
			{
				$main_design_array=mysql_fetch_array($search_main_design);
				if($design_id!=$main_design_array['DID'])
				{
					return false;
				}
				else
					{
						return $main_design_array['data'];
					}
			}
		}
		else
			{
	$search_main_design=mysql_query("SELECT DID, data FROM design WHERE DID='".mysql_real_escape_string($main_id)."' LIMIT 1");
		if(!$search_main_design || $search_main_design==false)
		{
			return false;
		}
		else
			{
				$main_design_array=mysql_fetch_array($search_main_design);
				if($main_id!=$main_design_array['DID'])
				{
					return false;
				}
				else
					{
						$search_under_design=mysql_query("SELECT DID, data FROM design WHERE DID='".mysql_real_escape_string($design_id)."' LIMIT 1");
						if(!$search_under_design || $search_under_design==false)
						{
							return false;
						}
						else
							{
							$under_design_array=mysql_fetch_array($search_under_design);
							return "".$main_design_array['data']."special_site_designs/".$under_design_array['data']."";
							}
							}
			}			
			}
	
	}
	// Build for the Normal Design NO MOBILE!
	private static function design_normal_build($srdp)
	{
		if(empty($_GET['sid']) && isset($_GET['sid'])==false)
		{
			$s_sid_search=mysql_query("SELECT CID, funktion FROM al_config WHERE CID='3'");
			$sid_array=mysql_fetch_array($s_sid_search);
			$sid=$sid_array['funktion'];
		}
		else
		{
			$coid=$_GET['sid'];
			if(preg_match ("/^([0-9]+)$/",$coid))
			{
				$sid=$coid;
				
			}
			else {
			// Search Name SID
			$sid_search=mysql_query("SELECT SID, name FROM sites WHERE name='".mysql_real_escape_string($coid)."'");
			if(!$sid_search || $sid_search==false)
			{
			$s_sid_search=mysql_query("SELECT CID, funktion WHERE CID='3'");
			$sid_array=mysql_fetch_array($s_sid_search);
			$sid=$sid_array['funktion'];
			}
			else
				{
				$s_n_a=mysql_fetch_array($sid_search);
				if($s_n_a['name']!=$coid)
				{
			$s_sid_search=mysql_query("SELECT CID, funktion FROM al_config WHERE CID='3'");
			$sid_array=mysql_fetch_array($s_sid_search);
			$sid=$sid_array['funktion'];
				}
				else
					{
					$sid=$s_n_a['SID'];
					}
				}
			}
		}
		//echo "SID:".$sid."";
	
	$search_site=mysql_query("SELECT SID FROM sites WHERE SID='".mysql_real_escape_string($sid)."' LIMIT 1");
	if(!$search_site || $search_site==false)
	{
		$search_standart_design=mysql_query("SELECT DID FROM design WHERE mobile='0' AND standart='1' AND aktiv='1' LIMIT 1");
		if(!$search_standart_design || $search_standart_design==false || mysql_num_rows($search_standart_design)==false)
		{
			echo "No standart design found!";
			exit;
		}	
		else
			{
				$standart_design_array=mysql_fetch_array($search_standart_design);
				$design_id=$standart_design_array['DID'];
				$main_id=$standart_design_array['DID'];
				$use_main_design=true;
			}
	}
	else
		{
			$search_master_standart_design=mysql_query("SELECT DID FROM design WHERE mobile='0' AND standart='1' AND aktiv='1' LIMIT 1");
		if(!$search_master_standart_design || $search_master_standart_design==false || mysql_num_rows($search_master_standart_design)==false)
		{
			echo "No standart design found!";
			exit;
		}	
		else
			{
				$standart_master_design_array=mysql_fetch_array($search_master_standart_design);
				$master_main_id=$standart_master_design_array['DID'];
				$serach_site_design=mysql_query("SELECT MDID, SID, use_design FROM site_design WHERE MDID='".mysql_real_escape_string($master_main_id)."' AND SID='".mysql_real_escape_string($sid)."' LIMIT 1");
				if(!$serach_site_design || $serach_site_design==false)
				{
			$search_standart_design=mysql_query("SELECT DID FROM design WHERE mobile='0' AND standart='1' AND aktiv='1' LIMIT 1");
		if(!$search_standart_design || $search_standart_design==false || mysql_num_rows($search_standart_design)==false)
		{
			echo "No standart design found!";
			exit;
		}	
		else
			{
				$standart_design_array=mysql_fetch_array($search_standart_design);
				$design_id=$standart_design_array['DID'];
				$main_id=$standart_design_array['DID'];
				$use_main_design=true;
			}		
				}
				else
					{
						$site_design_array=mysql_fetch_array($serach_site_design);
						if($site_design_array['SID']!=$sid)
						{
							$search_standart_design=mysql_query("SELECT DID FROM design WHERE mobile='0' AND standart='1' AND aktiv='1' LIMIT 1");
		if(!$search_standart_design || $search_standart_design==false || mysql_num_rows($search_standart_design)==false)
		{
			echo "No standart design found!";
			exit;
		}	
		else
			{
				$standart_design_array=mysql_fetch_array($search_standart_design);
				$design_id=$standart_design_array['DID'];
				$main_id=$standart_design_array['DID'];
				$use_main_design=true;
			}
						}
						else
							{
								$design_id_u=$site_design_array['use_design'];
								$search_use_design=mysql_query("SELECT DID FROM design WHERE DID='".mysql_real_escape_string($design_id_u)."' LIMIT 1");
								if(!$search_use_design || $search_use_design==false)
								{
								$design_id=$site_design_array['MDID'];
								$main_id=$site_design_array['MDID'];
								$use_main_design=true;
								}
								else {
								$design_id=$site_design_array['use_design'];
								$main_id=$site_design_array['MDID'];
								if($design_id==$main_id)
								{
								$use_main_design=true;
								}
								else
									{
								$use_main_design=false;		
									}
								}
							}
					}
		}
		}
				// DESIGN BUILD
				
				// Designs Files loading
			if(!file_exists("".$srdp."system/rights/right_classes.php"))
			{
				echo "No Right Class found.";
				exit;
			}	
			else if(!file_exists("".$srdp."system/rights/login_check.php"))
			{
				echo "No Session Checker found.";
				exit;
			}
			else
				{
			require_once("".$srdp."system/rights/login_check.php");
			login_check();
			require_once("".$srdp."system/rights/right_classes.php");
				// HTML Head
			//echo 	design::design_css($main_id);
			//echo "<p><br><p>";
			//echo "<p>DID:".$design_id." <p>AND MAIN_ID: ".$main_id." AND USE_DESIGN: ".$use_main_design."";
				//echo "".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."body_head.html";
				design::load_head("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."head_main.html" , $srdp);
				// Body Head
				design::load_body_head("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."body_head.html", $srdp);
				//Foot
				design::load_body_footer("".$srdp."design/".design::design_path($design_id, $main_id, $use_main_design)."body_foot.html", $srdp);
				//Body Fuctions of the Site
				rights::body_site($srdp, $design_id, $main_id, $use_main_design);
				// CSS included
				design::assign("css", require_once("".$srdp."design/".design::design_css($main_id)."css/index.php"));
				// Title
				$title_query=mysql_query("SELECT CID, funktion FROM al_config WHERE CID='1'");
				if(!$title_query || $title_query==false)
				{
					$title="AL-CMS";
				}
				else {
					$title_array=mysql_fetch_array($title_query);
					$title=$title_array["funktion"];
				}
				design::assign("title", "$title");
			}
			}
			
public static function body_normal($srdp)
{
	design::design_normal_build($srdp);
}

    private static $leftDelimiter = '{$';

    private static $rightDelimiter = '}';

    private static $leftDelimiterF = '{';

    private static $rightDelimiterF = '}';

   	private static$leftDelimiterC = '\{\*';

   	private static $rightDelimiterC = '\*\}';

    private static $leftDelimiterL = '\{L_';

    private static $rightDelimiterL = '\}';

    private static $templateFile = "";
        
    private static $template_plugin_File = "";

    private static $template_head_File = "";
	
	private static $template_body_head_File = "";
	
	private static $template_body_plugin_File = "";

	private static $template_body_foot_File = "";

    private static $languageFile = "";

    private static $templateName = "";

    private static $template = "";
	
	private static $template_head = "";
	
	private static $template_body_head = "";

	private static $template_body_site = "";

	private static $template_body_footer = "";
	
	private static $array;
	private static $arrayt ="";

    public function __construct($tpl_dir = "", $lang_dir = "") {
       
        if (!empty($tpl_dir) ) {
            $this->templateDir = $tpl_dir;
        }

       
        if ( !empty($lang_dir) ) {
            $this->languageDir = $lang_dir;
        }
    }
// This load is for Error Loads for the AL-CMS
    public static function load($file, $srdp)    {
        design::$templateName = $file;
        design::$templateFile = $file;

        if(isset(design::$templateFile) ) {
            if( file_exists(design::$templateFile) ) {
                design::$template = file_get_contents(design::$templateFile);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
        }
 
        design::parseFunctions();
    }
// This load the Head files
    public static function load_head($file, $srdp)    {
        design::$templateName = $file;
        design::$template_head_File = $file;

        if(isset(design::$template_head_File) ) {
            if( file_exists(design::$template_head_File) ) {
                design::$template_head = file_get_contents(design::$template_head_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
        }
 
        design::parseFunctions();
    }

public static function load_body_head($file, $srdp)    {
        design::$templateName = $file;
        design::$template_body_head_File = $file;

        if(isset(design::$template_body_head_File) ) {
            if( file_exists(design::$template_body_head_File) ) {
                design::$template_body_head  = file_get_contents(design::$template_body_head_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
    }
 
        design::parseFunctions();
    }

public static function load_body_site($file, $srdp)    {
        design::$templateName = $file;
        design::$template_body_plugin_File = $file;

        if(isset(design::$template_body_plugin_File)) {
            if( file_exists(design::$template_body_plugin_File) ) {
                design::$template_body_site  = file_get_contents(design::$template_body_plugin_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
   }
 
        design::parseFunctions();
    }
		
public static function load_body_footer($file, $srdp)    {
        design::$templateName = $file;
        design::$template_body_foot_File = $file;

        if(isset(design::$template_body_foot_File) ) {
            if( file_exists(design::$template_body_foot_File) ) {
                design::$template_body_footer  = file_get_contents(design::$template_body_foot_File);
            } else {
            	echo "1";
                return false;
            }
        } else {
        	echo "2";
           return false;
   }
 
        design::parseFunctions();
    }

   public static function assign($replace, $replacement) {
   	if($replacement==false || $replacement=="")
	{
		 design::$template = str_replace( design::$leftDelimiter .$replace.design::$rightDelimiter,
                                    "", design::$template );
	}
	else {
      design::$template = str_replace( design::$leftDelimiter .$replace.design::$rightDelimiter,
                                    $replacement, design::$template );
	}
	}
    public static function loadLanguage($files) {
        design::$languageFiles = $files;

        for( $i = 0; $i < count( design::$languageFiles ); $i++ ) {
            if (!file_exists( design::$languageDir .design::$languageFiles[$i] ) ) {
                return false;
            } else {
                 require_once(design::$languageDir .design::$languageFiles[$i]);
            }
        }

        design::$replaceLangVars($lang);

        return $lang;
    }


    private static function replaceLangVars($lang) {
        design::$template = preg_replace("/\{L_(.*)\}/isUe", "\$lang[strtolower('\\1')]", design::$template);
    }

    private static function parseFunctions() {
      
        while( preg_match( "/" .design::$leftDelimiterF ."include file=\"(.*)\.(.*)\""
                           .design::$rightDelimiterF ."/isUe", design::$template) )
        {
            design::$template = preg_replace( "/" .design::$leftDelimiterF ."include file=\"(.*)\.(.*)\""
                                            .design::$rightDelimiterF."/isUe",
                                            "file_get_contents(\$this->templateDir.'\\1'.'.'.'\\2')",
                                            design::$template );
        }


        design::$template = preg_replace( "/" .design::$leftDelimiterC ."(.*)" .design::$rightDelimiterC ."/isUe",
                                        "", design::$template );
    }
	
	public static function settemplate($srdp)
	{
		if(design::$template_head=="" || design::$template_head==false)
		{
design::load("data/design/default/error_site.html", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template head set.");	
		}
		else if(design::$template_body_head=="" || design::$template_body_head==false)
		{
design::load("data/design/default/error_site.html", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template body head set.");	
		}
		else if(design::$template_body_site=="" || design::$template_body_site==false)
		{
design::load("data/design/default/error_site.html", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template body plugin set.");	
		}
		else if(design::$template_body_footer=="" || design::$template_body_footer==false)
		{
design::load("data/design/default/error_site.html", $srdp);
// Platzhalter ersetzen
design::assign("error" ,"No template body foot set.");	
		}
		else {
		design::$template="".design::$template_head."".design::$template_body_head."".design::$template_body_site."".design::$template_body_footer."";
		}
		}
                public static function assignEach($name, $array) {
                        design::$array = $array;
                        design::$template = preg_replace_callback('/<each="' . $name . '">(.*?)<\/each>/ms', array('design', 'eachCallback'), design::$template);
                        //return design;
                }               
                private static function eachCallback($matches) {
                        foreach(design::$array as $value) {
                                $cache = $matches[0];
                                foreach($value as $key => $subValue)
								{
                                        $cache = str_replace(design::$leftDelimiter . $key . design::$rightDelimiter, $subValue, $cache);          
					}
								     design::$arrayt .= $cache;
                        }
                        return design::$arrayt;
                }
		
    public static function display($srdp) {
        echo design::$template;
	}
 }
 $designsys = new design();

?>