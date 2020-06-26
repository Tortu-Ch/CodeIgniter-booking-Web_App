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

<?php echo form_open_multipart('radio_test/save', [ 'class' => 'form-validate', 'id' => 'addRadioTest', 'autocomplete' => 'off' ]); ?>


  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <div class="box-tools pull-right">
        <a href="<?php echo url('radio_test') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back</a>
        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                title="Collapse">
          <i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
          <i class="fa fa-times"></i></button>
      </div>

    </div>
  </div>

  <div class="row">
    <div class="col-sm-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">New Log</h3>
          <span id="ob_num" data-ob-number="<?php echo $this->radio_test_model->getLastEntry()->ob_number; ?>" />
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="formClient-Ob_number">Auto OB Number:</label>
            <input type="text" class="form-control" name="ob_number" id="formClient-Ob_number" placeholder="YYYY/MM/0000" />
          </div>
      
      <div class="form-group">
            <label for="formClient-OnDutyTime">Radio Test Date & Time:</label>
            <input type="text" class="form-control date form_datetime" name="onDutyTime" id="formClient-OnDutyTime" data-date-format="yyyy-mm-dd HH:ii " data-link-field="dtp_input1" required placeholder="Select Date and Time" autocomplete="off" />
          </div>
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
      
    </div>
    <div class="col-sm-6">
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">More Details</h3>
        </div>
        <div class="box-body">
          <div class="form-group">
            <label for="formClient-TestType">Radio Test Type:</label>
            <select name="dutyType" id="formClient-TestType" class="form-control select2" required>
              <option value="">Select Type</option>
              <?php foreach ($this->radio_test_type_model->get() as $row): ?>
                <?php $sel = !empty(get('testType')) && get('testType')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->testType ?></option>
              <?php endforeach ?>
            </select>
          </div>
          
          <div class="form-group">
            <label for="formClient-Username">Callsign::</label>
            <select name="username" id="formClient-Username" class="form-control select2" required>
              <option value="">Select Callsign</option>
              <?php foreach ($this->users_model->get() as $row): ?>
                <?php $sel = !empty(get('username')) && get('username')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->username ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="formClient-Comments">HA2 Comments:</label>
            <textarea type="text" class="form-control" name="description" id="formClient-Description" placeholder="Enter description" rows="3"></textarea>
          </div>

        </div>
      </div>
      </div>
      <!-- /.box -->

    
  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-footer">
      <button type="submit" id="btnSubmit" class="btn btn-flat btn-primary">Submit</button>
    </div>
    <!-- /.box-footer-->

  </div>
  <!-- /.box -->

<?php echo form_close(); ?>

</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>
<!-- pace 
<script src="<?php echo $url->assets ?>plugins/cleave/dist/cleave.min.js"></script>-->
<script>
  $(document).ready(function() {
    $('.form-validate').validate();

    // Initialize InputMask
    $(":input").inputmask();

      //Initialize Select2 Elements
    $('.select2').select2()

  });

   $(document).ready(function() {
    $('.select2').select2();
    });

    $(document).ready(function () {

        $("#addDuty").submit(function (e) {

            //disable the submit button
            $("#btnSubmit").attr("disabled", true);

            return true;

        });
    });

var cleave = new Cleave('.form-control ob_num', {
    delimiter: '/',
    blocks: [4, 2, 4],
    uppercase: true
});


generateObNumber('formClient-Ob_number');
</script>

