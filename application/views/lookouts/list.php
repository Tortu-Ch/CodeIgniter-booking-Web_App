<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lookouts
    <small>All the vehicles in the list, will require SAPS confirmation before action is taken</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Suspect Vehicles</h3>

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
            <th class="text-wrap">Vehicle Plates</th>
            <th class="text-wrap">Category</th>
            <th class="text-wrap">Incident Description</th>
            <th class="text-wrap">Date of Incident</th>
            <th class="text-wrap">Last Seen</th>
            <th class="text-wrap">Incident OB Number</th>
            <th class="text-wrap">Incident Status</th>
            <th class="text-wrap">View OB</th>
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
              <td class="text-nowrap"><?php echo $row->plate ?></td>
              <td class="text-nowrap"><?php echo $row->category ?></td>
              <td class="text-wrap"><?php echo $row->description ?></td>
              <td><?php echo ($row->date!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($row->date)):'No Record' ?></td>
              <td><?php echo $row->sector ?></td>
              <td><?php echo $row->ob_number ?></td>
              <td><span class="label <?php echo $this->ob_book_model->statusType($row->statusId) ?>"><?php echo $row->status ?></span></td>
              <td class="text-nowrap">
                <?php if (hasPermissions('view_ob')): ?>
                  <a href="<?php echo url('ob_book/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View OB" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
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
  })
</script>