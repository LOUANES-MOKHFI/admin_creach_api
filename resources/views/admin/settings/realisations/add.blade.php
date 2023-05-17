@extends('admin.layouts.admin')
@section('title',' أضف عمل أو ملتقى')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضف عمل أو ملتقى</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.settings.realisations.store')}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات العمل</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم العمل</label>
                                    <input type="text" value="{{old('name')}}" id="name"
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
                                    <label for="projectinput1">  نوع العمل</label>
                                    <select name="type" id="" required class="form-control">
                                        <option value="">-- إختر من القائمة--</option>
                                        <option value="عمل">عمل</option>
                                        <option value="ملتقى">ملتقى</option>
                                    </select>
                                    @error("type")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  فيديو العمل <span class="text-danger" style="font-size: 12px">ليس اجباري</span></label>
                                    <input type="file"  id="video"
                                           class="form-control"
                                           placeholder="  "
                                           name="video">
                                    @error("video")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  صور العمل <span class="text-danger" style="font-size: 12px"> على الأقل صورة واحدة</span></label>
                                    <input type="file" id="images[]" multiple
                                           class="form-control"
                                           placeholder="  "
                                           name="images[]">
                                    @error("images")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-xs-12">
                                <div class="form-group">
                                    <label> ملخص عن العمل:</label>
                                    <textarea id="tinymce" name="description" cols="90" rows="10"></textarea>
                                    @error("description")
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        directionality : 'rtl',  // change this value according to your HTML
        language: 'ar'
    });

</script>
@endsection