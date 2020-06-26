<?php include viewPath('includes/header'); ?>

<!-- Main content -->
<section class="content">

  <div class="row">

    <div class="col-sm-3">

      <?php include 'sidebar.php'; ?>

    </div>
    <div class="col-sm-9">

      <!-- Default box -->
      <div class="box">

        <div class="box-header with-border">
          <h3 class="box-title">CPFd Settings</h3>
        </div>

        <?php echo form_open('settings/companyUpdate', [ 'class' => 'form-validate', 'autocomplete' => 'off', 'method' => 'post' ]); ?>
        <div class="box-body">

          <div class="form-group">
            <label for="formSetting-Company-Name">App Name Name</label>
            <input type="text" class="form-control" name="company_name" id="formSetting-Company-Name" value="<?php echo setting('company_name') ?>" required placeholder="Enter Company Name" autofocus />
          </div>

          <div class="form-group">
            <label for="formSetting-Company-Name">TimeZone</label>
            <select name="timezone" id="timezone" class="form-control select2">
              <?php $tzlist = DateTimeZone::listIdentifiers(DateTimeZone::ALL); ?>
              <?php foreach ($tzlist as $key => $value): ?>
                <?php $sel = setting('timezone')==$value ? 'selected' : ''; ?>
                <option value="<?php echo $value ?>" <?php echo $sel ?>><?php echo $value ?></option>
              <?php endforeach ?>
            </select>
          </div>
          
          <div class="form-group">
            <label for="formSetting-Company-Email">App Email</label>
            <input type="text" class="form-control" name="company_email" id="formSetting-Company-Email" value="<?php echo setting('company_email') ?>" required placeholder="Enter Company Email" autofocus />
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

    </div>
  </div>

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

