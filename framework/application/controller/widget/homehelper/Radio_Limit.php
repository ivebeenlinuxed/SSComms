<?php
namespace Controller\Widget\Homehelper;

class Radio_Limit {
	public $team_allocations = array(14=>5, 37=>2, 49=>15, 50=>4, 59=>3, 38=>25, 19=>7, 57=>9, 58=>4);
	
	public function getAlerts($asset, $person) {
		$alerts = array();
		if (!$person || !$asset || $asset->category != 2) {
			return $alerts;
		}
		$team = $person->getTeam();
		
		$db = \Model\Team::getDB();
					$rows = $db->Exec(<<<EOF
SELECT COUNT(*) AS number, team.name AS team_name
FROM equipment
LEFT JOIN equipment_category ON equipment.category = equipment_category.id
LEFT JOIN equipment_checkout ON equipment.id = equipment_checkout.equipment
LEFT JOIN person ON equipment_checkout.person = person.id
LEFT JOIN team ON person.team = team.id
WHERE equipment_checkout.checkin=0 AND equipment_category.id=2 AND team.id={$team->id} GROUP BY team.id ORDER BY number DESC
EOF
);
		
		if (isset($this->team_allocations[$team->id]) && $this->team_allocations[$team->id] >= $rows[0]['number']) {
			$alerts[] = \Core\Router::getView("widget/homehelper/radio_limit/alert", array("team"=>$team, "person"=>$person, "allocation"=>$this->team_allocations[$team->id], "out"=>$rows[0]['number']));
		}
		return $alerts;
	}
}
