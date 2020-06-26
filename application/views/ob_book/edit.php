<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Update Incident
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('ob_book/update/'.$obentry->id, [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>


  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">You are now updating an Incident</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('ob_book') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to Ob Book</a>
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
          <h3 class="box-title">New OB Details</h3>
        </div>
        <div class="box-body">

      <div class="form-group">
            <label for="formClient-Ob_number">OB Number:</label>
            <input type="text" class="form-control"  name="ob_number" id="formClient-Ob_numbe" required placeholder="YYYY/MM/0000" value="<?php echo $obentry->ob_number ?>" readonly/>
          </div>

      <div class="form-group">
        <label for="formClient-Date">Reported Date:</label>
        <input type="text" class="form-control date form_datetime" name="date" id="formClient-Date" data-date-format="yyyy-mm-dd HH:ii " data-link-field="dtp_input1" required placeholder="Select Date" autofocus value="<?php echo $obentry->date ?>" />
      </div>
      
       <div class="form-group">
            <label for="formClient-Category">Occurrence Category:</label>
            <select name="category" id="formClient-Category" class="form-control select2">
              <?php foreach ($this->category_model->get() as $row): ?>
                <?php $sel = !empty($obentry->catId) && $obentry->catId==$row->catId ? 'selected' : '' ?>
                <option value="<?php echo $row->catId ?>" <?php echo $sel ?>><?php echo $row->category ?></option>
              <?php endforeach ?>
            </select>
          </div>

      <div class="form-group">
            <label for="formClient-Sector">Sector Reported From</label>
            <select name="sector" id="formClient-Sector" class="form-control select2">
              <option value="">Select Sector</option>
              <?php foreach ($this->sector_model->get() as $row): ?>
                <?php $sel = !empty($obentry->sectorId) && $obentry->sectorId==$row->sectorId ? 'selected' : '' ?>
                <option value="<?php echo $row->sectorId ?>" <?php echo $sel ?>><?php echo $row->sector ?></option>
              <?php endforeach ?>
            </select>
          </div>
       <div class="form-group">
            <label for="formClient-IncidentAddress">Incident Address:</label>
            <textarea type="text" class="form-control" name="incidentAddress" id="formClient-IncidentAddress" placeholder="Enter Address" rows="1"><?php echo $obentry->incidentAddress ?></textarea>
          </div>
   
      <div class="form-group">
            <label for="formClient-Description">Details of Occurrence:</label>
            <textarea type="text" class="form-control" name="description" id="formClient-Description" placeholder="Enter description" rows="3"><?php echo $obentry->description ?></textarea>
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
            <label for="formClient-plate">Involved Vehicle Licence Plate:</label>
            <input type="text" class="form-control"  name="plate" id="formClient-plate" placeholder="Enter Vehicle Licence Plate" value="<?php echo $obentry->plate ?>"/>
          </div>
          <div class="form-group">
            <label for="formClient-Status">Incident Status:</label>
            <select name="status" id="formClient-Status" class="form-control select2" required>
              <option value="">Select Status</option>
              <?php foreach ($this->Ob_status_model->get() as $row): ?>
                <?php $sel = !empty($obentry->statusId) && $obentry->statusId==$row->statusId ? 'selected' : '' ?>
                <option value="<?php echo $row->statusId ?>" <?php echo $sel ?>><?php echo $row->status ?></option>
              <?php endforeach ?>
            </select>
          </div>
        <hr>
         <div class="form-group">
            <label for="formClient-Username">Callsign whom reported the Incident::</label>
            <select name="username" id="formClient-Username" class="form-control select2" required>
              <?php foreach ($this->users_model->get() as $row): ?>
                <?php $sel = !empty($obentry->id) && $obentry->userId==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->username ?></option>
              <?php endforeach ?>
            </select>
          </div>

        </div>
      </div>
      </div>
      <!-- /.box -->

      <div class="col-sm-6">
      <!-- Default box -->
      <div class="box box-primary">
        <div class="box-header">
          <h3 class="box-title">SAPS / Medic's Reponse Details </h3>
        </div>
        <div class="box-body">
         <div class="form-group">
            <label for="formClient-SapsRating">Rate SAPS Service:</label>
            <select name="sapsRating" id="formClient-SapsRating" class="form-control select2" required>
              <option value="">Select Rating</option>
              <?php foreach ($this->Saps_Rating_model->get() as $row): ?>
                <?php $sel = !empty($obentry->id) && $obentry-> sapsRatingId==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->sapsRating ?></option>
              <?php endforeach ?>
            </select>
          </div>
        <div class="form-group">
            <label for="formClient-SapsVehicle">Details:</label>
             <textarea type="text" class="form-control" name="sapsVehicle" id="formClient-SapsVehicle" placeholder="Enter reponse details" rows="3"><?php echo $obentry->sapsVehicle ?></textarea>
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
 
<script>
  $(document).ready(function() {
    $('.form-validate').validate();

      //Initialize Select2 Elements
    $('.select2').select2()

  });

  $(".form_datetime").datetimepicker({
    format: 'hh:mm',
    pick12HourFormat: false,
  });
</script>

<?php include viewPath('includes/footer'); ?>

