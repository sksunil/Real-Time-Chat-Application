<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>realTimeChatApplication</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css"
          integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/extra.css') }}">
    <style>
        .list-group {
            overflow-y: scroll;
            height: 400px;
        }
    </style>
</head>
<body>

<header>
    <h1 class="logo">
        Real Time Chating
    </h1>
    <input type="text" placeholder="" class="search-container">
    <nav class="header-nav">
        <ul>
            <li>

                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-').submit();">
                    <i class="fa fa-smile" title="logout" style="color: white; width: 40px; margin-top:20px;"></i>
                </a>

                <form id="logout-" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
    </nav>

</header>

<br>

<div class="container">
    <div class="row" id="app">

        <div class="offset-4 col-4 offset-sm-1 col-sm-10">
            <li class="list-group-item">
                <button type="button" class="btn btn-primary">
                    Chating Room
                </button>

                <button type="button" class="btn btn-primary">
                    Online <span class="badge badge-light"> @{{ numberOfUsers }}</span>
                </button>

                <!-- Example single danger button -->
                <div class="btn-group">
                    <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        Action
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#" @click.prevent="deleteSession">Clear chat</a>
                    </div>
                </div>

            </li>
            <div class="badge badge-pill badge-primary">@{{ typing }}</div>

            <ul class="list-group" v-chat-scroll>
                <message v-for="value,index in chat.message"
                         :key=value.index
                         color="success"
                         :user=chat.user[index]
                         :color=chat.color[index]
                         :time=chat.time[index]
                >

                    @{{ value }}

                </message>

            </ul>

            <input type="text" v-model="message" @keyup.enter='send'
                   class="form-control" placeholder="Write your message...">
            <br>

        </div>
    </div>
</div>

<script src="{{ asset('js/app.js')}}"></script>
</body>
</html>
