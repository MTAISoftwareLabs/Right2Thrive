			<header id="header" class="mb-3 clearfix">
				<div class="left-header">					
					<a href="#" class="burger-btn d-block" id="menubtn">
						<i class="bi bi-justify fs-3"></i>
					</a>
				</div>				
				<div class="center-header">
					<h2>My Digital Future</h2>
				</div>
				<div class="right-header">
					<div class="modal-danger me-1 mb-1 d-inline-block">
						<!-- Button trigger for danger theme modal -->
						<button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#logout-modal">
							Sign Out
						</button>

						<!--logout-modal theme Modal -->
						<div class="modal fade text-left" id="logout-modal" tabindex="-1" aria-labelledby="myModalLabel120" style="display: none;" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
								<div class="modal-content">
									<div class="modal-header bg-danger">
										<h5 class="modal-title white" id="myModalLabel120">
											Sign Out
										</h5>
										<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
											<i data-feather="x"></i>
										</button>
									</div>
									<div class="modal-body">
										Do you really want to Sign Out?
										<p class="log-text"><i class="bi bi-exclamation-triangle"></i> Please fill up your log book entry</p>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-danger ml-1" id="btn-logout">
											<span class="d-none d-sm-block">Yes</span>
										</button>
										<button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal" aria-label="Close">
											<span class="d-none d-sm-block">No</span>
										</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
            </header>