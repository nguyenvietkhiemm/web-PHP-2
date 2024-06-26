<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Bills</title>

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
                        <h1>Quản lí chi phí</h1>
                    </div>
                    <div class="row mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#add-bill-modal'>
                                <i class="fa-solid fa-plus fa-lg"></i> Thêm hóa đơn
                            </button>
                            <input type="text" id="search-input" class="form-control search-input" placeholder="Tìm kiếm sản phẩm..." style='width: 320px'>
                        </div>
                    </div>

                    <table class="table table-striped mt-4">
                        <thead>
                            <tr class="align-middle">
                                <th scope="col">ID</th>
                                <th scope="col">ID User</th>
                                <th scope="col">Người nhận hàng</th>
                                <th scope="col">Ghi chú</th>
                                <th scope="col">Ngày order</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $bills = [];
                            if (mysqli_num_rows($bills_data) > 0) {
                                while ($row = mysqli_fetch_assoc($bills_data)) {
                                    $bills[] = $row;
                                }
                                $bills = array_reverse($bills);

                                foreach ($bills as $row) {
                                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['user_id']}</td>
                            <td>{$row['fullname']}</td>
                            <td>{$row['note']}</td>
                            <td>{$row['order_date']}</td>
                            <td><button type='button' class='btn btn-primary'data-bs-toggle='modal' data-bs-target='#detail-modal' data-id='{$row['id']}'>Detail</button></td>
                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5' class='text-center'>Không có dữ liệu</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <?php
            $bills_array = [];
            mysqli_data_seek($bills_data, 0);
            while ($row = mysqli_fetch_assoc($bills_data)) {
                $bills_array[] = $row;
            }

            $bills_json = json_encode($bills_array);
            ?>

            <?php
            $orders_detail_array = [];
            while ($row = mysqli_fetch_assoc($orders_detail_data)) {
                $orders_detail_array[] = $row;
            }

            $orders_detail_json = json_encode($orders_detail_array);
            ?>

            <?php
            $products_array = [];
            mysqli_data_seek($products_data, 0);
            while ($row = mysqli_fetch_assoc($products_data)) {
                $products_array[] = $row;
            }

            $products_data_json = json_encode($products_array);
            ?>

            <?php
            include('./resources/views/partials/detail.php');
            include('./resources/views/partials/add_bill.php');
            ?>

            <footer class="footer mt-auto py-3 bg-light">
                <div class="container text-center">
                    <span class="text-muted">Copyright &copy; A Little Daisy</span>
                </div>
            </footer>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/41cf1aa121.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tablesort/5.2.1/tablesort.min.js"></script>
</body>

</html>