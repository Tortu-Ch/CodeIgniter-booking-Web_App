<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User
    <small>manage users</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<?php echo form_open_multipart('users/update/'.$User->id, [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>

  <!-- Default box -->
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Edit User</h3>

      <div class="box-tools pull-right">
        <a href="<?php echo url('users') ?>" class="btn btn-flat btn-default"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to User</a>
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
          <h3 class="box-title">Basic Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Name">Name</label>
            <input type="text" class="form-control" name="name" id="formClient-Name" required placeholder="Enter Name" value="<?php echo $User->name ?>" autofocus />
          </div>

          <div class="form-group">
            <label for="formClient-Username">Callsign</label>
            <input type="text" class="form-control" data-rule-remote="<?php echo url('users/check?notId='.$User->id) ?>" data-msg-remote="Callsign Already taken" name="username" id="formClient-Username" required placeholder="Enter Username"  value="<?php echo $User->username ?>"/>
          </div>

          <div class="form-group">
            <label for="formClient-Contact">Primary Contact Number</label>
            <input type="text" class="form-control" name="phone" id="formClient-Contact" placeholder="Enter Contact Number" value="<?php echo $User->phone ?>" />
          </div>
        
      <div class="form-group">
            <label for="formClient-radioSerialNumber">Radio Serial Number</label>
            <input type="text" class="form-control" name="radioSerialNumber" id="formClient-radioSerialNumber" placeholder="Enter Radio Serial Number" value="<?php echo $User->radioSerialNumber ?>" />
          </div>

        <div class="form-group">
            <label for="formClient-Sector">CPF Sector</label>
            <select name="sector" id="formClient-Sector" class="form-control select2" required>
              <option value="">Select Sector</option>
              <?php foreach ($this->sector_model->get() as $row): ?>
                <?php $sel = !empty($User->sectorId) && $User->sectorId==$row->sectorId ? 'selected' : '' ?>
                <option value="<?php echo $row->sectorId ?>" <?php echo $sel ?>><?php echo $row->sector ?></option>
              <?php endforeach ?>
            </select>
          </div>

       <div class="form-group">
            <label for="formClient-Role">Role</label>
            <select name="role" id="formClient-Role" class="form-control select2" required>
              <option value="">Select Role</option>
              <?php foreach ($this->roles_model->get() as $row): ?>
                <?php if ($row->id!=1): ?>
                <?php $sel = !empty($User->role) && $User->role==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->title ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
      
        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Login Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Email">Email</label>
            <input type="email" class="form-control" name="email" data-rule-remote="<?php echo url('users/check?notId='.$User->id) ?>" data-msg-remote="Email Already Exists" id="formClient-Email" required placeholder="Enter email"  value="<?php echo $User->email ?>">
          </div>

          <div class="form-group">
            <label for="formClient-Password">Password</label>
            <input type="password" class="form-control" name="password" id="formClient-Password" placeholder="Password" />
            <p class="help-block">Leave Blank to remain unchanged !</p>
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
          <h3 class="box-title">Other Details</h3>
        </div>
        <div class="box-body">

        <div class="form-group">
            <label for="formClient-RSAid">RSA ID Number</label>
            <input type="text" class="form-control" name="RSAid" id="formClient-RSAid" placeholder="Enter ID Number" autocomplete="off"  <?php echo $User->RSAid ?>"/>
          </div>
      
        <div class="form-group">
            <label for="formClient-med">Medical Aid</label>
            <input type="text" class="form-control" name="med" id="formClient-med" placeholder="Enter Medical Aid" value="<?php echo $User->med ?>" />
          </div>

          <div class="form-group">
            <label for="formClient-nextkin">Next of Kin Name</label>
            <input type="text" class="form-control" name="nextkin" id="formClient-nextkin" placeholder="Enter Next of Kin Name" value="<?php echo $User->nextkin ?>"/>
          </div>
          <div class="form-group">
            <label for="formClient-nextkinnumber">Next of Kin Name</label>
            <input type="text" class="form-control" name="nextkinnumber" id="formClient-nextkinnumber" placeholder="Enter Next of Kin Name" value="<?php echo $User->nextkinnumber ?>"/>
          </div>
         

          <div class="form-group">
            <label for="formClient-Address">Address</label>
            <textarea type="text" class="form-control" name="address" id="formClient-Address" placeholder="Enter Address" rows="3"><?php echo $User->address ?></textarea>

          </div>

          

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->
    
      <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Profile Image</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Image">Image</label>
            <input type="file" class="form-control" name="image" id="formClient-Image" placeholder="Upload Image" accept="image/*" onchange="previewImage(this, '#imagePreview')">
          </div>
          <div class="form-group" id="imagePreview">
            <img src="<?php echo userProfile($User->id) ?>" class="img-circle" alt="Uploaded Image Preview" width="100" height="100">
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

       <!-- Default box -->
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Vehicle Details</h3>
        </div>
        <div class="box-body">

          <div class="form-group">
            <label for="formClient-Vehicle1">Vehicle</label>
            <input type="text" class="form-control" name="vehicle1" id="formClient-Vehicle1" placeholder="Enter Vehicle Name" value="<?php echo $User->vehicle1 ?>" />
          </div>
          <div class="form-group">
            <label for="formClient-vehicleReg1">Vehicle Registaration</label>
            <input type="text" class="form-control" name="vehicleReg1" id="formClient-vehicleReg1" placeholder="Vehicle Registaration" value="<?php echo $User->vehicleReg1 ?>" />
          </div>
          <div class="form-group">
            <label for="formClient-vehicleModel1">Vehicle Model</label>
            <input type="text" class="form-control" name="vehicleModel1" id="formClient-vehicleModel1" placeholder="Enter Vehicle Model" value="<?php echo $User->vehicleModel1 ?>" />
          </div>
          <div class="form-group">
            <label for="formClient-vehicleColor1">Vehicle Color</label>
            <input type="text" class="form-control" name="vehicleColor1" id="formClient-vehicleColor1" placeholder="Enter Vehicle Color" value="<?php echo $User->vehicleColor1 ?>" />
          </div>

        </div>
        <!-- /.box-body -->

      </div>
      <!-- /.box -->

    </div>
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

  })

  function previewImage(input, previewDom) {

    if (input.files && input.files[0]) {

      $(previewDom).show();

      var reader = new FileReader();

      reader.onload = function(e) {
        $(previewDom).find('img').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }else{
      $(previewDom).hide();
    }

  }

</script>

<?php include viewPath('includes/footer'); ?>

