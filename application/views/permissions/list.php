<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Permissions
    <small>manage user permissions</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of Permissions</h3>

      <div class="box-tools pull-right">
        <?php if (hasPermissions('permissions_add')): ?>
          <a href="<?php echo url('permissions/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New Permission</a>
        <?php endif ?>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
    <div class="box-body">
      <table id="dataTable1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($permissions as $row): ?>
            <tr>
              <td width="60"><?php echo $row->id ?></td>
              <td>
                <?php echo $row->title ?>
              </td>
              <td>
                <?php echo $row->code ?>
              </td>
              <td>
                <?php if (hasPermissions('permissions_edit')): ?>
                  <a href="<?php echo url('permissions/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit Permission" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('permissions_delete')): ?>
                  <a href="<?php echo url('permissions/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this permissions ? \nIt may cause errors where it is currently being used !!")' title="Delete Permission" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      Footer
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>

<script>
  $('#dataTable1').DataTable()
</script>