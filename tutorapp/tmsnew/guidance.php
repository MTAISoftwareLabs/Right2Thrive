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
    <title><?php echo $sitename;?> | Guidance Policy</title>
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
              <div class="col-sm-6"><h3 class="mb-0">Client Guidance Policy</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Client Guidance Policy</li>
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
            <div class="card card-outline card-warning">
              <div class="card-header">
                <h3 class="card-title">CLIENT CONTACT, ADVICE & GUIDANCE POLICY</h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h2>Initial Client Contact</h2>
                <ul>
                  <li>Welcome the client in a polite and helpful manner whether online or in contact.</li>
                  <li>Ask how you can help them</li>
                  <li>Listen to their response and identify their needs. Ask further questions to clarify their needs if necessary.</li>
                  <li>Provide information, in an appropriate format about the services available. Highlight the services most relevant to their needs. Explain any cost, restrictions, waiting times ect. ating with tutors</li>
                  <li>Assist the client to select the services that would be most helpful to them.</li>
                  <li>Agree with the client how they will access the selected services and make the necessary arrangements to facilitate this. If the client is required to complete any documentation prior to a guidance interview ensure this is done. If the client is required to bring copies of CV’s ect ensure the client is aware of this.</li>
                  <li>If the client has attended for pre-booked appointment and it has been delayed or cancelled, explain the reason for this to the client. If the appointment has been cancelled offer another appointment, at a date and time convenient to the client.</li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card card-outline card-warning mt-5">
              <div class="card-header">
                <h3 class="card-title">If appropriate, explain your relationship to the Outreach site</h3>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <h2>Advice Contact</h2>
                <ul>
                  <li>Explain our policy on confidentially, client records and why certain information is required.</li>
                  <li>Ask the client to explain their situation and outline why they have come to see you and what they hope to gain from the contact.</li>
                  <li>Assist the client to explore their situation further and identify their needs by using open questions, prompts, active listening skills and positive body language.</li>
                  <li>Listen and respond to the client’s questions promptly .</li>
                  <li>Be aware of the client’s language and aim to respond in an appropriate language level and style.</li>
                  <li>Assist the client to identify and explain what is most important to them in regard to their future</li>
                  <li>Present information to the client in an appropriate way- verbal or written, books, leaflets, ICT.</li>
                  <li>Check the client understands the information presented and that it is sufficient. If necessary and available, use alternative sources of information.</li>
                  <li>If information is not available, agree to undertake resource on behalf of the client or signpost the client to other information resources.</li>
                  <li>If appropriate, provide the client with a copy of written information. If the information is Reference Only either:<br>
                  :: Make a photocopy<br>
                  :: Arrange to forward a copy. In this case, you must comply with our policy, which is to post information within 3 working days of the request.</li>
                  <li>If appropriate, sign post the client to other information contacts and/or introduce them to other resources in the information Point.</li>
                  <li>Discuss the information provided with the client. Relate it to the client’s needs.</li>
                  <li>Assist the client to identify the implications of the information on their decision making and next steps.</li>
                  <li>Identify if further specialist support is required. If so, research and select appropriate referral agencies, discuss these with the client, make the referral and complete and provide the client with a Referral Form.</li>
                  <li>Ask the client if he/she requires any further assistance or services. If yes, either provide those services or make the necessary arrangements for the client to access those services, or make a referral to an appropriate agency-if you make an appointment ensure it is at a time/venue convenient to the client.</li>
                  <li>Explain to the client how they may contact the service in the future</li>
                  <li>Explain the Client Information Sheet to the client and ask him/her to complete., sign and date it. Use the Notes section to record a summary of the key advice or information points provided.</li>
                  <li>Explain our aim to gather feedback form users of our services. Invite the client to complete a client feedback form and explain that feedback can be given anonymously. If the client agrees, give them an Advice Client Feedback Form and a SAE. Ask them to complete the form, place it in the envelope and either post it back or leave it in the box provided.</li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card  mt-5">
              
                
                <!-- /.card-tools -->
              <!-- /.card-header -->
              <div class="card-body">
              <h2>Guidance Contact</h2>
                <ul>
                  <li>Explain our policy on confidentially, client records and why certain information is required.</li>
                  <li>Ask the client to explain their situation and outline why they have come to se you and what they hope to gain from the contact.</li>
                  <li>Explain how the interview may be structured and what kind of things may be discussed. Agreed a contract/agenda for the interview with the client, based on their needs</li>
                  <li>Assist the client to explore their situation further and identify their needs and interest, in more depth, by using open questions, prompts, active listening skills and positive body language.</li>
                  <li>Listen and respond to the client’s questions promptly.</li>
                  <li>Be aware of the client’s language and aim to respond in an appropriate language level and style.</li>
                  <li>Assist the client to identify and explain what is most important to them in regard to their future.</li>
                  <li>Assist the client to explore a range of options and consider alternatives by presenting information to the client in an appropriate way-verbal or written, books leaflets, ICT.</li>
                  <li>Check the client understands the information presented and that it is sufficient. If necessary and available, use alternative sources of information.</li>
                  <li>If information is not available, agree to undertake research on behalf of the client or signpost the client to other information resources</li>
                  <li>If appropriate, provide the client with a copy of written information. If the information is Reference Only either:<br>
                              :: Make a photocopy<br>
                              :: Arrange to forward a copy. In this case, you must comply with our policy which is to post information within 3 working days of the request.</li>
                  <li>If appropriate, signpost the client to other information contacts and/or introduce them to other resources in the information Point.</li>
                  <li>Discuss the information provided with the client. Related it to the client’s needs</li>
                  <li>Assist the client to identify the implications of the information on their decision making and next steps.</li>
                  <li>Assist the client to make decisions, identify the next action they need to take and how to they may do this.</li>
                  <li>Identify if further specialist support is required. If so research and select appropriate referral agencies, discuss these with the client, make the referral and complete and provide the client with a Referral Form.</li>
                  <li>Explain the client how they may contact the service in the future</li>
                  <li>Explain the Client Information Sheet to the client and ask him/her to complete, sign and date it. Use the Notes section to record a summary of key advice or information points provided.</li>
                  <li>Provide the client with a summary of the decisions discussed and action steps identified and agreed.</li>
                  <li>Explain our aim to gather feedback from users of our services. Invite the client to complete a client feedback form and explain that the feedback can be given anonymously. If the client agrees, give them an Advice Client Feedback Form and a SAE. Ask them to complete the form, place it in the envelope and either post it back or leave it in the box provided.</li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <div class="card  mt-5">
              <!-- /.card-header -->
              <div class="card-body">
              <h2>Staff Competence</h2>
              <p>Explain our aim to gather feedback form users of our services. Invite the client to complete a client feedback form and explain that feedback can be given anonymously. If the client agrees, give them an Advice Client Feedback Form and a SAE. Ask them to complete the form, place it in the envelope and either post it back or leave it in the box provided.</p>
              </div>
              <!-- /.card-body -->
            </div>
            
            <div class="card card-primary mt-5">
                  <!-- /.card-header -->
                  <div class="card-body">Career Paths Online Team will review this policy on an annual basis<br>
                  Issue No.1<br>
                  Dated: August 2005<br>
                  Revision Date: July 2006</div>
                  <!-- /.card-body -->
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