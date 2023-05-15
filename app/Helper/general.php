<?php
function UploadFile($folder, $file){

    $file->store('/', $folder);

    $filename = $file->hashName();

    return  $filename;
}