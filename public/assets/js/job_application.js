$(document).ready(function() {

    /* Validation Of Job Application Form */
    $("#job_apllication").validate({
        rules: {
            offer: {
                required: true,
                number: true,
            },
        },
        messages: {

            offer: {
                required: "Please Enter Your Offer",
                number: "Only Number Enter",
            },
        },
        highlight: function(element) {
            $(element).removeClass("error");
        },
        normalizer: function(value) {
            return $.trim(value);
        },
    });


    /* Adding And Updating JobApplication Modal */
    $("#submit_job_application").click(function(event) {
        event.preventDefault();
        var form = $("#job_apllication")[0];
        var formData = new FormData(form);
        if ($("#job_apllication").valid()) {
            $('#loader_bg').show();
            $.ajax({
                url: aurl + "/Job-Application/store",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#loader_bg').hide();
                    toaster_message(data.message, data.icon, data.redirect_url, aurl);
                },
                error: function(request) {
                    $('#loader_bg').hide();
                    toaster_message(
                        "Something Went Wrong! Please Try Again.",
                        "error"
                    );
                },
            });
        }
    });


    /* Display Update Job Apply*/
    $("body").on("click", ".edit_job_apply", function(event) {
        $('#loader_bg').show();
        var id = $(this).data("id");
        $("#id").val(id);
        event.preventDefault();
        $.ajax({
            url: aurl + "/Job-Application/edit",
            type: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                var users = data.data.user;
                if (data.status) {
                    $('#loader_bg').hide();
                    $("#job_apllication").trigger("reset");
                    $("#job_apllication").validate().resetForm();
                    $("#title_job_apply_modal").text("Update Job Apply");
                    $("#job_apply_modal").modal("show");
                    $("#submit_job_application").text("Update Job Apply");
                    $("#exampleInputHospitalName1").val(data.data.user.name);
                    $("#hospital_id").val(data.data.user_id);
                    $("#job_id").val(data.data.job_id);
                    $("#user_id").val(data.data.user_id);
                    $("#exampleInputjobTitle").val(data.data.job.title);
                    $("#job_post_id").val(data.data.job_id);
                    $("#exampleInputJobRate").val(data.data.job.hourly_rate);
                    $("#exampleInputDescription").val(data.data.job.description);
                    $("#exampleInputOffer").val(data.data.offer);

                } else {
                    toaster_message(data.message, data.icon);
                }
            },
            error: function(request) {
                toaster_message(
                    "Something Went Wrong! Please Try Again.",
                    "error"
                );
            },
        });
    });

    /* Delete Job Apply Data From Database */
    $(document).on("click", ".delete", function() {
        var id = $(this).data('id');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-2'
            },
            buttonsStyling: false,
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Withdraw it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $('#loader_bg').show();
                $.ajax({
                    url: aurl + "/Job-Application/delete",
                    type: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(data) {
                        $('#loader_bg').hide();
                        if (data.status) {
                            toaster_message(data.message, data.icon, data.redirect_url, aurl);
                        } else {
                            toaster_message(data.message, data.icon, data.redirect_url, aurl);
                        }

                    },
                    error: function(error) {
                        $('#loader_bg').hide();
                        swalWithBootstrapButtons.fire('Cancelled', 'this data is not available :)', 'error')
                    }
                });

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire('Cancelled', 'Your data is safe :)', 'error')
            }
        })
    });


    /*Send Offer*/
    $("body").on("click", ".offer", function(event) {
        var id = $(this).data("id");
        $('#loader_bg').show();
        $.ajax({
            url: aurl + "/Job-Application/offer",
            type: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                $('#loader_bg').hide();
                toaster_message(data.message, data.icon);
            },
            error: function(request) {
                toaster_message(
                    "Something Went Wrong! Please Try Again.",
                    "error"
                );
            },
        });
    });

    /*Accept Offer*/
    $("body").on("click", ".accept", function(event) {
        var id = $(this).data("id");
        $('#loader_bg').show();

        $.ajax({
            url: aurl + "/Job-Application/accept-offer",
            type: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                $('#loader_bg').hide();
                toaster_message(data.message, data.icon);
            },
            error: function(request) {
                toaster_message(
                    "Something Went Wrong! Please Try Again.",
                    "error"
                );
            },
        });
    });



});

/*Reject Offer*/
$("body").on("click", ".reject", function(event) {
    var id = $(this).data("id");
    $('#loader_bg').show();

    $.ajax({
        url: aurl + "/Job-Application/reject-offer",
        type: "POST",
        data: { id: id },
        dataType: "JSON",

        success: function(data) {
            $('#loader_bg').hide();
            toaster_message(data.message, data.icon);
        },
        error: function(request) {
            toaster_message(
                "Something Went Wrong! Please Try Again.",
                "error"
            );
        },
    });
});