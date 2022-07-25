@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Allow Member</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Allow Member </li>
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
              <!-- /.card-header -->
              <div class="card-body">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                <form method="post" action="{{ route('admin.submit.firm.allow.member') }}" enctype="multipart/form-data">
                    @csrf 
                    <div class="col-12">
                       <div class="form-group col-md-6">
                            <label for="firm_name">Select Firm Name</label>
                            <select name="firm_name" class="form-control @error('firm_name') is-invalid @enderror">
                                @foreach($firms as $firm)
                                <option value="{{ $firm->id }}">{{ $firm->name }}</option>
                                @endforeach
                            </select>
                            @error('firm_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                       </div>  
                    </div>
                    <table id="customDataTable" class="table table-bordered table-hover table-design-cv firm-custom-data-table">
                      <thead>
                      <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Image</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach($members as $member)
                          <tr>
                            <td><input type="checkbox" value="{{ $member->id }}" name="user_ids[]"></td> 
                            <td>{{ $member->name }}</td>
                            <td>
                                <img src="{{ asset('public/upload/user').'/'.$member->avatar }}" alt="{{ $member->avatar }}" width="70" height="70">
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                    <div class="col-12 mt-4">
                       <div class="form-group col-md-4"> 
                           <button type="submit" class="main-btn main-btn-bg px-5"> Submit </button> 
                       </div>  
                    </div>
                </form>
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