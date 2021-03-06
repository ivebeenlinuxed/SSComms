<?php 
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
	return;
}
?>
</div>
	<div class="container">
		<footer>
			<hr>
			<p>&copy; William Tinsdeall 2014</p>
		</footer>
</div>
<div id="api-modal" class="modal fade modal-maxi">

</div>


<script src="/plugins/autobahn/autobahn.js"></script>
<script src="/plugins/boiler/api/RTCQueue.js"></script>
<script src="/plugins/toastr/toastr.js"></script>
<script src="/plugins/toastr/toastr.js"></script>
<script src="/js/fastkey.js"></script>
<script src="/js/widget/home_asset.js"></script>
<script src="/js/widget/home_person.js"></script>
<script src="/js/offline/venue_check_online.js"></script>
<script src="/js/widget/feed.js"></script>



<script type="text/javascript" src="/plugins/boiler/utils.js"></script>
<script type="text/javascript" src="/plugins/boiler/api/text-instant.js"></script>

<script type="text/javascript" src="/plugins/boiler/api/main_ajax.js"></script>
<script type="text/javascript" src="/plugins/jquery-pjax/jquery.pjax.js"></script>


<script type="text/javascript" src="/plugins/boiler/widget/search_expression/search_expression.js"></script>
<script type="text/javascript" src="/plugins/boiler/widget/tooltip-loader.js"></script>
<script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.min.js"></script>



<script type="text/javascript" src="/js/widget/home_activations.js"></script>
<script type="text/javascript" src="/js/widget/homehelper/radio_group.js"></script>
<script type="text/javascript" src="/js/deactivate.js"></script>


<script type="text/javascript" src="/js/widget/live.js"></script>


<link rel="import" id="person-searcher-import" href="/widget/person_searcher/template">
<script type="text/javascript" src="/js/widget/person_searcher.js"></script>



<link rel="import" id="asset-listbox-import" href="/widget/asset_listbox/template">
<script type="text/javascript" src="/js/widget/asset_listbox.js"></script>

<template id="home-activations-template">
<tr>
	<td></td>
	<td></td>
	<td></td>
	<td><div class="input-group">
			<input type="text" class="form-control home-activations-active" placeholder="Activation Code">
			<span class="input-group-btn">
				<button class="btn btn-default home-activations-active" type="button">Activate!</button>
			</span>
		</div> <!-- /input-group --></td>
</tr>
</template>
<iframe id='manifest_iframe_hack' 
  style='display: none;' 
  src='/offline/manifest_iframe.html'>
</iframe>
</body>
</html>
