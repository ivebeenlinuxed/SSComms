<?php
namespace Controller;

class Public_Roaming {
	public function tag($id=null) {
		\Core\Router::loadView("public_roaming/tag");
	}
	
	public function lookup_tag() {
		$ciphertext_base64 = $_GET['tag'];
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$ciphertext_dec = base64_decode($ciphertext_base64);
    
		    # retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
		    $iv_dec = substr($ciphertext_dec, 0, $iv_size);
		    
		    # retrieves the cipher text (everything except the $iv_size in the front)
		    $ciphertext_dec = substr($ciphertext_dec, $iv_size);

		    # may remove 00h valued characters from end of plain text
		    $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, \Core\Router::$settings['secret'],
				                    $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
			$e = explode(":", trim($plaintext_dec));
			if (count($e) != 3) {
				echo json_encode(array());
				return;
			}
			$tag = new \Model\BarcodeTag($e[0]);
			
			if ($tag->asset_type != $e[1] || $tag->asset_id != $e[2]) {
				echo json_encode(array());
				return;
			}
			
			$out = array("tag"=>$tag);
			switch ($tag->asset_type) {
				case \Model\BarcodeTag::ASSET_TYPE_PERSON:
					$p = new \Model\Person($tag->asset_id);
					$out['asset'] = array("first_name"=>$p->first_name);
					break;
				case \Model\BarcodeTag::ASSET_TYPE_EQUIPMENT:
					$e = new \Model\Equipment($tag->asset_id);
					if ($e->isCheckedOut()) {
						$checkout = $e->getCurrentCheckout();
						$out['keyholder'] = $checkout->getPerson()->first_name;
						$out['checkout_time'] = $checkout->checkout;
					}
					$out['asset'] = array(
						"id"=>$e->id,
						"name"=>$e->name,
						"category"=>$e->getCategory()->name
					);
					break;
					
			}
			echo json_encode($out);
	}
}
?>
