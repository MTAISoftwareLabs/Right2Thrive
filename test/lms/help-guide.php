<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Help & Guide<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Help & Guide</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link active" id="grievance-tab" data-bs-toggle="tab" href="#grievance" role="tab" aria-controls="grievance" aria-selected="false">Grievance Form</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="complaint-tab" data-bs-toggle="tab" href="#complaint" role="tab" aria-controls="complaint" aria-selected="true">Complaint Procedures</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="policy-tab" data-bs-toggle="tab" href="#policy" role="tab" aria-controls="policy" aria-selected="false">Disability Policy</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="equal-tab" data-bs-toggle="tab" href="#equal" role="tab" aria-controls="equal" aria-selected="false">Equal Opportunity</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="term-tab" data-bs-toggle="tab" href="#term" role="tab" aria-controls="term" aria-selected="false" title="Add to purchase the course">Terms & Conditions</a>
							</li>
							<li class="nav-item" role="presentation">
								<a class="nav-link" id="mission-tab" data-bs-toggle="tab" href="#mission" role="tab" aria-controls="mission" aria-selected="false">Mission Statements</a>
							</li>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="grievance" role="tabpanel" aria-labelledby="grievance-tab">
								<h5>Grievance Form</h5>
								<?php
									$sqluser = "select vUserName,vUserPhone,vUserEmailId,vUserAddress from cpo_usermaster where iUserId=".$_SESSION['user_id'];
									$rsuser = runquery($sqluser);
									$num = $rsuser ? mysqli_num_rows($rsuser) : 0 ; $username = ""; $usermail = "";
									$cmsg = "Thank you for recording the details of your complaint.<br> The CareerPaths Online Quality Manager will investigate your complaint and <br>contact you by the method you have indicated within 5 working days of <br> the receipt of this form.";
									if ($num > 0){
										$rsdata = mysqli_fetch_array($rsuser);
										$username = $rsdata['vUserName'];
										$usermail = $rsdata['vUserEmailId'];
										?>											
											<div class="row form form-horizontal mt-4 mb-4">
												<div class="col-sm-4">
													<label>Complaint Made By</label>
												</div>
												<div class="col-sm-8 form-group">
													<input type="text" class="form-control" value="<?php echo $rsdata['vUserName']; ?>" disabled>
												</div>
												<div class="col-sm-4">
													<label>Email</label>
												</div>
												<div class="col-sm-8 form-group">
													<input type="text" class="form-control" value="<?php echo $rsdata['vUserEmailId']; ?>" disabled>
												</div>
												<div class="col-sm-4">
													<label>Telephone</label>
												</div>
												<div class="col-sm-8 form-group">
													<input type="text" class="form-control" value="<?php echo $rsdata['vUserPhone']; ?>" disabled>
												</div>
												<div class="col-sm-4">
													<label>Address</label>
												</div>
												<div class="col-sm-8 form-group">
													<input type="text" class="form-control" value="<?php echo $rsdata['vUserAddress']; ?>" disabled>
												</div>
											</div>
										<?php
									}
										
									if (isset($_POST['TXGRIEVANCECOMP'])){
										$fromname = $username; 
										$fromaddress = $usermail; 
										$toname = "Administrator of CareerPaths Online";
										$toaddress = admin_email;
										$subject = "Grievance form send by ".$username;
										$message = $_POST['TXGRIEVANCECOMP'];
										$in = 0;
										if (isset($_POST['CHLETTER']) && $_POST['CHLETTER'] == "Letter"){
											$rec = $_POST['CHLETTER']; $in = 1;
										}if (isset($_POST['CHEMAIL']) && $_POST['CHEMAIL'] == "Mail"){
											if ($in == 1){
												$rec .= " or ".$_POST['CHEMAIL'];
											}else{
												$rec = $_POST['CHEMAIL']; $in = 1;
											}											
										}if (isset($_POST['CHTELEPHONE']) && $_POST['CHTELEPHONE'] == "Telephone"){
											if ($in == 1){
												$rec .= " or ".$_POST['CHTELEPHONE'];
											}else{
												$rec = $_POST['CHTELEPHONE']; $in = 1;
											}
										}if (isset($_POST['CHINPERSON']) && $_POST['CHINPERSON'] == "Personally"){
											if ($in == 1){
												$rec .= " or ".$_POST['CHINPERSON'];
											}else{
												$rec = $_POST['CHINPERSON'];
												$in = 1;
											}
										}
										$message .= "<br>user prefer to recieve complaint by ".$rec;
										SendingMail($fromname, $fromaddress, $toname, $toaddress, $subject, $message);
										?>
										<div class="alert alert-success">
											<h4 class="alert-heading">Grievance send successfully.</h4>
											<p>Thank you for recording the details of your complaint. Our Quality Manager will investigate your complaint and <br>contact you by the method you have indicated within 5 working days of <br> the receipt of this form.</p>
										</div>
										<?php
									}	
								?>
								<form class="form" name="FRMBRIEVANCE" method="post" action="help-guide?next=1">									
									<div class="form-group with-title mb-3">
										<textarea name="TXGRIEVANCECOMP" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Write details of your complaint here..." minlength="20" required></textarea>
									</div>
									<p>How complaint recieved : (Please tick atleast one which method you prefer)</p>
									<ul class="list-unstyled mb-0">
										<li class="d-inline-block me-2 mb-1">
											<div class="form-check">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="form-check-input form-check-success form-check-glow" checked="" name="CHEMAIL" value="Mail" id="chemail">
													<label class="form-check-label" for="customColorCheck3">E-mail</label>
												</div>
											</div>
										</li>
										<li class="d-inline-block me-2 mb-1">
											<div class="form-check">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="form-check-input form-check-success form-check-glow" name="CHLETTER" value="Letter" id="chletter">
													<label class="form-check-label" for="customColorCheck3">Letter</label>
												</div>
											</div>
										</li>
										<li class="d-inline-block me-2 mb-1">
											<div class="form-check">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="form-check-input form-check-success form-check-glow" name="CHTELEPHONE" value="Telephone" id="chphone">
													<label class="form-check-label" for="customColorCheck3">Telephone</label>
												</div>
											</div>
										</li>
										<li class="d-inline-block me-2 mb-1">
											<div class="form-check">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="form-check-input form-check-success form-check-glow" name="CHINPERSON" value="Personally" id="chperson">
													<label class="form-check-label" for="customColorCheck3">In person</label>
												</div>
											</div>
										</li>
									</ul>
									<button type="submit" class="btn btn-primary mt-3 font-bold">Submit</button>
								</form>
							</div>
							<div class="tab-pane fade" id="complaint" role="tabpanel" aria-labelledby="complaint-tab">
								<div class="help-page">
									<div class="container page-head pt-4 text-center">
										<h4 class="mb-4">Complaint Procedures</h4>
										<h6>21K Digital Media Ltd<br/> COMPLAINT PROCEDURE<br/>COMPLAINTS, COMMENTS AND COMPLIMENTS POLICY</h6>
										<div class="row title">
											<div class="col-6 text-left">COMPLIMENTS</div>
											<div class="col-6 text-right"><a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a></div>
										</div>
									</div>
									<div class="container pt-4">
										<p>An individual can give compliments either verbally, by letter, by email or by completing a Compliments Form.</p>
										<p>The member of staff receiving the details of the complaint will record all complaints received on a Complaints log. If a Complaints form, letter or email is received this should be stapled to the Complaints Log and stored in the Complaints File.</p>
										<p>All compliments received within the calendar month will be reported at the 21K Digital Media Ltd team meeting. Individual staff will be identified and examples of best practice highlighted and replicated wherever possible across the service.</p>
										<div class="row title">
											<div class="col-12 text-left">COMPLIMENTS</div>
										</div>
										<p>An individual can give complaints either verbally, by letter, by email or by completing a Complaints form.</p>
										<p>The member of staff receiving the details of the complaint will record all complaints received on a Complaints log. If a Complaints form, letter or email is received this should be stapled to the Complaints Log and stored in the Complaints File.</p>
										<p>All complaints made in person or by telephone should be responded to immediately by the member of staff who takes the complaint - either through their own response or by referral to the 21K Digital Media Ltd Quality Manager if available.</p>
										<p>If the complaint id not resolved immediately, then the member of staff should:</p>
										<ul>
											<li>Ask the complainant to complete a Complaints Form (or complete it on behalf of the client) Explain to the client the complaint procedure and that they will receive a response within five working days.</li>
											<li>Complete a Complaints Log form-staple the Complaints Form to the Complaints Log Form. File both the originals in the Complaints File.</li>
											<li>Refer the complaint to the 21K Digital Media Ltd Quality Manager by forwarding copies of the Complaint form. File and Complaints Log.</li>
											<li>The 21K Digital Media Ltd Quality Manager will ensure the complaint is actioned and the Complaint receives a written response within five working days.</li>
											<li>All complaints received in the calendar month will be discussed at the 21K Digital Media Ltd Team Meeting. Individual staff members will not be identified however, the 21K Digital Media Ltd Quality Manager will be responsible for ensuring learning points are highlighted and corrective action taken.</li>	
										</ul>
									</div>
								</div>								
							</div>
							<div class="tab-pane fade" id="policy" role="tabpanel" aria-labelledby="policy-tab">
								<div class="help-page">
									<div class="container page-head pt-4 text-center">
										<h4 class="mb-4">Disability Policy</h4>
										<div class="row title">
											<div class="col-6 text-left">Policy</div>
											<div class="col-6 text-right"><a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a></div>
										</div>
									</div>
									<div class="container pt-4">
										<p>21K Digital Media Ltd is totally committed to the elimination of any from of discrimination. We will ensue hat members of staff; our clients and professional organisations that access our service are not discriminated against directly or indirectly because of any disability hey have or may have had.</p><br/><hr/>				<p>The elimination of discrimination against disabled persons or persons who have had a disability are the subjects of disability discrimination legislation. This is covered by The Disability Discrimination Act 1995.</p>
										<p>According to the Disability Discrimination Act, a disabled person is anyone with "a physical or mental impairment, which has substantial and long-term adverse effect upon his or (her) ability to carry out normal day -to- day activities.</p>

										<p>Discrimination is deemed to have occurred when:</p><hr/>
										<ul>
											<li>A disabled person is treated less favourably than some else; and</li>
											<li>The treatment is for a reason relating to the person's disability; and</li>
											<li>The treatment cannot be justified; and also where</li>
											<li>There is a failure to make reasonable adjustment; and</li>
											<li>That failure cannot be justified.</li>	
										</ul>
										<p>We will ensure that our recruitment and selection policies reflect good practice in relation to disability.</p>
										<p>Disability discrimination will be covered in the induction of all staff and training for staff in disability issues will be offered as appropriate.</p><hr/>
										<p>Information resources held in our Information Points will include those with positive images of people with disabilities and learning difficulties.</p>
										<p>We will make all reasonable attempts to gain feedback from service users with disabilities. All uses with disabilities will be asked to complete client feedback forms.</p>
										<p>We will review our policies and procedures in the light of feedback from clients with disabilities. Furthermore, we will take positive action to research the needs of disabled persons and continuously seek ways in which to improve our services and facilities in order to reduce or remove any disadvantage they may caused a disabled person compared to a non-disabled person.</p> 
										<p>If disabled clients are prevented from accessing our services due to premises issues our staff will organise a referral to an alternative provider/ venue, using the NL IAG Networking Directory. Our staff will record the reasons for a referral on a Disability Monitoring Form which is stored in the front of the Client Records File i.e. premises involved, details of the disability, difficulties with the premises and where the client was referred to.</p> 
										<p style="font-weight:600">21K Digital Media Ltd Management Team will review this policy on an annual basis.<br/>
										Issue No.1 Dated 26 February 2016<br/>
										Revision Date: January 2017</p>
									</div>
								</div>	
							</div>
							<div class="tab-pane fade" id="equal" role="tabpanel" aria-labelledby="equal-tab">																
								<div class="help-page">
									<div class="container page-head pt-4 text-center">
										<h4 class="mb-4">Equal Opportunity</h4>
										<div class="row title">
											<div class="col-6 text-left">Introduction</div>
											<div class="col-6 text-right"><a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a></div>
										</div>
									</div>
									<div class="container pt-4">
										<p>21K Digital Media Ltd aims to promote equality of opportunity and is committed to relations amongst all people with whom it is involved. It is the policy of the 21K Digital Media Ltd that there shall be no discrimination in staff recruitment, employment conditions, promotions and delivery of training on the grounds of gender, marital status, colour, race, ethnic or national origins, disability, religion, sexual orientation or age.</p>

										<p>21K Digital Media Ltd aims to :</p><hr/>
										<ul>
											<li>Identify and stop discrimination whenever it occurs and in particular, discrimination against the groups within the scope of this statement.</li>
											<li>Ensure our services and published materials are consistent with our Equal Opportunities policy, and avoid the use of offensive and discriminating language in both formal and informal communications.</li>	
										</ul>

										<p>To achieve our aims we will</p><hr/>										
										<ul>
											<li>Promote Equal Opportunities throughout the organisation</li>
											<li>Provide annual training and/or guidance to all employees to ensure 21K Digital Media Ltd commitment to Equal Opportunities is known and understood</li>
											<li>Collect, evaluate and act upon the anonymous opinions of service users</li>
											<li>Review all our policies and procedures annually to ensure equality of opportunity, responsiveness, sensitivity and accessibility</li>
											<li>Ensure our disciplinary and grievance procedures contain provision to enforce this policy &</li>	
											<li>Include Equal Opportunities as a mandatory point/agenda item at the 21K Digital Media Ltd Quality Review Group meetings</li>
										</ul>
										<p>All members of 21K Digital Media Ltd will be expected to respect and act in accordance with this policy</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Recruitment</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>The 21K Digital Media Ltd will recruit and select by processes that reflect good personnel practice and avoid discrimination against any group of people. Vacancies and opportunities will be widely publicised to reach all sectors of society.</p>

										<p>Positive Action</p><hr/>
										<p>Under the Sex Discrimination Act (1975) and Race Relations Act (1976) we can: (Both Acts are available on request)</p>
										<ul>
											<li>Provide training and encouragement for people of a particular race or gender, who are under-represented in certain occupations or pay scales</li>
											<li>Address any special educational, training or welfare needs for a specific racial group.</li>
											<li>Provide training and encouragement for people returning to work following domestic or family responsibilities</li>	
										</ul>
										<p>Positive Action or encouragement might include targeted advertising and recruitment literature, or reserving places for particular groups on training courses.</p>
										<p>Specific steps will be taken to encourage applicants from particular groups where these are under-represented. It is the 21K Digital Media Ltd s' policy of the that applicants are employed and trained on the basis of ability and the requirements of the job/training scheme.</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Monitoring</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>21K Digital Media Ltd will collect and maintain records for analysis and review, and to show what progress is being made in the implementation of this policy. The information will include:</p>
										<ul>
											<li>Recruitment and Selection data</li>
											<li>Composition of our trainees and employees</li>
											<li>Achievement of qualifications and job outcomes</li>
											<li>Take-up of work experience placements</li>
											<li>Any other monitoring as determined by the Equal Opportunities Quality Review Group</li>	
										</ul>
										<p>The Chief Executive will regularly monitor the effectiveness of Equal Opportunity in all its practices. The senior management team will take any appropriate action required to ensure that the 21K Digital Media Ltd fulfils the requirements of all relevant legislations. Monitoring procedures will cover the ethnicities, gender and disability of applicants and recruits, in relation to all members of 21K Digital Media Ltd.</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Inroduction</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>Staff and trainees will receive a comprehensive induction programme that clearly explains their rights and responsibilities. All staff will receive a copy of the Staff Handbook and all trainees' a Training Handbook, both of which contains details of the Equal Opportunities Policy.</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Training And Assessment</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>21K Digital Media Ltd will promote access to training and assessment for members, and will do all that is possible to ensure that those who have the potential to achieve the standards are given access to fair assessments. Where possible, candidates with particular training and assessment requirements will be given alternative means to provide evidence of competence. Care will be taken to ensure that proposed assessment methods are of equal quality and rigor to those of mainstream candidates.</p>
										<p>Candidates will be given appropriate support in their development, to help them meet the required standard such as:</p>
										<ul>
											<li>Help with communication, literacy and numeracy</li>
											<li>Adapted equipment and physical environment</li>
											<li>Special information technology equipment</li>
											<li>Confidence building</li>
											<li>Help with finding work or accessing other training opportunities</li>
											<li>Information, Advice and Guidance - before, during and after programme</li>
										</ul>
										<p>The 21K Digital Media Ltd ensures that all our awarding bodies; Equal Opportunities policies relating to training and assessment, are adhered to at all times.</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Staff Development</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>An annual training and development budget will be agreed and training provided as part of a general programme to improve skills throughout the workforce, In addition, the 21K Digital Media Ltd has a training appraisal for all staff are encouraged them to use Learndirect programmes for personal and professional development. Attendance during working hours will be negotiated with line managers. Promotion/advancement will be based on ability and opportunities given to all staff within the organisation.</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Complaints Relating to Abuse and Discrimination</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>All complaints of discrimination - direct or indirect, abuse, victimisation or harassment will be investigated without delay by a senior manger. Such activities, if established against a 21K Digital Media Ltd member, will be dealt with via the grievance procedure, as gross misconduct under the disciplinary procedures.</p>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Marketing and Corporate Image</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>All staff, trainees, applicants and new recruits will receive information on the Equal Opportunities policy. Staff and trainee induction will cover equality of opportunity.</p>
										<p>21K Digital Media Ltd seek to</p><hr/>
										<ul>
											<li>Maintain representative numbers of staff from local communities on its workforce at all levels</li>
											<li>Make its marketing strategies relevant to the different local communities</li> 
											<li>Include an appropriate Equal Opportunities statement in all advertising or promotional material</li>
											<li>Encourage minority groups to participate</li> 
											<li>Use local and national minority press and local networks to ensure that information is widely available</li>	
										</ul>
									</div>

									<div class="container page-head pt-4">
										<div class="row title">
											<div class="col-6">Organisational Responsibility</div>
										</div>
									</div>
									<div class="container pt-4">
										<p>The Chief Executive and Senior Management Team will review the 21K Digital Media Ltd 's Equal Opportunities Policy to ensure its continued relevance and will recommend and promote equal opportunities initiatives. Line Mangers are responsible for implementing and promoting the policy within their centres/branches. Managers must observe and promote the company's Equal Opportunities Policy at all times. All staff and trainees are expected to observe the Equal Opportunities Policy and implement it within their spheres of activity.</p>
										<p>Key Terms</p><hr/>
										<ul>
											<li>Equal opportunities - treating people the same, regardless of differences that are not relevant, but considering differences that are.</li> 
											<li>Prejudice - unfavourable opinion or feelings formed beforehand based on limited knowledge, thought or reason.</li>
											<li>Discrimination - less favourable treatment.</li>
											<li>Direct Discrimination - treating someone less favourably than another.</li> 
											<li>Indirect Discrimination - where the conditions or requirements for job/ training are unnecessary, unfair or unreasonable, to the exclusion of individuals or groups.</li> 
											<li>Harassment - unwelcome or inappropriate behaviour that undermines, demeans, offends, insults or injures.</li>
											<li>Victimisation - Persistent Harassment</li>
											<li>Grievance - a feeling of resentment or injustice at having been unfairly treated</li> 
											<li>Positive Action - steps to stop discrimination or imbalance by actively encouraging those who are under represented in an organisation</li>
											<li>Members of 21K Digital Media Ltd - staff, trainees, candidates, clients, trustees, partners and guests</li>
										</ul>
									</div>
								</div>	
							</div>
							<div class="tab-pane fade" id="term" role="tabpanel" aria-labelledby="term-tab">								
								<div class="help-page">
									<div class="container page-head pt-4 text-center">
										<h4 class="mb-4">Terms & Conditions</h4>
										<div class="row title">
											<div class="col-6 text-left">Introduction</div>
											<div class="col-6 text-right"><a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a></div>
											<div><hr class="mt-0 mb-0"><p class="mb-0 mt-2 text-left">In order to enrol on our career development programme you must consent to this agreement:</p></div>
										</div>
									</div>
									<div class="container pt-4">
										<ul>
											<li>I agree to be honest in the information I provide to 21K Digital Media Ltd.</li>
											<li>I agree to complete all activities related to my programme within the time agreed with my tutor.</li>
											<li>I agree to fill in any evaluation and funding forms within the time agreed.</li>
											<li>I agree to follow any regulations 21K Digital Media Ltd may introduce from time to time.</li>
											<li>I consent to the Privacy Policy (read the Policy here).</li>
											<li>I agree to use the Chat room and notice board only for careers-related matters.</li>
											<li>I agree not to use abusive, aggressive, discriminatory or sexual language while using using the Chat room, noticeboard or any other areas of the website, or while communicating with tutors</li>	
										</ul>										
									</div>
									<div class="container page-head">
										<div class="row title">
											<div class="col-12 text-left">21K Digital Media Ltd agrees to:</div>											
										</div>
									</div>
									<div class="container pt-4">
										<ul>
											<li>Provide advice, information and support relevant to your career goals and needs.</li>
											<li>Provide the best service we can to all students, whatever their cultural or educational background, race, gender, disability, religion or sexuality.</li>
											<li>Respond to all questions within 24 hours</li>
											<li>Respond to all complaints within 24hours</li>
											<li>Follow the Privacy Policy.</li>	
										</ul>										
									</div>
								</div>	
							</div>
							<div class="tab-pane fade" id="mission" role="tabpanel" aria-labelledby="mission-tab">								
								<div class="help-page">
									<div class="container page-head pt-4 text-center">
										<h4 class="mb-4">Mission Statements</h4>
										<div class="row title">
											<div class="col-6 text-left">Statements of Service</div>
											<div class="col-6 text-right"><a class="print" href="javascript:print();"><i class="fa fa-print" aria-hidden="true"></i> Print this page</a></div>
										</div>
									</div>
									<div class="container pt-4">
										<p>21K Digital Media Ltd is an e-learning company based in London We specialise in producing high quality e- learning resources to aid individual career development.</p>
										<p>Our aim is to empower all who are socially, and economically, disadvantaged. We focus, especially, on those who are disabled, refugees, unemployed, low-income employees or, in any way, socially excluded.</p>
										<p>We help them improve their quality of life through increased effective knowledge, by our skilful use of media and technology</p>
										<p>By developing specific multimedia solutions, we enable businesses, community organisations and other training agencies, to enhance their courses.</p>
										<p>We are experts in producing a wide range of educational programmes to meet the diverse needs within the workplace.</p>
										<p>We provide unbiased, confidential information advice and guidance to individuals who need to decide what career options are available to them and how to take the necessary steps to achieve their goals.</p>
										<p>Our IAG services are supported by a code of conduct relating to confidentiality, equal opportunities and disability.</p>
										<p>We regularly review our IAG services and use your comments to increase our awareness on how well we meet your needs.</p>
										<p>Date January 2010<br> Review Date February 2011</p>
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
</body>

</html>