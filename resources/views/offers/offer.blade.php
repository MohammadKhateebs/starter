<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/landing') }}">{{__('message.Home')}}</a>
            @else
                <a href="{{ route('login') }}">{{__('message.Login')}}</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">{{__('message.Register')}}</a>
                @endif
            @endauth
                <a href="{{ route('showOffer') }}" >{{__('message.Show All Offer')}}</a>

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>

                @endforeach
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md">
            {{__('message.Add Offer')}}
        </div>
        @if(Session::has('succ'))
            <div class="alert alert-success" role="alert">
                {{Session::get('succ')}}
            </div>
        @endif
        <br>
        <form method="POST" action="{{route('store')}}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="offername" class="form-label">{{__('message.offer name')}}</label>
                <input type="text" class="form-control" name="name">
                @error('name')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">{{__('message.Add Photo')}}</label>
                <input type="file" class="form-control" name="photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="offerprice" class="form-label">{{__('message.Offer Price')}}</label>
                <input type="text" class="form-control" name="price">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">{{__('message.Add Offer')}}</button>

        </form>

    </div>
</div>
</body>
</html>
