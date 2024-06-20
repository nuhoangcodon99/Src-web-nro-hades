<?php
// 
include_once 'connect.php';
include_once 'set.php';
include('head.php');
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
<script>
            document.addEventListener('DOMContentLoaded', function() {
                var script = document.createElement('script');
                script.src = 'https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js';
                script.onload = function() {
                    particlesJS("snow", {
                        "particles": {
                            "number": {
                                "value": 75,
                                "density": {
                                    "enable": true,
                                    "value_area": 400
                                }
                            },
                            "color": {
                                "value": "#d3077d"
                            },
                            "opacity": {
                                "value": 1,
                                "random": true,
                                "anim": {
                                    "enable": false
                                }
                            },
                            "size": {
                                "value": 3,
                                "random": true,
                                "anim": {
                                    "enable": true
                                }
                            },
                            "line_linked": {
                                "enable": true
                            },
                            "move": {
                                "enable": true,
                                "speed": 1,
                                "direction": "top",
                                "random": true,
                                "straight": false,
                                "out_mode": "out",
                                "bounce": false,
                                "attract": {
                                    "enable": true,
                                    "rotateX": 300,
                                    "rotateY": 1200
                                }
                            }
                        },
                        "interactivity": {
                            "events": {
                                "onhover": {
                                    "enable": false
                                },
                                "onclick": {
                                    "enable": false
                                },
                                "resize": false
                            }
                        },
                        "retina_detect": true
                    });
                }
                document.head.append(script);
            });
        </script>


    <div class="p-1 mt-1 alert alert-danger" style="border-radius: 7px; box-shadow: 0px 0px 5px black;">
	<div class="alert alert-danger" style="border-radius: 7px;">
	<div class="p-1">
        
          
                <div class="box-stt">
                    <div style="width: 55px; float:left; margin-right: 10px;">
                        <img class="avatar" src="image/avatar3.png" style="width: 50px; height: 55px;">
                    </div>
                    <div class="box-right">
                        <a href="mo-thanh-vien" class="alert-link text-decoration-none font-weight-bold" style="color:#9100ff; font-size:18px;"> 
						Mở Thành Viên 1 Đồng <img src="image/hot.gif"></a>
                        <div class="box_name_eman">bởi <b>
                                        <b style="color:red">Admin</b>
                                    </b>
                    </div>
                </div></div><br>
                <div class="box-stt">
                   <div style="width: 55px; float:left; margin-right: 10px;">
                        <img class="avatar" src="image/avatar6.png" style="width: 50px; height: 55px;">
                    </div>
                    <div class="box-right">
                        <a href="bang-xep-hang" class="alert-link text-decoration-none font-weight-bold" style="color:#9100ff; font-size:18px;"> 
						Bảng Xếp Hạng Đua Top <img src="image/hot.gif"></a>
                        <div class="box_name_eman">bởi <b>
                                        <b style="color:red">Admin</b>
                                    </b>
                    </div>
                </div></div>
                <br>
                
                <div class="box-stt">
                    <?php
                    $query = "SELECT posts.*, player.gender, account.admin FROM posts 
                    LEFT JOIN player ON posts.username = player.name 
                    LEFT JOIN account ON player.account_id = account.id 
                    WHERE posts.username = player.name 
                    ORDER BY posts.id DESC";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['id'];

                        // Lấy Avatar và tên người dùng
                        $gender = $row['gender'];
                        $admin = $row['admin'];
                        $avatar_url = "";

                        if ($admin == 1) {
                            if ($gender == 1) {
                                $avatar_url = "image/avatar10.png";
                            } elseif ($gender == 2) {
                                $avatar_url = "image/avatar11.png";
                            } else {
                                $avatar_url = "image/avatar12.png";
                            }
                        } else {
                            if ($gender == 1) {
                                $avatar_url = "image/avatar1.png";
                            } elseif ($gender == 2) {
                                $avatar_url = "image/avatar2.png";
                            } else {
                                $avatar_url = "image/avatar0.png";
                            }
                        }

                        if ($row['ghimbai'] == 1) {
                            // Tiêu đề và avatar của bài viết ghim
                            echo '<div style="width: 40px; float: left; margin-right: 5px; overflow: hidden;">';
                            echo '<div style="width: 55px; float:left; margin-right: 10px;"><img class="avatar" src="' . $avatar_url . '" alt="Avatar" style="border-color:red; width: 50px; height: 55px;">';
                            echo '</div>';
                            echo '<div class="box-right">';

                            if ($row['admin'] == 1) {
                                // Determine title color based on the value of 'theloai'
                                $titleColor = '';
                                switch ($row['theloai']) {
                                    case 0:
                                        $titleColor = 'color:#9100ff; font-size:18px;'; // Brown color
                                        break;
                                    case 1:
                                        $titleColor = 'color:#9100ff; font-size:18px;'; // Green color
                                        break;
                                    case 2:
                                        $titleColor = 'color:#9100ff; font-size:18px;'; // Orange color
                                        break;
                                    case 3:
                                        $titleColor = 'color:#9100ff; font-size:18px;'; // Red color
                                        break;
                                    default:
                                        $titleColor = ''; // Default color (fallback)
                                        break;
                                }

                                echo '<a href="bai-viet?id=' . $row['id'] . '"><span class="alert-link text-decoration-none font-weight-bold" style="' . $titleColor . '">' . $row['tieude'] . '</span></a>';
                                echo '<div class="box-name" style="font-size: 13px;"> bởi <span style="color:red">';
                                echo $row['username'];
                                echo ' <i class="fas fa-star"></i>'; // Icon sao cho quản trị viên
                                echo '</span>';
                            } else {
                                echo '<a class="alert-link text-decoration-none" href="bai-viet?id=' . $row['id'] . '">' . $row['tieude'] . '</a>';
                                echo '<div class="box_name_eman" style="font-size: 13px;"> bởi <span style="color:red"> ' . $row['username'] . '';
                            }


                            $query2 = "SELECT comments.id, comments.nguoidung, player.account_id, account.admin, account.tichdiem FROM comments INNER JOIN player ON comments.nguoidung = player.name INNER JOIN account ON player.account_id = account.id WHERE comments.post_id = '$post_id' ORDER BY comments.id ASC";
                            $result2 = mysqli_query($conn, $query2);


                            $thao_luan_da_hien_thi = false;
                            $displayed_danh_hieu = false;
                            $first_comment_processed = false;
                            $first_comment_tichdiem = 0;
                            $first_comment_color = "";
                            $first_comment_danh_hieu = "";

                            if (mysqli_num_rows($result2) > 0) {
                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                    $tichdiem = $row2['tichdiem'];
                                    if ($row2['admin'] == 1 && !$thao_luan_da_hien_thi) {
                                        echo '<span style="color: #212F3C;"> (Admin Đã Tham Gia)</span>';
                                        $thao_luan_da_hien_thi = true;
                                        $displayed_danh_hieu = true;
                                        // Đánh dấu rằng đã hiển thị thông tin của admin
                                        // và không cần hiển thị danh hiệu nữa
                                    } elseif ($row2['admin'] != 1) {
                                        if ($tichdiem >= 200) {
                                            $danh_hieu = "(Chuyên Gia Đã Giải Đáp)";
                                            $color = "#800000";
                                        } elseif ($tichdiem >= 100) {
                                            $danh_hieu = "(Người Hỏi Đáp Đã Trả Lời)";
                                            $color = "#A0522D";
                                        } elseif ($tichdiem >= 35) {
                                            $danh_hieu = "(Người Bắt Chuyện Đã Trả Lời)";
                                            $color = "#6A5ACD";
                                        } else {
                                            $danh_hieu = "";
                                        }
                                        if ($danh_hieu !== "" && !$displayed_danh_hieu) {
                                            if (!$first_comment_processed) {
                                                $first_comment_color = $color;
                                                $first_comment_danh_hieu = $danh_hieu;
                                                $first_comment_processed = true;
                                            }
                                        }
                                    }
                                }
                                if ($first_comment_danh_hieu !== "" && !$displayed_danh_hieu) {
                                    echo '<span style="color:' . $first_comment_color . ' !important"> ' . $first_comment_danh_hieu . '</span>';
                                }
                            }

                            echo '</div></div>';


                        }
                    }
                    ?>
                </div>
            </div>
	</div>
<div class="alert alert-danger" style="border-radius: 7px;">
        <div class="row">
            <div class="col">
                <div class="box-stt">
                    <?php
                    // Tính toán số lượng bài viết
                    $query = "SELECT COUNT(*) AS count FROM posts";
                    $result = mysqli_query($conn, $query);
                    $row = mysqli_fetch_assoc($result);
                    $count = $row['count'];

                    // Thiết lập giới hạn cho mỗi trang
                    $limit = 20;

                    // Tính toán số lượng trang
                    $total_pages = ceil($count / $limit);

                    // Lấy số trang từ tham số URL
                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

                    // Xác định vị trí của trang hiện tại trong danh sách các trang
                    $page_position = min(max(1, $page - 1), max(1, $total_pages - 2));

                    // Tính toán giới hạn kết quả truy vấn theo biến $limit và $page
                    $offset = ($page - 1) * $limit;
                    $query = "SELECT posts.*, player.gender, account.admin FROM posts 
          LEFT JOIN player ON posts.username = player.name 
          LEFT JOIN account ON player.account_id = account.id 
          WHERE posts.username = player.name 
          ORDER BY posts.id DESC LIMIT $limit OFFSET $offset";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $post_id = $row['id'];

                        //lấy  Avatar và tên của người dùng
                        $gender = $row['gender'];
                        $admin = $row['admin'];
                        $avatar_url = "";

                        if ($admin == 1) {
                            if ($gender == 1) {
                                $avatar_url = "image/avatar10.png";
                            } elseif ($gender == 2) {
                                $avatar_url = "image/avatar11.png";
                            } else {
                                $avatar_url = "image/avatar12.png";
                            }
                        } else {
                            if ($gender == 1) {
                                $avatar_url = "image/avatar1.png";
                            } elseif ($gender == 2) {
                                $avatar_url = "image/avatar2.png";
                            } else {
                                $avatar_url = "image/avatar0.png";
                            }
                        }

                        // Tiêu đề và avatar của người dùng
                        echo '<div style="width: 55px; float:left; margin-right: 10px;"><img class="avatar" src="' . $avatar_url . '" alt="Avatar" style="border-color:red; width: 50px; height: 55px;"></div>';

                        echo '<div class="box-right">';

                        if ($row['admin'] == 1) {
                            // Determine title color based on the value of 'theloai'
                            $titleColor = '';
                            switch ($row['theloai']) {
                                case 0:
                                    $titleColor = 'color:#9100ff; font-size:18px;'; // Brown color
                                    break;
                                case 1:
                                    $titleColor = 'color:#9100ff; font-size:18px;'; // Green color
                                    break;
                                case 2:
                                    $titleColor = 'color:#9100ff; font-size:18px;'; // Orange color
                                    break;
                                case 3:
                                    $titleColor = 'color:#9100ff; font-size:18px;'; // Red color
                                    break;
                                default:
                                    $titleColor = ''; // Default color (fallback)
                                    break;
                            }

                            echo '<a href="bai-viet?id=' . $row['id'] . '"><span class="alert-link text-decoration-none font-weight-bold" style="' . $titleColor . '">' . $row['tieude'] . '</span></a>';
                            echo '<div class="box_name_eman" style="font-size: 13px;"> bởi <span style="color:red"><b>';
                            echo $row['username'];
                            echo ' <i class="fa fa-star"></i>'; // Icon sao cho quản trị viên
                            echo '</span>';
                        } else {
                            echo '<a class="alert-link text-decoration-none" href="bai-viet?id=' . $row['id'] . '">' . $row['tieude'] . '</a>';
                            echo '<div class="box_name_eman" style="font-size: 13px;"> bởi <span style="color:red">' . $row['username'] . '';
                        }


                        $query2 = "SELECT comments.id, comments.nguoidung, player.account_id, account.admin, account.tichdiem
            FROM comments 
            INNER JOIN player ON comments.nguoidung = player.name
            INNER JOIN account ON player.account_id = account.id
            WHERE comments.post_id = '$post_id'
            ORDER BY comments.id ASC";

                        $result2 = mysqli_query($conn, $query2);

                        $thao_luan_da_hien_thi = false;
                        $displayed_danh_hieu = false;
                        $first_comment_processed = false;
                        $first_comment_tichdiem = 0;
                        $first_comment_color = "";
                        $first_comment_danh_hieu = "";

                        if (mysqli_num_rows($result2) > 0) {
                            while ($row2 = mysqli_fetch_assoc($result2)) {
                                $tichdiem = $row2['tichdiem'];
                                if ($row2['admin'] == 1 && !$thao_luan_da_hien_thi) {
                                    echo '<span style="color: #212F3C;"> (Admin Đã Tham Gia)</span>';
                                    $thao_luan_da_hien_thi = true;
                                    $displayed_danh_hieu = true;
                                    // Đánh dấu rằng đã hiển thị thông tin của admin
                                    // và không cần hiển thị danh hiệu nữa
                                } elseif ($row2['admin'] != 1) {
                                    if ($tichdiem >= 200) {
                                        $danh_hieu = "(Chuyên Gia Đã Giải Đáp)";
                                        $color = "#800000";
                                    } elseif ($tichdiem >= 100) {
                                        $danh_hieu = "(Người Hỏi Đáp Đã Trả Lời)";
                                        $color = "#A0522D";
                                    } elseif ($tichdiem >= 35) {
                                        $danh_hieu = "(Người Bắt Chuyện Đã Trả Lời)";
                                        $color = "#6A5ACD";
                                    } else {
                                        $danh_hieu = "";
                                    }
                                    if ($danh_hieu !== "" && !$displayed_danh_hieu) {
                                        if (!$first_comment_processed) {
                                            $first_comment_color = $color;
                                            $first_comment_danh_hieu = $danh_hieu;
                                            $first_comment_processed = true;
                                        }
                                    }
                                }
                            }
                            if ($first_comment_danh_hieu !== "" && !$displayed_danh_hieu) {
                                echo '<span style="color:' . $first_comment_color . ' !important"> ' . $first_comment_danh_hieu . '</span>';
                            }
                        }
                        echo '</div></div><br>';

                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="container pb-2">
        <div class="row mt-3">
            <div class="col-5">
                <?php
            if ($_login === null) {

            } else {
                echo '<a class="btn btn-action m-1 text-white" style="border-radius: 10px;" href="dang-bai">Đăng bài mới</a>';
            }
            ?>
        </div>
            <?php
            echo '<div class="col-7 text-right">';
            echo '<ul class="pagination" style="justify-content: flex-end;">';
            if ($page > 1) {
                echo '<li><a class="btn btn-warning text-white" href="?page=' . ($page - 1) . '"><</a></li>';
            }
            $start_page = max(1, min($total_pages - 2, $page - 1));
            $end_page = min($total_pages, max(2, $page + 1));
            for ($i = 1; $i <= $total_pages; $i++) {
                if ($i >= $start_page && $i <= $end_page) {
                    $class_name = "btn btn-sm btn-light";
                    if ($i == $page) {
                        $class_name = "btn btn-sm page-active";
                    }
                    echo '<li><a class="' . $class_name . '" href="?page=' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($page < $total_pages) {
                echo '<li><a class="btn btn-sm btn-light" href="?page=' . ($page + 1) . '">></a></li>';
            }
            echo '</ul>';
            echo '</div>';
            ?>
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
    
    


    <script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/main.js"></script>
</body><!-- Bootstrap core JavaScript -->

</html>