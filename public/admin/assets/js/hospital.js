/*DataTable*/
var listing = $("#hospital_tbl").DataTable({
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
        url: aurl + "/admin/hospital/listing",
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
let images = [];
$(document).ready(function() {

    /* Validation Of Hospital Form */
    $("#hospital_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
                email_check: true,
            },
            password: {
                required: true,
            },
            contact: {
                required: true,
                number: true,
                minlength: 10,
                maxlength: 10
            },
            address: {
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
            contact: {
                required: "Please Enter Contact Number",
                number: "Only Number Enter",
                minlength: "Please Enter Minimum 10 Number",
                maxlength: "Please Enter Maximum 10 Number"
            },
            address: {
                required: "Please Enter Address",
            },
            public_private_hospital: {
                required: "Please Select Public Private Hospital",
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
            var id = $("#id").val();
            var email = $.ajax({
                url: aurl + "/admin/validate-email",
                type: "POST",
                async: false,
                data: {
                    email: value,
                    id: id,
                },
            }).responseText;
            if (email != 0) {
                return false;
            } else return true;
        },
        "Email Already Exists"
    );


    /* Add Hospital Modal */
    $("body").on("click", ".add_hospital", function() {
        $("#hospital_form").validate().resetForm();
        $("#hospital_form").trigger("reset");
        $("#hospital_modal").modal("show");
        $('#preview').html(' ');
        $('.cover_images').html(' ');
        $(".exampleInputPassword").show();
        $(".id").val('');
        $("#title_hospital_modal").text("Add Hospital");
        $(".submit_hospital").text("Add Hospital");
    });

    var filesArr = [];

    /* Adding And Updating Hospital Modal */
    $(".submit_hospital").click(function(event) {
        event.preventDefault();
        var form = $("#hospital_form")[0];
        var formData = new FormData(form);

        filesArr.forEach((f) => {
            formData.append("thumb[]", f, f.name);
        });

        if ($("#hospital_form").valid()) {
            $('#loader_bg').show();
            $.ajax({
                url: aurl + "/admin/hospital/store",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    $('#loader_bg').hide();
                    $("#hospital_modal").modal("hide");
                    toaster_message(data.message, data.icon);
                },
                error: function(request) {
                    toaster_message(
                        "Something Went Wrong! Please Try Again.",
                        "error"
                    );
                },
            });
        }
    });

    /* Display Update Hospital Modal*/
    $("body").on("click", ".edit_hospital", function(event) {
        var id = $(this).data("id");
        $(".id").val(id);
        event.preventDefault();
        $.ajax({
            url: aurl + "/admin/hospital/edit",
            type: "POST",
            data: { id: id },
            dataType: "JSON",
            success: function(data) {
                if (data.status) {
                    $("#hospital_form").trigger("reset");
                    $("#hospital_form").validate().resetForm();
                    $("#title_hospital_modal").text("Update Hospital");
                    $("#hospital_modal").modal("show");
                    $(".submit_hospital").text("Update Hospital");
                    $("#name").val(data.data.user.name);
                    $("#email").val(data.data.user.email);
                    $("#password").val(data.data.user.password);
                    $("#contact").val(data.data.user.phone_number);
                    $("#address").val(data.data.user.address);
                    $("#lat").val(data.data.user.latitude);
                    $("#lng").val(data.data.user.longitude);
                    $(
                        ".public-private-hospital option[value=" +
                        data.data.hospital.private_public_hospital +
                        "]"
                    ).prop("selected", true);
                    $(".form-select").select2({
                        dropdownParent: $(".addmodal"),
                        width: "100%",
                    });

                    $(".profile_cover").attr(
                        "src",
                        aurl + "/assets/images/CoverImage/" + data.data.user.cover_image
                    );
                    var thumbs = data.data.user.thumb;
                    $('#preview').html('');
                    thumbs.forEach(thumb => {
                        var thumbImg = thumb.thumb_image.split('|')
                        for (var index = 0; index < thumbImg.length; index++) {
                            var src = thumbImg[index];
                            // Add img element in <div id='preview'>
                            $('#preview').append('<img class="preview_thumb" style="width: 100px;margin: 3px;" src="/assets/images/Thumb/' + src + '">');
                        }
                    });
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

    /* Delete job Data From Database */
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
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: aurl + "/admin/hospital/delete",
                    type: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(data) {
                        if (data.status) {
                            toaster_message(data.message, data.icon, data.redirect_url, aurl);
                        } else {
                            toaster_message(data.message, data.icon, data.redirect_url, aurl);
                        }

                    },
                    error: function(error) {
                        swalWithBootstrapButtons.fire('Cancelled', 'this data is not available :)', 'error')
                    }
                });

            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire('Cancelled', 'Your data is safe :)', 'error')
            }
        })
    });


    if (window.File && window.FileList && window.FileReader) {
        $("#thumb_image").on("change", function(e) {
            var files = $("#thumb_image")[0].files;
            $.each(files, function(index, value) {
                filesArr.push(value);
            });
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result + "\"  />" +
                        "<br/><span class=\"remove\"><button>Remove</button></span>" +
                        "</span>").appendTo("#img-upload");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                        //Delete image from images array here
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }

});

function addImagesToList() {
    let newImages = document.getElementById("thumb_image").files;
    for (var i = 0; i < newImages.length; i++) {
        images.push(newImages[i]);
    }
}