<?php
/**
 * Controls a widget which renders threads
 *
 * PHP version 5.4
 *
 * @category Widget
 * @package  Intranet
 * @author   Will Tinsdeall <will.tinsdeall@mercianlabels.com>
 * @license  GNU v3.0 http://www.gnu.org/licenses/gpl-3.0.txt
 * @link     http://www.mercianlabels.com
 */
namespace Controller\Widget;


/**
 * Controls a widget that renders threads/streams/social wall
 *
 * PHP version 5.4
 *
 * @category Widget
 * @package  Boiler
 * @author   Will Tinsdeall <will.tinsdeall@mercianlabels.com>
 * @license  GNU v3.0 http://www.gnu.org/licenses/gpl-3.0.txt
 * @version  GIT: $Id$
 * @link     http://www.mercianlabels.com
 */
class Feed {
	public $num_posts = 15;
	
	public $edit_mode = true;
	
	public $title = true;
	
	/**
	 * Displays the feed widget
	 * 
	 * @param int|\Model\Thread $thread The thread to display
	 * 
	 * @return null
	 */
	public function index($thread) {
		if (!is_object($thread)) {
			$thread = new \Model\Thread($thread);
		}
		
		
		\Core\Router::loadView("widget/feed/stream", array(
				"controller"=>$this,
				"thread"=>$thread,
				"ajax_update"=>isset($_GET['update'])
		));
	}
	
	public function post() {
		\Model\ThreadPost::Create(array(
				"thread"=>$_POST['thread'],
				"message"=>$_POST['message'],
				"person"=>\Core\Router::getCurrentPerson()->id,
				"date"=>time()
		));
	}
	
	/**
	 * Displays a comment
	 * 
	 * @param int|\Model\ThreadPost $comment The comment, or ID number of it to post
	 * 
	 * @return null
	 */
	public function render_comment($comment) {
		if (!is_object($comment)) {
			$comment = new \Model\ThreadPost($comment);
		}
		\Core\Router::loadView("widget/feed/comment", array(
				"comment"=>$comment,
				"current_user"=>\Core\Router::getCurrentUser(),
				"user"=>$comment->getUser()
		));
	}
	
	/**
	 * Displays a modal showing everyone who starred a post
	 * 
	 * @param int|\Model\ThreadPost $post The post to see who starred
	 * 
	 * @return null
	 */
	public function star_modal($post) {
		if (!is_object($post)) {
			$post = new \Model\ThreadPost($post);
		}
		\Core\Router::loadView("widget/feed/star_modal", array(
			"stars"=>$post->getThreadPostStars()	
		));
	}
	
	/**
	 * Render a post into the feed
	 * 
	 * @param int|\Model\ThreadPost $post The post to render
	 * 
	 * @return null
	 */
	public function render_post($post) {
		if (!is_object($post)) {
			$post = new \Model\ThreadPost($post);
		}
		$user = $post->getPerson();
		$current_user = \Core\Router::getCurrentPerson();
		
		\Core\Router::loadView("widget/feed/post", array(
				"controller"=>$this,
				"post"=>$post,
				"user"=>$user,
				"current_user"=>$current_user,
				"comments"=>$post->getThreadPosts(),
				"stars"=>$post->getThreadPostStars()
		));
	}
	
	/**
	 * Toggle the logged in users star on the post
	 * 
	 * @param int|\Model\ThreadPost $post The post to star/unstar
	 * 
	 * @return null
	 */
	public function toggle_star($post) {
		$current_user = \Core\Router::getCurrentUser();
		$post = new \Model\ThreadPost($post);
		$post->ToggleStarByUser($current_user);
	}
	
	/**
	 * Render the 'X, Y and 2 others starred this' line
	 * 
	 * @param uint|\Model\ThreadPost $post The post
	 * 
	 * @return null
	 */
	public function star_line($post) {
		$current_user = \Core\Router::getCurrentUser();
		if (!is_object($post)) {
			$post = new \Model\ThreadPost($post);
		}
		$out = array();
		$out['is_starred'] = $post->isStarredByUser($current_user);
		$out['star_text'] = $this->getStarLineText($post);
		$out['count'] = count($post->getThreadPostStars());
		echo json_encode($out);
	}
	
	/**
	 * Backend function to get the line of starring text
	 * 
	 * @param int|\Model\ThreadPost $post The post to generate the star text for
	 * 
	 * @return null
	 */
	public function getStarLineText($post) {
		$max_names = 4;
		
		if (!is_object($post)) {
			$post = new \Model\ThreadPost($post);
		}
		$stars = $post->getThreadPostStars();
		
		if (count($stars) == 0) {
			return "No stars yet...";
		}
		
		foreach ($stars as $key=>$star) {
			$stars[$key]->strtime = strtotime($star->date);
		}
		$stars = \System\Library\StdLib::object_order($stars, "strtime");

		
		
		$current_user = \Core\Router::getCurrentUser();
		$user_str = array();
		if ($post->isStarredByUser($current_user)) {
			$first_user = true;
			$user_str[] = "<a href='".PUBLIC_ROOT."/api/user/{$current_user->staff_number}'>You</a>";
		}
		
		$i = 0;
		while (count($user_str) < $max_names && $i < count($stars)) {
			if ($stars[$i]->user == $current_user->staff_number) {
				$i++;
				continue;
			}
			
			$user = $stars[$i]->getUser();
			
			$user_str[] = "<a href='".PUBLIC_ROOT."/api/user/{$user->staff_number}'>{$user->getName()}</a>";
			$i++;
		}
		
		if ((count($stars)-count($user_str)) > 0) {
			$user_str[] = "<a href='".PUBLIC_ROOT."/widget/feed/star_modal/{$post->id}' data-type='api-modal'>".(count($stars)-count($user_str))." others</a>";
		}
		
		$out = "";
		foreach ($user_str as $key=>$usr) {
			if (strlen($out) > 0 && count($user_str)-1 == $key) {
				$out .= " and ";
			} elseif (strlen($out) > 0) {
				$out .= ", ";
			}
			$out .= $usr;
		}
		
		$out .= " starred this";
		return $out;
	}
	
	/**
	 * Displays a modal which allows you to attach a document to the post
	 * 
	 * @return null
	 */
	public function attach() {
		\Core\Router::loadView("widget/feed/attach");
	}
	
	/**
	 * Renders a modal which allows you to update a document
	 * 
	 * @param int $id ID of the document to update
	 * 
	 * @return null
	 */
	public function update($id) {
		$doc = new \Model\UserDocument($id);
		\Core\Router::loadView("widget/feed/update", array(
				"doc"=>$doc
		));
	}
	
	/**
	 * Display a lightbox presentation of all the pictures on a post
	 * 
	 * @param int|\Model\ThreadPost $post The post to get pictures for
	 * 
	 * @return null
	 */
	public function lightbox($post) {
		if (!is_object($post)) {
			$post = new \Model\ThreadPost($post);
		}
		$pics = $post->getUserDocumentsByType(\Model\ThreadPost::USER_DOCUMENT_TYPE_PICTURE);
		$id = 0;
		if ($_GET['id']) {
			$id = (int)$_GET['id'];
		}
		$next_id = $id+1;
		$prev_id = $id-1;
		if ($next_id >= count($pics)) {
			$next_id = 0;
		}
		
		if ($prev_id < 0) {
			$prev_id = count($pics)-1;
		}
		
		\Core\Router::loadView("widget/feed/lightbox", array(
			"post"=>$post,
			"current_id"=>$id,
			"next_id"=>$next_id,
			"prev_id"=>$prev_id,
			"picture"=>$pics[$id],
			"pics"=>$pics,
			"id"=>$id
		));
	}
	
	/**
	 * Download a specific file to the clients PC
	 * 
	 * @param int $id ID of the file version to download
	 * 
	 * @return null
	 */
	public function download($id) {
		$v = new \Model\FileVersion($id);
		//FIXME Check if file version is a UserDocument
		if (!isset($_GET['noattach'])) {
			header('Content-Disposition: attachment; filename="' . $v->getFile()->name . '"');
		}
		header("Content-Type: " . $v->getMimeType());
		$v->RegisterDownload(\Core\Router::getCurrentUser());
		echo file_get_contents($v->getFullPath());
	}
}