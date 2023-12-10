<!DOCTYPE html>
  <head>
    <title>Registration</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
     <!-- CSRF Token -->
     <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('images/favicon-32x32.png')}}">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> --}}
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" />    
    <link href="{{asset('css/login.css')}}" rel="stylesheet" />    
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">  
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <!-- Select2-->
    <link href="{{ asset('admin/assets/select2/select2.min.css') }}" rel="stylesheet" />
    <!-- Sweet Alert-->
    <link href="{{asset('admin/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

  </head>
 
  <body>
    <section class="sec-login">
      <div class="container-fluid">
        <div class="login-content">
          <div class="logo-main"><a href="#"><svg width="240" height="49" viewBox="0 0 240 49" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M72.2036 12.96V41H66.2036V25.44L59.2436 39.16L51.6836 24.96V41H45.6836V12.96H52.0836L59.1236 26.2L65.8436 12.96H72.2036ZM78.1914 18.6V13.08H97.1514V18.6H78.1914ZM78.1914 30.36V24.84H97.1514V30.36H78.1914ZM97.1514 35.52V41.04H78.1914V35.52H78.4314H97.1514ZM115 13.08C116.413 13.08 117.747 13.3333 119 13.84C120.253 14.3467 121.347 15.0267 122.28 15.88C123.213 16.7333 123.947 17.7467 124.48 18.92C125.04 20.0667 125.32 21.2933 125.32 22.6V31.52C125.32 32.8267 125.04 34.0667 124.48 35.24C123.947 36.3867 123.213 37.3867 122.28 38.24C121.347 39.0933 120.253 39.7733 119 40.28C117.747 40.7867 116.413 41.04 115 41.04H103.2V39.96V35.68H103.16V35.52H109.2H109.48H115C115.587 35.52 116.147 35.4133 116.68 35.2C117.213 34.9867 117.667 34.7067 118.04 34.36C118.44 33.9867 118.747 33.56 118.96 33.08C119.2 32.6 119.32 32.08 119.32 31.52V22.6C119.32 22.04 119.2 21.52 118.96 21.04C118.747 20.56 118.44 20.1467 118.04 19.8C117.667 19.4267 117.213 19.1333 116.68 18.92C116.147 18.7067 115.587 18.6 115 18.6H103.2V13.08H115Z" fill="#002148"/>
            <path d="M131.293 19.8V13H137.293V19.8H131.293ZM152.453 13V30.88H137.293V41H131.293V30.88V25.32H137.293H146.453V13H152.453ZM146.453 41V36.4H152.453V41H146.453ZM158.41 18.6V13.08H177.37V18.6H158.41ZM158.41 30.36V24.84H177.37V30.36H158.41ZM177.37 35.52V41.04H158.41V35.52H158.65H177.37ZM205.499 22.96C205.499 24.9333 204.966 26.72 203.899 28.32C202.832 29.8933 201.432 31.0933 199.699 31.92L204.939 41H198.059L193.419 32.92H189.379V41.04H183.379V27.12H189.379H195.179C195.766 27.12 196.326 27.0133 196.859 26.8C197.392 26.5867 197.846 26.2933 198.219 25.92C198.619 25.52 198.926 25.0667 199.139 24.56C199.379 24.0533 199.499 23.52 199.499 22.96C199.499 22.3733 199.379 21.8267 199.139 21.32C198.926 20.8133 198.619 20.3733 198.219 20C197.846 19.6267 197.392 19.3333 196.859 19.12C196.326 18.88 195.766 18.76 195.179 18.76H189.939H183.379V13H195.179C196.592 13 197.926 13.2667 199.179 13.8C200.432 14.3067 201.526 15.0133 202.459 15.92C203.392 16.8267 204.126 17.8933 204.659 19.12C205.219 20.32 205.499 21.6 205.499 22.96ZM233.672 15.92C234.898 17.12 235.832 18.4667 236.472 19.96C237.138 21.4267 237.472 23 237.472 24.68V29.52C237.472 31.1733 237.138 32.7467 236.472 34.24C235.832 35.7333 234.898 37.0667 233.672 38.24C232.445 39.44 231.045 40.3467 229.472 40.96C227.898 41.5733 226.245 41.88 224.512 41.88C222.752 41.88 221.085 41.5733 219.512 40.96C217.938 40.3467 216.538 39.44 215.312 38.24C214.085 37.0667 213.138 35.7333 212.472 34.24C211.832 32.7467 211.512 31.1733 211.512 29.52V24.68C211.512 23 211.832 21.4267 212.472 19.96C213.138 18.4667 214.085 17.12 215.312 15.92C216.538 14.7467 217.938 13.8533 219.512 13.24C221.085 12.6267 222.752 12.32 224.512 12.32C226.245 12.32 227.898 12.6267 229.472 13.24C231.045 13.8533 232.445 14.7467 233.672 15.92ZM231.472 24.68C231.472 23.7733 231.285 22.92 230.912 22.12C230.565 21.2933 230.072 20.5733 229.432 19.96C228.792 19.3467 228.045 18.8667 227.192 18.52C226.365 18.1733 225.472 18 224.512 18C223.552 18 222.645 18.1733 221.792 18.52C220.938 18.8667 220.192 19.3467 219.552 19.96C218.912 20.5733 218.405 21.2933 218.032 22.12C217.685 22.92 217.512 23.7733 217.512 24.68V29.52C217.512 30.4533 217.685 31.32 218.032 32.12C218.405 32.92 218.912 33.6267 219.552 34.24C220.192 34.8267 220.938 35.2933 221.792 35.64C222.645 35.9867 223.552 36.16 224.512 36.16C225.472 36.16 226.365 35.9867 227.192 35.64C228.045 35.2933 228.792 34.8267 229.432 34.24C230.072 33.6267 230.565 32.92 230.912 32.12C231.285 31.32 231.472 30.4533 231.472 29.52V24.68Z" fill="#569CCC"/>
            <path d="M19.035 24.0306V11.7021H23.9343V18.9306H30.6808L30.721 24.0306H19.035Z" fill="#569CCC"/>
            <path d="M35.5801 25.9182H19.035L19.0752 46.9207H23.9343V31.0182H35.5801V25.9182Z" fill="#569CCC"/>
            <path d="M4.81909 25.9182H16.7058V42.7041H11.8066V31.0182H4.81909V25.9182Z" fill="#002148"/>
            <path d="M12.0474 5.79907H16.9466V24.0307H0V18.8905H12.0474V5.79907Z" fill="#002148"/>
            </svg>
            </a>
          </div>
          
          <div class="l-inner border border-1 radio-default">
            {{-- <h4>Register</h4> --}}
           
            <h2 class="display-rebrand mt-20 pb-5">Join as a Doctor or Hospital</h2>
            <form method="POST" action="#" class="now" id="registration_radio_form">
              @csrf
              <input type="hidden" id="timezone" name="timezone">
              <input type="hidden" id="id" name="id">
              <div class="form-group row">
                <div class="form-check col  l-inner border border-1 radioPanel">
                  <input type="radio" class="form-check-input" name="user_status" id="doctor" value="doctor">
                  <label class="form-check-label" for="doctor">
                    I'm a Doctor
                  </label>
                </div>
                <div class="form-check col l-inner border border-1">
                  <input type="radio" class="form-check-input radioPanel" name="user_status" id="hospital" value="hospital">
                  <label class="form-check-label" for="hospital">
                    I'm a Hospital
                  </label>
                </div>
              </div>
            </form>
              
            <div class="mt-30 btn-default"><button data-qa="btn-apply" type="button" disabled="disabled" class="up-btn up-btn-primary width-md up-btn-block radio-zone"><div class="up-icon sm" style="display:none;"></div> Create Account
            </button> <p class="mb-0">
            </a></p></div>
            <p class="p-reg">Already have an account?  <a href="{{route('login')}}">Login here </a>,it takes less than a minute.</p>
          </div>

          <div class="l-inner border border-1 registration" style="display: none">
            {{-- <h4>Register</h4> --}}
            <h2 class="display-rebrand mt-20 pb-5 sign_up">Sign Up</h2>
            <form method="POST" action="#" class="now" id="registration_form">
              @csrf
              <input type="hidden" id="timezone" name="timezone">
              <div class="form-group">
                <label for="exampleInputName"> Name</label>
                <input type="text" class="form-control" name="name" placeholder="Please Enter Name">
                <span class="text-danger error_name"></span> 
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email Address</label>
                <input type="email" class="form-control" name="email"  aria-describedby="emailHelp" placeholder="Please Enter Email">
                <span class="text-danger error_email"></span>
              </div>

              <div class="form-group password" style="display: none">
                <label for="exampleInputPassword">Password</label>
                <input type="password" class="form-control" name="password"  aria-describedby="emailHelp" placeholder="Please Enter Password">
                <span class="text-danger error_password"></span>
              </div>

              <div class="form-group">
                <label for="exampleInputContactNumber">Contact Number</label>
                <input type="text" class="form-control" name="contact_number"  placeholder="Please Enter Contect Number">
                <span class="text-danger error_contact_number"></span>
              </div>

              <div class="form-group main_ahpra" style="display: none">
                <label for="exampleInputAhpraNo">Medical Registration No</label>
                <input type="text" class="form-control" name="medical_registration_no" id="medical_registration_no"  placeholder="Please Enter Medical Registration No">
              </div>

              <div class="form-group">
                <label for="exampleInputAddress">Address</label>
                <input type="text" class="form-control" name="address" id="address"  placeholder="Please Enter Adderss">
                <span class="text-danger error_address"></span>
              </div>

              <div class="form-group">
                <input type="hidden" class="form-control" name="latitude" id="lat"  placeholder="Latitude">
                <input type="hidden" class="form-control" name="longitude" id="lng" placeholder="Longitude">
              </div>
              <div class="form-group public-private-hospital" style="display: none">
                <label for="exampleInputPublicPrivateHospital">Public/Private Hospital</label> 
                <select class="select_dropdown form-select public-private-hospital select2 form-control" data-width="100%" name="public_private_hospital">
                  <option selected disabled value="0">Select Public/Private Hospital</option>
                  <option value="0">Public</option>
                  <option value="1">Private</option>
               </select>
              </div>

              <div class="form-group main_skill" style="display: none">
                <label for="exampleInputSkill">Skill</label>
                <select class="select_dropdown form-select skill select2 form-control" data-width="100%" name="skill">
                  @if($skills->isEmpty())
                      <option selected disabled value="0">First Enter Skill Name</option>
                  @else
                      <option value="0" selected disabled>Select Skill Name</option>
                      @foreach ($skills as $values)
                      <option value="{{ $values['id'] }}">{{ $values['name']}}</option>
                      @endforeach
                  @endif
                  </select>
                  <span class="text-danger error_skill"></span>
              </div>

              <div class="form-group cover" style="display: none">
                <label for="exampleInputCoverImage">Cover Image</label>
                <input type="file" class="form-control" name="cover_image" id="cover_image">
              </div>

              <div class="form-group profile" style="display: none">
                <label for="exampleInputProfileImage">Profile Image</label>
                <input type="file" class="form-control" name="profile_image" id="profile_image">
              </div>

              <div class="submit-btn">
                <input type="button" id="registration_btn" value="Submit"/>
              </div>
            </form>
            <p class="p-reg">Already have an account?  <a href="{{route('login')}}">Login here </a>,it takes less than a minute.</p>
          </div>
        </div>
      </div>
    </section>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.14/moment-timezone-with-data-2012-2022.min.js"></script>

  <script src="js/jquery.min.js"></script>
  <!-- Sweet Alerts js -->
  <script src="{{ asset('admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('admin/assets/libs/select2/select2.min.js') }}" rel="stylesheet"></script>

   
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyByMhYirwn_EOt2HPNbeWtVE-BVEypa6kI"></script>
   <script src="{{ asset('assets/js/jquery.validate.min.js')}}"></script>
   <script src="{{asset('admin/assets/libs/node-waves/waves.min.js')}}"></script>

  <!-- url -->
  <script type="text/javascript">
    var aurl = {!! json_encode(url('/')) !!}
    /* Ajax Set Up */
    $.ajaxSetup({
         headers: {
             "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
         },
     });
  </script>
  <!--Start Custome Script-->
  <script src="{{ asset('admin/assets/js/select2.js') }}"></script>
  <script src="{{ asset('assets/js/registration.js') }}"></script>
  <script src="{{ asset('assets/js/location_serach.js') }}"></script>
  <script src="{{ asset('assets/js/sweet_alert.js') }}"></script>
  <!--End Custome Script-->
  </body>
</html>