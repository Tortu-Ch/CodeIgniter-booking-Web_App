<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Emergency
    <small>Numbers</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>

      <div class="box-tools pull-right">

        <?php if (hasPermissions('add_emerg')): ?>
          <a href="<?php echo url('emergency/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
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
            <th>Ref</th>
            <th>Institution</th>
            <th>Primary Contact</th>
            <th>Primary Contact Number</th>
            <th>Communication Procedure</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($emerg as $row): ?>
            <tr>
              <td>CD00<?php echo $row->id ?></td>
              <td><?php echo $row->institution ?></td>
              <td><?php echo $row->primaryContact ?></td>
              <td><?php echo $row->primaryContactNumber ?></td>
              <td class="text-wrap"><?php echo $row->comSop ?></td>
              <td class="text-nowrap">
                <?php if (hasPermissions('edit_emerg')): ?>
                  <a href="<?php echo url('emergency/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('delete_emerg')): ?>
                  <a href="<?php echo url('emergency/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this OB entry ? \nIt may never be recovered!!")' title="Delete Ob Entrys" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>

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
  $('#dataTable1').DataTable()
</script>