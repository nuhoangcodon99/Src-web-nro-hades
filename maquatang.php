<?php
include_once 'set.php';
include_once 'connect.php';
include('head.php');
if ($_login === null) {
    // Chưa đăng nhập, chuyển hướng đến trang khác bằng JavaScript
    echo '<script>window.location.href = "../dang-nhap";</script>';
    exit(); // Đảm bảo dừng thực thi code sau khi chuyển hướng
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Trang Chủ Chính Thức - Ngọc Rồng Light</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="/">
    <meta name="description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="keywords"
        content="Chú Bé Rồng Online,ngoc rong mobile, game ngoc rong, game 7 vien ngoc rong, game bay vien ngoc rong">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:image" content="/image/logo.png">
    <meta name="twitter:image:width" content="200">
    <meta name="twitter:image:height" content="200">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/notify/notify.js"></script>
    <link rel="icon" href="/image/icon.png?v=99">
    <link href="assets/main.css" rel="stylesheet">
</head>

    <style>
        th,
        td {
            white-space: nowrap;
            padding: 2px 4px !important;
            font-size: 11px;
        }
    </style>
    <div class="container color-forum pt-1 pb-1">
        <div class="row">
            <div class="col"> <a href="dien-dan" style="color: white">Quay lại diễn đàn</a> </div>
        </div>
    </div>
    <div class="container color-forum pt-2">
        <div class="row">
            <div class="col">
                <h6>GIFTCODE CỦA BẠN</h6>
                <p> - Mã giftcode này sử dụng ở trên website<a href="<?php echo $_domain ?>/gifcode"
                        onclick="copyLink(event)">
                        <span style="color: black;">
                            <?php echo $_domain ?>/giftcode
                        </span>
                    </a>
                </p>
                <div id="notification"></div>
                <script>
                    function copyLink(event) {
                        event.preventDefault(); // Ngăn chặn chuyển hướng khi nhấp vào liên kết

                        var link = event.currentTarget.getAttribute('href'); // Lấy đường dẫn từ liên kết
                        navigator.clipboard.writeText(link) // Sao chép đường dẫn vào clipboard
                            .then(function () {
                                // Sao chép thành công
                                document.getElementById("notification").innerText = "Bạn đã sao chép liên kết nhập giftcode!";
                            })
                            .catch(function (error) {
                                // Sao chép thất bại
                                console.error(error);
                                document.getElementById("notification").innerText = "Có lỗi xảy ra khi sao chép liên kết.";
                            });
                    }
                </script>
                <?php

                // Truy vấn dữ liệu số lượng giftcode của người dùng
                $sql_count = "SELECT COUNT(*) AS giftcode_count FROM giftcode WHERE nguoidung = '$_username'";
                $result_count = $conn->query($sql_count);
                $row_count = $result_count->fetch_assoc();
                $giftcode_count = $row_count['giftcode_count'];

                // Truy vấn dữ liệu từ bảng "giftcodes" dựa trên số lượng giftcode của người dùng
                $sql = "SELECT id, giftcode, luotdung, nguoidung FROM giftcode WHERE nguoidung = '$_username' LIMIT $giftcode_count";
                $result = $conn->query($sql);

                // Kiểm tra và xử lý kết quả truy vấn
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $id = $row["id"];
                        $giftcode = $row["giftcode"];
                        $luotdung = $row["luotdung"];
                        $nguoidung = $row["nguoidung"];

                        // Kiểm tra lượt sử dụng và hiển thị thông báo tương ứng
                        if ($luotdung == 1) {
                            echo "Mã giftcode #" . $id . ": " . $giftcode . "<br>";
                        } else {
                            echo "Mã giftcode #" . $id . ": " . $giftcode . "<br>";
                        }
                    }
                } else {
                    echo "#Không có mã giftcode";
                }

                // Đóng kết nối đến cơ sở dữ liệu
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <div class="border-secondary border-top"></div>
    <div class="container pt-4 pb-4 text-white">
        <div class="row">
            <div class="col">
                <div class="text-center">
                    <div style="font-size: 13px" class="text-dark">
                        <?php
                        echo $_group;
                        echo $_fanpage;
                        echo $_copyright;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/main.js"></script>
</body><!-- Bootstrap core JavaScript -->

</html>