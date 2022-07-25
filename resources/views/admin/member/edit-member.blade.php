

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
               <h1>Edit Member</h1>
            </div>
            <div class="col-sm-12">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Member  </li>
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
               <a class="nav-link" id="designations-tabs-profile-tab" data-toggle="pill" href="#designations-tabs-profile" role="tab" aria-controls="designations-tabs-profile" aria-selected="false">Designations</a>
               <a class="nav-link" id="professional-tabs-messages-tab" data-toggle="pill" href="#professional-tabs-messages" role="tab" aria-controls="professional-tabs-messages" aria-selected="false">Professional Services</a>
               <a class="nav-link" id="firm-tabs-settings-tab" data-toggle="pill" href="#firm-tabs-settings" role="tab" aria-controls="firm-tabs-settings" aria-selected="false">Firms</a>
               <a class="nav-link" id="availability-tabs-settings-tab" data-toggle="pill" href="#availability-tabs-settings" role="tab" aria-controls="availability-tabs-settings" aria-selected="false">Availability</a>
               <a class="nav-link" id="activity-tabs-settings-tab" data-toggle="pill" href="#activity-tabs-settings" role="tab" aria-controls="activity-tabs-settings" aria-selected="false">Activity</a>
               <a class="nav-link" id="business-details-tabs-settings-tab" data-toggle="pill" href="#business-details-tabs-settings" role="tab" aria-controls="business-details-tabs-settings" aria-selected="false">Business Details</a>
            </div>
         </div>
         <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
            @if(count($member) == 1)
               <div class="tab-pane fade show active" id="general-tabs-profile">
                 @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                  @endif
                  @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                  @endif
                  <form method="post" action="{{ route('update.member.information',$member[0]->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="personal-info-block">
                           <div class="form-heading mb-4">
                              <h4 class="form_head pb-2"> Personal Info </h4>
                           </div>
                           <div class="upload-photo d-flex align-items-center mb-4">
                              <div class="photo-uploaded">
                                <img class="img-fluid" src="{{ asset('public/upload/user').'/'.$member[0]->avatar }}">
                              </div>
                              <div class="upload-content pl-3">
                                 <p> Photo must be 580 x 360 px and less than 1 mb </p>
                                    <input type="file" id="profile_pic" name="profile_pic[]" class="p-0">
                                 <p class="pt-2"> Upload a photo</p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" value="{{ $member[0]->first_name }}" class="form-control @error('first_name') is-invalid @enderror">
                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="form-group col-md-6">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" value="{{ $member[0]->last_name }}" class="form-control @error('last_name') is-invalid @enderror">
                        @error('last_name')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                     </div>
                     <div class="form-group col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" value="{{ $member[0]->email }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="company">Company</label> 
                        <input type="text" name="company" value="{{ $member[0]->company }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ $member[0]->mobile }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="listing_type">Listing type</label>
                        <select name="listing_type" class="form-control">
                        <option value="Individual" @if($member[0]->listing_type == "Individual") selected  @endif >Individual</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="address1">Address1</label>
                        <input type="text" name="address1" value="{{ $member[0]->address1 }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" value="{{ $member[0]->city }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" value="{{ $member[0]->postal_code }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="state_code">State Code</label>
                        <select name="state_code" class="form-control">
                        <option value="NJ" @if($member[0]->state_code == "NJ") selected  @endif >NJ</option>
                        <option value="PA" @if($member[0]->state_code == "PA") selected  @endif >PA</option>
                        <option value="CT" @if($member[0]->state_code == "CT") selected  @endif >CT</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="country_code">Country Code</label>
                        <select name="country_code" class="form-control">
                        <option value="USA" @if($member[0]->country_code == "USA") selected  @endif >USA</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="profession_name">Profession Name</label>
                        <input type="text" name="profession_name" value="{{ $member[0]->profession_name }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="prsnl_website">Personal Website</label>
                        <input type="text" name="prsnl_website" value="{{ $member[0]->prsnl_website }}" class="form-control">
                     </div>
                      <div class="form-group col-md-6">
                        <label for="user_status">Status</label>
                        <select name="user_status" class="form-control">
                          <option value="Pending" @if($member[0]->user_status == "Pending") selected  @endif >Pending</option>
                          <option value="Suspend" @if($member[0]->user_status == "Suspend") selected  @endif >Suspend</option>
                          <option value="Verified" @if($member[0]->user_status == "Verified") selected  @endif >Verified</option>
                          <option value="Hold" @if($member[0]->user_status == "Hold") selected  @endif >Hold</option>
                          <option value="Active" @if($member[0]->user_status == "Active") selected  @endif >Active</option>
                        </select>
                     </div>
                      <div class="form-group col-md-6">
                        <label for="user_level_type">Member Level</label>
                        <select name="user_level_type" class="form-control">
                           <option value="">Select Level</option>
                           <option value="1" @if($member[0]->user_level_type == "1") selected  @endif >Level 1</option>
                           <option value="2" @if($member[0]->user_level_type == "2") selected  @endif >Level 2</option>
                           <option value="3" @if($member[0]->user_level_type == "3") selected  @endif >Level 3</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="experience">Experience</label>
                        <select name="experience" class="form-control">
                           <option value="1 Year" @if($member[0]->experience == "1 Year") selected  @endif >1 Year</option>
                           @for ($i = 2; $i <= 50; $i++)
                              <option value="{{ $i }} Years" @if($member[0]->experience == "$i Years") selected  @endif >{{ $i }} Years</option>
                           @endfor
                        </select>
                     </div>
                     <div class="col-md-12">
                        <div class="heading_main_txt mt-3">
                           <div class="form-heading mb-4">
                              <h4 class="form_head pb-2"> Cover style  </h4>
                           </div>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="cover_color">Choose highlight color </label>
                          @if($member[0]->cover_color)
                            <input type="color" id="favcolor" name="cover_color" value="{{ $member[0]->cover_color }}" placeholder="#0B5510" class="p-1"> 
                            @else 
                                <input type="color" id="favcolor" name="cover_color" value="#0B5510" placeholder="#0B5510" class="p-1">
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                           <label for="quote_info">Personal Quote</label> 
                           <textarea name="quote_info" rows="4" cols="50" class="form-control description" placeholder="Add your personal quote here">{{ $member[0]->quote_info }}</textarea>
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
                           <input type="text" name="twitter" value="{{ $member[0]->twitter }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="linked_in">Linked in</label>
                           <input type="text" name="linked_in" value="{{ $member[0]->linked_in }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="others">Others</label>
                           <input type="text" name="others" value="{{ $member[0]->others }}" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="button-site"> 
                      <button class="main-btn main-btn-bg px-5" type="submit"> Save Changes </button>  
                    </div>
                  </form>
               </div>
               <div class="tab-pane fade" id="designations-tabs-profile">
                <form method="post" action="{{ route('update.member.designation',$member[0]->id) }}" enctype="multipart/form-data">
                  @csrf
                  <div class="designation-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading mb-4">
                        <h4 class="form_head pb-2">  Designations  </h4>
                     </div>
                     <ul class="p-0 list-unstyled mb-0">
                        <li>  
                            <input type="radio" name="profession_name" value="CFP" @if($member[0]->profession_name == "CFP") checked  @endif > 
                            <label for="CFP" class="pl-2">CFP</label> 
                        </li>
                        <li>  
                            <input type="radio" name="profession_name" value="CFA" @if($member[0]->profession_name == "CFA") checked  @endif> 
                            <label for="CFA" class="pl-2">CFA</label> 
                        </li>
                        <li>  
                            <input type="radio" name="profession_name" value="ChFC" @if($member[0]->profession_name == "ChFC") checked  @endif> 
                            <label for="ChFC" class="pl-2">ChFC</label> 
                        </li>
                     </ul>
                  </div>
                  <div class="button-site"> 
                    <button type="submit" class="main-btn main-btn-bg px-5"> Save Changes </button> 
                  </div>
                </form>
               </div>
               <div class="tab-pane fade" id="professional-tabs-messages">
                  <form method="post" action="{{ route('update.member.professinoal.services',$member[0]->id) }}" enctype="multipart/form-data">
                  @csrf
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
                     @if(count($member[0]->userAssignServices) > 0)
                     <div class="service-cross-btn d-lg-flex py-4 position-relative">
                        <ul>
                        @foreach($member[0]->userAssignServices as $service)
                        <li class="professional-services">
                            {{ $service->userAssignServicesDetails->name }}<a href="{{ url('admin/delete-assign-member-service').'/'.$member[0]->userAssignServices[0]->user_id.'/'.$service->userAssignServicesDetails->id }}" class="main-btn mb-3 mb-lg-0"><i class="fa fa-times-circle" aria-hidden="true"></i> </a>
                        </li>
                        @endforeach
                        <ul>
                     </div>
                     @endif
                  </div> 
                  <div class="button-site"> 
                    <button type="submit" class="main-btn main-btn-bg px-5"> Save Changes </button> 
                  </div>
                </form>
               </div>
               <div class="tab-pane fade" id="firm-tabs-settings">
                  <div class="firm-info-block bg-white p-4 mb-3 rounded-3">
                    <form method="post" action="{{ route('update.member.firm',$member[0]->id) }}" enctype="multipart/form-data">
                      @csrf
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Firm Info </h4>
                     </div>
                      <div class="row py-2 assign_firm_form">
                        <div class="form-group col-md-9">
                            <label for="services">Add Firm</label>
                            <select id="firm_name" name="firm_name" class="form-control @error('firm_name') is-invalid @enderror">
                              <option value="">Select Firm</option>
                              @foreach($firms as $firm)
                                <option value="{{ $firm->id }}" @if($member[0]->firm_id == $firm->id) selected  @endif >{{ $firm->name }}</option> 
                              @endforeach
                              <option value="Other">Other</option> 
                            </select>
                            @error('firm_name')
                              <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                        </div>
                      </div>
                     <div class="upload-photo mb-4 add_firm_form" style="display:none;">
                        <div class=" d-flex align-items-center"> 
                        <div class="photo-uploaded">
                           <img class="img-fluid" src="{{ asset('public/admin/images/img-upload2.png') }}">
                        </div>
                        <div class="upload-content pl-3">
                           <p> Photo must be 580 x 360 px and less than 1 mb </p>
                              <input type="file" id="firm_logo" name="add_firm_logo[]" class="p-0">
                           <p class="pt-2"> Upload a photo</p>
                        </div>
                        </div>
                        <div class="my-3 col-md-6">
                           <label for="firm_name" class="form-label pb-1 fw-500">Firm Name</label>
                           <input type="text" name="add_firm_name" class="form-control color-bg" id="firm_name" placeholder="">
                        </div>
                     </div>
                  </div>
                  <div class="button-site"> 
                      <button type="submit"class="main-btn main-btn-bg px-5"> Save Changes </button> 
                  </div>
                </form>
               </div>
               <div class="tab-pane fade" id="availability-tabs-settings">
                  <div class="availability-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Availability </h4>
                     </div>
                     <div class="row clearfix">
                        <div class="col-md-12">
                        @if(count($member[0]->userAvailabilityList) > 0)
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                 <thead>
                                    <tr>
                                       <th> Day </th>
                                       <th> Start Time </th>
                                       <th> End Time</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($member[0]->userAvailabilityList as $availability)
                                    <tr id="addr0" data-id="0" class="hidden">
                                       <td data-name="name">
                                          <input type="text" class="form-control color-bg" value="{{ $availability->day_name }}" placeholder="{{ $availability->day_name }}"> 
                                       </td>
                                       <td data-name="start_time">
                                          <input type="text" class="form-control color-bg" value="{{ $availability->start_time }}" placeholder="{{ $availability->start_time }}"> 
                                       </td>
                                       <td data-name="close_time">
                                          <input type="text" class="form-control color-bg" value="{{ $availability->close_time }}" placeholder="{{ $availability->close_time }}">  
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                           @else
                            <h4>No Availability Found.</h4>
                           @endif
                        </div>
                     </div>
                     <div class="add-day-btn"> 
                        <button id="add_row" type="button" class="btn main-btn mb-3 mb-md-0 p-3 primary-text primary-border" data-toggle="modal" data-target="#addDayModal"><i class="fa fa-plus pe-2" aria-hidden="true"></i> Add Day</button> 
                            <!--Add Day Modal -->
                            <div class="modal fade" id="addDayModal" tabindex="-1" aria-labelledby="addDayModalLabel" aria-hidden="true">
                               <form method="post" action="{{ route('submit.member.availability',$member[0]->id) }}" enctype="multipart/form-data">
                                  @csrf
                                  <div class="modal-dialog">
                                     <div class="modal-content">
                                        <div class="modal-header">
                                           <h5 class="modal-title" id="videoModalLabel">Add Availability</h5>
                                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                           </button>
                                        </div> 
                                        <div class="modal-body">
                                           <div class="row">
                                              <div class="form-group col-md-12">
                                                 <label for="day_name">Day</label>
                                                 <select id="day_name" name="day_name" class="form-control @error('day_name') is-invalid @enderror" required>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thrusday">Thrusday</option>
                                                    <option value="Friday">Friday</option>
                                                 </select>
                                                 @error('day_name')
                                                 <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                                 </span>
                                                 @enderror
                                              </div>
                                              <div class="form-group col-md-6">
                                                 <label for="start_time "> Start Time </label>
                                                <div class="input-group date" id="start_time" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#start_time" name="start_time">
                                            <div class="input-group-append" data-target="#start_time" data-toggle="datetimepicker">
                                        		<div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        	</div>
                                        </div>
                                              </div>
                                              <div class="form-group col-md-6">
                                                 <label for="end_time">End Time</label>
                                                <div class="input-group date" id="end_time" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#end_time" name="end_time">
                                            <div class="input-group-append" data-target="#end_time" data-toggle="datetimepicker">
                                        		<div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        	</div>
                                        </div>
                                              </div>
                                              <div class="form-group col-md-12">
                                                 <label for="status">Select Status</label>
                                                 <select name="status" class="form-control">
                                                    <option value="Active" >Active</option>
                                                    <option value="DeActive" >Deactive</option>
                                                 </select>
                                              </div>
                                           </div>
                                        </div>
                                        <div class="modal-footer">
                                           <button type="submit" class="btn btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Submit</button>
                                        </div>
                                     </div>
                                  </div>
                               </form>
                            </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="activity-tabs-settings">
                  <div class="activity-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Activity </h4>
                     </div>
                     <div class="row">
                        <!--Videos block-->
                        <div class="col-md-12">
                           <div class="activity-block-content border-gray rounded-3 p-4 mb-4">
                              <h5 class="mb-0"> Videos </h5>
                              <p class="text-color mb-0 py-3"> You can add your popular videos here by adding the link for them </p>
                              <!-- Button trigger modal -->
                              <button type="button" class="btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4" data-toggle="modal" data-target="#videoaddModal">
                              Add Video
                              </button>
                              <!--video Modal -->
                              <div class="modal fade" id="videoaddModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                                <form method="post" action="{{ route('submit.member.video',$member[0]->id) }}" enctype="multipart/form-data">
                                    @csrf
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="videoModalLabel">Add Video</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="form-group col-md-12">
                                                <label for="video_name">Video Title</label>
                                                <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Video Title" required>
                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                             <div class="form-group col-md-12">
                                                <label for="link">Add Video Link</label>
                                                <input type="text" name="link" value="" placeholder="Add Video Link" class="form-control">
                                             </div>
                                             <div class="form-group col-md-12">
                                                <label for="video">Video Uplaod</label><br>
                                                <input type="file" id="video" name="video[]" class="p-0 @error('video') is-invalid @enderror" accept="video/*">
                                                @error('video')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                             <div class="form-group col-md-12">
                                                <label for="status">Select Status</label>
                                                <select name="status" class="form-control">
                                                   <option value="Active" >Active</option>
                                                   <option value="DeActive" >Deactive</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="submit" class="btn btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Save changes</button>
                                       </div>
                                    </div>
                                 </div>
                                </form>
                              </div>
                              <!--add video-->
                              <div class="row">
                                @if(count($member[0]->userVideoList) > 0)
                                    @foreach($member[0]->userVideoList as $video)
                                    <div class="col-md-4"> 
                                        <div class="video-play mb-3 mb-md-0">
                                           @if($video->upload_type == "Video")
                                            <video class="img-fluid" width="180" controls>
                                                <source src="{{ asset('public/upload/user_video').'/'.$video->file_name }}" type="video/mp4">
                                            </video> 
                                            @else
                                                <img class="img-fluid" src="{{ asset('public/upload/user_video').'/'.$video->file_name }}">
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div class="col-md-6"><h4>No Video Found.</h4></div>
                                @endif
                              </div>
                           </div>
                        </div>
                        <!--Articles block-->
                        <div class="col-md-12">
                           <div class="article-block-content border-gray rounded-3 p-4 mb-4">
                              <h5 class="mb-0"> Social Feed </h5>
                              <p class="text-color mb-0 py-3"> You can add your popular videos here by adding the link for them </p>
                              <div class="activity_btn"> 
                                 <!-- Button trigger modal -->
                                 <button type="button" class="main-btn main-btn-bg px-5 mt-1 mb-4 py-4" data-toggle="modal" data-target="#socialFeedDddModal">Add Social Feed</button>
                                 <!--video Modal -->
                                 <div class="modal fade" id="socialFeedDddModal" tabindex="-1" aria-labelledby="socialFeedModalLabel" aria-hidden="true">
                                 <form method="post" action="{{ route('submit.member.social.feed',$member[0]->id) }}" enctype="multipart/form-data">
                                       @csrf 
                                    <div class="modal-dialog">
                                       <div class="modal-content">
                                          <div class="modal-header">
                                             <h5 class="modal-title" id="socialFeedModalLabel">Add Social Feed</h5>
                                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                             </button>
                                          </div>
                                          <div class="modal-body">
                                             <div class="row">
                                                <div class="form-group col-md-6">
                                                   <label for="name">Name</label>
                                                   <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Enter name" required>
                                             @error('name')
                                             <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $message }}</strong>
                                                   </span>
                                                   @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="username">Username</label>
                                                   <input type="text" name="username" value="" placeholder="Enter Username" class="form-control">
                                                </div>
                                                <div class="form-group col-md-12">
                                                   <label for="desc">Descrption</label><br>
                                                   <textarea name="desc" rows="4" cols="50" class="form-control description" placeholder="Add Descrption here"></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="image">Image Uplaod</label><br>
                                                   <input type="file" id="image" name="image[]" class="p-0">
                                                </div>
                                                <div class="form-group col-md-6">
                                                   <label for="status">Select Status</label>
                                                   <select name="status" class="form-control">
                                                      <option value="Active" >Active</option>
                                                      <option value="DeActive" >Deactive</option>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="modal-footer">
                                             <button type="submit" class="btn btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Submit</button>
                                          </div>
                                       </div>
                                    </div>
                                 </form>
                                 </div>
                              </div>
                              <!--Social feed list-->
                              <div class="row">
                              @if(count($member[0]->userSocialFeedList) > 0)
                                 @foreach($member[0]->userSocialFeedList as $social)
                                 <div class="col-md-6">
                                    <div class="article-block border-gray p-lg-4 p-md-2 p-4 rounded-3 mb-3">
                                       <div class="social-header d-flex position-relative">
                                          <img class="img-fluid" src="{{ asset('public/upload/user_social_feed').'/'.$social->image }}" alt="{{ $social->image }}">
                                          <div class="social-name pl-3">
                                             <h6 class="fw-600 mb-1"> {{ $social->name }} </h6>
                                             <p> {{ $social->username }} </p>
                                          </div>
                                       </div>
                                       <div class="detail-para pt-3">
                                           @php
	                                                echo $social->desc;
                                                @endphp 
                                          <small> {{ date('h:m a', strtotime($social->created_at)) }} - {{ date('d M Y', strtotime($social->created_at)) }} </small>
                                       </div> 
                                    </div>
                                 </div>
                                 @endforeach
                                 @else 
                                    <div class="col-md-6"><h4>No Social Feed Found.</h4></div>
                                  @endif
                              </div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="article-block-content border-gray rounded-3 p-4 mb-4">
                              <h5 class="mb-0"> Articles </h5>
                              <p class="text-color mb-0 py-3"> You can add your popular videos here by adding the link for them </p>
                              <!-- Button trigger modal -->
                              <button type="button" class="btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4" data-toggle="modal" data-target="#articleModal">
                              Add Article
                              </button>
                              <!-- Modal -->
                              <div class="modal fade" id="articleModal" tabindex="-1" aria-labelledby="articleModalLabel" aria-hidden="true">
                                <form method="post" action="{{ route('submit.member.article',$member[0]->id) }}" enctype="multipart/form-data">
                                    @csrf
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header">
                                          <h5 class="modal-title" id="articleModalLabel">Add Article</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                          </button>
                                       </div>
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="form-group col-md-12">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" value="" class="form-control @error('name') is-invalid @enderror" placeholder="Enter Article Name" required>
                                                 @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                             </div>
                                             <div class="form-group col-md-12 mt-4">
                                                <label for="desc">Descrption</label> 
                                                <textarea name="desc" rows="4" cols="50" class="form-control description" placeholder="Add Descrption here"></textarea> 
                                             </div>
                                             <div class="form-group col-md-6 upload-content pl-3">
                                                <p class="pt-2"> Upload a photo</p>
                                        <input type="file" id="image" name="image[]" class="p-0">
                                             </div>
                                             <div class="form-group col-md-6 mt-4">
                                                <label for="status">Select Status</label>
                                                <select name="status" class="form-control">
                                                   <option value="Active" >Active</option>
                                                   <option value="DeActive" >Deactive</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="submit" class="btn btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Add Article</button>
                                       </div>
                                    </div>
                                 </div>
                                 </form>
                              </div>
                              <!--add articles-->
                              <div class="row">
                                @if(count($member[0]->userArticleList) > 0)
                                @foreach($member[0]->userArticleList as $article) 
                                     <div class="col-lg-4 col-md-6">
                                        <div class="articles-detail border-gray p-4 rounded-3 h-md-100 clr-text mb-3 mb-md-0">
                                            @if($article->image)
                                                <img class="img-fluid" src="{{ asset('public/upload/user_article').'/'.$article->image }}" alt="{{ $article->image }}">
                                           @endif
                                           <h4 class="py-2 mt-1 fw-600">{{ $article->name }}</h4>
                                           <div class="mb-0">
                                               @php
	                                                echo $article->desc;
                                                @endphp
                                            </div>
                                        </div>
                                     </div>
                                     @endforeach
                                 @else 
                                    <div class="col-md-6"><h4>No Artical Found.</h4></div>
                                  @endif
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="business-details-tabs-settings">
                 <form method="post" action="{{ route('update.member.business.detail',$member[0]->id) }}" enctype="multipart/form-data">
                  @csrf
                    <div class="business-detail-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Business Details </h4>
                     </div>
                     <div class="mb-3 col-md-9">
                        <label for="lastname" class="form-label pb-1 fw-500">Biography</label> <br>
                        <textarea class="w-100 color-bg border-0 p-3 description" rows="6" cols="50" name="biography" placeholder="Add your biography">{{ $member[0]->biography }}</textarea>
                        @error('biography')
                           <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                           </span>
                        @enderror
                     </div>
                     <div class="button-site"> 
                       <button type="submit" class="main-btn main-btn-bg px-5"> Save Changes </button> 
                     </div>
                    </div>
                  </form>
                  <div class="show-result-articles bg-white rounded-3 px-4">
                     <div class="Education-content border-bottom  py-4 mb-3 ">
                        <div class="form-heading">
                           <h4 class="form_head pb-3"> Education </h4>
                        </div>
                        @if(count($member[0]->userEducationList) > 0)
                            @foreach($member[0]->userEducationList as $article)
                            <div class="education-content d-flex">
                               <div class="education-img"> 
                                  <img class="img-fluid" src="{{ asset('public/admin/images/edu-2.png') }}">
                               </div>
                               <div class="education-content pl-3">
                                  <h6 class="fw-600"> {{ $article->type }} </h6>
                                  <p class="mb-0 pb-2"> {{ $article->position }}/{{ $article->name }} </p>
                                  <small class="text-color"> Sep 2020 to Dec 2020 </small>
                               </div>
                            </div>
                            @endforeach
                        @else
                            <div class="education-content d-flex"><h4>No Education Found.</h4></div>
                        @endif
                     </div>
                     <!-- Button trigger modal -->
                     <button type="button" class="btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4" data-toggle="modal" data-target="#educationModal">
                     Add 
                     </button>
                     <!-- Modal -->
                     <div class="modal fade" id="educationModal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
                        <form method="post" action="{{ route('submit.member.education',$member[0]->id) }}" enctype="multipart/form-data">
                          @csrf
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title" id="educationModalLabel">Education Detail</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="form-group col-md-12">
                                       <label for="name">Title</label>
                                       <input type="text" name="name" value="" class="form-control  @error('name') is-invalid @enderror" placeholder="Enter Title" required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="position">Position</label>
                                       <input type="text" name="position" value="" class="form-control" placeholder="Enter Position">
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="business_type">Type</label>
                                       <select name="type" class="form-control">
                                          <option value="Education" selected="">Education</option>
                                          <option value="Job">Job</option>
                                          <option value="Other">Other</option>
                                       </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="start_date">Start Date</label>
                                       <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="start_date">
                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                        		<div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        	</div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="end_date">End Date</label>
                                       <div class="input-group date" id="reservationdate2" data-target-input="nearest">
                                            <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate2" name="end_date">
                                            <div class="input-group-append" data-target="#reservationdate2" data-toggle="datetimepicker">
                                        		<div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        	</div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="submit" class="btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Save changes</button>
                              </div>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               @else
               <div class="form-group">
                  <p>No Result Found</p>
               </div>
               @endif
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
</div>
<!-- /.content-wrapper -->
@endsection