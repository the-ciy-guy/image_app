<?php

    if (isset($_POST['upload_picture'])) {
        $pictures = array_filter($_FILES['picture']['name']);
        $target_dir = "../gallery_pictures/";
        $allowed = ['jpg', 'png', 'jpeg', 'gif'];
        $user_id = $_SESSION['u_id'];
        $gidd = $_GET['gallery_id'];

        if (empty($pictures)) {
            header('location: add_picture.php?gallery_id='.$gidd.'&id='.$user_id);
            exit();
        }
        
        if (!empty($pictures)) {
            foreach ($_FILES['picture']['name'] as $key=>$val) {
                $filename = basename($_FILES['picture']['name'][$key]);
                $target_path = $target_dir . $filename;

                $file_type = pathinfo($target_path, PATHINFO_EXTENSION);
                
                if (in_array($file_type, $allowed)) {
                    if (move_uploaded_file($_FILES['picture']['tmp_name'][$key], $target_path)) {
                        $insert .= "('".$filename."','".$gidd."', '".$user_id."', NOW(), NOW()),";
                    } 
                } 
            }
            
            if (!empty($insert)) {
                $insert = trim($insert, ',');
                $insert_query = "INSERT INTO pictures (picture, gallery_id, user_id, updated_at, created_at) VALUES $insert";
                mysqli_query($conn, $insert_query);
                header('location:' .BASE_URL. 'galleries/gallery.php?gallery_id='.$gidd.'&id='.$user_id);
                exit();
            }
        }
    }

    $title = "";
    $pic_thumbnail = "";
    $pic_description = "";
    $picture_id = 0;
    $edit_picture = false;

    if (isset($_GET['edit_id'])) {
        $edit_picture = true;
        $picture_id = $_GET['edit_id'];

        $get_picture = "SELECT * FROM pictures WHERE id = '$picture_id' LIMIT 1";
        $query = mysqli_query($conn, $get_picture);
        $result = mysqli_fetch_array($query);
        $title = $result['title'];
        $pic_thumbnail = $result['thumbnail_description'];
        $pic_description = $result['pic_description'];
    }

    if (isset($_POST['update_picture'])) {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $pic_thumbnail = mysqli_real_escape_string($conn, $_POST['thumbnail_description']);
        $pic_description = mysqli_real_escape_string($conn, $_POST['pic_description']);

        $id = $_GET['edit_id'];
        $gallery_id = $_GET['gallery_id'];
        $update_pic = "UPDATE pictures SET title='$title', thumbnail_description='$pic_thumbnail', pic_description='$pic_description', updated_at=now() WHERE id=$id";
        mysqli_query($conn, $update_pic);
        header('location:'.BASE_URL. 'galleries/gallery.php?picture_updated&gallery_id='.$gallery_id);
        exit();
    }

    function getGalleryPictures()
    {
        global $conn;
        $gallery_id = $_GET['gallery_id'];
        $get_pics = "SELECT *, p.id AS pid from pictures p join users u on p.user_id = u.id where p.gallery_id = '$gallery_id' ORDER BY p.created_at DESC";
        $result = mysqli_query($conn, $get_pics);
        return $result;
    }

    function getGalleryPictureId()
    {
        $gallery = getGalleryPictures();
        if ($g = mysqli_fetch_array($gallery)) {
            $id = $g['pid'];
            return $id;
        }
    }

    function countPictures()
    {
        global $conn;
        $gallery_id = $_GET['gallery_id'];
        $query = "SELECT COUNT(*) FROM pictures WHERE gallery_id = $gallery_id";
        $result = mysqli_query($conn, $query) ;
        $all_pictures = mysqli_fetch_array($result);
        $total = $all_pictures[0];
        return $total;
    }

    function countAllPictures()
    {
        global $conn;
        $user_id = $_GET['id'];
        $query = "SELECT COUNT(*) FROM pictures WHERE user_id = $user_id";
        $result = mysqli_query($conn, $query);
        $pictures = mysqli_fetch_array($result);
        $total = $pictures[0];
        return $total;
    }

    function getUserPictures()
    {
        global $conn;
        $user_id = $_GET['id'];
        $query = "SELECT *, u.id AS uid, p.id AS pid FROM pictures p JOIN users u ON p.user_id = u.id WHERE user_id = $user_id";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function pictures()
    {
        global $conn;
        $query = "SELECT * FROM pictures";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function picturesGalleryId()
    {
        $query = pictures();
        if ($n = mysqli_fetch_array($query)) {
            $gid = $n['gallery_id'];
            return $gid;
        }
    }

    function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }

    // Download pictures
    if (isset($_GET['file_id'])) {
        $id = $_GET['file_id'];
        $gid = $_GET['gallery_id'];
        
        $query = "SELECT * FROM pictures WHERE id = $id";
        $result = mysqli_query($conn , $query);

        $file = mysqli_fetch_assoc($result);
        $path = '../gallery_pictures/' . $file['picture'];

        if (!file_exists($path)) {
            header('location:' .BASE_URL. 'galleries/gallery.php?no_image&gallery_id='.$gid);
            exit();
        }
        
        if (file_exists($path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' .basename($path));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('gallery_pictures/' . $file['picture']));
            readfile('gallery_pictures/' . $file['picture']);
            exit;
        }
    }

    /**
     * Showing pictures on the homepage, currently index.php
     * 
     * It is ordered by the latest uploaded pictures.
     * 
     * @access public
     * @author Johan Borg
     * @global $conn
     * @return object Query
     */
    function allPictures() 
    {
        global $conn;
        $pics_per_page = 100;
        $get_pics = "SELECT *, p.id AS pid FROM pictures p JOIN users u ON p.user_id = u.id ORDER BY p.created_at DESC LIMIT $pics_per_page";
        $result = mysqli_query($conn, $get_pics);
        return $result;
    }

    // EOF
    