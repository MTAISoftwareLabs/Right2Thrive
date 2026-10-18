<?php
//ini_set('display_errors','Off');
    include_once 'dbConnection.php';
    require_once 'dompdf/autoload.inc.php';
    $html = '<html><head></head><body>';
    $planID = $_GET['id'];
    $displayData = false;
    if(is_numeric($planID) && $planID>0)
    {
        $query_tutor_id = "select cpo_weekly_wellness_checkin.*, cpo_usermaster.vUserName 
            from cpo_weekly_wellness_checkin
            left join cpo_usermaster on cpo_usermaster.iUserId=cpo_weekly_wellness_checkin.iStudentId
            where cpo_weekly_wellness_checkin.id =".$planID;
        $result_tutor_id = runquery($query_tutor_id);
        

        if(mysqli_num_rows($result_tutor_id)>0)
        {
            $row = mysqli_fetch_array($result_tutor_id);
            
            $strQuerySteps = "select * from cpo_weekly_wellness_steps where wellness_id=".$planID;
            $resultSteps= runquery($strQuerySteps);
            
            $strQueryChallenges = "select * from cpo_weekly_wellness_challenges where wellness_id=".$planID;
            $resultChallenges = runquery($strQueryChallenges);
            
            $strQueryStrategies = "select * from cpo_weekly_wellness_strategies where wellness_id=".$planID;
            $resultStrategy = runquery($strQueryStrategies);

            $strQueryPchanges = "select * from cpo_weekly_wellness_pchanges where wellness_id=".$planID;
            $resultPchanges = runquery($strQueryPchanges);

            $strQueryWBChallenges = "select * from cpo_weekly_wellness_wbchallenges where wellness_id=".$planID;
            $resultWBChallenges  = runquery($strQueryWBChallenges);

            $strQueryHAspects = "select * from cpo_weekly_wellness_hfullaspects where wellness_id=".$planID;
            $resultHAspects  = runquery($strQueryHAspects);

            $strQueryCHGAspects = "select * from cpo_weekly_wellness_chaspects where wellness_id=".$planID;
            $resultCHGAspects = runquery(($strQueryCHGAspects));

            $strreqconcerns = "select * from cpo_weekly_wellness_reqconcerns where wellness_id=".$planID;
            $resultreqconcerns = runquery(($strreqconcerns));
            
            $strFocus = "select * from cpo_weekly_wellness_focusareas where wellness_id=".$planID;
            $resultFocus = runquery(($strFocus));

            $strEvents = "select * from cpo_weekly_wellness_events where wellness_id=".$planID;
            $resultEvents = runquery($strEvents);

            $strPride = "select * from cpo_weekly_wellness_pridepoint where wellness_id=".$planID;
            $resultPride= runquery($strPride);

            $strLearning = "select * from cpo_weekly_wellness_learning where wellness_id=".$planID;
            $resultLearning = runquery($strLearning);
            
            $displayData = true;
            
            $html = $html.'<table style="width:100%">
                <tr><td colspan="2"><strong>1. This Week\'s Journey</strong></td></tr>
                <tr>
                    <td style="width:25%"><b>Student Name:</b></td>
                    <td style="width:25%">'. $row['vUserName'].'</td>
                    <td style="width:25%"><b>Submitted:</b></td>
                    <td style="width:25%">'.date("d/m/Y", strtotime($row['date_submission'])).'</td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Progress Towards My Goals</b>&nbsp;<small>(What steps did I take? Even small actions count!)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Steps</b>
                    </td>
                </tr>';
                
                    
                    while($rowSupport = mysqli_fetch_array($resultSteps))
                    {
                        $html = $html.'<tr><td style="width:25%">'.$rowSupport['step'].'</td></tr>';
                    }
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>Challenges I Faced</b>&nbsp;<small>(What obstacles did I encounter?)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Challenges</b>
                    </td>
                </tr>';
                    while($rowChallenge = mysqli_fetch_array($resultChallenges))
                    {
                        $html = $html.'<tr><td style="width:25%">'.$rowChallenge['challenge'].'</td></tr>';
                    }
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>How I Handled Challenges</b>&nbsp;<small>(What strategies did I use? Did I seek support?)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Strategies Used</b>
                    </td>
                </tr>';
                    while($rowStrategy = mysqli_fetch_array($resultStrategy))
                    {
                        $html = $html.'<tr><td style="width:25%">'.$rowStrategy['strategy'].'</td></tr>';
                    }
                    
                $html = $html.'<tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>2. My Emotional Landscape</strong></td></tr>
                <tr>
                    <td style="width:25%"><b>Overall Mood This Week</b></td>
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
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Positive Changes I\'ve Noticed</b>&nbsp;<small>(Any improvements in mood, energy, relationships, etc.?)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Positive Changes</b>
                    </td>
                </tr>';
                    
                    while($rowPChange= mysqli_fetch_array($resultPchanges))
                    {
                        $html = $html.'<tr><td style="width:25%"> '.$rowPChange['positive_changes'].'</td></tr>';
                    }
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>Challenges in My Well-being</b>&nbsp;<small>(Any setbacks or worsening of symptoms?)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Challenges Noticed</b>
                    </td>
                </tr>';
                    
                    while($rowWBChallenge= mysqli_fetch_array($resultWBChallenges))
                    {
                        $html = $html.'<tr><td style="width:25%"> '. $rowWBChallenge['wbchallenge'].'</td></tr>';
                    }
                
                $html = $html.'<tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>3. Support and Feedback</strong></td></tr>
                <tr>
                    <td colspan="4">
                        <b>What\'s Been Helpful</b>&nbsp;<small>(People, activities, or strategies that supported me)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Helpful Aspects</b>
                    </td>
                </tr>';
                    while($rowHAspects= mysqli_fetch_array($resultHAspects))
                    {
                        $html = $html.'<tr><td style="width:25%">'.$rowHAspects['hfullaspects'].'</td></tr>';
                    }
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>What\'s Been Challenging</b>&nbsp;<small>(Things that didn\'t work well or need improvement)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Challenging Aspects</b>
                    </td>
                </tr>';
                    
                    while($rowCHGAspects= mysqli_fetch_array($resultCHGAspects))
                    {
                        $html = $html.'<tr><td style="width:25%">'. $rowCHGAspects['chaspects'].'</td></tr>';
                    }
                
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>My Requests or Concerns</b>&nbsp;<small>(Any support or changes I need going forward)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Requests/Concerns</b>
                    </td>
                </tr>';
                    
                    while($rowreqconcerns= mysqli_fetch_array($resultreqconcerns))
                    {
                        $html = $html.'<tr><td style="width:25%">'. $rowreqconcerns['reqconcerns'].'</td></tr>';
                    }
                $html = $html.'<tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>4. Looking Ahead</strong></td></tr>
                <tr>
                    <td colspan="4">
                        <b>My Focus for Next Week</b>&nbsp;<small>(One thing I want to work on or achieve)</small>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Focus Area</b>
                    </td>
                </tr>';
                    
                    while($rowFocus= mysqli_fetch_array($resultFocus))
                    {
                        $html = $html.'<tr><td style="width:25%">'. $rowFocus['focusareas'].'</td></tr>';
                    }
                
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>Something I\'m Looking Forward To</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Upcoming Events/Activities</b>
                    </td>
                </tr>';
                
                    
                    while($rowEvents= mysqli_fetch_array($resultEvents))
                    {
                        $html = $html.'<tr><td style="width:25%">'.$rowEvents['events'].'</td></tr>';
                    }
                
                $html = $html.'<tr><td colspan="4"><hr></td></tr>
                <tr><td colspan="2"><strong>5. Self-Reflection</strong></td></tr>
                <tr>
                    <td colspan="4">
                        <b>One Thing I\'m Proud of This Week</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Pride Point</b>
                    </td>
                </tr>';
                
                    
                    while($rowPride= mysqli_fetch_array($resultPride))
                    {
                        $html = $html.'<tr><td style="width:25%">'. $rowPride['pride_point'].'</td></tr>';
                    }
                    
                $html = $html.'<tr>
                    <td colspan="4">
                        <b>Something I Learned About Myself</b>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <b>Learning</b>
                    </td>
                </tr>';
                
                    
                    while($rowLearn= mysqli_fetch_array($resultLearning))
                    {
                        $html = $html.'<tr><td style="width:25%">'.$rowLearn['learning'].'</td></tr>';
                    }
                    
                
            $html = $html.'</table>';
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
$dompdf->stream("Weekly Wellness Details - ".$row['vUserName']. ' - '.date("d-m-Y", strtotime($row['date_submission'])).'.pdf');
?>