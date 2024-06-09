<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>A Little Daisy - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="public/css/style.css" rel="stylesheet">
    <link href="public/css/index.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="public/img/icon.png">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div id="wrapper">
        <?php
        include("partials/sidebar.html");
        ?>

        <div id="content-wrapper" class="d-flex flex-column">
            <div class="content">
                <?php
                include("partials/topbar.html");
                ?>
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1>Tổng quan</h1>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Doanh thu (trong ngày)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total_earning_today) ?> VND</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Chi phí (trong ngày)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total_expense_today) ?> VND</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-danger shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">KPI</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_earning_month / 1000000 ?>tr / 500tr VND</div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-12">
                                                    <div class="progress progress-sm mt-2">
                                                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo $total_earning_month / 1000000 / 5 ?>%" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Doanh thu (trong tháng)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format($total_earning_month) ?> VND</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-xl-8">
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Doanh thu (10 ngày gần nhất)</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4">
                            <div class="card shadow">
                                <!-- Card Header - Dropdown -->
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="myPieChart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Hàng tiêu dùng
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Điện tử
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Thời trang
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Thực phẩm
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-warning"></i> Gia dụng
                                        </span>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row  mb-4">
                        <div class="col-lg-6">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Sắp hết hàng ⛔</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (mysqli_num_rows($five_min) > 0) {
                                        while ($row = mysqli_fetch_assoc($five_min)) {
                                            $percentage = ($row['count'] / 1000) * 100; // Tính phần trăm
                                            echo "<h4 class='small font-weight-bold'>{$row['name']}<span class='float-right'>{$row['count']} / 1000</span></h4>
                                                <div class='progress mb-4'>
                                                    <div class='progress-bar bg-warning' role='progressbar' style='width: {$percentage}%' aria-valuemin='0' aria-valuemax='100'></div>
                                                </div>";
                                        }
                                    } else {
                                        echo '<h4 class="small font-weight-bold">Không có dữ liệu</h4>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card shadow">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Sản phẩm bán chạy 🔥</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    if (mysqli_num_rows($five_max) > 0) {
                                        while ($row = mysqli_fetch_assoc($five_max)) {
                                            $percentage = ($row['count'] / 1000) * 100; // Tính phần trăm
                                            echo "<h4 class='small font-weight-bold'>{$row['name']}<span class='float-right'>Đã bán: {$row['count']} / 1000</span></h4>
                                                <div class='progress mb-4'>
                                                    <div class='progress-bar bg-danger' role='progressbar' style='width: {$percentage}%' aria-valuemin='0' aria-valuemax='100'></div>
                                                </div>";
                                        }
                                    } else {
                                        echo '<h4 class="small font-weight-bold">Không có dữ liệu</h4>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy; A Little Daisy</span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/41cf1aa121.js" crossorigin="anonymous"></script>
    <script src="public/js/Chart.js"></script>
    <?php
    $total_earning_week_array = [];
    while ($row = mysqli_fetch_assoc($total_earning_week)) {
        $total_earning_week_array[] = $row;
    }

    $total_earning_week_json = json_encode($total_earning_week_array);
    ?>

    <?php
    $category_id_count_array = [];
    while ($row = mysqli_fetch_assoc($category_id_count)) {
        $category_id_count_array[] = $row;
    }

    $category_id_count_json = json_encode($category_id_count_array);
    ?>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart
        var ctx = document.getElementById("myAreaChart");
        labels = [];
        data = [];
        var total_earning_week_data = <?php echo $total_earning_week_json ?>;
        total_earning_week_data.forEach(i => {
            labels.push(i.order_day.split('-')[2] + ' / ' + i.order_day.split('-')[1]);
            data.push((i.total_earning_day / 1000000).toFixed(2));
        })

        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: "Doanh thu",
                    lineTension: 0.1,
                    backgroundColor: "rgba(78, 115, 223, 0.2)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: data,
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return number_format(value) + 'tr VND';
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ": ~" + number_format(tooltipItem.yLabel, 2) + 'tr VND';
                        }
                    }
                }
            }
        });
    </script>

    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        labels = [];
        data = [];
        var category_id_count_data = <?php echo $category_id_count_json ?>;
        console.log(category_id_count_data);
        category_id_count_data.forEach(i => {
            labels.push(i.category_name);
            data.push(i.product_count);
        })

        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#e74a3b', '#f6c23e'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#c52616', '#d6a417'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",

                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 80,
            },
        });
    </script>
</body>

</html>