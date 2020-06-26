<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    New Duty Entry
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('duty_book/save', [ 'class' => 'form-validate', 'id' => 'addDuty', 'autocomplete' => 'off' ]); ?>


  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <span id="ob_num" data-ob-number="<?php echo $this->duty_book_model->getLastEntry()->on_ob_number; ?>" />
      <div class="box-tools pull-right">
        <a href="<?php echo url('duty_book') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Duty Book</a>
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
          <h3 class="box-title">New Duty Details</h3>
          <span id="ob_num" data-ob-number="<?php echo $this->duty_book_model->getLastEntry()->on_ob_number; ?>" />
        </div>
        <div class="box-body">
              <div class="form-group">
            <label for="formClient-Username">Callsign:</label>
            <select name="username" id="formClient-Username" class="form-control select2" data-rule-remote="<?php echo url('duty_book/check_duty') ?>" data-msg-remote="This callsign is already on duty !" required>
              <option value="">Select Callsign</option>
              <?php foreach ($this->users_model->get() as $row): ?>
                <?php $sel = !empty(get('username')) && get('username')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->username ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="formClient-on_ob_number">On Duty OB Number:</label>
            <input type="text" maxlength="12" minlength="12"  class="form-control ob_num" name="on_ob_number"
             data-rule-remote="<?php echo url('duty_book/check') ?>" data-msg-remote="Oops! This OB Number already exists" existsid="formClient-On_ob_number"  required placeholder="YYYY/MM/0000" data-inputmask='"mask": "9999/99/9999"'/>
          </div>
      
      <div class="form-group">
            <label for="formClient-OnDutyTime">On Duty Date & Time:</label>
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
            <label for="formClient-DutyType">Duty Type:</label>
            <select name="dutyType" id="formClient-DutyType" class="form-control select2" required>
              <option value="">Select Type</option>
              <?php foreach ($this->duty_model->get() as $row): ?>
                <?php $sel = !empty(get('dutyType')) && get('dutyType')==$row->dutyTypeId ? 'selected' : '' ?>
                <option value="<?php echo $row->dutyTypeId ?>" <?php echo $sel ?>><?php echo $row->dutyType ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="formClient-BookOnAs">Book On As:</label>
            <select name="bookOnAs" id="formClient-BookOnAs" class="form-control select2" required>
              <option value="">Select options</option>
              <?php foreach ($this->Bookon_as_model->get() as $row): ?>
                <?php $sel = !empty(get('bookOnAs')) && get('bookOnAs')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->bookOnAs ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="formClient-Comments">HA2 Comments:</label>
            <textarea type="text" class="form-control" name="comments" id="formClient-Comments" placeholder="Enter description" rows="3"></textarea>
          </div>

        </div>
      </div>
      </div>
      <!-- /.box -->

    
  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-footer">
      <button type="button" id="btnSubmit" class="btn btn-flat btn-primary">Submit</button>
    </div>
    <!-- /.box-footer-->

  </div>
  <!-- /.box -->

<?php echo form_close(); ?>

</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>
<!-- pace -->
<script src="<?php echo $url->assets ?>plugins/cleave/dist/cleave.min.js"></script>
<script>
  $(document).ready(function() {
    $('.form-validate').validate();

    // Initialize InputMask
    $(":input").inputmask();

      //Initialize Select2 Elements
    $('.select2').select2()

     //Money Euro
    $('[data-mask]').inputmask()
  });

  $(document).ready(function() {
    $('.select2').select2();
    });



$("#btnSubmit").on("click", function(event){
    event.preventDefault();
    alertify.confirm('Add new duty',  function(e){
        if (e) {
            $("#addDuty").submit();
            alertify.success("Duty was saved.")
            return true;
        } else  {
            alertify.error("Duty not saved.");
            return false;
        }
    });
});


generateObNumber('formClient-Auto_ob_number');
</script>

