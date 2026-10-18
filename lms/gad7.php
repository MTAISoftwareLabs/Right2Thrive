<?php
    include "dbConnection.php";
    $msg = "";
    if(isset($_POST['frmSubmitted']) && $_POST['frmSubmitted']==1)
    {
        $radio1 = $_POST['radio1'];
        $radio2 = $_POST['radio2'];
        $radio3 = $_POST['radio3'];
        $radio4 = $_POST['radio4'];
        $radio5 = $_POST['radio5'];
        $radio6 = $_POST['radio6'];
        $radio7 = $_POST['radio7'];
        $CBOSTUDENT = $_POST['CBOSTUDENT'];
        $iStudentId = $_SESSION['user_id'];
        $strInsert = "INSERT INTO cpo_gad7 (iStudentId, tutorid, radio1, radio2, radio3, radio4, radio5, radio6, radio7, submit_date)
        values ($iStudentId, $CBOSTUDENT, $radio1, $radio2, $radio3, $radio4, $radio5, $radio6, $radio7, '".date("Y-m-d H:i:s")."')";
       
        runquery($strInsert);
        $msg = "<div class='alert alert-danger' role='alert'>Your Generalized Anxiety Disorder 7 data is stored successfully.</div>";
        //echo "<div class='alert alert-danger' role='alert'>Your core plan is stored successfull</div>";
        addlog(18);
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Generalized Anxiety Disorder 7 <?php echo sitename; ?></title>
		<?php include "metadata.php"; ?>
        <style>
            /* Style the form */
            #regForm {
            background-color: #ffffff;
            margin: 10px auto;
            padding: 5px;
            width: 100%;
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
            

            .input-hidden {
                position: absolute;
                left: -9999px;
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

            
        </style>
    </head>
	<body class="hub-assessment">
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
										<div class="col-md-12">
											<div class="card shadow mt-4">
												<div class="card-content">
													<div class="card-body text-center">
														<h5 class="mb-4">Generalized Anxiety Disorder 7-Item Assessment (GAD–7)</h5>
                                                        <?php echo $msg;?>
                                                        <p>Over the last 2 weeks, how often have you been bothered by the following problems? (Use the check boxes to indicate your answer)</p>
														<form id="regForm" action="" method="post">
                                                            <div class="row mt-3">
                                                                <div class="col-lg col-sm-12 text-left mt-1">
                                                                    1. Feeling nervous, anxious or on edge
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio1_0" name="radio1" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio1_1" name="radio1" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio1_2" name="radio1" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio1_3" name="radio1" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row bg-light mt-3">
                                                                <div class="col-lg col-sm-12  text-left mt-1">
                                                                    2. Not being able to stop or control worrying
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio2_0" name="radio2" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio2_1" name="radio2" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio2_2" name="radio2" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio2_3" name="radio2" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg col-sm-12  text-left mt-1">
                                                                    3. Worrying too much about different things
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio3_0" name="radio3" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio3_1" name="radio3" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio3_2" name="radio3" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio3_3" name="radio3" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row bg-light mt-3">
                                                                <div class="col-lg col-sm-12  text-left mt-1">
                                                                    4. Trouble relaxing
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio4_0" name="radio4" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio4_1" name="radio4" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio4_2" name="radio4" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio4_3" name="radio4" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg col-sm-12  text-left mt-1">
                                                                    5. Being so restless that it is hard to sit still
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio5_0" name="radio5" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio5_1" name="radio5" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio5_2" name="radio5" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio5_3" name="radio5" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row bg-light mt-3">
                                                                <div class="col-lg col-sm-12  text-left mt-1">
                                                                    6. Becoming easily annoyed or irritable
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio6_0" name="radio6" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio6_1" name="radio6" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio6_2" name="radio6" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio6_3" name="radio6" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mt-3">
                                                                <div class="col-lg col-sm-12  text-left mt-1">
                                                                7. Feeling afraid as if something awful might happen
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                            <input type="radio" class="form-check-input" id="radio7_0" name="radio7" value="0" required /> Not at all
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio7_1" name="radio7" value="1" /> Several Days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio7_2" name="radio7" value="2" /> More than half the days
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col text-left mt-1">
                                                                            <label class="checkbox-inline">
                                                                                <input type="radio" class="form-check-input"  id="radio7_3" name="radio7" value="3" /> Nearly everyday
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row bg-light mt-3">
                                                                <div class="col">
                                                                    &nbsp;
                                                                </div>
                                                                <div class="col">
                                                                    <label>Total:</label>
                                                                </div>
                                                                <div class="col text-left mt-1">
                                                                    <div id="ntotal"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row  mt-3">
                                                                <div class="col-3">
                                                                    Select Mentor
                                                                </div>
                                                                <div class="col-9">
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
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-3">
                                                                    &nbsp;
                                                                </div>
                                                                <div class="9">
                                                                    <input type="hidden" name="frmSubmitted" value="1" />
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
													</div>
												</div>
											</div>
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
        <script>
            $('.form-check-input').click(function(){
                var nTotal = 0;
                $('#regForm').find('input:radio:checked').each(function(obj){
                    nTotal = parseInt(nTotal) + parseInt($(this).val());
                })
                $('#ntotal').html(nTotal);
            });
        </script>
	</body>
</html>