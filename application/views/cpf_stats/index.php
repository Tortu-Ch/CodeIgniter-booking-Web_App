<?php include viewPath('includes/header'); ?>
<!-- Content Header (Page header) -->
<link rel="stylesheet" href="<?php echo $url->assets ?>/css/jquery-ui.css">
<script src="<?php echo $url->assets ?>/js/jquery/jquery.min.js"></script>
<script src="<?php echo $url->assets ?>/js/jquery/jquery.mtz.monthpicker.js"></script>
<?php
$m = array(1=>'JANUARY','FEBRUARY','MARCH','APRIL','MAY','JUNE','JULY','AUGUST','SEPTEMBER','OCTOBER','NOVEMBER','DECEMBER');
$t_m = array(1=>'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
$year = null;
$PATLOLLER_title = "PATLOLLER PATLOLLS";
$VOLLUNTEER_title = "VOLLUNTEER PARTROLLS";
$TOTAL_title = "Total Hours vs Total Number Partrols";
if($page->month)
{
    $m_temp = explode('/', $page->month);
    $PATLOLLER_title .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."01-31"."&nbsp;".$m[(int)$m_temp[0]]."&nbsp;".$m_temp[1];
    $VOLLUNTEER_title .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"."01-31"."&nbsp;".$m[(int)$m_temp[0]]."&nbsp;".$m_temp[1];
    $TOTAL_title .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN &nbsp;".$m_temp[1];
    $year=$m_temp[1];
}
$date = null;
if($page->date)
{
    $d_temp = explode('-', $page->date);
    $PATLOLLER_title .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$d_temp[2]."&nbsp;".$m[(int)$d_temp[1]]."&nbsp;".$d_temp[0];
    $VOLLUNTEER_title .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$d_temp[2]."&nbsp;".$m[(int)$d_temp[1]]."&nbsp;".$d_temp[0];
    $TOTAL_title .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IN &nbsp;".$d_temp[0];
    $year=$d_temp[0];
}
$sectorQuery = $this->cpf_stats_model->getSector(0);
$userQuery = $this->cpf_stats_model->getUser($page->sectorId,null);
if($page->userId && !empty($userQuery)) {
    foreach ($userQuery as $u_row) {
        if($page->userId==$u_row->id)$TOTAL_title .= "(User:" . $u_row->username . ")";
    }
}

?>
<?php echo form_open_multipart('Cpf_stats/form_refresh/', [ 'class' => 'form-validate', 'autocomplete' => 'off' ]); ?>
<section class="content-header">
    <h1>
        CPF STATS
        <small>overview </small>
    </h1>
    <div class="box-tools pull-right">
        <input type="text"  id="month"  style="height: 33px;width: 100px" readonly name="month" placeholder="Select month" value="<?php echo $page->month;?>" class = "text-bold text-center">&nbsp;&nbsp;
        <input type="text" id="date" style="height: 33px;width: 100px" readonly name = "date" placeholder="Select date" value="<?php echo $page->date;?>" class = "text-bold text-center">&nbsp;&nbsp;
        <select style="width: 120px;" id="sector" name="sector" id="formClient-Sector" class="text-bold text-center select2">
            <option value="">Select Sector</option>
            <?php foreach ($sectorQuery as $row): ?>
                <?php $sel = $page->sectorId==$row->sectorId ? 'selected' : '' ?>
                <option value="<?php echo $row->sectorId ?>" <?php echo $sel ?>><?php echo $row->sector ?></option>
            <?php endforeach ?>
        </select>&nbsp;&nbsp;
        <select style="width: 120px;" id="user" name="user" id="formClient-Sector" class="text-bold text-center select2">
            <option value="">Select User</option>
            <?php foreach ($userQuery as $row): ?>
                <?php $sel = $page->userId==$row->id ? 'selected' : '' ?>
                <option value="<?php echo $row->id ?>" <?php echo $sel ?>><?php echo $row->username ?></option>
            <?php endforeach ?>
        </select>&nbsp;&nbsp;&nbsp;&nbsp;
    </div>
</section>
<section class="content">

    <div class="row">
        <div class="col-sm-7">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?php echo $PATLOLLER_title;?></strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                    <div class="example table-responsive">
                        <table id="dataTable0" class="table table-bordered table-striped">
                            <thead>
                            <tr  style="background-color: #ECF0F5">
                                <th class="text-center">PATROLLER</th>
                                <th class="text-center">NO OF<br>PATROLS</th>
                                <th class="text-center">DURATION<br>[H:MM]</th>
                                <th class="text-center">AVG DURATION<br>[H:MM]</th>
                            </tr>
                            <tr id = "recordSum" style="background-color: #ECF0F5">
                                <td colspan="4" class="text-center">No records found.</td>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="box-body">
                    <div class="example table-responsive" style="overflow: auto; height: 400px">
                        <table id="dataTable" class="table table-bordered table-striped">
                        <?php
                        if($page->sectorId)$sectorQuery=$this->cpf_stats_model->getSector($page->sectorId);
                        $sumcount = array('user'=>0,'potrols'=>0,'duration'=>0);
                        if(!empty($sectorQuery))
                        {
                            $record_sum= 0;
                            foreach($sectorQuery as $sector_row) {
                                $record_count = 0;
                                $subcount = array('user' => 0, 'potrols'=>0, 'duration'=>0);
                                if($page->userId)$userQuery = $this->cpf_stats_model->getUser($sector_row->sectorId,$page->userId);
                                else $userQuery = $this->cpf_stats_model->getUser($sector_row->sectorId,0);
                                if (!empty($userQuery)) {
                                ?>
                                    <thead id = "<?php echo "subhead".$sector_row->sectorId;?>">
                                    </thead>
                                    <tbody>
                                    <?php
                                        foreach ($userQuery as $user_row) {
                                            $count = array('user'=>0, 'potrols'=>0, 'duration'=>0);
                                            $dutyQuery = $this->cpf_stats_model->getDuty($page->month, $page->date, $user_row->id,0);

                                            if ($dutyQuery) {
                                                $durtempOn = null;
                                                $durtempOff = null;
                                                foreach ($dutyQuery as $duty_row) {
                                                    $count['potrols'] = $count['potrols']+1;
                                                    $durtempOn = explode(' ', $duty_row->onDutyTime);
                                                    $durtempOn = explode(':', $durtempOn[1]);
                                                    $durtempOff = explode(' ', $duty_row->offDutyTime);
                                                    $durtempOff = explode(':', $durtempOff[1]);

                                                    $count['duration'] += ($durtempOff[0] * 60 + $durtempOff[1]) - ($durtempOn[0] * 60 + $durtempOn[1]);
                                                }
                                                $hh = (int)($count['duration'] / 60);
                                                $mm = $count['duration'] % 60;
                                                $avg_hh = (int)($count['duration'] / ($count['potrols'] * 60));
                                                $avg_mm = ($count['duration']/$count['potrols']) % 60;
                                                $count['user']++;
                                                ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $user_row->username; ?></td>
                                                    <td class="text-center"><?php echo $count['potrols'];?></td>
                                                    <td class="text-center"><?php echo $hh." : ".$mm; ?></td>
                                                    <td class="text-center"><?php echo $avg_hh . " : " . $avg_mm; ?></td>
                                                </tr>
                                                <?php
                                                $record_count++;
                                            }
                                            $subcount['user'] += $count['user'];
                                            $subcount['potrols'] += $count['potrols'];
                                            $subcount['duration'] += $count['duration'];
                                        }
                                     if($record_count){
                                         $record_sum++;
                                         ?>
                                         <tr style="background-color: #ECF0F5">
                                             <td colspan="4"></td>
                                         </tr>
                                         <?php
                                     }?>
                                    </tbody>
                                        <?php
                                        if($record_count){
                                           $sub_hh = (int)($subcount['duration'] / 60);
                                           $sub_mm = $subcount['duration'] % 60;
                                           $sub_avg_hh = (int)($subcount['duration'] / ($subcount['potrols'] * 60));
                                           $sub_avg_mm = ($subcount['duration']/$subcount['potrols']) % 60;

                                        ?>
                                    <script>
                                        $("#<?php echo 'subhead'.$sector_row->sectorId;?>").append('' +
                                            '<tr>\n' +
                                            '<th colspan=\'4\' class="text-center" style="background-color: #ADD7F0"><?php echo strtoupper($sector_row->sector); ?></th>\n' +
                                            '</tr>\n' +
                                            '<tr style="background-color: #ECF0F5">\n' +
                                            '    <th class="text-center">PATROLLER</th>\n' +
                                            '    <th class="text-center">NO OF<br>PATROLS</th>\n' +
                                            '    <th class="text-center">DURATION<br>[H:MM]</th>\n' +
                                            '    <th class="text-center">AVG DURATION<br>[H:MM]</th>\n' +
                                            '</tr>\n' +
                                            '<tr style="background-color: #ECF0F5">\n' +
                                            '    <th class="text-center"><?php echo $subcount['user'];?></th>\n' +
                                            '    <th class="text-center"><?php echo $subcount['potrols'];?></th>\n' +
                                            '    <th class="text-center"><?php echo $sub_hh." : ".$sub_mm; ?></th>\n' +
                                            '    <th class="text-center"><?php echo $sub_avg_hh." : ".$sub_avg_mm; ?></th>\n' +
                                            '</tr>');
                                    </script>
                                    <?php
                                }
                                }
                                $sumcount['user'] += $subcount['user'];
                                $sumcount['potrols'] += $subcount['potrols'];
                                $sumcount['duration'] += $subcount['duration'];

                            }
                            if($record_sum)
                            {
                                    $sum_hh = (int)($sumcount['duration'] / 60);
                                    $sum_mm = $sumcount['duration'] % 60;
                                    $sum_avg_hh = (int)($sumcount['duration'] / ($sumcount['potrols'] * 60));
                                    $sum_avg_mm = ($sumcount['duration']/$sumcount['potrols']) % 60;
                                ?>
                                <SCRIPT>
                                    $('#recordSum').empty()
                                    $("#recordSum").append('<th class="text-center"><?php echo $sumcount['user']?></th>\n' +
                                                        '<th class="text-center"><?php echo $sumcount['potrols']?></th>\n' +
                                                        '<th class="text-center"><?php echo $sum_hh." : ".$sum_mm; ?></th>\n' +
                                                        '<th class="text-center"><?php echo $sum_avg_hh." : ".$sum_avg_mm; ?></th>');
                                </SCRIPT>
                            <?php
                            }

                        }
                        ?>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <div class="col-sm-5">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?php echo $VOLLUNTEER_title;?></strong></h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="example table-responsive" style="overflow: auto; height: 515px">
                        <table id="dataTable3" class="table table-bordered table-striped">
                            <thead>
                            <tr style="background-color: #ECF0F5">
                                <th class="text-center">VOLUNTEER</th>
                                <th class="text-center">NO OF<br>PATROLS</th>
                                <th class="text-center">DURATION<br>[H:MM]</th>
                            </tr>
                            <tr id = "harecordSum" style="background-color: #ECF0F5">
                                <td colspan="4" class="text-center">No records found.</td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $ha_sumcount = array('user'=>0,'potrols'=>0,'duration'=>0);
                            $record_count = 0;
                            if($page->userId)$userQuery = $this->cpf_stats_model->getUser(0,$page->userId);
                            else $userQuery = $this->cpf_stats_model->getUser(0,0);
                            if (!empty($userQuery)) {
                                foreach ($userQuery as $user_row) {
                                    $count = array('user'=>0, 'potrols'=>0, 'duration'=>0);
                                    $dutyQuery = $this->cpf_stats_model->getDuty($page->month, $page->date, $user_row->id, 2);
                                    if ($dutyQuery) {
                                        $durtempOn = null;
                                        $durtempOff = null;
                                        foreach ($dutyQuery as $duty_row) {
                                            $count['potrols'] = $count['potrols']+1;
                                            $durtempOn = explode(' ', $duty_row->onDutyTime);
                                            $durtempOn = explode(':', $durtempOn[1]);
                                            $durtempOff = explode(' ', $duty_row->offDutyTime);
                                            $durtempOff = explode(':', $durtempOff[1]);

                                            $count['duration'] += ($durtempOff[0] * 60 + $durtempOff[1]) - ($durtempOn[0] * 60 + $durtempOn[1]);
                                        }
                                        $hh = (int)($count['duration'] / 60);
                                        $mm = $count['duration'] % 60;
                                        $count['user']++;
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $user_row->username; ?></td>
                                            <td class="text-center"><?php echo $count['potrols'];?></td>
                                            <td class="text-center"><?php echo $hh." : ".$mm; ?></td>
                                        </tr>
                                        <?php
                                        $record_count++;
                                    }
                                    $ha_sumcount['user'] += $count['user'];
                                    $ha_sumcount['potrols'] += $count['potrols'];
                                    $ha_sumcount['duration'] += $count['duration'];
                                }
                            }
                            if($record_count)
                            {
                                $sum_hh = (int)($ha_sumcount['duration'] / 60);
                                $sum_mm = $ha_sumcount['duration'] % 60;
                                ?>
                                <SCRIPT>
                                    $('#harecordSum').empty()
                                    $("#harecordSum").append('<th class="text-center"><?php echo $ha_sumcount['user']?></th>\n' +
                                        '<th class="text-center"><?php echo $ha_sumcount['potrols']?></th>\n' +
                                        '<th class="text-center"><?php echo $sum_hh." : ".$sum_mm; ?></th>\n');
                                </SCRIPT>
                                <?php
                            }

                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><strong><?php echo $TOTAL_title;?></strong></h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>

                </div>
                <div class="box-body">
                    <div class="example table-responsive">
                        <table id="dataTable2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th rowspan="2" class="text-center">DATE[M-Y]</th>
                                <?php
                                $sectorQuery = $this->cpf_stats_model->getSector(0);
                                if(!empty($sectorQuery))
                                {
                                    $sum = array(array('hour'=>0,'count'=>0));
                                    for($i=1; $i< 100; $i++)
                                    {
                                        $sum[$i]['hour'] = 0;
                                        $sum[$i]['count'] = 0;
                                    }
                                    foreach($sectorQuery as $sector_row) {?>
                                        <th colspan="2" class="text-center"><I><?php echo $sector_row->sector;?></I></th>
                                <?php
                                    }?>

                            </tr>
                            <tr>
                                <?php
                                foreach($sectorQuery as $sector_row) {?>
                                    <th class="text-center"><I>Hour</I></th>
                                    <th class="text-center"><I>Count</I></th>
                                <?php
                                }?>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                $i=0;

                                foreach ($t_m as $m)
                                {
                                    $i++;
                                    $t_date = $m.'&nbsp-&nbsp'.$year;?>

                                    <tr>
                                        <th class="text-center"><?php echo $t_date;?></th>
                            <?php
                                    $j=0;
                                    foreach($sectorQuery as $sector_row) {
                                        $j++;
                                        $count=0;
                                        $hh=null;
                                        $mm=null;
                                        $duration = 0;
                                        $userQuery = $this->cpf_stats_model->getUser($sector_row->sectorId, $page->userId);
                                        if (!empty($userQuery)) {
                                            foreach ($userQuery as $user_row) {
                                                $dutyQuery = $this->cpf_stats_model->getDuty($i . "/" . $year, 0, $user_row->id, 0);
                                                if (!empty($dutyQuery)) {
                                                    foreach ($dutyQuery as $duty_row) {
                                                        $count++;
                                                        $durtempOn = explode(' ', $duty_row->onDutyTime);
                                                        $durtempOn = explode(':', $durtempOn[1]);
                                                        $durtempOff = explode(' ', $duty_row->offDutyTime);
                                                        $durtempOff = explode(':', $durtempOff[1]);
                                                        $duration += ($durtempOff[0] * 60 + $durtempOff[1]) - ($durtempOn[0] * 60 + $durtempOn[1]);

                                                    }
                                                }
                                            }
                                        }
                                        if($count) {
                                            $sum[$j]['count'] += $count;
                                            $sum[$j]['hour'] += $duration;
                                            $hh = (int)($duration / 60);
                                            $mm = $duration % 60;
                                            $duration=$hh." : ".$mm;
                                        }
                                        else {
                                            $count = null;
                                            $duration = null;
                                        }
                                            ?>
                                        <th class="text-center"><?php echo $duration;?></th>
                                        <th class="text-center"><?php echo $count;?></th>
                                        <?php
                                    }
                            ?>
                                    </tr>
                            <?php
                                }
                            ?>
                            <tr style="background-color: #ECF0F5"><th></th>
                                <?php
                                    $i = 0;
                                    foreach ($sectorQuery as $row_sum)
                                    {
                                        $i++;
                                        $hh = (int)($sum[$i]['hour'] / 60);
                                        $mm = $sum[$i]['hour'] % 60;
                                        if($sum[$i]['count'])
                                        {
                                            $duration = $duration=$hh." : ".$mm;
                                            ?>
                                            <th class="text-center"><?php echo $duration;?></th>
                                            <th class="text-center"><?php echo $sum[$i]['count'];?></th>
                                <?php    }
                                        else echo"<th></th><th></th>";
                                    }
                                ?>
                            </tr>
                            </tbody>

                                <?php
                                }
                                ?>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
        </div>
    </div>
    <?php include viewPath('includes/footer'); ?>
</section>
<!-- /.content -->



<script>
/*
    function ajaxReport(month, date, sector, user)
    {
        $.ajax({
            url : "",
            data:{'month':month, 'date':date, 'sector':sector, 'user':user},
            type: "POST",
            success: function(result)
            {
                $('#report').empty().html(result).fadeIn('slow');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {

            }
        });
    }
*/
$(document).ready(function() {
    $('.form-validate').validate();
    //Initialize Select2 Elements
    $('.select2').select2()
    $('#month').monthpicker();

    $('#date').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
    });
    $('#month').change(function () {
        $('#date').val('');
        $('.form-validate').submit();
    });
    $('#date').change(function () {
        $('#month').val('');
        $('.form-validate').submit();
    });
    $('#user').change(function () {
        $('.form-validate').submit();
    });
    $('#sector').change(function () {
        $('.form-validate').submit();
    });
})

</script>