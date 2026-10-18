<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php include "dbConnection.php"; ?>
    <title>Job Vacancies<?php echo sitename; ?></title>
	<?php include "metadata.php"; ?>
</head>
<body>
    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <?php include "header.php"; ?>

            <div class="page-heading">
                <h4 class="mb-1">Job vacancies</h4>
                <p class="hub-page-sub mb-0">Published roles from the Collective Careers Hub. Check back regularly for new opportunities.</p>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <div id="job-vacancies">
                                    <?php
                                    $result = runquery1("SELECT iJobId, vJobTitle, tJobDesc, dDate FROM cpo_jobmaster WHERE COALESCE(iStatus,1)=1 ORDER BY iJobId DESC");
                                    $num = $result ? mysqli_num_rows($result) : 0;
                                    if ($num > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $title = htmlspecialchars((string) $row['vJobTitle']);
                                            $desc = nl2br(htmlspecialchars((string) $row['tJobDesc']));
                                            $posted = !empty($row['dDate']) ? htmlspecialchars((string) $row['dDate']) : '';
                                            echo '<article class="alert alert-light border mb-3">';
                                            echo '<h5 class="mb-2">' . $title . '</h5>';
                                            if ($posted !== '') {
                                                echo '<p class="small text-muted mb-2"><i class="bi bi-calendar3"></i> Posted: ' . $posted . '</p>';
                                            }
                                            echo '<div class="mb-0">' . $desc . '</div>';
                                            echo '</article>';
                                        }
                                    } else {
                                        echo '<p class="text-muted mb-0">No job vacancies published at the moment. New roles will appear here when they are added by admin.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
			<?php include "footer.php"; ?>
        </div>
    </div>
</body>
</html>
