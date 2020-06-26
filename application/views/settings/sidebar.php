<!-- Default box -->
  <div class="box">

    <div class="box-header with-border">
      <h3 class="box-title">Settings</h3>
    </div>
    <ul class="nav nav-pills nav-stacked">
     
      <?php if (hasPermissions('company_settings')): ?>
        <li <?php echo ($page->submenu=='company')?'class="active"':'' ?>>
        	<a href="<?php echo url('settings/company') ?>">App Settings</a>
        </li>
     
     
      <!-- <li <?php echo ($page->submenu=='auth')?'class="active"':'' ?>>
      	<a href="<?php echo url('settings/auth') ?>">Authentication</a>
      </li> -->
      
    </ul>

  </div>