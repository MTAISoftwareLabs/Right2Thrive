<!DOCTYPE html>
<html lang="en">
<?php
@ini_set('display_errors', 'off');
$title = "";
$img = "";
$errcode = $_GET["errcode"];
if ($errcode != ""){
	if($errcode == 400){
		$title = "Bad Request";
		$img = "error-403.png";
	}else if($errcode == 401){
		$title = "Unauthorised Access";
		$img = "error-403.png";
	}else if($errcode == 403){
		$title = "Forbidden";
		$img = "error-403.png";
	}else if($errcode == 500){
		$title = "Internal Server Error";
		$img = "error-500.png";
	}else{
		$title = "Page Not Found";
		$img = "error-404.png";
	}
}else{
	$title = "Page Not Found";
	$img = "error-404.png";
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/error.css">
    <link rel="icon" href="assets/images/logo/logo.png" type="image/png">
	<style>
		#main{
			margin-left:unset;
			text-align:center;
		}
	</style>
</head>

<body>
    <div id="app">
        <div id="main">
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
										<img src="assets/images/logo/logo.png" alt="Right 2 Thrive UK" style="max-width:100px; margin-bottom:50px"><br/>
                                        <h4><?php echo $title; ?></h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="notice-board">
										<img src="assets/images/samples/<?php echo $img; ?>" style="max-width:500px;"><br/>
										<a href="index" class="go-back btn btn-sm btn-outline-danger">Home</a>
										<a href="#" class="go-back btn btn-sm btn-outline-danger" onclick="history.back();">Go Back</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</body>

</html>