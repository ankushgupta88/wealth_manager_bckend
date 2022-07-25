@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Cities List</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Cities List </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All cities list</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Sr.</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php($count = 0)
                    @foreach($cities as $city)
                        @php($count++)
                      <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $city->name }}</td>
                        <td>
                            <img src="{{ asset('public/upload/city').'/'.$city->image }}" alt="{{ $city->image }}" width="100" height="100"> 
                        </td>
                        <td>
                          <a class="btn btn-info btn-sm" href="{{ url('admin/edit-city',$city->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a> 

                          <a class="btn btn-danger btn-sm" href="{{ url('admin/delete-city',$city->id) }}"><i class="fas fa-trash"></i> Delete</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
</div>
<!-- /.content-wrapper -->
@endsection