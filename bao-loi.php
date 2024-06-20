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
                <h4>BÁO LỖI MÁY CHỦ</h4>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><span class="text-danger">*</span> Tiêu đề:</label>
                        <input class="form-control" type="text" name="tieude" id="tieude"
                            placeholder="Nhập tiêu đề bài viết" required>

                        <label><span class="text-danger">*</span> Nội dung:</label>
                        <textarea class="form-control" type="text" name="noidung" id="noidung"
                            placeholder="Nhập nội dung bài viết" required></textarea>

                        <?php
                        if (isset($_SESSION['success'])) {
                            $successMessage = $_SESSION['success'];
                            echo "<p class='text-danger'>$successMessage</p>";
                            unset($_SESSION['success']);
                        } elseif (isset($_SESSION['message'])) {
                            $errorMessage = $_SESSION['message'];
                            echo "<p class='text-danger'>$errorMessage</p>";
                            unset($_SESSION['message']);
                        }
                        ?>
                    </div>

                    <button class="btn btn-main form-control" type="submit">ĐĂNG BÀI</button>
                </form>
                <script>
                    const form = document.querySelector("form");
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const submitError = form.querySelector("#submit-error");

                    const submitForm = async (event) => {
                        event.preventDefault();

                        const titleLength = document.getElementById("tieude").value.trim().length;
                        const contentLength = document.getElementById("noidung").value.trim().length;

                        if (titleLength < 1 || contentLength < 1) {
                            submitError.innerHTML =
                                "<strong>Lỗi:</strong> Tiêu đề và nội dung không được để trống!";
                            submitError.style.display = "block";
                            submitBtn.scrollIntoView({ behavior: "smooth", block: "start" });
                            return;
                        }

                        try {
                            const xhr = new XMLHttpRequest();
                            xhr.open('POST', 'gmail/bao-loi-api.php', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = () => {
                                if (xhr.readyState === XMLHttpRequest.DONE) {
                                    if (xhr.status === 200) {
                                        const response = xhr.responseText;
                                        if (response === "success") {
                                            alert("Gửi gmail thành công");
                                            updateRemainingTime();
                                            location.reload(); // Tải lại trang nếu gửi yêu cầu thành công
                                        } else {
                                            console.error(response);
                                            location.reload(); // Tải lại trang nếu gửi yêu cầu thành công
                                        }
                                    } else {
                                        console.error(xhr.statusText);
                                        location.reload(); // Tải lại trang nếu gửi yêu cầu thành công
                                    }
                                }
                            };
                            const formData = new FormData(form);
                            xhr.send(new URLSearchParams(formData).toString());

                        } catch (error) {
                            console.error(error);
                        }
                    };

                    form.addEventListener("submit", submitForm);
                </script>
            </div>
        </div>
    </div>
</div>
    <script src=" assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/main.js"></script>
</body><!-- Bootstrap core JavaScript -->

</html>
<div class="py-3">
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
</main>
</body>