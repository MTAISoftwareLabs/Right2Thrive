<?php
    include_once 'dbConnection.php';
    if($_GET['flag'] == 'D')
    {
        $flag = 'Detention';
    }
    else
    {
        $flag = 'Exclusion';
    }
    $sql="SELECT * FROM cpo_detention where I_detentionid=".$_GET['id'];
    $rID=runquery1($sql);
    
    if(isset($rID))
    {
        $result_info = mysqli_fetch_array($rID);
    }
?>
<div class="row mt-5">
    <div class="col-12 text-center"><h3><?php echo $flag;?></h3></div>
</div>
<div class="row">
    <div class="col-4"><b>Date</b></div>
    <div class="col-8"><?  $date = explode('-', $result_info['D_detention']); echo $date[2]."/".$date[1]."/".$date[0];?></div>
</div>
<div class="row">
    <div class="col-4"><b>Reason</b></div>
    <div class="col-8">
        <?php 
            if( $result_info['V_reason'] != '') 
            {
                echo ucfirst($result_info['V_reason']);
            }
            else
            {
                echo "-";
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>What do I need to improve?</b><br>
        <?php
            if( $result_info['T_improve'] != '')
            {
                echo ucfirst($result_info['T_improve']);
            }
            else
            {
                echo "-";
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>Tutor  Comments</b><br>
        <?php
            if( $result_info['T_tcomments'] != '')
            {
                echo ucfirst($result_info['T_tcomments']);
            }
            else
            {
                echo "-";
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>Student Comments</b><br>
        <?php
            if( $result_info['T_scomments'] != '')
            {
                echo ucfirst($result_info['T_scomments']);
            }
            else
            {
                echo "-";
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <b>Parent Comments</b><br>
        <?php
            if( $result_info['T_pcomments'] != '')
            {
                echo ucfirst($result_info['T_pcomments']);
            }
            else
            {
                echo "-";
            }
        ?>
    </div>
</div>
<div class="row">
    <div class="col-12 text-left">
        <input type="button" class="btn btn-primary" value="Close" onclick="document.getElementById('id_deten').style.display='none';" />
    </div>
</div>