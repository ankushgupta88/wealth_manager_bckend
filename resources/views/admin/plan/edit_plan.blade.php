@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Edit Plan</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Plan  </li>
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
             <form method="post" action="{{ route('plan.update',$id->id) }}" enctype="multipart/form-data">
                 @csrf
                 @method('PUT')
              <div class="form-group">
                <label for="PlanName">Plan Name</label>
                <input type="text" id="PlanName" name="name" value="{{ $id->plan_name }}" class="form-control">
              </div>
              
              <div class="form-group">
                <label for="page_description">Plan Description</label>
                <textarea id="page_description" name="description" class="form-control">{{ $id->description }}
              </textarea>
              </div>
              
              <div class="form-group">
                <label for="Status">Plan Status</label>
                <select id="Status" name="status" class="form-control custom-select">
                  <option value="">Select one</option>
                  <!--<option value="php">PHP</option>-->
                  <option value="Active" @if($id->status == "Active") selected @endif >Active</option>
                  <option value="InActive" @if($id->status == "InActive") selected @endif>InActive</option>
                  <!--<option>Success</option>-->
                </select>
              </div>
              <div class="form-group">
                <label for="PlanType">Plan Type's</label>
                <select id="PlanType" name="plan_type" class="form-control custom-select">
                  <option value="" >Select one</option>
                  <option value="Individual" @if($id->plan_type == "Individual") selected @endif >Individual</option>
                  <option value="Premium" @if($id->plan_type == "Premium") selected @endif >Premium</option>
                  <option value="Firm" @if($id->plan_type == "Firm") selected @endif >Firm</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="Price">Price's</label>
                <!--<input type="text" id="inputClientCompany" class="form-control">-->
                <input class="form-control allow_decimal input_date" type="text" name="price" value="{{ $id->price }}" id="Price">
                <div>Allow only numeric values with decimal</div>
              </div>
 
              <div class="form-group">
                <label for="BillingStyle">Billing Style</label>
                <select id="BillingStyle" name="billing_style" class="form-control custom-select">
                  <option value="">Select Billing</option>
                  <option value="Monthly" @if($id->billing_style == "Monthly") selected @endif>Monthly</option>
                  <option value="yearly" @if($id->billing_style == "Yearly") selected @endif>Yearly</option>
                  <!--<option>Quarterly</option>-->
                </select>
              </div>
              
              <div class="row">
                <div class="col-12">
                  <!--<a href="#" type="reset" class="btn btn-secondary">Reset</a>-->
                  <!--<input type="reset" class="btn btn-secondary" value="Reset">-->
                  <input type="submit" value="Update" class="btn btn-success  ">
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
  <!-- /.content-wrapper -->
  
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