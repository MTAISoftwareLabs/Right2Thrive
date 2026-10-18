    <link rel="icon" href="../assets/images/logo/logo.png" type="image/png">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="assets/css/app.css">
	<?php
		function getIcon($filename){
			switch(substr($filename,strlen($filename)-4,strlen($filename))){
				case ".swf" : return "../assets/images/file-icons/swf.png"; break;
				case ".doc" : return "../assets/images/file-icons/doc.png"; break;
				case "docx" : return "../assets/images/file-icons/doc.png"; break;			
				case ".jpg" : return "../assets/images/file-icons/jpg.png"; break;			
				case ".png" : return "../assets/images/file-icons/png.png"; break;			
				case ".gif" : return "../assets/images/file-icons/gif.png"; break;			
				case ".pdf" : return "../assets/images/file-icons/pdf.png"; break;
				case ".ppt" : return "../assets/images/file-icons/ppt.png"; break;
				case "pptx" : return "../assets/images/file-icons/ppt.png"; break;
				case ".xls" : return "../assets/images/file-icons/xls.png"; break;
				case "xlsx" : return "../assets/images/file-icons/xls.png"; break;
				case ".avi" : return "../assets/images/file-icons/avi.png"; break;
				case ".mpg" : return "../assets/images/file-icons/mpg.png"; break;
				default : return "../assets/images/file-icons/file.png"; break;	
			}
		}
	?>