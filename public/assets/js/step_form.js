var currentTab = 0;
var all_validate = false;
showTab(currentTab); // Display the current tab

function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
        document.getElementById("prevBtn").style.display = "none";
    } else {
        document.getElementById("prevBtn").style.display = "inline";
        document.getElementById("skipBtn").innerHTML = "Skip";
    }
    if (n == x.length - 1) {
        document.getElementById("nextBtn").style.display = "none";
        document.getElementById("skipBtn").innerHTML = "Skip & Submit";
    } else {
        document.getElementById("nextBtn").style.display = "inline";
        document.getElementById("nextBtn").innerHTML = "Next";
        document.getElementById("skipBtn").style.display = "inline";
    }
}
/* next button  */
$(".next_tab1").on("click", function() {
    $("#general_form").validate({
        rules: {
            medical_no: {
                required: true,
            },
            grade_primary: {
                required: true,
            },
            country: {
                required: true,
            },
            about: {
                required: true,
            },
        },

        messages: {
            medical_no: {
                required: "Enter medical number",
            },
            grade_primary: {
                required: "Specialty is required",
            },
            country: {
                required: "country is required ",
            },
            about: {
                required: "about is required ",
            },
        },
    });

    if ($("#general_form").valid() == true) {
        document.getElementById("tab_1").style.display = "none";
        document.getElementById("tab_2").style.display = "block";
        var form = $("#general_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
    }
});

$(".next_tab2").on("click", function() {
    $("#step_experience_form").validate({
        rules: {
            position: {
                required: true,
            },
            name: {
                required: true,
            },
            employment_type: {
                required: true,
            },
            e_country: {
                required: true,
            },
            city: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: !$(".current").checked,
            },
            description: {
                required: true,
            },
        },

        messages: {
            position: {
                required: "Position is required",
            },
            name: {
                required: "Hospital name is required",
            },
            employment_type: {
                required: "employee type is required",
            },
            e_country: {
                required: "Country is required",
            },
            city: {
                required: "City is required",
            },
            start_date: {
                required: "Start date is required",
            },
            end_date: {
                minlength: "End date is required",
            },
            description: {
                required: "Description is required",
            },
        },
    });

    if ($("#step_experience_form").valid() == true) {
        document.getElementById("tab_1").style.display = "none";
        document.getElementById("tab_2").style.display = "none";
        document.getElementById("tab_3").style.display = "block";

        var form = $("#step_experience_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
    }
});

$(".next_tab3").on("click", function() {
    $("#step_education_form").validate({
        rules: {
            name: {
                required: true,
            },
            degree: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
            grade: {
                required: true,
            },
            description: {
                required: true,
            },
        },

        messages: {
            name: {
                required: "School name is required",
            },
            degree: {
                required: "Degree is required",
            },
            start_date: {
                required: "Start date is required",
            },
            end_date: {
                required: "End date is required",
            },
            grade: {
                required: "Grade is required",
            },
            description: {
                required: "Description is required",
            },
        },
    });

    if ($("#step_education_form").valid() == true) {
        document.getElementById("tab_1").style.display = "none";
        document.getElementById("tab_2").style.display = "none";
        document.getElementById("tab_3").style.display = "none";
        document.getElementById("tab_4").style.display = "block";

        var form = $("#step_education_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
    }
});

$(".next_tab4").on("click", function() {
    $("#step_skill_form").validate({
        rules: {
            "skills[]": {
                required: true,
            },
            "languages[]": {
                required: true,
            },
        },

        messages: {
            "skills[]": {
                required: "Skills is required",
            },
            "languages[]": {
                required: "Languages is required",
            },
        },
    });

    if ($("#step_skill_form").valid() == true) {
        var form = $("#step_skill_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
        window.location.href = aurl;
    }
});

/* next button end */

$(".skip_gen").on("click", function() {
    $("#general_form").validate({
        rules: {
            medical_no: {
                required: true,
            },
            grade_primary: {
                required: true,
            },
            country: {
                required: true,
            },
            about: {
                required: true,
            },
        },

        messages: {
            medical_no: {
                required: "Please enter medical number",
            },
            grade_primary: {
                required: "Please enter specialty",
            },
            country: {
                required: "Please select country",
            },
            about: {
                required: "Please enter about",
            },
            message: {
                minlength: "Please enter about message",
            },
        },
    });

    if ($("#general_form").valid() == true) {
        document.getElementById("tab_1").style.display = "none";
        document.getElementById("tab_2").style.display = "block";

        var form = $("#general_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
    }
});

/* step 2*/

$(".skip_exp").on("click", function() {
    $("#step_experience_form").validate({
        rules: {
            position: {
                required: true,
            },
            name: {
                required: true,
            },
            employment_type: {
                required: true,
            },
            e_country: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: !$(".current").checked,
            },
        },

        messages: {
            position: {
                required: "Please enter position",
            },
            name: {
                required: "Please enter hospital name",
            },
            employment_type: {
                required: "Please select Employee type",
            },
            e_country: {
                required: "Please select country",
            },
            start_date: {
                required: "Please select start date",
            },
            end_date: {
                minlength: "Please select end date",
            },
        },
    });

    if ($("#step_experience_form").valid() == true) {
        document.getElementById("tab_1").style.display = "none";
        document.getElementById("tab_2").style.display = "none";
        document.getElementById("tab_3").style.display = "block";

        var form = $("#step_experience_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
    }
});

/* Step 3 */

$(".skip_edu").on("click", function() {
    $("#step_education_form").validate({
        rules: {
            name: {
                required: true,
            },
            degree: {
                required: true,
            },
            start_date: {
                required: true,
            },
            end_date: {
                required: true,
            },
        },

        messages: {
            name: {
                required: "Please enter school name",
            },
            degree: {
                required: "Please enter degree",
            },
            start_date: {
                required: "Please select start date",
            },
            end_date: {
                minlength: "Please select end date",
            },
        },
    });

    if ($("#step_education_form").valid() == true) {
        document.getElementById("tab_1").style.display = "none";
        document.getElementById("tab_2").style.display = "none";
        document.getElementById("tab_3").style.display = "none";
        document.getElementById("tab_4").style.display = "block";

        var form = $("#step_education_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
    }
});

$(".skip_lang_skill").on("click", function() {
    $("#step_skill_form").validate({
        rules: {
            "skills[]": {
                required: true,
            },
            "languages[]": {
                required: true,
            },
        },

        messages: {
            "skills[]": {
                required: "Skills is required",
            },
            "languages[]": {
                required: "Languages is required",
            },
        },
    });

    if ($("#step_skill_form").valid() == true) {
        var form = $("#step_skill_form")[0];
        var formData = new FormData(form);
        submit_data(formData);
        window.location.href = aurl;
    }
});

/* previous button  */
$(".pre_tab1").on("click", function() {});

$(".pre_tab2").on("click", function() {
    document.getElementById("tab_1").style.display = "block";
    document.getElementById("tab_2").style.display = "none";
    document.getElementById("tab_3").style.display = "none";
    document.getElementById("tab_4").style.display = "none";
});

$(".pre_tab3").on("click", function() {
    document.getElementById("tab_1").style.display = "none";
    document.getElementById("tab_2").style.display = "block";
    document.getElementById("tab_3").style.display = "none";
    document.getElementById("tab_4").style.display = "none";
});

$(".pre_tab4").on("click", function() {
    document.getElementById("tab_1").style.display = "none";
    document.getElementById("tab_2").style.display = "none";
    document.getElementById("tab_3").style.display = "block";
    document.getElementById("tab_4").style.display = "none";
});
/* previous button  */

/* submit data function */
function submit_data(formData) {
    $.ajax({
        url: aurl + "/complete-profile",
        type: "POST",
        dataType: "JSON",
        processData: false,
        contentType: false,
        data: formData,
    });
}