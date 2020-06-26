<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Users
    <small>manage users</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of Users</h3>

      <div class="box-tools pull-right">

        <?php if (hasPermissions('users_add')): ?>
          <a href="<?php echo url('users/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New User</a>
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
            <th>Id</th>
            <th>Callsign</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Contact Number</th>
            <th>Last Login</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($users as $row): ?>
            <tr>
              <td width="60"><?php echo $row->id ?></td>
              <td width="60"><?php echo $row->username ?></td>
              <td width="50" class="text-center">
                <img src="<?php echo url('uploads/users/'.$row->id.'.png'); ?>" width="40" height="40" alt="" class="img-avtar">
              </td>
              <td>
                <?php echo $row->name ?>
              </td>
              <td><?php echo $row->email ?></td>
              <td><?php echo $row->phone ?></td>
              <td><?php echo ($row->last_login!='0000-00-00 00:00:00')?date('d M, Y', strtotime($row->last_login)):'No Record' ?></td>
              <td>
                <?php if (hasPermissions('users_edit')): ?>
                  <a href="<?php echo url('users/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Edit User" data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('users_view')): ?>
                  <a href="<?php echo url('users/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View User" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('users_delete')): ?>
                  <?php if ($row->id!=1): ?>
                    <a href="<?php echo url('users/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick="return confirm('Do you really want to delete this user ?')" title="Delete User" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                  <?php else: ?>
                    <a href="#" class="btn btn-sm btn-default" title="You cannot Delete this User" data-toggle="tooltip" disabled><i class="fa fa-trash"></i></a>
                  <?php endif ?>
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