<?php
/**
 * @Author: amydinsyahira
 * @Date:   2016-10-18 13:03:34
 * @Last Modified by:   ayipzz
 * @Last Modified time: 2016-10-20 06:31:01
 */
?>
<div id="fullpage" class="map-container">
	<ng-map center="-7.8032491,110.3398252" zoom="9" disable-default-u-i="true" zoom-control="true" scale-control="false" scrollwheel="false" style="height:500px">
		<marker id='{{shop.id}}' position="{{shop.event_map}}"
        ng-repeat="shop in vm.shops"
        on-click="vm.showDetail(shop)" ng-init="count=0">
      </marker>
	</ng-map>
	<div class="event-list">
		<div event-header class="event-header hidden"></div>
		<tpl-event-list class="row"></tpl-event-list>
	</div>
	<tpl-book-event class="row"></tpl-book-event>
</div>