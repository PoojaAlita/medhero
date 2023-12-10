@extends('admin.layouts.master')
@section('title',"Doctor")
@section('plugin-css')
  <link href="{{ asset('admin/assets/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin/assets/select2/select2.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="page-title-box">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h6 class="page-title">Doctors </h6>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
          <div class="loader-background" id="loader_bg" style="display:none">
            <div class="spinner-border"  id="loader"   role="status"></div>
         </div>
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="table-responsive mt-2">
                    <table id="doctor_tbl" class="table">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Address</th>
                          <th>Longitude</th>
                          <th>Latitude</th>
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

@endsection
@section('plugin-script')
    <script src="{{ asset('admin/assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin/assets/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
 
@endsection
@section('costome-script')
<script src="{{ asset('admin/assets/js/doctor.js')}}"></script>
@endsection
