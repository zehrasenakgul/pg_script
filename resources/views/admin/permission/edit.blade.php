@extends('admin.layouts.app')

@section('content')

<!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb">
            <div class="row">
              <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Edit Permission</h4>
                <div class="ms-auto text-end">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                      <li class="breadcrumb-item active" aria-current="page">
                       <a href="{{route('admin.permission.list')}}"> Permission List</a>
                      </li>
                      <!-- <li class="breadcrumb-item active" aria-current="page">
                        Add New
                      </li> -->
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
          <!-- ============================================================== -->
          <!-- End Bread crumb and right sidebar toggle -->
          <!-- ============================================================== -->


          <div class="row">
              <div class="col-lg-12 mt-3">
                <div class="card">
                    <div class="card-body">
                      <div class="col-lg-6">
                        <form action="{{route('admin.permission.update')}}"  method="post">
                            @csrf
                     <input type="hidden" name="id" value="{{$permission->id}}" />
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{$permission->name}}" required name="name" placeholder="Enter Permission Name">
                      </div>
                      <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" value="{{$permission->slug}}" required name="slug" placeholder="Enter Permission Slug">
                      </div>
                     
                      <button class="btn btn-primary" type="submit">Submit</button>

                    </form>
                      </div>
                    </div>
                  </div>
            </div>
          </div>
        </div>
@endsection
