@extends('layouts.app')
@section('content')
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
                    <a rel="alternate" hreflang="{{ $localeCode }}"
                       href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $properties['native'] }}
                    </a>

                @endforeach
            </div>
        @endif
    </div>
    <div class="content ">
        <div class="alert alert-danger" id='mesg' style="display: none;">

        </div>
        <br>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">{{__('message.id')}}</th>
                <th scope="col">{{__('message.offer name')}}</th>
                <th scope="col">{{__('message.Offer Price')}}</th>
                <th scope="col">{{__('message.photos')}}</th>
                <th scope="col">{{__('message.Opration')}}</th>


            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr class="RowClass{{$offer->id}}">
                    <td>{{$offer->id}}</td>
                    <td>{{$offer->name}}</td>
                    <td>{{$offer->price}}</td>
                    <td><img style="height:70px;width:70px;margin: 6px;" src="{{asset('imegs/offers/'.$offer->photo)}}"
                             alt="photo"></td>
                    <td><a class="btn btn-success  text-white"
                           href="{{url('ajaxoffer/edit/'.$offer->id )}}">{{__('message.Edit')}}</a>
                        <a offer_id="{{$offer->id}}"
                           class="btn btn-secondary  delete_btn text-white">{{__('message.Delete')}}2</a>

                    </td>


                </tr>
            @endforeach

            </tbody>
        </table>

    </div>
@section('scripts')
    <script>
        $(document).on("click", ".delete_btn", function (e) {
            e.preventDefault()
            var offer_id = $(this).attr('offer_id')
            $.ajax({
                type: 'POST',
                url: '{{route('deletajax')}}',
                data: {
                    '_token': "{{csrf_token()}}",
                    'id': offer_id,
                },
                success: function (data) {
                    if(data.status==true) {
                        $('#mesg').show();

                    }
                    $('.RowClass'+data.id).remove();


                },
                error: function (reject) {

                }
            });
        });
    </script>
@stop

@endsection




