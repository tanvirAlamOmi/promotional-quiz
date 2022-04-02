
@extends('Admin.includes.layout')
@section('pageTitle', 'General settings')
@push('styles')
<style>
   
</style>
@endpush

@section('content')
    <div class="container">
        <form id="couponCodesForm">
            @csrf
            <div class="pl-5 pr-5 mr-5 ml-5">
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">{{$data[0]->name}}</span>
                    </div>
                    <input type="text" class="form-control" id="productOne" aria-describedby="basic-addon3" value="{{$data[0]->coupon}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">{{$data[1]->name}}</span>
                    </div>
                    <input type="text" class="form-control" id="productTwo" aria-describedby="basic-addon3" value="{{$data[1]->coupon}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">{{$data[2]->name}}</span>
                    </div>
                    <input type="text" class="form-control" id="productThree" aria-describedby="basic-addon3" value="{{$data[2]->coupon}}">
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend w-50">
                      <span class="input-group-text w-100">{{$data[3]->name}}</span>
                    </div>
                    <input type="text" class="form-control" id="productFour" aria-describedby="basic-addon3" value="{{$data[3]->coupon}}">
                </div>
                <input type="submit" value="submit" id="submit_coupon_button" class="btn btn-primary btn-block">
            </div>
        </form>
    </div>
@endsection

@push('scripts')

    <script>

        $('#couponCodesForm').submit( (event) => {
            event.preventDefault();
            $('#submit_coupon_button').prop('disabled', true);
            $.ajax({
                type: "POST",
                url: '/update_coupons',
                data:{
                "_token": "{{ csrf_token() }}",
                "productOne": $('#productOne').val(),
                "productTwo": $('#productTwo').val(),
                "productThree": $('#productThree').val(),
                "productFour": $('#productFour').val(),
                }, 
                success: function(output) {
                if (output.result == "success") {
                    Toast.fire({
                        icon: 'success',
                        title: 'Updated successfully'
                    })
                }
                else if(output.result == "failed"){
                    Toast.fire({
                        icon: 'error',
                        title: 'Update failed'
                    })
                }
                
                $('#submit_coupon_button').prop('disabled', false);
                },
                error:function (response){
                    Toast.fire({
                        icon: 'error',
                        title: 'Update failed'
                    })
                    
                $('#submit_coupon_button').prop('disabled', false);
                }
            });
        })
    </script>
@endpush