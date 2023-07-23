@extends('admin.layouts.admin')

@section('title')
عرض الطلب
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
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض الطلب</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    
                    <h4 class="form-section text-danger"><i class="ft-home"></i>معلومات الروضة</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>  اسم الروضة: <span class="badge badge-success">{{$demande->creche_name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> اسم مدير الروضة : <span class="badge badge-success">{{$demande->gerant_name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> رقم الهاتف : <span class="badge badge-success">{{$demande->telephone}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> الولاية: <span class="badge badge-success">{{$demande->wilaya->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>  البلدية : <span class="badge badge-success">{{$demande->commune->name}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>  سنة التأسيس : <span class="badge badge-success">{{$demande->annee}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
<<<<<<< HEAD
                                <h5>  البرنامج الذي عملت به الموسم الماضي : <span class="badge badge-success">{{$demande->programme->name}}</span></h5>
=======
                                <h5>  البرنامج الذي عملت به الموسم الماضي : <span class="badge badge-success">{{$demande->programme_id == 13 ? $demande->other_programme : $demande->programme->name}}</span></h5>
>>>>>>> a23e2688915068becc1c8971c63a0950dabb04f7
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mg-b-20">

                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    <div class="table-responsive">
                        <table class="table key-buttons text-md-nowrap" style="text-align: center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>الكتاب</th>
                                    <th>المستوى</th>
                                    <th>الكمية</th>
                                   
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>الكتاب</th>
                                    <th>المستوى</th>
                                    <th>الكمية</th>

                                </tr>
                            </tfoot>
                            <tbody>
                            @isset($demande->detail)
                                @foreach($demande->detail as $key=>$detail)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$detail->book ? $detail->book->name : ''}}</td>
                                        <td>{{$detail->niveau}}</td>
                                        <td>{{$detail->qty}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-content -->
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


