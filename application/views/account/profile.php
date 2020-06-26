<?php include viewPath('includes/header'); ?>

<!-- Main content -->
<section class="content">


  <div class="row">
    <div class="col-md-3">

      <!-- Profile Image -->
      <div class="box box-primary">
        <div class="box-body box-profile">
          <img class="profile-user-img img-responsive img-circle" src="<?php echo userProfile($user->id) ?>" alt="User profile picture" />

          <h3 class="profile-username text-center"><?php echo $user->name ?></h3>

          <p class="text-muted text-center"><?php echo $user->role->title ?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Username</b> <a class="pull-right"><?php echo $user->username ?></a>
            </li>
            <li class="list-group-item">
              <b>Last Login</b> <a class="pull-right"><?php echo date('d F, Y', strtotime($user->last_login)) ?></a>
            </li>
            <li class="list-group-item">
              <b>Member Since</b> <a class="pull-right"><?php echo date('d F, Y', strtotime($user->created_at)) ?></a>
            </li>
          </ul>

          <a href="<?php echo url('profile/index/edit') ?>" class="btn btn-primary btn-block"><b> <i class="fa fa-pencil"></i> Edit Profile</b></a>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </div>
    <!-- /.col -->
    <div class="col-md-9">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li <?php echo $activeTab=='profile'?'class="active"':'' ?>><a href="#viewProfile" onclick="updateUrl('<?php echo url('profile/index/profile') ?>')" data-toggle="tab">Profile</a></li>
          <li <?php echo $activeTab=='edit'?'class="active"':'' ?>><a href="#editProfile" onclick="updateUrl('<?php echo url('profile/index/edit') ?>')" data-toggle="tab">Edit</a></li>
          <li <?php echo $activeTab=='change_pic'?'class="active"':'' ?>><a href="#editProfilePic" onclick="updateUrl('<?php echo url('profile/index/change_pic') ?>')" data-toggle="tab">Change Profile Pic</a></li>
          
        </ul>
        <div class="tab-content">
          <div class="<?php echo $activeTab=='profile'?'active':'' ?> tab-pane" id="viewProfile">
            <table class="table table-bordered table-striped">
              <tbody>
                <tr>
                  <td width="160"><strong>Name</strong>:</td>
                  <td><?php echo $user->name ?></td>
                </tr>
                <tr>
                  <td><strong>username</strong>:</td>
                  <td><?php echo $user->username ?></td>
                </tr>
                <tr>
                  <td><strong>Email</strong>:</td>
                  <td><?php echo $user->email ?></td>
                </tr>
                <tr>
                  <td><strong>Role</strong>:</td>
                  <td><?php echo $user->role->title ?></td>
                </tr>
                <tr>
                  <td><strong>Phone</strong>:</td>
                  <td><?php echo $user->phone ?></td>
                </tr>
                <tr>
                  <td><strong>Address</strong>:</td>
                  <td><?php echo nl2br($user->address) ?></td>
                </tr>
                <tr>
                  <td><strong>Last Login</strong>:</td>
                  <td><?php echo ($user->last_login!='0000-00-00 00:00:00')?date('H:i a - d F, Y', strtotime($user->last_login)):'No Record' ?></td>
                </tr>
                <tr>
                  <td><strong>Member Since</strong>:</td>
                  <td><?php echo ($user->created_at!='0000-00-00 00:00:00')?date('H:i a - d F, Y', strtotime($user->created_at)):'No Record' ?></td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="<?php echo $activeTab=='edit'?'active':'' ?> tab-pane" id="editProfile">
            <form action="<?php echo url('profile/updateProfile') ?>" method="post" class="form-horizontal form-validate">

              <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">
                  <input type="name" name="name" required class="form-control" id="inputName" value="<?php echo $user->name ?>" autofocus placeholder="Name">
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                  <input type="email" name="email" required 
                   data-rule-remote="<?php echo url('users/check?notId='.$user->id) ?>" data-msg-remote="Email Already Exists"
                   class="form-control" id="inputEmail" placeholder="Email" value="<?php echo $user->email ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="password" name="password" class="form-control" id="inputEmail" placeholder="Password">
                  <p class="help-block text-muted">Leave Blank, if you dont want to change password</p>
                </div>
              </div>

              <div class="form-group">
                <label for="inputContact" class="col-sm-2 control-label">Contact Number</label>

                <div class="col-sm-10">
                  <input type="name" name="contact" required class="form-control" id="inputContact" value="<?php echo $user->phone ?>" placeholder="Contact Number..">
                </div>
              </div>

              <div class="form-group">
                <label for="inputContact" class="col-sm-2 control-label">Address</label>

                <div class="col-sm-10">
                  <textarea type="text" class="form-control" name="address" id="inputAddress" placeholder="Enter Address" rows="3"><?php echo $user->address ?></textarea>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
          <div class="<?php echo $activeTab=='change_pic'?'active':'' ?> tab-pane" id="editProfilePic">
            <form action="<?php echo url('profile/updateProfilePic') ?>" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">

              <div class="form-group">
                <label for="formAdmin-Image" class="col-sm-2 control-label">Image</label>

                <div class="col-sm-10">
                  <input type="file" class="form-control" name="image" id="formAdmin-Image" placeholder="Upload Image" required accept="image/*" onchange="previewImage(this, '#imagePreview')">
                </div>
              </div>       
              <div class="form-group" id="imagePreview">
                <label for="formAdmin-Preview" class="col-sm-2 control-label">Preview</label>
                <div class="col-sm-10">
                  <img src="<?php echo userProfile($user->id) ?>" class="img-circle" width="150" alt="Uploaded Preview">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-primary btn-flat">Update</button>
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->


        </div>
        <!-- /.tab-content -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

</section>
<!-- /.content -->

<script>
  $(document).ready(function() {
    $('.form-validate').validate();
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

<script>
      //Initialize Select2 Elements
    $('.select2').select2()
</script>