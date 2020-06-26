<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Radio Test
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Radio Test Log</h3>

      <div class="box-tools pull-right">

        <?php if (hasPermissions('add_duty')): ?>
          <a href="<?php echo url('radio_test/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
        <?php endif ?>

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
            <th class="text-nowrap">Test OB Number</th>
            <th class="text-nowrap">Radio Test Type</th>
            <th class="text-nowrap">Radio Test Date</th>
            <th class="text-nowrap">Reported By</th>
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
              <td>TR00<?php echo $row->id ?></td>
              <?php endif ?>
              <td><?php echo $row->ob_number ?></td>
              <td><?php echo $row->testType ?></td>
              <td><?php echo ($row->radioTestDate!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($row->radioTestDate)):'No Record' ?></td>
              <td><?php echo $row->username ?></td>
              <td><?php echo $row->description?></td>
              <td class="text-nowrap">
                <?php if (hasPermissions('edit_ob')): ?>
                  <a href="<?php echo url('radio_test/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('delete_ob')): ?>
                  <a href="<?php echo url('radio_test/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this OB entry ? \nIt may never be recovered!!")' title="Delete Ob Entrys" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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

