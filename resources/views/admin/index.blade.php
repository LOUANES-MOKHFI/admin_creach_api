@extends('admin.layouts.admin')
@section('title','الرئيسية')

@section('style')

@endsection

@section('content')
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الإعدادات العامة</span>
        </div>
    </div>
</div>
<div class="row">
    <!--div-->
    <div class="col-xl-12">
        <div class="card mg-b-20 " style="padding:10px">
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <a href="{{route('admin.creches')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل الروضات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','creche')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white"> الروضات المؤكدة</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض ({{\App\Models\User::where('type','creche')->where('is_active',1)->count()}})</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-primary-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white"> الروضات الغير مؤكدة</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض ({{\App\Models\User::where('type','creche')->where('is_active',0)->count()}})</span>
                                    </span>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <a href="{{route('admin.creches')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المتاجر</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\User::where('type','vendeur')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white"> المتاجر المؤكدة</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض ({{\App\Models\User::where('type','vendeur')->where('is_active',1)->count()}})</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                            <div class="">
                                <h6 class="mb-3 tx-12 text-white"> المتاجر الغير مؤكدة</h6>
                            </div>
                            <div class="pb-0 mt-0">
                                <div class="d-flex">
                                    <span class="float-right my-auto mr-auto">
                                        <i class="fas fa-arrow-circle-up text-white"></i>
                                        <span class="text-white op-7">عرض ({{\App\Models\User::where('type','vendeur')->where('is_active',0)->count()}})</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-warning-gradient">
                        <a href="{{route('admin.blogs')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المقالات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\Blog::where('type','blog')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-info-gradient">
                        <a href="{{route('admin.products')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المنتجات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\Product::count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-success-gradient">
                        <a href="{{route('admin.contributions')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل المساهمات</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\Blog::where('type','contribution')->count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
                    <div class="card overflow-hidden sales-card bg-danger-gradient">
                        <a href="{{route('admin.offre_emplois')}}">
                            <div class="pl-3 pt-3 pr-3 pb-2 pt-0">
                                <div class="">
                                    <h6 class="mb-3 tx-12 text-white">كل عروض العمل</h6>
                                </div>
                                <div class="pb-0 mt-0">
                                    <div class="d-flex">
                                        <span class="float-right my-auto mr-auto">
                                            <i class="fas fa-arrow-circle-up text-white"></i>
                                            <span class="text-white op-7">عرض ({{\App\Models\OffreEmploi::count()}})</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 
            </div>
        </div>
        <div class="card mg-b-20 " style="padding:10px">
            @include('admin.includes.alerts.alerts')
            <h4 class="form-section"><i class="ft-home"></i>آخر التسجيلات</h4>
            <div class="table-responsive">
                <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نوع الحساب</th>
                            <th>الاسم</th>
                            <th>البريد الالكتروني</th>
                            <th>رقم الهاتف</th>
                            <th>حالة الحساب</th>
                            <th>العمليات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach(\App\Models\User::limit(10)->orderBy('id', 'DESC')->get() as $key=>$user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @if($user->type == "creche")
                                        <span class="badge badge-success">روضة</span>
                                    @elseif($user->type == "vendeur")
                                        <span class="badge badge-info">متجر</span>
                                    @else
                                        <span class="badge badge-danger">مستخدم</span>
                                    @endif
                                </td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->phone}}</td>
                                <td>
                                    <span class="badge {{$user->is_active == 0 ? 'badge-danger' : 'badge-success' }}">{{$user->is_active == 0 ? 'غير مفعل' : 'مفعل'}}</span>
                                </td>

                                <td>
                                @if($user->type == "creche")
                                    <?php $link = 'admin.creches.'?>
                                @elseif($user->type == "vendeur")
                                    <?php $link = 'admin.vendeurs.'?>
                                @else
                                    <?php $link = 'admin.users.'?>
                                @endif
                                @if($user->is_active == 0)
                                <a href="{{route($link.'confirmeAccount',$user->uuid)}}"class="btn btn-sm btn-success waves-effect waves-light">
                                    <i class="fa fa-check"></i> تأكيد الحساب
                                </a>
                                @endif
                                <a href="{{route($link.'show',$user->uuid)}}"class="btn btn-sm btn-info waves-effect waves-light" title="تعديل">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="{{route($link.'edit',$user->uuid)}}"class="btn btn-sm btn-warning waves-effect waves-light" title="تعديل">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{route($link.'delete',$user->uuid)}}" class="btn btn-sm btn-danger waves-effect waves-light" title="حذف">
                                    <i class="fa fa-trash"></i>
                                </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card mg-b-20 " style="padding:10px">
            <h4>المنحنى البياني للتسجيلات (روضة, متجر, مستخدم)</h4>
            <div class="col-lg-12">
                <div class="box-content">
                    <canvas id="allUsers" width="400" height="100"></canvas>
                </div>
            </div>
 
        </div>
    </div>
</div>
@endsection

@section('script')
 <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>

<script>
 var xMonth = JSON.parse('{!! json_encode($usersmonth)!!}');
 var yusers = JSON.parse('{!! json_encode($users)!!}');
 var ycreches = JSON.parse('{!! json_encode($creches)!!}');
 var yvendors = JSON.parse('{!! json_encode($vendors)!!}');
const ctxtestPcr = document.getElementById('allUsers');
const allUsers = new Chart(ctxtestPcr, {
    type: 'bar',
    data: {
        labels: xMonth,
        
        datasets: [
        {
            label: '# المستخدمين',
            data: yusers,
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)',
                
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1
        },
        {
            label: '# الروضات',
            data: ycreches,
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)',
                
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        },
        {
            label: '# المتاجر',
            data: yvendors,
            backgroundColor: [
                'rgba(75, 192, 192, 0.2)',
                
            ],
            borderColor: [
                'rgba(75, 192, 192, 1)',
            ],
            borderWidth: 1
        },
        ]
    },
     options: {
    transitions: {
      show: {
        animations: {
          x: {
            from: 0
          },
          y: {
            from: 0
          }
        }
      },
      hide: {
        animations: {
          x: {
            to: 0
          },
          y: {
            to: 0
          }
        }
      }
    }
    }
});
</script>
@endsection