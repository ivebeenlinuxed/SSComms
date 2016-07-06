<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Who is the asset going to?</h4>
		</div>
		<div class="modal-body">
			<div class="person_searcher" id="asset-out-person">
			
			</div>
			<script type="text/javascript">
			p = new PersonSearcher(document.querySelector("#asset-out-person"));
			p.onselect = function(person) {
				fireAPIModal("/widget/livehelper/asset_change/change_asset_list/"+person.id);
			};
			</script>
		</div>
	</div>
	
</div>