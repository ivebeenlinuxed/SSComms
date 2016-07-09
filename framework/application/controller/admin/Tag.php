<?php
namespace Controller\Admin;

class Tag {
	public function index() {
		if (isset($_POST['tag_size'])) {
			if (($tag_start = (\Model\SystemConfiguration::Get("tag.start_number"))) == null) {
				$tag_start = \Model\SystemConfiguration::Set("tag.start_number", 10000000);
			}
			
			$zip = new \ZipArchive();
			$zip->open(BOILER_TMP."/download_{$tag_start}.zip", \ZipArchive::CREATE);
			$tag_number = $tag_start;
			for ($i=0; $i<(int)$_POST['tag_count']; $i++) {
				$t = new \Library\BarcodeTag($tag_number);
				$t->size = (int)$_POST['tag_size'];
				$t->Generate($file = BOILER_TMP."/tag_{$tag_number}.png");
				$zip->addFile($file, "tag_{$tag_number}.png");
				$tag_number++;
				
			}
			$zip->close();
			for ($i=0; $i<(int)$_POST['tag_count']; $i++) {
				unlink(BOILER_TMP."/tag_".($i+$tag_start).".png");
			}
			//return;
			header("Content-Type: application/zip");
			header("Content-Disposition: attachment; filename=download_{$tag_start}.zip");
			echo file_get_contents(BOILER_TMP."/download_{$tag_start}.zip");
			\Model\SystemConfiguration::Set("tag.start_number", $tag_number);
		}
		
		\Core\Router::loadView("admin/tag/index");
		
	}
}
