<?php include_once 'dbConnection.php'; ?>
<html>
<head>
<title>CareerPaths Online - Download files</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<!-- <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script> -->

</head>
<body>
<?php
	if(isset($_GET['id'])){
		//$fname = cleancode($_GET['id']);
		$fname = $_GET['id'];
		if($fname == 'Individual_Learning_Plan.doc'){
			addlog(15);
		}
		if($fname == 'Individual_Learning_Plan_Review.doc'){
			addlog(17);
		}
		if($fname == 'Course_Evaluation_Questionnaire.doc'){
			addlog(20);
		}
	}
?>
<script language="JavaScript">
	window.location = "<?php echo 'assets/documents/'.$fname; ?>";
</script>
</body>
</html>
