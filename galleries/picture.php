<?php
    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';
?>
<title>CIY Images | Picture</title>
</head>
</body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="single_picture">
                    <div class="meta">
                        <p><span><a href="#"> <img class="pic_mini" src="../static/img/profile_woman.jpg" alt=""> Username</a></span></p>
                    </div>
                    <img src="../static/img/person-s-feet-2425664.jpg" alt="">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis, officia?</p>
                    <div class="comments">
                        <p><span><a href="#"> <img class="pic_mini" src="../static/img/profile_woman.jpg" alt=""> Username</a></span></p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia totam eos magnam inventore. Quia cupiditate perferendis itaque quam ab eaque?</p>
                        <p class="datetime">March 20</p>
                    </div>
                    <div class="form">
                        <form action="picture.php">
                            <textarea name="comments" placeholder="Comment"></textarea>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/inc/footer.php';
