$(document).on('click', '.show_experience', function(){
    var err_cnt = 0;
    if($('#name').val() == ''){
        err_cnt = 1;
        $('.name_error').text('Please enter your name');
        $('.name_error').show();
    }else{
        $('.name_error').hide();
    }
    if($('#reg_info').val() == ''){
        err_cnt = 1;
        $('.reg_info_error').text('Please enter valid information');
        $('.reg_info_error').show();
    }else{
        $('.reg_info_error').hide();
    }
    if($('#education_info').val() == ''){
        err_cnt = 1;
        $('.education_info_error').text('Please enter valid information');
        $('.education_info_error').show();
    }else{
        $('.education_info_error').hide();
    }
    if(err_cnt == 0){
        $('.experience_div').show();
        $('.basic_info_div').hide();
        $('.details_div').hide();
        $('.submit_btn_div').hide();
    }

    
});

$(document).on('click', '.show_details', function(){
    var err_cnt = 0;
    if($('#work_history').val() == ''){
        err_cnt = 1;
        $('.work_history_error').text('Please enter work history');
        $('.work_history_error').show();
    }else{
        $('.work_history_error').hide();
    }

    if(err_cnt == 0){
        $('.details_div').show();
        $('.submit_btn_div').show();
        $('.basic_info_div').hide();
        $('.experience_div').hide();
    }
});

$(document).on('click', '.show_basic', function(){
    $('.basic_info_div').show();
    $('.experience_div').hide();
    $('.details_div').hide();
    $('.submit_btn_div').hide();
});

$(document).on('click', '.add_new_history', function(){
    var add_new_work_history = '<span class="work_history_span">';
    add_new_work_history += '<input type="text" class="form-control work_start_input" id="work_start" name="work_start[]" aria-describedby="from" placeholder="From"> <b>-</b> ';
    add_new_work_history += '<input type="text" class="form-control work_end_input" id="work_end" name="work_end[]" aria-describedby="to" placeholder="To">';
    add_new_work_history += '<input type="text" class="form-control work_input" id="work_history" name="work_history[]" aria-describedby="work_history" placeholder="Work / Practice Details">';
    add_new_work_history += '<a class="remove_history">-</a>';
    add_new_work_history += '</span>';
    $(add_new_work_history).insertAfter($('.work_history_span').last());
});

$(document).on('click', '.remove_history', function(){
    $(this).parents('.work_history_span').remove();
});

$(document).on('click', '.add_new_education', function(){
    var add_new_work_history = '<span class="education_span">';
    add_new_work_history += '<input type="text" class="form-control edu_date" id="edu_date" name="edu_date[]" aria-describedby="education_info" placeholder="Month Year"> <b>-</b> ';
    add_new_work_history += '<input type="text" class="form-control education_info" id="education_info" name="education_info[]" aria-describedby="education_info" placeholder="Qualifications / Education">';
    add_new_work_history += '<a class="remove_education">-</a>';
    add_new_work_history += '</span>';
    $(add_new_work_history).insertAfter($('.education_span').last());
});

$(document).on('click', '.remove_education', function(){
    $(this).parents('.education_span').remove();
});