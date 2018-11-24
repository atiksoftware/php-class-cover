<?php

	namespace Atiksoftware\Cover;

	class Arr
	{
		/**
		 * Array Notation ile bir array içinden verileri "user.props.name" şeklinde alın veya yazın
		 *
		 * @param array array nesnesi
		 * @param string anahtar
		 * @param object yeni değer (opsiyones)
		 * 
		 * @return array arrayı geri döndürür
		 */
		static public function Not(){
			$args = func_get_args(); 
			$array = &$args[0];
			$key = $args[1];
			if(count($args) > 2){
				$value = $args[2];
				$array = self::NotationSet($array,$key,$value); 
			}
			return self::NotationGet($array,$key);
		} 

		/**
		 * Get an item from an array using "dot" notation.
		 *
		 * @param  \ArrayAccess|array  $array
		 * @param  string  $key
		 * @param  mixed   $default
		 * @return mixed
		 */
		public static function NotationGet($array, $key, $default = null)
		{
			if (! static::NotationAccessible($array)) {
				return value($default);
			}
			if (is_null($key)) {
				return $array;
			}
			if (static::NotationExists($array, $key)) {
				return $array[$key];
			}
			if (strpos($key, '.') === false) {
				return $array[$key] ?? value($default);
			}
			foreach (explode('.', $key) as $segment) {
				if (static::NotationAccessible($array) && static::NotationExists($array, $segment)) {
					$array = $array[$segment];
				} else {
					return value($default);
				}
			}
			return $array;
		}

		/**
		 * Set an array item to a given value using "dot" notation.
		 *
		 * If no key is given to the method, the entire array will be replaced.
		 *
		 * @param  array   $array
		 * @param  string  $key
		 * @param  mixed   $value
		 * @return array
		 */
		public static function NotationSet(&$array, $key, $value) {
			if (is_null($key)) {
				return $array = $value;
			} 
			$keys = explode('.', $key); 
			while (count($keys) > 1) {
				$key = array_shift($keys);  
				if (! isset($array[$key]) || ! is_array($array[$key])) {
					$array[$key] = [];
				} 
				$array = &$array[$key];
			} 
			$array[array_shift($keys)] = $value; 
			print_r($array);
			exit;
			return $array;
		}
		/**
		 * Determine whether the given value is array accessible.
		 *
		 * @param  mixed  $value
		 * @return bool
		 */
		public static function NotationAccessible($value)
		{
			return is_array($value) || $value instanceof ArrayAccess;
		}
		/**
		 * Determine if the given key exists in the provided array.
		 *
		 * @param  \ArrayAccess|array  $array
		 * @param  string|int  $key
		 * @return bool
		 */
		public static function NotationExists($array, $key)
		{
			if ($array instanceof ArrayAccess) {
				return $array->offsetExists($key);
			}
			return array_key_exists($key, $array);
		}


	}
