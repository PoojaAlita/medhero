@extends('layouts.master')

@section('content')
<input type="hidden" id="login_id" value="{{ $myInfo->id }}">
<div class="container">
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
                            <img src="{{ $myInfo->profile }}" class="img-sm rounded-circle" alt="profile">
                            <div class="status user-icon-{{ $myInfo->id }}"></div>
                          </figure>
                          <div>
                            <h6>{{ $myInfo->first_name }} {{ $myInfo->last_name }}</h6>
                            <p class="text-muted tx-13">{{ $myInfo->designation }}</p>
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
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-8 chat-content">
                  <div class="chat-header border-bottom pb-2">
                    <div class="d-flex justify-content-between">
                      <div class="d-flex align-items-center">
                        <i data-feather="corner-up-left" id="backToChatList" class="icon-lg me-2 ms-n2 text-muted d-lg-none"></i>
                        <figure class="mb-0 me-2">
                          <img src="{{ $friendInfo->profile }}" class="img-sm rounded-circle" alt="image">
                        </figure>
                        <div>
                          <p><span>{{ $friendInfo->first_name }} {{ $friendInfo->last_name }}</span></p>
                          <p class="text-muted tx-13"> {{ $friendInfo->designation }}</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-center me-n1">
                        <a href="#">
                          <i data-feather="video" class="icon-lg text-muted me-3" data-bs-toggle="tooltip" title="Start video call"></i>
                        </a>
                        <a href="#">
                          <i data-feather="phone-call" class="icon-lg text-muted me-0 me-sm-3" data-bs-toggle="tooltip" title="Start voice call"></i>
                        </a>
                        <a href="#" class="d-none d-sm-block">
                          <i data-feather="user-plus" class="icon-lg text-muted" data-bs-toggle="tooltip" title="Add to contacts"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="chat-body">
                    <ul class="messages">
                      @foreach ($messages as $message)
                        <li class="message-item {{ ($message->user_messages->s_id==$myInfo->id) ? 'me' : 'friend' }}">
                          <img src="{{ ($message->user_messages->s_id==$myInfo->id) ? $myInfo->profile : $friendInfo->profile }}" class="img-xs rounded-circle" alt="avatar">
                          <div class="content">
                            <div class="message">
                              <div class="bubble">
                                <p>{{ $message->message }}</p>
                              </div>
                              <span>{{ $message->created_at }}</span>
                            </div>
                          </div>
                        </li>
                      @endforeach
                      
                      
                    </ul>
                  </div>
                  <div class="chat-footer d-flex">
                    <div>
                      <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Emoji">
                        <i data-feather="smile" class="text-muted"></i>
                      </button>
                    </div>
                    <div class="d-none d-md-block">
                      <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Attatch files">
                        <i data-feather="paperclip" class="text-muted"></i>
                      </button>
                    </div>
                    <div class="d-none d-md-block">
                      <button type="button" class="btn border btn-icon rounded-circle me-2" data-bs-toggle="tooltip" title="Record you voice">
                        <i data-feather="mic" class="text-muted"></i>
                      </button>
                    </div>
                    <form class="search-form flex-grow-1 me-2">
                      <div class="input-group">
                        <input type="text" class="form-control rounded-pill" id="chatForm" placeholder="Type a message" maxlength="200">
                      </div>
                    </form>
                    <div>
                      <button type="button" class="btn btn-primary btn-icon rounded-circle send_message">
                        <i data-feather="send"></i>
                      </button>
                    </div>
                  </div>
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
    const chatMessages = document.querySelector('.chat-body'); 
    // Scroll down
    chatMessages.scrollTop = chatMessages.scrollHeight;
    let $chatInput = $(".input-group");
    let $messageWrapper = $('.messages');
    let userID = $('#login_id').val();
    let ip_address = aurl.split("/")[2].toString().split(":")[0]
    let socket_port = '8005';
    let socket = io(ip_address + ':' + socket_port);
    socket.on('connect', function() {
      socket.emit('user_connected',userID);
    });
    let friendId = "{{ $friendInfo->id }}";
    let name = '{{ $myInfo->name }}';
    
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

    $chatInput.keypress(function (e) {
      let message = $('#chatForm').val();
      if (e.which === 13 && !e.shiftKey && message.trim()!='') { 
        $('#chatForm').val('');
        sendMessage(message);
        return false;
      }
    });

    $('.send_message').on('click',function(event){
      event.preventDefault();
      let message = $('#chatForm').val();
      $('#chatForm').val('');
      sendMessage(message);
      return false;
    })
    
    function sendMessage(message) {
      let url = "{{ route('message.send-message') }}";
      let form = $(this);
      let formData = new FormData();
      let token = "{{ csrf_token() }}";
      
      formData.append('message', message);
      formData.append('_token', token);
      formData.append('receiver_id', friendId);
      formData.append('socket_id', socket.id);
      $messageClass = $('.user-message-'+friendId);
      $messageClass.html(message);
      $('.user-message_time-'+friendId).html(formatAMPM(new Date));
      appendMessageToSender(message);
      $.ajax({
          url: url,
          type: 'POST',
          data: formData,
          processData: false,
          contentType: false,
          dataType: 'JSON',
          success: function (response) {
            if (response.success) {
              
            }
          }
      });
      usersGet();
    }

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

    function appendMessageToSender(message) {
      let url_ = '{{ $myInfo->profile }}';
      let userInfo = '<li class="message-item me">\n' +
                  '<img src="'+url_+'" class="img-xs rounded-circle" alt="avatar">\n' +
                  '<div class="content">\n' +
                    '<div class="message">\n' +
                      '<div class="bubble"><p>'+message+'</p></div>\n' +
                      '<span>'+formatAMPM(new Date)+'</span>\n' +
                    '</div>\n' +
                  '</div>\n' +
                '</li>';
      $messageWrapper.append(userInfo);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    socket.on("private-channel:App\\Events\\PrivateMessageEvent", function (message){
      if(friendId==message.sender_id){
        appendMessageToReceiver(message);
        $messageClass = $('.user-message-'+message.sender_id);
        $messageClass.html(message.content);
        $('.user-message_time-'+message.sender_id).html(formatAMPM(new Date));
      }else if(userID==message.sender_id){
        appendMessageToSender(message.content);
      }else{
        $messageClass = $('.user-message-'+message.sender_id);
        $messageClass.html(message.content);
        $('.user-message_time-'+message.sender_id).html(formatAMPM(new Date));
        var x= $('.user-counter-'+message.sender_id).html()!=''?parseInt($('.user-counter-'+message.sender_id).html()):0;
        console.log(x+1)
        $('.user-counter-'+message.sender_id).html(x+1)
      }
      usersGet();
    });
    function appendMessageToReceiver(message) {
      let url_ = '{{ $friendInfo->profile }}';
      let userInfo = '<li class="message-item friend">\n' +
                  '<img src="'+url_+'" class="img-xs rounded-circle" alt="avatar">\n' +
                  '<div class="content">\n' +
                    '<div class="message">\n' +
                      '<div class="bubble"><p>'+message.content+'</p></div>\n' +
                      '<span>'+formatAMPM(new Date)+'</span>\n' +
                    '</div>\n' +
                  '</div>\n' +
                '</li>';
      $messageWrapper.append(userInfo);
      chatMessages.scrollTop = chatMessages.scrollHeight;
    }
  });
  
</script>
@endpush