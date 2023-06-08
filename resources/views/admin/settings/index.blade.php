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
        <div class="card mg-b-20 ">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <a href="{{route('admin.roles')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">الأدوار</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a> 
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <a href="{{route('admin.settings.about')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">معلومات الموقع</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <a href="{{route('admin.settings.domaines')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">مجالات البائعين</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <a href="{{route('admin.settings.categories_products')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">أقسام المنتجات</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <a href="{{route('admin.settings.categories_blogs')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">أقسام المدونة</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-secondary-gradient">
                        <a href="{{route('admin.settings.realisations')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">الأعمال و الملتقيات</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <a href="{{route('admin.settings.programmes')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">البرامج التعليمية</h6>
                                <p></p>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض </span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <a href="{{route('admin.settings.types_users')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">صفات حسابات الزوار</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-info-gradient">
                        <a href="{{route('admin.settings.emplois')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white">الوظائف المطلوبة</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <a href="{{route('admin.settings.publicites')}}">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white"> الاشهارات</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض</span>
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

@endsection

@section('script')

@endsection