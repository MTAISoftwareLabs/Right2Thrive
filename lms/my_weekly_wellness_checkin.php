<?php
    
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php include "dbConnection.php"; ?>
		<title>My Weekly Wellness Checkin <?php echo sitename; ?></title>
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
														<h5 class="mb-4">Welcome to Your Recovery Journey!</h5>
                                                        <p>Congratulations on taking this important step! This weekly report is designed to empower you to progress towards your goals.</p>
														<?php
                                                            if(isset($_POST['frmSubmitted']))
                                                            {
                                                                $iStudentId = $_SESSION['user_id'];
                                                                $CBOSTUDENT = $_POST['CBOSTUDENT'];
                                                                $strDate = $_POST['strDate'];
                                                                
                                                                $emotion = $_POST['emotion'];
                                                                $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_checkin
                                                                (iStudentId, tutorid, date_submission, emotion)
                                                                VALUES ($iStudentId, $CBOSTUDENT, '$strDate', '$emotion')";
                                                                runquery($strQueryInsert);
                                                                $lastInsertedId = mysqli_insert_id($conn);
                                                        
                                                                foreach($_POST['kt_docs_repeater_steps'] as $step)
                                                                {
                                                                    $strStep = $step['steps'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_steps
                                                                    (wellness_id, step)
                                                                    VALUES ($lastInsertedId, '$strStep')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_challenges'] as $challenge)
                                                                {
                                                                    $strChallenge = $challenge['challenges'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_challenges
                                                                    (wellness_id, challenge)
                                                                    VALUES ($lastInsertedId, '$strChallenge')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_strategies'] as $Thisstrategy)
                                                                {
                                                                    $strategy = $Thisstrategy['strategies'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_strategies
                                                                    (wellness_id, strategy)
                                                                    VALUES ($lastInsertedId, '$strategy')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_pchanges'] as $thisPChanges)
                                                                {
                                                                    $positive_change = $thisPChanges['pchanges'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_pchanges
                                                                    (wellness_id, positive_changes)
                                                                    VALUES ($lastInsertedId, '$positive_change')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_wbchallenges'] as $thisWBChallenge)
                                                                {
                                                                    $wbchallenge = $thisWBChallenge['wbchallenges'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_wbchallenges
                                                                    (wellness_id, wbchallenge)
                                                                    VALUES ($lastInsertedId, '$wbchallenge')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_hfullaspects'] as $thisHelpfulAspect)
                                                                {
                                                                    $hfullaspects = $thisHelpfulAspect['hfullaspects'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_hfullaspects
                                                                    (wellness_id, hfullaspects)
                                                                    VALUES ($lastInsertedId, '$hfullaspects')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_challengingaspects'] as $thisChallengAspect)
                                                                {
                                                                    $challengingaspects = $thisChallengAspect['challengingaspects'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_chaspects
                                                                    (wellness_id, chaspects)
                                                                    VALUES ($lastInsertedId, '$challengingaspects')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_reqconcerns'] as $thisreqconcerns)
                                                                {
                                                                    $reqconcerns = $thisreqconcerns['reqconcerns'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_reqconcerns
                                                                    (wellness_id, reqconcerns)
                                                                    VALUES ($lastInsertedId, '$reqconcerns')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_focusareas'] as $thisFocusArea)
                                                                {
                                                                    $focusareas = $thisFocusArea['focusarea'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_focusareas
                                                                    (wellness_id, focusareas)
                                                                    VALUES ($lastInsertedId, '$focusareas')";
                                                                    runquery($strQueryInsert);
                                                                }
                                                        
                                                                foreach($_POST['kt_docs_repeater_events'] as $thisEvent)
                                                                {
                                                                    $events = $thisEvent['events'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_events
                                                                    (wellness_id, events)
                                                                    VALUES ($lastInsertedId, '$events')";
                                                                    runquery($strQueryInsert);
                                                                }

                                                                foreach($_POST['kt_docs_repeater_pridepoint'] as $thisPoint)
                                                                {
                                                                    $pride_point = $thisPoint['pridepoint'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_pridepoint
                                                                    (wellness_id, pride_point)
                                                                    VALUES ($lastInsertedId, '$pride_point')";
                                                                    runquery($strQueryInsert);
                                                                }

                                                                foreach($_POST['kt_docs_repeater_learnings'] as $thisLearning)
                                                                {
                                                                    $learning = $thisLearning['learnings'];
                                                                    $strQueryInsert = "INSERT INTO  cpo_weekly_wellness_learning
                                                                    (wellness_id, learning)
                                                                    VALUES ($lastInsertedId, '$learning')";
                                                                    runquery($strQueryInsert);
                                                                }

                                                                $msg = "Your weekly wellness checking is stored successfully.";
                                                                echo "<div class='alert alert-danger' role='alert'>Your weekly wellness checking is stored successfully</div>";
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
															}
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
															}*/
														?>
														<form id="regForm" action="" method="post">

                                                            <!-- One "tab" for each step in the form: -->
                                                            <div class="tab">
                                                                <p class="formp">
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
                                                                <p class="formp">
                                                                    <fieldset class="form-group" style="text-align: left;";>
                                                                        <label>Date</label><br>
                                                                        <input type="date" class="form-control " id="strDate" name="strDate" value="<?php echo date("Y-m-d");?>">
                                                                    </fieldset>
                                                                    
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>This Week's Journey</h5>
                                                                <p class="formp">
                                                                    <b>Progress Towards My Goals</b><br><small>(What steps did I take? Even small actions count!)</small><br>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Steps Taken</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_steps">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_steps">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="steps" name="steps" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Challenges I Faced</b><br><small>(What obstacles did I encounter?)</small><br>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Challenges</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_challenges">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_challenges">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="challenges" name="challenges" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>How I Handled Challenges</b><br><small>(What strategies did I use? Did I seek support?)</small><br>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Strategies Used</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_strategies">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_strategies">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="strategies" name="strategies" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                            </div>

                                                            <div class="tab"><h5>My Emotional Landscape</h5>
                                                                <p class="formp">
                                                                    <b>&#128578;Overall Mood This Week</b><br><small>(Select the emoji that best represents your mood)</small><br/>
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
                                                                    <b>Positive Changes I've Noticed</b><br><small>(Any improvements in mood, energy, relationships, etc.?)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Positive Changes</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_pchanges">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_pchanges">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="pchanges" name="pchanges" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Challenges in My Well-being</b><br><small>(Any setbacks or worsening of symptoms?)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Challenges Noticed</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_wbchallenges">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_wbchallenges">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="wbchallenges" name="wbchallenges" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Support and Feedback</h5>
                                                                <p class="formp">
                                                                    <b>What's Been Helpful</b><br><small>(People, activities, or strategies that supported me)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Helpful Aspects</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_hfullaspects">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_hfullaspects">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="hfullaspects" name="hfullaspects" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>What's Been Challenging</b><br><small>(Things that didn't work well or need improvement)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Challenging Aspects</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_challengingaspects">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_challengingaspects">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="challengingaspects" name="challengingaspects" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>My Requests or Concerns</b><br><small>(Any support or changes I need going forward)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Requests/Concerns</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_reqconcerns">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_reqconcerns">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="reqconcerns" name="reqconcerns" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Looking Ahead</h5>
                                                                <p class="formp">
                                                                    <b>My Focus for Next Week</b><br><small>(One thing I want to work on or achieve)</small><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Focus Area</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_focusarea">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_focusareas">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="focusarea" name="focusarea" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Something I'm Looking Forward To</b><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Upcoming Events/Activities</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_events">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_events">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="events" name="events" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                            </div>
                                                            <div class="tab"><h5>Self Reflection</h5>
                                                                <p class="formp">
                                                                    <b>One Thing I'm Proud of This Week</b><br>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Pride Point</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_pridepoint">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_pridepoint">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="pridepoint" name="pridepoint" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                                <p class="formp">
                                                                    <b>Something I Learned About Myself</b><br/>
                                                                    <div class="row">
                                                                        <div class="col-md-9">
                                                                            <label class="form-label">Learnings</label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        </div>
                                                                    </div>
                                                                    <!--begin::Repeater-->
                                                                    <div id="kt_docs_repeater_learnings">
                                                                        <!--begin::Form group-->
                                                                        <div class="form-group">
                                                                            <div data-repeater-list="kt_docs_repeater_learnings">
                                                                                <div data-repeater-item>
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control mb-2 mb-md-0" id="learnings" name="learnings" />
                                                                                        </div>
                                                                                        <div class="col-md-3">
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
                                                                </p>
                                                            </div>
                                                            
                                                            <div style="overflow:auto;">
                                                            <div style="float:right;">
                                                                <button type="button" class="btn btn-primary mt-4" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                                                <button type="button" class="btn btn-primary mt-4" id="nextBtn" onclick="nextPrev(1)">Next</button>
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

            $('#kt_docs_repeater_steps').repeater({
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
            $('#kt_docs_repeater_challenges').repeater({
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
            $('#kt_docs_repeater_strategies').repeater({
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

            $('#kt_docs_repeater_pchanges').repeater({
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

            $('#kt_docs_repeater_wbchallenges').repeater({
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

            $('#kt_docs_repeater_hfullaspects').repeater({
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

            $('#kt_docs_repeater_challengingaspects').repeater({
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
            $('#kt_docs_repeater_reqconcerns').repeater({
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
            $('#kt_docs_repeater_focusarea').repeater({
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

            $('#kt_docs_repeater_events').repeater({
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

            $('#kt_docs_repeater_pridepoint').repeater({
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

            $('#kt_docs_repeater_learnings').repeater({
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