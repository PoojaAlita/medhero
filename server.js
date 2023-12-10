var app = require('express')();
var http = require('http').Server(app);
const io = require('socket.io')(http, {
  cors: {
      origin: "*",
      methods: ["GET", "POST"]
  }
});
var Redis = require('ioredis');
var redis = new Redis();
var current_socket_id;
const users = {};
const user_ids = {};

http.listen(8005, function () {
    console.log('Listening to port 8005');
});

redis.subscribe('private-channel', function() {
    console.log('subscribed to private channel');
});

redis.on('message', function(channel, message) {
    message = JSON.parse(message);
    if (channel == 'private-channel') {
        let data = message.data.data;
        let receiver_socket_id= users[data.receiver_id];
        let sender_socket_id = users[data.sender_id];
        let all_ids=[];
        if(receiver_socket_id){
            all_ids = sender_socket_id.concat(receiver_socket_id);
        }
        all_ids.forEach((socket_id)=>{
            if(data.socket_id!=socket_id){
                io.to(socket_id).emit(channel + ':' + message.event, data);
            }
        })
    }
});

io.on('connection', function (socket) {
    socket.on("user_connected", function (user_id) {
        if(users[user_id]){
            users[user_id].push(socket.id);
        }else{
            users[user_id] = [socket.id];
        }
        user_ids[socket.id] = user_id;
        io.emit('updateUserStatus', users);
    });

    socket.on('disconnect', function() {
        if(socket.id!=null){
            var i = user_ids[socket.id];
            var j = users[i].indexOf(socket.id);
            users[i].splice(j, 1);
            delete user_ids[socket.id];
            io.emit('updateUserStatus', users);
        }
    });
});