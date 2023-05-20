<?php
function UploadFile($folder, $file){

    $file->store('/', $folder);

    $filename = $file->hashName();

    return  $filename;
}

function Messages(){
    return \App\Models\Contact::where('is_viewed',0)->get();
}

function Notifications(){
    return \App\Models\Notification::where('is_viewed',0)->get();
}
