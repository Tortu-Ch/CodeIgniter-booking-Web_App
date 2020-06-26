<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Activity Log
    <small>view activities</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">List of All Activites</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
    <div class="box-body">

      <div class="row">
        <div class="col-sm-12">
          <form action="<?php echo url('activity_logs') ?>" method="get" autocomplete="off">
            <div class="row">

                <div class="col-sm-2">
                  <div class="form-group">
                    <p style="margin-top: 20px"><strong>Filter :</strong> </p>
                  </div>
                </div>

                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="Filter-IpAddress">Ip Address </label>
                    <span class="pull-right"><a href="#" onclick="event.preventDefault(); $('#Filter-IpAddress').val('').trigger('onchange')">clear</a></span>
                    <input type="text" name="ip" id="Filter-IpAddress" onchange="$(this).parents('form').submit();" class="form-control" value="<?php echo get('ip') ?>" placeholder="Search by Ip Addres" />
                  </div>
                </div>

                <div class="col-sm-5">
                  <div class="form-group">
                    <label for="Filter-User">User</label>
                    <span class="pull-right"><a href="#" onclick="event.preventDefault(); $('#Filter-User').val('').trigger('onchange')">clear</a></span>
                    <select name="user" id="Filter-User" onchange="$(this).parents('form').submit();" class="form-control select2">
                      <option value="">Select User</option>
                      <?php foreach ($this->users_model->get() as $row): ?>
                        <?php $sel = (get('user')==$row->id)?'selected':'' ?>
                        <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->name ?> #<?php echo $row->id ?></option>
                      <?php endforeach ?>
                    </select>
                  </div>
                </div>

            </div>

          </form>
        </div>
      </div>

      <table id="dataTable1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Id</th>
            <th>IP Address</th>
            <th>Message</th>
            <th>Date Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($activity_logs as $row): ?>
            <tr>
              <td width="60"><?php echo $row->id ?></td>
              <td><?php echo !empty($row->ip_address)?'<a href="'.url('activity_logs/index?ip='.urlencode($row->ip_address)).'">'.$row->ip_address.'</a>':'N.A' ?></td>
              <td>
                <a href="<?php echo url('activity_logs/view/'.$row->id) ?>"><?php echo $row->title ?></a>
              </td>
              <td><?php echo date('G:ia | D jS F Y', strtotime($row->created_at)) ?></td>
              <td>
                <?php if (hasPermissions('activity_log_view')): ?>
                  <a href="<?php echo url('activity_logs/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View Activity" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                  <?php if ($row->user > 0): ?>
                    <a href="<?php echo url('users/view/'.$row->user) ?>" class="btn btn-sm btn-default" title="View User" target="_blank" data-toggle="tooltip"><i class="fa fa-user"></i></a>
                  <?php endif ?>
                <?php endif ?>
              </td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>

<script>

  $('#dataTable1').DataTable({
    "order": []
  })

  $('.select2').select2();

</script>