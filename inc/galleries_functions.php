<?php
    $gallery_name = "";
    $gallery_desc = "";
    $gallery_cat = "";
    $gallery_thumbnail = "";
    $gallery_id = 0;

    if (isset($_POST['create_gallery'])) {
        $gallery_name = mysqli_real_escape_string($conn, $_POST['gallery_name']);
        $gallery_desc = mysqli_real_escape_string($conn, $_POST['gallery_desc']);
        $gallery_cat = mysqli_real_escape_string($conn, $_POST['gallery_category']);

        $gallery_thumbnail = $_FILES['gallery_thumbnail']['name'];
        $target_dir = "../gallery_thumbnails/";
        $target_file = $target_dir . basename($_FILES['gallery_thumbnail']['name']);

        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = ["jpg", "jpeg", "png"];

        if (empty($gallery_name) || empty($gallery_cat)) {
            header('location: create_gallery.php?gallery=fields_empty&'.$gallery_name.'&category='.$gallery_cat);
            exit();
        } 
        if (in_array($image_file_type, $extensions_arr)) {
            $user_id = $_SESSION['u_id'];
            $insert_gallery = "INSERT INTO galleries (gallery_name, gallery_desc, gallery_category, user_id, updated_at, created_at, gallery_thumbnail) VALUES ('$gallery_name', '$gallery_desc', '$gallery_cat', '$user_id', now(), now(), '$gallery_thumbnail')";
            mysqli_query($conn, $insert_gallery);
            move_uploaded_file($_FILES['gallery_thumbnail']['tmp_name'], $target_dir.$gallery_thumbnail);
            header('location:' .BASE_URL. 'galleries/galleries.php?gallery_created&id='.$user_id);
            exit();
        }
    }

    $edit_gallery = false;

    if (isset($_GET['gallery_id'])) {
        $edit_gallery = true;
        $gallery_id = $_GET['gallery_id'];

        $get_gallery = "SELECT * FROM galleries WHERE id = '$gallery_id' LIMIT 1";
        $result = mysqli_query($conn, $get_gallery);
        $edit = mysqli_fetch_array($result);
        $gallery_name = $edit['gallery_name'];
        $gallery_desc = $edit['gallery_desc'];
        $gallery_cat = $edit['gallery_category'];
        $gallery_thumbnail = $edit['gallery_thumbnail'];
    }

    if (isset($_POST['update_gallery'])) {
        $gallery_name = mysqli_real_escape_string($conn, $_POST['gallery_name']);
        $gallery_desc = mysqli_real_escape_string($conn, $_POST['gallery_desc']);
        $gallery_cat = mysqli_real_escape_string($conn, $_POST['gallery_category']);

        $gallery_thumbnail = $_FILES['gallery_thumbnail']['name'];
        $target_dir = "../gallery_thumbnails/";
        $target_file = $target_dir . basename($_FILES['gallery_thumbnail']['name']);

        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $extensions_arr = ["jpg", "jpeg", "png", "gif"];

        if (empty($gallery_name) || empty($gallery_cat)) {
            header('location: create_gallery.php?gallery=fields_empty&'.$gallery_name.'&category='.$gallery_cat);
            exit();
        } 
        if (in_array($image_file_type, $extensions_arr)) {
            $gallery_id = $_POST['gallery_id'];
            $user_id = $_SESSION['u_id'];
            $update_gallery = "UPDATE galleries SET gallery_name='$gallery_name', gallery_desc='$gallery_desc', gallery_category='$gallery_cat', updated_at=now(), gallery_thumbnail='$gallery_thumbnail' WHERE id='$gallery_id'";
            mysqli_query($conn, $update_gallery);
            move_uploaded_file($_FILES['gallery_thumbnail']['tmp_name'], $target_dir.$gallery_thumbnail);
            header('location:' .BASE_URL. 'galleries/gallery.php?gallery_created&gallery_id='.$gallery_id.'&id='.$user_id);
            exit();
        }
    }

    if (!isset($_GET['delete_gallery'])) {
        return;
        $user_id = $_SESSION['u_id'];
        header('location: '.BASE_URL. 'galleries/galleries.php?id='.$user_id);
        exit();
    }

    if (isset($_GET['delete_gallery'])) {
        $gallery_id = $_GET['delete_gallery'];
        $user_id = $_SESSION['u_id'];
        $get_gallery = "DELETE galleries, pictures FROM galleries INNER JOIN pictures ON galleries.id = pictures.gallery_id WHERE galleries.id='$gallery_id'";
        if (!mysqli_query($conn, $get_gallery)) {
            header('location: ' .BASE_URL. 'galleries/galleries.php?error_when_deleting&id='.$user_id);
            exit();
        } else {
            header('location: '.BASE_URL. 'galleries/galleries.php?gallery_deleted&id='.$user_id);
            exit();
        }
    }
    
    function getAllUserGalleries()
    {
        global $conn;
        $user_id = $_GET['id'];
        $get_galleries = "SELECT * FROM galleries WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $get_galleries);
        return $result;
    }

    function getTheGallery()
    {
        global $conn;
        $gallery_id = $_GET['gallery_id'];
        $get_gallery = "SELECT *, galleries.id AS gid FROM galleries INNER JOIN users ON galleries.user_id = users.id INNER JOIN profile_pics ON galleries.user_id WHERE galleries.id = '$gallery_id'";

        if (!$get_gallery) {
            echo 'Could not run query: ' . mysqli_error();
            exit();
        }
        $result = mysqli_query($conn, $get_gallery);
        return $result;
    }

    function getTheGalleryName()
    {
        $result = getTheGallery();
        if ($n = mysqli_fetch_array($result)) {
            $g_name = $n['gallery_name'];
            return $g_name;
        }
    }

    function getTheGalleryDescription()
    {
        $result = getTheGallery();
        if ($n = mysqli_fetch_array($result)) {
            $g_desc = $n['gallery_desc'];
            return $g_desc;
        }
    }

    function getTheGalleryUsername()
    {
        $result = getTheGallery();
        if ($n = mysqli_fetch_array($result)) {
            $user_pic = $n['username'];
            return $user_pic;
        }
    }

    function getTheGalleryPicUserId()
    {
        $result = getTheGallery();
        if ($n = mysqli_fetch_array($result)) {
            $pic_id = $n['id'];
            return $pic_id;
        }
    }

    function getTheGalleryId()
    {
        $result = getTheGallery();
        if ($n = mysqli_fetch_array($result)) {
            $gid = $n['gid'];
            return $gid;
        }
    }

    function countGalleries()
    {
        global $conn;
        $userid = $_GET['id'];
        $query = "SELECT COUNT(*) FROM galleries WHERE user_id = $userid";
        $result = mysqli_query($conn, $query);
        $all_galleries = mysqli_fetch_array($result);
        $total = $all_galleries[0];
        return $total;
    }

    function galleriesLatest()
    {
        global $conn;
        $query = "SELECT * FROM galleries ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function totalPicsGallery()
    {
        global $conn;
        $query = "SELECT gallery_id, count(pictures.id), pictures.id as pid from pictures join galleries on pictures.gallery_id = galleries.id GROUP BY gallery_id";
        $result = mysqli_query($conn, $query);
        $pictures = mysqli_fetch_array($result);
        $total = $pictures[1];
        return $total;
    }

    function categoryGallery()
    {
        $query = galleriesLatest();
        if ($n = mysqli_fetch_array($query)) {
            $cat = $n['gallery_category'];
            return $cat;
        }
    }

    function getCategoryTopics()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'Folks' OR gallery_category = 'People' LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getDrinksCatGalleries()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'summer' OR gallery_category = 'beer' OR gallery_category = 'wine' LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getFoodsCatGalleryOne()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'meat' ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getFoodsCatGalleryTwo()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'chicken' ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getFoodsCatGalleryThree()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'amazing vegetables' ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getTravelCatGalleriesOne()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'adventure' ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getTravelCatGalleriesTwo()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'beach' ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    function getTravelCatGalleriesThree()
    {
        global $conn;
        $query = "SELECT * FROM galleries WHERE gallery_category = 'nature' ORDER BY created_at DESC LIMIT 5";
        $result = mysqli_query($conn, $query);
        return $result;
    }

    // Galleries on the category page discover/category.php
    
    // Get the category name in the title
    function getCategories()
    {
        global $conn;
        $catName = $_GET['category'];
        $get_category = "SELECT * FROM galleries WHERE gallery_category = '$catName'";
        if (!$get_category) {
        echo 'Could not run query: ' . mysqli_error();
        exit();
    }
        $result = mysqli_query($conn, $get_category);
        return $result;
    }

    function getTheCatTitle()
    {
        $result = getCategories();
        if ($name = mysqli_fetch_array($result)) {
            $cat_name = $name['gallery_category'];
            echo $cat_name;
        }
    }

    function getGalleryName()
    {
        $result = getCategories();
        if ($name = mysqli_fetch_array($result)) {
            $gall_name = $name['gallery_name'];
            echo $gall_name;
        }
    }

    // Get the pictures in a gallery
    function getPictures()
    {
        global $conn;
        $get_gallery = $_GET['category'];
        $pictures = "SELECT * FROM pictures INNER JOIN galleries ON pictures.gallery_id = galleries.id WHERE galleries.gallery_category = '$get_gallery'";
        $result = mysqli_query($conn, $pictures);
        return $result;
    }

    function getThePictures()
    {
        $result = getPictures();
        if ($i = mysqli_fetch_array($result)) {
            $pics = $i['picture'];
            return $pics;
        }
    }
    
    function pictureJson()
    {
        $url = 'http://localhost/phpsandbox/php-con-to-pro/image_app/json.php';
        $response = file_get_contents($url);
        $pictures = json_decode($response, true);
        return $pictures;
    }

    // EOF
    