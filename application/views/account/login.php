<?php include 'includes/header.php' ?>
 <!-- Page -->
    <div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">
      <div class="page-content vertical-align-middle">
        <div class="panel">
          <div class="panel-body">
            <div class="brand">
              <img class="brand-img" src="<?php echo $assets ?>img/logo.png" height='80' alt="...">
              <h2 class="brand-text font-size-18">CPFd</h2>
              <hr>
              <h4 class="brand-text font-size-18">Sign in to start your session</h4>
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
            <form action="<?php echo url('/login/check') ?>" method="post" autocomplete="off">
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="text" class="form-control"  value="<?php echo post('username') ?>" name="username" autofocus autocomplete="off"/>
                <label class="floating-label">Enter Callsign or Email...</label>
              </div>
              <div class="form-group form-material floating" data-plugin="formMaterial">
                <input type="password" class="form-control" name="password"/>
                <label class="floating-label">Password</label>
              </div>
              <div class="form-group clearfix">
                <div class="checkbox-custom checkbox-inline checkbox-primary checkbox-lg float-left">
                  <input type="checkbox" id="inputCheckbox" <?php echo post('remember_me')?'checked':'' ?> name="remember_me">
                  <label for="inputCheckbox">Remember me</label>
                </div>
                <a class="float-right" href="<?php echo url('login/forget?username='.post('username')) ?>">Forgot password?</a>
              </div>
              <button type="submit" class="btn btn-primary btn-block btn-lg mt-40">Sign in</button>
            </form>
          </div>
        </div>
        <?php include 'includes/footer.php' ?>