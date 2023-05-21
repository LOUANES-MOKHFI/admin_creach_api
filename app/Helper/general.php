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

function getNotificationType($model){
    if($model == '\App\Models\User'){
        return "<span class='text-danger'>تسجيل عضوية</span>";
    }elseif($model == '\App\Models\Product'){
        return "<span class='text-danger'>منتج جديد</span>";
    }elseif($model == '\App\Models\Blog'){
        return "<span class='text-danger'>مدونة جديدة</span>";
    }
}