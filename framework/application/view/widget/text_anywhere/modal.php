<form class="modal-dialog" method="post" action="/widget/text_anywhere/send">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Send a Text</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
        	<label class="col-xs-2">Recipients</label>
        	<div class="col-xs-10">
        		<?php
        		$people_select = array();
        		foreach ($recipients as $recipient) {
        			$people_select[] = $recipient->id;
        		?>
        		<span class="label label-<?php echo $recipient->isPhoneValid()? "success" : "danger" ?>">
        			<?php echo $recipient->getName() ?> (<?php echo $recipient->getFormattedPhone() ?>)
        		</span>&nbsp;
        		<?php
        		}
        		?>
        	</div>
        	<input type="hidden" name="recipients" value="<?php echo implode(":", $people_select) ?>" />
        </div>
        <textarea class="form-control" name="message"><?php echo $message ?></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" value="Send" class="btn btn-primary" />
      </div>
    </div><!-- /.modal-content -->
  </form><!-- /.modal-dialog -->
