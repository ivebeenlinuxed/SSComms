<?php

namespace Library;

class BarcodeTag {
	public $id;
	public $size = 1;
	public function __construct($id) {
		$this->id = $id;
	}
	private function CryptoQR($id, $file) {
		$iv_size = mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
		$iv = mcrypt_create_iv ( $iv_size, MCRYPT_RAND );
		// creates a cipher text compatible with AES (Rijndael block size = 128)
		// to keep the text confidential
		// only suitable for encoded input that never ends with value 00h
		// (because of default zero padding)
		$ciphertext = mcrypt_encrypt ( MCRYPT_RIJNDAEL_128, \Core\Router::$settings ['secret'], $id . ":" . rand ( 1, 100000 ), MCRYPT_MODE_CBC, $iv );
		
		// prepend the IV for it to be available for decryption
		$ciphertext = $iv . $ciphertext;
		
		// encode the resulting cipher text so it can be represented by a string
		$ciphertext_base64 = base64_encode ( $ciphertext );
		\Library\QRcode::png ( "http://sscomms.bluelightstudios.co.uk/public_roaming/tag?tag=" . urlencode ( $ciphertext_base64 ), $file, QR_ECLEVEL_L, 6 );
	}
	public static function Decrypt($tag_crypt) {
		$ciphertext_base64 = $tag_crypt;
		$iv_size = mcrypt_get_iv_size ( MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC );
		$ciphertext_dec = base64_decode ( $ciphertext_base64 );
		
		// retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
		$iv_dec = substr ( $ciphertext_dec, 0, $iv_size );
		
		// retrieves the cipher text (everything except the $iv_size in the front)
		$ciphertext_dec = substr ( $ciphertext_dec, $iv_size );
		
		// may remove 00h valued characters from end of plain text
		$plaintext_dec = mcrypt_decrypt ( MCRYPT_RIJNDAEL_128, \Core\Router::$settings ['secret'], $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec );
		$e = explode ( ":", trim ( $plaintext_dec ) );
		if (count ( $e ) != 2) {
			return null;
		} else {
			return $e[0];
		}
		
		
	}
	public function Generate($file) {
		if ($this->size == 2) {
			$imgres = imagecreate ( 400, 500 );
			
			
			$generator = new \Library\Barcode\BarcodeGeneratorPNG();
			file_put_contents($barcode_file = BOILER_TMP . "/barcode_{$this->size}_{$this->id}.png", $generator->getBarcode($this->id, $generator::TYPE_CODE_128, 2, 120));
			imagecopy ( $imgres, imagecreatefrompng ( $barcode_file ), 20, 300, 0, 0, 354, 180 );
			$this->CryptoQR($this->id, $qr_file = BOILER_TMP."/qr_{$this->size}_{$this->id}.png");
			imagecopy ( $imgres, imagecreatefrompng ( $qr_file ), 50, 0, 0, 0, 294, 294);
		
			imagepng ( $imgres, $file );
			unlink($qr_file);
			unlink($barcode_file.".png");
		} else {
			$generator = new \Library\Barcode\BarcodeGeneratorPNG();
			file_put_contents($file, $generator->getBarcode($this->id, $generator::TYPE_CODE_128, 2, 120));
			//$b = new Barcode ();
			//$b->setScale ( 2 );
			//$b->setSymblogy("I25");
			//$b->setFont ( BOILER_HTDOCS . "/font/arial.ttf" );
			//$b->genBarCode ( $this->id, "png", substr($file, 0, -4) );
		}
	}
}
