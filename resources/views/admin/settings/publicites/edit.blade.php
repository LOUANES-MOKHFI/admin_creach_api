@extends('admin.layouts.admin')
@section('title',' تعديل اشهار')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل اشهار</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.settings.publictes.update',$publicite->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات الاشهار</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم الاشهار</label>
                                    <input type="text" value="{{$publicite->name}}" id="name"
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
                                    <label for="projectinput1"> الحالة</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{$publicite->status == 1 ? 'selected' : ''}}>مفعل</option>
                                        <option value="0" {{$publicite->status == 0 ? 'selected' : ''}}>غير مفعل</option>
                                    </select>
                                    @error("status")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  صورة الاشهار</label>
                                    <input type="file" value="{{old('image')}}" id="image"
                                           class="form-control"
                                           placeholder="  "
                                           name="image">
                                    @error("image")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{asset('files/publicites/'.$publicite->image)}}"  width="150" alt="">
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