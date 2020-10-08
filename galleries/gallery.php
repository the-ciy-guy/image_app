<?php

    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<?php // getTheGalleryName() from galleries_functions.php ?>
<title>CIY Images | <?= getTheGalleryName(); ?></title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container" id="home">
            <div class="body_container">
                <div class="gallery">
                    <h2><?= getTheGalleryName(); ?></h2>
                    <?php // getTheGalleryDescription() from galleries_functions.php ?>
                    <p><?= getTheGalleryDescription(); ?></p>
                    <?php // countPictures() from pictures_functions.php. getTheGalleryPicUserId() and getTheGalleryUsername() from galleries_functions.php ?>
                    <p><span><?= countPictures(); ?> photos</span><span><a href="<?= BASE_URL . 'users/profile.php?id='. getTheGalleryPicUserId(); ?>"> <img class="pic_mini" src="../uploads/<?= getTheGalleryUsername(); echo getTheGalleryPicUserId(); ?>" alt=""> by <?= getTheGalleryUsername(); ?></a></span></p>
                    <?php if (isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getTheGalleryPicUserId()): ?>
                    <div class="section_btns">
                        <button class="btn btn_edit" onclick="window.location.href='<?= BASE_URL . 'galleries/create_gallery.php?id='. getTheGalleryPicUserId() .'&gallery_id='.$_GET['gallery_id']; ?>'">Edit Gallery</button>
                        <button class="btn btn_edit" onclick="window.location.href='<?= BASE_URL . 'galleries/add_picture.php?id='. getTheGalleryPicUserId().'&gallery_id='.$_GET['gallery_id']; ?>'">Add Pictures</button>
                        <button class="btn btn_delete" onclick="window.location.href='<?= BASE_URL . 'galleries/gallery.php?delete_gallery='.$_GET['gallery_id']; ?>'">Delete Gallery</button>
                        <button class="btn btn_edit" onclick="window.location.href='<?= BASE_URL . 'galleries/galleries.php?id='. getTheGalleryPicUserId(); ?>'">Back to all galleries</button>
                    </div>
                    <?php 
                        endif; 
                    ?>
                    <ul class="gallery_grid">
                    <?php
                        // getGalleryPictures from pictures_functions.php
                        $pictures = getGalleryPictures();
                        $i = 1;
                        if (!$pictures || mysqli_num_rows($pictures) == 0): ?>
                            <p>No Pictures</p>
                    <?php else: ?>
                    <?php while ($row = mysqli_fetch_array($pictures)): ?>
                        <li id="clickImg">
                            <a class="pic_hover" href="#" data-url="<?= $row['pid']; ?>" data-gallery="<?= $row['gallery_id']; ?>">
                                <img src="../gallery_pictures/<?= $row['picture']; ?>" class="img_hover" id="myImg" alt="" data-image="<?= $row['pid']; ?>">
                                <div class="img_hover-meta">
                                    <p class="img_hover-action"><?= $row['username']; ?></p>
                                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == $row['user_id']): ?>
                                    <button class="btn btn_edit img_hover-action" onclick="window.location.href='<?= BASE_URL . 'galleries/add_picture.php?edit_id='.$row['pid'].'&gallery_id='.$row['gallery_id']; ?>'">Edit Picture</button>
                                <?php else: ?>   
                                    <div class="img_hover-action">
                                        <button class="download_btn" data-index="<?= $row['pid']; ?>"><i class="fas fa-file-download"></i></button>
                                    </div>
                                <?php endif; ?>
                                </div>
                                <div class="modal" id="downloadModal" data-index="<?= $row['pid']; ?>" data-button="<?= $row['pid']; ?>">
                                    <p id="imgTitle" class="title_name">Title: <?= $row['title']; ?></p>
                                    <p>Creator: <?= $row['username']; ?></p>
                                    <p>Support the creator: Link to paypal or something</p>
                                    <a class="btn btn_download" href="<?= BASE_URL . 'galleries/gallery.php?file_id=' . $row['pid'] . '&gallery_id=' . $row['gallery_id']; ?>">Download</a>
                                    <a href="javascript:void(0)" data-button="<?= $row['pid']; ?>" class="btn close_btn">Cancel</a>
                                </div>
                                <div class="modal testmodal" id="myModal" data-image="<?= $row['pid']; ?>">
                                    <span class="close">&times;</span>
                                                      
                                    <p>By <?= $row['username']; ?></p><p> <?= $row['thumbnail_description']; ?></p>
                                    <img src="../gallery_pictures/<?= $row['picture']; ?>" id="img" class="modal_content">
                                    <div id="caption"><?= $row['pic_description']; ?></div>
                                    <div class="comments">
                                        <h2>Comments</h2>
                                        <div class="form form_comment">
                                            <form class="submit_comment" action="../galleries/gallery.php?gallery_id=<?= $row['gallery_id']; ?>" method="post">
                                                <input type="hidden" value="<?= $row['pid']; ?>" name="picture_id">
                                                <textarea name="comment_body" class="comment_textarea" cols="30" rows="10" placeholder="Write a comment" required></textarea>
                                                <?php if(isset($_SESSION['is_logged_in'])): ?>
                                                    <button id="comment_btn" class="btn btn_confirm" type="submit" name="submit_comment" data-comment="<?= $row['pid']; ?>">Comment</button>
                                                <?php else: ?>
                                                    <a class="btn btn_confirm" href="../login.php">Login To Comment</a>   
                                                <?php endif; ?>     
                                            </form>
                                        </div>
                                        <div>
                                            <ul>
                                            <?php
                                                $pid = $row['pid'];
                                                global $conn;
                                                $sql = "SELECT *, comments.created_at AS comcreate FROM comments JOIN users ON comments.userID = users.id WHERE picID = '$pid' ORDER BY comcreate DESC";
                                                $res = mysqli_query($conn, $sql);
                                                if (!$res || mysqli_num_rows($res) == 0): ?>
                                                    <p>No Comments</p>
                                                    <p>Be the first one to send some love</p>
                                                <?php 
                                                    else:
                                                    while ($p = mysqli_fetch_array($res)):
                                                ?>
                                                <li>
                                                    <div class="comment_list">
                                                        <img src="../uploads/<?= $p['username']; echo $p['userID']; ?>" class="grid_row" alt="">
                                                        <p class="bold"><?= $p['username']; ?></p>
                                                    </div>
                                                    <p><?= $p['comment']; ?></p>
                                                    <p><?= $p['comcreate']; ?></p>
                                                </li>
                                            <?php 
                                                endwhile;
                                            endif;
                                            ?>        
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <p><?= $row['pic_description']; ?></p>
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
    </div>
    <?php include ROOT_PATH . '/inc/footer.php';

    // EOF
