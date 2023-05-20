@extends('admin.layouts.admin')
@section('title',' تعديل كتاب')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تعديل كتاب</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.books_creche.update',$book->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات الكتاب</h4>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم الكتاب </label>
                                    <input type="text" value="{{$book->name}}" id="name"
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
                                    <label for="projectinput1">  اسم الكتاب </label>
                                    <select name="niveau" id="" required class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        @isset($niveaux)
                                        @foreach($niveaux as $niveau)
                                            <option {{$book->niveau_id == $niveau->id ? 'selected' : ''}} value="{{$niveau->id}}">{{$niveau->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("niveau")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="projectinput1"> ملف pdf  </label>
                                    <a target="_blank" href="{{asset('files/books_creche/'.$book->pdf_file)}}">تحميل الدليل بصيغة  PDF</a>
                                    <input type="file" id="pdf_file"
                                           class="form-control"
                                           placeholder="  "
                                           name="pdf_file">
                                    @error("pdf_file")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">  صورة الكتاب  </label>
                                    <input type="file" multiple id="image"
                                           class="form-control"
                                           placeholder="  "
                                           name="image">
                                    @error("images")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img src="{{asset('files/books_creche/'.$book->image)}}" width="100" height="150" alt="">
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