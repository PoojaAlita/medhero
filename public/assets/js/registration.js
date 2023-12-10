$(document).ready(function() {
    /* Validation Of Registration Form */
    $("#registration_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email_check: true
            },
            password: {
                required: true,
            },
            contact_number: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10

            },
            address: {
                required: true,
            },
            skill: {
                required: true,
            },
            public_private_hospital: {
                required: true,
            }
        },
        messages: {
            name: {
                required: "Please Enter Name",
            },
            email: {
                required: "Please Enter Email",
            },
            password: {
                required: "Please Enter Password",
            },
            contact_number: {
                required: "Please Enter Contact Number",
                number: "Only Number Enter",
                minlength: "Please Enter Minimum 10 Number",
                maxlength: "Please Enter Maximum 10 Number"
            },
            address: {
                required: "Please Enter Address",
            },
            skill: {
                required: "Please Select Skill",
            },
            public_private_hospital: {
                required: "Please Select Public Private Hospital",
            }
        },
        errorPlacement: function(error, element) {
            if (
                element.parents("div").hasClass("has-feedback") ||
                element.hasClass("select2-hidden-accessible")
            ) {
                error.appendTo(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
        normalizer: function(value) {
            return $.trim(value);
        },
    });


    $.validator.addMethod(
        "email_check",
        function(value) {
            var email = 0;
            var user_status = $('input[name="user_status"]:checked').val();
            var email = $.ajax({
                url: aurl + "/validate-email",
                type: "POST",
                async: false,
                data: {
                    email: value,
                    user_status: user_status,
                },
            }).responseText;
            if (email != 0) {
                return false;
            } else return true;
        },
        "Email Already Exists"
    );


    /* Adding Registration*/
    $("#registration_btn").click(function(event) {
        event.preventDefault();
        var user_status = $('.form-check-input:checked').val();
        var form = $("#registration_form")[0];
        var formData = new FormData(form);
        formData.append('user_status', user_status);

        if ($("#registration_form").valid()) {
            $.ajax({
                url: aurl + "/register",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $("#registration_form")[0].reset();
                    toaster_message(data.message, data.icon);

                },
                error: function(request) {
                    $(".error_name").html(
                        request.responseJSON.errors.name
                    );
                    $(".error_email").html(
                        request.responseJSON.errors.email
                    );
                    $(".error_contact_number").html(
                        request.responseJSON.errors.contact_number
                    );
                    $(".error_address").html(
                        request.responseJSON.errors.address
                    );
                    $(".error_skill").html(
                        request.responseJSON.errors.skill
                    );
                    toaster_message(
                        "Something Went Wrong! Please Try Again.",
                        "error"
                    );
                },
            });
        }
    });

});

/*Click on radio change button text*/
$("input[name='user_status']").click(function() {
    $('.btn-default button').text('Create Account');
    if (this.checked) {
        if ($("#doctor").is(":checked")) {
            $(".sign_up").text('Sign Up');
            $(".main_skill").show();
            $(".main_ahpra").show();
            $(".cover").show();
            $(".password").show();
            $(".profile").show();
            $(".radio-zone").removeAttr('disabled');
            $('.radio-zone').text('Join as a Doctor');
        } else if ($("#hospital").is(":checked")) {
            $('.public-private-hospital').show();
            $('.sign_up').text('Contact Us');
            $(".radio-zone").removeAttr('disabled');
            $('.radio-zone').text('Apply as a Hosplital');
        }
    }

});

/*Show & Hide Doctor,Hospital form*/
$('.radio-zone').click(function() {
    $('.radio-default').hide();
    $('.registration').show();
});