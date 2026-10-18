<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>	
    <title>Interactive<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4>Interactive</h4>
            </div>
            <div class="page-content">
                <section>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>Topics</h4>
								</div>
								<div class="card-body">
									<div id="notice-board">
										<a href="in-download-center" class="alert alert-secondary"><i class="bi bi-check-circle"></i> Document Download Centre</a>
										<a href="in-book-chat" class="alert alert-secondary"><i class="bi bi-check-circle"></i> Book Chat Time</a>
										<a href="javascript:chatnow();" class="alert alert-secondary"><i class="bi bi-check-circle"></i> Chat Now</a>     
										<a href="in-mail-tutors" class="alert alert-secondary"><i class="bi bi-check-circle"></i> Send Mail</a>
										<a href="in-event-history" class="alert alert-secondary"><i class="bi bi-check-circle"></i> Event History</a> 
										<a href="http://www.groupworld.net/mp/parse.cgi?filename=nc&inst_id=375&instance=conf1&iframe=true" target="_blank" class="alert alert-secondary"><i class="bi bi-check-circle"></i> Virtual Classroom</a>                   
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
		function chatnow(){
			new1=window.open("../chatnew/","","titlebar='CareerPaths Online - Chatting',height=460,width=700,scrollbars=yes,top=50,left=150");
		}
	</script>
</body>

</html>