@extends('layouts.Admin.master')
@push('plugin-styles')
<link href="{{asset('includes/pages/css/style.css')}}" rel="stylesheet" /> 
@endpush
@section('content')

<section class="fd-cstm">
    <div class="container">
    <div class=col-md-12>
    <form method="POST" action="{{'generate-document'}}">
        @csrf
        <div class="basic_info_div">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="Name" placeholder="Enter Name">
                <label class="error name_error" style="display:none;"></label>
            </div>

            <div class="form-group">
                <label for="reg_info">Personal / Registration Information:</label>
                <input type="text" class="form-control" id="reg_info" name="reg_info" aria-describedby="reg_info" placeholder="Personal / Registration Information">
                <label class="error reg_info_error" style="display:none;"></label>
            </div>

            <div class="form-group">
                <label for="education_info">Qualifications / Education:</label>
                <span class="education_span education_span_initial">
                    <input type="text" class="form-control edu_date" id="edu_date" name="edu_date[]" aria-describedby="education_info" placeholder="Month Year"> <b>-</b> 
                    <input type="text" class="form-control education_info" id="education_info" name="education_info[]" aria-describedby="education_info" placeholder="Qualifications / Education">
                    <a class="add_new_education">+</a>
                </span>
                <label class="error education_info_error" style="display:none;"></label>
            </div>
            <a class="btn btn-primary mb-2 show_experience">Next</a>
        </div>
        
        <div class="experience_div" style="display:none">
            <div class="work_history_div">
                <div class="form-group">
                    <label for="work_history">Work / Practice History:</label>
                    <span class="work_history_span work_history_span_initial">
                        <input type="text" class="form-control work_start_input" id="work_start" name="work_start[]" aria-describedby="from" placeholder="From"> <b>-</b> 
                        <input type="text" class="form-control work_end_input" id="work_end" name="work_end[]" aria-describedby="to" placeholder="To">
                        <input type="text" class="form-control work_input" id="work_history" name="work_history[]" aria-describedby="work_history" placeholder="Work / Practice Details">
                        <a class="add_new_history">+</a>
                    </span>
                    <label class="error work_history_error" style="display:none;"></label>
                </div>
            </div>
            
            <div class="other_experience_div">
                <div class="form-group">
                    <label for="other_work_exp">Other Work Experience:</label>
                    <span class="other_work_history_span">
                        <input type="text" class="form-control work_start_input" id="other_work_start" name="other_work_start[]" aria-describedby="from" placeholder="From"> <b>-</b> 
                        <input type="text" class="form-control work_end_input" id="other_work_end" name="other_work_end[]" aria-describedby="to" placeholder="To">
                        <input type="text" class="form-control other_work_exp" id="other_work_exp" name="other_work_exp[]" aria-describedby="other_work_exp" placeholder="Other Work Experience">
                    </span>
                    <label class="error other_work_exp_error" style="display:none;"></label>
                </div>
            </div>
            <a class="btn btn-primary mb-2 show_basic">Back</a>
            <a class="btn btn-primary mb-2 show_details">Next</a>
        </div>

        
        <div class="details_div" style="display:none">
            <div class="form-group">
                <label for="skills">Clinical / Procedural Skills:</label>
                <textarea class="form-control" id="skills" name="skills" aria-describedby="skills" placeholder="Clinical / Procedural Skills"></textarea>
                <label class="error skills_error" style="display:none;"></label>
            </div>

            <div class="form-group">
                <label for="goals">Objectives / Goals / Personal Statement:</label>
                <textarea class="form-control" id="goals" name="goals" aria-describedby="goals" placeholder="Objectives / Goals / Personal Statement"></textarea>
                <label class="error goals_error" style="display:none;"></label>
            </div>

            <div class="form-group">
                <label for="contact_details">Contact Details:</label>
                <textarea class="form-control" id="contact_details" name="contact_details" aria-describedby="contact_details" placeholder="Contact Details"></textarea>
                <label class="error contact_details_error" style="display:none;"></label>
            </div>
        </div>
        <div class="submit_btn_div" style="display:none">
            <a class="btn btn-primary mb-2 show_experience">Back</a>
            
            @if (request()->route()->uri == 'export-to-doc')
              <button type="submit" class="btn btn-primary mb-2" name="export_to_doc">Export DOC</button>       
            @else
             <button type="submit" class="btn btn-info mb-2" name="export_to_pdf">Export PDF</button>
            @endif

        </div>
    
    </form>
</div>
    </div>
</section>


@endsection  
@push('custom-scripts')
  <script src="{{asset("includes/js/custom.js")}}"></script>
@endpush