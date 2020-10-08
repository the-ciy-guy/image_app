<?php

function getLoggedInUser()
{
    global $conn;
    $id = $_GET['id'];
    $get_user = "SELECT * FROM users WHERE id = '$id'";
    $result = mysqli_query($conn, $get_user);
    return $result;
}

function getLoggedInUserId()
{
    $id = getLoggedInUser();
    if ($i = mysqli_fetch_array($id)) {
        $uid = $i['id'];
        return $uid;
    }
}

function getLoggedInUserName()
{
    $query = getLoggedInUser();
    if ($i = mysqli_fetch_array($query)) {
        $uname = $i['username'];
        return $uname;
    }
}

function userSignupDate()
{
    $query = getLoggedInUser();
    if ($i = mysqli_fetch_array($query)) {
        $date = $i['updated_at'];
        $date = date("F Y");
        return $date;
    }
}

function getLoggedInUserDescription()
{
    $query = getLoggedInUser();
    if ($i = mysqli_fetch_array($query)) {
        $udesc = $i['user_description'];
        return $udesc;
    }
}

$email = "";
$user_desc = "";
$user_edit = false;
$id = 0;

if (isset($_GET['id'])) {
    $user_edit = true;
    $id = $_GET['id'];
    $get_the_user = "SELECT * FROM users WHERE id = $id LIMIT 1";
    $result = mysqli_query($conn, $get_the_user);

    $user = mysqli_fetch_array($result);
    $email = $user['email'];
    $user_desc = $user['user_description'];
}

if (isset($_POST['add_info'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_desc = mysqli_real_escape_string($conn, $_POST['user_desciption']);

    $id = $_POST['id'];
    $insert_info = "UPDATE users SET email='$email', user_description='$user_desc' WHERE id=$id";
    mysqli_query($conn, $insert_info);
    header('location:' .BASE_URL. 'users/profile.php?update_successful&id='.$_SESSION['u_id']);
    exit();
}

$profile_pic = "";
if (isset($_POST['upload_pic'])) {
    $profile_pic = $_FILES['profile_pic']['name'];
    $file_tmp_name = $_FILES['profile_pic']['tmp_name'];
    $file_size = $_FILES['profile_pic']['size'];
    $file_error = $_FILES['profile_pic']['error'];
    $file_type = $_FILES['profile_pic']['type'];

    $file_ext = explode('.', $profile_pic);
    $file_exists = strtolower(end($file_ext));

    $allowed = ['jpg', 'jpeg', 'png'];
    $pic_user_id = $_SESSION['u_id'];
    $pic_username = $_SESSION['u_username'];

    if (in_array($file_exists, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 500000) {
                $new_file_name = "$pic_username"."$pic_user_id".".".$file_exists;
                $file_destination = '../uploads/'.$new_file_name;
                move_uploaded_file($file_tmp_name, $file_destination);
                $insert_pic = "INSERT INTO profile_pics (profile_pic, tmp_name, user_id) VALUES ('$profile_pic', '$file_tmp_name', '$pic_user_id')";
                mysqli_query($conn, $insert_pic);
                header('location: '.BASE_URL. 'users/profile.php?image_updated&id='.$_SESSION['u_id']);
                exit();
            }
        }
    }
}

$edit_pic = false;
$pic_id = 0;

if (isset($_GET['edit_picture'])) {
    $edit_pic = true;
    $pic_id = $_GET['edit_picture'];

    $get_pic = "SELECT * FROM profile_pics WHERE pic_id = $pic_id LIMIT 1";
    $result = mysqli_query($conn, $get_pic);
    $edit = mysqli_fetch_array($result);
    $profile_pic = $edit['profile_pic'];
}

if (isset($_POST['edit_picture'])) {
    $profile_pic = $_FILES['profile_pic']['name'];
    $file_tmp_name = $_FILES['profile_pic']['tmp_name'];
    $file_size = $_FILES['profile_pic']['size'];
    $file_error = $_FILES['profile_pic']['error'];
    $file_type = $_FILES['profile_pic']['type'];

    $file_ext = explode('.', $profile_pic);
    $file_exists = strtolower(end($file_ext));

    $allowed = ['jpg', 'jpeg', 'png'];
    $pic_user_id = $_SESSION['u_id'];
    $pic_username = $_SESSION['u_username'];

    if (in_array($file_exists, $allowed)) {
        if ($file_error === 0) {
            if ($file_size < 500000) {
                $new_file_name = "$pic_username"."$pic_user_id".".".$file_exists;
                $file_destination = '../uploads/'.$new_file_name;
                move_uploaded_file($file_tmp_name, $file_destination);
                $pic_id = $_POST['pic_id'];
                $update_pic = "UPDATE profile_pics SET profile_pic='$profile_pic', tmp_name='$file_tmp_name' WHERE pic_id=$pic_id";
                mysqli_query($conn, $update_pic);
                header('location: '.BASE_URL. 'users/profile.php?image_updated&id='.$_SESSION['u_id']);
                exit();
            }
        }
    }
}

function getProfilePic()
{
    global $conn;
    $user_id = $_GET['id'];
    $pic_query = "SELECT * FROM profile_pics WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $pic_query);
    return $result;
}

function getUserProfilePicId()
{
    $user_id = getProfilePic();
    if ($user = mysqli_fetch_array($user_id)) {
        $user_pic = $user['user_id'];
        return $user_pic;
    }
}

function getProfilePicId()
{
    $pic_id = getProfilePic();
    if ($i = mysqli_fetch_array($pic_id)) {
        $id = $i['pic_id'];
        return $id;
    }
}

function getEditPicId()
{
    global $conn;
    $pic_id = $_GET['edit_picture'];
    $query = "SELECT * FROM profile_pics WHERE pic_id = '$pic_id'";
    $result = mysqli_query($conn, $query);
    return $result;
}

function getPicUserId()
{
    $user_id = getEditPicId();
    if ($i = mysqli_fetch_array($user_id)) {
        $id = $i['user_id'];
        return $id;
    }
}

// EOF
