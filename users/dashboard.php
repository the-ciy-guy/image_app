<?php

    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<title>CIY Images | <?= $_SESSION['u_username']; ?></title>
</head>
    </body>
        <div id="main">
            <?php include ROOT_PATH . '/inc/navbar.php'; ?>
            <div class="container">
                <div class="body_container">
                <?php // getLoggedInUserId() from users_function.php ?>
                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getLoggedInUserId()): ?>
                        <section class="left">
                            <div class="box_user">
                                <div class="comment_overview">
                                    <?php // getLoggedInUserName() from users_function.php ?>
                                    <img src="../uploads/<?= getLoggedInUserName(); echo getLoggedInUserId(); ?>" class="grid_row" alt="">
                                    <p class="bold left"><?= getLoggedInUserName(); ?></p>
                                </div>
                                <h2>Latest Comment</h2>
                                <?php // show_user_comment() from comments_functions.php ?>
                                <p>"<?= show_user_comment(); ?>"</p>
                            </div>
                            <div class="box_user">
                                <h2>Create Gallery</h2>
                                <button class="btn btn_create" onclick="window.location.href='<?= BASE_URL . 'galleries/create_gallery.php?id=' . getLoggedInUserId(); ?>'">Create Gallery</button>
                            </div>
                        </section>
                        <section class="right">
                            <div class="box_user">
                                <h2>Edit Your Credentials</h2>
                                <button class="btn btn_edit" id="btn_profile_update" onclick="window.location.href='<?= BASE_URL . 'users/edit_profile.php?id=' . $_SESSION['u_id']; ?>'">Edit Credentials</button>
                            </div>
                        </section>
                    <?php 
                    else:
                        header('location: ../login.php?please_login');
                        exit();
                    endif;
                    ?>
                </div>
            </div>
        </div>
        <?php include ROOT_PATH . '/inc/footer.php';

        // EOM
