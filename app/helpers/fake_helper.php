<?php
defined('PREVENT_DIRECT_ACCESS') or exit('No direct script access allowed');


if (!function_exists('randHash')) {
	function randHash($len=32)
	{
		return substr(md5(openssl_random_pseudo_bytes(20)),-$len);
	}
}

/**
 * 
 */
if (!function_exists('encryptor')) {
	function encryptor($action, $string, $key = 19942024) {
		$output = false;

		$encrypt_method = "AES-256-CBC";
		//Please set your unique hashing key
		$secret_key = $key;
		//Initialization Vector 
		$i_vector = 'gBin' . $key;

		// hash
		$key = hash('sha256', $secret_key);

		// IV - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $i_vector), 0, 16);

		//do the encyption given text/string/number
		if( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		}
		else if( $action == 'decrypt' ){
			//decrypt the given text/string/number
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}

		return $output;
	}
}

/**
 * 
 */
if (!function_exists('encode')) {
	function encode($text)
	{
		$id = (float)$text * 1994;
		return base64_encode($id);
	}
}

/**
 * 
 */
if (!function_exists('decode')) {
	function decode($text)
	{
		$url_id = base64_decode($text);
		return (float)$url_id / 1994;
	}
}

/**
 * 
 */
if (!function_exists('encrypt_text')) {
    function encrypt_text($text, $key = 1994)
    {
        $key = hex2bin($key);
		$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
		$nonce = openssl_random_pseudo_bytes($nonceSize);
		$ciphertext = openssl_encrypt(
			$text,
			'aes-256-ctr',
			$key,
			OPENSSL_RAW_DATA,
			$nonce
		);
		return base64_encode($nonce . $ciphertext);
    }
}

/**
 * 
 */
if (!function_exists('decrypt_text')) {
    function decrypt_text($text, $key = 1994)
    {
        $key = hex2bin($key);
		$message = base64_decode($text);
		$nonceSize = openssl_cipher_iv_length('aes-256-ctr');
		$nonce = mb_substr($message, 0, $nonceSize, '8bit');
		$ciphertext = mb_substr($message, $nonceSize, null, '8bit');
		$plaintext = openssl_decrypt(
			$ciphertext,
			'aes-256-ctr',
			$key,
			OPENSSL_RAW_DATA,
			$nonce
		);
		return $plaintext;
    }
}
