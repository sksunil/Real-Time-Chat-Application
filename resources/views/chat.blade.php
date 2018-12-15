<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>realTimeChatApplication</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        .list-group {
            overflow-y: scroll;
            height: 200px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row" id="app">

        <div class="offset-4 col-4 offset-sm-1 col-sm-10">
            <li class="list-group-item active">Chat Room</li>
            <div class="badge badge-pill badge-primary">@{{ typing }}</div>

            <ul class="list-group" v-chat-scroll>
                <message v-for="value,index in chat.message"
                         :key=value.index
                         color="success"
                         :user=chat.user[index]
                         :color="chat.color[index]"
                >

                    @{{ value }}

                </message>

            </ul>

            <input type="text" v-model="message" @keyup.enter='send'
                   class="form-control" placeholder="Write your message...">

        </div>
    </div>
</div>

<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>