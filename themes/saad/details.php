<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home - NASA2020</title>
        <!-- Some Headers here, you can also separate them & then include -->
        <link rel="stylesheet" type="text/css" href="themes/css/styles.css"/>
    </head>
    <body>
        <?php
        if (!is_post()) {
            echo $Error;
        } else {
            ?>
            <div class="post-main">
                Title: <?= the_title() ?><br/>
                Name: <?= the_name() ?><br/>
                Photo: <?= the_photo() ?><br/>
                Uid: <?= the_uid() ?><br/>
                Username: <?= the_username() ?><br/>
                Thumbnail: <?= the_thumb() ?><br/>
                Time: <?= the_time() ?><br/>
                Text: <?= the_text() ?><br/>
            </div>
            <div class="comms">
                <?php
                if (!has_cmms()) {
                    if ($Error) {
                        echo $Error;
                    } else {
                        echo 'No comments available..';
                    }
                } else while (has_cmm()) {
                        ?>
                        <div  class="cmm">
                            Name: <?= the_name() ?><br/>
                            Photo: <?= the_photo() ?><br/>
                            Uid: <?= the_uid() ?><br/>
                            Username: <?= the_username() ?><br/>
                            Replies: <?= sub_count() ?><br/>
                            Time: <?= the_time() ?><br/>
                            Text: <?= the_text() ?><br/>
                        </div>
                        <?php
                    }
                ?>
            </div>
            <?php
        }
        ?>
        <div class="cmm-ar">
            <?php
            if(is_logged()){
                ?>
            <?php
            if(has_msg()){
                if(the_error()){
                    echo the_error();
                }else{
                    echo '<div class="ok">Comment added!!</div>';
                }
            }
            ?>
            <form method="post">
                <textarea name="text" placeholder="Your comment"></textarea>
                <input type="hidden" name="dis" value="<?= $_GET["id"]?>"/>
                <input type="submit"/>
            </form>
            <?php
            }else{
                echo 'Commenting is only for registered users';
            }
            ?>
        </div>
    </body>
</html>