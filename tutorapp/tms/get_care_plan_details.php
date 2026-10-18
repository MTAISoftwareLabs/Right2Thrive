<?php

    include_once 'dbConnection.php';
    require_once 'dompdf/autoload.inc.php';
    $html = '<html><head></head><body>';
    $planID = $_GET['id'];
    $displayData = false;
    if(is_numeric($planID) && $planID>0)
    {
        $query_tutor_id = "select cpo_core_plan.*, cpo_usermaster.vUserName 
            from cpo_core_plan
            left join cpo_usermaster on cpo_usermaster.iUserId=cpo_core_plan.iStudentId
            where cpo_core_plan.id =".$planID;
        $result_tutor_id = runquery($query_tutor_id);
        if(mysqli_num_rows($result_tutor_id)>0)
        {
            $row = mysqli_fetch_array($result_tutor_id);
            $displayData = true;
            $strSQLSupportCircle = "select * from cpo_support_circle where core_plan=".$planID;
            $resultSupportCircle = runquery($strSQLSupportCircle);

            $strSQLMedicationPlan = "select * from cpo_medication_plan where core_plan=".$planID;
            $resultMedicationPlan = runquery($strSQLMedicationPlan);
            $html = $html.'<table style="width:100%">
                <tr><td colspan="2"><strong>1. Daily Check-In</strong></td></tr>
                <tr>
                    <td style="width:25%"><b>Student Name:</b></td>
                    <td style="width:25%">'. $row['vUserName'].'</td>
                    <td style="width:25%"><b>Submitted:</b></td>
                    <td style="width:25%">'. date("d/m/Y", strtotime($row['submitted_on'])).'</td>
                </tr>
                <tr>
                    <td style="width:25%"><b>How am I feeling today?</b></td>
                    <td style="width:25%">';
                            if($row['emotion']=='great')
                            {
                                $html = $html.'&#128512;';
                            }
                            else if($row['emotion']=='good')
                            {
                                $html = $html.'&#128578;';
                            }
                            else if($row['emotion']=='ok')
                            {
                                $html = $html.'&#128528;';
                            }
                            else if($row['emotion']=='not_so_good')
                            {
                                $html = $html.'&#128533;';
                            }
                            else if($row['emotion']=='struggling')
                            {
                                $html = $html.'&#128546;';
                            }
                        
                    $html = $html.'</td>
                    <td style="width:25%"><b>Overall Wellbeing Score:</b></td>
                    <td style="width:25%">'. $row['wbscore'].'</td>
                </tr>
                <tr>
                    <td style="width:25%">
                        <b>What’s influencing my mood?</b>
                    </td>
                    <td colspan="3">'. str_replace("Other", $row['other_mood'], $row['mood']);
                        
                    $html = $html.'</td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>2. My Support Circle</strong></td></tr>
                <tr>
                    <td style="width:25%">
                        <b>Key Support People?</b>
                    </td>
                </tr>
                <tr>
                    <td style="width:25%"> 
                        &nbsp;
                    </td>
                    <td style="width:25%">
                        <b>Name</b>
                    </td>
                    <td>
                        <b>Relationship</b>
                    </td>
                    <td style="width:25%"> 
                        &nbsp;
                    </td>
                </tr>';
                
                    while($rowSupport = mysqli_fetch_array($resultSupportCircle))
                    {
                        $html = $html.'<tr>
                            <td style="width:25%"> 
                                &nbsp;
                            </td>
                            <td style="width:25%">'.$rowSupport['contactname'].'
                            </td>
                            <td style="width:25%">'.$rowSupport['contactrelationship'].'
                            </td>
                            <td style="width:25%"> 
                                &nbsp;
                            </td>
                        </tr>';
                    }
                
                $html = $html.'<tr>
                    <td style="width:25%">
                        <b>Mental Health Professionals</b>
                    </td>
                </tr>
                <tr>
                    <td style="width:25%"><b>Therapist</b></td>
                    <td style="width:25%">'. $row['therapist'].'</td>
                    <td style="width:25%"><b>Contact:</b></td>
                    <td style="width:25%">'. $row['therapist_contact'].'</td>
                </tr>
                <tr>
                    <td style="width:25%"><b>Psychiatrist</b></td>
                    <td style="width:25%">'. $row['psychiatrist'].'</td>
                    <td style="width:25%"><b>Contact:</b></td>
                    <td style="width:25%">'. $row['psychiatrist_contact'].'</td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>3. Wellness Toolkit</strong></td></tr>
                <tr>
                    <td style="width:25%"><b>What helps me feel better?</b></td>
                    <td colspan="3">'.str_replace("Other", $row['other_feel'], $row['feel']).'</td>
                </tr>
                <tr>
                    <td  colspam="4"><b>New strategies I want to try:</b></td>
                </tr>
                <tr>
                    <td colspam="4">1: '. $row['strategy1'].'</td>
                </tr>
                <tr>
                    <td colspam="4">2: '. $row['strategy2'].'</td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>4. Medication Plan</strong></td></tr>
                <tr>
                    <td style="width:25%">
                        <b>Current Medications</b>
                    </td>
                </tr>
                <tr>
                    <td style="width:25%"> 
                        <b>Medication Name</b>
                    </td>
                    <td style="width:25%">
                        <b>Dosage</b>
                    </td>
                    <td>
                        <b>Time</b>
                    </td>
                    <td style="width:25%"> 
                        &nbsp;
                    </td>
                </tr>';
                
                    while($rowMed = mysqli_fetch_array($resultMedicationPlan))
                    {
                        $html = $html.'<tr>
                            <td style="width:25%">'.$rowMed['medicinename'].'</td>
                            <td style="width:25%">'.$rowMed['dossage'].'</td>
                            <td style="width:25%">'.$rowMed['time'].'</td>
                            <td style="width:25%">&nbsp;</td>
                        </tr>';
                    }
                
                $html = $html.'<tr>
                    <td style="width:25%"> 
                        <b>Side Effects to Watch for?</b>
                    </td>
                    <td style="width:25%">
                        '.$row['side_effects'].'
                    </td>
                    <td>
                        <b>Pharmacy Contact</b>
                    </td>
                    <td style="width:25%"> 
                        '.$row['pharmacy'].'
                    </td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>5. Recognizing Warning Signs</strong></td></tr>
                <tr>
                    <td colspan="2"> 
                        <b>Personal Warning Signs:</b>
                    </td>
                    <td colspan="2"> 
                        1. '.$row['warning1'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        2. '.$row['warning2'].'
                    </td>
                    <td colspan="2"> 
                        3. '.$row['warning3'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <b>Action Plan for Warning Signs:</b>
                    </td>
                    <td colspan="2"> 
                        1. '.$row['actionplan1'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        2. '.$row['actionplan2'].'
                    </td>
                    <td colspan="2"> 
                        3. '.$row['actionplan3'].'
                    </td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>6. Goals and Aspirations</strong><br>Short-term Goal (Next Month)</td></tr>
                <tr>
                    <td style="width:25%"> 
                        <b>I want to:</b>
                    </td>
                    <td colspan="3">
                        '.$row['goal_short_term'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="3"> 
                        <b>Steps to achieve this goal</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        1. '.$row['step1_short_term'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        2. '.$row['step2_short_term'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        3. '.$row['step3_short_term'].'
                    </td>
                </tr>
                <tr>
                    <td style="width:25%"> 
                        <b>I hope to (Long term):</b>
                    </td>
                    <td colspan="3">
                        '.$row['hope_long_term'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="3"> 
                        <b>Milestones Along the Way:</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        1. '.$row['milestone1_long_term'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        2. '.$row['milestone2_long_term'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        3. '.$row['milestone3_long_term'].'
                    </td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>7. Daily Self-Care Checklist</strong></td></tr>
                <tr>
                    <td colspan="4">'.str_replace("Other", $row['other_daily_checklist'], $row['daily_checklist']).'</td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>8. Community Engagement</strong></td></tr>
                <tr>
                    <td><b>Activities I am interested in joining:</b></td>
                    <td colspan="3">'.str_replace("Other", $row['other_interested_activities'], $row['interested_activities']).'</td>
                </tr>
                <tr>
                    <td><b>Skills I Want to Develop:</b></td>
                </tr>
                <tr>
                    <td colspan="2">1. '.$row['skills_to_develop_1'].'</td>
                    <td colspan="2">2. '.$row['skills_to_develop_2'].'</td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>9. Crisis Plan</strong></td></tr>
                <tr>
                    <td><b>If I\'m in crisis, I will:</b></td>
                </tr>
                <tr>
                    <td width="25%"><b>Contact:</b></td>
                    <td width="25%">'.$row['crisis_contact'].'</td>
                    <td width="25%"><b>Phone:</b></td>
                    <td width="25%">'.$row['crisis_phone'].'</td>
                </tr>
                <tr>
                    <td width="25%"><b>Use this Coping Strategy:</b></td>
                    <td width="25%">'.$row['crisis_coping_strategy'].'</td>
                </tr>
                <tr>
                    <td width="25%"><b>Emergency Contact:</b></td>
                    <td width="25%">'.$row['emergency_contact'].'</td>
                    <td width="25%"><b>Phone:</b></td>
                    <td width="25%">'.$row['emergency_phone'].'</td>
                </tr>
                <tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>10. Reflection and Gratitude</strong></td></tr>
                <tr>
                    <td width="25%"><b>One thing I’m proud of today:</b></td>
                    <td width="25%">'.$row['proud_of'].'</td>
                </tr>
                <tr>
                    <td width="25%"><b>Something I’m looking forward to:</b></td>
                    <td width="25%">'.$row['looking_forward_to'].'</td>
                </tr>
                <tr>
                    <td width="25%"><b>One person I’m grateful for:</b></td>
                    <td width="25%">'.$row['greatful_for'].'</td>
                </tr>
            </table>';
        }
    }
    $html = $html.'</body></html>';
    use Dompdf\Dompdf;

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("Care Plan - ".$row['vUserName']. ' - '.date("d-m-Y", strtotime($row['submitted_on'])).'.pdf');
?>