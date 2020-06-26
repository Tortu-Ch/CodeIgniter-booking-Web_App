<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Permissions
    <small>manage permissions</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Permission</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('permissions') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Permissions</a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>

    <?php echo form_open_multipart('permissions/update/'.$permission->id, [ 'class' => 'form-validate' ]); ?>
    <div class="box-body">

      <div class="form-group">
        <label for="formClient-Name">Name</label>
        <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="Enter Name" value="<?php echo $permission->title ?>" autofocus />
      </div>

      <div class="form-group">
        <label for="formClient-Code">Code</label>
        <input type="text" class="form-control" data-rule-remote="<?php echo url('permissions/checkIfUnique?notId='.$permission->id) ?>" name="code" id="formClient-Code" required placeholder="Enter Code" value="<?php echo $permission->code ?>" />
        <p style="color: red;">* code must be unique</p>
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