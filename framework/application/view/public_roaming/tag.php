<?php
\Core\Router::loadView("api/html/_template/unauth/top");
?>
<style type="text/css">
@keyframes fader {
    from {opacity: 0;}
    to {opacity: 1;}
}

#asset-list a {
	animation: fader 2s;
}
</style>
<h1 class="text-center">Hello Stranger!</h1>
<p class="text-center">It seems like you've got a Soul Survivor asset! Keep scanning everything you have, then scan the QR code on your badge to assign them to you!</p>
<div class="list-group" id="asset-list">
  <a href="#" id="nothing-item" class="list-group-item">
    <h4 class="list-group-item-heading">Nothing Scanned Yet...</h4>
    <p class="list-group-item-text">Use your phone camera to scan some assets</p>
  </a>
</div>
<template id="asset-item-templ">
  <a href="#" class="list-group-item">
    <h4 class="list-group-item-heading">Radio 123456</h4>
    <p class="list-group-item-text">Currently signed out to Will Tinsdeall</p>
  </a>
</template>
<div class="text-center">
	<video id="video" width="640" height="480" autoplay></video>
	<canvas id="canvas" width="640" height="480" style="display: none;"></canvas>
</div>

<script src="/node_modules/qrcode-reader/dist/browser.js"></script>
<script src="/js/tag.js"></script>
<?php
\Core\Router::loadView("api/html/_template/unauth/bottom");
?>
