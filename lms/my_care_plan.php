<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include "dbConnection.php"; ?>
		<title>My Care Plan <?php echo sitename; ?></title>
		<?php include "metadata.php"; ?>
        <style>
            /* Style the form */
            #regForm {
                background-color: #ffffff;
                margin: 10px auto;
                padding: 5px;
                width: 70%;
                min-width: 300px;
            }

            /* Style the input fields */
            input {
                padding: 10px;
                width: 100%;
                font-size: 17px;
                font-family: Raleway;
                border: 1px solid #aaaaaa;
            }

            /* Mark input boxes that gets an error on validation: */
            input.invalid {
                background-color: #ffdddd;
            }

            /* Hide all steps by default: */
            .tab {
                display: none;
            }

            /* Make circles that indicate the steps of the form: */
            .step {
                height: 15px;
                width: 15px;
                margin: 0 2px;
                background-color: #bbbbbb;
                border: none;
                border-radius: 50%;
                display: inline-block;
                opacity: 0.5;
            }

            /* Mark the active step: */
            .step.active {
                opacity: 1;
            }

            /* Mark the steps that are finished and valid: */
            .step.finish {
                background-color: #04AA6D;
            }

            .input-hidden {
                position: absolute;
                left: -9999px;
            }

            input[type=radio]:checked + label>img {
                border: 1px solid #fff;
                box-shadow: 0 0 3px 3px #090;
            }

            /* Stuff after this is only to make things more pretty */
            input[type=radio] + label>img {
                border: 1px dashed #444;
                width: 150px;
                height: 150px;
                transition: 500ms all;
            }

            input[type=radio]:checked + label>img {
                transform: 
                    rotateZ(-10deg) 
                    rotateX(10deg);
            }

            /*
            | //lea.verou.me/css3patterns
            | Because white bgs are boring.
            */
            html {
                background-color: #fff;
                background-size: 100% 1.2em;
                background-image: 
                linear-gradient(
                    90deg, 
                    transparent 79px, 
                    #abced4 79px, 
                    #abced4 81px, 
                    transparent 81px
                ),
                linear-gradient(
                    #eee .1em, 
                    transparent .1em
                );
            }

            .formp{
                text-align: left !important;
            }

            .radioborder{
                border: 1px solid black;
            }
        </style>
    </head>
	<body>
		<div id="app">
			<?php include "sidebar.php"; ?>
			<div id="main">
				<?php include "header.php"; ?>
				<div class="page-heading">
					<h4>My E-Portfolio</h4>
				</div>
				<div class="page-content">
					<section class="row">
						<div class="col-12">
							<div class="tab-content card-header">
								<div class="tab-pane fade active show" id="uploadphoto" role="tabpanel" aria-labelledby="uploadphoto-tab">
									<div class="row">
										<div class="col-md-3">
										</div>
										<div class="col-md-6">
											<div class="card shadow mt-4">
												<div class="card-content">
													<div class="card-body text-center">
														<h5 class="mb-4">Welcome to Your Recovery Adventure!</h5>
                                                        <p>Congratulations on taking this important step! This plan is designed to empower you as you transition back into your vibrant daily life. Every step you take is a victory, and we’re excited to support you on this journey. Let’s dive in and explore the possibilities together!<br>Let’s get started!</p>
														<?php
                                                            if(isset($_POST['frmSubmitted']))
                                                            {
                                                                $iStudentId = $_SESSION['user_id'];
                                                                $tutor = $_POST['CBOSTUDENT'];
                                                                $emotion = $_POST['emotion'];
                                                                $wbscore = $_POST['wbscore'];
                                                                $strMood = "";
                                                                $other_mood = "";
                                                                if(is_array($_POST['mood']))
                                                                {
                                                                    for($i=0; $i<count($_POST['mood']); $i++)
                                                                    {
                                                                        $strMood = $strMood.$_POST['mood'][$i].",";
                                                                        if(strtolower($_POST['mood'][$i])=='other')
                                                                        {
                                                                            $other_mood = $_POST['other_mood'];
                                                                        }
                                                                    }
                                                                    $strMood = rtrim($strMood, ",");
                                                                }
                                                                $strTherapist = $_POST['therapist'];
                                                                $strTherapistContact = $_POST['therapist_contact'];
                                                                $strPsychiatrist = $_POST['psychiatrist'];
                                                                $strPsychiatristContact = $_POST['psychiatrist_contact'];
                                                        
                                                                $feel = "";
                                                                $other_feel = "";
                                                                if(is_array($_POST['feel']))
                                                                {
                                                                    for($i=0; $i<count($_POST['feel']); $i++)
                                                                    {
                                                                        $feel = $feel.$_POST['feel'][$i].",";
                                                                        if(strtolower($_POST['feel'][$i])=='other')
                                                                        {
                                                                            $other_feel = $_POST['other_feel'];
                                                                        }
                                                                    }
                                                                    $feel = rtrim($feel, ",");
                                                                }
                                                                $strategy1 = $_POST['strategy1'];
                                                                $strategy2 = $_POST['strategy2'];
                                                                $side_effects = $_POST['side_effects'];
                                                                $pharmacy = $_POST['pharmacy'];
                                                                $warning1 = $_POST['warning1'];
                                                                $warning2 = $_POST['warning2'];
                                                                $warning3 = $_POST['warning3'];
                                                                $actionplan1 = $_POST['actionplan1'];
                                                                $actionplan2 = $_POST['actionplan2'];
                                                                $actionplan3 = $_POST['actionplan3'];
                                                                $goal_short_term = $_POST['goal_short_term'];
                                                                $step1_short_term = $_POST['step1_short_term'];
                                                                $step2_short_term = $_POST['step2_short_term'];
                                                                $step3_short_term = $_POST['step3_short_term'];
                                                                $hope_long_term = $_POST['hope_long_term'];
                                                                $milestone1_long_term = $_POST['milestone1_long_term'];
                                                                $milestone2_long_term = $_POST['milestone2_long_term'];
                                                                $milestone3_long_term = $_POST['milestone3_long_term'];
                                                                $strDailyChecklist = "";
                                                                $strOtherCheckList = "";
                                                                if(is_array($_POST['daily_checklist']))
                                                                {
                                                                    for($i=0; $i<count($_POST['daily_checklist']); $i++)
                                                                    {
                                                                        $strDailyChecklist = $strDailyChecklist.$_POST['daily_checklist'][$i].",";
                                                                        if(strtolower($_POST['daily_checklist'][$i])=='other')
                                                                        {
                                                                            $strOtherCheckList = $_POST['other_daily_checklist'];
                                                                        }
                                                                    }
                                                                    $strDailyChecklist = rtrim($strDailyChecklist, ",");
                                                                }
                                                        
                                                                $strInterestedActivities = "";
                                                                $strOtherActivities = "";
                                                                if(is_array($_POST['interested_activities']))
                                                                {
                                                                    for($i=0; $i<count($_POST['interested_activities']); $i++)
                                                                    {
                                                                        $strInterestedActivities = $strInterestedActivities.$_POST['interested_activities'][$i].",";
                                                                        if(strtolower($_POST['interested_activities'][$i])=='other')
                                                                        {
                                                                            $strOtherActivities = $_POST['other_interested_activities'];
                                                                        }
                                                                    }
                                                                    $strInterestedActivities = rtrim($strInterestedActivities, ",");
                                                                }
                                                                $skills_to_develop_1 = $_POST['skills_to_develop_1'];
                                                                $skills_to_develop_2 = $_POST['skills_to_develop_2'];
                                                                $crisis_contact = $_POST['crisis_contact'];
                                                                $crisis_phone = $_POST['crisis_phone'];
                                                                $crisis_go_to = $_POST['crisis_go_to'];
                                                                $crisis_coping_strategy = $_POST['crisis_coping_strategy'];
                                                                $emergency_contact = $_POST['emergency_contact'];
                                                                $emergency_phone = $_POST['emergency_phone'];
                                                                $proud_of = $_POST['proud_of'];
                                                                $looking_forward_to = $_POST['looking_forward_to'];
                                                                $greatful_for = $_POST['greatful_for'];
                                                                $resources = $_POST['resources'];
                                                                $strInsert = "INSERT INTO cpo_core_plan
                                                                (iStudentId, tutorid, emotion, wbscore, mood, other_mood, therapist, therapist_contact, psychiatrist, psychiatrist_contact,
                                                                feel, other_feel, strategy1, strategy2, side_effects, pharmacy, warning1, warning2, warning3, actionplan1,
                                                                actionplan2, actionplan3, resources,goal_short_term, step1_short_term, step2_short_term, step3_short_term,
                                                                hope_long_term, milestone1_long_term, milestone2_long_term, milestone3_long_term, daily_checklist, 
                                                                other_daily_checklist, interested_activities, other_interested_activities, skills_to_develop_1, skills_to_develop_2,
                                                                crisis_contact, crisis_phone, crisis_go_to, crisis_coping_strategy, emergency_contact, emergency_phone,
                                                                proud_of, looking_forward_to, greatful_for)
                                                                VALUES ($iStudentId, $tutor, '$emotion', $wbscore, '$strMood', '$other_mood', '$strTherapist', '$strTherapistContact', '$strPsychiatrist', '$strPsychiatristContact',
                                                                '$feel', '$other_feel', '$strategy1', '$strategy2', '$side_effects', '$pharmacy', '$warning1', '$warning2', '$warning3', '$actionplan1',
                                                                '$actionplan2', '$actionplan3', '$resources', '$goal_short_term', '$step1_short_term', '$step2_short_term', '$step3_short_term',
                                                                '$hope_long_term', '$milestone1_long_term', '$milestone2_long_term', '$milestone3_long_term', '$strDailyChecklist', 
                                                                '$strOtherCheckList', '$strInterestedActivities', '$strOtherActivities', '$skills_to_develop_1', '$skills_to_develop_2',
                                                                '$crisis_contact', '$crisis_phone', '$crisis_go_to', '$crisis_coping_strategy', '$emergency_contact', '$emergency_phone',
                                                                '$proud_of', '$looking_forward_to', '$greatful_for')";
                                                               // echo $strInsert;
                                                               //exit;
                                                                runquery($strInsert);
                                                                $lastInsertedId = mysqli_insert_id($conn);

                                                                foreach($_POST['kt_docs_repeater_support'] as $support)
                                                                {
                                                                    $contactname = $support['contactname'];
                                                                    $contactrelationship = $support['contactrelationship'];
                                                                    $strInsertSupport = "INSERT INTO cpo_support_circle (core_plan, contactname,contactrelationship) 
                                                                    VALUES ($lastInsertedId, '$contactname', '$contactrelationship')";
                                                                    
                                                                    runquery($strInsertSupport);
                                                                }
                                                                foreach($_POST['kt_docs_repeater_medication'] as $medication)
                                                                {
                                                                    $medicinename = $medication['medicinename'];
                                                                    $dossage = $medication['dossage'];
                                                                    $time = $medication['time'];
                                                                    $strInsertMedical = "INSERT INTO cpo_medication_plan (core_plan, medicinename, dossage, `time`) 
                                                                    VALUES ($lastInsertedId, '$medicinename', '$dossage', '$time')";
                                                                    runquery($strInsertMedical);
                                                                }
                                                                $msg = "Your core plan is stored successfully.";
                                                                echo "<div class='alert alert-danger' role='alert'>Your core plan is stored successfull</div>";
                                                                addlog(18);
                                                            }
															/*if (isset($_POST['addreview']))
															{
																$sqlid = "SELECT * FROM cpo_ind_review WHERE iStudentId = " . $_SESSION['user_id'];
																$rsid = runquery($sqlid);
																$numid = $rsid ? mysqli_num_rows($rsid) : 0;
																if ($numid > 0) {
																	$rs = mysqli_fetch_array($rsid);
																}
																$allowedTypes = array('application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
																$fileType = $_FILES['TXUPFILE']['type'];
																if (in_array($fileType, $allowedTypes)) {
																	$uploaddir = "./uploads/";
																	if (!file_exists($uploaddir)) {
																		mkdir($uploaddir, 0755, true);
																	}
																	// var_dump($rs['iIndId']);
																	// exit;
																	// Insert the data into the database
																	$sqlInsert = "INSERT INTO cpo_ind_review (iStudentId, iTutorId, iflag, dDate, file_type) VALUES (" . $_SESSION['user_id'] . ", " . $_POST['CBOSTUDENT'] . ", 0, '" . date('Y/m/d') . "', 'mh_upload')";
																	runquery($sqlInsert);
																	$lastInsertedId = mysqli_insert_id($conn);
																	$userfile_tmp = $_FILES['TXUPFILE']['tmp_name'];
																	$newfile = $uploaddir . $lastInsertedId . ".doc";
																	move_uploaded_file($userfile_tmp, $newfile);
																	$sqlup = "UPDATE cpo_ind_review SET iflag = 0, dDate = '" . date('Y/m/d') . "', file_name='".$lastInsertedId.".doc' WHERE iIndId = " . $lastInsertedId;
																	runquery($sqlup);
																	$msg = "Your file was uploaded successfully.";
																	echo "<div class='alert alert-danger' role='alert'>Your file was uploaded successfully</div>";
																	addlog(18);
																}
																else {
																	$msg = "<div class='alert alert-success text-center' role='alert'>You can only upload MS-Word files.</div>";
																	echo "<div class='alert alert-danger' role='alert'>You can only upload MS-Word files.</div>";
																}
															}*/
															$query_tutor_id = "SELECT iTutorId FROM cpo_ind_review WHERE iStudentId = " . $_SESSION['user_id'] . " AND iflag = 0";
															$result_tutor_id = runquery($query_tutor_id);
															$nos = 0;
															if ($result_tutor_id) {
																$nos = mysqli_num_rows($result_tutor_id);
															}
															$formsts = "";
															if ($nos == 0) {
																$formsts = "";
																echo "<div class='alert alert-danger' role='alert'>No Learning Review Assign.</div>";
															}
														?>
														<form id="regForm" action="" method="post">

                                                            <!-- One "tab" for each step in the form: -->
                                                            <div class="tab">
                                                                <p>
                                                                    <input type="hidden" name="frmSubmitted" value="1" />
                                                                    <select name="CBOSTUDENT" class="form-select" id="tutor">
                                                                        <option value="" selected>Select Mentor </option>
                                                                        <?php
                                                                            $query_tutor_id = "select I_tutorid from cpo_user_subject where I_studentid='".$_SESSION['user_id']."' ";
                                                                            $result_tutor_id = runquery($query_tutor_id);
                                                                            $nos = 0;
                                                                            if($result_tutor_id){
                                                                                $nos = mysqli_num_rows($result_tutor_id);
                                                                            }
                                                                            if($nos>0){
                                                                                $tutor_ids='';
                                                                                $result_tutor = mysqli_fetch_array($result_tutor_id);
                                                                                $str_tutor_id=$result_tutor['I_tutorid'];
                                                                                $tutor_ids= $str_tutor_id;
                                                                                if($tutor_ids<>''){
                                                                                    $query_tutor_info = "select iUserId,vUserName from cpo_usermaster ";
                                                                                    $result_tutor_info = runquery($query_tutor_info);
                                                                                    $nos = 0;
                                                                                    if($result_tutor_info){
                                                                                        $nos = mysqli_num_rows($result_tutor_info);
                                                                                    }
                                                                                    if($nos>0){
                                                                                        while($result_tutor = mysqli_fetch_array($result_tutor_info)){
                                                                                            $isseleted = "";
                                                                                            if(isset($_POST['CBOSTUDENT']) && $_POST['CBOSTUDENT'] == $result_tutor['iUserId'] ){
                                                                                                $isseleted = "selected";
                                                                                            }
                                                                                            echo "<option value=".$result_tutor['iUserId']." $isseleted>".$result_tutor['vUserName']."</option>";
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>1. Daily Check-In</h5>
                                                                <p class="formp">
                                                                    <b>How am I feeling today:</b><br>
                                                                    <input type="radio" name="emotion" id="great" class="input-hidden" value="great" />
                                                                    <label for="great" class="clsemoji" title="Great">&#128512;</label>
                                                                    <input type="radio" name="emotion" id="good" class="input-hidden" value="good" />
                                                                    <label for="good" class="clsemoji" title="Good">&#128578;</label>
                                                                    <input type="radio" name="emotion" id="ok" class="input-hidden" value="ok" />
                                                                    <label for="ok" class="clsemoji" title="OK">&#128528;</label>
                                                                    <input type="radio" name="emotion" id="not_so_good" class="input-hidden" value="not_so_good"  />
                                                                    <label for="not_so_good" class="clsemoji" title="Not So Good">&#128533;</label>
                                                                    <input type="radio" name="emotion" id="struggling" class="input-hidden" value="struggling" />
                                                                    <label for="struggling" class="clsemoji" title="struggling">&#128546;</label>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Overall Wellbeing Score:</b><br><small>(1 = struggling, 10 = thriving)</small><br />
                                                                    <select id="wbscore" name="wbscore" class="form-select">
                                                                        <option value="">Select</option>
                                                                        <?php
                                                                            for($i=1; $i<=10;$i++)
                                                                            {
                                                                                ?>
                                                                                <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>What’s influencing my mood?</b><br><small>(Select all that apply)</small><br>
                                                                    <input type="checkbox" name="mood[]" id="sleep" value="Sleep Quality" style="width:20px !important">&nbsp;<label for="sleep">Sleep Quality</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="appetite" value="Appetite"  style="width:20px !important"><label for="appetite">Appetite</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="elevels" value="Energy levels"  style="width:20px !important"><label for="elevels">Energy levels</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="sinteractions" value="Social interactions"  style="width:20px !important"><label for="sinteractions">Social interactions</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="medeffects" value="Medication effects"  style="width:20px !important"><label for="medeffects">Medication effects</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="slevels" value="Stress levels"  style="width:20px !important"><label for="slevels">Stress levels</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="physical_health" value="Physical health"  style="width:20px !important"><label for="physical_health">Physical health</label><br/>
                                                                    <input type="checkbox" name="mood[]" id="other" value="Other"  style="width:20px !important"><label for="other">Other</label><input type="text" name="other_mood" class="form-control" />
                                                                </p>
                                                            </div>

                                                            <div class="tab"><h5>My Support Circle</h5>
                                                                <p class="formp">
                                                                    <b>Key Support People:</b><br><small>(List your go-to contacts)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Name:</label>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <label class="form-label">Relationship:</label>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_support">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_support">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-4">
                                                                                            
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="contactname" name="contactname" />
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="contactrelationship" name="contactrelationship" />
                                                                                        </div>
                                                                                        <div class="col-md-4">
                                                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-md-8">
                                                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                                                Delete
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Form group-->

                                                                        <!--begin::Form group-->
                                                                        <div class="form-group mt-5">
                                                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Add
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Mental Health Professionals</b><br/>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="therapist" placeholder="Therapist" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="therapist_contact" placeholder="Contact" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="psychiatrist" placeholder="Psychiatrist" />
                                                                        </div>
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="psychiatrist_contact" placeholder="Contact" />
                                                                        </div>
                                                                    </div>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Wellness Toolkit</h5>
                                                                <p class="formp">
                                                                    <b>What helps me feel better? </b><br><small>(Select all that apply)</small><br>
                                                                    <input type="checkbox" name="feel[]" id="deepbreath" value="Deep breathing exercises" style="width:20px !important">&nbsp;<label for="deepbreath">Deep breathing exercises</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="journaling" value="Journaling"  style="width:20px !important"><label for="journaling">Journaling</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="exercise" value="Physical exercise"  style="width:20px !important"><label for="exercise">Physical exercise</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="cactivities" value="Creative activities (art, music)"  style="width:20px !important"><label for="cactivities">Creative activities (art, music)</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="talking" value="Talking to someone"  style="width:20px !important"><label for="talking">Talking to someone</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="meditation" value="Mindfulness or meditation"  style="width:20px !important"><label for="meditation">Mindfulness or meditation</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="walks" value="Nature walks"  style="width:20px !important"><label for="walks">Nature walks</label><br/>
                                                                    <input type="checkbox" name="feel[]" id="other" value="Other"  style="width:20px !important"><label for="other">Other</label><input type="text" name="other_feel" class="form-control" />
                                                                </p>
                                                                <p class="formp">
                                                                    <b>New strategies I want to try:</b><br>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>1</label><br>
                                                                        <input type="text" name="strategy1" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;">
                                                                        <label>2</label><br>
                                                                        <input type="text" name="strategy2" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Medication Plan</h5>
                                                                <p class="formp">
                                                                    <b>Current Medications:</b>
                                                                    <div class="row">
                                                                        <div class="col-md-5">
                                                                            <label class="form-label">Medication Name</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <label class="form-label">Dosage</label>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <label class="form-label">How many times per day?</label>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_medication">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_medication">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-5">
                                                                                            
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="medicinename" name="medicinename" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="dossage" name="dossage" />
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="time" name="time" />
                                                                                        </div>
                                                                                        <div class="col-md-2">
                                                                                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-md-8">
                                                                                                <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>
                                                                                                Delete
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Form group-->

                                                                        <!--begin::Form group-->
                                                                        <div class="form-group mt-5">
                                                                            <a href="javascript:;" data-repeater-create class="btn btn-light-primary">
                                                                                <i class="ki-duotone ki-plus fs-3"></i>
                                                                                Add
                                                                            </a>
                                                                        </div>
                                                                        <!--end::Form group-->
                                                                    </div>
                                                                    <!--end::Repeater-->
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Side Effects to Watch For:</b><br/>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="side_effects"  />
                                                                        </div>
                                                                    </div>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Pharmacy Contact:</b><br/>
                                                                    <div class="row mt-3">
                                                                        <div class="col">
                                                                            <input type="text" class="form-control" name="pharmacy" />
                                                                        </div>
                                                                    </div>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Action Plan for Warning Signs</h5>
                                                                <p class="formp">As you navigate your recovery journey, it’s important to have a personal action plan ready for when you recognize warning signs. Use the prompts below to create your own tailored plan.</p>
                                                                <p class="formp">
                                                                    <b>Identify Your Warning Signs: </b><br>What specific behaviors, feelings, or thoughts do you notice when you're not feeling well?<br>Example: Increased irritability or withdrawal from social activities.<br>

                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>1</label><br>
                                                                        <input type="text" name="warning1" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>2</label><br>
                                                                        <input type="text" name="warning2" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>3</label><br>
                                                                        <input type="text" name="warning3" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Immediate Steps to Take: </b><br>What actions will you take when you notice these warning signs?<br>Example: Reach out to a friend or engage in a calming activity like deep breathing.<br>

                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>1</label><br>
                                                                        <input type="text" name="actionplan1" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>2</label><br>
                                                                        <input type="text" name="actionplan2" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>3</label><br>
                                                                        <input type="text" name="actionplan3" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Support Resources</b><br>Who can you reach out to for support, and what resources can you utilize?<br>Example: A therapist, a trusted family member, or a mental health hotline.<br>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Your Resources</label><br>
                                                                        <input type="text" name="resources" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                                <p class="formp">
                                                                By filling out this action plan, you empower yourself to respond effectively when warning signs arise, helping you maintain your well-being and stay on track in your recovery journey.
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Goals and Aspirations</h5>
                                                                <p class="formp">
                                                                    <b>Short-term Goal (Next Month) </b><br>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>I want to:</label><br>
                                                                        <input type="text" name="goal_short_term" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Steps to Achieve This Goal:</label><br>
                                                                        <label>1</label><br>
                                                                        <input type="text" name="step1_short_term" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>2</label><br>
                                                                        <input type="text" name="step2_short_term" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>3</label><br>
                                                                        <input type="text" name="step3_short_term" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Long-term Vision (Next 6 Months)</b>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>I hope to</label><br>
                                                                        <input type="text" name="hope_long_term" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Milestones Along the Way:</label><br>
                                                                        <label>1</label><br>
                                                                        <input type="text" name="milestone1_long_term" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>2</label><br>
                                                                        <input type="text" name="milestone2_long_term" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>3</label><br>
                                                                        <input type="text" name="milestone3_long_term" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Daily Self-Care Checklist</h5>
                                                                <p class="formp">
                                                                    <small>(Check off each item as you complete it)</small><br>
                                                                    <input type="checkbox" name="daily_checklist[]" id="healthy_meal" value="Healthy meal" style="width:20px !important">&nbsp;<label for="healthy_meal">Healthy meal</label><br/>
                                                                    <input type="checkbox" name="daily_checklist[]" id="physical_activity" value="Physical activity (e.g., walk, workout)"  style="width:20px !important"><label for="physical_activity">Physical activity (e.g., walk, workout)</label><br/>
                                                                    <input type="checkbox" name="daily_checklist[]" id="relaxation_practice" value="Relaxation practice (e.g., reading, meditation)"  style="width:20px !important"><label for="relaxation_practice">Relaxation practice (e.g., reading, meditation)</label><br/>
                                                                    <input type="checkbox" name="daily_checklist[]" id="social_connection" value="Social connection (call/text a friend)"  style="width:20px !important"><label for="social_connection">Social connection (call/text a friend)</label><br/>
                                                                    <input type="checkbox" name="daily_checklist[]" id="enjoyable_activity" value="Enjoyable activity (hobby or interest)"  style="width:20px !important"><label for="enjoyable_activity">Enjoyable activity (hobby or interest)</label><br/>
                                                                    <input type="checkbox" name="daily_checklist[]" id="medication" value="Medication (if applicable)"  style="width:20px !important"><label for="medication">Medication (if applicable)</label><br/>
                                                                    <input type="checkbox" name="daily_checklist[]" id="other" value="Other"  style="width:20px !important"><label for="other">Other</label><input type="text" name="other_daily_checklist" class="form-control" />
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Community Engagement</h5>
                                                                <p class="formp">
                                                                    <b>Activities I’m Interested In Joining</b><br><small>(Check off each item as you complete it)</small><br>
                                                                    <input type="checkbox" name="interested_activities[]" id="support_groups" value="Support groups" style="width:20px !important">&nbsp;<label for="support_groups">Support groups</label><br/>
                                                                    <input type="checkbox" name="interested_activities[]" id="volunteer_work" value="Volunteer work"  style="width:20px !important"><label for="volunteer_work">Volunteer work</label><br/>
                                                                    <input type="checkbox" name="interested_activities[]" id="classes_workshops" value="Classes/workshops"  style="width:20px !important"><label for="classes_workshops">Classes/workshops</label><br/>
                                                                    <input type="checkbox" name="interested_activities[]" id="sports_fitness_activities" value="Sports/fitness activities"  style="width:20px !important"><label for="sports_fitness_activities">Sports/fitness activities</label><br/>
                                                                    <input type="checkbox" name="interested_activities[]" id="art_music_groups" value="Art/music groups"  style="width:20px !important"><label for="art_music_groups">Art/music groups</label><br/>
                                                                    <input type="checkbox" name="interested_activities[]" id="other" value="Other"  style="width:20px !important"><label for="other">Other</label><input type="text" name="other_interested_activities" class="form-control" />
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Skills I want to develop</b>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>1</label><br>
                                                                        <input type="text" name="skills_to_develop_1" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>2</label><br>
                                                                        <input type="text" name="skills_to_develop_2" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Crisis Plan</h5>
                                                                <p class="formp">
                                                                    <b>If I'm in crisis, I will:</b><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <fieldset class="form-group" style="text-align: left;";>
                                                                                <label>Contact</label><br>
                                                                                <input type="text" name="crisis_contact" class="form-control">
                                                                            </fieldset>
                                                                        </div>
                                                                        <div class="col">
                                                                            <fieldset class="form-group" style="text-align: left;";>
                                                                                <label>Phone</label><br>
                                                                                <input type="text" name="crisis_phone" class="form-control">
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Go to</label><br>
                                                                        <input type="text" name="crisis_go_to" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Use this coping strategy</label><br>
                                                                        <input type="text" name="crisis_coping_strategy" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Emergency:</b><br>
                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <fieldset class="form-group" style="text-align: left;";>
                                                                                <label>Contact</label><br>
                                                                                <input type="text" name="emergency_contact" class="form-control">
                                                                            </fieldset>
                                                                        </div>
                                                                        <div class="col">
                                                                            <fieldset class="form-group" style="text-align: left;";>
                                                                                <label>Phone</label><br>
                                                                                <input type="text" name="emergency_phone" class="form-control">
                                                                            </fieldset>
                                                                        </div>
                                                                    </div>
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Reflection and Gratitude</h5>
                                                                <p class="formp">
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>One thing I’m proud of today: </label><br>
                                                                        <input type="text" name="proud_of" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Something I’m looking forward to</label><br>
                                                                        <input type="text" name="looking_forward_to" class="form-control">
                                                                    </fieldset>
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>One person I’m grateful for</label><br>
                                                                        <input type="text" name="greatful_for" class="form-control">
                                                                    </fieldset>
                                                                </p>
                                                            </div>

                                                            <div style="overflow:auto;">
                                                            <div style="float:right;">
                                                                <button type="button" class="btn btn-primary mt-4" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                                                <button type="button" class="btn btn-primary mt-4" id="nextBtn" name="btnNext" onclick="nextPrev(1)">Next</button>
                                                            </div>
                                                            </div>

                                                            <!-- Circles which indicates the steps of the form: -->
                                                            <div style="text-align:center;margin-top:40px;">
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            <span class="step"></span>
                                                            
                                                            </div>

                                                            </form>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3">
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<?php include "footer.php"; ?>
			</div>
		</div>
        <script src="assets/js/jquery-1.11.1.js"></script>
        <script src="assets/js/jquery.input.js"></script>
        <script src="assets/js/lib.js"></script>
        <script src="assets/js/repeater.js"></script>
		<script>
			/*$(document).ready(function(){
				$("#sfile").attr("disabled", true);
				$("#tutor").change(function(){
					if($("#tutor").val() !== ""){
						$("#sfile").attr("disabled", false);
					}
					else{
						$("#sfile").attr("disabled", true);
					}
				});
			});*/
            var currentTab = 0; // Current tab is set to be the first tab (0)
            showTab(currentTab); // Display the current tab

            function showTab(n) {
            // This function will display the specified tab of the form ...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            // ... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            // ... and run a function that displays the correct step indicator:
            fixStepIndicator(n)
            }

            function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form... :
            if (currentTab >= x.length) {
                //...the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
            }

            function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            /*for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                // add an "invalid" class to the field:
                y[i].className += " invalid";
                // and set the current valid status to false:
                valid = false;
                }
            }*/
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
            }

            function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class to the current step:
            x[n].className += " active";
            }

            $('.clsemoji').click(function(){
                $('.clsemoji').removeClass('radioborder');
                $(this).addClass('radioborder');
            });

            $('#kt_docs_repeater_support').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });

            $('#kt_docs_repeater_medication').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                },

                hide: function (deleteElement) {
                    $(this).slideUp(deleteElement);
                }
            });
		</script>
	</body>
</html>