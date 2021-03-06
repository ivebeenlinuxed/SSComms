<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Give Assets to <?= $person->getName() ?></h4>
		</div>
		<div class="modal-body">
			<input type="hidden" id="asset-out-lister-person" value="<?= $person->id ?>" />
			<div class="asset_lister" id="asset-out-lister">
			
			</div>
			<button id="change_asset_list_complete" class="btn pull-right btn-primary">Check Out</button>
			<div class="clearfix" />
			<script type="text/javascript">
			al = new AssetListbox(document.querySelector("#asset-out-lister"));
			document.querySelector("#change_asset_list_complete").addEventListener("click", () => {
				var fd = new FormData();
				var assets = new Array();
				for (var i=0; i<al.selected_assets.length; i++) {
					assets.push(al.selected_assets[i].id);
				}
				fd.append("assets", JSON.stringify(assets));
				fd.append("user", document.querySelector("#asset-out-lister-person").value);
				
				fetch("/widget/livehelper/asset_change/save_out", {
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