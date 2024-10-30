<p>kkkkkkkkkkkkkkkkkkkkkkkkkkkkk</p>


<?php 
include('../connectdb7.php');

$target_path = "../image/";
$icon = '';

if (isset($_FILES['icon'])) {
    $target_path = $target_path . basename($_FILES['icon']['name']); 
    // Kiểm tra kiểu file upload
    if (!preg_match('/\.(jpg|gif|png|jpeg)$/i', basename($_FILES['icon']['name']))) {
        echo "Không phải file ảnh!";
    } else {
        // xử lý trùng tên
        if (file_exists($target_path)) {
            $icon = $_FILES['icon']['name']; // Lưu tên file để hiển thị
        } else {
            // Di chuyển file upload
            if (move_uploaded_file($_FILES['icon']['tmp_name'], $target_path)) {
                $icon = basename($_FILES['icon']['name']); // Lưu tên file để hiển thị
            } else {
                echo "Có lỗi xảy ra khi tải lên file, vui lòng thử lại!";
            }
        }
    }
}
    
    $theloai = $_POST['TenTL'];
    $thutu = $_POST['ThuTu'];
    $an = $_POST['AnHien'];
    $sl = "insert into theloai (TenTL,ThuTu,AnHien,icon) 
    Values ('$theloai','$thutu','$an','$icon')";
if(mysqli_query($connect,$sl))
{
    echo "<script language='javascript'>alert('Them thanh cong');";
    echo "location.href='index_new.php';</script>";
    // header("Loaction: index.php");
}
else
{
    echo 'Lỗi: ',mysqli_error($link);
}
?>