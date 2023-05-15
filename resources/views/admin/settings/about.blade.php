@extends('admin.layouts.admin')
@section('title','الإعدادات')

@section('style')

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
            <h4 class="box-title">Informations de La clinique</h4>			
            <div class="card-body">
            @include('admin.includes.alerts.alerts')					
                    <div id="tabsleft" class="tabbable tabs-left">
                        <ul>
                            <li class="card" style="width: 200px;">
                                <a href="#tabsleft-tab1" data-toggle="tab" style="height: 50px;padding: 4px;color: black;font-weight: bold;">معلومات الموقع</a>
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
                                            </div>
                                        </div>								
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>اسم الموقع :</label>
                                                <input type="text" name="site_name" value="{{$settingapp->site_name}}" class="form-control" placeholder="اسم الموقع">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>عنوان المؤسسة :</label>
                                                <input type="text" name="address" value="{{$settingapp->address}}" class="form-control" placeholder="عنوان المؤسسة">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>رقم الهاتف :</label>
                                                <input type="text" name="phone" value="{{$settingapp->phone}}" class="form-control" placeholder="رقم الهاتف">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>البريد الالكتروني :</label>
                                                <input type="text" name="email" value="{{$settingapp->email}}" class="form-control" placeholder="البريد الالكتروني">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>صفحة الفايسبوك :</label>
                                                <input type="text" name="facebook_page" value="{{$settingapp->facebook_page}}" class="form-control" placeholder="صفحة الفايسبوك">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>مجموعة الفايسبوك :</label>
                                                <input type="text" name="facebook_groupe" value="{{$settingapp->facebook_groupe}}" class="form-control" placeholder="مجموعة الفايسبوك">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>صفحة الانستغرام :</label>
                                                <input type="text" name="instagram" value="{{$settingapp->instagram}}" class="form-control" placeholder="صفحة الانستغرام">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>صفحة التيكتوك :</label>
                                                <input type="text" name="tiktok" value="{{$settingapp->tiktok}}" class="form-control" placeholder="صفحة التيكتوك">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-xs-6">
                                            <div class="form-group">
                                                <label>قناة اليوتوب  :</label>
                                                <input type="text" name="youtube" value="{{$settingapp->youtube}}" class="form-control" placeholder="قناة اليوتوب">
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

@endsection