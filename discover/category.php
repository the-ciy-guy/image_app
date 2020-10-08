<?php
    
    include '../config.php';
    include ROOT_PATH . '/inc/header.php';
    include '../functions.php';

?>
<?php // getTheCatTitle() from galleries_functions.php ?>
<title>CIY Images | Explore images and galleries in <?php getTheCatTitle(); ?></title>
</head>
<body>
    <div id="main">
        <?php include ROOT_PATH . '/inc/navbar.php'; ?>
        <div class="container">
            <div class="body_container">
                <section class="section_discover">
                    <h2><?php getTheCatTitle(); ?></h2>
                    <div class="front_page">
                    <?php

                        // getCategories() from galleries_functions.php
                        $get_cat = getCategories();
                        $n = 1;
                        while ($cat = mysqli_fetch_array($get_cat)):

                    ?>
                        <ul>
                            <a href="<?= BASE_URL . 'galleries/gallery.php?gallery_id='.$cat['id']; ?>" class="folder_discover img_grid">
                                <ul>
                                <?php

                                    // getPictures() from galleries_functions.php
                                    $cat_gallery = getPictures();
                                    $i = 1;
                                    if (mysqli_num_rows($cat_gallery) == 0): 

                                ?>
                                    <p>No Pictures</p>
                                <?php else: ?>
                                <?php while ($row = mysqli_fetch_array($cat_gallery)): ?>
                                    <li class="disc_grid">
                                        <img src="<?= BASE_URL . 'gallery_pictures/'.$row['picture']; ?>" alt="">
                                    </li>
                                <?php

                                    endwhile;
                                    endif;
                                    $i++;

                                ?>
                                    <div class="meta_discover">
                                        <h3 class="grid_row"><?= $cat['gallery_name']; ?></h3>
                                        <p class="grid_row"><i class="fas fa-images"></i> 
                                            <?php 

                                                global $conn;
                                                $get_gallery = $cat['id'];
                                                $query = "SELECT gallery_id, count(pictures.gallery_id) from pictures join galleries on pictures.gallery_id = galleries.id WHERE gallery_id = $get_gallery GROUP BY gallery_id";
                                                $result = mysqli_query($conn, $query);
                                                $pictures = mysqli_fetch_array($result);
                                                $total = $pictures[1];
                                                echo $total;

                                            ?>
                                        </p>
                                    </div>
                                </ul>
                            </a>
                        </ul>
                    <?php

                        endwhile;
                        $n++;

                    ?>  
                    </div>  
                </section>
            </div>
        </div>
    </div>
    <?php 
    
    include ROOT_PATH . '/inc/footer.php'; 

    // EOF
