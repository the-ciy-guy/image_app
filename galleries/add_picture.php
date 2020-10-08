<?php

    include '../config.php';
    include '../functions.php';
    include ROOT_PATH . '/inc/header.php';

?>
<title>CIY Images | Add Pictures</title>
</head>
</body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <div class="form">
                    <?php if ($edit_picture === true): ?>
                        <h2>Edit Pictures</h2>
                    <?php else: ?>
                        <h2>Add Pictures</h2>
                    <?php endif; ?>
                    <form action="" method="post" enctype="multipart/form-data">
                        <?php if ($edit_picture === true): ?>
                            <input type="hidden" name="edit_id" value="<?= $picture_id; ?>">
                            <input type="text" name="title" placeholder="Add a title" value="<?= $title; ?>">
                            <input type="text" name="thumbnail_description" placeholder="Add a short description" value="<?= $pic_thumbnail; ?>">
                            <textarea name="pic_description" class="gallery_textarea"><?= $pic_description; ?></textarea>
                            <button type="submit" class="btn btn_create" name="update_picture">Update</button>
                            <?php // getTheGalleryId() from galleries_functions.php ?>
                            <button type="button" class="btn btn_delete" onclick="window.location.href='<?= BASE_URL . 'galleries/gallery.php?gallery_id=' . getTheGalleryId(); ?>'">Cancel</button>
                        <?php else: ?>
                            <input type="file" name="picture[]" id="" multiple>
                            <button type="submit" name="upload_picture" class="btn btn_create">Upload</button>
                            <button type="button" class="btn btn_delete"onclick="window.location.href='<?= BASE_URL . 'galleries/gallery.php?gallery_id=' . getTheGalleryId(); ?>'">Cancel</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include ROOT_PATH . '/inc/footer.php';

    // EOF
