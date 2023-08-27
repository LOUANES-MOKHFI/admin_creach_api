@extends('admin.layouts.admin')
@section('title',' أضف قسم الوثائق')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ أضف قسم الوثائق</span>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                @include('admin.includes.alerts.alerts')
                <form class="form" action="{{route('admin.dossiers.store')}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">

                        <h4 class="form-section"><i class="ft-home"></i>معلومات القسم</h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  نوع القسم </label>
                                    <select name="type" id="type_class"  class="form-control">
                                        <option value="">-- اختر نوع القسم --</option>
                                        <option value="1"> قسم فرعي </option>
                                        <option value="2">  صور </option>
                                    </select>
                                    @error("name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم القسم </label>
                                    <input type="text" value="{{old('name')}}" id="name"
                                           class="form-control"
                                           placeholder="  "
                                           name="name">
                                    @error("name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4" id="dossier" style="display:none">
                                <div class="form-group">
                                    <label for="projectinput1" > القسم الأساسي </label>
                                    <select name="parent_id" id="parent_id"  class="form-control">
                                        <option value="">-- اختر القسم --</option>
                                        @isset($dossiers)
                                        @foreach($dossiers as $dossier)
                                            <option value="{{$dossier->id}}">{{$dossier->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12" id="images" style="display:none">
                                <div class="form-group">
                                    <label for="projectinput1"> الصور  </label>
                                    <input type="file" multiple id="images"
                                           class="form-control"
                                           placeholder="  "
                                           name="images[]">
                                    @error("images")
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
<script>
    $('#type_class').on('change',function(){
        if(this.value == 1){
            $('#images').css('display','none');
            $('#dossier').css('display','block');
        }else{
            $('#dossier').css('display','none');
            $('#images').css('display','block');
        }
    })
</script>
@endsection