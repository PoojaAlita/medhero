/*DataTable*/
var listing = $("#doctor_tbl").DataTable({
    aLengthMenu: [
        [10, 30, 50, -1],
        [10, 30, 50, "All"],
    ],
    iDisplayLength: 10,
    language: {
        search: "",
    },
    ajax: {
        type: "POST",
        url: aurl + "/admin/doctor/listing",
    },
    columns: [
        { data: "0" },
        { data: "1" },
        { data: "2" },
        { data: "3" },
        { data: "4" },
        { data: "5" },
        { data: "6" },
        { data: "7" },

    ],

});

$(document).ready(function() {
    /*Update Approval*/
    $("body").on("click", ".padding", function(event) {
        var id = $(this).data("id");
        $(".id").val(id);
        $('#loader_bg').show();
        event.preventDefault();
        $.ajax({
            url: aurl + "/admin/doctor/approval",
            type: "GET",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                $('#loader_bg').hide();
                listing.ajax.reload();
            },
            error: function(request) {
                toaster_message(
                    "Something Went Wrong! Please Try Again.",
                    "error"
                );
            },
        });
    });

    /* Reject Doctor */
    $("body").on("click", ".reject", function(event) {
        event.preventDefault();
        var id = $(this).data("id");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger me-2",
            },
            buttonsStyling: false,
        });

        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, Reject It!",
                cancelButtonText: "No, Cancel!",
                reverseButtons: true,
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: aurl + "/admin/doctor/reject",
                        data: { id: id },
                        dataType: "JSON",
                        success: function(data) {
                            if (data.status) {
                                swalWithBootstrapButtons
                                    .fire({
                                        title: "Rejected!",
                                        text: "Your File Has Been Rejected.",
                                        icon: "success",
                                        confirmButtonText: "OK",
                                        reverseButtons: true,
                                    })
                                    .then((result) => {
                                        if (result.value) {
                                            listing.ajax.reload();
                                        }
                                    });
                            }
                        },
                        error: function(error) {
                            swalWithBootstrapButtons.fire(
                                "Cancelled",
                                "This Data Is Reject :)",
                                "error"
                            );
                        },
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelled",
                        "Your data file is safe :)",
                        "error"
                    );
                }
            });
    });
});