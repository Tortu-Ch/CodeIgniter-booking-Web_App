<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Category 
    <small>List of All Incident Categories</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>

      <div class="box-tools pull-right">

        <?php if (hasPermissions('options_settings')): ?>
          <a href="<?php echo url('Category/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
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
            <th>Category</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($cate as $row): ?>
            <tr>
              <td>CAT00<?php echo $row->catId ?></td>
              <td><?php echo $row->category ?></td>
              <td class="text-nowrap">
                <?php if (hasPermissions('options_settings')): ?>
                  <a href="<?php echo url('Category/edit/'.$row->catId) ?>" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('options_settings')): ?>
                  <a href="<?php echo url('Category/delete/'.$row->catId) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this Category ? \nIt may never be recovered!!")' title="Delete Category" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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