@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="flex-center position-ref full-height">
<button><a href="{{route('showOfferAjax')}}">All Offer</a></button>

            <div class="content ">
                <div class="title m-b-md">
                    {{__('message.Add Offer')}}
                </div>
                <div class="alert alert-success " id="mesg" style="display:none;">
                    تم الحفظ بنجاح
                </div>

                <form id="offarform">
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

                    <button id="save_offer" class="btn btn-primary">{{__('message.Add Offer')}}</button>

                </form>

            </div>
        </div>
    </div>



@stop

@section('scripts')
    <script>
        $(document).on("click", "#save_offer", function (e) {
            e.preventDefault()
            var formData = new FormData($('#offarform')[0]);
            $.ajax({
                type: 'POST',
                enctype: "multipart/form-data",
                url: '{{route('storeajax')}}',
                data: formData,
                processData: false,
                contentType: false,
                cach: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#mesg').show();
                    } else if (data.status == false) alert(data.msg);


                },
                error: function (reject) {

                }
            });
        });
    </script>
@stop
