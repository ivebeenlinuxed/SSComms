<?php 
if ($_SERVER['HTTP_X_REQUESTED_WITH'] == "XMLHttpRequest") {
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



<script type="text/javascript" src="/plugins/boiler/utils.js"></script>
<script type="text/javascript" src="/plugins/boiler/api/text-instant.js"></script>

<script type="text/javascript" src="/plugins/boiler/api/main_ajax.js"></script>
<script type="text/javascript" src="/plugins/jquery-pjax/jquery.pjax.js"></script>


<script type="text/javascript" src="/plugins/boiler/widget/search_expression/search_expression.js"></script>
<script type="text/javascript" src="/plugins/boiler/widget/tooltip-loader.js"></script>
<script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.min.js"></script>



<script type="text/javascript" src="/js/widget/home_activations.js"></script>
<script type="text/javascript" src="/js/deactivate.js"></script>
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
