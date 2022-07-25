@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Manage Member List</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Manage Member List</li>
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
              <div class="card-body manage-firm-list">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
                <div class="col-12">
                   <div class="form-group col-md-4">
                        <label for="firm_name">Firm List</label>
                        <select name="firm_name" class="form-control choose_firm_name">
                           <option>Select Firm</option>
                            @foreach($firms as $firm)
                            <option value="{{ $firm->id }}">{{ $firm->name }}</option>
                            @endforeach
                        </select>
                   </div>  
                    <div class="custom_loader" style="display:none;"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
                    <div class="update_assign_member_list_reponce"></div>
                    <div class="assign_member_list_reponce"></div>
                </div>
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