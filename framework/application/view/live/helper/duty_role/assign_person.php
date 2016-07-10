<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal"
				aria-hidden="true">&times;</button>
			<h4 class="modal-title">Who do you wish to assign?</h4>
		</div>
		<div class="modal-body">
			<div class="" id="assign-role-person">
			
			</div>
			<script type="text/javascript">
			p = new PersonSearcher(document.querySelector("#assign-role-person"));
			p.onselect = function(person) {
				fireAPIModal("/widget/livehelper/duty_role/assign_role/"+person.id);
			};
			</script>
		</div>
	</div>
	
</div>