@extends('admin.theme.default')

@section('title')
  التصنيفات
@endsection

@section('content')
    <div class="container-fluid">
       <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i>اضافة التصنيفات
            <form  method="post" action="{{route('category.store')}}">
              @csrf
              <div class="row">
                <div class="col">
                  <input type="text" class="form-control @error('title') is invalid @enderror" name="ttle" placeholder="التصنيف">
                    @error('title')
                        <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col">
                  <button type="submit" class="btn btn-dark">حفظ</button>
                </div>
              </div>
            </form>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th>الرقم</th>
                      <th>التصنيف</th>                    
                      <th>الاسم اللطيف</th>
                      <th>تاريخ انشاء</th>
                      <th>حذف</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                   <tr>
                      <td>{{$category->id}}</td>
                      <td>{{$category->title}}</td>
                      <td>{{$category->slug}}</td>
                      <td>{{$category->created_at}}</td>
                      <td>
                        <form action="{{route('category.destroy', $category->id )}}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-link"style="background-color:white, border:none; "><i class="far fa-trash-alt text-danger fa-lg"></i></button>
                        </form>
                      </td>
                   </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
      </div>
    </div>
@endsection