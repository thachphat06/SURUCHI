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

function user_insert_id($username, $password, $name, $address, $email, $sdt)
{
    $sql = "INSERT INTO users(username, password, name, address, email, sdt) VALUES (?, ?, ?, ?, ?, ?)";
    return pdo_execute_id($sql,  $username, $password, $name, $address, $email, $sdt);
}

function user_update($username, $password, $email, $name, $img, $address, $sdt, $role, $id) {
    if($img!="" && $role==0) {
        $sql = "UPDATE users SET username=?, password=?, email=?, name=?, img=?, address=?, sdt=?, role=? WHERE id=?";
        pdo_execute($sql, $username, $password, $email, $name, $img, $address, $sdt, $role, $id);
    } else {
        $sql = "UPDATE users SET username=?, password=?, email=?, name=?, address=?, sdt=? WHERE id=?";
        pdo_execute($sql, $username, $password, $email, $name, $address, $sdt, $id);
    }
}


function checkuser($username, $password) {
    $sql = "SELECT * FROM users WHERE username=? AND password=?";
    return pdo_query_one($sql, $username, $password);
}

function checkmail($usr, $Mailer){
    $sql = "SELECT * FROM users WHERE username=? AND email=? ";
    return pdo_query_one($sql, $usr, $Mailer);
}

function checkpass(){
    $sql = "SELECT * FROM users ";
    return pdo_query_one($sql);
}

function get_user($id) {
    $sql = "SELECT * FROM users WHERE id=?";
    return pdo_query_one($sql, $id);
}

function user_delete($id){
    $sql = "DELETE FROM users WHERE id=?";
    pdo_execute($sql, $id);
}

function user_change_password($rs_pwf, $iduser){
    $sql = "UPDATE users SET password=? WHERE id=?";
    pdo_execute($sql, $rs_pwf, $iduser);
}

function loadall_user($kyw) {
    $sql = "SELECT * FROM users WHERE 1";

    if ($kyw != "") {
        $sql .= " AND username LIKE '%" . $kyw . "%'";
    }

    $sql .= " ORDER BY id";

    return pdo_query($sql);
}

function load_user_role(){
    $sql = "SELECT * FROM users WHERE role = 1 ORDER BY id DESC";
    $userlist = pdo_query($sql);
    return $userlist;
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
