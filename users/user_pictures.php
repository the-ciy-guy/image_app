<?php

    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<title>CIY Images | All of <?php echo getLoggedInUserName(); ?>'s images</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="gallery">
                    <?php // getLoggedInUserName() from users_function.php ?>
                    <h2><?= getLoggedInUserName(); ?>'s images</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At delectus dolor ad? Odio, sunt quos?</p>
                    <p><span>74 photos</span><span><a href="#"> <img class="pic_mini" src="../static/img/profile_woman.jpg" alt=""> by <?= getLoggedInUserName(); ?></a></span></p>
                    <ul>
                        <li>
                            <a class="pic_hover" href="#">
                                <img src="../static/img/map_and_car.jpg" class="img_hover" id="myImg" alt="">
                                <div class="img_hover-meta">
                                    <p class="img_hover-action">Username</p>
                                    <div class="img_hover-action">
                                        <i class="fas fa-file-download"></i>
                                        <i class="far fa-heart"></i>
                                        <i class="fas fa-folder-plus"></i>
                                    </div>
                                </div>
                                <div class="modal" id="myModal">
                                    <span class="close">&times;</span>
                                    <p>By Username</p><p> Thumbnail text here</p>
                                    <img id="img" class="modal_content">
                                    <div id="caption">Description here</div>
                                    <div class="comments">
                                        <h2>Comments</h2>
                                        <div class="form form_comment">
                                            <form action="">
                                                <textarea name="comment" class="comment_textarea" cols="30" rows="10" placeholder="Write a comment"></textarea>
                                                <button class="btn btn_confirm" type="submit">Comment</button>
                                            </form>
                                        </div>
                                        <div>
                                            <ul>
                                                <li>
                                                    <div class="comment_list">
                                                        <img src="../static/img/profile_man_beard.jpg" class="grid_row" alt="">
                                                        <p class="bold">Username</p>
                                                    </div>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam enim expedita, fugit fuga rerum neque eveniet odio perspiciatis quos voluptatibus.</p>
                                                    <p>July 6 2020</p>
                                                </li>
                                                <li>
                                                    <div class="comment_list">
                                                        <img src="../static/img/profile_man_beard.jpg" class="grid_row" alt="">
                                                        <p class="bold">Username</p>
                                                    </div>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Aliquam enim expedita, fugit fuga rerum neque eveniet odio perspiciatis quos voluptatibus.</p>
                                                    <p>July 6 2020</p>
                                                </li>
                                            </ul>
                                            
                                        </div>
                                        
                                    </div>
                                </div>
                            </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, officia?</p>
                        </li>
                        <li>
                            <a class="pic_hover" href="#">
                                <img src="../static/img/map_and_car.jpg" alt="">
                            </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, officia?</p>
                        </li>
                        <li>
                            <a class="pic_hover" href="#">
                                <img src="../static/img/map_and_car.jpg" alt="">
                            </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, officia?</p>
                        </li>
                        <li>
                            <a class="pic_hover" href="#">
                                <img src="../static/img/map_and_car.jpg" alt="">
                            </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, officia?</p>
                        </li>
                        <li>
                            <a class="pic_hover" href="#">
                                <img src="../static/img/map_and_car.jpg" alt="">
                            </a>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, officia?</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/inc/footer.php';

    // EOF
    