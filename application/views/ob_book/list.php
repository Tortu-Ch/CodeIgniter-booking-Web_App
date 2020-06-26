<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Incident Book 
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"></h3>

      <div class="box-tools pull-right">

        <?php if (hasPermissions('add_ob')): ?>
          <a href="<?php echo url('ob_book/add') ?>" class="btn btn-primary"><i class="fa fa-plus"></i>Add New</a>
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
            <th class="text-wrap">Ref</th>
            <?php endif ?>
            <th class="text-wrap">Ob Number</th>
            <th class="text-wrap">Date</th>
            <th class="text-wrap">Incident Status</th>
            <th class="text-wrap">Sector</th>
            <th class="text-wrap">Category</th>
            <th class="text-wrap">Reported By</th>
            <th class="text-wrap">description</th>
            <th class="text-wrap">Reponse Details</th>
            <?php if (hasPermissions('saps_rating')): ?>
            <th class="text-wrap">SAPS Rating</th>
            <?php endif ?>
            <th class="text-wrap">Action</th>
          </tr>
        </thead>
        <tbody>

          <?php
                    if(!empty($obentry))
                    {
                        foreach($obentry as $row)
                        {
                    ?>
            <tr>
              <?php if (hasPermissions('activity_log_view')): ?>
              <td>ON00<?php echo $row->id ?></td>
              <?php endif ?>
              <td><?php echo $row->ob_number ?></td>
              <td><?php echo ($row->date!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($row->date)):'No Record' ?></td>
              <td><span class="label <?php echo $this->ob_book_model->statusType($row->statusId) ?>"><?php echo $row->status ?></span></td>
              <td><?php echo $row->sector ?></td>
              <td><?php echo $row->category ?></td>
              <td><?php echo $row->username?></td>
              <td class="text-wrap"><?php echo $row->description ?></td>
              <td class="text-wrap"><?php echo $row->sapsVehicle ?></td>
              <?php if (hasPermissions('saps_rating')): ?>
              <td class="text-wrap"><?php echo $row->sapsRating ?></td>
              <?php endif ?>
              <td class="text-nowrap">
                <?php if (hasPermissions('edit_ob')): ?>
                  <a href="<?php echo url('ob_book/edit/'.$row->id) ?>" class="btn btn-sm btn-default" title="Amend Incident " data-toggle="tooltip"><i class="fa fa-pencil"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('view_ob')): ?>
                  <a href="<?php echo url('ob_book/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View Incident Report" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
                <?php endif ?>
                <?php if (hasPermissions('delete_ob')): ?>
                  <a href="<?php echo url('ob_book/delete/'.$row->id) ?>" class="btn btn-sm btn-default" onclick='return confirm("Do you really want to delete this Incident entry ? \nIt may never be recovered!!")' title="Delete Incident" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
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