@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Plan Add</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Plan Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-10">
          <div class="card card-primary">
            <div class="card-body">
          @if (session('success'))
            <p class="alert alert-success">{{ session('success') }}</p>
        @endif
         @if (session('unsuccess'))
            <p class="alert alert-danger">{{ session('unsuccess') }}</p>
        @endif
             <form method="post" action="{{ route('plan.store') }}" enctype="multipart/form-data">
                 @csrf
              <div class="form-group">
                <label for="PlanName">Plan Name</label>
                <input type="text" id="PlanName" name="name" class="form-control">
              </div>
              <div class="form-group">
                <label for="page_description">Plan Description</label>
                <textarea id="page_description" name="description"  class="form-control">
              </textarea>
              
              </div>
              <div class="form-group">
                <label for="inputStatus">Plan Status</label>
                <select id="inputStatus" name="status"  class="form-control custom-select">
                  <option selected disabled>Select one</option>
                  <option value="Active">Active</option>
                  <option value="InActive">InActive</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputPlan">Plan Type's</label>
                <select id="inputPlan" name="plan_type" class="form-control custom-select">
                  <option selected disabled>Select one</option>
                  <option value="Individual">Individual</option>
                  <option value="Premium">Premium</option>
                  <option value="Firm">Firm</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="numeric">Price's</label>
                <!--<input type="text" id="inputClientCompany" class="form-control">-->
                <input class="form-control allow_decimal input_date" type="text" name="price" id="numeric" placeholder="0.00" value="">
                <div>Allow only numeric values with decimal</div>
              </div>
              
              <div class="form-group">
                <label for="inputPlan">Billing Style</label>
                <select id="inputPlan" name="billing_style" class="form-control custom-select">
                  <option selected value=''>Select Billing</option>
                  <option value="Monthly">Monthly</option>
                  <option value="Yearly">Yearly</option>
                </select>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <input type="submit" value="Submit" class="btn btn-success  ">
                </div>
              </div>
              </form>
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
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $(".allow_decimal").on("input", function(evt) {
           var self = $(this);
           self.val(self.val().replace(/[^0-9\.]/g, ''));
           if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
           {
             evt.preventDefault();
           }
        });
    });
  </script>
 @endsection