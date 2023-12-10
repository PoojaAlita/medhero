<!-- user_modal -->
<div class="modal modal-common fade" id="user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modal-g-photo">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body md-detail">
            <p class="p-require">* Indicates required</p>
            <form class="frm-details" id="user_form">
              @csrf
              <div class="frm-grp">
                  <label>Name*</label>
                  <input class="input-cstm" name="name" type="text" placeholder="Enter Name" value="{{ Auth::user()->name}}"/>
              </div>
              <div class="frm-grp">
                <label>Email Address*</label>
                <input class="input-cstm" name="email" type="email" placeholder="Enter Email" value="{{Auth::user()->email}}" />
              </div>
              <div class="frm-grp">
                <label>Contact Number*</label>
                <input class="input-cstm" name="contact_number" type="text" placeholder="Enter Contact No" value="{{ Auth::user()->phone_number}}" />
              </div>
            
             
             {{--  @if(auth()->user()->user_status==0)
              <div class="frm-grp">
                  <label>Medical registered number*</label>
                  <input class="input-cstm" name="medical_no" type="text" placeholder="" value="{{ Auth::user()->medical_no }}" />
              </div>
              @endif --}}

              <div class="frm-grp">
                <label>Address*</label>
                <input class="input-cstm" name="address" id="address" type="text" placeholder="" value="{{ Auth::user()->address}}" />
              </div>
              <div class="form-group">
                <input type="hidden" class="form-control" name="latitude" id="lat"  placeholder="Latitude" value="{{ Auth::user()->latitude}}">
                <input type="hidden" class="form-control" name="longitude" id="lng" placeholder="Longitude" value="{{ Auth::user()->longitude}}">
              </div>
             
              {{-- <div class="contact-info"><a href="#">Contact Info</a></div> --}}
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-blue-modal submit_user">Apply</button>
        </div>
      </div>
    </div>
  </div>