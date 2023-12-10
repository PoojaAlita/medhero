@extends('layouts.master')
@php
    $user = Auth::user();
    dd($user)
@endphp
@push('plugin-styles')
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
<link href="{{ asset('css/model.css') }}" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('css/step_form.css')}}" rel="stylesheet" /> 

@endpush
@section('pageTitle', 'Complete Hospital Profile')
@section('content')

<div class="tab-wrapper">
    <div class="tab tab_1" id="tab_1" style="display:block">
        <div class="container">
            <div class="form-sign-wrapper">
                <h1>User Details</h1>
                <div class="row-one">
                    <p class="p-require">* Indicates required</p>
                    <form class="frm-details" id="user_detail" method="POST" action="{{ route('store.userData') }}">
                        @csrf
                        <input type="hidden" id="timezone" name="timezone">
                        <div class="form-group row">
                            <div class="form-check col">
                              <input type="radio" class="form-check-input" name="user_status" id="doctor" checked value="doctor">
                              <label class="form-check-label" for="doctor">
                                I'm Doctor
                              </label>
                            </div>
                            <div class="form-check col">
                              <input type="radio" class="form-check-input" name="user_status" id="hospital" value="hospital">
                              <label class="form-check-label" for="hospital">
                                I'm Hospital
                              </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Phone number</label>
                            <input type="number" class="form-control" name="mobile_number"  placeholder="Phone Number"  value={{old('mobile_number')}}>
                            <div class="text-danger">
                              @error('mobile_number')
                                {{$message}}
                              @enderror
                            </div>
                        </div>
                        <div class="submit-btn">
                            <button type="submit" value="Next">Next</button>
                        </div>
                            
                    </form>
                    {{-- <div class="prev-next-btn">
                        <button type="button" class="btn btn-primary" id="user_detail_submit">Next</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('plugin-scripts')
    <script src="{{ asset('assets/plugins/select2/select2.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>
@endpush

@push('custom-scripts')
    <script>
        $(document).ready(function() {
        $('#timezone').val(moment.tz.guess())
        });        
    </script>
    <script src="{{ asset('assets/js/select2.js') }}"></script>
    <script src="{{ asset('assets/js/profile.js') }}"></script>
@endpush