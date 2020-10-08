<?php
    
    include 'config.php';
    include ROOT_PATH . '/inc/header.php';
    include 'functions.php';
    
?>
<title>CIY Images | Home</title>
</head>
    </body>
        <div id="main">
            <?php

                include ROOT_PATH . '/inc/navbar.php'; 
                include ROOT_PATH . '/inc/banner.php'; 

            ?>
            <div class="container">
                <div class="body_container">
                    <div class="gallery">
                        <ul class="front_page">
                        <?php
                            // allPictures() from pictures_functions.php
                            $pictures = allPictures();
                            $p = 1;
                            while ($row = mysqli_fetch_array($pictures)): ?>
                            <li class="list_pics" id="clickImg">
                                <a class="pic_hover" href="#" data-url="<?= $row['pid'] ?>" data-gallery="<?= $row['gallery_id'] ?>">
                                    <img src="gallery_pictures/<?= $row['picture']; ?>" alt="" class="img_hover" id="myImg" data-image="<?= $row['pid']; ?>">
                                    <div class="img_hover-meta">
                                        <p class="img_hover-action"><?= $row['username']; ?></p>
                                        <div class="img_hover-action">
                                            <button class="download_btn" data-index="<?= $row['pid']; ?>"><i class="fas fa-file-download"></i></button>
                                        </div>
                                    </div>
                                    <div class="modal" id="downloadModal" data-index="<?= $row['pid']; ?>" data-button="<?= $row['pid']; ?>">
                                        <p id="imgTitle" class="title_name">Title: <?= $row['title']; ?></p>
                                        <p>Creator: <?= $row['username']; ?></p>
                                        <p>Support the creator: Link to paypal or something</p>
                                        <a href="<?= BASE_URL . 'galleries/gallery.php?file_id='.$row['pid'].'&gallery_id='.$row['gallery_id']; ?>">Download</a>
                                        <a href="javascript:void(0)" data-button="<?= $row['pid']; ?>" class="close_btn">Cancel</a>
                                    </div>
                                    <div class="modal testmodal" id="myModal" data-image="<?= $row['pid']; ?>">
                                        <span class="close">&times;</span>
                                        <p>By <?= $row['username']; ?></p><p> <?= $row['thumbnail_description']; ?></p>
                                        <img src="gallery_pictures/<?= $row['picture']; ?>" id="img" class="modal_content">
                                        <div id="caption"><?= $row['pic_description']; ?></div>
                                        <div class="comments">
                                            <h2>Comments</h2>
                                            <div class="form form_comment">
                                                <form action="galleries/gallery.php?gallery_id=<?= $row['gallery_id']; ?>" method="post">
                                                    <input type="hidden" value="<?= $row['pid']; ?>" name="picture_id">
                                                    <textarea name="comment_body" class="comment_textarea" cols="30" rows="10" placeholder="Write a comment" required></textarea>
                                                    <?php // getTheGalleryPicUserId() from galleries_functions.php ?>
                                                    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['u_id'] == getTheGalleryPicUserId()): ?>
                                                        <button class="btn btn_confirm" type="submit" name="submit_comment">Comment</button>
                                                    <?php else: ?>
                                                        <a class="btn btn_confirm" href="login.php">Login To Comment</a>   
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
                                                    <img src="static/img/profile_man_beard.jpg" class="grid_row" alt="">
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
                            </a>
                            </li>
                        <?php

                            $p++;
                            endwhile;

                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <?php 
        
        include ROOT_PATH . '/inc/footer.php';

        // EOF
        