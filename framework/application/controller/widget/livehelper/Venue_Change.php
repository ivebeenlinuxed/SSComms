<?php

namespace Controller\Widget\LiveHelper;

use Library\Live\TileResult;
use Library\Live\Tile;
use Library\Live\TileAction;

class Venue_Change {
	public static function GetTileResult($since) {
		$tr = new TileResult ();
		
		$start_date = new \DateTime ();
		$start_date->setTime ( 0, 0, 0 );
		$end_date = clone $start_date;
		$end_date->add ( new \DateInterval ( "P1D" ) );
		
		$ev_select = \Model\Event::getDB ()->Select ( \Model\Event::class );
		$ev_filter = $ev_select->getAndFilter ();
		$ev_filter->gt ( "end", $start_date->getTimestamp () );
		$ev_filter->lt ( "start", $end_date->getTimestamp () );
		$ev_filter->neq ( "status", \Model\Event::STATUS_ASPLANNED );
		
		$ev_select->setFilter ( $ev_filter );
		$ev_select->addCount ( "c" );
		$ev_row = $ev_select->Exec () [0];
		
		$tile = new Tile ();
		$tile->title = "Event Changes";
		$tile->description = "There are {$ev_row['c']} event changes today";
		
		$tile_action_view = new TileAction ();
		$tile_action_view->label = "View Programme";
		$tile_action_view->action = "/widget/livehelper/venue_change/programme";
		$tile_action_view->action_disposition = TileAction::DISPOSITION_MODAL;
		$tile->actions [] = $tile_action_view;
		
		$tile_action_view = new TileAction ();
		$tile_action_view->label = "Show Venues";
		$tile_action_view->action = "/api/venue";
		$tile_action_view->action_disposition = TileAction::DISPOSITION_LINK;
		$tile->actions [] = $tile_action_view;
		
		$tr->current_information [] = $tile;
		
		return $tr;
	}
	public function programme() {
		\Core\Router::loadView ( "live/helper/venue_change/programme" );
	}
}