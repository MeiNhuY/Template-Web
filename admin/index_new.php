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
    
    <title>Quan li the loai</title>  
</head>

<body>
    <?php include_once('../connectdb7.php') ?>
    
    <div class="container">
        <h3 class="text-content">Quản lí thể loại</h3>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Tên thể loại</th>
                <th scope="col">STT</th>
                <th scope="col">Ẩn/ Hiện</th>
                <th scope="col">Biểu tượng</th>
                <th scope="col">Sửa</th>
                <th scope="col">Xóa</th>
              </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM theloai";
                    $result = mysqli_query($connect, $sql);
                    while (($rows = mysqli_fetch_assoc($result)) != NULL) {
                ?> 
                    <tr> <!-- Thêm thẻ <tr> ở đây -->
                        <td><?php echo $rows['TenTL'] ?></td>
                        <td><?php echo $rows['ThuTu'] ?></td>
                        <td>
                            <?php if($rows['AnHien'] == 1) {
                                echo "Hiện";
                            } else {
                                echo "Ẩn";
                            }?>
                        </td>
                        <td>
                            <?php
                                $image_path = "toan.jpg" . $rows['icon'];
                                echo "<img src='$image_path' style='width:40px'/>";
                            ?>
                        </td>
                        <!-- <td><a class="btn btn-warning" href="edit_new.php">Sửa</a></td> -->
                        <td><a class="btn btn-warning" href="edit_new.php?idTL=<?php echo $rows['idTL']; ?>">Sửa</a></td>
                        <td><a class="btn btn-danger" href="delete_new.php?idTL=<?php echo $rows['idTL'];?>" onclick="return confirm('Bạn có chắc chắn không?');">Xóa</a></td>
                    </tr>
                <?php 
                    } 
                    mysqli_close($connect);
                ?>
            </tbody>
          </table>
          

          <!-- Button trigger modal của index--> 
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">Thêm thể loại</button>
  
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <!-- /tieu đề cuat dialog THÊM -->
                <h5 class="modal-title" id="exampleModalLabel">Thêm thể loại</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <form action="add_xuli.php" method="POST" action="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputName" class="form-label">Tên</label>
                            <input type="text" class="form-control" name="TenTL" id="exampleInputName"  placeholder="Tên thể loại">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputSTT" class="form-label">STT</label>
                            <input type="text" class="form-control" name="ThuTu" id="exampleInputSTT"  placeholder="STT" >
                        </div>
                        <div class="form-group">
                            <select class="custom-select" id="inputGroupSelect01" name="AnHien">
                                <option selected>Chọn Ẩn/ Hiện...</option>
                                <option value="1">Ẩn</option>
                                <option value="2">Hiện</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPic" class="form-label">Biểu tượng</label>
                            <input type="file" class="form-control" name="icon" id="exampleInputPic"  placeholder="Chọn biểu tượng">
                        </div>
                    
                    
                        <button type="submit" class="btn btn-success" >Thêm Vào</button>
                    </form>
                </div>
              
              </div>
            </div>
        </div>
    </div>
</body>

