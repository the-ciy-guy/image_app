<?php

    $comment_body = "";

    if (isset($_POST['submit_comment'])) {
        $comment_body = mysqli_real_escape_string($conn, $_POST['comment_body']);

        $gallery_id = $_GET['gallery_id'];
        if (empty($comment_body)) {
            header('location: '.BASE_URL. 'galleries/gallery.php?gallery_id='.$gallery_id);
            exit();
        }

        $user_id = $_SESSION['u_id'];
        $pic_id = $_REQUEST['picture_id'];
        $insert_comment = "INSERT INTO comments (comment, userID, picID, created_at) VALUE ('$comment_body', $user_id, $pic_id, now())";
        $result = mysqli_query($conn, $insert_comment);
        
        if (!$result) {
            header('location:' . BASE_URL . 'galleries/gallery.php?comment_not_posted&gallery_id=' . $gallery_id);
            exit();
        } 
        if ($result) {
            header('location:' . BASE_URL . 'galleries/gallery.php?comment_successfully_posted&gallery_id=' . $gallery_id);
            exit();
        }
    }

    /**
     * Get comments for a particular user from comments
     * 
     * Use this to get comments from a specific user to be
     * used on the website.
     * 
     * @access public
     * @author Johan Borg
     * @global object $conn
     */
    function get_user_comment()
    {
        global $conn;
        $user_id = $_GET['id'];
        $get_comment = "SELECT * FROM comments WHERE userID = '$user_id' ORDER BY created_at DESC LIMIT 1";
        $query_db = mysqli_query($conn, $get_comment);
        return $query_db;
    }

    /**
     * Display the latest comment from a user on dashboard.php. 
     * 
     * @access public
     * @author Johan Borg
     * @param get_user_comment()
     */
    function show_user_comment() {
        $comment = get_user_comment();
        if ($comments = mysqli_fetch_array($comment)) {
            $com = $comments['comment'];
            return $com;
        }
    }

    // EOF
