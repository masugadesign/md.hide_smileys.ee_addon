<?php

/* ===========================================================================
ext.md_hide_smileys.php ---------------------------
Hide the smileys link(s) on the Publish and Edit 
pages of the ExpressionEngine control panel.

INFO ---------------------------
Developed by: Ryan Masuga, masugadesign.com
Created:   Jul 10 2007
Last Mod:  Mar 08 2009

http://expressionengine.com/docs/development/extensions.html
=============================================================================== */

class Md_hide_smileys
{
    var $settings        = array();
    
		var $name			       = 'MD Hide Smileys';
		var $version		     = '1.0.1';
		var $description	   = 'Hide the smileys link(s) on Publish pages in the Control Panel.';
		var $settings_exist	 = 'n';
		var $docs_url		     = 'http://www.masugadesign.com/the-lab/scripts/hide-smileys/';
		
    
    // -------------------------------
    //   Constructor - Extensions use this for settings
    // -------------------------------
    
    function Md_hide_smileys($settings='')
    {
        $this->settings = $settings;
    }
    // END


		// --------------------------------
		//  Activate Extension
		// --------------------------------

		function activate_extension()
		{
		    global $DB;
    
		    $DB->query($DB->insert_string('exp_extensions',
              array(
                    'extension_id' => '',
                    'class'        => get_class($this),
                    'method'       => "hide_smileylink",
                    'hook'         => "show_full_control_panel_end",
                    'settings'     => "",
                    'priority'     => 10,
                    'version'      => $this->version,
                    'enabled'      => "y"
                  )
             )
         );
		}
		// END

		//
		// Change Settings
		//
		function settings()
		{
			$settings = array();
			
			return $settings;
		}

		// --------------------------------
		//  Update Extension
		// --------------------------------  

		function update_extension($current='')
		{
		    global $DB;
    
		    if ($current == '' OR $current == $this->version)
		    {
		        return FALSE;
		    }
		    if ($current < '1.0.1')
		    {
		        // Update to next version 1.0.1
		    }
    
		    $DB->query("UPDATE exp_extensions 
		                SET version = '".$DB->escape_str($this->version)."' 
		                WHERE class = '".get_class($this)."'");
		}
		// END


		// --------------------------------
		//  Disable Extension
		// --------------------------------

		function disable_extension()
		{
		    global $DB;
		    $DB->query("DELETE FROM exp_extensions WHERE class = '".$DB->escape_str(get_class($this))."'");
		}
		// END


	// -----------------------------
	//	Da function
	// -----------------------------	


    function hide_smileylink( $out )
	{
		global $EXT;
		
		if($EXT->last_call !== false)
		{
			$out = $EXT->last_call;
		}
		
$out = preg_replace("#<b>Glossary</b></a>[^\r\n]*</span>#", "<b>Glossary</b></a>&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;</span>", $out);

		return $out;
	}
}
// END CLASS
?>