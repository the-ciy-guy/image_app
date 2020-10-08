<?php 
    
    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<?php // getLoggedInUserName() from users_function.php ?>
<title>CIY Images | <?= getLoggedInUserName(); ?>'s Galleries</title>
</head>
</body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <h2><?= getLoggedInUserName(); ?>'s Galleries</h2>
                <?php // countGalleries() from galleries_functions.php, getLoggedInUserId from users_function.php ?>
                <p class="margin_bottom"><span><?= countGalleries(); ?> galleries</span><span><a href="<?= BASE_URL . 'users/profile.php?id='.getLoggedInUserId(); ?>"> 
                    <?php // getUserProfilePicId() from users_function.php ?>
                    <?php if (getUserProfilePicId()): ?>
                        <img class="pic_mini" src="../uploads/<?= getLoggedInUserName(); echo getUserProfilePicId(); ?>" alt=""> <?= getLoggedInUserName(); ?>
                    <?php else: ?>   
                        <img src="../static/img/profile.png" alt="">
                    <?php endif; ?>
                </a></span></p>
                <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getLoggedInUserId()): ?>
                    <div class="section_btns">
                        <button class="btn btn_create" onclick="window.location.href='<?= BASE_URL . 'galleries/create_gallery.php?id='.getLoggedInUserId(); ?>'">Create Gallery</button>
                    </div>
                <?php endif; ?>
                <ul class="gallery_grid">
                <?php
                    // getAllUserGalleries() from galleries_functions.php
                    $galleries = getAllUserGalleries();
                    $i = 1;
                    if (mysqli_num_rows($galleries) == 0): ?>
                        <p>No Galleries</p>
                    <?php else: ?>
                    <?php while ($row = mysqli_fetch_array($galleries)):
                ?>
                    <li>
                        <a href="<?= BASE_URL . 'galleries/gallery.php?gallery_id='.$row['id']; ?>">
                            <div class="img_folder">
                                <img src="<?= BASE_URL . 'gallery_thumbnails/'.$row['gallery_thumbnail']; ?>" alt="">
                                <p class="margin_bottom"><?= $row['gallery_name']; ?></p>
                                <p class="margin_bottom"><?= $row['gallery_desc'] ?></p>
                            </div>
                        </a>
                        <a class="borders" href="<?= BASE_URL . 'discover/category.php?category='.$row['gallery_category']; ?>"><?= $row['gallery_category']; ?></a>
                    </li>
                <?php
                    $i++;
                    endwhile;
                    endif;
                ?>
                </ul>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/inc/footer.php';

    // EOF
