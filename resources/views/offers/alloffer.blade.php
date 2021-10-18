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
<div class="flex-center position-ref " style="height: 100px;">
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

                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <a  rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                            {{ $properties['native'] }}
                        </a>

                @endforeach
        </div>
    @endif
</div>
    <div class="content ">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{__('message.id')}}</th>
                <th scope="col">{{__('message.offer name')}}</th>
                <th scope="col">{{__('message.Offer Price')}}</th>
                <th scope="col">{{__('message.Opration')}}</th>


            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
            <tr>
                <td>{{$offer->id}}</td>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td><button class="btn btn-success"><a class="text-white" href="{{url('offer/edit/'.$offer->id )}}">{{__('message.Edit')}}</a></button></td>

            </tr>
            @endforeach

            </tbody>
        </table>

    </div>

</body>
</html>
