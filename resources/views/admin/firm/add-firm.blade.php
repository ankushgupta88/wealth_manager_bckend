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
               <h1>Add Firm</h1>
            </div>
            <div class="col-sm-12">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Firm  </li>
               </ol>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <div class="col-5 col-sm-3">
            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
               <a class="nav-link active" id="general-tabs-profile-tab" data-toggle="pill" href="#general-tabs-profile" role="tab" aria-controls="general-tabs-profile" aria-selected="false">General Info</a>
               <a class="nav-link" id="professional-tabs-messages-tab" data-toggle="pill" href="#professional-tabs-messages" role="tab" aria-controls="professional-tabs-messages" aria-selected="false">Professional Services</a>
               <a class="nav-link" id="business-details-tabs-settings-tab" data-toggle="pill" href="#business-details-tabs-settings" role="tab" aria-controls="business-details-tabs-settings" aria-selected="false">Business Details</a>
            </div>
         </div>
         <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
               <div class="tab-pane fade show active" id="general-tabs-profile">
                 @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                  @endif
                  @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                  @endif
                  <form method="post" action="{{ route('submit.firm') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="personal-info-block">
                           <div class="form-heading mb-4">
                              <h4 class="form_head pb-2"> Personal Info </h4>
                           </div>
                           <div class="upload-photo d-flex align-items-center mb-4">
                              <div class="photo-uploaded">
                                <img class="img-fluid" src="{{ asset('public/upload/firm/default_logo.png')}}" alt="default_logo.png">
                              </div>
                              <div class="upload-content pl-3">
                                 <p> Photo must be 580 x 360 px and less than 1 mb </p>
                                    <input type="file" id="logo" name="logo[]" class="p-0">
                                 <p class="pt-2"> Upload a photo</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-12">
                        <label for="name">Firm Name</label>
                        <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                     </div>
                     <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" value="" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="address1">Address1</label>
                        <input type="text" name="address1" value="" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" value="" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" value="" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="state_code">State Code</label>
                        <select name="state_code" class="form-control">
                        <option value="NJ">NJ</option>
                        <option value="PA">PA</option>
                        <option value="CT">CT</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="country_code">Country Code</label>
                        <select name="country_code" class="form-control">
                        <option value="USA">USA</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="prsnl_website">Personal Website</label>
                        <input type="text" name="prsnl_website" value="" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                       <label for="status">status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                          <option value="DeActive">DeActive</option>
                          <option value="Active">Active</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                     <div class="col-md-12">
                        <div class="heading_main_txt mt-3">
                           <div class="form-heading mb-4">
                              <h4 class="form_head pb-2"> Cover style  </h4>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="cover_color">Choose highlight color </label>
                          <input type="color" id="favcolor" name="cover_color" value="#0B5510" placeholder="#0B5510" class="p-1">
                        </div>
                        <div class="form-group col-md-12">
                           <label for="quote_info">Personal Quote</label> 
                           <textarea name="quote_info" rows="4" cols="50" class="form-control" placeholder="Add your personal quote here"></textarea>
                           <p class="text-color mb-0"> The Personal Quote will be displayed on your cover </p>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <div class="heading_main_txt mt-3">
                           <div class="form-heading mb-4">
                              <h4 class="form_head pb-2"> Social media </h4>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                           <label for="twitter">Twitter</label>
                           <input type="text" name="twitter" value="" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="linked_in">Linked in</label>
                           <input type="text" name="linked_in" value="" class="form-control">
                        </div>
                      </div>
                    </div> 
               </div>
               <div class="tab-pane fade" id="professional-tabs-messages">
                  <div class="designation-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Professional Services </h4>
                     </div>
                     <div class="row py-2">
                        <div class="form-group col-md-9">
                           <label for="services">Add Service</label>
                           <select name="services[]" class="multi-select-field form-control @error('services') is-invalid @enderror" multiple>
                              @foreach($services as $service) 
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                              @endforeach
                            </select> 
                            @error('services')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                     </div>
                  </div> 
               </div>
               <div class="tab-pane fade" id="business-details-tabs-settings">
                    <div class="business-detail-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Business Details </h4>
                     </div>
                     <div class="mb-3 col-md-9">
                        <label for="biography" class="form-label pb-1 fw-500">Biography</label> <br>
                        <textarea class="w-100 color-bg border-0 p-3 @error('biography') is-invalid @enderror" rows="6" cols="50" name="biography" placeholder="Add your biography"></textarea>
                        @error('biography')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="button-site"> 
                       <button type="submit" class="main-btn main-btn-bg px-5"> Submit </button> 
                     </div>
                    </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->
@endsection







{{--
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
            <h1>Add Firm</h1>
          </div>
          <div class="col-sm-12">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Add Firm  </li>
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
                <form method="post" action="{{ route('submit.firm') }}" enctype="multipart/form-data">
                 @csrf
                <div class="form-group">
                  <label for="name">Firm Name</label>
                  <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror">
                  @error('name')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="logo">Logo</label>
                  <input type="file" name="logo[]" value="" class="form-control">
                </div>
                <div class="form-group">
                  <label for="prsnl_website">Personal Website</label>
                  <input type="text" name="prsnl_website" class="form-control">
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
                  <label for="status">Status</label>
                   <select name="status" class="form-control @error('status') is-invalid @enderror">
                      <option value="DeActive">DeActive</option>
                      <option value="Active">Active</option>
                    </select>
                    @error('status')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                  <div class="col-12"> 
                    <input type="submit" value="Submit" class="btn btn-success">
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
 @endsection
 --}}