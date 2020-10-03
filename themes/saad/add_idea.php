<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Home - NASA2020</title>
        <!-- Some Headers here, you can also separate them & then include -->
    </head>
    <body>
        <?php
        if(has_msg()){
            if(the_error()){
                echo '<div class="error">'. the_error().'</div>';
            }else echo '<div class="success">Idea added successfully! <a href="details.php?id='. the_id().'">Click here to browse</a></div>';
        }
        ?>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="new"/><!-- For indication that data is posted -->
            <input type="text" name="title" placeholder="Title">
            <textarea name="text" placeholder="Description of idea">
                
            </textarea>
            <input type="file" name="thumb">
            <input type="submit"/>
        </form>
    </body>
</html>