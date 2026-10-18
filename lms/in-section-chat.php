<div class="row">
	<div class="col-md-12">
		<div class="buttons">
			<!-- <a href="javascript:chatnow();" class="btn btn-primary"><i class="fa fa-comments-o" aria-hidden="true"></i> Chat Now</a>
			<a href="http://www.groupworld.net/mp/parse.cgi?filename=nc&inst_id=375&instance=conf1&iframe=true" target="_blank" class="btn btn-primary"><i class="fa fa-laptop" aria-hidden="true"></i> Virtual Classroom</a> -->
			<!--<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chat-info"><i class="fa fa-comments-o" aria-hidden="true"></i> Chat Now</a>-->
			<a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chat-info"><i class="fa fa-laptop" aria-hidden="true"></i> Virtual Classroom</a>

			<!--Danger theme Modal -->
			<div class="modal fade text-left" id="chat-info" tabindex="-1"
				role="dialog" aria-labelledby="myModalLabel120"
				aria-hidden="true">
				<div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable"
					role="document">
					<div class="modal-content">
						<div class="modal-header bg-info">
							<h5 class="modal-title white" id="myModalLabel120">
								Zoom Class
							</h5>
							<button type="button" class="close"
								data-bs-dismiss="modal" aria-label="Close">
								<i data-feather="x"></i>
							</button>
						</div>

						<div class="modal-body">
													<?php 
session_start();
if (isset($_SESSION['url']))
{ 
    echo"The tutor Scheduled Class At ".$_SESSION['time'];
	echo "<a href=' ".$_SESSION['url'];
	echo"'> Join..</a>";
}

else{
  echo "Tutor didn't Schedule the Class yet !";
}
 
 ?></span>
						
						<!--<div class="modal-body">-->
						<!--	Chat not initialized yet.<span class="text-sm text-primary d-block">Try again later or contact with tutor.</span>-->
						<!--</div>-->
						
						<div class="modal-footer">
							<button type="button" class="btn btn-sm btn-light-secondary mb-0" data-bs-dismiss="modal">
								<span class="d-none d-sm-block">Close</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>