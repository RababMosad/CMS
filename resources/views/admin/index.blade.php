@extends('admin.theme.default')

@section('title')
الاحصائيات
@endsection

@section('content')
   <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            المنشورات</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$posts_count}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-post fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            المستخدمين</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$users_count}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                              التعليقات</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$comments_count}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comment fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            التصنيفات</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$categories_count}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-category fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   </div>
@endsection