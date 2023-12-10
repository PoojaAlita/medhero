{{--
  *Author : kishan 
  *Date : 29/04/22
  *Added skill and language model
--}}
<!--skill_modal -->
<div class="modal modal-common fade" id="skill_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content modal-g-photo">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Skills</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body md-detail">
        <p class="p-require"><span style="color:red">*</span> Indicates required</p>
        <form class="frm-details" id="skill_form">
          @csrf
          @if ($user)
          <div class="mb-3">
            <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
          </div>
          <div class="frm-grp">
              <label>Skills<span style="color:red">*</span></label>
             <select class="js-example-basic-multiple select_skill" name="skills[]" multiple="multiple">
              @if($user->skill->isEmpty())
                  @foreach($all_skills as $skills)
                    <option value="{{$skills->id}}">{{$skills->name}}</option>
                  @endforeach
              @endif
                @foreach($user->skill as $skill)  
                  @foreach($all_skills as $skills)
                    <option @if($skills->id == $skill->id) selected @endif  value="{{$skills->id}}" >@if($skills->id != $skill->id) {{$skills->name}}@else {{$skills->name}}  @endif</option>
                  @endforeach
                @endforeach
         
            </select>
          </div>
          @endif
        </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-blue-modal submit_skill">Apply</button>
    </div>
  </div>
</div>
</div>

<!--Launge_Modal -->
<div class="modal modal-common fade" id="language_model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content modal-g-photo">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit Language</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body md-detail">
        <p class="p-require"><span style="color:red">*</span> Indicates required</p>
        <form class="frm-details" id="language_form">
          @csrf
          @if ($user)
          <div class="mb-3">
            <input type="hidden" class="form-control" id="id" name="id" value="{{ $user->id }}">
          </div>
          <div class="frm-grp">
              <label>Languages<span style="color:red">*</span></label>
             <select class="js-example-basic-multiple select_language" name="languages[]" multiple="multiple">
                @if($user->language->isEmpty())
                    @foreach($all_languages as $languages)
                     <option value="{{$languages->id}}">{{$languages->name}}</option>
                    @endforeach
                @endif
                @foreach($user->language as $language)  
                  @foreach($all_languages as $languages)
                    <option @if($languages->id == $language->id) selected @endif  value="{{$languages->id}}">@if($languages->id != $language->id) {{$languages->name}}@else {{$languages->name}}  @endif </option>
                  @endforeach
                @endforeach
            
            </select>
          </div>
          @endif
        </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-blue-modal submit_language">Apply</button>
    </div>
  </div>
</div>
</div>





{{--
  * Author : kishan 
  * Date : 29/04/22
  * End
--}}