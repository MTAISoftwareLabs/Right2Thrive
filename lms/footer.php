			<!-- Logout modal lives outside the header so Bootstrap fixed backdrop/dialog are not clipped (header uses backdrop-filter / sticky). -->
			<div class="modal fade hub-logout-modal" id="logout-modal" tabindex="-1" aria-labelledby="logout-modal-title" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<div class="hub-logout-modal__title-wrap">
								<span class="hub-logout-modal__icon" aria-hidden="true"><i class="bi bi-box-arrow-right"></i></span>
								<h5 class="modal-title mb-0" id="logout-modal-title">Sign out</h5>
							</div>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
							<p class="mb-3">You are about to leave your session. Unsaved work in open pages may be lost.</p>
							<div class="hub-logout-modal__hint" role="note">
								<i class="bi bi-journal-text" aria-hidden="true"></i>
								<span>If your programme requires it, complete your <strong>log book</strong> before signing out.</span>
							</div>
						</div>
						<div class="modal-footer d-flex flex-wrap justify-content-end align-items-center">
							<button type="button" class="btn btn-light border hub-logout-modal__btn-cancel me-2 mb-2 mb-sm-0" data-bs-dismiss="modal">Stay signed in</button>
							<a class="btn btn-danger hub-logout-modal__btn-confirm mb-2 mb-sm-0" href="student-log-form.php?logout=yes">Sign out</a>
						</div>
					</div>
				</div>
			</div>

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
					var btnLogout = document.getElementById("btn-logout");
					if (btnLogout) {
						btnLogout.addEventListener("click", logout);
					}
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