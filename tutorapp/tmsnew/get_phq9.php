<?php

    include_once 'dbConnection.php';
    require_once 'dompdf/autoload.inc.php';
    $html = '<html><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
            font-size:15px;
        }
        </style>
    </head><body>';
    
    $gadid = $_GET['id'];
    $displayData = false;
    if(is_numeric($gadid) && $gadid>0)
    {
        $query_tutor_id = "select cpo_phq9.*, cpo_usermaster.vUserName 
            from cpo_phq9
            left join cpo_usermaster on cpo_usermaster.iUserId=cpo_phq9.iStudentId
            where cpo_phq9.id =".$gadid;
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
                    <td colspan="4"><b>1. Over the last 2 weeks, how often have you been bothered by any of the following problems? Read each item carefully, and circle your response.</b></td></tr>
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
                    <td style="width:50%"><b>a. Little interest or pleasure in doing things</b></td>';
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
                    <td style="width:50%"><b>b. Feeling down, depressed, or hopeless</b></td>';
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
                    <td style="width:50%"><b>c. Trouble falling asleep, staying asleep, or sleeping too much</b></td>';
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
                    <td style="width:50%"><b>d. Feeling tired or having little energy</b></td>';
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
                    <td style="width:50%"><b>e. Poor appetite or overeating</b></td>';
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
                    <td style="width:50%"><b>f. Feeling bad about yourself, feeling that you are a failure, or feeling that you have let yourself or your family down</b></td>';
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
                    <td style="width:50%"><b>g. Trouble concentrating on things such as reading the newspaper or watching television</b></td>';
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
                    <td style="width:50%"><b>h. Moving or speaking so slowly that other people could have noticed. Or being so fidgety or restless that you have been moving around a lot more than usual</b></td>';
            if($row['radio8']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio8']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio8']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio8']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $html = $html.'</tr>';
            $html = $html.'<tr>
                    <td style="width:50%"><b>i. Thinking that you would be better off dead or that you want to hurt yourself in some way</b></td>';
            if($row['radio9']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['radio9']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['radio9']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['radio9']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }
            $total = $row['radio1'] + $row['radio2'] + $row['radio3'] + $row['radio4'] + $row['radio5'] + $row['radio6'] + $row['radio7'] + $row['radio8'] + $row['radio9'];
            $html = $html.'</tr><tr><td colspan="3">&nbsp;</td><td><b>Total</b></td><td><b>'.$total.'</b></td></tr>';
            if($total<=4)
            {
                $strRemarks = 'The patient may not need depression treatment.';
            }
            else if($total<=14)
            {
                $strRemarks = 'Physician uses clinical judgment about treatment, based on patient’s duration of symptoms and functional impairment.';
            }
            else
            {
                $strRemarks = 'Warrants treatment for depression, using antidepressant, psychotherapy and/or a combination of treatment.';
            }
            $html = $html.'</tr><tr><td colspan="5" style="color:red">'.$strRemarks.'</td></tr>';
            $html = $html.'<tr><td colspan="5">2. If you checked off any problem on this questionnaire so far, how difficult have these problems made it for you to do your work, take care of things at home, or get along with other people?</td></tr>';
            $html = $html.'</table>';
            $html = $html.'<table style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">Not Difficult at All</th>
                        <th scope="col">Somewhat Difficult</th>
                        <th scope="col">Very Difficult</th>
                        <th scope="col">Extremely Difficult</th>
                    </tr>';
            $html = $html.'<tr>';
            if($row['difficulty']==0)
            {
                $html = $html.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd.$blanktd;
            }
            else if($row['difficulty']==1)
            {
                $html = $html.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd.$blanktd;
            }
            else if($row['difficulty']==2)
            {
                $html = $html.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>'.$blanktd;
            }
            else if($row['difficulty']==3)
            {
                $html = $html.$blanktd.$blanktd.$blanktd.'<td style="text-align:center;">&#10004;</td>';
            }

        }
    }
    $html = $html.'</body></html>';
    //echo $html;
    //exit;
    if(isset($_GET['view']) && $_GET['view']=='modal')
    {
        echo $html;
        exit;
    }
    
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("PHQ9 - ".$row['vUserName']. ' - '.date("d-m-Y", strtotime($row['submit_date'])).'.pdf');
?>