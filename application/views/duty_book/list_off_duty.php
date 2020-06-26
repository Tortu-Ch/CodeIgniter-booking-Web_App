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
            <th class="text-nowrap">Hours</th>
            <th class="text-nowrap">HA2 Comments</th>
            <th class="text-nowrap">Action</th>
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
              <td><?php echo ($row->onDutyTime!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($row->onDutyTime)):'No Record' ?></td>
              <td><?php echo ($row->offDutyTime!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($row->offDutyTime)):'No Record' ?></td>
              <td><?php 
                $start = new DateTime($row->onDutyTime);
                $end = new DateTime($row->offDutyTime);
                $interval = $start->diff($end);
                $hrs = $interval->days * 24 + $interval->h;
               echo $hrs." hours ".$interval->format('%i')." minutes";?></td>
              <td><?php echo $row->comments?></td>
              <td class="text-nowrap">
                <?php if (hasPermissions('edit_ob')): ?>
                  <a href="<?php echo url('duty_book/edit/'.$row->id) ?>" class="btn btn-sm btn-warning" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('super_edit_duty')): ?>
                  <a href="<?php echo url('duty_book/super_edit/'.$row->id) ?>" class="btn btn-sm btn btn-info" title="Super Edit Duty" data-toggle="tooltip"><i class="fa fa-mouse-pointer"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('delete_ob')): ?>
                  <a href="<?php echo url('duty_book/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick='return confirm("Do you really want to delete this OB entry ? \nIt may never be recovered!!")' title="Delete Ob Entrys" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                <?php endif ?>
              </td>
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

