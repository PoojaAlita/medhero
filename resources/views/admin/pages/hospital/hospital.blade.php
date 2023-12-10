@extends('admin.layouts.master')
@section('title',"Hospital")
@section('plugin-css')
  <link href="{{ asset('admin/assets/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin/assets/css/dropzone.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />

@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-10">
                  <h6 class="page-title">Hospitals</h6>
                </div>
                <div class="col-md-2">
                  <a  class="btn btn-primary add_hospital"  style="float: right" id="add_hospital">Add Hospital</a>
            </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                 
                  <div class="table-responsive mt-2">
                    <table id="hospital_tbl" class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Address</th>
                          <th>Public/Private Hospital</th>
                          <th>Cover Image</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>

<!-- Hospital Modal -->
<div class="modal fade select  bd-example-modal-md addmodal" id="hospital_modal" tabindex="-1" aria-labelledby="title_hospital_modal" aria-hidden="true">
  <div class="loader-background" id="loader_bg" style="display:none">
    <div class="spinner-border"  id="loader"   role="status"></div>
 </div> 
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title_hospital_modal">Add Hospital </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
      </div>
      <div class="modal-body">
        <form class="forms-sample" method="POST" enctype="multipart/form-data" id="hospital_form">
          @csrf
          <input type="hidden" name="id" class="id" id="id" value="">
     
          <div class="row">
              <label class="form-label">Name</label>
              <div class="form-group mb-3">
                <input type="text" name="name" id="name" class="form-control" placeholder="Please Enter Name">
              </div>
          </div>

          <div class="row">
            <label class="form-label">Email</label>
            <div class="form-group mb-3">
                <input type="email" name="email" id="email" class="form-control" placeholder="Please Enter Email">
            </div>
         </div>

         <div class="form-group exampleInputPassword" style="display: none">
          <label for="exampleInputPassword">Password</label>
          <div class="form-group mb-3">
            <input type="password" class="form-control" id="password" name="password"  aria-describedby="emailHelp" placeholder="Please Enter Password">
            <span class="text-danger error_password"></span>
          </div>
        </div>
       
         <div class="row">
          <label class="form-label">Contact Number</label>
          <div class="form-group mb-3">
              <input type="text" name="contact" id="contact" class="form-control" placeholder="Please Enter Contact Number">
          </div>
        </div>

        <div class="form-group">
          <label for="exampleInputAddress">Address</label>
          <div class="form-group mb-3">
            <input type="text" class="form-control" name="address" id="address"  placeholder="Please Enter Adderss">
          </div>
          <span class="text-danger error_address"></span>
        </div>

        <div class="form-group" id="latitudeArea">
            <input type="hidden" id="lat" name="latitude" class="form-control">
        </div>
        <div class="form-group" id="longtitudeArea">
            <input type="hidden" name="longitude" id="lng" class="form-control">
        </div>

        <div class="form-group public_private-hospital mb-3">
          <label for="exampleInputPublicPrivateHospital">Public/Private Hospital</label> 
          <select class="select_dropdown form-select public-private-hospital select2 form-control" data-width="100%" name="public_private_hospital">
            <option selected disabled value="0">Select Public/Private Hospital</option>
            <option value="0">Public</option>
            <option value="1">Private</option>
         </select>
        </div>

        <div class="form-group cover">
          <label for="exampleInputCoverImage">Cover Image</label>
          <div class="form-group mb-3">
            <input type="file" class="form-control" name="cover_image" id="cover_image">
          </div>
          <div class="cover_images">
            <img class="profile_cover" src="" alt="" style="width: 100px;">
          </div>
        </div>
        <div class="form-group ">
          <label for="exampleInputThumbImage">Thumb Image</label>
          <div class="form-group mb-3" >
            <input type="file" class="form-control"id="thumb_image"  name="thumb_image[]" multiple accept='image/*' onchange="addImagesToList();" />
          </div>
          <div class="col-3"  id="img-upload" ></div>
          <div class="mb-3">
            <div id='preview'></div>
          </div>
        </div>
        
          <button class="btn btn-primary submit_hospital" type="button"></button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
@section('plugin-script')
    <script src="{{ asset('assets/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyByMhYirwn_EOt2HPNbeWtVE-BVEypa6kI"></script>
@endsection
@section('costome-script')
  <script src="{{ asset('assets/js/select2.js') }}"></script>
   <script src="{{ asset('assets/js/location_serach.js') }}"></script>
   <script src="{{ asset('admin/assets/js/hospital.js')}}"></script>
@endsection
