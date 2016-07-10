<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Check In Assets</h4>
		</div>
		<div class="modal-body">
			<div class="asset_lister" id="asset-in-lister">
			
			</div>
			<button id="change_asset_in_complete" class="btn pull-right btn-primary">Check In</button>
			<div class="clearfix" />
			<script type="text/javascript">
			al = new AssetListbox(document.querySelector("#asset-in-lister"));
			document.querySelector("#change_asset_in_complete").addEventListener("click", () => {
				var fd = new FormData();
				var assets = new Array();
				for (var i=0; i<al.selected_assets.length; i++) {
					assets.push(al.selected_assets[i].id);
				}
				fd.append("assets", JSON.stringify(assets));
				
				fetch("/widget/livehelper/asset_change/in_save", {
					credentials: "include",
					body: fd,
					method: "post"
			}).then(() => {
					$("#api-modal").modal('hide');
			});
			});
			</script>
		</div>
	</div>
	
</div>