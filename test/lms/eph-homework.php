<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Homework<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Homework</h4>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item" role="presentation">
								<a class="nav-link <?php if(!isset($_GET['ct'])){echo "active"; } ?>" id="summery-tab" href="eph-homework" role="tab" aria-controls="summery" aria-selected="true"><i class="fa fa-file-text" aria-hidden="true"></i> All</a>
							</li>
							<?php								
								$selsub="select s.iSubjectId, s.vSubjectName,u.I_subjectid  from  cpo_subjectmaster as s, cpo_user_subject as u where s.iSubjectId=u.I_subjectid  and  I_studentid=".$_SESSION['user_id']." group by I_subjectid order by  s.iSubjectId" ;
								$ressub = runquery($selsub);
								$count = mysqli_num_rows($ressub);
								$snm = '';
								if($count){
									foreach($ressub as $rowsub){
										$sid = $rowsub['iSubjectId'];
										$snm = $rowsub['vSubjectName'];
										if(isset($_GET['ct']) && $_GET['ct'] !== '' && $sid == $_GET['ct'] ){											
											echo "<li class='nav-item' role='presentation'> <a class='nav-link active' id='summery-tab' href='eph-homework?ct=$sid' role='tab' aria-controls='summery' aria-selected='true'><i class='fa fa-file-text' aria-hidden='false'></i> $snm</a> </li>";
										}else{
											echo "<li class='nav-item' role='presentation'> <a class='nav-link' id='summery-tab' href='eph-homework?ct=$sid' role='tab' aria-controls='summery' aria-selected='false'><i class='fa fa-file-text' aria-hidden='true'></i> $snm</a> </li>";
										}
									}
								}
							?>
						</ul>
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="summery" role="tabpanel" aria-labelledby="summery-tab">
							<?php 
								if(isset($_GET['ct']) && $_GET['ct'] !== ''){									
									echo "<h5>Homework: $snm</h5>";
								}else{
									echo "<h5>Student Homework</h5>";
								}
								if($count){
									?>
									<div class="table-responsive">
										<table class="table table-hover mb-0">
											<thead class="dark">
												<tr>
													<th>Subject</th>
													<th>Title</th>
													<th>Due Date</th>
													<th>Status</th>
													<th>Feedback</th>
												</tr>
											</thead>
											<tbody>
									<?php
										if(isset($_GET['ct']) && $_GET['ct'] !== ''){
											$fetch1="select  I_user_subid,I_subjectid  from cpo_user_subject where I_studentid =".$_SESSION['user_id']." and I_subjectid=".$_GET['ct'];
											$result1=runquery($fetch1);
											$count1=mysqli_num_rows($result1);
											while($row_ius =mysqli_fetch_array($result1)){
												$ids[] = $row_ius['I_user_subid'];
											}$vcnt =0;

											if($count1 > 0){
												for($ij = 0; $ij < count($ids); $ij++){												
													$fetchname="select * from cpo_subjectmaster where iSubjectId=".$_GET['ct'];
													$resultfetchname=runquery($fetchname);
													$count10=mysqli_num_rows($resultfetchname);
													if ($count10 > 0){
														$subnamearry=mysqli_fetch_array($resultfetchname);
														$subjectname=$subnamearry['vSubjectName'];
													}
													
													$sqlspn="select I_homeworkid,V_title ,D_assign_date ,D_due_date,C_Completed,T_Summary from cpo_homework where I_user_subjectid=".$ids[$ij];
													$result = runquery1($sqlspn) or die('could not execute'.mysqli_error());
													$num = $result? mysqli_num_rows($result) : 0;													
													if ($num > 0){
														$count = mysqli_num_rows($result);
														$page=Ceil($count/page_size);
														if(isset($_GET['curpage'])){
															$curpage = $_GET['curpage'];
															if($curpage==0){
																 $sqlspn.=" order by D_due_date desc  Limit 0,".page_size;
															}else{
																$current=page_size*($curpage);
																$sqlspn.=" order by D_due_date desc  Limit " .$current. ",".page_size;
															}
														}else{
														   $sqlspn.=" order by D_due_date desc Limit 0,".page_size;
														   $curpage=0;
														}
														$result2 = runquery1($sqlspn);												
														while($row2=mysqli_fetch_array($result2)){
															$logid=$row2["I_homeworkid"];
															$due_date =gdate($row2['D_due_date']);
															$title=ucfirst($row2['V_title']);
															$comp = ucfirst($row2['C_Completed']);
															if($row2['T_Summary'] != "" ){ 
																$view = 'Click to view';	 
															}else{ 
																$view = 'Add Feedback'; 
															}
															echo "<tr><td><a href='hwfolder?ct=".$_GET['ct'].">' >$subjectname</a></td><td>$title</td><td>$due_date</td><td><a href='#' onClick='javascript:openwin($logid)'>$comp</a></td><td><a href='#' onClick='javascript:openwin($logid)'>$view</a></td></tr>";
														}
													}else {
														$flg =1; $vcnt++;
													}
													 
			 									}if(count($ids)== $vcnt){ 
													echo "<tr><td colspan='5'><h6 class='text-muted mb-2 mt-2'>No Homework Exists</h6></td></tr>";
												}
											}else{ 
												echo "<tr><td colspan='5'><h6 class='text-muted mb-2 mt-2'>No Homework Exists</h6></td></tr>";
											}
										}else{
											$fetch1="select I_user_subid,I_subjectid  from cpo_user_subject where I_studentid=".$_SESSION['user_id']." group by I_subjectid" ;
											$result1=runquery($fetch1);
											$count1=mysqli_num_rows($result1);
											if($count1 > 0){
												$vcnt =0;
												while($row1=mysqli_fetch_array($result1)){
													$fetchname="select * from cpo_subjectmaster where iSubjectId=".$row1["I_subjectid"];
													$resultfetchname=runquery($fetchname);
													$count10=mysqli_num_rows($resultfetchname);
													if ($count10 > 0){
														$subnamearry=mysqli_fetch_array($resultfetchname);
														$subjectname=$subnamearry['vSubjectName'];
													}
													$query1="select I_homeworkid,V_title ,D_assign_date,D_due_date,C_Completed,T_Summary from cpo_homework where I_user_subjectid=".$row1['I_user_subid'];
													$result=runquery($query1);
													$count2=mysqli_num_rows($result);
													while($row=mysqli_fetch_array($result)){
														$logid=$row["I_homeworkid"];
														$due_date =gdate($row['D_due_date']);
														$compl = ucfirst($row['C_Completed']);
														$title=ucfirst($row['V_title']);															
														if($row2['T_Summary'] != "" ){ 
															$view = 'Click to view';	 
														}else{ 
															$view = 'Add Feedback'; 
														}
														echo "<tr><td><a href='hwfolder?ct=".$_GET['ct'].">' >$subjectname</a></td><td>$title</td><td>$due_date</td><td><a href='#' onClick='javascript:openwin($logid)'>".$row['C_Completed']."</a></td><td><a href='#' onClick='javascript:openwin($logid)'>$view;</a></td></tr>";
														$flg =1; $vcnt++;
													}														
												}if($vcnt == 0){ 
													echo "<tr><td colspan='5'><h6 class='text-muted mb-2 mt-2'>No Homework Exists</h6></td></tr>";
												}
											}else{ 
												echo "<tr><td colspan='5'><h6 class='text-muted mb-2 mt-2'>No Homework Exists</h6></td></tr>";
											} 
										}
									?>
											</tbody>
										</table>										
										<div class="dataTable-bottom">
											<ul class="pagination pagination-primary float-end dataTable-pagination">
												<?php
												if(isset($page) && $page>1){ 
													echo "Page : ";
													for($i=1;$i<=$page;$i++){
														if($i==($curpage+1)){
															echo "<li class='page-item active'><a href='#' class='page-link' data-page='$i'>$i</a></li>";
														}else{
															$str="";
															$j = $i-1;
															echo "<li class='page-item'><a class='page-link' data-page='$i' href='in-event-history?curpage=".$j."&ct=".$_GET['ct']."'>$i</a></li>";															
														}									
													}
												}
												?>
											</ul>
										</div>
									</div>	
									<?php
								}else{
									echo "<div class='tab-pane fade active show' id='summery' role='tabpanel' aria-labelledby='summery-tab'><h2 class='text-warning'><i class='fa fa-frown-o'></i> Oops...</h2><h5 class='text-muted mb-4'>No Subject Assigned.</h5></div>";
								}
							?>
						</div>							
                    </div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
	<script>
		function openwin(obj){
			new1=window.open("eph-hw-details?id="+obj,"",'height=450,width=600,scrollbars=yes,top=50 left=150');
		}
	</script>
</body>

</html>