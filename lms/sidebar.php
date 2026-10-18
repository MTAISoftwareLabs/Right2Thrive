<?php
	function active($currect_page){
	  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
	  $url = end($url_array);
	  $url =  explode('?', $url) ;
	  $url =  reset($url) ;
	  if($currect_page == $url){
		  echo 'active'; //class name in css 
	  }else if($currect_page == "my-account"){
		  $pages = array("my-ac-personal-information.php", "my-ac-qualification.php", "my-ac-upload-photo.php", "my-ac-join-course.php", "my-ac-change-password.php", "my-account.php");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }			  
		  }
	  }else if($currect_page == "my-wellbeing"){
		  $pages = array("zoom.php", "phq9.php", "gad7.php", "my_weekly_wellness_checkin.php", "my_care_plan.php", "mh-review-download.php");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }
		  }
	  }else if($currect_page == "career-coach-chat"){
		  $pages = array("career-chat.php");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }
		  }
	  }else if($currect_page == "interactive"){
		  $pages = array("in-download-center.php", "in-book-chat.php", "in-mail-tutors.php", "in-event-history.php", "interactive_learning.php", "interactive.php");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }
		  }
	  }else if($currect_page == "job-vacancies"){
		  $pages = array("eps-personal-development.php", "learning-resources.php");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }
		  }
	  }else if($currect_page == "my-portfolio"){
		  $pages = array("my-portfolio.php", "eps-download-course-work.php", "eph-homework.php", "epl-plan-download.php", "epl-review-download.php", "student-log-form.php", "student-log-book.php", "career-progress-dashboard.php");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }
		  }
	  }
	}
?>
		<div id="sidebar" class="active">
            <div class="sidebar-wrapper active ps ps--active-y">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="../assets/images/logo/logo.png" alt="Right 2 Thrive UK" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
						<li class="sidebar-title username"><?php echo 'Hello, ' . (isset($_SESSION['user_name']) ? htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') : 'Member'); ?></li>
				
						 <li class="sidebar-item <?php active('dashboard.php');?>">								  
                            <a href="dashboard.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Home</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('Virtual_Classroom');?>">
                            <a href="zoom.php" class='sidebar-link'>
                                <i class="bi bi-camera-video"></i>
                                <span>Virtual Classroom</span>
                            </a>
                        </li>

						<li class="sidebar-item <?php active('career-coach-chat');?>">
                            <a href="career-chat.php" class='sidebar-link'>
                                <i class="bi bi-chat-dots"></i>
                                <span>Career coach chat</span>
                            </a>
                        </li>
						<li class="sidebar-item <?php active('my-portfolio.php');?>">
                            <a href="my-portfolio.php" class='sidebar-link'>
                                <i class="bi bi-folder2-open"></i>
                                <span>My E-Portfolio</span>
                            </a>
                        </li>
						<li class="sidebar-item <?php active('my-portfolio');?>">
                            <a href="career-progress-dashboard.php" class='sidebar-link'>
                                <i class="bi bi-graph-up-arrow"></i>
                                <span>Career Progress Monitor</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('interactive');?>">
                            <a href="in-download-center.php" class='sidebar-link'>
                                <i class="bi bi-egg-fill"></i>
                                <span>Interactive</span>
                            </a>
                        </li>
						 <li class="sidebar-item <?php active('career-development.php');?>">
                            <a href="career-development.php" class='sidebar-link'>
                                <i class="bi bi-award-fill"></i>
                                <span>Career Development</span>
                            </a>
                        </li>
                        
                         
						
                       
                        <!--<li class="sidebar-item <?php active('my-account');?>">-->
                        <!--    <a href="my-account.php" class='sidebar-link'>-->
                        <!--        <i class="bi bi-person-lines-fill"></i>-->
                        <!--        <span>Virtual Classroom</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                         <li class="sidebar-item <?php active('my-wellbeing');?>">
                            <a href="zoom.php" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>My Wellbeing</span>
                            </a>
                        </li>
                        
                        <li class="sidebar-item <?php active('job-vacancies');?>">
                            <a href="eps-personal-development.php" class='sidebar-link'>
                                <i class="bi bi-briefcase-fill"></i>
                                <span>Job Vacancies</span>
                            </a>
                        </li>
                       
						<li class="sidebar-item <?php active('help-guide.php');?>"> <!-- has-sub class for submenu -->
                            <a href="help-guide.php" class='sidebar-link'>
                                <i class="bi bi-info-square-fill"></i>
                                <span>Help & Guide</span>
                            </a>
                            <!-- <ul class="submenu ">
                                <li class="submenu-item ">
                                    <a href="help-guide#complaint">Complaint Procedures</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Grievance Form</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Disability Policy</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Equal Opportunity</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Terms & Conditions</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="#">Mission Statements</a>
                                </li>
                            </ul>-->
                        </li>
                        <!--<li class="sidebar-item <?php active('chatnow');?>">-->
                        <!--    <a href="chatnow.php" class='sidebar-link'>-->
                        <!--        <i class="bi bi-file-earmark-medical-fill"></i>-->
                        <!--        <span>Chat Now</span>-->
                        <!--    </a>-->
                        <!--</li>-->
                          
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>