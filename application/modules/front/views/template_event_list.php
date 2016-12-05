<div ng-repeat="sp in shop.event_list" class="col-md-3 col-sm-6 col-xs-12">
	<div class="thumbnail event">
      <img src="http://www.skiheavenly.com/~/media/heavenly/images/732x260%20header%20images/events-heavenly-header.ashx" alt="...">
      <div class="caption">
        <h3>{{sp.event_name}}</h3>
        <p><strong>on</strong> {{sp.event_startdate | date : 'mediumDate'}} to {{sp.event_enddate | date : 'mediumDate'}}</p>
        <p>{{sp.event_location}}</p>
        <br /><a class="btn btn-primary btn-block" role="button" ng-click="vm.bookPlace(sp)">Book Your Place</a>
      </div>
    </div>		
</div>