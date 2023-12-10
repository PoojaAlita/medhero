{{-- 
* Author : Rajvi 
* Date : 30/04/22
* Design of Banner,Banner Upload,Profile,User,About and Experience Modal 
--}}
<!-- Banner image  -->
<div class="modal modal-common fade" id="cover_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add background photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="showcase">
            <img src="{{ url('images/showcase.svg') }}" alt=""/>
            <h3>Showcase your personality, interests, team moments or notable milestones</h3>
            <p>A good background photo will help you stand out.</p>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue-modal">Edit profile background<input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg"></button>
      </div>
    </div>
  </div>
</div>

<!-- Banner image  upload photo -->
<div class="modal modal-common fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-g-photo">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Background photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="banner-photo">
              <div class="b-photo"><img id="cover_path" src="" alt=""/></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue-modal add_cover">Apply</button>
      </div>
    </div>
  </div>
</div>

<!-- profile_modal -->
@if ($user && Auth::user()->id==$user->id) 
<div class="modal modal-common modal-black fade" id="profile_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile Photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <input type="hidden" id="id" name="profile_id" class="profile_id">
    
      <div class="modal-body">
        <div class="profile-photo-change">
            <span><img id="current_profile" src="{{isset($user->doctor->profile_image) ? asset('assets/images/profileImage/'.$user->doctor->profile_image) : asset('assets/images/default.png')}}" alt="" /></span>
        </div>
       </div> 
     
      <div class="modal-footer">
        <div class="btn-l">
          <button type="button" class="btn btn-blue-modal edit_profile_photo">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
              <path d="M21.13 2.86a3 3 0 00-4.17 0l-13 13L2 22l6.19-2L21.13 7a3 3 0 000-4.16zM6.77 18.57l-1.35-1.34L16.64 6 18 7.35z"></path>
            </svg>
            Edit
          </button>
          <button type="button" class="btn btn-blue-modal">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
              <path d="M16 13a4 4 0 11-4-4 4 4 0 014 4zm6-4v11H2V9a3 3 0 013-3h1.3l1.2-3h9l1.2 3H19a3 3 0 013 3zm-5 4a5 5 0 10-5 5 5 5 0 005-5z"></path>
            </svg>
            Add Photo
            <input type="file" id="add_profile" name="avatar" accept="image/png, image/jpeg">
          </button>
        </div>
        <div class="btn-r">
          <button type="button" class="btn btn-blue-modal delete_profile" data-id="{{Auth::user()->id}}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" data-supported-dps="24x24" fill="currentColor" class="mercado-match" width="24" height="24" focusable="false">
                <path d="M20 4v1H4V4a1 1 0 011-1h4a1 1 0 011-1h4a1 1 0 011 1h4a1 1 0 011 1zM5 6h14v13a3 3 0 01-3 3H8a3 3 0 01-3-3zm9 12h1V8h-1zm-5 0h1V8H9z"></path>
              </svg>
              Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
@endif

<!-- profile image  upload -->
<div class="modal modal-common fade" id="upload_profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-g-photo">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Background photo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="banner-photo">
              <div class="b-photo"><img id="profile_path" src="" alt=""/></div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue-modal add_profile">Apply</button>
      </div>
    </div>
  </div>
</div>
<!-- about_modal -->
<div class="modal modal-common fade" id="about_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content modal-g-photo">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Description</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body md-detail">
        <p class="p-require">* Indicates required</p>
        <form class="frm-details" id="about_form">
          @csrf
          <div class="frm-grp">
              <label>Description*</label>
              <textarea class="input-cstm" type="text" placeholder="Description" name="about" rows="6">{{ (!is_null(Auth::user()->about)) ? Auth::user()->about : ''}}</textarea>
          </div>
        </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-blue-modal submit_about">Apply</button>
    </div>
  </div>
</div>
</div>

{{-- experience modal --}}
<div class="modal modal-common fade" id="experience_modal" tabindex="-1" aria-labelledby="experienceModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content modal-g-photo">
    <div class="modal-header">
      <h5 class="modal-title" id="experienceModalLabel">Add Experience</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body md-detail">
        <p class="p-require">* Indicates required</p>
        <form class="frm-details" id="experience_form">
          @csrf
          <div class="mb-3">
            <input type="hidden" class="form-control experience_modal_id" id="experience_modal_id" name="id" value="{{ encryptid('0') }}">
          </div>
          <div class="frm-grp">
              <label>Title*</label>
              <input class="input-cstm position" type="text" name="position" placeholder="Title" value=""/>
          </div>
          <div class="frm-grp">
              <label>Employment Type</label>
              <select class="input-cstm employment_type" name="employment_type" id="employment_type">
                <option selected hidden class="input-cstm">Please Select</option>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Internship">Internship</option>
                <option value="Trainee">Trainee</option>
              </select>
          </div>

          <h4>Hospital Name</h4>
          <div class="frm-grp logo">
              <label>Hospital Logo*</label>
              <div class="logo-one"><button><input type="file" id="logo" name="logo" class="logo_input" accept="image/png, image/jpeg">Add Company Logo</button></div>
          </div>
          <div class="frm-grp">
              <label>Hospital*</label>
              <input class="input-cstm hospital_name" name="name" type="text" placeholder=""/>
          </div>

          <h4>Location</h4>
          <div class="frm-grp">
              <label>Country/Region</label>
              <select class="js-example-basic-single form-select country" data-width="100%" id="country" name="country">
                <option value="0"selected disabled hidden>select country</option>
                @foreach (country() as $code=>$country)
                  <option value="{{ $country['name'] }}">{{ $country['code'] }}-{{ $country['name'] }}</option>
                @endforeach
              </select>
          </div>
          <div class="frm-grp">
              <label>City</label>
              <input class="input-cstm city_exp" name="city" type="text" placeholder=""/>
          </div>
          <div class="frm-grp form-check">
            <input class="form-check-input current" type="checkbox" name="current" value=""/>
            <label class="form-check-label">I am currently working in this role</label>
          </div>
          <div class="row">
            <div class="date datepicker frm-grp col-md-6 datePickerExample start_date_div">
              <label for="start_date" class="form-label">Start Date</label>
              <input autocomplete="off" type="text" class="input-cstm input-group-addon start_date" id="start_date" name="start_date" value="">
            </div>
            <div class="date datepicker frm-grp col-md-6 datePickerExample end_date_div">
              <label for="end_date" class="form-label">End Date</label>
              <input autocomplete="off" type="text" class="input-cstm input-group-addon end_date" id="end_date" name="end_date" value="">
            </div>
          </div>
          <div class="frm-grp">
            <label>Description</label>
            <textarea class="input-cstm description" type="text" placeholder="Description" name="description" ></textarea>
          </div>
        </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn  delete_experience" data-id="0">Delete Experience</button>
      <button type="button" class="btn btn-blue-modal submit_experience">Apply</button>
    </div>
  </div>
</div>
</div>

{{-- 
* Author : Rajvi 
* Date : 30/04/22
* end
--}}

{{-- 
* Author : Rajvi 
* Date : 2/05/22
* added education modal
--}}

{{-- education modal --}}
<div class="modal modal-common fade" id="education_modal" tabindex="-1" aria-labelledby="educationModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-g-photo">
      <div class="modal-header">
        <h5 class="modal-title" id="educationModalLabel">Add Education</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body md-detail">
          <p class="p-require">* Indicates required</p>
          <form class="frm-details" id="education_form">
            @csrf
            <div class="mb-3">
              <input type="hidden" class="form-control education_modal_id" id="education_modal_id" name="id" value="{{ encryptid('0') }}">
            </div>
            <div class="frm-grp">
                <label>School*</label>
                <input class="input-cstm name" type="text" name="name" placeholder="School" value=""/>
            </div>
            <div class="frm-grp logo">
              <label>School Logo*</label>
              <div class="logo-one"><button><input type="file" id="school_logo" name="school_logo" class="school_logo_input" accept="image/png, image/jpeg">Add School Logo</button></div>
            </div>
            <div class="frm-grp">
              <label>Degree</label>
              <input class="input-cstm degree" name="degree" type="text" placeholder=""/>
            </div>
            <div class="row">
              <div class="date datepicker frm-grp col-md-6 datePickerExample education_start_date_div">
                <label for="start_date" class="form-label">Start Date</label>
                <input autocomplete="off" type="text" class="input-cstm input-group-addon start_date" id="start_date" name="start_date" value="">
              </div>
              <div class="date datepicker frm-grp col-md-6  education_end_date_div">
                <label for="end_date" class="form-label">End Date</label>
                <input autocomplete="off" type="text" class="input-cstm input-group-addon end_date" id="end_date" name="end_date" value="">
              </div>
            </div>
            <div class="frm-grp">
              <label>Grade</label>
              <input class="input-cstm grade" name="grade" type="text" placeholder=""/>
            </div>
            <div class="frm-grp">
              <label>Description</label>
              <textarea class="input-cstm description" type="text" placeholder="Description" name="description" ></textarea>
            </div>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn  delete_education" data-id="0">Delete Education</button>
        <button type="button" class="btn btn-blue-modal submit_education">Apply</button>
      </div>
    </div>
  </div>
</div>




{{-- chat modal --}}
<div class="" id="chatToOne" style="display:none">
  <div class="chat-wrapper">
    <div class="modal-content chat-content modal-g-photo">
      <div class="modal-header">
        <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
          <div class="d-flex align-items-center">
            <figure class="me-2 mb-0">
              <img src="" class="img-sm rounded-circle r_profile" alt="profile">
              <div class="status"></div>
            </figure>
            <div>
              <h6 class="hospital_name"></h6>
              <p class="r_name"></p>
              <p class="text-muted tx-13"></p>
            </div>
          </div>
        </div>
        {{-- <h5 class="r_name" id="exampleModalLabel"></h5> --}}
        <button type="button" class="btn-close close_chat" aria-label="Close"></button>
      </div>
      <div class="chat-body">
        <ul class="messages">
          
        </ul>
      </div>
      <div class="modal-footer">
        <div>
          <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Emoji">
            <i data-feather="smile" class="text-muted"></i>
          </button>
        </div>
        <div class="d-none d-md-block">
          <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Attatch files">
            <i data-feather="paperclip" class="text-muted"></i>
          </button>
        </div>
        <div class="d-none d-md-block">
          <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Record you voice">
            <i data-feather="mic" class="text-muted"></i>
          </button>
        </div>
        <form class="search-form flex-grow-1 me-2">
          <div class="message_type">
            <input type="text" class="form-control rounded-pill" id="chatForm" placeholder="Type a message" maxlength="250">
          </div>
        </form>
        <div>
          <button type="button" class="btn btn-primary btn-icon rounded-circle send_message">
            <i data-feather="send"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

  {{-- 
  * Author : Rajvi 
  * Date : 2/05/22
  * end 
  --}}