<?php
session_start();

if (!isset($_SESSION['username']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'teacher')) {
    header('Location: login.php'); 
    exit();
}


require_once '../../controllers/userC.php';
require_once '../../controllers/formationC.php';

$usersController = new UserController();
$formationsController = new FormationController();
$result = $usersController->getStatistics();
$resultTypesStats = $formationsController->getFormationTypesStatistics();

?>

<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>
      Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro
    </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link
      rel="icon"
      type="image/x-icon"
      href="assets/img/favicon/favicon.ico"
    />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link
      rel="stylesheet"
      href="assets/vendor/css/core.css"
      class="template-customizer-core-css"
    />
    <link
      rel="stylesheet"
      href="assets/vendor/css/theme-default.css"
      class="template-customizer-theme-css"
    />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link
      rel="stylesheet"
      href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"
    />

    <link
      rel="stylesheet"
      href="assets/vendor/libs/apex-charts/apex-charts.css"
    />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php require './menubar.php';  ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <?php require './navbar.php';  ?>
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">
                            Congratulations <?= $_SESSION['username']  ?> 🎉
                          </h5>
                          <p class="mb-4">
                            You have <span class="fw-bold">successfully</span> log
                            to your profile.
                          </p>

                          
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              
                <!-- Total Revenue -->
                <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card" style="height:360px !important">
                    <div class="row row-bordered g-0">
                      <div class="col-md-8">
                        <h5 class="card-header m-0 me-2 pb-5">User Registration Date</h5>
                        <div id="userRegistrationChart"></div>
                      </div>
                     
                    </div>
                  </div>
                </div>
                <!--/ Total Revenue -->
                <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                  <div class="row">
                   
                  <div class="card h-100">
                    <div
                      class="card-header d-flex align-items-center justify-content-between pb-0"
                    >
                      <div class="card-title mb-0">
                        <h5 class="m-0 me-2">Formation Type Statistics</h5>
                     
                      </div>
                     
                    </div>
                    <div class="card-body">
                      <div
                        class="d-flex justify-content-between align-items-center mb-3"
                      >
                        <div
                          class="d-flex flex-column align-items-center gap-1"
                        >
                         
                        </div>
                        <div id="formationTypeChart"></div>
                      </div>
                      <ul class="p-0 m-0">
                      <?php 
                      $bgColors = ["danger", "warning", "primary", "info", "success", "secondary", "dark"];

                      foreach ($resultTypesStats["series"] as $index => $item): 
                        $randomColor = $bgColors[array_rand($bgColors)];
                      
                      ?>
                        <li class="d-flex mb-4 pb-1">
                          <div class="avatar flex-shrink-0 me-3">
                            <span
                              class="avatar-initial rounded bg-label-<?= $randomColor ?>"
                              ></span>
                          </div>
                          <div
                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2"
                          >
                            <div class="me-2">
                              <h6 class="mb-0"><?= $resultTypesStats["labels"][$index] ?></h6>
                             
                            </div>
                            <div class="user-progress">
                              <small class="fw-semibold"><?= $resultTypesStats["series"][$index] ?></small>
                            </div>
                          </div>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                  </div>

                    <!-- </div>
    <div class="row"> -->
                    
                  </div>
                </div>
              </div>
              
            </div>
            <!-- / Content -->

           <!-- Footer -->
           <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , made with ❤️ by
                  Khalil Jeber
                </div>
                
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

   


    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>

var data = <?php echo json_encode($result); ?>;

var labels = data.map(item => item.registration_date);
var counts = data.map(item => parseInt(item.user_count));
counts.unshift(0);



const incomeChartEl = document.getElementById('userRegistrationChart'),
    incomeChartConfig = {
      series: [
        {
          data: counts
        }
      ],
      chart: {
        height: 215,
        width:760,
        parentHeightOffset: 0,
        parentWidthOffset: 0,
        toolbar: {
          show: false
        },
        type: 'area'
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
      legend: {
        show: false
      },
      markers: {
        size: 6,
        colors: 'transparent',
        strokeColors: 'transparent',
        strokeWidth: 4,
        discrete: [
          {
            fillColor: config.colors.white,
            seriesIndex: 0,
            dataPointIndex: 7,
            strokeColor: config.colors.primary,
            strokeWidth: 2,
            size: 6,
            radius: 8
          }
        ],
        hover: {
          size: 7
        }
      },
      colors: [config.colors.primary],
      fill: {
        type: 'gradient',
        gradient: {
          shade: '#eceef1',
          shadeIntensity: 0.6,
          opacityFrom: 0.5,
          opacityTo: 0.25,
          stops: [0, 95, 100]
        }
      },
      grid: {
        borderColor: '#eceef1',
        strokeDashArray: 3,
        padding: {
          top: -20,
          bottom: -8,
          left: -10,
          right: 8
        }
      },
      xaxis: {
    categories: ['','Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul' ,'Aug','Sep','Oct','Nov','Dec'],
    axisBorder: {
        show: true
    },
    axisTicks: {
        show: false
    },
    labels: {
        show: true,
        style: {
            fontSize: '13px',
            colors: '#a1acb8'
        }
    }
},
      yaxis: {
        labels: {
          show: true
        },
        min: 0,
        max: 10,
        tickAmount: 10
      }
    };

    const incomeChart = new ApexCharts(incomeChartEl, incomeChartConfig);
    incomeChart.render();
  

</script>


<script>

var dataTypes = <?php echo json_encode($resultTypesStats); ?>;

var labels = dataTypes["labels"];
var values = dataTypes["series"];




   const chartOrderStatistics = document.querySelector("#formationTypeChart"),
    orderChartConfig = {
      chart: {
        height: 165,
        width: 130,
        type: "donut",
      },
      labels: labels,
      series: values,
      colors: [
        config.colors.primary,
        config.colors.secondary,
        config.colors.info,
        config.colors.success,
      ],
      stroke: {
        width: 5,
        colors: '#fff',
      },
      dataLabels: {
        enabled: false,
        formatter: function (val, opt) {
          return parseInt(val) + "%";
        },
      },
      legend: {
        show: false,
      },
      grid: {
        padding: {
          top: 0,
          bottom: 0,
          right: 15,
        },
      },
      plotOptions: {
        pie: {
          donut: {
            size: "75%",
            labels: {
              show: true,
              value: {
                fontSize: "1.5rem",
                fontFamily: "Public Sans",
                color: '#566a7f',
                offsetY: -15,
                formatter: function (val) {
                  return parseInt(val) ;
                },
              },
              name: {
                offsetY: 20,
                fontFamily: "Public Sans",
              },
              total: {
                show: true,
                fontSize: "0.8125rem",
                color: '#a1acb8',
                label: "Total",
                formatter: function (w) {
                  return dataTypes["series"].reduce(function (a, b) {
                          return a + b;
                        }, 0);
                },
              },
            },
          },
        },
      },
    };
  if (
    typeof chartOrderStatistics !== undefined &&
    chartOrderStatistics !== null
  ) {
    const statisticsChart = new ApexCharts(
      chartOrderStatistics,
      orderChartConfig
    );
    statisticsChart.render();
  }
</script>
  </body>
</html>
