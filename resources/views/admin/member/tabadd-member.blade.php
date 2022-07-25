@extends('admin.layouts.master')
 @section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="col-sm-12"> <!--content-wrapper-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1>Add Member</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Member  </li>
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
                @if (session('success'))
                  <p class="alert alert-success">{{ session('success') }}</p>
                @endif
                @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                @endif
             <form method="post" action="{{ route('admin.submit.member') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label for="listing_type">Listing type</label>
                   <select name="listing_type" class="form-control">
                      <option value="Individual">Individual</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="first_name">First Name</label>
                  <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror">
                  @error('first_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="last_name">Last Name</label>
                  <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror">
                  @error('last_name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror">
                  @error('email')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="company">Company</label>
                  <input type="text" name="company" class="form-control">
                </div>
                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input type="text" name="phone_number" class="form-control">
                </div>
                <div class="form-group">
                  <label for="address1">Address1</label>
                  <input type="text" name="address1" class="form-control">
                </div>
                <div class="form-group">
                  <label for="city">City</label>
                  <input type="text" name="city" class="form-control">
                </div>
                <div class="form-group">
                  <label for="postal_code">Postal Code</label>
                  <input type="text" name="postal_code" class="form-control">
                </div>
                <div class="form-group">
                  <label for="state_code">State Code</label>
                    <select name="state_code" class="form-control">
                      <option value="NJ">NJ</option>
                      <option value="PA">PA</option>
                      <option value="CT">CT</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="country_code">Country Code</label>
                   <select name="country_code" class="form-control">
                      <option value="USA">USA</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="profession_name">Profession Name</label>
                  <input type="text" name="profession_name" class="form-control">
                </div>
                <div class="form-group">
                  <label for="services">Select Services</label>
                   <select name="services[]" class="form-control" multiple>
                      @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="firm_name">Firm List</label>
                   <select name="firm_name" class="form-control">
                      <option value="">Select Firm</option>
                      @foreach($firms as $firm)
                        <option value="{{ $firm->id }}">{{ $firm->name }}</option>
                      @endforeach
                    </select>
                </div>
                <div class="form-group">
                  <label for="prsnl_website">Personal Website</label>
                  <input type="text" name="prsnl_website" class="form-control">
                </div>
                <div class="form-group">
                  <label for="cover_color">Cover Style</label>
                  <input type="text" name="cover_color" class="form-control my-colorpicker1">
                </div> 
                <div class="form-group">
                  <label for="twitter">Twitter</label>
                  <input type="text" name="twitter" class="form-control">
                </div>
                <div class="form-group">
                  <label for="linked_in">Linked in</label>
                  <input type="text" name="linked_in" class="form-control">
                </div>
                <div class="form-group">
                  <label for="quote_info">Quote Info</label> 
                  <textarea name="quote_info" rows="4" cols="50" class="form-control"></textarea>
                </div>
                <div class="form-group">
                  <label for="others">Others</label>
                  <input type="text" name="others" class="form-control">
                </div>
                <div class="form-group">
                  <label for="user_status">Status</label>
                   <select name="user_status" class="form-control">
                      <option value="Pending">Pending</option>
                      <option value="Suspend">Suspend</option>
                      <option value="Verified">Verified</option>
                      <option value="Hold">Hold</option>
                      <option value="Active">Active</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="user_level_type">Member Level</label>
                   <select name="user_level_type" class="form-control">
                      <option value="">Select Level</option>
                      <option value="1">Level 1</option>
                      <option value="2">Level 2</option>
                      <option value="3">Level 3</option>
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
  <!-- /.content-wrapper -->
  <script>
    //Colorpicker
    $('.my-colorpicker1').colorpicker()
  </script>
 @endsection

