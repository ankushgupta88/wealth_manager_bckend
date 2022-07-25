@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> 
      <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Member Service </h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Member Service</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-9">
          <div class="card card-primary">
            <div class="card-body">
                @if(count($member_service) == 1)
                    @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                    @endif
                    @if (session('unsuccess'))
                        <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                    @endif
                    <form method="post" action="{{ route('update.member.service',$member_service[0]->id) }}" enctype="multipart/form-data">
                        @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $member_service[0]->name }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                    </div>
                    <div class="form-group">
                      <label for="name">Short Name</label>
                      <input type="text" name="short_name" value="{{ $member_service[0]->short_name }}" class="form-control"> 
                  </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="Active" @if($member_service[0]->status == "Active") selected  @endif >Active</option>
                            <option value="DeActive" @if($member_service[0]->status == "DeActive") selected  @endif >DeActive</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-12"> 
                            <input type="submit" value="Update" class="btn btn-success">
                        </div>
                    </div>
                </form>
                @else
                    <div class="form-group">
                        <p>No Result Found</p>
                    </div> 
                @endif
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->
 @endsection