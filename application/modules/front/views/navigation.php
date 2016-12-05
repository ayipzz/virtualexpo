<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">VIRTUAL EXPO</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="col-md-4 col-sm-5 col-md-offset-2">
        <div class="row mg-top-7">
            <div class="input-group">
              <input type="text" class="form-control input-search" placeholder="Search Place, Events">
              <span class="input-group-addon"><i class="fa fa-search"></i></span>
            </div>
        </div>
      </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li data-toggle="popover" title="ADVANCED FILTER"  data-html="true" data-popover-content="#popover-content" data-placement="bottom"><a href=""><i class="fa fa-sliders"></i> Filter</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
        if($this->session->userdata("c_id")) {
        echo '
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Welcome, '.$this->session->userdata("c_name").' <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="'.site_url('company_logout').'">Logout</a></li>
            </ul>
          </li>
        ';
        } else {
          echo '
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Member <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="'.site_url('login').'">Login</a></li>
            </ul>
          </li>
          ';
        }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div ng-click="vm.getEvent()" id="btn_getEvent"></div>
<div id="popover-content" class="hide advanced_filter">
  
      <div class="form-group">
        <label for="eventcategory">Event Category :</label>
        <select class="form-control" id="eventcategory">
          <option value="">All Category Event</option>
          <option ng-repeat="category in vm.ev_category" value="{{ category.event_category_id }}"> {{ category.event_category_value }}</option>
        </select>
      </div>
      <div class="col-md-6 pd_l_0">
        <div class="form-group">
          <label for="startdate">Start Date :</label>
          <input type="date" name="startdate" id="startdate" class="form-control" value="<?php echo date("Y-m-01"); ?>" />
        </div>
      </div>
      <div class="col-md-6 pd_r_0">
        <div class="form-group">
          <label for="enddate">End Date :</label>
          <input type="date" name="enddate" id="enddate" class="form-control" value="<?php echo date("Y-m-t"); ?>" />
        </div>
      </div>
      <button onclick="$('#btn_getEvent').click();$('.popover').popover('hide')" class="btn btn-primary btn-block">Filter</button>
</div>