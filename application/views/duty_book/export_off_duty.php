<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    History
    <small>Duty Book</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Off Duty Book</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
    <div class="box-body">
      <div class="example table-responsive">
      <table id="dataTable1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <?php if (hasPermissions('activity_log_view')): ?>
            <th>Ref</th>
            <?php endif ?>
            <th class="text-nowrap">Booked On As</th>
            <th class="text-nowrap">Callsign</th>
            <th class="text-nowrap">Duty Type</th>
            <th class="text-nowrap">On Duty OB</th>
            <th class="text-nowrap">Off Duty OB</th>
            <th class="text-nowrap">On Duty Time</th>
            <th class="text-nowrap">Off Duty Time</th>
          </tr>
        </thead>
        <tbody>

           <?php
                    if(!empty($Records))
                    {
                        foreach($Records as $row)
                        {
                    ?>
            <tr>
              <?php if (hasPermissions('activity_log_view')): ?>
              <td>DR00<?php echo $row->id ?></td>
              <?php endif ?>
              <td><?php echo $row->bookOnAs ?></td>
              <td><?php echo $row->username ?></td>
              <td><span class="label <?php echo $this->duty_book_model->dutyType($row->dutyTypeId) ?>"><?php echo $row->dutyType ?></span></td>
              <td><?php echo $row->on_ob_number ?></td>
              <td><?php echo $row->off_ob_number ?></td>
              <td><?php echo $row->onDutyTime ?></td>
              <td><?php echo $row->offDutyTime ?></td>
            </tr>
          <?php
                        }
                    }
                    ?>

        </tbody>
      </table>
    </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->



<?php include viewPath('includes/footer'); ?>

<script>
$('#dataTable1').dataTable( {
     "ordering": false
} );



</script>

