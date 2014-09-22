<?php
	class ServerValidations {
		
		private static $valueBasedCheck = array('isNot', 'hasRequireLen', 'isValue', 'isBetween', 'isImgSize', 'isSameAsPwd');
				//isNotEmpty,isAlphaNuemaric,isEmail,isDropdownNotEmpty,isNot*,hasRequireLen*,isSameAsPwd,isBetween*,isNumber,isValue*,isImage,isImgSize
				
		public function isNotEmpty($value) {
			if(is_bool($value) ) {
				return true;
			}
			if(empty($value)) {
				return false;
			}
			return true;
		}
		
		public function isAlphaNuemaric($value) {
			/*if(preg_match('/^[a-zA-Z0-9]+$/', $this->currValueToValidate)) {
				return true;
			}*/
			if(ctype_alnum($value)) {
				return true;
			}
			return false;
		}
		
		public function isAlpha ($value) {
			if(ctype_alpha($value)) {
				return true;
			}
			return false;
		}
		
		public function isEmail($email) {
			$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/"; 
			if (preg_match($regex, $email)) {
				return true;
			}
			return false;
		}
		
		public function isDropdownNotEmpty($value) {
			if($value === "-1") {
				return false;
			}
			return true;
		}
		
		public function isNot($rule, $value) {
			if(!isset($value)) {
				return true;
			}		
			for($i = 0, $len = count($rule); $i != $len; ++$i) {
				if($rule[$i] === $value) {
					return false;
				}
			}
			return true;
		}
		
		public function hasRequireLen($rule, $value) {
			$this->pwd = $value;
			if(strlen($value) >= $rule[0]) {
				return true;
			}
			return false;
		}
		
		public function isSameAsPwd($pwd, $cnfmPwd) {
			if($cnfmPwd !== $pwd[0]) {
				return false;
			}
			return true;
		}
		
		public function isBetween($rule, $value) {
			if( $rule[0] <= $rule[1] ) {
				$max = $rule[1];
				$min = $rule[0];
			}
			else {
				$max = $rule[0];
				$min = $rule[1];
			}
			$numlen=strlen($value);
			if($numlen === 0) {
				return false;
			}
			if( ($min <= $numlen) && ($numlen <= $max) ) {
				return true;
			}
			return false;
		}
		
		public function isNumber($value) {
			if(is_numeric($value)) {
				return true;
			}	
			return false;
		} 
		
		public function isDate($date) {
			$date_regex = "/^(0[1-9]|[1-2][0-9]|3[0-1])[- \/](0[1-9]|1[0-2])[- \/][0-9]{4}$/"; 
			if(preg_match($date_regex , $date)) {
			   return true;
			}
			return false;
		}
		
		public function isValue($rule,$value) {
			$gend = $value;
			if($gend === $rule[0] || $gend === $rule[1] || $gend === $rule[2]) {
				return true;
			}
			return false;	
		}
		
		public function isImgSize($rule,$value) {
			$pathInfo = pathInfo($value);
			$flSize = $_FILES['profile_pic']['size'];
			if($flSize <= $rule[0]*1048576) {
				return true;
			}
			return false;
		}
		
		public function isImage($value) {
			$pathInfo = pathinfo($value);
			if($pathInfo != "") {
				$extension = $pathInfo['extension'];
				if(in_array($extension, array('jpeg','jpg','png','gif'), true)) {
					return true;
				}
				return false;
			}
			
			return false;
		}
		
		public static function getValueBasedChecks() {
			return self::$valueBasedCheck;
		}
		
	}
?>