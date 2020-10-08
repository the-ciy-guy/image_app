<?php
    
    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';
    
?>
<?php // getLoggedInUserName() from users_function.php ?>
<title>CIY Images | <?= getLoggedInUserName(); ?>'s profile</title>
</head>
    </body>
        <div id="main">
            <?php include ROOT_PATH . '/inc/navbar.php'; ?>
            <div class="container">
                <div class="body_container">
                    <section class="user_header">
                        <div class="user_img">
                            <?php // getUserProfilePicId() and getUserProfilePicId from users_function.php ?>
                            <?php if (getUserProfilePicId()): ?>
                                <img src="../uploads/<?= getLoggedInUserName(); echo getUserProfilePicId(); ?>" alt="">
                            <?php else: ?>   
                            <img src="../static/img/profile.png" alt="">
                            <?php endif; ?>

                            <?php // getUserLoggedInId() and getProfilePicId() from users_function.php ?>
                            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getLoggedInUserId()): ?>
                                <?php if (!getProfilePicId()): ?>
                                    <button class="btn btn_edit" onclick="window.location.href='<?= BASE_URL . 'users/profile_picture.php?id='.getLoggedInUserId(); ?>'">Upload Profile Image</button>
                                <?php elseif (getProfilePicId()): ?>
                                    <button class="btn btn_edit" onclick="window.location.href='<?= BASE_URL . 'users/profile_picture.php?edit_picture='.getProfilePicId(); ?>'">Change Profile Image</button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="user_info">
                            <h3><?= getLoggedInUserName(); ?></h3>
                            <?php // userSignupDate() from users_function.php ?>
                            <p>Member since: <?= userSignupDate(); ?></p>
                            <?php // getLoggedInUserDescription() from users_function.php ?>
                            <p><?= getLoggedInUserDescription(); ?></p>
                            <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getLoggedInUserId()): ?>
                                <button class="btn btn_edit" id="btn_profile_update" onclick="window.location.href='<?= BASE_URL . 'users/edit_profile.php?id='.$_SESSION['u_id']; ?>'">Update</button>
                            <?php endif; ?>
                        </div>
                    </section>
                    <section class="user_stats">
                        <div class="box_user">
                            <h2>Galleries</h2>
                            <?php // countGalleries() from galleries_functions.php ?>
                            <p><?= countGalleries(); ?> galleries</p>
                            <button class="btn btn_create" onclick="window.location.href='<?= BASE_URL . 'galleries/galleries.php?id='.getLoggedInUserId(); ?>'">Go to Galleries</button>
                        </div>
                        <div class="box_user">
                            <h2>Pictures</h2>
                            <?php // countAllPictures() from pictures_functions.php ?>
                            <p><?= countAllPictures(); ?> pictures</p>
                            <button class="btn btn_create" onclick="window.location.href='<?= BASE_URL . 'galleries/pictures.php?id='.getLoggedInUserId(); ?>'">See all Photos</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <?php include ROOT_PATH . '/inc/footer.php';

        // EOM
