<?php
\Core\Router::loadView("api/html/_template/offline/top");
?>
<h1 class="text-center">Soul Survivor Comms <small>Offline</small></h1>
<div class="alert alert-info">
<strong>We've detected your offline!</strong> We've saved the tasks below from last time you were online.
However, if you were expecting something else, try going online for a bit so the app to sync
new tasks.
</div>
Choose an action:
<ul id="offline_actions">
</ul>
<?php
\Core\Router::loadView("api/html/_template/offline/bottom");
?>
