@extends('admin.layouts.admin')
@section('title',' تعديل حساب مستخدم')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل حساب مستخدم</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.users.update',$user->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <h4 class="form-section"><i class="ft-home"></i>معلومات الحساب مستخدم</h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم حساب مستخدم</label>
                                    <input type="text" value="{{$user->name}}" id="name"
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
                                    <input type="email" value="{{$user->email}}" id="email"
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
                                    <label for="projectinput1"> رقم الهاتف</label>
                                    <input type="text" value="{{$user->phone}}" id="phone"
                                           class="form-control"
                                           placeholder="  "
                                           name="phone">
                                    @error("phone")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1"> البلد</label>
                                    <select name="pays_id" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        <option value="1">--  بلد 1 --</option>
                                    </select>
                                    @error("pays_id")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1"> الولاية</label>
                                    <select name="wilaya_id" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        <option value="1">--  ولاية 1 --</option>
                                    </select>
                                    @error("wilaya_id")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1"> البلدية</label>
                                    <select name="commune_id" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        <option value="1">--  بلدية 1 --</option>
                                    </select>
                                    @error("commune_id")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> صفة المستخدم</label>
                                    <select name="type_user" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        @isset($types)
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("type_user")
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