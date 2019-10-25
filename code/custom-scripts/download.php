<?php

$a = 'https://dl.dropboxusercontent.com/s/ahkl5xi95bl2khd/SPPS_TR_RDCR4.main.jpg';

function save_image($inPath, $outPath)
{ //Download images from remote server
    $in=    fopen($inPath, "rb");
    $out=   fopen($outPath, "wb");
    while ($chunk = fread($in,8192))
    {
        fwrite($out, $chunk, 8192);
    }
    fclose($in);
    fclose($out);
}

save_image($a,'image.jpg');
