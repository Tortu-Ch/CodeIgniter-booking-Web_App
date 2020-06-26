<?php include viewPath('includes/header'); ?>

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Incident: 
        <small><?php echo $obentry->ob_number ?></small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> CPFd : Incident Report
            <small class="pull-right">Document Created: <?php echo ($obentry->date!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($obentry->date)):'No Record' ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Place of incident
          <address>
            <strong>Sector Reported From:</strong> <?php echo $obentry->sectorId->sector ?><br>
            <strong>Incident Address:</strong> <?php echo $obentry->incidentAddress ?><br>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Incident OB NUmber:</b> <?php echo $obentry->ob_number ?><br>
          <b>Category:</b> <?php echo $obentry->catId->category ?><br>
          <b>Incident Reported By:</b> <?php echo $obentry->userId->username ?><br>
          <b>Date & Time :</b> <?php echo ($obentry->date!='0000-00-00 00:00:00 00:00  ')?date('G:ia | D jS F Y', strtotime($obentry->date)):'No Record' ?>
        </div>
        <!-- /.col -->
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Incident Status :</b> <h3><?php echo $obentry->statusId->status ?></h3><br>
          <b>Involved Vehicle Licence Plate:</b> <?php echo $obentry->plate ?><br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
               <tr>
                  <td colspan="4"></td>
                </tr>
            </thead>
            <tbody>
              <td class="bg-info"><strong>Incident Description :</strong></td>
                  <tr>
                  <td colspan="4" class="text-warp"><?php echo $obentry->description ?></td>
                </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Reponse Details :</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
           <?php echo $obentry->sapsVehicle ?>
          </p>
        </div>
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a href="#" onclick="myFunction()" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->

<?php include viewPath('includes/footer'); ?>

<script>
	$('#dataTable1').DataTable({
    "order": []
  });
  function myFunction() {
  window.print();
}
</script>
