<div class="col-md-12">
	<h4>{{ eventname }}</h4>
	<p>{{ keyword }}</p>
	<div id="myMaps" class="hidden"></div>
</div>
<div class="modal fade" id="reservationModal" tabindex="-1" role="dialog" aria-labelledby="reservationModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?php echo site_url('reserve_stand'); ?>" method="POST">
      <input type="hidden" name="event_id" id="event_id" />
      <input type="hidden" name="stand_id" id="stand_id" />
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="reservationModalLabel">Stands</h4>
      </div>
      <div class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Reserve Stands">
      </div>
      </form>
    </div>
  </div>
</div>