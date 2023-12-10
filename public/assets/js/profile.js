$(document).ready(function() {

    /* ajax setup */
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
        },
    });

    /* toaster message for every action */
    function toaster_message(message, icon, url, aurl) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger me-2'
            },
            buttonsStyling: false,
        })
        swalWithBootstrapButtons.fire({
            text: message,
            icon: icon,
            confirmButtonText: 'OK',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                window.location.href = aurl + '/' + url;
            }
        })
    }

    /* update buttons of connect */
    function connection_buttons(formData) {
        $("#search_form").validate({
            rules: {},

            messages: {},
        });
        var form = $("#search_form")[0];
        var formData = new FormData(form);
        if ($("#search_form").valid()) {
            $.ajax({
                url: aurl + "/search",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        var location = data.data.usersData;
                        var html = '<div class="row gx-10 overflow-hidden">';
                        if (data.data.user_status == 1) {
                            $.each(data.data.users, function(key, val) {
                                if (val.job_apply && val.job_apply.offer_accept == 3) {
                                    console.log('Done');
                                } else {
                                    var profile = val.user.user_status == 1 ? val.user.cover_image : val.user.profile;

                                    html += '<div class="col-md-6 card p-3 mt-3 ">';
                                    html += '<div class="d-flex align-items-center justify-content-between">';
                                    html += '<div class="d-flex align-items-center">';
                                    html += '<a class="name_link" href="' + aurl + '/profile/' + val.user.remember_token + '"><img class="rounded-circle" src="/assets/images/CoverImage/' + profile + '" height="50px" width="50px" alt=""></a>';
                                    html += '<a class="name_link" href="' + aurl + '/profile/' + val.user.remember_token + '"><h3 class="pl-3 pt-1 user_name" data-id="' + val.user.id + '">' + val.title + '</h3></a>';
                                    html += '</div>';
                                    html += '</div>';
                                    html += '<h5 class="pl-3 pt-1 user_name" data-id="' + val.user.id + '">' + val.user.name + '</h5></a>';
                                    html += '<p class="pl-3 ">' + val.user.address + '</p>';

                                    if (val.job_apply && val.id == val.job_apply.job_id && val.job_apply.status == 1) {
                                        html += '<a style="color: #cad1da;" href="' + aurl + '/Job-Application/index/' + val.user.id + +val.id + '"><div class="btn search-btn btn-primary" data-flag="0"  data-id="' + val.user.id + '"><span class="text-center"> Applied </span></div></a>';

                                    } else if (val.job_apply && val.id == val.job_apply.job_id && val.job_apply.status == 0) {
                                        html += '<a style="color: #cad1da;" href="' + aurl + '/Job-Application/index/' + val.user.id + +val.id + '"><div class="btn search-btn btn-primary" data-flag="0"  data-id="' + val.user.id + '"><span class="text-center"> Apply </span></div></a>';
                                    } else {
                                        html += '<a style="color: #cad1da;" href="' + aurl + '/Job-Application/index/' + val.user.id + +val.id + '"><div class="btn search-btn btn-primary" data-flag="0"  data-id="' + val.user.id + '"><span class="text-center"> Apply </span></div></a>';
                                    }
                                    html += '</div>';
                                }

                            });
                        } else {
                            $.each(data.data.usersData, function(key, val) {
                                var profile = val.doctor ? val.doctor.profile_image : '';
                                html += '<div class="col-md-6 card p-3 mt-3 hospital__wpr btn-wrpper-remove">';
                                html += '<a class="name_link" href="' + aurl + '/profile/' + val.remember_token + '"><img class="rounded-circle" src="/assets/images/profileImage/' + profile + '" height="50px" width="50px" alt="">';


                                html += '<h5 class="pl-3 pt-1 user_name" data-id="' + val.id + '">' + val.name + '</h5></a>';
                                html += '<p class="pl-3 ">' + val.address + '</p>';

                                if (val.from_connections.length != 0) {
                                    if (val.from_connections[0]['status'] == 1) {
                                        html += '<div class="dropdown">';
                                        html += '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>';
                                        html += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                        html += '<a class="dropdown-item remove remove-color" data-flag="0" data-connection_id="' + val.from_connections[0]['id'] + '" data-id="' + val.id + '">Remove Following</a>';
                                        html += '<a class="dropdown-item block" data-flag="0" data-connection_id="' + val.from_connections[0]['id'] + '" data-id="' + val.id + '">Block</a></div></div>';
                                    } else if (val.from_connections[0]['status'] == 2) {
                                        html += '<div class="btn btn-primary connect hospital__btn " data-flag="0" data-connection_id="' + val.from_connections[0]['id'] + '" data-id="' + val.id + '"><span class="text-center">Connect</span></div>';
                                    } else {
                                        html += '<div class="accept_remove_btn">';
                                        html += '<div class="btn accept" data-flag="0" data-connection_id="' + val.from_connections[0]['id'] + '" data-id="' + val.id + '"><span class="text-center">Accept</span></div>';
                                        html += '<div class="btn remove remove-color hospital__request_remove" data-flag="0" data-connection_id="' + val.from_connections[0]['id'] + '" data-id="' + val.id + '"><span class="text-center">Reject</span></div>';
                                        html += '</div>';
                                    }
                                } else if (val.to_connections.length != 0) {
                                    if (val.to_connections[0]['status'] == 1) {
                                        html += '<div class="dropdown">';
                                        html += '<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">...</button>';
                                        html += '<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                        html += '<a class="dropdown-item remove remove-color" data-flag="0" data-connection_id="' + val.to_connections[0]['id'] + '" data-id="' + val.id + '">Remove Following</a>';
                                        html += '<a class="dropdown-item block" data-flag="0" data-connection_id="' + val.to_connections[0]['id'] + '" data-id="' + val.id + '">Block</a></div></div>';
                                    } else if (val.to_connections[0]['status'] == 2) {
                                        html += '<div class="btn btn-primary connect hospital__btn" data-flag="0" data-connection_id="' + val.to_connections[0]['id'] + '" data-id="' + val.id + '"><span class="text-center">Connect</span></div>';
                                    } else {
                                        html += '<div class="btn remove h_wpr hospital__btn" data-flag="0" data-connection_id="' + val.to_connections[0]['id'] + '" data-id="' + val.id + '"><span class="text-center">Requested</span></div>';
                                    }
                                } else {
                                    html += '<div class="btn btn-primary connect hospital__btn" data-flag="0" data-id="' + val.id + '"><span class="text-center">Connect</span></div>';
                                }
                                html += '</div>';
                            });

                        }

                        html += '</div>';
                        initMap(location, html);

                    } else {
                        $('#address').val('');

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: "btn btn-success",
                                cancelButton: "btn btn-danger me-2",
                            },
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire("Cancelled", data.message, "error");

                    }
                },
            });
        }
    }


    /*Google Map*/
    function initMap(data_response, html) {

        $('.search_result').html(html);
        $('.search_result').show();
        $('.google-map-show').show();

        var lat = parseFloat(document.getElementById('lat').value);
        var lng = parseFloat(document.getElementById('lng').value);

        const myLatLng = { lat: lat, lng: lng };
        var latlng = [];

        for (i = 0; i < data_response.length; i++) {
            latlng[i] = new google.maps.LatLng(data_response[i]['latitude'], data_response[i]['longitude']);
        }
        var latlngbounds = new google.maps.LatLngBounds();

        for (var i = 0; i < latlng.length; i++) {
            latlngbounds.extend(latlng[i]);
        }

        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 4,
            center: myLatLng,
        });


        var infowindow = new google.maps.InfoWindow();
        var marker;

        for (i = 0; i < data_response.length; i++) {

            marker = new google.maps.Marker({
                position: new google.maps.LatLng(data_response[i]['latitude'], data_response[i]['longitude']),
                map: map,
                title: data_response[i]['name'],
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                var content = '<div class="row">' + '<div class="col-md-12 mb-2">' +
                    '<span> Name : ' + data_response[i]['name'] + '</span>' + '</div>' + '</div>' + '<div class="row">' +
                    '<div class="col-md-12">' + '<span> Location : ' + data_response[i]['address'] + '</span>' + '</div>' +
                    '</div>';
                return function() {
                    infowindow.setContent(content);
                    infowindow.open(map, marker);
                }
            })(marker, i));
            map.fitBounds(latlngbounds);
        }
    }


    /*
     * Author : Rajvi
     * Date : 30/04/22
     * JS for about,experience,user,cover and profile
     */
    /* validation of user form */
    $("#user_form").validate({
        rules: {
            name: {
                required: true,
            },
            email: {
                required: true,
            },
            contact_number: {
                required: true,
            },
            address: {
                required: true,
            },

        },

        messages: {
            name: {
                required: "Please Enter Your Name",
            },
            email: {
                required: "Please Enter Email",
            },
            contact_number: {
                required: "Please Enter Contact Number",
            },
            address: {
                required: "Please Enter Address",
            },
        },
    });

    /* validation of about form */
    $("#about_form").validate({
        rules: {
            about: {
                required: true,
            },
        },
        messages: {
            about: {
                required: "Please enter about your self",
            },
        },
    });

    /* validation of experience form */
    $("#experience_form").validate({
        rules: {
            name: {
                required: true,
            },
            position: {
                required: true,
            },
            logo: {
                extension: "jpg|jpeg|png",
            },
            start_date: {
                required: true,
            },

            end_date: {
                required: !$(".current").checked,
            },
        },
        errorPlacement: function(label, element) {
            if (element.attr("class") == "logo_input error") {
                label.insertAfter(element.closest(".logo-one"));
            } else {
                label.insertAfter(element);
            }
        },
        messages: {
            name: {
                required: "Please enter hospital name",
            },
        },
    });

    /* validation for hospital complete profile */
    $("#hospital_form").validate({
        rules: {
            hospital_name: {
                required: true,
            },
            headline: {
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
        errorPlacement: function(label, element) {
            if (element.attr("id") == "hospital_country") {
                label.insertAfter(element.closest(".country_div"));
            } else {
                label.insertAfter(element);
            }
        },
    });

    /* display cover modal */
    $("body").on("click", ".edit_cover", function(event) {
        $("#cover_modal").modal("show");
    });

    /* display profile modal */
    $("body").on("click", ".edit_profile", function(event) {
        $("#profile_modal").modal("show");
    });

    /* display user modal */
    $("body").on("click", ".edit_user", function(event) {
        $.ajax({
            url: aurl + "/profile/user/data",
            type: 'POST',
            dataType: "JSON",
            success: function(data) {
                if (data.data.status) {
                    if (data.data.user_status == 0) {
                        if (data.data.experience.length > 0) {
                            $('.current_position option[value="' + data.data.experience['0']['id'] + '"]').prop('selected', true);
                            $('.education option[value="' + data.data.education['0']['id'] + '"]').prop('selected', true);
                        }
                    }
                    $('#user_modal').modal('show');
                } else {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger me-2'
                        },
                        buttonsStyling: false,
                    })
                    swalWithBootstrapButtons.fire('Cancelled', data.message, 'error')
                }
            },
        });
        $("#user_modal").modal("show");
        $('.user_country').select2({
            dropdownParent: $('#user_modal')
        });
    });

    var $modal = $('#upload');
    var image = document.getElementById('cover_path');
    var cropper;
    /* after uploading cover picture display modal */
    $("#avatar").change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image.src = url;
            $("#cover_modal").modal("hide");
            $modal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    var cover_size_status = $('.cover_image_size').val();
    $modal.on('shown.bs.modal', function() {
        if (cover_size_status == 1) {
            cropper = new Cropper(image, {
                // aspectRatio: 5.2,
                viewMode: 3,
                preview: '.preview'
            });
        } else {
            cropper = new Cropper(image, {
                aspectRatio: 5.2,
                viewMode: 3,
                preview: '.preview'
            });

        }

    }).on('hidden.bs.modal', function() {
        cropper.destroy();
        // cropper = null;
    });

    /* add cover */
    $(".add_cover").on("click", function() {
        canvas = cropper.getCroppedCanvas({
            width: 1146,
            height: 220,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: aurl + "/profile/cover/store",
                    data: { image: base64data },
                    success: function(data) {
                        if (data.status) {
                            $modal.modal('hide');
                            toaster_message(data.message, data.icon, data.redirect_url, aurl);
                        }
                    }
                });
            }
        });
    });

    var $uploadProfilemodal = $('#upload_profile');
    var image_profile = document.getElementById('profile_path');
    var edit_image_profile = document.getElementById('current_profile');
    var cropper_profile;
    /* after uploading profile photo */
    $("#add_profile").change(function(event) {
        var files = event.target.files;
        var done = function(url) {
            image_profile.src = url;
            $("#profile_modal").modal("hide");
            $uploadProfilemodal.modal('show');
        };
        var reader;
        var file;
        var url;
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $uploadProfilemodal.on('shown.bs.modal', function() {
        cropper_profile = new Cropper(image_profile, {
            aspectRatio: 1,
            viewMode: 1,
            preview: '.preview'
        });
    }).on('hidden.bs.modal', function() {
        cropper_profile.destroy();
        // cropper = null;
    });
    $(".edit_profile_photo").on("click", function() {
        $("#profile_modal").modal("hide");
        $uploadProfilemodal.modal('show');
        image_profile.src = edit_image_profile.src;
    });

    /* add profile */
    $(".add_profile").on("click", function() {
        canvas = cropper_profile.getCroppedCanvas({
            width: 200,
            height: 200,
        });
        canvas.toBlob(function(blob) {
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function() {
                var base64data = reader.result;
                var id = $('#id').val();
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: aurl + "/profile/cover/store",
                    data: {
                        profile_image: base64data,
                        profile_id: id
                    },
                    success: function(data) {
                        if (data.status) {
                            $uploadProfilemodal.modal('hide');
                            toaster_message(data.message, data.icon, data.redirect_url, aurl);
                        }
                    }
                });
            }
        });
    });

    /* Delete Profile Data From Database */
    $(document).on("click", ".delete_profile", function() {
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
                    url: aurl + "/profile/profile/delete",
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


    /* display about modal */
    $("body").on("click", ".edit_description", function(event) {
        $("#about_modal").modal("show");
    });

    /* storing about data to database */
    $(document).on("click", ".submit_about", function() {
        var form = $("#about_form")[0];
        var formData = new FormData(form);
        if ($("#about_form").valid()) {
            $.ajax({
                url: aurl + "/profile/about",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#about_modal").modal("hide");
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    } else {
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    }
                },
            });
        }
    });

    /* disabling end date */
    $('.current').change(function() {
        if (this.checked) {
            $('.end_date').prop('disabled', true);
            $('.end_date').val('');
        } else {
            $('.end_date').prop('disabled', false);
        }
    });

    /* storing experience data to database */
    $(document).on("click", ".submit_experience", function() {
        var form = $("#experience_form")[0];
        var formData = new FormData(form);
        if ($("#experience_form").valid()) {
            $.ajax({
                url: aurl + "/profile/experience",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#experience_modal").modal("hide");
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    } else {
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    }
                },
            });
        }
    });

    /* display update experience modal */
    $("body").on("click", ".update_experience", function(event) {
        var id = $(this).data("id");
        $(".experience_modal_id").val(id);
        $('.delete_experience').attr('data-id', id);

        $.ajax({
            url: aurl + "/profile/experience/data",
            type: "POST",
            dataType: "JSON",
            data: { id: id },
            success: function(data) {
                if (data.status.status) {
                    $('#experience_form')['0'].reset();
                    $('#experienceModalLabel').text('Edit Experience');
                    $('.position').val(data.data.position);
                    $('#employment_type option[value="' + data.data.employment_type + '"]').prop('selected', true);
                    $('.hospital_name').val(data.data.name);
                    $('#country option[value="' + data.data.country + '"]').prop('selected', true);
                    $('.city_exp').val(data.data.city);
                    if (data.data.end_date == null) {
                        $('.current').prop('checked', true);
                        $('.end_date').prop('disabled', true);
                    }
                    $('.end_date_div').datepicker('setDate', data.data.end_date);
                    $('.start_date_div').datepicker('setDate', data.data.start_date);
                    $('.description').html(data.data.description);
                    $('.country').select2({
                        dropdownParent: $('#experience_modal')
                    });
                    $("#experience_modal").modal("show");
                } else {
                    toaster_message(data.status.message, data.status.icon, data.status.redirect_url);
                }
            },
        });
    });

    /* storing user data to database */
    $(document).on("click", ".submit_user", function() {
        var form = $("#user_form")[0];
        var formData = new FormData(form);
        if ($("#user_form").valid()) {
            $.ajax({
                url: aurl + "/profile/user",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#user_modal").modal("hide");
                    }
                    toaster_message(data.message, data.icon, data.redirect_url, aurl);
                },
            });
        }
    });

    /* display experience modal */
    $("body").on("click", ".add_experience", function(event) {
        $('.delete_experience').hide();
        $(".country").select2({
            dropdownParent: $("#experience_modal"),
        });
        $("#experience_modal").modal("show");
    });
    /* display education modal */
    $("body").on("click", ".add_education", function(event) {
        $('.delete_education').hide();
        $("#education_modal").modal("show");
    });
    /*
     * Author : Rajvi
     * Date : 30/04/22
     * end
     */

    // * Author : Rajvi
    // * Date : 2/05/22
    // * added education

    /* validation of education form */
    $.validator.setDefaults({
        ignore: [],
        // any other default options and/or rules
    });
    $("#education_form").validate({
        rules: {
            name: {
                required: true,
            },
            school_logo: {
                extension: "jpg|jpeg|png",
            },
            start_date: {
                required: true,
            },

            end_date: {
                required: !$(".current").checked,
            },
        },
        errorPlacement: function(label, element) {
            if (element.attr("class") == "school_logo_input error") {
                label.insertAfter(element.closest(".logo-one"));
            } else {
                label.insertAfter(element);
            }
        },
        messages: {
            name: {
                required: "Please enter university name",
            },
        },
    });

    /* storing education data to database */
    $(document).on("click", ".submit_education", function() {
        var form = $("#education_form")[0];
        var formData = new FormData(form);
        if ($("#education_form").valid()) {
            $.ajax({
                url: aurl + "/profile/education",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#education_modal").modal("hide");
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    } else {
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    }
                },
            });
        }
    });

    /* display update education modal */
    $("body").on("click", ".update_education", function(event) {
        var id = $(this).data("id");
        $(".education_modal_id").val(id);
        $('.delete_education').attr('data-id', id);
        $.ajax({
            url: aurl + "/profile/education/data",
            type: "POST",
            dataType: "JSON",
            data: { id: id },
            success: function(data) {
                if (data.status.status) {
                    $("#educationModalLabel").text("Edit Education");
                    $(".name").val(data.data.name);
                    $(".degree").val(data.data.degree);
                    $(".education_start_date_div").datepicker("setDate", data.data.start_date);
                    $(".education_end_date_div").datepicker("setDate", data.data.end_date);
                    $(".grade").val(data.data.grade);
                    $(".description").html(data.data.description);
                    $("#education_modal").modal("show");
                } else {
                    toaster_message(data.status.message, data.status.icon, data.status.redirect_url);
                }
            },
        });
    });

    // * Author : Rajvi
    // * Date : 2/05/22
    // * added education

    // * Author : Rajvi
    // * Date : 4/05/22
    // * added experience delete and education delete

    /* delete experience data from database */
    $(document).on("click", ".delete_experience", function() {
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
                    url: aurl + "/profile/experience/delete",
                    type: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(data) {
                        if (data.status) {
                            $("#experience_modal").modal("hide");
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

    /* delete education data from database */
    $(document).on("click", ".delete_education", function() {
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
                    url: aurl + "/profile/education/delete",
                    type: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(data) {
                        if (data.status) {
                            $("#education_modal").modal("hide");
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

    // * Author : Rajvi
    // * Date : 4/05/22
    // * end

    //Display Skill Model
    $("body").on("click", ".edit_skills", function(event) {
        $("#skill_modal").modal("show");
        $(".select_skill").select2({
            dropdownParent: $("#skill_modal"),
        });
    });

    /* validation of skill form */
    $("#skill_form").validate({
        rules: {
            "skills[]": {
                required: true,
            },
        },
        messages: {
            "skills[]": {
                required: "Please Select your Skills",
            },
        },
    });

    /* storing skill data to database */
    $(document).on("click", ".submit_skill", function() {
        var form = $("#skill_form")[0];
        var formData = new FormData(form);
        if ($("#skill_form").valid()) {
            $.ajax({
                url: aurl + "/profile/skills",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#skill_modal").modal("hide");
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    } else {
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    }
                },
            });
        }
    });

    //Display Language Model
    $("body").on("click", ".edit_language", function(event) {
        $("#language_model").modal("show");
        $(".select_language").select2({
            dropdownParent: $("#language_model"),
        });
    });

    /* validation of language form */
    $("#language_form").validate({
        rules: {
            "languages[]": {
                required: true,
            },
        },
        messages: {
            "languages[]": {
                required: "Please Select your language",
            },
        },
    });

    /* storing languages data to database */
    $(document).on("click", ".submit_language", function() {
        var form = $("#language_form")[0];
        var formData = new FormData(form);
        if ($("#language_form").valid()) {
            $.ajax({
                url: aurl + "/profile/languages",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#language_form").modal("hide");
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    } else {
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    }
                },
            });
        }
    });

    /* storing hospital data to database */
    $(document).on("click", "#hospital_submit", function() {
        var form = $("#hospital_form")[0];
        var formData = new FormData(form);
        if ($("#hospital_form").valid()) {
            $.ajax({
                url: aurl + "/complete/profile/hospital",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $('#tab_4').show();
                        $('#tab_1').hide();
                    } else {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: "btn btn-success",
                                cancelButton: "btn btn-danger me-2",
                            },
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire("Cancelled", data.message, "error");
                    }
                },
            });
        }
    });

    $(".pre_tab4").on("click", function() {
        document.getElementById("tab_1").style.display = "block";
        document.getElementById("tab_4").style.display = "none";
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
            $.ajax({
                url: aurl + "/complete/profile/hospital",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $('#tab_4').show();
                        $('#tab_1').hide();
                    } else {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: "btn btn-success",
                                cancelButton: "btn btn-danger me-2",
                            },
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire("Cancelled", data.message, "error");
                    }
                },
            });
            window.location.href = aurl;
        }
    });

    /* searching hospital data into database */
    $(document).on("click", ".search_button", function() {
        connection_buttons();
    });

    // Request To Connection
    $(document).on("click", ".connect", function() {
        const arr = [$(this).data('id')];
        if ($(this).data('connection_id') != null) {
            arr.push($(this).data('connection_id'));
        }
        var flag = $(this).data('flag');
        $.ajax({
            url: aurl + "/connect",
            type: "POST",
            dataType: "JSON",
            data: { arr: arr, flag: flag },
            cache: false,
            success: function(data) {
                if (data.status) {
                    if (data.flag) {
                        location.reload(true)
                    } else {
                        connection_buttons();
                    }
                }
            },
        });
    });
    // request to accept 
    $(document).on("click", ".accept", function() {
        var id = $(this).data('id');
        var connection_id = $(this).data('connection_id');
        var flag = $(this).data('flag');
        $.ajax({
            url: aurl + "/connect",
            type: "POST",
            dataType: "JSON",
            data: { accept_id: id, connection_id: connection_id, flag: flag },
            cache: false,
            success: function(data) {
                if (data.status) {
                    if (data.flag) {
                        location.reload(true)
                    } else {
                        connection_buttons();
                    }
                }
            },
        });

    });
    // request to remove
    $(document).on("click", ".remove", function() {
        var id = $(this).data('id');
        var connection_id = $(this).data('connection_id');
        var flag = $(this).data('flag');
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
            confirmButtonText: 'Cancel Request',
            cancelButtonText: 'Close',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: aurl + "/connect",
                    type: "POST",
                    dataType: "JSON",
                    data: { reject_id: id, connection_id: connection_id, flag: flag },
                    cache: false,
                    success: function(data) {
                        if (data.status) {
                            if (data.flag) {
                                location.reload(true)
                            } else {
                                connection_buttons();
                            }
                        }
                    },
                });
            }
        })
    });

    // request to block
    $(document).on("click", ".block", function() {
        var id = $(this).data('id');
        var connection_id = $(this).data('connection_id');
        var flag = $(this).data('flag');
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
            confirmButtonText: 'Block User',
            cancelButtonText: 'Close',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: aurl + "/connect",
                    type: "POST",
                    dataType: "JSON",
                    data: { block_id: id, connection_id: connection_id, flag: flag },
                    cache: false,
                    success: function(data) {
                        if (data.status) {
                            if (data.flag) {
                                location.reload(true)
                            } else {
                                connection_buttons();
                            }
                        }
                    },
                });
            }
        })
    });

    /* opening perticular chatbox */
    $(document).on("click", ".message", function() {
        var id = $(this).data('id');
        $.ajax({
            url: aurl + "/chatToOne",
            type: "POST",
            dataType: "JSON",
            data: { r_id: id },
            cache: false,
            success: function(data) {
                if (data.status.status) {
                    const chatMessages = document.querySelector('.chat-body');
                    chatMessages.scrollBottom = chatMessages.scrollHeight;
                    var friendInfo = data.data.friendInfo;
                    $('.status').addClass('user-icon-' + friendInfo.id);
                    friendInfo.user_status == 1 ? $('.hospital_name').html(friendInfo.hospital_name) : '';
                    $('.r_profile').attr('src', friendInfo.profile);
                    $('.r_name').html(friendInfo.first_name + ' ' + friendInfo.last_name)
                    $('#chatToOne').show();
                    var html = '';
                    let tempData = [];
                    let tempArr = Object.entries(data);
                    tempData.push(tempArr[0][1]);
                    tempData.forEach((data) => {
                        var myInfo = data.myInfo;
                        var frndInfo = data.friendInfo;
                        data.messages.forEach((message) => {
                            var class_name = (message.user_messages.s_id == myInfo.id) ? 'me' : "friend";
                            var profile_url = (message.user_messages.s_id == myInfo.id) ? myInfo.profile : frndInfo.profile;
                            html += '<li class="message-item ' + class_name + '">'
                            html += '<img src="' + profile_url + '" class="img-xs rounded-circle" alt="avatar">'
                            html += '<div class="content">'
                            html += '<div class="message">'
                            html += '<div class="bubble">'
                            html += '<p>' + message.message + '</p>'
                            html += '</div>'
                            html += '<span>' + message.created_at + ' </span>'
                            html += `</div>
                            </div>
                          </li>`;
                        });
                    });
                    $('.messages').html(html);
                }
            },
        });

    });
    $(document).on("click", ".close_chat", function() {
        $('#chatToOne').hide();
    });


    /*
     * Author : kishan
     * Date : 3/05/22
     * Added end date disable checkbox js
     */

    $(".h_current").change(function() {
        if (this.checked) {
            $(".h_end_date").prop("disabled", true);
        } else {
            $(".h_end_date").prop("disabled", false);
        }
    });

    $(".e_current").change(function() {
        if (this.checked) {
            $(".e_end_date").prop("disabled", true);
        } else {
            $(".e_end_date").prop("disabled", false);
        }
    });

    /*
     * Author : kishan
     * Date : 3/05/22
     * End
     */


    /* Validation Of Job Post Form */
    $("#job_post_form").validate({
        rules: {
            title: {
                required: true,
            },
            "skills[]": {
                required: true,
            },
            "languages[]": {
                required: true,
            },
            select_experience: {
                required: true,
            },
            work_period: {
                required: true,
            },
            description: {
                required: true,
            },
            hourly_rate: {
                required: true,
            },

        },
        messages: {
            title: {
                required: "Please Enter Title",
            },
            "skills[]": {
                required: "Please Select Skills",
            },
            "languages[]": {
                required: "Please Select Languages",
            },
            select_experience: {
                required: "Please Select Experience",
            },
            work_period: {
                required: "Please Enter Work Period",
            },
            description: {
                required: "Please Enter Job Description",

            },
            hourly_rate: {
                required: "Please Enter Hourly Rate",
            },
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


    /* Display Job Post Modal */
    /*   $("body").on("click", ".add_job", function(event) {
          $("#job_post_form").validate().resetForm();
          $("#job_post_form").trigger("reset");
          $('.delete_job').hide();
          $("#job_modal").modal("show");
          $(".submit_job").text("Add Job");
          $(".select_skills,.select_experience, .select_language").select2({
              dropdownParent: $("#job_modal"),
          });

      }); */


    /* Storing Job Data To Database */
    $(document).on("click", ".submit_job", function() {
        var form = $("#job_post_form")[0];
        var formData = new FormData(form);
        if ($("#job_post_form").valid()) {

            $.ajax({
                url: aurl + "/profile/job/store",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                        $("#job_modal").modal("hide");
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    } else {
                        toaster_message(data.message, data.icon, data.redirect_url, aurl);
                    }
                },
            });

        }
    });

    /* Display Edit Job Modal */
    $("body").on("click", ".update_job", function(event) {
        var id = $(this).data("id");
        $(".job_post_modal_id").val(id);
        $('.delete_job').attr('data-id', id);
        $.ajax({
            url: aurl + "/profile/job/update",
            type: "POST",
            dataType: "JSON",
            data: { id: id },
            success: function(data) {
                if (data.status.status) {
                    $("#jobModalLabel").text("Update Job");
                    $(".submit_job").text("Update Job");
                    $(".title").val(data.data.job.title);
                    $(".work_period").val(data.data.job.work_period);
                    $("textarea[name='description']").val(data.data.job.description);

                    $(".hourly_rate").val(data.data.job.hourly_rate);

                    $(
                        ".select_experience option[value=" +
                        data.data.job.experience +
                        "]"
                    ).prop("selected", true);

                    $(".select_skills").select2({
                        multiple: true,
                    });
                    $('.select_skills').val(data.data.skill).trigger('change');

                    $(".select_language").select2({
                        multiple: true,
                    });
                    $('.select_language').val(data.data.language).trigger('change');

                    $(".form-select").select2({
                        dropdownParent: $(".addmodal"),
                        width: "100%",
                    });

                    $(".attach_image").attr(
                        "src",

                        aurl + "/assets/images/JobImage/" + data.data.job.attach_file
                    );

                    $("#job_modal").modal("show");
                } else {
                    toaster_message(data.status.message, data.status.icon, data.status.redirect_url);
                }
            },
        });
    });

    /* Delete job Data From Database */
    $(document).on("click", ".delete_job", function() {
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
                    url: aurl + "/profile/job/delete",
                    type: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(data) {
                        if (data.status) {
                            $("#job_modal").modal("hide");
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

    $(document).on("click", ".about", function() {
        $('.hospital-about').show();
        $('.hospital-current-job').hide();
        $('.hospital-past-job').hide();


    });
    $(document).on("click", ".current-job", function() {
        $('.hospital-current-job').show();
        $('.hospital-about').hide();
        $('.hospital-past-job').hide();


    });
    $(document).on("click", ".menu-past-hospital", function() {
        $('.hospital-past-job').show();
        $('.hospital-about').hide();
        $('.hospital-current-job').hide();

    });
    $(document).on("click", ".heart", function() {
        var id = $(this).data('id');
        // alert(id);
        $.ajax({
            url: aurl + "/profile/like",
            type: "POST",
            dataType: "JSON",
            data: { id: id },

            success: function(data) {
                if (data.status) {
                    if (data.data == 1) {
                        // console.log('remove');
                        $('#heart').removeClass('active_like')
                            /*  if (!$('#heart').hasClass('active_like')) {
                             $('#heart').addClass('active_like')
                         }*/

                    } else {
                        // console.log('add');
                        $('#heart').addClass('active_like')
                    }

                } else {
                    toaster_message(data.message, data.icon);
                }
            },
        });

    });


    $(document).on("click", "#star", function() {
        var id = $(this).data('id');
        $.ajax({
            url: aurl + "/profile/review",
            type: "POST",
            dataType: "JSON",
            data: { id: id },

            success: function(data) {
                console.log(data);
                if (data.status) {
                    if (data.data.review == 1) {
                        $('#star').addClass('active_review')

                    } else {
                        console.log('remove');
                        $('#star').removeClass('active_review')
                    }
                } else {
                    toaster_message(data.message, data.icon);
                }
            },
        });

    });


});