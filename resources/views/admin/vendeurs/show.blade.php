@extends('admin.layouts.admin')

@section('title')
عرض حساب
@endsection
@section('style')
<style>
    .shell{
    padding:80px 0;
    }
    .wsk-cp-product{
    background:#fff;
    padding:5px;
    border-radius:6px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24);
    position:relative;
    margin:10px auto;
    }
    .wsk-cp-img{
    position:absolute;
    top:5px;
    left:50%;
    transform:translate(-50%);
    -webkit-transform:translate(-50%);
    -ms-transform:translate(-50%);
    -moz-transform:translate(-50%);
    -o-transform:translate(-50%);
    -khtml-transform:translate(-50%);
    width: 100%;
    padding: 15px;
    transition: all 0.2s ease-in-out;
    }
    .wsk-cp-img img{
    width:100%;
    transition: all 0.2s ease-in-out;
    border-radius:6px;
    }
    .wsk-cp-product:hover .wsk-cp-img{
    top:-40px;
    }
    .wsk-cp-product:hover .wsk-cp-img img{
    box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22);
    }
    .wsk-cp-text{
    padding-top:100%;
    }
    .wsk-cp-text .title-product{
    text-align:center;
    }
    .wsk-cp-text .title-product h3{
    font-size:20px;
    font-weight:bold;
    margin:15px auto;
    overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    width:100%;
    }
    .card-footer{
    padding: 25px 0 5px;
    border-top: 1px solid #ddd;
    }
    .card-footer:after, .card-footer:before{
    content:'';
    display:table;
    }
    .card-footer:after{
    clear:both;
    }

    .card-footer .wcf-left{
    float:left;
    
    }

    .card-footer .wcf-right{
    float:right;
    }

    .price{
    font-size:18px;
    font-weight:bold;
    }
    a.buy-btn{
    display:block;
    color:#212121;
    text-align:center;
    font-size: 18px;
    width:35px;
    height:35px;
    line-height:35px;
    border-radius:50%;
    border:1px solid #212121;
    transition: all 0.2s ease-in-out;
    }
    a.buy-btn:hover , a.buy-btn:active, a.buy-btn:focus{
    border-color: #FF9800;
    background: #FF9800;
    color: #fff;
    text-decoration:none;
    }
    .wsk-btn{
    display:inline-block;
    color:#212121;
    text-align:center;
    font-size: 18px;
    transition: all 0.2s ease-in-out;
    border-color: #FF9800;
    background: #FF9800;
    padding:12px 30px;
    border-radius:27px;
    margin: 0 5px;
    }
    .wsk-btn:hover, .wsk-btn:focus, .wsk-btn:active{
    text-decoration:none;
    color:#f
    }
</style>
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
                                <h5> الولاية : <span class="text-danger">{{$vendeur->wilaya->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البلدية : <span class="text-danger">{{$vendeur->commune->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> التوصيل : <span class="text-danger">{{$vendeur->livraison}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="form-section"><i class="ft-home"></i> منتجات المتجر</h4>
                    <div class="shell">
                        <div class="container">
                          <div class="row">
                            @isset($vendeur->products)
                            @foreach($vendeur->products as $product)
                                <div class="col-md-3">
                                <div class="wsk-cp-product">
                                    <div class="wsk-cp-img">
                                        @if(count($product->images)>0)
                                        <img src="{{asset('files/products/'.$product->images[1]->image)}}" alt="Product" class="img-responsive" style="height: 200px;"/>
                                        @endif
                                    </div>
                                    <div class="wsk-cp-text">
                                    <div class="title-product">
                                        <h3>{{$product->name}}</h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="wcf-left"><span class="price">{{$product->price}}</span></div>
                                        <div class="wcf-right"><a href="{{route('admin.products.show',$product->uuid)}}" class="btn btn-info"><i class="fa fa-eye"></i> عرض المنتج</a></div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                            @endisset
                          </div>
                          
                        </div>
                      </div>
                    
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
   
@endsection


