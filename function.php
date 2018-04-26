<?php
	
	function validStr($str) {
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = stripslashes($str);
		$str = mb_strtolower($str);
		return $str;
	}
?>