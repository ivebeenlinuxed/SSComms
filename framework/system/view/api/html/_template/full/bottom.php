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


<script type="text/javascript" src="/plugins/boiler/widget/WidgetFactory.js"></script>
<link rel="import" href="/util/widget/loader/<?php echo \Library\Widget\Widget::TEXT ?>" />



<script type="text/javascript" src="/plugins/boiler/utils.js"></script>
<script type="text/javascript" src="/plugins/boiler/api/text-instant.js"></script>

<script type="text/javascript" src="/plugins/boiler/api/main_ajax.js"></script>
<script type="text/javascript" src="/plugins/jquery-pjax/jquery.pjax.js"></script>


<script type="text/javascript" src="/plugins/boiler/widget/search_expression/search_expression.js"></script>
<script type="text/javascript" src="/plugins/boiler/widget/tooltip-loader.js"></script>
<script type="text/javascript" src="/plugins/bootstrap/js/bootstrap.min.js"></script>

<link rel="import" href="/widget/text/loader" />

</body>
</html>
