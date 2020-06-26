<ul class="sidebar-menu" data-widget="tree">
  
  <li class="header">Main Navigation</li>

  <li <?php echo ($page->menu=='dashboard')?'class="active"':'' ?>>
    <a href="<?php echo url('/dashboard') ?>">
      <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
  </li>
<?php  if (hasPermissions('index_cpf')): ?>
    <li <?php  echo ($page->menu=='cpf_stats')?'class="active"':'' ?>>
        <a href="<?php echo url('cpf_stats') ?>">
            <i class="fa fa-signal"></i> <span>CPF Stats</span>
        </a>
    </li>
<?php endif ?>

<?php if (hasPermissions('list_duty')): ?>
    <li <?php echo ($page->menu=='duty_book')?'class="active"':'' ?>>
      <a href="<?php echo url('duty_book') ?>">
        <i class="fa fa-clock-o"></i> <span>On Duty Book</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('list_duty')): ?>
    <li <?php echo ($page->menu=='duty_book')?'class="active"':'' ?>>
      <a href="<?php echo url('duty_book/off_duty') ?>">
        <i class="fa fa-clock-o"></i> <span>Patrol History</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('export_table')): ?>
    <li <?php echo ($page->menu=='duty_book')?'class="active"':'' ?>>
      <a href="<?php echo url('duty_book/export_duty') ?>">
        <i class="fa fa-clock-o"></i> <span>Export Patrol History</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('list_ob')): ?>
    <li <?php echo ($page->menu=='ob_book')?'class="active"':'' ?>>
      <a href="<?php echo url('ob_book') ?>">
        <i class="fa fa-book"></i> <span>Incident Book</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('list_ob')): ?>
    <li <?php echo ($page->menu=='lookouts')?'class="active"':'' ?>>
      <a href="<?php echo url('lookouts') ?>">
        <i class="fa fa-book"></i> <span>Lookouts</span>
      </a>
    </li>
  <?php endif ?>
  <?php if (hasPermissions('list_radio')): ?>
    <li <?php echo ($page->menu=='radio_test')?'class="active"':'' ?>>
      <a href="<?php echo url('radio_test') ?>">
        <i class="fa fa-book"></i> <span>Radio Test</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('list_emerg')): ?>
    <li <?php echo ($page->menu=='emergency')?'class="active"':'' ?>>
      <a href="<?php echo url('emergency') ?>">
        <i class="fa fa-ambulance"></i> <span>Emergency Numbers</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('users_list')): ?>
    <li <?php echo ($page->menu=='users')?'class="active"':'' ?>>
      <a href="<?php echo url('users') ?>">
        <i class="fa fa-user"></i> <span>Users</span>
      </a>
    </li>
  <?php endif ?>

  <?php if (hasPermissions('activity_log_list')): ?>
  <li <?php echo ($page->menu=='activity_logs')?'class="active"':'' ?>>
    <a href="<?php echo url('activity_logs') ?>">
      <i class="fa fa-history"></i><span>Activity Logs</span>
    </a>
  </li>
  <?php endif ?>

  <?php if (hasPermissions('roles_list')): ?>
  <li <?php echo ($page->menu=='roles')?'class="active"':'' ?>>
    <a href="<?php echo url('roles') ?>">
      <i class="fa fa-lock"></i><span>Manage Roles</span>
    </a>
  </li>
  <?php endif ?>

  <?php if (hasPermissions('permissions_list')): ?>
  <li <?php echo ($page->menu=='permissions')?'class="active"':'' ?>>
    <a href="<?php echo url('permissions') ?>">
      <i class="fa fa-lock"></i><span>Manage Permissions</span>
    </a>
  </li>
  <?php endif ?>

  <?php if ( hasPermissions('options_settings') ): ?>
  <li class="treeview <?php echo ($page->menu=='Options')?'active':'' ?>">
    <a href="#">
      <i class="fa fa-cog"></i> <span>Options</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">

      <li <?php echo ($page->submenu=='Category')?'class="active"':'' ?>>
        <a href="<?php echo url('category') ?>">
          <i class="fa fa-circle-o"></i>Add Category
        </a>
      </li>
      <li <?php echo ($page->submenu=='Sector')?'class="active"':'' ?>>
        <a href="<?php echo url('sector') ?>">
          <i class="fa fa-circle-o"></i>Add Sector
        </a>
      </li>
      
    </ul>
  </li>
  <?php endif ?>

  <?php if ( hasPermissions('company_settings') ): ?>
  <li class="treeview <?php echo ($page->menu=='settings')?'active':'' ?>">
    <a href="#">
      <i class="fa fa-cog"></i> <span>Settings</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">

      <li <?php echo ($page->submenu=='company')?'class="active"':'' ?>>
        <a href="<?php echo url('settings/company') ?>">
          <i class="fa fa-circle-o"></i> App Settings
        </a>
      </li>

    </ul>
  </li>
  <?php endif ?>

</ul>