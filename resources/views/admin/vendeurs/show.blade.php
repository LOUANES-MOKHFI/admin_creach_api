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
                            <div class="justify-content-center">
                                <img src="{{asset('assets/files/logo/'.$vendeur->logo)}}" style="border: 50%" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>نوع الحساب : <span class="badge badge-danger">حساب بائع</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> مجال البائع : <span class="badge badge-success"> {{$vendeur->domaine->name}}</span> </h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>الاسم و اللقب : <span class="text-danger">{{$vendeur->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>  اسم المتجر: {{$vendeur->store_name}}</h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> حالة الحساب: @if($vendeur->is_active == 1)<span class="badge badge-success">مفعل</span>@else <span class="badge badge-danger">ليس مفعل</span> @endif</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> البريد الالكتروني : <span class="text-danger">{{$vendeur->email}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> رقم الهاتف : <span class="text-danger">{{$vendeur->phone}}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> الولاية : <span class="text-danger">{{$vendeur->wilaya_id}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البلدية : <span class="text-danger">{{$vendeur->commune_id}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> التوصيل : <span class="text-danger">{{$vendeur->livraison}}</span></h5>
                            </div>
                        </div>
                    </div>
                        <div class="form-actions">
                            @if($vendeur->is_active == 0)
                                <a href="{{route('admin.vendeurs.confirmeAccount',$vendeur->uuid)}}" class="btn btn-success waves-effect waves-light">
                                    <i class="fa fa-check"></i> تأكيد الحساب
                                </a>
                            @endif
                            <a href="{{route('admin.vendeurs.delete',$vendeur->uuid)}}" class="btn btn-danger waves-effect waves-light" title="حذف">
                                <i class="fa fa-trash"></i> حذف الحساب
                            </a>
                        </div>
                        

                </div>
                <!-- /.box-content -->
            </div>

        </div>
    </div>
@endsection
@section('script')
   
@endsection


