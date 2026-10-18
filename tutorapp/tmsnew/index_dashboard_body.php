<?php
/** Tutor dashboard main content — included from index.php */
$tutorNameEsc = htmlspecialchars($tutorName, ENT_QUOTES, 'UTF-8');
?>
            <section class="tms-hero">
              <!-- Careers Hub branding hidden for now
              <p class="tms-hero__eyebrow">Right2Thrive · Careers Hub</p>
              -->
              <h1 class="tms-hero__title">Welcome back, <?php echo $tutorNameEsc; ?></h1>
              <p class="tms-hero__sub">Manage learner plans, wellbeing tools, and shared files from one place. Use the hubs below for day-to-day coaching tasks.</p>
              <a class="tms-featured me-2" href="career_progress.php"><i class="bi bi-graph-up-arrow"></i> Career Progress Monitor</a>
              <a class="tms-featured" href="career_chat.php"><i class="bi bi-chat-dots"></i> Career coach chat</a>
            </section>

            <div class="tms-stat-row">
              <div class="tms-stat">
                <span class="tms-stat__icon tms-stat__icon--indigo"><i class="bi bi-people"></i></span>
                <div class="tms-stat__label">Assigned learners</div>
                <div class="tms-stat__value"><?php echo (int) $learnerCount; ?></div>
              </div>
              <div class="tms-stat">
                <span class="tms-stat__icon tms-stat__icon--teal"><i class="bi bi-folder2-open"></i></span>
                <div class="tms-stat__label">Uploaded files</div>
                <div class="tms-stat__value"><?php echo (int) $fileCount; ?></div>
              </div>
              <div class="tms-stat">
                <span class="tms-stat__icon tms-stat__icon--amber"><i class="bi bi-heart-pulse"></i></span>
                <div class="tms-stat__label">Wellbeing tools</div>
                <div class="tms-stat__value">6</div>
              </div>
            </div>

            <div class="row g-4 mb-4">
              <div class="col-lg-6">
                <div class="card tms-hub-card">
                  <div class="card-header">
                    <h2><span class="hub-icon" style="background:#eef2ff;color:#4f46e5;"><i class="bi bi-briefcase"></i></span> Career development</h2>
                  </div>
                  <div class="card-body">
                    <div class="tms-link-grid">
                      <a class="tms-link-item" href="career_progress.php">
                        <span class="tms-link-item__icon"><i class="bi bi-graph-up-arrow"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Career Progress Monitor</span><span class="tms-link-item__desc">Mentor workspace &amp; learner plans</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="career_chat.php">
                        <span class="tms-link-item__icon"><i class="bi bi-chat-dots"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Career coach chat</span><span class="tms-link-item__desc">Message your assigned learners</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="../tms/AssignPlan.php">
                        <span class="tms-link-item__icon"><i class="bi bi-journal-check"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Assign learning plan</span><span class="tms-link-item__desc">Set structured goals for a learner</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="../tms/StudentLogBook.php" target="_blank" rel="noopener">
                        <span class="tms-link-item__icon"><i class="bi bi-book"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Add learner log book</span><span class="tms-link-item__desc">Record session activity</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="../tms/StudentInformation.php">
                        <span class="tms-link-item__icon"><i class="bi bi-person-lines-fill"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Add learner information</span><span class="tms-link-item__desc">Update learner profile details</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="../tms/GetStudentPlan.php">
                        <span class="tms-link-item__icon"><i class="bi bi-download"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Download learning plan</span><span class="tms-link-item__desc">Export plan as PDF</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="../tms/UploadReview.php">
                        <span class="tms-link-item__icon"><i class="bi bi-cloud-upload"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Upload learning review</span><span class="tms-link-item__desc">Submit review documents</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item" href="category.php">
                        <span class="tms-link-item__icon"><i class="bi bi-tags"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Categories</span><span class="tms-link-item__desc">Manage course categories</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card tms-hub-card">
                  <div class="card-header">
                    <h2><span class="hub-icon" style="background:#ecfdf5;color:#0d9488;"><i class="bi bi-heart-pulse"></i></span> Wellbeing hub</h2>
                  </div>
                  <div class="card-body">
                    <div class="tms-link-grid">
                      <a class="tms-link-item tms-link-item--teal" href="UpFiles_mh.php">
                        <span class="tms-link-item__icon"><i class="bi bi-file-earmark-medical"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Upload care plan</span><span class="tms-link-item__desc">Mental health care plans</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item tms-link-item--teal" href="gad7.php" target="_blank" rel="noopener">
                        <span class="tms-link-item__icon"><i class="bi bi-clipboard-data"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">GAD-7</span><span class="tms-link-item__desc">Anxiety screening</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item tms-link-item--teal" href="phq9.php">
                        <span class="tms-link-item__icon"><i class="bi bi-clipboard2-pulse"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">PHQ-9</span><span class="tms-link-item__desc">Depression screening</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item tms-link-item--teal" href="sendmail.php">
                        <span class="tms-link-item__icon"><i class="bi bi-envelope"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Send mail</span><span class="tms-link-item__desc">Message learners</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item tms-link-item--teal" href="bookchattime.php">
                        <span class="tms-link-item__icon"><i class="bi bi-calendar-event"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Book chat time</span><span class="tms-link-item__desc">Schedule a session</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                      <a class="tms-link-item tms-link-item--teal" href="chatnow.php">
                        <span class="tms-link-item__icon"><i class="bi bi-chat-dots"></i></span>
                        <span class="tms-link-item__text"><span class="tms-link-item__title">Chat now</span><span class="tms-link-item__desc">Open live chat</span></span>
                        <i class="bi bi-chevron-right tms-link-item__arrow"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="card tms-hub-card tms-files-card">
                  <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h2><span class="hub-icon" style="background:#fffbeb;color:#b45309;"><i class="bi bi-paperclip"></i></span> Your uploaded files</h2>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table tms-files-table mb-0">
                        <thead>
                          <tr>
                            <th>File</th>
                            <th>Learner(s)</th>
                            <th>Uploaded</th>
                            <th class="text-end">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sqlfiles = 'SELECT vFilePath, vUploadDate, iFileId, iUserId FROM cpo_uploadfilestutor WHERE iTutorId = ' . (int) $_SESSION['user_id'] . ' ORDER BY vUploadDate DESC';
                        $rsfiles = runquery($sqlfiles);
                        $num = $rsfiles ? mysqli_num_rows($rsfiles) : 0;
                        if ($num === 0) {
                            echo '<tr><td colspan="4"><div class="tms-empty"><i class="bi bi-inbox"></i> No files uploaded yet.</div></td></tr>';
                        } else {
                            while ($rsdata = mysqli_fetch_array($rsfiles)) {
                                $filePath = (string) $rsdata['vFilePath'];
                                $filePathEsc = htmlspecialchars($filePath, ENT_QUOTES, 'UTF-8');
                                $fileName = htmlspecialchars(basename($filePath), ENT_QUOTES, 'UTF-8');
                                $userName = htmlspecialchars(getlearnernames($rsdata['iUserId']), ENT_QUOTES, 'UTF-8');
                                $uploadDate = htmlspecialchars(gdate($rsdata['vUploadDate']), ENT_QUOTES, 'UTF-8');
                                $fileId = (int) $rsdata['iFileId'];
                                echo '<tr id="file-row-' . $fileId . '">';
                                echo '<td><a href="' . $filePathEsc . '" target="_blank" rel="noopener"><i class="bi bi-file-earmark me-1"></i>' . $fileName . '</a></td>';
                                echo '<td>' . ($userName !== '' ? $userName : '—') . '</td>';
                                echo '<td>' . $uploadDate . '</td>';
                                echo '<td class="text-end"><button type="button" class="btn btn-outline-danger btn-sm deleteFileBtn" data-id="' . $fileId . '" title="Delete"><i class="bi bi-trash"></i></button></td>';
                                echo '</tr>';
                            }
                        }
                        ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
