@extends('admin.layouts.admin')
@section('title',' تعديل حساب مدير')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل حساب مدير</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.admins.update',$admin->id)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">
                        <input type="hidden" name="id" value="{{$admin->id}}">
                        <h4 class="form-section"><i class="ft-home"></i>معلومات الحساب </h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم المدير </label>
                                    <input type="text" value="{{$admin->name}}" id="name"
                                           class="form-control"
                                           placeholder="  "
                                           name="name">
                                    @error("name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1"> البريد الالكتروني</label>
                                    <input type="email" value="{{$admin->email}}" id="email"
                                           class="form-control"
                                           placeholder="  "
                                           name="email">
                                    @error("email")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1"> كلمة المرور</label>
                                    <input type="password" value="{{old('password')}}" id="password"
                                           class="form-control"
                                           placeholder="  "
                                           name="password">
                                    @error("password")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> الدور</label>
                                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}

                                    @error("roles")
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