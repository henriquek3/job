<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Notificação</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div class="container">
    <h1>Teste</h1>
    <p>{{ $user->unreadNotifications->count() }}</p>
</div>
<ul>
    @foreach($user->notifications as $nt)
        <li>
            @if ($nt->read_at == null)
                <a href="/read/{{ $nt->id }}">{{ $nt->data['message'] }}</a>
            @else
                {{ $nt->data['message'] }}
            @endif
        </li>
    @endforeach
</ul>

<div id="app">
    <example-component user="{{$user->id}}"></example-component>
</div>

<script src="{{asset('js/app.js')}}"></script>
</body>
</html>
