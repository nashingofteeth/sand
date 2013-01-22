<?php

if ($handle = opendir('/var/www/instabin/s')) {

    /* This is the correct way to loop over the directory. */
    while (false !== ($entry = readdir($handle))) {
        echo "<a href='http://mtthw.me/instabin/s/$entry'>$entry\n</a><br>";
    }

    closedir($handle);
}
?>
