<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
   Update Duty
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

 <?php echo form_open_multipart('duty_book/update/'.$duty->id, [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>


  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Update Duty Entry</h3>
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
          <h3 class="box-title">Duty Details</h3>
        </div>
        <div class="box-body">
           <div class="form-group">
            <label for="formClient-Username">Callsign:</label>
            <select name="username" id="formClient-Username" class="form-control select2" required>
              <option value="">Select Callsign</option>
              <?php foreach ($this->users_model->get() as $row): ?>
                <?php $sel = !empty($duty->id) && $duty->userId==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->username ?></option>
              <?php endforeach ?>
            </select>
          </div>
      <div class="form-group">
            <label for="formClient-On_ob_number">OB Number:</label>
            <input type="text" class="form-control" maxlength="12" minlength="12" name="on_ob_number"  id="formClient-On_ob_numbe" required placeholder="YYYY/MM/0000" data-inputmask='"mask": "9999/99/9999"' value="<?php echo $duty->on_ob_number ?>" />
          </div>
          <div class="form-group">
            <label for="formClient-Off_ob_number">Off Number:</label>
            <input type="text" class="form-control" maxlength="12" minlength="12" value="<?php echo $duty->off_ob_number ?>" name="off_ob_number"
            data-rule-remote="<?php echo url('duty_book/checkoff') ?>" data-msg-remote="Oops! This OB Number already exists"
             id="formClient-Off_ob_number" required placeholder="YYYY/MM/0000"  data-inputmask='"mask": "9999/99/9999"' />
          </div>

      <div class="form-group">
        <label for="formClient-OnDutyTime">On Duty Time:</label>
        <input type="text" class="form-control date form_datetime" name="onDutyTime" id="formClient-OnDutyTime" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1" autocomplete="off" required placeholder="Select Date" autofocus value="<?php echo $duty->onDutyTime ?>"/>
      </div>

      <div class="form-group">
        <label for="formClient-OffDutyTime">Off Duty Time:</label>
        <input type="text" class="form-control date form_datetime" name="offDutyTime" id="formClient-OffDutyTime" data-date-format="yyyy-mm-dd hh:ii " data-link-field="dtp_input2" autocomplete="off" required placeholder="Select Date" autofocus value="<?php echo $duty->offDutyTime ?>"/>
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
              <option value="">Select Duty Type</option>
              <?php foreach ($this->duty_model->get() as $row): ?>
                <?php $sel = !empty($duty->dutyTypeId) && $duty->dutyTypeId==$row->dutyTypeId ? 'selected' : '' ?>
                <option value="<?php echo $row->dutyTypeId ?>" <?php echo $sel ?>><?php echo $row->dutyType ?></option>
              <?php endforeach ?>
            </select>
          </div>
           <div class="form-group">
            <label for="formClient-BookOnAs">Booked On As:</label>
            <select name="bookOnAs" id="formClient-BookOnAs" class="form-control select2" required>
              <option value="">Select</option>
              <?php foreach ($this->Bookon_as_model->get() as $row): ?>
                <?php $sel = !empty($duty->id) && $duty->asId==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->bookOnAs ?></option>
              <?php endforeach ?>
            </select>
          </div>
          

      <div class="form-group">
            <label for="formClient-Comments">HA2 Comments:</label>
            <textarea type="text" class="form-control" name="comments" id="formClient-Comments" placeholder="Enter description" rows="3"><?php echo $duty->comments ?></textarea>
          </div>

        </div>
      </div>
      </div>
      <!-- /.box -->

    
  </div>

  <!-- Default box -->
  <div class="box">
    <div class="box-footer">
      <button type="submit" class="btn btn-flat btn-primary">Submit</button>
    </div>
    <!-- /.box-footer-->

  </div>
  <!-- /.box -->

<?php echo form_close(); ?>

</section>
<!-- /.content -->

<?php include viewPath('includes/footer'); ?>

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

  //generateObNumber('formClient-Off_ob_number');
</script>

