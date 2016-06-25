<?php
namespace Controller;

class Public_Roaming {
	public function tag($id=null) {
		\Core\Router::loadView("public_roaming/tag");
	}
	
	public function make_tag($id=0) {
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		$tag = \Model\BarcodeTag($id);
		    # creates a cipher text compatible with AES (Rijndael block size = 128)
		    # to keep the text confidential 
		    # only suitable for encoded input that never ends with value 00h
		    # (because of default zero padding)
		    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, \Core\Router::$settings['secret'],
				                 $tag->id.":".$tag->asset_type.":".$tag->asset_id, MCRYPT_MODE_CBC, $iv);

		    # prepend the IV for it to be available for decryption
		    $ciphertext = $iv . $ciphertext;
		    
		    # encode the resulting cipher text so it can be represented by a string
		    $ciphertext_base64 = base64_encode($ciphertext);
	}
	
	public function lookup_tag($ciphertext_base64) {
		$ciphertext_dec = base64_decode($ciphertext_base64);
    
		    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
		    $iv_dec = substr($ciphertext_dec, 0, $iv_size);
		    
		    # retrieves the cipher text (everything except the $iv_size in the front)
		    $ciphertext_dec = substr($ciphertext_dec, $iv_size);

		    # may remove 00h valued characters from end of plain text
		    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, \Core\Router::$settings['secret'],
				                    $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
			$e = explode(":", $plaintext_dec);
			if (count($e) != 3) {
				echo json_encode(array());
				return;
			}
			$tag = \Model\BarcodeTag($id);
			if ($tag->asset_type != $e[1] || $tag->asset_id != $e[2]) {
				echo json_encode(array());
				return;
			}
			
			$out = array("tag"=>$tag);
			switch ($tag->asset_type) {
				case \Model\BarcodeAsset::ASSET_TYPE_PERSON:
					$p = new \Model\Person($tag->asset_id);
					$out['asset'] = array("first_name"=>$p->first_name);
				case \Model\BarcodeAsset::ASSET_TYPE_EQUIPMENT:
					$e = new \Model\Equipment($tag->asset_id);
					if ($e->isCheckedOut()) {
						$checkout = $e->getCurrentCheckout();
						$out['keyholder'] = $checkout->first_name;
						$out['checkout_time'] = $checkout->checkout;
					}
					$out['asset'] = array(
						"id"=>$e->id,
						"name"=>$e->name,
						"category"=>$e->getCategory()->name;
					);
					
			}
	}
}
?>
