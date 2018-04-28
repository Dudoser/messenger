<?php
	
	function validStr($str, $text = false) {
		if ($text == false) {
			$str = mb_strtolower($str);
		}
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		return $str;
	}
?>