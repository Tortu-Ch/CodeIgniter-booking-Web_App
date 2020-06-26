<?php include viewPath('includes/header'); ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Activity Logs
    <small>manage activity logs</small>
  </h1>
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="box">
		<div class="box-header with-border">
		  <h3 class="box-title">View Activity</h3>

		  <div class="box-tools pull-right">
		    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
		            title="Collapse">
		      <i class="fa fa-minus"></i></button>
		    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
		      <i class="fa fa-times"></i></button>
		  </div>

		</div>
		<div class="box-body">

		  <table class="table table-bordered table-striped">
		    <thead>
		    </thead>
		    <tbody>

		        <tr>
		          <td width="150">Id: </td>
		          <td><strong><?php echo $activity->id ?></strong></td>
		        </tr>

		        <tr>
		          <td>Message: </td>
		          <td><strong><?php echo $activity->title ?></strong></td>
		        </tr>

		        <tr>
		          <td>User: </td>
		          <?php $User = $this->users_model->getBy('id',$activity->user) ?>
		          <td><strong><?php echo $activity->user > 0 ? $User->name : '' ?></strong> <a href="<?php echo url('users/view/'.$User->id) ?>" target="_blank"><i class="fa fa-eye"></i></a></td>
		        </tr>

		        <tr>
		          <td>Date Time: </td>
		          <td><strong><?php echo date('h:m a - d M, Y', strtotime($activity->created_at)) ?></strong></td>
		        </tr>

		    </tbody>
		  </table>
		</div>
		<!-- /.box-body -->
	</div>

</section>

<?php include viewPath('includes/footer'); ?>
