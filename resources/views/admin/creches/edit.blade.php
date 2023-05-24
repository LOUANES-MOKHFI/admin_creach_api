@extends('admin.layouts.admin')
@section('title',' تعديل حساب بائع')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل حساب بائع</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.creches.update',$creche->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">
                        <input type="hidden" name="id" value="{{$creche->id}}">
                        <h4 class="form-section"><i class="ft-home"></i>معلومات حساب بائع</h4>

                        <div class="row">
                            <div class="col-md-12 justify-content-center">
                                <div class="form-group ">
                                    <img src="{{asset('assets/files/logo/'.$creche->logo)}}" height="180" style="border: 50%" alt="">
                                    <input type="file" class="form-control" name="logo">
                                    @error("logo")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم مدير الروضة</label>
                                    <input type="text" value="{{$creche->name}}" id="name"
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
                                    <input type="email" value="{{$creche->email}}" id="email"
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
                                    <input type="text" value="{{$creche->phone}}" id="phone"
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">نوع الروضة</label>
                                    <select name="type_creche" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        <option {{$creche->type_creche == 'روضة معتمدة' ? 'selected' : ''}} value="روضة معتمدة">روضة معتمدة</option>
                                        <option {{$creche->type_creche == 'أكاديمية' ? 'selected' : ''}} value="أكاديمية">أكاديمية</option>
                                        <option {{$creche->type_creche == 'نادي' ? 'selected' : ''}} value="نادي">نادي</option>
                                    </select>
                                    @error("type_creche")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم الروضة</label>
                                    <input type="text" value="{{$creche->creche_name}}" id="creche_name"
                                           class="form-control"
                                           placeholder="  "
                                           name="creche_name">
                                    @error("creche_name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1"> برنامج الروضة </label>
                                    <select name="programme_id" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        @isset($programmes)
                                        @foreach($programmes as $programme)
                                            <option {{$programme->id == $creche->programme_id ? 'selected' : ''}} value="{{$programme->id}}">{{$programme->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("programme_id")
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