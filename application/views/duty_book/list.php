<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Duty Book
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Duty Book</h3>

      <div class="box-tools pull-right">

        <?php if (hasPermissions('add_duty')): ?>
          <a href="<?php echo url('duty_book/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
        <?php endif ?>


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
              <td><?php echo $row->comments?></td>
              <td class="text-nowrap">
                <?php if (hasPermissions('edit_ob')): ?>
                  <a href="<?php echo url('duty_book/edit/'.$row->id) ?>" class="btn btn-sm btn-warning" title="Edit Duty" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('delete_ob')): ?>
                  <a href="<?php echo url('duty_book/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick='return confirm("Do you really want to delete this duty entry ? \nIt may never be recovered!!")' title="Delete Duty" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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
  $('#dataTable1').DataTable({
    //order: 'desc'
    "order": [1, 'desc']
  })



</script>

