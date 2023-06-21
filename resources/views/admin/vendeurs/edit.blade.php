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
                <form class="form" action="{{route('admin.vendeurs.update',$vendeur->uuid)}}"
                      method="POST"
                      enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body">
                        <input type="hidden" name="id" value="{{$vendeur->id}}">
                        <h4 class="form-section"><i class="ft-home"></i>معلومات حساب بائع</h4>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">  اسم البائع</label>
                                    <input type="text" value="{{$vendeur->name}}" id="name"
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
                                    <input type="email" value="{{$vendeur->email}}" id="email"
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
                                    <input type="text" value="{{$vendeur->phone}}" id="phone"
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
                            <div class="col-md-4" id="wilayaBlock">
                                <div class="form-group">
                                    <label for="projectinput1"> الولاية</label>
                                    <select name="wilaya_id" id="wilaya" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        @isset($wilayas)
                                        @foreach($wilayas as $wilaya)
                                            <option value="{{$wilaya->id}}" {{$wilaya->id == $vendeur->wilaya_id ? 'selected' : ''}}>{{$wilaya->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("wilaya_id")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4" id="CommuneBlock">
                                <div class="form-group">
                                    <label for="projectinput1"> البلدية</label>
                                    <select name="commune_id" id="commune" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        @isset($communes)
                                        @foreach($communes as $commune)
                                            <option value="{{$commune->id}}" {{$commune->id == $vendeur->commune_id ? 'selected' : ''}}>{{$commune->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("commune_id")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">التوصيل</label>
                                    <select name="livraison" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        <option {{$vendeur->livraison == 'متوفرة' ? 'selected' : ''}} value="متوفرة">متوفرة</option>
                                        <option {{$vendeur->livraison == 'غير متوفرة' ? 'selected' : ''}} value="غير متوفرة">غير متوفرة</option>
                                    </select>
                                    @error("livraison")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="projectinput1">اسم المتجر</label>
                                    <input type="text" value="{{$vendeur->store_name}}" id="store_name"
                                           class="form-control"
                                           placeholder="  "
                                           name="store_name">
                                    @error("store_name")
                                    <span class="text-danger"> {{$message}}  </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="projectinput1">مجال البائع</label>
                                    <select name="domaine_vendeur" id="" class="form-control">
                                        <option value="">-- اختر من القائمة --</option>
                                        @isset($domaines)
                                        @foreach($domaines as $domaine)
                                            <option {{$domaine->id == $vendeur->domaine_vendeur ? 'selected' : ''}} value="{{$domaine->id}}">{{$domaine->name}}</option>
                                        @endforeach
                                        @endisset
                                    </select>
                                    @error("domaine_vendeur")
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
    $(document).on('change', '#wilaya', function () {
        wilaya = this.value;
        $.ajax({
            url: "{{route('admin.get_communes_by_wilaya')}}",
            method:"get",
            dataType:'json',
            data:{
                wilaya:wilaya,
            },
            success: function(result){
                //console.log(result.communes);
                communes = result.communes;
                $('#commune').empty();
                var options = '';
                $.each(communes, function(key, value) {
                    options += '<option value='+value.id+'>'+value.name+'</option>';
                });
                $('#commune').append(`<option value="">-- اختر من القائمة --</option>`);
                $('#commune').append(options);
            }
        });
    });
</script>
@endsection