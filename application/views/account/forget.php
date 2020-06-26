<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php include 'includes/header.php' ?>

  <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content vertical-align-middle">
        <div class="panel">
          <div class="panel-body">
            <div class="brand">
              <img class="brand-img" href="<?php echo url('/') ?>" src="<?php echo $assets ?>theme/assets//images/logo-colored.png" alt="...">
              <h2>Forgot Your Password ?</h2>
              <p>Enter your registered callsign or email to reset your password. An Email will be sent to the registered email.</p>
            </div>
            <?php if(isset($message)): ?>
              <div class="alert alert-<?php echo $message_type ?>">
                <p><?php echo $message ?></p>
              </div>
            <?php endif; ?>

            <?php if(!empty($this->session->flashdata('message'))): ?>
              <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                <p><?php echo $this->session->flashdata('message') ?></p>
              </div>
            <?php endif; ?>
            <form action="<?php echo url('/login/reset_password') ?>" method="post" autocomplete="off">
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="text" class="form-control"  value="<?php echo !empty(post('username'))? post('username') : get('username')  ?>" name="username" autofocus autocomplete="off"/>
                <label class="floating-label">Enter Callsign or Email...</label>
                <?php echo form_error('username', '<div class="error" style="color: red;">', '</div>'); ?>
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Reset Your Password</button>
            </form>
          </div>
          <hr>
        <a href="<?php echo url('login') ?>"> <i class="fa fa-chevron-left"></i> Go To Login</a>
        <br>
        <br>
        </div>


<?php include 'includes/footer.php' ?>
