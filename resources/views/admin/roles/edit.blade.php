@extends('admin.layouts.admin')
@section('title',' تعديل دور')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل دور</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.roles.update',$role->id)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات الدور</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  الدور </label>
                                    <input type="text" value="{{$role->name}}" id="name"
                                           class="form-control"
                                           placeholder="  "
                                           name="name">
                                    @error("name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1">الصلاحيات </label>
                                    <div class="row">
                                        @foreach($permission as $value)
                                        <div class="col-md-3">
                                            <label>
                                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                                {{ $value->name }}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error("permission")
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