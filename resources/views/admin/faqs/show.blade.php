@extends('admin.layouts.admin')
@section('title',' عرض استشارة')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض استشارة</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <div class="form-body">
                    <h4 class="form-section"><i class="ft-home"></i>معلومات الاستشارة</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>عنوان الاستشارة : <span class="text-danger">{{$faq->title}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>قسم الاستشارة : <span class="text-danger">{{$faq->category->name}}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>السؤال: </h5>
                                <p><span class="text-danger">{!! html_entity_decode($faq->question) !!}</span></p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5>الجواب: </h5>
                                <p><span class="text-danger">{!! html_entity_decode($faq->response) !!}</span></p>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="form-actions">
                    <button type="button" class="btn btn-warning mr-1"
                            onclick="history.back();">
                        <i class="ft-x"></i> عودة
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection