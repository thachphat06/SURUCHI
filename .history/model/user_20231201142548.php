<?php
require_once 'pdo.php';

function isUsernameExists($username) {
    $sql = "SELECT * FROM users WHERE username = ?";
    $result = pdo_query_one($sql, $username);

    return $result !== false;
}

function isPasswordExists($password) {
    $sql = "SELECT * FROM users WHERE password = ?";
    $result = pdo_query_one($sql, $password);
    
    return $result !== false;
}


function user_insert($username, $password, $email) {
    // Thực hiện quá trình đăng ký khi tài khoản không tồn tại
    $sql = "INSERT INTO users(username, password, email) VALUES (?, ?, ?)";
    pdo_execute($sql, $username, $password, $email);
}

function user_update($username, $password, $email, $name, $img, $address, $sdt, $role, $id) {
    if($img!="") {
        $sql = "UPDATE users SET username=?, password=?, email=?, name=?, img=?, address=?, sdt=?, role=? WHERE id=?";
        pdo_execute($sql, $username, $password, $email, $name, $img, $address, $sdt, $role, $id);
    } else {
        $sql = "UPDATE users SET username=?, password=?, email=?, name=?, address=?, sdt=?, role=? WHERE id=?";
        pdo_execute($sql, $username, $password, $email, $name, $address, $sdt, $role, $id);
    }
}



function checkuser($username, $password) {
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    return pdo_query_one($sql, $username, $password);
    // if (is_array($kq)&&(count($kq))) {
    //     return $kq["id"];
    // } else {
    //     return 0;
    // }
}



function get_user($id) {
    $sql = "SELECT * FROM users WHERE id=?";
    return pdo_query_one($sql, $id);
}

// function user_update($ma_kh, $mat_khau, $ho_ten, $email, $hinh, $kich_hoat, $vai_tro){
//     $sql = "UPDATE users SET mat_khau=?,ho_ten=?,email=?,hinh=?,kich_hoat=?,vai_tro=? WHERE ma_kh=?";
//     pdo_execute($sql, $mat_khau, $ho_ten, $email, $hinh, $kich_hoat==1, $vai_tro==1, $ma_kh);
// }

function user_delete($id){
    $sql = "DELETE FROM users WHERE id=?";
    pdo_execute($sql, $id);
}

// function user_select_all(){
//     $sql = "SELECT * FROM users";
//     return pdo_query($sql);
// }

// function user_select_by_id($ma_kh){
//     $sql = "SELECT * FROM users WHERE ma_kh=?";
//     return pdo_query_one($sql, $ma_kh);
// }

// function user_exist($ma_kh){
//     $sql = "SELECT count(*) FROM users WHERE $ma_kh=?";
//     return pdo_query_value($sql, $ma_kh) > 0;
// }

// function user_select_by_role($vai_tro){
//     $sql = "SELECT * FROM users WHERE vai_tro=?";
//     return pdo_query($sql, $vai_tro);
// }

// function user_change_password($ma_kh, $mat_khau_moi){
//     $sql = "UPDATE users SET mat_khau=? WHERE ma_kh=?";
//     pdo_execute($sql, $mat_khau_moi, $ma_kh);
// }

function loadall_user(){
    $sql = "select * from users";
    $listuser=pdo_query($sql);
    return $listuser;
} 

function get_img_user($id) {
    $sql = "SELECT img FROM users WHERE id=?";
    $getimg = pdo_query_one($sql, $id);

    // Kiểm tra xem có dữ liệu trả về hay không
    if ($getimg !== false && is_array($getimg)) {
        return $getimg['img'];
    } else {
        // Xử lý trường hợp không có dữ liệu
        return 'Ảnh không tồn tại'; // Hoặc giá trị mặc định khác tùy vào yêu cầu của bạn
    }
}

function change_password($username, $newpassword){
    $sql = "UPDATE users SET password=? WHERE username=?";
    pdo_execute($sql, $newpassword, $username);
}

function update_role($id, $role) {
    $sql = "UPDATE users SET role = ? WHERE id = ?";
    pdo_execute($sql, $role, $id);
}
