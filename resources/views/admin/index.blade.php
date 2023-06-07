@extends('admin.layouts.admin')
@section('title','الرئيسية')

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
        <div class="card mg-b-20 ">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <a href="{{route('admin.creches')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل الروضات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','creche')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white"> الروضات المؤكدة</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','creche')->where('is_active',1)->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                    
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white"> الروضات الغير مؤكدة</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','creche')->where('is_active',0)->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <a href="{{route('admin.creches')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المتاجر</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','vendeur')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white"> المتاجر المؤكدة</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','vendeur')->where('is_active',1)->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                    
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white"> المتاجر الغير مؤكدة</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','vendeur')->where('is_active',0)->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <a href="{{route('admin.blogs')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المقالات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\Blog::where('type','blog')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-info-gradient">
                        <a href="{{route('admin.blogs')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المقالات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\Blog::where('type','contribution')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <a href="{{route('admin.offre_emplois')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل عروض العمل</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\OffreEmploi::count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </a>
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