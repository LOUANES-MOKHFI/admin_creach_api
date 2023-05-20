@extends('admin.layouts.admin')

@section('title')
عرض الرسالة
@endsection
@section('style')

@endsection
@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الرسالة</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    <h5>اسم المرسل :</h5>
                    <p class="text-danger">{{$message->name}}</p>
                    <h5> عنوان الرسالة :</h5>
                    <p class="text-danger">{{$message->subject}}</p>
                    <h5> البريد الالكتروني :</h5>
                    <p class="text-danger">{{$message->email}}</p>
                    <h5> الرسالة :</h5>
                    <p class="">{{$message->message}}</p>

                </div>
                <!-- /.box-content -->
            </div>

        </div>
    </div>
@endsection

@section('script')

@endsection


