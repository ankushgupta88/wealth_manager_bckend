@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Plan List</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Plan List </li>
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
                <h3 class="card-title">All Plan list</h3>
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
                    <th>Plan Name</th>
                    <th>Plan Status</th>
                    <th>Plan Type</th>
                    <th>Billing Style</th>
                    <th>Price</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @php($count = 0)
                    @foreach($plans as $plan)
                        @php($count++)
                      <tr>
                        <td>{{ $count }}</td>
                        <td>{{ $plan->plan_name }}</td>
                        <td>{{ $plan->status }}</td>
                        <td>{{ $plan->plan_type }}</td>
                        <td>{{ $plan->billing_style }}</td>
                        <td>{{ $plan->price }}</td>
                        <td>
                          <a class="btn btn-info btn-sm" href="{{ route('edit.plan',$plan->id) }}"><i class="fas fa-pencil-alt"></i> Edit</a> 

                          <a class="btn btn-danger btn-sm" href="{{ url('admin/plan-delete',$plan->id) }}"><i class="fas fa-trash"></i> Delete</a>
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