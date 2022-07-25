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
               <h1>Edit Firm</h1>
            </div>
            <div class="col-sm-12">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Firm  </li>
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
               <a class="nav-link" id="activity-tabs-settings-tab" data-toggle="pill" href="#activity-tabs-settings" role="tab" aria-controls="activity-tabs-settings" aria-selected="false">Activity</a>
               <a class="nav-link" id="business-details-tabs-settings-tab" data-toggle="pill" href="#business-details-tabs-settings" role="tab" aria-controls="business-details-tabs-settings" aria-selected="false">Business Details</a>
            </div>
         </div>
         <div class="col-7 col-sm-9">
            <div class="tab-content" id="vert-tabs-tabContent">
            @if(count($firm) == 1)
               <div class="tab-pane fade show active" id="general-tabs-profile">
                 @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                  @endif
                  @if (session('unsuccess'))
                    <p class="alert alert-danger">{{ session('unsuccess') }}</p>
                  @endif
                  <form method="post" action="{{ route('update.firm',$firm[0]->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="personal-info-block">
                           <div class="form-heading mb-4">
                              <h4 class="form_head pb-2"> Personal Info </h4>
                           </div>
                           <div class="upload-photo d-flex align-items-center mb-4">
                              <div class="photo-uploaded">
                                <img class="img-fluid" src="{{ asset('public/upload/firm').'/'.$firm[0]->logo }}" alt="{{ $firm[0]->logo }}">
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
                        <input type="text" name="name" value="{{ $firm[0]->name }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')
                          <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                     </div>
                     <div class="form-group col-md-6">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" name="phone_number" value="{{ $firm[0]->phone_number }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="address1">Address1</label>
                        <input type="text" name="address1" value="{{ $firm[0]->address1 }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="city">City</label>
                        <input type="text" name="city" value="{{ $firm[0]->city }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="postal_code">Postal Code</label>
                        <input type="text" name="postal_code" value="{{ $firm[0]->postal_code }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="state_code">State Code</label>
                        <select name="state_code" class="form-control">
                        <option value="NJ" @if($firm[0]->state_code == "NJ") selected  @endif >NJ</option>
                        <option value="PA" @if($firm[0]->state_code == "PA") selected  @endif >PA</option>
                        <option value="CT" @if($firm[0]->state_code == "CT") selected  @endif >CT</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="country_code">Country Code</label>
                        <select name="country_code" class="form-control">
                        <option value="USA" @if($firm[0]->country_code == "USA") selected  @endif >USA</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="prsnl_website">Personal Website</label>
                        <input type="text" name="prsnl_website" value="{{ $firm[0]->prsnl_website }}" class="form-control">
                     </div>
                     <div class="form-group col-md-6">
                       <label for="status">status</label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                          <option value="DeActive" @if($firm[0]->status == "DeActive") selected  @endif >DeActive</option>
                          <option value="Active" @if($firm[0]->status == "Active") selected  @endif >Active</option>
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
                          @if($firm[0]->cover_color)
                            <input type="color" id="favcolor" name="cover_color" value="{{ $firm[0]->cover_color }}" placeholder="#0B5510" class="p-1"> 
                            @else 
                                <input type="color" id="favcolor" name="cover_color" value="#0B5510" placeholder="#0B5510" class="p-1">
                            @endif
                        </div>
                        <div class="form-group col-md-12">
                           <label for="quote_info">Personal Quote</label> 
                           <textarea name="quote_info" rows="4" cols="50" class="form-control" placeholder="Add your personal quote here">{{ $firm[0]->quote_info }}</textarea>
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
                           <input type="text" name="twitter" value="{{ $firm[0]->twitter }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                           <label for="linked_in">Linked in</label>
                           <input type="text" name="linked_in" value="{{ $firm[0]->linked_in }}" class="form-control">
                        </div>
                      </div>
                    </div> 
                    <div class="button-site"> 
                      <button class="main-btn main-btn-bg px-5" type="submit"> Save Changes </button>  
                    </div>
                  </form>
               </div>
               <div class="tab-pane fade" id="professional-tabs-messages">
                  <form method="post" action="{{ route('update.firm.professinoal.services',$firm[0]->id) }}" enctype="multipart/form-data">
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
                      @if(count($firm[0]->firmAssignServices) > 0)
                     <div class="service-cross-btn d-lg-flex py-4 position-relative">
                        <ul>
                        @foreach($firm[0]->firmAssignServices as $service)
                         <li class="professional-services">
                            {{ $service->firmAssignServicesDetails->name }}
                            <a href="{{ url('admin/delete-assign-firm-service').'/'.$firm[0]->firmAssignServices[0]->firm_id.'/'.$service->firmAssignServicesDetails->id }}" class="main-btn mb-3 mb-lg-0"><i class="fa fa-times-circle" aria-hidden="true"></i> </a> 
                        </li>
                        @endforeach
                        </ul>
                     </div>
                     @endif 
                  </div> 
                  <div class="button-site"> 
                    <button type="submit" class="main-btn main-btn-bg px-5"> Save Changes </button> 
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
                                    <tr id="addr0" data-id="0" class="hidden">
                                       <td data-name="name">
                                          <select id="select_days" class="form-select color-bg border-0" aria-label="Default select">
                                             <option selected="">Monday</option>
                                             <option value="1">Tuesday</option>
                                             <option value="2">Wednesday</option>
                                             <option value="3">Thrusday</option>
                                             <option value="1">Friday</option>
                                             <option value="2">Saturday</option>
                                          </select>
                                       </td>
                                       <td data-name="startime">
                                          <input type="text" class="form-control color-bg" id="startime" placeholder="7:15 am"> 
                                       </td>
                                       <td data-name="endtime">
                                          <input type="text" class="form-control color-bg" id="endtime" placeholder="3:30 pm">  
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                     <div class="add-day-btn"> <a id="add_row" class="btn main-btn mb-3 mb-md-0 p-3 primary-text primary-border"><i class="fa fa-plus pe-2" aria-hidden="true"></i> Add Day</a> </div>
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
                                                <input type="text" name="video_name" value="" class="form-control" placeholder="Enter Video Title">
                                             </div>
                                             <div class="form-group col-md-12">
                                                <label for="video_name">Add Video Link</label>
                                                <input type="text" name="video_name" value="" placeholder="Add Video Link" class="form-control">
                                             </div>
                                             <div class="form-group col-md-12">
                                                <label for="video_name">Video Uplaod</label><br>
                                                <input type="file" id="videoFile" name="filename" class="p-0" accept="video/*">
                                             </div>
                                             <div class="form-group col-md-12">
                                                <label for="status_type">Select Status</label>
                                                <select name="status_type" class="form-control">
                                                   <option value="Active" selected="">Active</option>
                                                   <option value="DeActive" selected="">Deactive</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Save changes</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!--add video-->
                              <div class="row">
                                 <div class="col-md-4">
                                    <div class="video-play mb-3 mb-md-0">
                                       <img class="img-fluid" src="{{ asset('public/admin/images/video-1.png') }}">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="video-play mb-3 mb-md-0">
                                       <img class="img-fluid" src="{{ asset('public/admin/images/video-2.png') }}">
                                    </div>
                                 </div>
                                 <div class="col-md-4">
                                    <div class="video-play mb-3 mb-md-0">
                                       <img class="img-fluid" src="{{ asset('public/admin/images/video-3.png') }}">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--Articles block-->
                        <div class="col-md-12">
                           <div class="article-block-content border-gray rounded-3 p-4 mb-4">
                              <h5 class="mb-0"> Social Feed </h5>
                              <p class="text-color mb-0 py-3"> You can add your popular videos here by adding the link for them </p>
                              <div class="activity_btn">
                                 <button class="main-btn main-btn-bg px-5 mt-1 mb-4 py-4"> Add Social Feed </button>
                              </div>
                              <!--add Articles-->
                              <div class="row">
                                 <div class="col-md-6">
                                    <!--1-->
                                    <div class="article-block border-gray p-lg-4 p-md-2 p-4 rounded-3 mb-3">
                                       <div class="social-header d-flex position-relative">
                                          <img class="img-fluid" src="{{ asset('public/admin/images/social-1.png') }}">
                                          <div class="social-name pl-3">
                                             <h6 class="fw-600 mb-1"> Chris Porter y </h6>
                                             <p> @johndoe </p>
                                          </div>
                                       </div>
                                       <div class="detail-para pt-3">
                                          <p> Donec dapibus mauris id odio ornare tempus. Duis sit amet </p>
                                          <small> 1:20 PM - Nov 15,2020 </small>
                                       </div>
                                    </div>
                                 </div>
                                 <!---2--->
                                 <div class="col-md-6">
                                    <div class="article-block border-gray p-lg-4 p-md-2 p-4 rounded-3 mb-3 mb-md-0">
                                       <div class="social-header d-flex position-relative">
                                          <img class="img-fluid" src="{{ asset('public/admin/images/social-4.png') }}">
                                          <div class="social-name pl-3">
                                             <h6 class="fw-600 mb-1"> Sandra Wallace </h6>
                                             <p> @johndoe </p>
                                          </div>
                                       </div>
                                       <div class="detail-para pt-3">
                                          <p> Donec dapibus mauris id odio ornare tempus. Duis sit amet </p>
                                          <small> 1:20 PM - Nov 15,2020 </small>
                                       </div>
                                    </div>
                                 </div>
                                 <!------>
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
                                                <label for="article_name">Name</label>
                                                <input type="text" name="article_name" value="" class="form-control" placeholder="Enter Article Name">
                                             </div>
                                             <div class="upload-content pl-3">
                                                <p class="pt-2"> Upload a photo</p>
                                                <form>
                                                   <input type="file" id="myphoto" name="filename" class="p-0">
                                                </form>
                                             </div>
                                             <div class="form-group col-md-12 mt-4">
                                                <label for="infodes">Add Descrption</label> 
                                                <textarea name="infodes" rows="4" cols="50" class="form-control" placeholder="Add Descrption here"></textarea>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="modal-footer">
                                          <button type="button" class="btn btn main-btn main-btn-bg px-5 mt-1 mb-4 py-4">Add Article</button>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!--add articles-->
                              <div class="row">
                                 <div class="col-lg-4 col-md-6">
                                    <div class="articles-detail border-gray p-4 rounded-3 h-md-100 clr-text mb-3 mb-md-0">
                                       <img class="img-fluid" src="{{ asset('public/admin/images/articles-1.png') }}">
                                       <h4 class="py-2 mt-1 fw-600"> Avoid consumer debt like the plague </h4>
                                       <p class="mb-0"> Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo, quis tempor ligula. Quisque quis pharetra felis.
                                          Ut quis consequat orci, at consequat felis. Suspendisse auctor laoreet placerat. Nam et
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-6">
                                    <div class="articles-detail border-gray p-4 rounded-3 h-md-100 clr-text mb-3 mb-md-0">
                                       <h4 class="pb-2 fw-600"> Avoid consumer debt like the plague </h4>
                                       <p class="mb-0"> Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo, quis tempor ligula. Quisque quis pharetra felis.
                                          Ut quis consequat orci, at consequat felis. Suspendisse auctor laoreet placerat. Nam et risus non lacus dignissim lacinia
                                          sit amet nec eros. Nulla vel urna quis libero pharetra varius. Nulla tellus nunc, malesuada at
                                       </p>
                                    </div>
                                 </div>
                                 <div class="col-lg-4 col-md-6">
                                    <div class="articles-detail border-gray p-4 rounded-3 h-md-100 clr-text mb-3 mb-md-0">
                                       <h4 class="pb-2 fw-600"> Avoid consumer debt like the plague </h4>
                                       <p class="mb-0"> Donec dapibus mauris id odio ornare tempus. Duis sit amet accumsan justo, quis tempor ligula. Quisque quis pharetra felis.
                                          Ut quis consequat orci, at consequat felis. Suspendisse auctor laoreet placerat. Nam et
                                       </p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="tab-pane fade" id="business-details-tabs-settings">
                 <form method="post" action="{{ route('update.firm.business.detail',$firm[0]->id) }}" enctype="multipart/form-data">
                  @csrf
                    <div class="business-detail-block bg-white p-4 mb-3 rounded-3">
                     <div class="form-heading">
                        <h4 class="form_head pb-3"> Business Details </h4>
                     </div>
                     <div class="mb-3 col-md-9">
                        <label for="biography" class="form-label pb-1 fw-500">Biography</label> <br>
                        <textarea class="w-100 color-bg border-0 p-3 description  @error('biography') is-invalid @enderror" rows="6" cols="50" name="biography" placeholder="Add your biography">{{ $firm[0]->biography }}</textarea>
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