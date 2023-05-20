@extends('admin.layouts.admin')
@section('title',' تعديل دليل بيداغوجي')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل دليل بيداغوجي</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.guide_pedagogique.update',$guide->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات الدليل بيداغوجي</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم الدليل بيداغوجي </label>
                                    <input type="text" value="{{$guide->name}}" id="name"
                                           class="form-control"
                                           placeholder="  "
                                           name="name">
                                    @error("name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> ملف pdf </label>
                                    <a target="_blank" href="{{asset('files/guide_pedagogique/'.$guide->pdf_file)}}">تحميل الدليل بصيغة  PDF</a>
                                    <input type="file" id="pdf_file"
                                           class="form-control"
                                           placeholder="  "
                                           name="pdf_file">
                                    @error("pdf_file")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> الصور </label>
                                    <input type="file" multiple id="images"
                                           class="form-control"
                                           placeholder="  "
                                           name="images[]">
                                    @error("images")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            @isset($guide->images)
                            <div class="col-lg-12 col-xs-12">
                                <div class="row">
                                    @foreach($guide->images as $image)
                                    <div class="col-md-3">
                                        <img src="{{asset('files/guide_pedagogique/'.$image->image)}}"  alt="">
                                        <a href="{{route('admin.guide_pedagogique.deleteImage',$image->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endisset
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
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

@endsection