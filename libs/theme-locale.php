<?php
class Theme_Locale {
    function get($text) {
		global $theme_lang;
		if ($theme_lang == 'th' || $theme_lang == 'th_TH') {
			include(locate_template('languages/th.php'));
			if (isset($lang_th[$text])) {
				return $lang_th[$text];
			} else {
				return $text;
			}
		} else {
			include(locate_template('languages/en.php'));
			if (isset($lang_en[$text])) {
				return $lang_en[$text];
			} else {
				return $text;
			}
		}
	}
}
?>