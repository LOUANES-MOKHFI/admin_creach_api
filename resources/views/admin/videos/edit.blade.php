@extends('admin.layouts.admin')
@section('title',' تعديل فيديو')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل فيديو</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.videos.update',$video->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات الفيديو</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  عنوان الفيديو</label>
                                    <input type="text" value="{{$video->title}}" id="title"
                                           class="form-control"
                                           placeholder="  "
                                           name="title">
                                    @error("title")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> المجال</label>
                                    <select name="domaine" class="form-control" id="">
                                        <option value="">اختر القسم</option>
                                        <option value="القسم التربوي" {{$video->domaine == 'القسم التربوي' ? 'selected' : ''}}>القسم التربوي</option>
                                        <option value="إنشاء الروضة" {{$video->domaine == 'إنشاء الروضة' ? 'selected' : ''}}>إنشاء الروضة</option>
                                        <option value="إدارة الروضة" {{$video->domaine == 'إدارة الروضة' ? 'selected' : ''}}>إدارة الروضة</option>
                                    </select>
                                    @error("domaine")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> اسم الناشر</label>
                                    <input type="text" value="{{$video->publisher}}" id="publisher"
                                           class="form-control"
                                           placeholder="  "
                                           name="publisher">
                                    @error("publisher")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> رابط الفيديو</label>
                                    <input type="text" value="{{$video->link}}" id="link"
                                           class="form-control"
                                           placeholder="  "
                                           name="link">
                                    @error("link")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
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