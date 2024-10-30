<?php 
include('../connectdb7.php');

// Lấy dữ liệu thể loại từ cơ sở dữ liệu
$sl = "SELECT * FROM theloai WHERE idTL=" . $_GET['idTL'];
$results = mysqli_query($connect, $sl);
$d = mysqli_fetch_array($results);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <title>Sửa thể loại</title>  
</head>


<body style="width:500px; margin:auto">
        <h3 class="text-center">Sửa</h3>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="idTL" value="<?php echo $d['idTL']; ?>">
                        <div class="form-group">
                            <label for="exampleInputName" class="form-label">Tên</label>
                            <input value="<?php echo $d['TenTL']; ?>" type="text" class="form-control" name="TenTL" id="exampleInputName"  placeholder="Tên thể loại">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSTT" class="form-label">STT</label>
                            <input value="<?php echo $d['ThuTu']; ?>" type="text" class="form-control" name="ThuTu" id="exampleInputSTT"  placeholder="STT" >
                        </div>
                        <div class="form-group">
                            <select class="custom-select" id="inputGroupSelect01" name="AnHien">
                                <option selected>Chọn Ẩn/ Hiện...</option>
                                <option value="0" <?php if ($d['AnHien'] == 0) echo "selected"; ?>>Ẩn</option>
                                <option value="1" <?php if ($d['AnHien'] == 1) echo "selected"; ?>>Hiện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPic" class="form-label">Biểu tượng</label>
                            <input type="file" class="form-control" name="icon" id="exampleInputPic"  placeholder="Chọn biểu tượng">
                        </div>
                    
                    
                        <button type="submit" name="Sua" value="<?php echo $d['idTL']; ?>" class="btn btn-success" action="add_xuli.php">Sửa</button>
                        <button type="reset" name="Huy" value="Hủy" onclick="window.location.href='index_new.php'">Hủy</button>

                    </form>
                </div>
              
              </div>
            </div>
        </>
    </div>
</body>

<?php

// Cập nhật thông tin
if (isset($_POST['Sua'])) {

    $target_path = "../image/";
    $uploaded_icon = ''; // Biến lưu tên icon mới nếu có

    if (isset($_FILES['ufile'])) {
        $filename = basename($_FILES['ufile']['name']);
        $target_path = $target_path . $filename;

        // Kiểm tra kiểu file upload
        if (!preg_match('/\.(jpg|gif|png|jpeg)$/i', $filename)) {
            echo 'Không phải file ảnh!';
        } else {
            // Di chuyển file upload
            if (move_uploaded_file($_FILES['ufile']['tmp_name'], $target_path)) {
                $uploaded_icon = $filename; // Lưu tên file để hiển thị
            } else {
                echo "Có lỗi xảy ra khi tải lên file, vui lòng thử lại!";
            }
        }
    }
    // Kiểm tra xem form đã submit hay chưa nếu đã submit rồi
    $theloai = $_POST['TenTL'];
    $thutu = $_POST['ThuTu'];
    $an = $_POST['AnHien'];
    $key = $_POST['idTL'];

    if ($uploaded_icon != '') {
        $sl = "UPDATE theloai SET TenTL='$theloai', ThuTu='$thutu', AnHien='$an', icon='$uploaded_icon' WHERE idTL='$key'";
    } else {
        $sl = "UPDATE theloai SET TenTL='$theloai', ThuTu='$thutu', AnHien='$an' WHERE idTL='$key'";
    }

    // Thực hiện truy vấn
    if (mysqli_query($connect, $sl)) {
        echo "<script language='javascript'>alert('Sửa thành công');";
        echo "location.href='index_new.php';</script>";
    } else {
        echo 'Lỗi: ' . mysqli_error($connect);
    }
}
?>
