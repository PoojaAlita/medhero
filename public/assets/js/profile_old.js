$(document).ready(function(){
    /* validation of cover form */
    $('#cover_form').validate({ 
        rules: {
            cover: {
                required: true,
                extension: "jpg|jpeg|png"
            },
        },
        messages: {
            cover: {
                required: "Please upload your profile picture",
                extension: "Please upload jpg, jpeg or png file only",
            },
        },
    });

    /* validation of profile form */
    $('#profile_form').validate({ 
        rules: {
            profile: {
                required: true,
                extension: "jpg|jpeg|png"
            },
        },
        messages: {
            profile: {
                required: "Please upload your profile picture",
                extension: "Please upload jpg, jpeg or png file only",
            },
        },
    });

     /* validation of user form */
     $('#user_form').validate({ 
        rules: {
            "name": {
                required: true,
            },
            "location": {
                required: true,
            },
            "speciality": {
                required: true,
            },
            "abouts": {
                required: true,
                minlength: 2
            },
           
            "message": {
                required: true,
                minlength: 2,
            },
        },
        errorPlacement: function (label, element) {
            if(element.attr("type") == "radio" )
            {
              label.insertAfter(element.closest(".form-check")); 
            }
            else if(element.attr("type") == "checkbox"){
            label.insertAfter(element.closest(".form-check")); 
            }
            else if(element.attr("class") == "work_start_input") {
                console.log('hii');
              label.insertAfter(element.closest(".work_history_span"));
            }
            else 
            {
            label.insertAfter(element);
            }
        },
        messages: {
            "name": {
                required: "Please enter your name",
            },
            "abouts": {
                minlength: "Please enter about",
            },
            "message": {
                minlength: "Please enter about message",
            },
        },
    });

    /* add new experience */
    $(document).on('click', '.add_new_history', function(){
        var add_new_work_history = '<span class="work_history_span">';
        add_new_work_history += '<input type="text" autocomplete="off" class="form-control work_start_input" id="work_start" name="work_start[]" aria-describedby="from" placeholder="From"> <b>-</b> ';
        add_new_work_history += '<input type="text" autocomplete="off" class="form-control work_end_input" id="work_end" name="work_end[]" aria-describedby="to" placeholder="To">';
        add_new_work_history += '<input type="text" class="form-control work_input" id="work_history" name="work_history[]" aria-describedby="work_history" placeholder="Work / Practice Details">';
        add_new_work_history += '<a class="remove_history">-</a>';
        add_new_work_history += '</span>';
        $(add_new_work_history).insertAfter($('.work_history_span').last());
    });

    /* remove experience */
    $(document).on('click', '.remove_history', function(){
        $(this).parents('.work_history_span').remove();
    });

    /* add education */
    $(document).on('click', '.add_new_education', function(){
        var add_new_work_history = '<div class="education">';
        add_new_work_history += '<div class="row mb-3">';
        add_new_work_history += '<div class="date datepicker col-6 datePickerExample"> <label for="start_date" class="form-label">Start Date</label><input type="text" class="form-control input-group-addon" id="start_date" name="start_date[]" value=""></div>';
        add_new_work_history += '<div class="date datepicker col-6 datePickerExample"><label for="end_date" class="form-label">End Date</label><input type="text" class="form-control input-group-addon end_date" id="end_date" name="end_date[]" value=""></div>';
        add_new_work_history += '</div>';
        add_new_work_history += '<div class="mb-3 education_span education_span_initial"><label for="education_info" class="form-label">Qualifications / Education:</label><input type="text" class="form-control education_info" id="education_info" name="education_info[]" aria-describedby="education_info" placeholder="Qualifications / Education"><a class="remove_education">-</a></div>';
        add_new_work_history += '</div>';
        
        $(add_new_work_history).insertAfter($('.education').last());
        $('.datePickerExample').datepicker({
            format: "mm/dd/yyyy",
            todayHighlight: true,
            autoclose: true,
            endDate: "today"
        });
    });
    
    /* remove education */
    $(document).on('click', '.remove_education', function(){
        $(this).parent().parent('.education').remove();
    });

    /* display cover modal */
    $('body').on("click", ".edit_cover", function(event){
        $('#cover_modal').modal('show');
    });

    /* adding cover photo to database */   
    $(".submit_cover").on("click", function(event){
        event.preventDefault();
        var form = $('#cover_form')[0];
        var formData = new FormData(form);
        if($("#cover_form").valid()){   
            $.ajax({
                url: aurl + "/profile/cover",
                type: 'POST',
                dataType: "JSON",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data.status);
                    if(data.status){
                        $('#cover_modal').modal('hide');
                        window.location.href = aurl + "/profile";
                    }else{
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger me-2'
                            },
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            data.message,
                            'error'
                        )
                    }
                },
            });
        } else {
            console.log('Please enter required fields!')
        }
    });

    $(document).on('click', '.submit_user', function(){
        
        var form = $('#user_form')[0];
        var formData = new FormData(form);
        if($("#user_form").valid()){
                $.ajax({
                    url: aurl + "/profile/user",
                    type: 'POST',
                    dataType: "JSON",
                    data:formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log(data.status);
                        if(data.status){
                            $('#user_modal').modal('hide');
                            window.location.href = aurl + "/profile";
                        }else{
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: 'btn btn-success',
                                    cancelButton: 'btn btn-danger me-2'
                                },
                                buttonsStyling: false,
                            })
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                data.message,
                                'error'
                            )
                        }
                    },
                });
            
        }
    
        
    });
    /* display profile modal */
    $('body').on("click", ".edit_profile", function(event){
        $('#profile_modal').modal('show');
    });

     /* adding profile photo to database */   
     $(".submit_profile").on("click", function(event){
        event.preventDefault();
        var form = $('#profile_form')[0];
        var formData = new FormData(form);
        if($("#profile_form").valid()){   
            $.ajax({
                url: aurl + "/profile/avtar",
                type: 'POST',
                dataType: "JSON",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data.status);
                    if(data.status){
                        $('#profile_modal').modal('hide');
                        window.location.href = aurl + "/profile";
                    }else{
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger me-2'
                            },
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            data.message,
                            'error'
                        )
                    }
                },
            });
        } else {
            console.log('Please enter required fields!')
        }
    });

    /* display user modal */
    $('body').on("click", ".edit_user", function(event){
        $('#user_modal').modal('show');
    });

     /* display experience modal */
     $('body').on("click", ".add_experience", function(event){
        $('#experience_modal').modal('show');
    });
     /* display education modal */
     $('body').on("click", ".add_education", function(event){
        $('#education_modal').modal('show');
    });

    /* adding education to user */
    $(document).on('click', '.submit_education', function(){
        
        var err_cnt = 0;
        if($('#education_info').val() == '' || $('#start_date').val() == '' || $('#end_date').val() == ''){
            err_cnt = 1;
            $('.education_info_error').text('Please enter your education');
            $('.education_info_error').show();
        }else{
            $('.education_info_error').hide();
        }
        // if($('#work_history').val() == '' || $('#work_start').val() == '' || $('#work_end').val() == ''){
        //     err_cnt = 1;
        //     $('.work_history_error').text('Please enter work history');
        //     $('.work_history_error').show();
        // }else{
        //     $('.work_history_error').hide();
        // }
        if(err_cnt == 0){
            var form = $('#education_form')[0];
            var formData = new FormData(form);
            $.ajax({
                url: aurl + "/profile/user/education",
                type: 'POST',
                dataType: "JSON",
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data) {
                    console.log(data.status);
                    if(data.status){
                        $('#user_modal').modal('hide');
                        window.location.href = aurl + "/profile";
                    }else{
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger me-2'
                            },
                            buttonsStyling: false,
                        })
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            data.message,
                            'error'
                        )
                    }
                },
            });
        
        }
    });

    $('.current').change(function() {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        if(this.checked) {
            $('#end_date').prop('readonly', true);
            $('#end_date').datepicker('setDate', today);
        }else{
            $('#end_date').prop('disabled', false);
            $('#end_date').val('');
        }      
    });
    
});