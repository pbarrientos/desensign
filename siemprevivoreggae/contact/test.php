<?php print_r($_FILES);?>

<form action="" method="post" enctype="multipart/form-data">
    <div>
        <label for="subject">Subject</label>
        <input type="text" name="subject" />
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" />
    </div>
    <input type="submit" value="Send" />
</form>