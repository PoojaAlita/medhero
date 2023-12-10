@extends('layouts.master')
@push('plugin-styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link href="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush
@section('pageTitle', 'Profile | Calendar')

@section('content')
<div class="container">
    <div id='calendar'></div>
</div>

<!-- event modal -->
<div class="modal modal-common fade" id="event_modal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modal-g-photo">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel">Add Event</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body md-detail">
            <p class="p-require">* Indicates required</p>
            <form class="frm-details" id="event_form">
                @csrf
                <div class="mb-3">
                    <input type="hidden" class="form-control" id="u_id" name="u_id" value="{{ Auth::user()->id }}">
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control id" id="id" name="id" value="0">
                </div>
                <div class="frm-grp">
                    <label>Title*</label>
                    <input class="input-cstm title" type="text" name="title" placeholder="Title" value=""/>
                </div>
                <div class="date datepicker frm-grp col-md-6 event_start_date_div">
                    <label for="start" class="form-label">Start Date</label>
                    <input autocomplete="off" type="text" class="input-cstm input-group-addon start" id="start" name="start" value="">
                </div>
                <div class="date datepicker frm-grp col-md-6 event_end_date_div">
                    <label for="end" class="form-label">End Date</label>
                    <input autocomplete="off" type="text" class="input-cstm input-group-addon end" id="end" name="end" value="">
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn delete_event" data-id="0">Delete Event</button>
          <button type="button" class="btn btn-blue-modal submit_event">Apply</button>
        </div>
      </div>
    </div>
</div>
<!-- event modal -->
<div class="modal modal-common fade" id="eventView_modal" tabindex="-1" aria-labelledby="eventViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modal-g-photo">
        <div class="modal-header">
          <h5 class="modal-title" id="eventViewModalLabel">Event View</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body md-detail">
                <div class="frm-grp">
                    <label>Title</label>
                    <p class="title_view" name="title" placeholder="Title" value=""></p>
                </div>
                <div class="frm-grp col-md-6">
                    <label for="start" class="form-label">Start Date</label>
                    <p class="start" id="start_view" name="start" value=""></p>
                </div>
                <div class="frm-grp col-md-6">
                    <label for="end" class="form-label">End Date</label>
                    <p class="end" id="end_view" name="end" value=""></p>
                </div>
        </div>
      </div>
    </div>
</div>
@endsection
@push('plugin-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
@endpush
@push('custom-scripts')
<script src="{{ asset('assets/js/datepicker.js') }}"></script>
<script>
$(document).ready(function () {
    function date_convert(date){
        var dateArr = date.split(' ');
        date = dateArr[0]+'T'+dateArr[1];
        return date;
    }

    $("#event_form").validate({
        rules: {
            start: {
                required: true,
            },
            end: {
                required: true,
            },
            title: {
                required: true,
            },
        },
    });

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="_token"]').attr('content')
        }
    });

    /* storing event data to database */
    $(document).on("click", ".submit_event", function () {
        var form = $("#event_form")[0];
        var formData = new FormData(form);
        if ($("#event_form").valid()) {
            $.ajax({
                url: aurl + "/full-calender/action",
                type: "POST",
                dataType: "JSON",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data.status) {
                        calendar.fullCalendar('refetchEvents');
                        $('#event_modal').modal('hide');
                    } else {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: "btn btn-success",
                                cancelButton: "btn btn-danger me-2",
                            },
                            buttonsStyling: false,
                        });
                        swalWithBootstrapButtons.fire(
                            "Cancelled",
                            data.message,
                            "error"
                        );
                    }
                },
            });
        }
    });

    /* delete event data from database */
    $(document).on("click", ".delete_event", function () {
        var id = $('#event_modal .delete_event').attr('data-id');
        $('.type').val('delete');
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
                    url: aurl + "/full-calender/action/delete",
                    type: "POST",
                    dataType: "JSON",
                    data: { id: id },
                    success: function(data) {
                        if (data.status) {
                            $('.delete_event').attr('data-id','0');
                            swalWithBootstrapButtons.fire({
                                title: 'Deleted!',
                                text: "Your file has been deleted.",
                                icon: 'success',
                                confirmButtonText: 'OK',
                                reverseButtons: true
                            }).then((result) => {
                                if(result.value){
                                    calendar.fullCalendar('refetchEvents');
                                    $('#event_modal').modal('hide');
                                   
                                }
                            })
                        }else {
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: "btn btn-success",
                                    cancelButton: "btn btn-danger me-2",
                                },
                                buttonsStyling: false,
                            });
                            swalWithBootstrapButtons.fire(
                                "Cancelled",
                                data.message,
                                "error"
                            );                    
                        }
                        
                    },
                    error: function (error) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'this data is not available :)',
                            'error'
                        )
                    }
                });
                
            } else if (result.dismiss === Swal.DismissReason.cancel){
                id =""
                swalWithBootstrapButtons.fire('Cancelled','Your data is safe :)','error')
            }
        })
    });
    function dateToYMD(date) {
        var d = date.getDate();
        var m = date.getMonth() + 1; //Month from 0 to 11
        var y = date.getFullYear();
        return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
    }
    var calendar = $('#calendar').fullCalendar({
        editable:true,
        viewRender: function(currentView){
            var minDate = moment();
            // Past
            $(".fc-past").prop('disabled', true); 
            $(".fc-past").addClass('fc-state-disabled'); 
        },
        header:{
            left:'prev,next today',
            center:'title',
            right:'month,agendaWeek,agendaDay'
        },
        events:'/full-calender',
        displayEventTime: false,
        selectable:true,
        selectHelper: true,
        select:function(start, end, allDay)
        {
            var check = start._d.toJSON().slice(0,10);
            var today = new Date().toJSON().slice(0,10);
            if(check >= today){
                var start_date = new Date(start._d.getFullYear(), start._d.getMonth(), start._d.getDate());
                var end_date = new Date(end._d.getFullYear(), end._d.getMonth(), end._d.getDate());
                var date = new Date();
                var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
                $.ajax({
                    url: aurl + "/full-calender/check_event",
                    type: "POST",
                    dataType: "JSON",
                    data: { start_date: dateToYMD(start_date), end_date:dateToYMD(end_date)},
                    success: function(data) {
                        if (data.status) {
                            console.log(data.data)
                            $('#event_form')['0'].reset();
                            $('.delete_event').hide();
                            $('#event_modal').modal('show'); 
                            $(".event_start_date_div").datepicker( {
                                format: "mm/dd/yyyy",
                                todayHighlight: true,
                                autoclose: true,
                                startDate: today,
                                datesDisabled: data.data
                            });
                            $(".event_end_date_div").datepicker( {
                                format: "mm/dd/yyyy",
                                todayHighlight: true,
                                autoclose: true,
                                startDate: today,
                                datesDisabled: data.data
                            });
                            $('.event_start_date_div').datepicker('setDate', start_date);
                            $('.event_end_date_div').datepicker('setDate', end_date);
                            $('.submit_event').text('Add');
                            $('#eventModalLabel').text('Add Event');
                        }else {
                            const swalWithBootstrapButtons = Swal.mixin({
                                customClass: {
                                    confirmButton: "btn btn-success",
                                    cancelButton: "btn btn-danger me-2",
                                },
                                buttonsStyling: false,
                            });
                            swalWithBootstrapButtons.fire(
                                "Cancelled",
                                data.message,
                                "error"
                            );                    
                        }
                    },
                    error: function (error) {
                        swalWithBootstrapButtons.fire(
                            'Cancelled',
                            'this data is not available :)',
                            'error'
                        )
                    }
                });
            }
        },
        editable:true,
        eventResize: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },
        eventDrop: function(event, delta)
        {
            var start = $.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss');
            var title = event.title;
            var id = event.id;
            $.ajax({
                url:"/full-calender/action",
                type:"POST",
                data:{
                    title: title,
                    start: start,
                    end: end,
                    id: id,
                    type: 'update'
                },
                success:function(response)
                {
                    calendar.fullCalendar('refetchEvents');
                    alert("Event Updated Successfully");
                }
            })
        },

        /* pop-up modal for edit */
        eventClick:function(event)
        {
            var date = new Date();
            var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
            var id = event.id;
            $('#id').val(id);
            $('.delete_event').attr('data-id', id);
            $.ajax({
                url:"/full-calender/data",
                type:"POST",
                data:{id:id},
                dataType:'JSON',
                success:function(response)
                {
                    var current_day = new Date().toJSON().slice(0,10);
                    var check = event.start._d.toJSON().slice(0,10);
                    if(response.status.status){
                        if(check>=current_day){
                            $(".event_start_date_div").datepicker( {
                                format: "mm/dd/yyyy",
                                todayHighlight: true,
                                autoclose: true,
                                startDate: today,
                                datesDisabled: response.datesUnavailable
                            });
                            $(".event_end_date_div").datepicker( {
                                format: "mm/dd/yyyy",
                                todayHighlight: true,
                                autoclose: true,
                                startDate: today,
                                datesDisabled: response.datesUnavailable
                            });
                            $('.event_start_date_div').datepicker("setDate", new Date(response.data.start) );
                            $('.event_end_date_div').datepicker("setDate", new Date(response.data.end) );
                            $('.submit_event').text('Update')
                            $('#eventModalLabel').text('Edit Event')
                            $('.title').val(response.data.title);
                            $('.delete_event').show();
                            $('#event_modal').modal('show');
                        }else{
                            // console.log(new date(response.data.start));
                            $('.title_view').html(response.data.title);
                            $('#start_view').html(moment(response.data.start).format('ll'));
                            $('#end_view').html(moment(response.data.end).format('ll'));
                            $('#eventView_modal').modal('show');
                        }
                        
                    }
                }
            })
        }
    });

});
</script>
@endpush
