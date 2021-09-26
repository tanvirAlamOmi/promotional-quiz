  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <link href="{{asset('img/main-logo.webp')}}" rel="icon">
      {{-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> --}}
      <title>Delicious Quiz</title>
      <!-- google font-->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      {{-- <link href="https://fonts.googleapis.com/css2?family=Pattaya&family=Poppins:wght@300;500;600;700&display=swap" rel="stylesheet"> --}}
      
      <!-- Font awesome css file -->
      <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
      <!-- <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}"> -->
      
      
      <!-- Boostrap css-->      
      <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
      <!-- Main css -->
      <link rel="stylesheet" href="{{asset('css/style.css')}}">
      
      <style>
     
       </style>
  </head>
  
  <body onload="myFunction()">
  
        <!--pre loader start-->
      <div id="loader" class="pre-loader">
        <img src="{{asset('img/preloader.gif')}}">
      </div>
      <!-- pre loader end-->
      <!-- home page start-->
      
      @include('Website.home')
    <div class="main-card">
      <!-- home page end-->
        <!-- change Quiz section start -->
        @include('Website.header')
        
        <!-- Quiz section end -->
        <!-- quiz body start -->
        @include('Website.quiz-section')
      
        <!-- quiz body end -->

        <!-- change quiz gift update page start-->
        @include('Website.gift')
      
        <!-- quiz gift update page end-->
        <!--quiz result page start-->
      
        @include('Website.quiz-form')
        <!--quiz result page end-->
        <!-- Thank you page start -->
        @include('Website.thanks')


        <!-- Thank you page end -->
        
        @include('Website.footer')
      <!--change footer start-->
    </div>
    
    
    <!-- footer end-->
    <!-- preloader js start-->
    <script>
    var myVar;

    function myFunction() {
      myVar = setTimeout(showPage, 2000);
    }

    function showPage() {
      document.getElementById("loader").style.display = "none";

    }
    </script>
    <!-- preloader js end-->
    <!-- Boostrap cdn -->
    <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
    
    <!-- fontawesome js start-->
    <script src="{{asset('js/fontawesome.min.js')}}"></script>

    {{-- lazy load --}}
    <script src="{{asset('js/lazysizes.min.js')}}" async></script>
    
    <!-- fontawesome js end-->
    <script src="{{asset('js\jquery-3.6.0.min.js')}}"></script>
    
    <script>
      
    $(document).ready(function() {

      let boxNum = 0;
      let progressWidth = 0;
      let checkboxNames = ['friends', 'vacation', 'night', 'Sandwich', 'juice', 'craving'];
      let totalPoint = '';
      let prize;
      let progressBarPortion = 16.66; //6 question so (100/6) = 16.66

      (function () {
        $(".box").hide();
        $("#result_button").hide();
        $('.quiz-form').hide();
        $('.quiz-gift').hide();
        $('.thank-you').hide();
        $('.main-card').hide();
        $('.quiz-body').hide();
        // $('.thank-you').hide();
      }());

      function contentBoxShow(boxNum){
        $(`.box:eq(${boxNum})`).show();
      }

      function progressBarProgress(progressWidth){
        $('.progress-bar').css('width', `${progressWidth}%`)
      }

      function logic(result){
        switch(result) {
          case '1a2a3a4d5a-n':
            return {
              "name" : "Pesto Chicken",
              "coupon_code" : "PPDE1FREE",
              "img_source" : "pesto_chicken_sandwich.webp"
            };

          case '1c2c3d4c5c-n':
            return {
              "name" : "Tikka Flavoured Sandwich",
              "coupon_code" : "CT14FREE",
              "img_source" : "Tikka_sandwich.webp"
            };
            
          case '1b2b3c4a5d-n':
            return {
              "name" : "Spicy Meatball",
              "coupon_code" : "SM98FREE",
              "img_source" : "Spicy_Meatball_sandwich.webp"
            };
            
          case '1d2d3b4b5b-v':
            return {
              "name" : "Veggie Melt",
              "coupon_code" : "Pesto Chicken",
              "img_source" : "Veggie_Melt_sandwich.webp"
            };
            
          default:
            switch(vegOrNonveg(result)) {
              case 'n':
                return {
              "name" : "Tikka Flavoured Sandwich",
              "coupon_code" : "Pesto Chicken",
              "img_source" : "Tikka_sandwich.webp"
            };
                
              case 'v':
                return  {
              "name" : "Southern Roasted Veggie",
              "coupon_code" : "SRVD5FREE",
              "img_source" : "Southern_Roasted_Veggie_sandwich.webp"
            };
            }
        }
      }

      function vegOrNonveg(result){
        let k = result.split('-');
        return k[1];
      }

      $('.quiz-card').click( function () {
        $(this).find("input:checkbox").prop('checked', true);
        let vr = this;
        boxNum++;
        if(boxNum < 6){
          $(".box").hide();
        }
        else if(boxNum == 6){
          $("#result_button").show();
          $('.form-check-input').attr("disabled", true);
          $(vr).addClass('exchange-card-color')
        }
        else{ 
          return;
        }
        onImageclick(vr);
      })

     function onImageclick(vr) {
        totalPoint += $(`input:checkbox[name=${checkboxNames[boxNum-1]}]:checked`).val();
        progressWidth = progressWidth + progressBarPortion;
        progressBarProgress(progressWidth)
        contentBoxShow(boxNum)
      }

      $('#result_button').click( () => {
        $(".box").hide();
        $('.quiz-body').hide();
        $("#result_button").hide();
        $('.quiz-gift').show();
        $('.progress').hide();
        prize = logic(totalPoint);
        $('#gift_name').html(prize.name);
        $('#gift_img').attr("src", `{{asset('img/prize/${prize.img_source}')}}`);
      })

      $('#go_to_quiz').click( () => {
        $('.home-page').hide();
        $('.main-card').show();
        $('.quiz-form').show();
        $('.progress').hide();
      })

      $('#customerForm').submit( (event) => {
        event.preventDefault();
        $('#quiz_start').addClass('spinner-border spinner-border-sm');
        $.ajax({
          type: "POST",
          url: '/check_validation',
          data:{
          "_token": "{{ csrf_token() }}",
          "customerName": $('#customerName').val(),
          "customerEmail": $('#customerEmail').val(),
          "customerPhone": $('#customerPhone').val(),
          // "prizeWon": prize.name,
          // "coupon_code": prize.coupon_code
          }, 
          success: function(output) {
            if (output.result == "success") {
              $('.quiz-form').hide();
              $('.quiz-body').show();
              $('.progress').show();
              contentBoxShow(boxNum);
              progressBarProgress(progressWidth);
              $('#quiz_start').removeClass('spinner-border spinner-border-sm');
            }
            else if(output.result == "failed"){
              $('#message').html(`<li> ${output.message} </li>`).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger');
              $('#quiz_start').removeClass('spinner-border spinner-border-sm');
            }
          },
          error:function (response){
            let list = '';
              $.each(response.responseJSON.errors,function(field_name,error){
                list +=`<li> ${error} </li>`;
              })
              $('#message').html(list).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger')
              $('#quiz_start').removeClass('spinner-border spinner-border-sm');
            }
        });
      })

      $('#coupon_button').click( (event) => {
        event.preventDefault();
        $('#coupon_button_loading').addClass('spinner-border spinner-border-sm');
        $.ajax({
          type: "POST",
          url: '/submit_form_deli',
          data:{
          "_token": "{{ csrf_token() }}",
          "customerName": $('#customerName').val(),
          "customerEmail": $('#customerEmail').val(),
          "customerPhone": $('#customerPhone').val(),
          "prizeWon": prize.name,
          "coupon_code": prize.coupon_code
          }, 
          success: function(output) {
            if (output.result == "success") {
              $('.quiz-gift').hide();
              $('.thank-you').show();
              totalPoint = 0;
              $('#coupon_button_loading').removeClass('spinner-border spinner-border-sm');

            }
            else if(output.result == "failed"){
              $('#message').html(`<li> ${output.message} </li>`).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger')
              $('#coupon_button_loading').removeClass('spinner-border spinner-border-sm');
            }
          },
          error:function (response){
            let list = '';
              $.each(response.responseJSON.errors,function(field_name,error){
                list +=`<li> ${error} </li>`;
              })
              $('#message').html(list).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger');
              $('#coupon_button_loading').removeClass('spinner-border spinner-border-sm');
          }
        });
      })

      window.history.pushState('', null, './');
        $(window).on('popstate', function() {
        location.reload(true);
      });
    })
    </script>
  </body>
</html>