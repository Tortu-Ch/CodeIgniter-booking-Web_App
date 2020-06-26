<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    User
    <small>manage user</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

<!-- Custom Tabs -->
  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
    
      <li class="active"><a href="#tab_1" data-toggle="tab">Overview</a></li>
      <li><a href="#tab_2" data-toggle="tab">Activity</a></li>
      <?php if (hasPermissions('users_edit')): ?>
        <li><a href="<?php echo url('users/edit/'.$User->id) ?>">Edit Profile</a></li>
      <?php endif ?>
      
      <li class="pull-right"><a href="<?php echo url('users') ?>"><i class="fa fa-arrow-left"></i> &nbsp;&nbsp; Go Back to User</a></li>
      
      <?php if (hasPermissions('users_edit')): ?>
        <li class="pull-right"><a href="<?php echo url('users/edit/'.$User->id) ?>" class="text-muted"><i class="fa fa-pencil"></i></a></li>
      <?php endif ?>
    
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="tab_1">
      	<div class="row">
      		<div class="col-sm-2" style="padding-left: 50px;">
      			<br>
      			<img src="<?php echo userProfile($User->id) ?>" width="150" class="img-circle" alt="">
      			<br>
      		</div>
      		<div class="col-sm-10" style="padding-left: 50px;">
      			<table class="table table-bordered table-striped">
      				<tbody>
                <tr>
                  <td><strong>Callsign</strong>:</td>
                  <td><?php echo $User->username ?></td>
                </tr>
                <tr>
                  <td><strong>Sector</strong>:</td>
                  <td><?php echo $User->sectorId ?></td>
                </tr>
      					<tr>
      						<td width="160"><strong>Name & Surname</strong>:</td>
      						<td><?php echo $User->name ?></td>
      					</tr>
      					<tr>
      						<td><strong>Email</strong>:</td>
      						<td><?php echo $User->email ?></td>
      					</tr>
                <tr>
                  <td><strong>Phone</strong>:</td>
                  <td><?php echo $User->phone ?></td>
                </tr>
                <tr>
                  <td><strong>Address</strong>:</td>
                  <td><?php echo $User->address ?></td>
                </tr>
                <tr>
                  <td><strong>Medical Aid</strong>:</td>
                  <td><?php echo $User->med ?></td>
                </tr>
                <tr>
                  <td><strong>Next of Kin Name</strong>:</td>
                  <td><?php echo $User->nextkin ?></td>
                </tr>
                <tr>
                  <td><strong>Next of Kin Number</strong>:</td>
                  <td><?php echo $User->nextkinnumber ?></td>
                </tr>
                <tr>
                  <td><strong>Vehicle</strong>:</td>
                  <td><?php echo $User->vehicle1 ?></td>
                </tr>
                <tr>
                  <td><strong>Vehicle Registaration</strong>:</td>
                  <td><?php echo $User->vehicleReg1 ?></td>
                </tr>
                <tr>
                  <td><strong>Vehicle Model</strong>:</td>
                  <td><?php echo $User->vehicleModel1 ?></td>
                </tr>
                <tr>
                  <td><strong>Vehicle Color</strong>:</td>
                  <td><?php echo $User->vehicleColor1 ?></td>
                </tr>
                <tr>
                  <td><strong>CPFd Role</strong>:</td>
                  <td><?php echo $User->role->title ?></td>
                </tr>
      					<tr>
      						<td><strong>Last Login</strong>:</td>
      						<td><?php echo ($User->last_login!='0000-00-00 00:00:00')?date('H:i a - d F, Y', strtotime($User->last_login)):'No Record' ?></td>
      					</tr>
      				</tbody>
      			</table>
      		</div>
      	</div>
      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_2">

		<table id="dataTable1" class="table table-bordered table-striped">
		    <thead>
		      <tr>
		        <th>Id</th>
		        <th>IP Address</th>
		        <th>Message</th>
		        <th>Date Time</th>
		        <th>Action</th>
		      </tr>
		    </thead>
		    <tbody>

		      <?php foreach ($User->activity as $row): ?>
		        <tr>
		          <td width="60"><?php echo $row->id ?></td>
		          <td><?php echo !empty($row->ip_address)?'<a href="'.url('activity_logs/index?ip='.urlencode($row->ip_address)).'">'.$row->ip_address.'</a>':'N.A' ?></td>
		          <td>
		            <a href="<?php echo url('activity_logs/view/'.$row->id) ?>"><?php echo $row->title ?></a>
		          </td>
		          <td><?php echo date('d M, Y', strtotime($row->created_at)) ?></td>
		          <td>
		            <a href="<?php echo url('activity_logs/view/'.$row->id) ?>" class="btn btn-sm btn-default" title="View Activity" data-toggle="tooltip"><i class="fa fa-eye"></i></a>
		          </td>
		        </tr>
		      <?php endforeach ?>

		    </tbody>
		  </table>

      </div>
      <!-- /.tab-pane -->
      <div class="tab-pane" id="tab_3">
        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
        when an unknown printer took a galley of type and scrambled it to make a type specimen book.
        It has survived not only five centuries, but also the leap into electronic typesetting,
        remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
        sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
        like Aldus PageMaker including versions of Lorem Ipsum.
      </div>
      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>
  <!-- nav-tabs-custom -->

</section>

<?php include viewPath('includes/footer'); ?>

<script>
	$('#dataTable1').DataTable({
    "order": []
  });
</script>
