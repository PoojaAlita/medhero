@extends('layouts.master')
@php 
  $login_user=Auth::user();
@endphp
@section('content')
<div class="container">
<input type="hidden" id="login_id" value="{{ $login_user->id }}">
    <div class="row chat-wrapper">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="row position-relative">
                <div class="col-lg-4 chat-aside border-end-lg">
                  <div class="aside-content">
                    <div class="aside-header">
                      <div class="d-flex justify-content-between align-items-center pb-2 mb-2">
                        <div class="d-flex align-items-center">
                          <figure class="me-2 mb-0">
                            <img src="{{ $login_user->profile }}" class="img-sm rounded-circle" alt="profile">
                            <div class="status user-icon-{{ $login_user->id }}"></div>
                          </figure>
                          <div>
                            <h6>{{ $login_user->first_name  }} {{ $login_user->last_name }}</h6>
                            <p class="text-muted tx-13">{{ $login_user->headline }}</p>
                          </div>
                        </div>
                        <div class="dropdown">
                          <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-lg text-muted pb-3px" data-feather="settings" data-bs-toggle="tooltip" title="Settings"></i>
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View Profile</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit Profile</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="aperture" class="icon-sm me-2"></i> <span class="">Add status</span></a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="settings" class="icon-sm me-2"></i> <span class="">Settings</span></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="aside-body">
                      <ul class="nav nav-tabs nav-fill mt-3" role="tablist">
                        <li class="nav-item">
                          <a class="nav-link active" id="chats-tab" data-bs-toggle="tab" data-bs-target="#chats" role="tab" aria-controls="chats" aria-selected="true">
                            <div class="d-flex flex-row flex-lg-column flex-xl-row align-items-center justify-content-center">
                              <i data-feather="message-square" class="icon-sm me-sm-2 me-lg-0 me-xl-2 mb-md-1 mb-xl-0"></i>
                              <p class="d-none d-sm-block">Chats</p>
                            </div>
                          </a>
                        </li>
                      </ul>
                      <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="chats" role="tabpanel" aria-labelledby="chats-tab">
                          <div>
                            <p class="text-muted mb-1">Recent chats</p>
                            <ul class="list-unstyled chat-list px-1 users_list">
                              {{-- @foreach ($all_users as $user)
                              @php 
                                $id = $user->id ;
                              @endphp
                              <li class="chat-item pe-1">
                                <a href="{{ route('message.conversation', $id) }}" class="d-flex align-items-center">
                                  <figure class="mb-0 me-2">
                                    <img src="{{ $user->profile }}" class="img-xs rounded-circle" alt="user">
                                    <div class="status user-icon-{{ $id }}"></div>
                                  </figure>
                                  <div class="d-flex justify-content-between flex-grow-1 border-bottom">
                                    <div>
                                      <span class="text-body fw-bolder"><span>{{ $user->first_name }} {{ $user->last_name }}</span></span>
                                      <span class="text-muted tx-13 d-block user-message-{{ $id }}">{{ $user->message }}</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                      <span class="text-muted tx-13 mb-1 user-message_time-{{ $id }}">{{ $user->message_time }}</span>
                                      <div class="badge rounded-pill bg-primary ms-auto user-counter-{{ $id }}">{{ $user->unseen_message!=0?$user->unseen_message:'' }}</div>
                                    </div>
                                  </div>
                                </a>
                              </li>
                              @endforeach --}}
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 chat-content">
                  <p class="text-center">click for starting chat</p>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection

@push('custom-scripts')
  <script src="{{ asset('assets/plugins/socket.io/socket.io.min.js') }}" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/plugins/qs.min.js') }}" integrity="sha512-juaCj8zi594KHQqb92foyp87mCSriYjw3BcTHaXsAn4pEB1YWh+z+XQScMxIxzsjfM4BeVFV3Ij113lIjWiC2w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{ asset('assets/js/chat.js') }}"></script>
  <script>
    /* ajax setup */
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="_token"]').attr("content"),
        },
    });
    usersGet();
    function usersGet(){
      $.ajax({
          url: aurl + '/getUser',
          type: 'POST',
          processData: false,
          contentType: false,
          dataType: 'JSON',
          success: function (data) {
            if (data.success) {
              var html = '';
              $.each(data.data,function(key,val){
                var unseen_count = val.unseen_message!=0 ? val.unseen_message : ''
                html += '<li class="chat-item pe-1">'
                  html += '<a href="'+val.route_url+'" class="d-flex align-items-center">'
                    html += '<figure class="mb-0 me-2">'
                      html += '<img src="'+val.profile+'" class="img-xs rounded-circle" alt="user">'
                      html += '<div class="status user-icon-'+val.id+'"></div>'
                    html += '</figure>'
                    html += '<div class="d-flex justify-content-between flex-grow-1 border-bottom">'
                      html += '<div>'
                        html += '<span class="text-body fw-bolder"><span>'+val.first_name+' '+val.last_name+'</span></span>'
                        html += '<span class="text-muted tx-13 d-block user-message-'+val.id+'">'+val.message+' </span>'
                      html += '</div>'
                      html += '<div class="d-flex flex-column align-items-end">'
                        html += '<span class="text-muted tx-13 mb-1 user-message_time-'+val.id+'">'+val.message_time+'</span>'
                        html += '<div class="badge rounded-pill bg-primary ms-auto user-counter-'+val.id+'">'+unseen_count+'</div>'
                      html += '</div>'
                    html += '</div>'
                  html += '</a>'
                html += '</li>'
              });
              $('.users_list').html(html);
            }
          }
      });
    }
    $(function (){
      let userID = $('#login_id').val();
      let ip_address = aurl.split("/")[2].toString().split(":")[0];
      let socket_port = '8005';
      let socket = io(ip_address + ':' + socket_port);
      socket.on('connect', function() {
          socket.emit('user_connected',userID);
      });
      socket.on('updateUserStatus', (data) => {
      let $userStatusIcon = $('.status');
      $userStatusIcon.removeClass('online');
      $userStatusIcon.attr('title', 'Away');
        $.each(data, function (key, val) {
            if (val.length !== 0 && val !== 0) {
              let $userIcon = $(".user-icon-"+key);
              $userIcon.addClass('online');
              $userIcon.attr('title','Online');
            }
        });
      });
      function formatAMPM(date) {
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // the hour '0' should be '12'
        minutes = minutes < 10 ? '0'+minutes : minutes;
        var strTime = hours + ':' + minutes + ' ' + ampm;
        return strTime;
      }
      socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message){
        $messageClass = $('.user-message-'+message.sender_id);
        $messageClass.html(message.content);
        $('.user-message_time-'+message.sender_id).html(formatAMPM(new Date));
        var x= $('.user-counter-'+message.sender_id).html()!=''?parseInt($('.user-counter-'+message.sender_id).html()):0;
        $('.user-counter-'+message.sender_id).html(x+1)
        usersGet();
      });

    });
  </script>
@endpush