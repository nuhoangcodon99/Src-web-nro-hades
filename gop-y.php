<?php
include_once 'set.php';
include_once 'connect.php';
include('head.php');
if ($_login === null) {
    // Chưa đăng nhập, chuyển hướng đến trang khác bằng JavaScript
    echo '<script>window.location.href = "../dang-nhap";</script>';
    exit(); // Đảm bảo dừng thực thi code sau khi chuyển hướng
}
$_alert = '';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Trang Chủ Chính Thức - Ngọc Rồng Light</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="keywords"
        content="Chú Bé Rồng Online,ngoc rong mobile, game ngoc rong, game 7 vien ngoc rong, game bay vien ngoc rong">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:description"
        content="Website chính thức của Chú Bé Rồng Online – Game Bay Vien Ngoc Rong Mobile nhập vai trực tuyến trên máy tính và điện thoại về Game 7 Viên Ngọc Rồng hấp dẫn nhất hiện nay!">
    <meta name="twitter:image" content="image/logo.png">
    <meta name="twitter:image:width" content="200">
    <meta name="twitter:image:height" content="200">
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/notify/notify.js"></script>
    <link rel="icon" href="image/icon.png?v=99">
    <link href="assets/main.css" rel="stylesheet">
</head>


    <div class="container color-forum pt-1 pb-1">
        <div class="row">
            <div class="col"> <a href="dien-dan" style="color: white">Quay lại diễn đàn</a> </div>
        </div>
    </div>
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <h4>GÓP Ý PHÁT TRIỂN MÁY CHỦ</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Tiêu đề:</label>
                        <input class="form-control" type="text" name="tieude" id="tieude"
                            placeholder="Nhập tiêu đề bài viết" required>

                        <label><span class="text-danger">*</span> Nội dung:</label>
                        <textarea class="form-control" type="text" name="noidung" id="noidung"
                            placeholder="Nhập nội dung bài viết" required></textarea>

                        <div id="submit-error" class="alert alert-danger mt-2" style="display: none;"></div>
                    </div>

                    <button class="btn btn-main form-control" type="submit">ĐĂNG BÀI</button>
                </form>
                <?php
                // Import thư viện PHPMailer
                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;

                // Đường dẫn đến các tệp thư viện PHPMailer
                require 'vendor/autoload.php';
                require 'vendor/phpmailer/phpmailer/src/Exception.php';
                require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
                require 'vendor/phpmailer/phpmailer/src/SMTP.php';

                // Kiểm tra xem form đã được gửi hay chưa
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Lấy giá trị từ form
                    $tieude = htmlspecialchars($_POST["tieude"]);
                    $noidung = htmlspecialchars($_POST["noidung"]);
                    $username = $_username; // Sử dụng thông tin username từ phiên đăng nhập
                
                    // Kiểm tra từ cấm trong tiêu đề và nội dung
                    $censoredWords = array(
                        'sex',
                        'địt',
                        'súc vật',
                        'fuck',
                        'loz',
                        'lozz',
                        'lozzz',
                        'óc chó',
                        'ngu lồn',
                        'nguu lồn',
                        'nguu lồn',
                        'ngulon',
                        'nguu lonn',
                        'ngu lon',
                        'occho',
                        'ditmemay',
                        'dmm',
                        'dcm',
                        'địt cụ mày',
                        'địt con mẹ mày',
                        'fuck you',
                        'chịch',
                        'chịt',
                        'sẽ gầy'
                    );

                    foreach ($censoredWords as $word) {
                        if (stripos($tieude, $word) !== false || stripos($noidung, $word) !== false) {
                            echo "<span class='text-danger pb-2'>Thông Báo:</span> Tiêu đề hoặc nội dung chứa từ không cho phép.";
                            exit;
                        }
                    }

                    // Gửi email
                    $mail = new PHPMailer(true);

                    try {
                        // Cấu hình thông tin email
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'ngocrongdragonking@gmail.com'; // Tài khoản Gmail của bạn
                        $mail->Password = 'vscwwaluzuvwztwr'; // Mật khẩu Gmail của bạn
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        // Thiết lập địa chỉ email người gửi và tên người gửi
                        $mail->setFrom('ngocrongdragonking@gmail.com', 'Góp Ý');

                        // Thiết lập địa chỉ email người nhận
                        $mail->addAddress('ngocrongdragonking@gmail.com');

                        // Thiết lập tiêu đề email
                        $mail->Subject = '=?UTF-8?B?' . base64_encode($tieude) . '?=';

                        // Thiết lập nội dung email
                        $mail->Body = "- Tên tài khoản: " . $username . "\n- Nội dung: $noidung";
                        $mail->CharSet = 'UTF-8';
                        $mail->Encoding = 'base64';

                        // Gửi email
                        $mail->send();

                        echo 'Email đã được gửi đi thành công.';
                    } catch (Exception $e) {
                        echo 'Gửi email thất bại. Lỗi: ' . $mail->ErrorInfo;
                    }
                }
                ?>
                <script>
                    const form = document.querySelector('form');
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const submitError = form.querySelector('#submit-error');

                    form.addEventListener('submit', (event) => {
                        const titleLength = document.getElementById('tieude').value.trim().length;
                        const contentLength = document.getElementById('noidung').value.trim().length;

                        if (titleLength < 1 || contentLength < 1) {
                            event.preventDefault();

                            submitError.innerHTML = '<strong>Lỗi:</strong> Tiêu đề và nội dung phải có ít nhất 5 ký tự!';
                            submitError.style.display = 'block';
                            submitBtn.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
    <script src=" assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/main.js"></script>
</body><!-- Bootstrap core JavaScript -->

</html>
<div class="py-3">
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
</div>
</main>
</body>