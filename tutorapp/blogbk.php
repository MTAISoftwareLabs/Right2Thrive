<?php 
include("system/config.inc.php");
include("system/paging.php");

					$recordperpage = 3;
					if (isset($_REQUEST['page'])) {
							$page = $_REQUEST['page'];
							$s1 = $page * $recordperpage - $recordperpage;
							$s2 = $recordperpage;
					} else {
							$s1 = 0;
							$s2 = $recordperpage;
					}		
if(isset($_REQUEST['bid']) && $_REQUEST['bid']!=''){
	$user_sql="SELECT *,DATE_FORMAT(crdate,'%b %D') as blogdate FROM `news` WHERE `id`='".$_REQUEST['bid']."' ";
	$user_res=$obj_db->select($user_sql);
}
else{
$sqlcpont="SELECT count(id) AS `countno` FROM `news`";
$count = $obj_db->select($sqlcpont);
	$user_sql="SELECT *,DATE_FORMAT(crdate,'%b %D') as blogdate FROM `news` ORDER BY `id` DESC LIMIT $s1,$s2";
	$user_res=$obj_db->select($user_sql);
}
?>	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<title>Blog | just for The health of it!</title>
	<meta name="description" content="" />
	<link rel="stylesheet" type="text/css" href="stylesheets/limon.css" />
    <link rel="shortcut icon" href="favicon.ico" />
	<script type="text/javascript" src="javascripts/jquery-1.6.2.js"></script>
    <script src="javascripts/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#news").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Should be a valid Email id"
                });
            });
            /* ]]> */
    </script>
	<script type="text/javascript" src="javascripts/jquery-1.6.2.js"></script>
    <script src="javascripts/jquery.validate.js" type="text/javascript"></script>
    <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#news").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Should be a valid Email id"
                });
            });
            /* ]]> */
    </script>
    <script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#name").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter your name field"
                });
                jQuery("#email").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter email field"
                });
                jQuery("#email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Should be a valid Email id"
                });
                jQuery("#comment").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter Comment field"
                });
            });
            /* ]]> */
    </script>
	<script type="text/javascript" src="javascripts/jquery-ui-1.8.14.js"></script>
	<script type="text/javascript" src="javascripts/jquery.nivo.slider.js"></script>
	<script type="text/javascript" src="javascripts/global.js"></script>
	<script type="text/javascript" src="javascripts/demo.js"></script>
    
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-34503062-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
</script>
    
</head>
<body>
	
	
	
	<!-- Start Page Container -->
	<div id="container_wrap">
		
		<!-- Start Header -->
						<?php include('includes/header.php');?>

		<!-- End Header -->
		
		
		<!-- Start Page Content -->
		<div id="our_story" class="main_content">
			
			<div class="page_heading">
				<h1>Blog</h1>
			</div>

			<div class="small_left_column">
<?php for($i=0;$i<count($user_res);$i++) { ?>
				<div class="post">
					<div class="date"><?php echo $user_res[$i]['blogdate'] ?></div>
					<div class="post_details">
						<h1><a href="post.php?id=<?php echo $user_res[$i]['id'] ?>"><?php echo $user_res[$i]['title'] ?></a></h1>
                        <div style="float:left; width:100%; margin-top:15px;">
                        <div style="float:left; width:120px; "><img  class="bimg" src="cpanel/upload/news/thumb/<?php echo $user_res[$i]['image'] ?>" /></div>
						<div class="content">
							
							<?php if(isset($_REQUEST['bid'])) { echo $user_res[$i]['description']; } else { echo substr($user_res[$i]['description'],0,150); } ?>
							
						</div>
                        </div>
                        <?php if(!isset($_REQUEST['bid'])) {?>
						<div style="float:left; width:100px; margin-top:10px; margin-bottom:10px;"><a href="post.php?id=<?php echo $user_res[$i]['id'] ?>" class="button">Read Full Story</a></div>						
                        <?php } ?>
					</div>
				</div>
                        <?php if(isset($_REQUEST['bid'])) {?>
                
                <div style="float:left; width:100%;">
                    <div id="comments">
				
					<ol>
                    <?php 
$sqlcpont1="SELECT count(id) AS `countno` FROM `comment` where blogid='".$_REQUEST['bid']."'";
$count1 = $obj_db->select($sqlcpont1);
$comment="SELECT *,DATE_FORMAT(crdate,'%M %e %Y') as blogdate FROM `comment` where blogid='".$_REQUEST['bid']."' order by id desc LIMIT $s1,$s2";
$sql_comment = $obj_db->select($comment);
					for($k=0;$k<count($sql_comment);$k++) {
					?>
						<li>
							<div class="comment">
								<h5><?php echo $sql_comment[$k]['name'];?></h5>
								<span class="date"><?php echo $sql_comment[$k]['blogdate'];?></span>
								<p><?php echo $sql_comment[$k]['comment'];?></p>
							</div>
						</li>
                    <?php 
					}
					?>
<?php if(isset($_REQUEST['bid'])) { ?>
                    <div class="paging">
                     <?php doPages($recordperpage, "post.php?id=".$_REQUEST['bid']."&", "", $count1[0]['countno']); ?>

</div>
</div>
<!--<div style="float:right;"><a style="color:#676767; font-weight:bold; font-size:16px;" href="blog.php">Back</a></div>--><?php } ?>
                        
                	<h3>Leave a Comment</h3>
                    <p>Required fields are marked <span style="color:#f00;">*</span></p>
                    
						<li class="comment_form" >
							<div class="comment" style="min-height:450px;">
								<form action="comment.php" method="post">
									<div class="row">
										<p><label>Your Name <span style="color:#f00;">*</span></label><input type="text" class="text_field" name="name" id="name" /></p>
										<p><label>Your Email <span style="color:#f00;">*</span></label><input type="text" class="text_field" name="email" id="email"/></p>
										<p><label>Your Website</label><input type="text" class="text_field" name="website" id="website" /></p>	
										<p><label>Your Comment <span style="color:#f00;">*</span></label><textarea name="comment" id="comment" class="text_field" rows="10" cols="10"></textarea></p>
									</div>
									<input type="hidden" class="button" name="bid" value="<?php echo $_REQUEST['bid'];?>" />
									<input type="submit" class="button" name="submit" value="Add Comment" />
								</form>
							</div>
						</li>
					</ol>
					
				</div>
                </div>
<?php } ?>

<?php } ?>
<?php if(!isset($_REQUEST['bid'])) { ?>
                    <div class="paging">
                     <?php doPages($recordperpage, "blog.php?", "", $count[0]['countno']); ?>

</div>
</div>
<?php  } else {?><!--<div style="float:right;"><a style="color:#676767; font-weight:bold; font-size:16px;" href="blog.php">Back</a></div>--><?php } ?>
			</div>
			
						<div id="sidebar" class="large_right_column">
        		<?php include("includes/facts.php");?>
           		<?php if(!isset($_REQUEST['bid'])) { ?>
				<?php include("includes/fitness.php");?>
        		<?php include("includes/review.php");?>
				<?php } ?>

			</div>
            

						
		</div>
		<!-- End Page Content -->

		<!-- Start Footer -->
		        		<?php include("includes/footer.php");?>

		<!-- End Footer -->

	<!-- Start Twitter Integration -->
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$("#twitter_stream").tweet({
	            username: "envato",
	            count: 3,
				template: "<em class='arrow'></em>{text}{time}",
	            loading_text: "loading tweets..."
	        });
		});
	</script>
	<!-- End Twitter Integration -->
	
	</div>
</body>			
</html>