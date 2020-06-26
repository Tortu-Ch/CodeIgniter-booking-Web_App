<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Emergency
    <small>Add New</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">New Entry</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('emergency') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Emergency Number</a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>

    <?php echo form_open_multipart('emergency/save', [ 'class' => 'form-validate' ]); ?>
    <div class="box-body">

    <div class="form-group">
            <label for="formClient-Institution">institution:</label>
            <input type="text" class="form-control" name="institution" id="formClient-Institution" required placeholder="Enter Institution" />
          </div>

      <div class="form-group">
        <label for="formClient-primaryContact">Primary Contact:</label>
        <input type="text" class="form-control" name="primaryContact" id="formClient-primaryContact" required placeholder="Enter Contact" autofocus />
      </div>

      <div class="form-group">
        <label for="formClient-PrimaryContactNumber">Primary Contact Number:</label>
        <input type="text" class="form-control" name="primaryContactNumber" id="formClient-PrimaryContactNumber" required placeholder="Enter Number" autofocus />
      </div>

      <div class="form-group">
            <label for="formClient-comSop">Communication Procedure:</label>
            <textarea type="text" class="form-control" name="comSop" id="formClient-comSop" placeholder="Enter description" rows="3"></textarea>
          </div>

    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="submit" class="btn btn-flat btn-primary">Submit</button>
    </div>
    <!-- /.box-footer-->

    <?php echo form_close(); ?>

  </div>
  <!-- /.box -->

</section>
<!-- /.content -->

<script>
  $(document).ready(function() {
    $('.form-validate').validate();

    $('.check-select-all-p').on('change', function() {

      $('.check-select-p').attr('checked', $(this).is(':checked'));
      
    })

    $('.table-DT').DataTable({
      "ordering": false,
    });
  })

</script>

<?php include viewPath('includes/footer'); ?>

<script>
      //Initialize Select2 Elements
    $('.select2').select2()
</script>