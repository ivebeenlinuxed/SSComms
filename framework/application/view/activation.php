<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/top");
?>
<table class="table table-striped table-bordered" id="home-activations-table">
				<thead>
					<tr>
						<th>Phone Number</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
<?php
\Core\Router::loadView("api/html/_template/" . \Core\Router::$disposition . "/bottom");
?>