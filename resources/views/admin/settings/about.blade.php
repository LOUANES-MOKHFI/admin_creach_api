@extends('admin.layouts.admin')
@section('title','الإعدادات')

@section('style')
    <link rel="stylesheet" href="{{asset('admin/assets1/plugin/form-wizard/prettify.css')}}">
@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإعدادات العامة</span>
        </div>
    </div>
</div>
<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <h4 class="box-title">معلومات المؤسسة</h4>			
            <div class="card-body">
                @include('admin.includes.alerts.alerts')					
                <div id="tabsleft" class="tabbable tabs-left">
                    <ul>
                        <li class="card" style="width: 200px;">
                            <a href="#tabsleft-tab1" data-toggle="tab" style="height: 50px;padding: 4px;color: black;font-weight: bold;">معلومات الموقع</a>
                        </li>
                        <li class="card" style="width: 200px;">
                            <a href="#tabsleft-tab2" data-toggle="tab" style="height: 50px;padding: 4px;color: black;font-weight: bold;">معلومات المؤسس</a>
                        </li>
                        
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabsleft-tab1">
                            <form action="{{route('admin.settings.about.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">	
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>شعار الموقع :</label>
                                            <input type="file" name="logo" class="form-control">
                                            @error("logo")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>								
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>اسم الموقع :</label>
                                            <input type="text" name="site_name" value="{{$settingapp->site_name}}" class="form-control" placeholder="اسم الموقع">
                                            @error("site_name")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>عنوان المؤسسة :</label>
                                            <input type="text" name="address" value="{{$settingapp->address}}" class="form-control" placeholder="عنوان المؤسسة">
                                            @error("address")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>رقم الهاتف :</label>
                                            <input type="text" name="phone" value="{{$settingapp->phone}}" class="form-control" placeholder="رقم الهاتف">
                                            @error("phone")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>البريد الالكتروني :</label>
                                            <input type="text" name="email" value="{{$settingapp->email}}" class="form-control" placeholder="البريد الالكتروني">
                                            @error("email")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>صفحة الفايسبوك :</label>
                                            <input type="text" name="facebook_page" value="{{$settingapp->facebook_page}}" class="form-control" placeholder="صفحة الفايسبوك">
                                            @error("facebook_page")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>مجموعة الفايسبوك :</label>
                                            <input type="text" name="facebook_groupe" value="{{$settingapp->facebook_groupe}}" class="form-control" placeholder="مجموعة الفايسبوك">
                                            @error("facebook_groupe")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>صفحة الانستغرام :</label>
                                            <input type="text" name="instagram" value="{{$settingapp->instagram}}" class="form-control" placeholder="صفحة الانستغرام">
                                            @error("instagram")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>صفحة التيكتوك :</label>
                                            <input type="text" name="tiktok" value="{{$settingapp->tiktok}}" class="form-control" placeholder="صفحة التيكتوك">
                                            @error("tiktok")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>قناة اليوتوب  :</label>
                                            <input type="text" name="youtube" value="{{$settingapp->youtube}}" class="form-control" placeholder="قناة اليوتوب">
                                            @error("youtube")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                            <i class="ft-x"></i> عودة
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> حفظ
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        <div class="tab-pane" id="tabsleft-tab2">
                            <form action="{{route('admin.settings.about.updateGerant')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">	
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>صورة المؤسس  :</label>
                                            <input type="file" name="image" class="form-control">
                                            @error("image")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>	
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label> فيديو تعريفي قصير  :</label>
                                            <input type="file" name="video" class="form-control">
                                            @error("video")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>								
                                    <div class="col-lg-6 col-xs-6">
                                        <div class="form-group">
                                            <label>اسم المؤسس  :</label>
                                            <input type="text" name="gerant_name" value="{{$settingapp->gerant_name}}" class="form-control" placeholder="اسم المؤسس">
                                            @error("gerant_name")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <label> نبذة عن المؤسس :</label>
                                            <textarea id="tinymce" name="description" cols="90" rows="10">{{$settingapp->description}}</textarea>
                                            @error("description")
                                            <span class="text-danger"> {{$message}}  </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                            <i class="ft-x"></i> عودة
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> حفظ
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                        
                    </div>
                </div>
                
            </div>
            <!-- /.box-content -->
        </div>
    </div>
</div>

@endsection

@section('script')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        directionality : 'rtl',  // change this value according to your HTML
        language: 'ar'
    });

</script>

<!-- Form Wizard -->
    <script src="{{asset('admin/assets1/plugin/form-wizard/prettify.js')}}"></script>
    <script src="{{asset('admin/assets1/plugin/form-wizard/jquery.bootstrap.wizard.min.js')}}"></script>
    <script src="{{asset('admin/assets1/plugin/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin/assets1/scripts/form.wizard.init.min.js')}}"></script>
<script src="{{asset('admin/assets1/scripts/jquery.min.js')}}"></script>

@endsection