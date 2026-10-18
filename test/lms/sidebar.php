<?php
	function active($currect_page){
	  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
	  $url = end($url_array);
	  $url =  explode('?', $url) ;
	  $url =  reset($url) ;
	  if($currect_page == $url){
		  echo 'active'; //class name in css 
	  }else if($currect_page == "my-account"){
		  $pages = array("my-ac-personal-information", "my-ac-qualification", "my-ac-upload-photo", "my-ac-join-course", "my-ac-change-password");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }			  
		  }
	  }else if($currect_page == "interactive"){
		  $pages = array("in-download-center", "in-book-chat", "in-mail-tutors", "in-event-history");
		  foreach($pages as $xx){
			  if($xx == $url){
				echo 'active';
			  }
		  }
	  }else if($currect_page == "my-portfolio"){
		  $pages = array("eps-upload-course-work", "eps-download-course-work", "eph-homework", "epl-plan-upload", "epl-plan-download", "epl-review-upload", "epl-review-download", "student-log-form", "student-log-book");
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
                            <a href="index"><img src="images/logo.png" alt="Right2Thrive UK Collective Careers Hub" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
						<li class="sidebar-title username">Hi <?php echo $_SESSION['user_name']; ?> !!</li>
                        <li class="sidebar-item <?php active('dashboard');?>">								  
                            <a href="dashboard" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('my-account');?>">
                            <a href="my-account" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>Personal Information</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('my-portfolio');?>">
                            <a href="my-portfolio" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>My E-Portfolio</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('interactive');?>">
                            <a href="in-download-center" class='sidebar-link'>
                                <i class="bi bi-egg-fill"></i>
                                <span>Interactive</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('learning-resources');?>">
                            <a href="learning-resources" class='sidebar-link'>
                                <i class="bi bi-file-earmark-medical-fill"></i>
                                <span>Learning Resources</span>
                            </a>
                        </li>
                        <li class="sidebar-item <?php active('career-development');?>">
                            <a href="career-development" class='sidebar-link'>
                                <i class="bi bi-award-fill"></i>
                                <span>Career Development</span>
                            </a>
                        </li>
						<li class="sidebar-item <?php active('help-guide');?>"> <!-- has-sub class for submenu -->
                            <a href="help-guide" class='sidebar-link'>
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
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>