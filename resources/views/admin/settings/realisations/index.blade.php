@extends('admin.layouts.admin')

@section('title')
الأعمال و الملتقيات
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
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الأعمال و الملتقيات</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                        <a href="{{route('admin.settings.realisations.create')}}" class="modal-effect btn btn-sm btn-primary" style="color:white"><i
                                class="fas fa-plus"></i>&nbsp; أضف عمل أو ملتقى
                        </a>

                </div>
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>صورة العمل</th>
                                    <th>اسم العمل</th>
                                    <th>نوع العمل</th>
                                    <th>اسم الأدمن</th>
                                    <th>العمليات</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>صورة العمل</th>
                                    <th>اسم العمل</th>
                                    <th>نوع العمل</th>
                                    <th>اسم الأدمن</th>
                                    <th>العمليات</th>
                                </tr>
                            </tfoot>
                            <tbody>
                            @isset($realisations)
                                @foreach($realisations as $key=>$realisation)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>@if(count($realisation->images)>0) <img src="{{asset('files/realisations/'.$realisation->images[0]->image)}}" width="100">@endif</td>
                                        <td>{{$realisation->name}}</td>
                                        <td>{{$realisation->type}}</td>
                                        <td>{{$realisation->admin->name}}</td>
                                        <td>
                                        <a href="{{route('admin.settings.realisations.edit',$realisation->uuid)}}"class="btn btn-warning waves-effect waves-light" title="تعديل">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('admin.settings.realisations.delete',$realisation->uuid)}}" class="btn btn-danger waves-effect waves-light" title="حذف">
                                            <i class="fa fa-trash"></i>
                                        </a>

                                        </td>
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


