<?php
include_once 'set.php';
include_once 'connect.php';
include_once 'head.php';
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
    <title>Ngọc Rồng Hades</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="assets/images/icon/icon.ico">


    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- mycss -->
    <link rel="stylesheet" href="css/mystyle.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- myjs -->
    <!--<script src="js/tet.js"></script>-->

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</head>


    <div class="p-1 mt-1 alert alert-danger" style="border-radius: 7px; box-shadow: 0px 0px 5px black;">
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <br>
                <br>
                <h4>Cộng Tiền - Máy Chủ 1</h4><br>
                <?php if ($_login === null) { ?>
                    <p>Bạn chưa đăng nhập? hãy đăng nhập để sử dụng chức năng này</p>
                <?php } else { ?>
                    <b class="text text-danger">Lưu Ý: </b><br>
                    - Hãy thoát game trước khi cộng tránh lỗi không mong muốn!
                    <br>
                    - Chỉ dùng cho những tài khoản không bị khóa do vi phạm
                    <br>
                    <br>
                    <?php
                    $_alert = '';
                    // Xử lý khi form được submit
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Lấy dữ liệu từ form
                        $username = $_POST["username"];
                        $vnd = intval($_POST["vnd"]);

                        // Kiểm tra xem có tài khoản nào khớp với tên đăng nhập không
                        $sql_check = "SELECT * FROM account WHERE username = '$username'";
                        $result_check = $conn->query($sql_check);

                        if ($result_check->num_rows == 0) {
                            $_alert = '<div class="alert alert-danger">Lỗi: Tài khoản không tồn tại!</div>';
                        } else {
                            $row = $result_check->fetch_assoc();
                            if ($row["ban"] == 1) {
                                $_alert = '<div class="alert alert-danger">Lỗi: Tài khoản đã bị vi phạm và không thể cộng tiền!</div>';
                            } else {
                                // Cập nhật tiền
                                $sql_update = "UPDATE account SET vnd = vnd + $vnd WHERE username = '$username'";
                                if ($conn->query($sql_update) === TRUE) {
                                    $_alert = '<div class="alert alert-success">Cộng tiền thành công!</div>';
                                } else {
                                    $_alert = '<div class="alert alert-warning">Lỗi: Kết nối đến máy chủ</div>';
                                }
                            }
                        }
                    }

                    // Đóng kết nối
                    $conn->close();
                    ?>
                    <!-- Hiển thị biến $_alert -->
                    <div id="alertContainer">
                        <?php echo $_alert; ?>
                    </div>
                    <form method="POST">
                        <div class="mb-3">
                            <label>Tên Tài Khoản:</label>
                            <input type="username" class="form-control" name="username" id="username"
                                placeholder="Nhập tên tài khoản" required autocomplete="username">
                        </div>
                        <div class="mb-3">
                            <label>Số Tiền:</label>
                            <input type="vnd" class="form-control" name="vnd" id="vnd" placeholder="Nhập số tiền cần cộng"
                                required autocomplete="vnd">
                        </div>
                        <button class="btn btn-main form-control" type="submit">Thực Hiện</button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

    
      <footer class="mt-1">


            <div class="text-center mt-1">
                <b style="font-size:13px;" class="text-white">Tham gia cộng đồng giao lưu game với chúng tớ.</b>
                <br>
                <a href="" target="_blank"><img src="assets/images/icon/findondiscord.png" style="max-width:100px" class="mt-1"></a>
                <a href="https://www.facebook.com/groups/ngocronghades" target="_blank"><img src="assets/images/icon/findonfb.png" style="max-width:100px" class="mt-1"></a>
            </div>
            <div class="text-center text-white">
                Trò chơi không có bản quyền chính thức, hãy cân nhắc kỹ trước khi tham gia.<br> Chơi quá 180 phút một ngày sẽ ảnh hưởng đến sức khỏe.
            </div>
        </footer>
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/main.js"></script>
</body><!-- Bootstrap core JavaScript -->

</html>