<?php 

    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<title>CIY Images | Upload Profile Picture</title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <form action="profile_picture.php" method="post" enctype="multipart/form-data">
                        <?php if ($edit_pic === true): ?>
                            <input type="hidden" name="id" value="<?= $pic_id; ?>">
                            <h2>Change Profile Picture</h2>
                            <input type="file" name="profile_pic" value="<?= $profile_pic; ?>">
                            <button type="submit" name="edit_picture" class="btn btn_create">Change Picture</button>
                            <button type="button" class="btn btn_delete" onclick="window.location.href='<?= BASE_URL . 'users/profile.php?id='.getPicUserId(); ?>'">Cancel</button>
                        <?php else: ?>    
                            <h2>Upload Profile Picture</h2>
                            <input type="file" name="profile_pic">
                            <button type="submit" name="upload_pic" class="btn btn_create">Upload Picture</button>
                        <?php endif; ?>  
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include ROOT_PATH . '/inc/footer.php';

    // EOF
