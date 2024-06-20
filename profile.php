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
    <link href="assets//main.css" rel="stylesheet">
</head>


<div class="container color-forum pt-1 pb-1">
    <div class="row">
        <div class="col">
            <a href="dien-dan" style="color: white">Quay lại diễn đàn</a>
        </div>
    </div>
</div>
<h4>THÔNG TIN NHÂN VẬT</h4>
<?php
// Truy vấn dữ liệu từ bảng player và account
$query = "SELECT player.name, player.gender, player.pet, player.data_point, player.data_task
          FROM player
          LEFT JOIN account ON player.account_id = account.id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $playerName = $row['name'];
        $playerGender = $row['gender'];
        $playerPet = $row['pet'];
        $datapointString = $row['data_point'];
        $playertask = json_decode($row['data_task'], true);

        // Chuyển đổi JSON thành mảng
        $data_point = json_decode($datapointString, true);

        // Lấy danh sách các datapoint cần lấy
        $datapointArray = array_filter($data_point, function ($key) {
            return in_array($key, ['1', '2', '4', '5', '6', '7', '8']);
        }, ARRAY_FILTER_USE_KEY);

        // Xây dựng và hiển thị thông tin nhân vật và đệ tử
        echo '<div class="container pt-5 pb-5" id="pageHeader">';
        echo '<div class="row pb-2 pt-2">';
        echo '<div class="col-lg-6">';

        // Xây dựng và hiển thị hình ảnh nhân vật
        $characterImage = '';
        switch ($playerGender) {
            case '0':
                $characterImage = 'gohan.png';
                $characterImageStyle = 'width: 80px;'; // Kích thước 100px chỉ áp dụng cho Gohan
                break;
            case '1':
                $characterImage = 'picolo.png';
                $characterImageStyle = 'width: 100px;'; // Kích thước 100px chỉ áp dụng cho Picolo
                break;
            case '2':
                $characterImage = 'vegeta.png';
                $characterImageStyle = 'width: 150px;'; // Kích thước 100px chỉ áp dụng cho Vegeta
                break;
            default:
                $characterImage = 'default.png';
                break;
        }

        $characterImagePath = 'image/' . $characterImage;
        echo "<div class='col-lg-6 htop'>";
        echo "<img src='$characterImagePath' alt='Nhân vật' style='$characterImageStyle'>";


        // Hiển thị hành tinh
        $planetName = '';
        switch ($playerGender) {
            case '0':
                $planetName = 'Trái Đất';
                break;
            case '1':
                $planetName = 'Namec';
                break;
            case '2':
                $planetName = 'Xayda';
                break;
            default:
                $planetName = 'Không xác định';
                break;
        }

        echo "<br><span>Nhân Vật: $playerName</span>";
        echo "<br><span>Hành Tinh: $planetName</span><br>";

        // Truy vấn tên nhiệm vụ từ bảng task_main_template
        $taskQuery = "SELECT name FROM task_main_template WHERE id = ?";
        $taskStatement = $conn->prepare($taskQuery);
        $taskID = $playertask[0]; // Lấy ID nhiệm vụ từ trường player.task

        // Bind ID vào câu truy vấn
        $taskStatement->bind_param("i", $taskID);
        $taskStatement->execute();

        // Lấy kết quả từ truy vấn
        $taskResult = $taskStatement->get_result();

        // Kiểm tra và lấy tên nhiệm vụ
        $taskName = '';
        if ($taskResult->num_rows > 0) {
            $taskRow = $taskResult->fetch_assoc();
            $taskName = $taskRow['name'];
        }

        echo "<span>Nhiệm Vụ: $taskName</span>";
        echo "</div>";
        echo "</div>";
        echo '<div class="col-lg-6">';
        echo '<h8>THÔNG TIN CHỈ SỐ:</h8><br><br>';

        // Hiển thị các chỉ số sư phụ nếu có
        foreach ($datapointArray as $key => $value) {
            switch ($key) {
                case '1':
                    $sucmanh = number_format($value);
                    echo "<p>Sức Mạnh: $sucmanh</p>";
                    break;

                case '2':
                    $tiemnang = number_format($value);
                    echo "<p>Tiềm Năng: $tiemnang</p>";
                    break;

                case '4':
                    $mau = number_format($value);
                    echo "<p>Máu: $mau</p>";
                    break;

                case '5':
                    $theluc = number_format($value);
                    echo "<p>Thể Lực: $theluc</p>";
                    break;

                case '6':
                    $sucdanhgoc = number_format($value);
                    echo "<p>Sức Đánh Gốc: $sucdanhgoc</p>";
                    break;

                case '7':
                    $giapgoc = number_format($value);
                    echo "<p>Giáp Gốc: $giapgoc</p>";
                    break;

                case '8':
                    $chimang = number_format($value);
                    echo "<p>Chí Mạng: $chimang</p>";
                    break;
            }
        }
        echo "</div>";
        echo '</div>';
        echo '</div>';

        // Chỉ hiển thị thông tin của một nhân vật duy nhất
        break;
    }
} else {
    echo "Không tìm thấy thông tin nhân vật.";
}

$conn->close();
?>
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