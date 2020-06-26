<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lookouts
    <small>All the vehicles in the list, will require SAPS confirmation before action is taken</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">
 
<div class="row">
   <?php
                    if(!empty($obentry))
                    {
                        foreach($obentry as $widget)
                        {
                    ?>
        <div class="col-md-4">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-grey">
              <div class="widget-user-image">
                <img class="img-circle" src="<?php echo $url->assets ?>img/Lookout.png" alt="Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="widget-user-username"><?php echo $widget->plate ?></h3>
              <h5 class="widget-user-desc"><?php echo $widget->category ?></h5>
            </div>
            <div class="box-footer no-padding">
              <ul class="nav nav-stacked">
                <li><a href="#">Date of Incident <span class="pull-right"><?php echo ($widget->date!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($widget->date)):'No Record' ?></span></a></li>
                <li><a href="#">Last Seen <span class="pull-right badge bg-blue"><?php echo $widget->sector ?></span></a></li>
                <li><a href="#">Incident Description:</a></li>
                <li><a href="#"><?php echo $widget->description ?></a></li>
            </div>
          </div>
          <!-- /.widget-user -->
        </div>
          <?php
                        }
                    }
                    ?>
        <!-- /.col -->
      </div>
     


</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>
