@extends('layouts.app')
@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none;">
            تم  التحديث بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{__('message.Edit Offer')}}

                </div>
                '
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif

                <br>
                <form method="POST"  id="offerFormUpdate" action="" enctype="multipart/form-data">
                    @csrf
                    {{-- <input name="_token" value="{{csrf_token()}}"> --}}


                    <div class="form-group">
                        <label for="exampleInputEmail1">{{__('message.offer name')}}</label>
                        <input type="text" class="form-control" value="{{$offer -> name}}" name="name"
                               placeholder="{{__('message.offer name')}}">
                    </div>


                    <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="id">

                    <div class="form-group">
                        <label for="exampleInputPassword1">{{__('message.offer price')}}</label>
                        <input type="text" class="form-control" value="{{$offer -> price}}" name="price"
                               placeholder="{{__('message.offer price')}}">
                    </div>


                    <button id="update_offer" class="btn btn-primary">{{__('message.Edit Offer')}}</button>
                </form>


            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                }, error: function (reject) {
                }
            });
        });
    </script>
@stop

