<!DOCTYPE html>
<html>
<head>
	<title>Virtual Expo</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/css/bootstrap.min.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/css/font-awesome.min.css')?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/front/css/style.css')?>" />
	<!-- Js -->
	<script type="text/javascript" src="<?php echo base_url('assets/front/js/jquery.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/front/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/front/js/angular.min.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/front/js/popover.js')?>"></script>
	<script src="<?php echo base_url('assets/front/js/ng-map.min.js')?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDY-Fhi-52NTpycQ5mCaxDFMuwm_oXYKlU"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/front/js/jquery.wayfinding.js')?>"></script>
	<script type="text/javascript" src="<?php echo base_url('assets/front/js/app.js')?>"></script>
	<script type="text/javascript">
		$(function () {
  			$('[data-toggle="popover"]').popover({
  				animation : false,
  				html: true, 
				content: function() {
          			return $('#popover-content').html();
        		}
  			});
		});
		
	</script>
</head>
<body ng-app="virtualExpo"  ng-controller="mapController as vm">
<!-- Nagiation Menu -->
<?php echo $navigation;?>

<!-- Content -->
<?php echo $content_page;?>

<!-- Footer -->
<?php echo $footer;?>
</body>
</html>
