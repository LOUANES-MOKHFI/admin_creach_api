@extends('admin.layouts.admin')

@section('title')
عرض منتج
@endsection
@section('style')

@endsection
@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض منتج</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    
                    <h4 class="form-section text-danger"><i class="ft-home"></i>معلومات المتجر</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>  اسم المتجر: <span class="badge badge-success">{{$product->vendor->store_name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> اسم البائع : <span class="badge badge-success">{{$product->vendor->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البريد الالكتروني : <span class="badge badge-success">{{$product->vendor->email}}</span></h5>
                            </div>
                        </div>
                    </div>
                    <h4 class="form-section text-danger"><i class="ft-home"></i>معلومات المنتج</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>اسم المنتج : <span class="badge badge-danger">{{$product->name}}</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>سعر المنتج : <span class="badge badge-danger"> {{$product->price}}</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>سعر المنتج بالجملة : <span class="badge badge-danger">{{$product->gros_price}}</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>أقسام المنتج  : @foreach($product->categories as $category) <span class="badge badge-danger">{{$category->name}}</span>@endforeach </h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5> وصف المنتج :</h5>
                                <p>{!! html_entity_decode($product->description) !!}</p>
                                <br>
                            </div>
                        </div>
                    </div>
                   
                    
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" row">
                               
                                @isset($product->images)
                                @foreach($product->images as $image)
                                <div class="col-md-3">
                                    <img src="{{asset('files/products/'.$image->image)}}" width="150" height="180" alt="">
                                </div>
                                @endforeach
                                @endisset
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


