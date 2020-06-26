<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    New Incident
    <small></small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('ob_book/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>


  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">New Entry</h3>
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
           <span id="ob_num" data-ob-number="<?php echo $this->ob_book_model->getLastEntry()->ob_number; ?>" />
        </div>
        <div class="box-body">
            <div class="form-group">
            <label for="formClient-Ob_number">Auto OB Number:</label>
            <input type="text" class="form-control" name="ob_number" id="formClient-Ob_number" placeholder="YYYY/MM/0000" readonly />
          </div>


      <div class="form-group">
        <label for="formClient-Date">Reported Date:</label>
        <input type="text" class="form-control date form_datetime" name="date" id="formClient-Date" data-date-format="yyyy-mm-dd HH:ii " data-link-field="dtp_input1" required placeholder="Select Date" autofocus />
      </div>
      
       <div class="form-group">
            <label for="formClient-Category">Occurrence Category:</label>
            <select name="category" id="formClient-Category" class="form-control select2" required>
              <option value="">Select Category</option>
              <?php foreach ($this->category_model->get() as $row): ?>
                <?php $sel = !empty(get('category')) && get('category')==$row->catId ? 'selected' : '' ?>
                <option value="<?php echo $row->catId ?>" <?php echo $sel ?>><?php echo $row->category ?></option>
              <?php endforeach ?>
            </select>
          </div>

      <div class="form-group">
            <label for="formClient-Sector">Sector Reported From</label>
            <select name="sector" id="formClient-Sector" class="form-control select2" required>
              <option value="">Select Sector</option>
              <?php foreach ($this->sector_model->get() as $row): ?>
                <?php $sel = !empty(get('sector')) && get('sector')==$row->sectorId ? 'selected' : '' ?>
                <option value="<?php echo $row->sectorId ?>" <?php echo $sel ?>><?php echo $row->sector ?></option>
              <?php endforeach ?>
            </select>
          </div>
       <div class="form-group">
            <label for="formClient-IncidentAddress">Incident Address:</label>
            <textarea type="text" class="form-control" name="incidentAddress" id="formClient-IncidentAddress" placeholder="Enter Address" rows="1"></textarea>
          </div>

      <div class="form-group">
            <label for="formClient-Description">Details of Occurrence:</label>
            <textarea type="text" class="form-control" name="description" id="formClient-Description" placeholder="Enter description" rows="3"></textarea>
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
          <!-- radio -->
              <div class="form-group">
                <label for="formClient-plate">Is there a vehicle involved in this incident ?</label>
                <br>
                <label>
                  <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck" class="minimal">
                  Yes 
                </label>
                <label>
                  <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="noCheck" class="minimal" checked>
                  No 
                </label>
                <br>
                <div id="ifYes" style="visibility:hidden">
            <label for="formClient-plate">Please enter Involved Vehicle Licence Plate:</label>
            <input type="text" class="form-control"  name="plate" id="formClient-plate" placeholder="Enter Vehicle Licence Plate"/>
          </div>
              </div>
        
        <div class="form-group">
            <label for="formClient-Username">Callsign whom reported the Incident::</label>
            <select name="username" id="formClient-Username" class="form-control select2" required>
              <option value="">Select Callsign</option>
              <?php foreach ($this->users_model->get() as $row): ?>
                <?php $sel = !empty(get('username')) && get('username')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->username ?></option>
              <?php endforeach ?>
            </select>
          </div>
        <hr>
          <div class="form-group">
            <label for="formClient-Status">Incident Status:</label>
            <select name="status" id="formClient-Statys" class="form-control select2" required>
              <option value="">Select Status</option>
              <?php foreach ($this->Ob_status_model->get() as $row): ?>
                <?php $sel = !empty(get('status')) && get('status')==$row->statusId ? 'selected' : '' ?>
                <option value="<?php echo $row->statusId ?>" <?php echo $sel ?>><?php echo $row->status ?></option>
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
          <h3 class="box-title">Reponse Details</h3>
        </div>
        <div class="box-body">
           <div class="form-group">
            <label for="formClient-SapsRating">Rate SAPS Service:</label>
            <select name="sapsRating" id="formClient-SapsRating" class="form-control select2" required>
              <option value="">Select Rating</option>
              <?php foreach ($this->Saps_Rating_model->get() as $row): ?>
                <?php $sel = !empty(get('sapsRating')) && get('sapsRating')==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->sapsRating ?></option>
              <?php endforeach ?>
            </select>
          </div>
        <div class="form-group">
            <label for="formClient-SapsVehicle">Details:</label>
             <textarea type="text" class="form-control" name="sapsVehicle" id="formClient-SapsVehicle" placeholder="Enter reponse details" rows="3"></textarea>
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

<script>
  $(document).ready(function() {
    $('.form-validate').validate();

      //Initialize Select2 Elements
    $('.select2').select2()

  });

  function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

}

 $(document).ready(function () {

        $("#addDuty").submit(function (e) {

            //disable the submit button
            $("#btnSubmit").attr("disabled", true);

            return true;

        });
    });

  generateObNumber('formClient-Ob_number');
</script>

