@extends('admin.layouts.admin')

@section('title')
عرض حساب
@endsection
@section('style')
    <link href="{{ asset('admin/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ asset('admin/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('content')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض حساب</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    <div class="row">
                        <div class="col-md-12">
                            <div class="justify-content-center">
                                <img src="{{asset('assets/files/logo/'.$creche->logo)}}" style="border: 50%" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>نوع الحساب : <span class="badge badge-danger">حساب روضة</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> حالة الحساب: @if($creche->is_active == 1)<span class="badge badge-success">مفعل</span>@else <span class="badge badge-danger">ليس مفعل</span> @endif</h5>
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>  نوع الروضة: <span class="badge badge-success">{{$creche->type_creche}}</span></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>الاسم و اللقب (المدير) : <span class="text-danger">{{$creche->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>اسم الروضة: <span class="text-danger">{{$creche->creche_name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>برنامج الروضة: <span class="text-danger">{{$creche->programme->name}}</span></h5>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> البريد الالكتروني : <span class="text-danger">{{$creche->email}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5> رقم الهاتف : <span class="text-danger">{{$creche->phone}}</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البلد : <span class="text-danger">{{$creche->countrie ? $creche->countrie->name : ''}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> الولاية : <span class="text-danger">{{$creche->wilaya ? $creche->wilaya->name : ''}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البلدية : <span class="text-danger">{{$creche->commune ? $creche->commune->name : ''}}</span></h5>
                            </div>
                        </div>
                    </div>
                    
                        <div class="form-actions">
                            @if($creche->is_active == 0)
                                <a href="{{route('admin.creches.confirmeAccount',$creche->uuid)}}" class="btn btn-success waves-effect waves-light">
                                    <i class="fa fa-check"></i> تأكيد الحساب
                                </a>
                            @endif
                            <a href="{{route('admin.creches.delete',$creche->uuid)}}" class="btn btn-danger waves-effect waves-light" title="حذف">
                                <i class="fa fa-trash"></i> حذف الحساب
                            </a>
                        </div>                        
                
                    </div>
                <!-- /.box-content -->
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="form-section"><i class="ft-home"></i>مقالات الروضة</h4>
                    <div class="shell">
                        <div class="container">
                          <div class="row">
                            @isset($creche->blogs_creche)
                            @foreach($creche->blogs_creche as $blog)
                                <div class="col-md-3">
                                <div class="wsk-cp-product">
                                    <div class="wsk-cp-img">
                                        @if(count($blog->images)>0)
                                        <img src="{{asset('files/blogs/'.$blog->images[0]->image)}}" alt="{{$blog->title}}" class="img-responsive" style="height: 200px;"/>
                                        @endif
                                    </div>
                                    <div class="wsk-cp-text">
                                    <div class="title-product">
                                        <h3>{{$blog->title}}</h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="wcf-right"><a href="{{route('admin.blogs.show',$blog->uuid)}}" class="btn btn-info"><i class="fa fa-eye"></i> عرض المقالة</a></div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            @endforeach
                            @endisset
                          </div>
                          
                        </div>
                      </div>
                    
                </div>
            </div>

            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="form-section"><i class="ft-home"></i>عروض عمل الروضة</h4>
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>عرض العمل</th>
                                    <th>الروضة</th>
                                    <th>المستوى التعليمي</th>
                                    <th>الخبرة</th>
                                    <th>رقم الهاتف</th>
                                    <th>العنوان</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>

                            <tbody>
                            @isset($creche->offres)
                            @foreach($creche->offres as $key => $offre)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$offre->emploi ? $offre->emploi->name : ''}}</td>
                                        <td>{{$offre->creche ? $offre->creche->name : ''}}</td>
                                        <td>{{$offre->degre_etude}}</td>
                                        <td>{{$offre->experience}}</td>
                                        <td>{{$offre->phone}}</td>
                                        <td>{{$offre->wilaya ? $offre->wilaya->name : ''}} - {{$offre->commune ? $offre->commune->name : ''}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ asset('admin/assets/js/table-data.js') }}"></script>
    <!--Internal  Notify js -->
    <script src="{{ asset('admin/assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection


