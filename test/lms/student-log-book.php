<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Learner Logs Book View<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
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
						<div class="tab-content card-header" id="myTabContent">
							<div class="tab-pane fade active show" id="event-history" role="tabpanel" aria-labelledby="event-history-tab">
								<div class="row">
									<div class="col-md-2">
									</div>
									<div class="col-md-8">
										<div class="card shadow">											
											<div class="card-content">
												<div class="card-body">
												<h5 class="text-center mb-4">View Learner Log Book</h5>												
												<div class="table-responsive" id="search1">
													<table class='table table-hover'>
														<thead class='dark'>
															<tr>
																<th>Entry Date</th>
																<th>Tutor Name</th>
																<th>Subject</th>
															</tr>
														</thead>
														<tbody>
														<?php
															$sqlspn="select s.iLogId,t.vUserName,s.dEntryDate,sm.vSubjectName from cpo_studentlogbook s,cpo_usermaster t,cpo_subjectmaster sm where s.iTutorId = t.iUserId and s.iSubjectId = sm.iSubjectId and s.iStudentId and s.iStudentId=".$user_id." order by s.dEntryDate desc";
															$result=runquery($sqlspn);
															$count=0; $page=0;
															if($result){
																$count = mysqli_num_rows($result);
																$page=Ceil($count/page_size);
															}
															if(isset($_GET['curpage'])){
																$curpage = $_GET['curpage'];
																if($curpage==0){
																	 $sqlspn.=" Limit 0,".page_size;
																}else{
																	$current=page_size*($curpage);
																	$sqlspn.=" Limit " .$current. ",".page_size;
																}
															}else{
																$sqlspn.=" Limit 0,".page_size;
																$curpage=0;
															}
															$result = runquery($sqlspn);
															$num = $result ? mysqli_num_rows($result):0;
															$counter=1;	
															if($num > 0){
																while($rslist = mysqli_fetch_array($result)){
																	$dispdate = gdate($rslist["dEntryDate"]);
														?>
															<tr> 
																<td><a href="#" onClick="javascript:openwin(<? echo $rslist['iLogId'] ?>)"><? echo $dispdate; ?></a></td>
																<td><a href="#" onClick="javascript:openwin(<? echo $rslist['iLogId'] ?>)"><? echo $rslist["vUserName"]; ?></a></td>
																<td><a href="#" onClick="javascript:openwin(<? echo $rslist['iLogId'] ?>)"><? echo $rslist["vSubjectName"]; ?></a></td>
															</tr>
														 <?php
																$counter++;
																}
															}else{
																echo "<tr><td colspan='3' class='text-center font-bold'>No Log Book information found.</td></tr>";
															}
														?>													
														</tbody>
													</table>
													<div class="dataTable-bottom">
														<ul class="pagination pagination-primary float-end dataTable-pagination">
															<?php
																if($page>1){ 
																	echo "Page : ";
																	for($i=1;$i<=$page;$i++){
																		if($i==($curpage+1)){
																			echo "<li class='page-item active'><a href='#' class='page-link' data-page='$i'>$i</a></li>";
																		}else{
																			$str="";
																			$j = $i-1;
																			echo "<li class='page-item'><a class='page-link' data-page='$i' href='student-log-book?curpage=$j'>$i</a></li>";															
																		}									
																	}
																}
															?>
														</ul>
													</div>
												</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-2">
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
	<script>		
		function openwin(obj){
			new1=window.open("student-log-detail?id="+obj,"",'height=600,width=600,scrollbars=yes,top=50 left=150');
			return true;
		}
	</script>
</body>

</html>