<?php
function url_dasar()
{
    //$SERVER['SERVER_NAME'] : alamat website, misalkan web-smpit.com
    // $SERVER ['SCRIPT_NAME'] : directory website, websitemu.com/blog/ $SERVER['SCRIPT_NAME'] : blog
    $url_dasar = "http://" . $_SERVER['SERVER_NAME'] . dirname ($_SERVER['SCRIPT_NAME']);
    return $url_dasar;
}