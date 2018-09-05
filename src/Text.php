<?php

	namespace Atiksoftware\Cover;

	class Text
	{

		/* Text Encodes */
		static function toUTF8($text){
			return iconv( mb_detect_encoding($text, mb_detect_order(), true), 'UTF-8',  $text );
		}
		static function toWindows($text){
			return iconv( mb_detect_encoding($text, mb_detect_order(), true), 'windows-1254',  $text );
		}

		static function toHex($e){
			return strtoupper(dechex($e));
		}
		static function toDec($e){
			return strtoupper(hexdec($e));
		}

		static function toUpper($e){
			$old = array("ı","ğ","ü","ş","i","ö","ç");
			$new = array("I","Ğ","Ü","Ş","İ","Ö","Ç");
			return strtoupper(str_replace($old,$new,$e));
		}
		static function toLower($e){
			$old = array("I","Ğ","Ü","Ş","İ","Ö","Ç");
			$new = array("ı","ğ","ü","ş","i","ö","ç");
			return strtolower(str_replace($old,$new,$e));
		}
		static function toUpFirst($e){
			$w=array();
			$ps=explode(" ", $e);
			foreach ($ps as $p){
				$fc=mb_substr($p,0,1,'UTF-8');
				$fc = Text::toUpper($fc);
				$oc=mb_substr($p,1,strlen($p),'UTF-8');
				$w[] = $fc. Text::toLower($oc);
			}
			return implode(" ",$w);
		}
		static function fixChars($e){
			$old = array("ı","İ","ğ","Ğ","ü","Ü","ş","Ş","ö","Ö","ç","Ç");
			$new = array("i","I","g","G","u","U","s","S","o","O","c","C");
			return str_replace($old,$new,$e);
		}
		static function clearSpecialChars($e){
			return preg_replace('/[^A-Za-z0-9ıİğĞüÜşŞöÖçÇ ]/', '', $e);
		}
		static function truncate($text,$size,$seperattor = " "){
			return substr( $text, 0, strpos($text, $seperattor, $size) );
		}



		static function formatFirstName($e){
			return Text::toUpFirst($e) ;
		}
		static function formatLastName($e){
			return Text::toUpper($e);
		}
		static function formatFullName($n){
			$p = explode(" ",$n);
			$l = array_pop($p);
			$l = Text::formatLastName($l);
			$f = Text::formatFirstName(implode(" ",$p)) ;
			return "$f $l";
		}

		static function formatPhone($e){
			$e = preg_replace('/[^0-9]/','',$e);
			if(strlen($e) > 11) {
				$countryCode = substr($e, 0, strlen($e)-10);
				$areaCode = substr($e, -10, 3);
				$nextThree = substr($e, -7, 3);
				$lastFour = substr($e, -4, 4);
				$e = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
			}
			else if(strlen($e) == 11) {
				$areaCode = substr($e, -11, 4);
				$nextThree = substr($e, -7, 3);
				$lastFour = substr($e, -4, 4);
				$e = $areaCode.' '.$nextThree.' '.$lastFour;
			}
			else if(strlen($e) == 10) {
				$areaCode = substr($e, 0, 3);
				$nextThree = substr($e, 3, 3);
				$lastFour = substr($e, 6, 4);
				$e = "0".$areaCode.' '.$nextThree.' '.$lastFour;
			}
			else if(strlen($e) == 7) {
				$nextThree = substr($e, 0, 3);
				$lastFour = substr($e, 3, 4);
				$e = $nextThree.'-'.$lastFour;
			}
			return $e;
		}

	}
