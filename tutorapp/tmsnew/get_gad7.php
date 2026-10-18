<?php

    include_once 'dbConnection.php';
    require_once 'dompdf/autoload.inc.php';
    $html = '<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }
        </style>
    </head><body>';
    $gadid = $_GET['id'];
    $displayData = false;
    if(is_numeric($gadid) && $gadid>0)
    {
        $query_tutor_id = "select cpo_gad7.*, cpo_usermaster.vUserName 
            from cpo_gad7
            left join cpo_usermaster on cpo_usermaster.iUserId=cpo_gad7.iStudentId
            where cpo_gad7.id =".$gadid;
        $result_tutor_id = runquery($query_tutor_id);
        if(mysqli_num_rows($result_tutor_id)>0)
        {
            $row = mysqli_fetch_array($result_tutor_id);
            $displayData = true;
            $blanktd = '<td></td>';
            $html = $html.'<table style="width:100%">
                <tr>
                    <td style="width:25%"><b>Student Name:</b></td>
                    <td style="width:25%">'. $row['vUserName'].'</td>
                    <td style="width:25%"><b>Submitted:</b></td>
                    <td style="width:25%">'. date("d/m/Y", strtotime($row['submit_date'])).'</td>
                </tr>
                <tr>
                    <td colspan="4"><b>Over the last 2 weeks, how often have you been bothered by the following problems?</b></td></tr>
                </table>
                <table style="width:100%">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Not at all</th>
                        <th scope="col">Several Days</th>
                        <th scope="col">More than<br>half the days</th>
                        <th scope="col">Nearly everyday</th>
                    </tr>
                </thead>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>1. Feeling nervous, anxious or on edge</b></td>';
            if($row['radio1']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio1']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio1']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio1']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>2. Not being able to stop or control worrying</b></td>';
            if($row['radio2']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio2']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio2']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio2']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>3. Worrying too much about different things</b></td>';
            if($row['radio3']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio3']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio3']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio3']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>4. Trouble relaxing</b></td>';
            if($row['radio4']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio4']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio4']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio4']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>5. Being so restless that it is hard to sit still</b></td>';
            if($row['radio5']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio5']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio5']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio5']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>6. Becoming easily annoyed or irritable</b></td>';
            if($row['radio6']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio6']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio6']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio6']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>Feeling afraid as if something awful might happen</b></td>';
            if($row['radio7']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio7']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio7']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio7']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"></td>';
            $total = $row['radio1'] + $row['radio2'] + $row['radio3'] + $row['radio4'] + $row['radio5'] + $row['radio6'] + $row['radio7'];
            if($total>=0 && $total<=4)
            {
                $status = 'No Anxiety';
            }
            else if($total>=5 && $total<=9)
            {
                $status = 'Low Anxiety';
            }
            else if($total>=10 && $total<=14)
            {
                $status = 'Moderate Anxiety';
            }
            else
            {
                $status = 'Severe Anxiety';
            }
            $html = $html.$blanktd.$blanktd.'<td><b>Total</b></td><td>'.$total.'&nbsp'.$status.'</td>';
            $html = $html.'</tr>';    
            $html = $html.'</table>';
        }
    }
    $html = $html.'</body></html>';
    if(isset($_GET['view']) && $_GET['view']=='modal')
    {
        echo $html;
        exit;
    }
    //echo $html;
    //exit;
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("GAD7 - ".$row['vUserName']. ' - '.date("d-m-Y", strtotime($row['submit_date'])).'.pdf');
?>