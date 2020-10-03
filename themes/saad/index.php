<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home - NASA2020</title>
        <!-- Some Headers here, you can also separate them & then include -->
        <link rel="stylesheet" type="text/css" href="themes/css/styles.css"/>
    </head>
    <body>
        <?php if (!has_posts()) { ?>
            <div>No discussions available</div>
            <?php if ($Error) echo $Error ?>
        <?php } else while (has_post()) { ?>
            <a href="details.php?id=<?= the_id()?>">
                <div class="post">
                    <div class="title">Post title: <?= the_title() ?></div>
                    <div class="name">Post by: <?= the_name() ?></div>
                    <div class="photo">Post author's photo: <?= the_photo() ?></div>
                    <div class="time">Posted at: <?= date("Y-m-d H:i:s", the_time()) ?></div>
                    <div class="id">Post id: <?= the_id() ?></div>
                    <div class="uid">Post uid: <?= the_uid() ?></div>
                    <div class="text">Post data: <br><?= the_text() ?></div>
                    <div class="thumb">Post thumbnail: <?= the_thumb() ?></div>
                </div>
            </a>
            <?php } ?>
            <a href="new.php"><h3>ADD NEW IDEA</h3></a>
    </body>
</html>