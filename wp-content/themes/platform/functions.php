<?php
/*
	
	THEME INITIALIZATION
	
	This file loads the core framework for Platform which handles everything. 
	
	This theme copyright (C) 2008-2010 PageLines

*/

require_once(TEMPLATEPATH . "/includes/core.init.php");


//禁用Open Sans
class Disable_Google_Fonts {
    public function __construct() {
        add_filter( 'gettext_with_context', array( $this, 'disable_open_sans'             ), 888, 4 );
    }
    public function disable_open_sans( $translations, $text, $context, $domain ) {
        if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
                $translations = 'off';
        }
        return $translations;
    }
}
$disable_google_fonts = new Disable_Google_Fonts;
