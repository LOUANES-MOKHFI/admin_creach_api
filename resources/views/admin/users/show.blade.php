@extends('admin.layouts.admin')

@section('title')
عرض حساب
@endsection
@section('style')

@endsection
@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض حساب</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>نوع الحساب : <span class="badge badge-danger">حساب مستخدم</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>الاسم و اللقب : <span class="text-danger">{{$user->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> صفة الحساب: <span class="text-danger">{{$user->typeUser ? $user->typeUser->name : ''}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> حالة الحساب: @if($user->is_active == 1)<span class="badge badge-success">مفعل</span>@else <span class="badge badge-danger">ليس مفعل</span> @endif</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> البريد الالكتروني : <span class="text-danger">{{$user->email}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> رقم الهاتف : <span class="text-danger">{{$user->phone}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البلد : <span class="text-danger">{{$user->countrie ? $user->countrie->name : ''}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> الولاية : <span class="text-danger">{{$user->wilaya ? $user->wilaya->name : ''}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البلدية : <span class="text-danger">{{$user->commune ? $user->commune->name : ''}}</span></h5>
                            </div>
                        </div>
                        <div class="form-actions">
                            @if($user->is_active == 0)
                                <a href="{{route('admin.users.confirmeAccount',$user->uuid)}}" class="btn btn-success waves-effect waves-light">
                                    <i class="fa fa-check"></i> تأكيد الحساب
                                </a>
                            @endif
                            <a href="{{route('admin.users.delete',$user->uuid)}}" class="btn btn-danger waves-effect waves-light" title="حذف">
                                <i class="fa fa-trash"></i> حذف الحساب
                            </a>
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


