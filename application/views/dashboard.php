<?php include viewPath('includes/header'); ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Dashboard
  <small>overview </small>
  </h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-sm-3">
      <div class="info-box">
        <span class="info-box-icon bg-blue"><span class="info-box-number"><?php echo $this->users_model->countAll() ?></span></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Active Patrollers</span>
          
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-sm-3">
      <div class="info-box">
        <span class="info-box-icon bg-blue"><span class="info-box-number"><?php echo $this->ob_book_model->countAll() ?></span></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total OB Records</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-sm-3">
      <div class="info-box">
        <span class="info-box-icon bg-blue"><span class="info-box-number"><?php echo $this->ob_book_model->countStatus() ?></span></span>
        <div class="info-box-content">
          <span class="info-box-text">Outstanding Incidents</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
    <div class="col-sm-3">
      <div class="info-box">
        <span href="<?php echo url('duty_book') ?>" class="info-box-icon bg-blue"><span class="info-box-number"><?php echo $this->duty_book_model->countOnDuty() ?></span></span>
        <div class="info-box-content">
          <span class="info-box-text">On Duty Patollers</span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </div>
  </div>
<!-- Main row -->
  <div class="row">
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs pull-right">
          <li class="active"><a href="#dutyInfo" data-toggle="tab">On Duty Patrollers</a></li>
          <li><a href="#incidents" data-toggle="tab">Incidents</a></li>
          <li class="pull-left header"><i class="fa fa-inbox"></i>Info Desk</li>
        </ul>
        <div class="tab-content no-padding">
          <!-- Morris chart - Sales -->
          <div class="tab-pane" id="incidents" style="position: relative; height: auto;">
            <div class="box-body no-padding table-responsive">
          <table class="table table-striped">
            <tbody><tr>
              <th class="text-nowrap">Incident OB</th>
              <th>Date/Time Reported</th>
              <th class="text-nowrap">Incident Sector</th>
              <th class="text-nowrap">Category</th>
              <th class="text-nowrap">Reported By</th>
              <th class="text-nowrap">Incident Status</th>
            </tr>
            <tr>
              <?php
                if(!empty($Status))
                {
                  foreach($Status as $strow)
                  {
              ?>
                <tr>
                  <td><?php echo $strow->ob_number ?></td>
                  <td><?php echo ($strow->date!='0000-00-00 00:00:00 00:00  ')?date('g:ia | D jS F Y', strtotime($strow->date)):'No Record' ?></td>
                  <td><?php echo $strow->sector ?></td>
                  <td><?php echo $strow->category ?></td>
                  <td><?php echo $strow->username ?></td>
                  <td><span class="label <?php echo $this->ob_book_model->statusType($strow->statusId) ?>"><?php echo $strow->status ?></span></td>
                </tr>
              <?php
                  }
                }
              ?>
            </tbody></table>
          </div>
          </div>
          <div class="tab-pane active" id="dutyInfo" style="position: relative; height: auto;">
            <div class="box-body no-padding table-responsive">
            <table class="table">
              <tbody><tr>
                <th class="text-nowrap">Booked On As</th>
                <th class="text-nowrap">Callsign</th>
                <th class="text-nowrap">Duty Type</th>
                <th class="text-nowrap">On Duty OB Number</th>
                <th class="text-nowrap">On Duty Time</th>
              </tr>
              <tr>
              <?php
              if(!empty($Records))
                {
                  foreach($Records as $row)
                  {
                ?>
                  <tr>
                    <td><?php echo $row->bookOnAs ?></td>
                    <td><?php echo $row->username ?></td>
                    <td><span class="label <?php echo $this->duty_book_model->dutyType($row->dutyTypeId) ?>"><?php echo $row->dutyType ?></span></td>
                    <td><?php echo $row->on_ob_number ?></td>
                    <td><?php echo ($row->onDutyTime!='0000-00-00 00:00:00 00:00  ')?date('g:ia | D jS F Y', strtotime($row->onDutyTime)):'No Record' ?></td>
                  </tr>
                <?php
                  }
                }
              ?>
              </tbody></table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.nav-tabs-custom -->

      <!-- /.box (chat box) -->
<?php if (hasPermissions('add_duty')): ?>
      <!-- quick email widget -->
      <div class="box box-info">
        <div class="box-header">
          <i class="fa fa-clock-o"></i>

          <h3 class="box-title">Quick Book On Duty </h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                    title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
          <!-- /. tools -->
        </div>
        <div class="box-body">
            <?php echo form_open_multipart('duty_book/save', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
            <div class="form-group">
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
        </div>
        <div class="box-footer clearfix">
           <button type="Submit" id="btnSubmit" class="btn btn-flat btn-primary">Submit</button>
        </div>
        <?php echo form_close(); ?>
      </div>
<?php endif ?>
    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">
      <!-- Calendar -->
      <div class="box box-solid">
        <div class="box-header">
          <i class="fa fa-clock-o"></i>

          <h3 class="box-title">Currnt Time</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
          <!--The calendar -->
          <div id="calendar" style="width: 100%"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer text-black">
          <div class="row">
            <div class="col-sm-6">
              <iframe src="https://freesecure.timeanddate.com/clock/i6xyi9dm/n111/fn12/fs48/fcfff/tc22d/ftb/bls0/brs0/bts4/btc00b/th1" frameborder="0" width="242" height="55"></iframe>


            </div>
            <!-- /.col -->
            <div class="col-sm-6">
             
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
      </div>
      <!-- /.box -->

    </section>
    <!-- right col -->
  </div>
  <!-- /.row (main row) -->

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



generateObNumber('formClient-Auto_ob_number');
</script>

    <!-- ChartJS -->

 
    