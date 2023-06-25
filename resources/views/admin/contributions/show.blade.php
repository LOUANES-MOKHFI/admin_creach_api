@extends('admin.layouts.admin')

@section('title')
عرض المساهمة
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
                <h4 class="content-title mb-0 my-auto">الرئيسية</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ عرض المساهمة</span>
            </div>
        </div>

    </div> 
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-body">
                    @include('admin.includes.alerts.alerts')
                    
                    <h4 class="form-section text-danger"><i class="ft-home"></i>معلومات الحساب</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>  اسم الحساب: <span class="badge badge-success">{{$blog->creche->name}}</span></h5>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <h5> البريد الالكتروني : <span class="badge badge-success">{{$blog->creche->email}}</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="form-section text-danger"><i class="ft-home"></i>معلومات المساهمة</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>اسم المساهمة : <span class="badge badge-danger">{{$blog->title}}</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>عدد الاعجابات : <span class="badge badge-primary">{{$blog->nbr_heart}}</span></h5>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>عدد المشاهدات : <span class="badge badge-success">{{$blog->nbr_view}}</span> </h5>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <h5> محتوى المساهمة :</h5>
                                <p>
                                    @if($blog->content != null )
                                    {!! html_entity_decode($blog->content) !!}
                                    @else
                                    /
                                    @endif
                                </p>
                                <br>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="{{route('admin.contributions.changeStatus',$blog->uuid)}}" class="btn {{ $blog->is_active == 0 ? 'btn-success' : 'btn-warning' }} waves-effect waves-light" title="عرض">
                                    @if($blog->is_active == 0) 
                                        تأكيد المساهمة
                                    @else
                                        إلغاء المساهمة
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class=" row">
                                @isset($blog->images)
                                @foreach($blog->images as $image)
                                <div class="col-md-3">
                                    <img src="{{asset('files/blogs/'.$image->image)}}" width="150" height="180" alt="">
                                </div>
                                @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>     
                    @if($blog->videos != null)    
                    <div class="row">
                        <div class="col-md-12">
                            <video src="{{asset('files/blogs/'.$blog->video)}}"></video>
                        </div>
                    </div>    
                    @endif             
                </div>
                <!-- /.box-content -->
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="form-section text-danger"><i class="ft-home"></i>قائمة الاعجابات بالمقال</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>المقال</th>
                                            <th>المستخدم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @isset($blog->heart_users)
                                        @foreach($blog->heart_users as $key=>$heart_user)
                                            <tr>
                                              
                                                <td>{{$blog->title}}</td>
                                                <td>{{$heart_user->name}}</td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mg-b-20">
                <div class="card-body">
                    <h4 class="form-section text-danger"><i class="ft-home"></i>قائمة التعليقات في المقال</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>المقال</th>
                                            <th>المستخدم</th>
                                            <th>التعليق</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @isset($blog->comments)
                                        @foreach($blog->comments as $key=>$comment)
                                            <tr>
                                              
                                                <td>{{$blog->title}}</td>
                                                <td>{{$comment->user->name}}</td>
                                                <td>{{$comment->comment}}</td>
                                                <td>
                                                    <a href="{{route('admin.blogs.deleteComment',$comment->id)}}"class="btn btn-danger waves-effect waves-light" title="حذف">
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
                    </div>
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


