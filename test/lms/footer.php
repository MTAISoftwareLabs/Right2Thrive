            <footer>				
				<div class="row">
					<div class="col-md-12 text-right">
						<a href="#" class="go-back btn btn-sm btn-outline-danger" onclick="history.back();">Go Back</a>
					</div>
				</div>
                <div class="footer clearfix mb-0 text-muted row">
                    <div class="col-sm-6 text-left">
                        <p><?php echo date("Y"); ?> &copy; Right2Thrive UK Ltd</p>
                    </div>
                    <div class="col-sm-6 text-right">
                        <p>All rights reserved.</p>
                    </div>
                </div>
            </footer>
			    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
				<script src="assets/js/bootstrap.bundle.min.js"></script>

				<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>

				<script  src="assets/js/txteditor.js"></script>

				<script src="assets/js/main.js"></script>
				<script>
					window.onscroll = function() {myFunction()};
					document.getElementById("menubtn").addEventListener("click", myFunction);

					var header = document.getElementById("header");
					var sticky = header.offsetTop;

					function myFunction() {
						if (window.pageYOffset > sticky) {
							header.classList.add("sticky");
							var xx = document.getElementById('main').clientWidth - 64;
							document.getElementById("header").style.columnWidth = xx + "px";
						} else {
							header.classList.remove("sticky");
						}
					}
					
					document.getElementById("btn-logout").addEventListener("click", logout);
					function logout(){
						if(<?php echo $_SESSION['log_fill'];?>==0){
							window.location="student-log-form?logout=yes";
						}
						else{
							window.location="../index";
						}
					}
					function downloadfile(){
						fname = "Course_Evaluation_Questionnaire.doc";
						new1=window.open("../download?id="+fname);
					}
				</script>