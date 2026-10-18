<?php
    session_cache_expire(time()-1);
    session_cache_limiter('nocache');
    @ob_start();	
    include "dbConnection.php";
    if (!isset($_SESSION['user_id']))
    { 
        header("Location:../user_login.php");
    }
    else
    {
        $user_id = $_SESSION['user_id'];
    }
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $sitename;?> | Equal Opportunity</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="FAQ | AdminLTE 4" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard"
    />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
    <style>
      [data-astro-image] {
        width: 100%;
        height: auto;
        object-fit: var(--fit);
        object-position: var(--pos);
        aspect-ratio: var(--w) / var(--h);
      }
      [data-astro-image='responsive'] {
        max-width: calc(var(--w) * 1px);
        max-height: calc(var(--h) * 1px);
      }
      [data-astro-image='fixed'] {
        width: calc(var(--w) * 1px);
        height: calc(var(--h) * 1px);
      }
    </style>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <?php include "topbar.php";?>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <?php require "sidebar.php";?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Equal Opportunity Policy</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Equal Opportunity</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Introduction</h2>
                    <hr>
                    <p>21K Creative Media aims to promote equality of opportunity and is committed to relations amongst all people with whom it is involved. It is the policy of the 21K Creative Media that there shall be no discrimination in staff recruitment, employment conditions, promotions and delivery of training on the grounds of gender, marital status, colour, race, ethnic or national origins, disability, religion, sexual orientation or age.</p>
                    <h3>21K Creative Media aims to :</h3>
                    <hr>
                    <ul>
                        <li>Identify and stop discrimination whenever it occurs and in particular, discrimination against the groups within the scope of this statement</li>
                        <li>Ensure our services and published materials are consistent with our Equal Opportunities policy, and avoid the use of offensive and discriminating language in both formal and informal communications.</li>
                    </ul>
                    <h3>To achieve our aims we will</h3>
                    <hr>
                    <ul>
                        <li>Promote Equal Opportunities throughout the organisation</li>
                        <li>Provide annual training and/or guidance to all employees to ensure 21K Creative Media commitment to Equal Opportunities is known and understood</li>
                        <li>Collect, evaluate and act upon the anonymous opinions of service users</li>
                        <li>Review all our policies and procedures annually to ensure equality of opportunity, responsiveness, sensitivity and accessibility</li>
                        <li>Ensure our disciplinary and grievance procedures contain provision to enforce this policy &</li>
                        <li>Include Equal Opportunities as a mandatory point/agenda item at the 21K Creative Media Quality Review Group meetings</li>
                    </ul>
                    <p class="d-flex justify-content-center">All members of 21K Creative Media will be expected to respect and act in accordance with this policy</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Recruitment</h2>
                    <hr>
                    <p>The 21K Creative Media will recruit and select by processes that reflect good personnel practice and avoid discrimination against any group of people. Vacancies and opportunities will be widely publicised to reach all sectors of society.</p>
                    <h3>Positive Action</h3>
                    <hr>
                    <p>Under the Sex Discrimination Act (1975) and Race Relations Act (1976) we can: (Both Acts are available on request)</p>
                    <ul>
                        <li>Provide training and encouragement for people of a particular race or gender, who are under-represented in certain occupations or pay scales</li>
                        <li>Address any special educational, training or welfare needs for a specific racial group.</li>
                        <li>Provide training and encouragement for people returning to work following domestic or family responsibilities</li>
                    </ul>
                    <p>Positive Action or encouragement might include targeted advertising and recruitment literature, or reserving places for particular groups on training courses.</p>
                    <p>Specific steps will be taken to encourage applicants from particular groups where these are under-represented. It is the 21K Creative Media s’ policy of the that applicants are employed and trained on the basis of ability and the requirements of the job/training scheme.</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Monitoring</h2>
                    <hr>
                    <p>21K Creative Media will collect and maintain records for analysis and review, and to show what progress is being made in the implementation of this policy. The information will include:</p>
                    <ul>
                        <li>Recruitment and Selection data</li>
                        <li>Composition of our trainees and employees</li>
                        <li>Achievement of qualifications and job outcomes</li>
                        <li>Take-up of work experience placements</li>
                        <li>Any other monitoring as determined by the Equal Opportunities Quality Review Group</li>
                    </ul>
                    <p>The Chief Executive will regularly monitor the effectiveness of Equal Opportunity in all its practices. The senior management team will take any appropriate action required to ensure that the 21K Creative Media fulfils the requirements of all relevant legislations. Monitoring procedures will cover the ethnicities, gender and disability of applicants and recruits, in relation to all members of 21K Creative Media.</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Induction</h2>
                    <hr>
                    <p>Staff and trainees will receive a comprehensive induction programme that clearly explains their rights and responsibilities. All staff will receive a copy of the Staff Handbook and all trainees’ a Training Handbook, both of which contains details of the Equal Opportunities Policy.</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Training And Assessment</h2>
                    <hr>
                    <p>21K Creative Media will promote access to training and assessment for members, and will do all that is possible to ensure that those who have the potential to achieve the standards are given access to fair assessments. Where possible, candidates with particular training and assessment requirements will be given alternative means to provide evidence of competence. Care will be taken to ensure that proposed assessment methods are of equal quality and rigor to those of mainstream candidates.</p>
                    <p>Candidates will be given appropriate support in their development, to help them meet the required standard such as:</p>
                    <ul>
                        <li>Help with communication, literacy and numeracy</li>
                        <li>Adapted equipment and physical environment</li>
                        <li>Special information technology equipment</li>
                        <li>Confidence building</li>
                        <li>Help with finding work or accessing other training opportunities</li>
                        <li>Information, Advice and Guidance – before, during and after programme</li>
                    </ul>
                    <p>The 21K Creative Media ensures that all our awarding bodies; Equal Opportunities policies relating to training and assessment, are adhered to at all times.</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Staff Development</h2>
                    <hr>
                    <p>An annual training and development budget will be agreed and training provided as part of a general programme to improve skills throughout the workforce, In addition, the 21K Creative Media has a training appraisal for all staff are encouraged them to use Learndirect programmes for personal and professional development. Attendance during working hours will be negotiated with line managers. Promotion/advancement will be based on ability and opportunities given to all staff within the organisation.</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Complaints Relating to Abuse and Discrimination</h2>
                    <hr>
                    <p>All complaints of discrimination – direct or indirect, abuse, victimisation or harassment will be investigated without delay by a senior manger. Such activities, if established against a 21K Creative Media member, will be dealt with via the grievance procedure, as gross misconduct under the disciplinary procedures.</p>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Marketing and Corporate Image</h2>
                    <hr>
                    <p>All staff, trainees, applicants and new recruits will receive information on the Equal Opportunities policy. Staff and trainee induction will cover equality of opportunity.</p>
                    <h3>21K Creative Media seek to</h3>
                    <hr>
                    <ul>
                    <li>Maintain representative numbers of staff from local communities on its workforce at all levels</li>
                    <li>Make its marketing strategies relevant to the different local communities</li>
                    <li>Include an appropriate Equal Opportunities statement in all advertising or promotional material</li>
                    <li>Encourage minority groups to participate</li>
                    <li>Use local and national minority press and local networks to ensure that information is widely available</li>
                    </ul>
                </div>
            </div>
            <p></p>
            <div class="card card-primary">
                <div class="card-body">
                    <h2>Organisational Responsibility</h2>
                    <hr>
                    <p>The Chief Executive and Senior Management Team will review the 21K Creative Media’s Equal Opportunities Policy to ensure its continued relevance and will recommend and promote equal opportunities initiatives. Line Mangers are responsible for implementing and promoting the policy within their centres/branches. Managers must observe and promote the company’s Equal Opportunities Policy at all times. All staff and trainees are expected to observe the Equal Opportunities Policy and implement it within their spheres of activity.</p>
                    <h3>Key Terms</h3>
                    <hr>
                    <ul>
                      <li>Equal opportunities – treating people the same, regardless of differences that are not relevant, but considering differences that are.</li>
                      <li>Prejudice - unfavourable opinion or feelings formed beforehand based on limited knowledge, thought or reason.</li>
                      <li>Discrimination - less favourable treatment.</li>
                      <li>Direct Discrimination – treating someone less favourably than another.</li>
                      <li>Indirect Discrimination – where the conditions or requirements for job/ training are unnecessary, unfair or unreasonable, to the exclusion of individuals or groups.</li>
                      <li>Harassment – unwelcome or inappropriate behaviour that undermines, demeans, offends, insults or injures.</li>
                      <li>Victimisation – Persistent Harassment</li>
                      <li>Grievance – a feeling of resentment or injustice at having been unfairly treated</li>
                      <li>Positive Action - steps to stop discrimination or imbalance by actively encouraging those who are under represented in an organisation</li>
                      <li>Members of 21K Creative Media- staff, trainees, candidates, clients, trustees, partners and guests</li>
                    </ul>
                </div>
            </div>
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content-->
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <?php include "footer.php";?>
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>