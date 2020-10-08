<?php

    include 'config.php';
    include ROOT_PATH . '/inc/header.php';
    include 'functions.php';

?>
<title>CIY Images | Search Results</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container" id="home">
            <div class="body_container">
                <div class="search">
                    <div class="form_search search_border">
                        <form action="search.php" method="get">
                            <input type="search" name="search_input" placeholder="Search" required>
                            <button type="submit" class="btn btn_search btn_full_width" id="search" name="search_site">Search</button>
                        </form>
                    </div>
                </div>
                <div class="gallery">
                <?php // get_search_name() from search_functions.php ?>
                <h2>Search Results for: <?= get_search_name(); ?></h2>
                <div class="search_results">
                    <ul class="front_page">
                    <?php

                        // search_pictures() from search_functions.php
                        $search_results = search_pictures();
                        if (!$search_results || mysqli_num_rows($search_results) == 0): 
                            
                    ?>
                        <p>No Results</p>        
                    <?php    
                        elseif (mysqli_num_rows($search_results) > 0) :
                            while ($row = mysqli_fetch_assoc($search_results)): ?>
                        <li id="clickImg">
                            <a href="#" class="pic_hover" data-url="<?= $row['pid']; ?>" data-gallery="<?= $row['gallery_id']; ?>">
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
                                    <a href="<?= BASE_URL . 'galleries/gallery.php?file_id=' . $row['pid'] . '&gallery_id=' . $row['gallery_id']; ?>">Download</a>
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
                                            <form class="submit_comment" action="galleries/gallery.php?gallery_id=<?= $row['gallery_id']; ?>" method="post">
                                                <input type="hidden" value="<?= $row['pid']; ?>" name="picture_id">
                                                <textarea name="comment_body" class="comment_textarea" cols="30" rows="10" placeholder="Write a comment" required></textarea>
                                                <?php if(isset($_SESSION['is_logged_in'])): ?>
                                                    <button id="comment_btn" class="btn btn_confirm" type="submit" name="submit_comment" data-comment="<?= $row['pid']; ?>">Comment</button>
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
                                                if (!$res || mysqli_num_rows($res) == 0): 

                                            ?>
                                                <p>No Comments</p>
                                                <p>Be the first one to send some love</p>
                                                <?php 

                                                    else:
                                                    while ($p = mysqli_fetch_array($res)):

                                                ?>
                                                <li>
                                                    <div class="comment_list">
                                                        <img src="uploads/<?= $p['username']; echo $p['userID']; ?>" class="grid_row" alt="">
                                                        <p class="bold"><?php echo $p['username']; ?></p>
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
                            </a>
                        </li>
                    <?php 

                        endwhile;    
                        endif;

                    ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </div>

<?php 

include ROOT_PATH . '/inc/footer.php';

// EOF
