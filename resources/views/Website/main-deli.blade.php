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
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css">
      {{-- <link rel="stylesheet" href="{{asset('css/fontawesome.css')}}"> --}}
      
      
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
        @include('Website.quiz-section-deli')
      
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
      let point;
      let prize;
      let progressBarPortion = 16.66; //6 question so (100/6) = 16.66
      let progressDone = 0;
      const counts = {};
      let winResult = "";
      let prevClcickId = '';
      let total_qus = $('.qus-headline').length;
      products = ['veggie_melt', 'pesto_chicken', 'chicken_tikka', 'spicy_meatball'];

      (function () {
        $(".box").hide();
        $("#result_button").hide();
        $('.quiz-form').hide();
        $('.quiz-gift').hide();
        $('.thank-you').hide();
        $('.main-card').hide();
        $('.quiz-body').hide();
        $('.alert').hide();
      }());

      function contentBoxShow(boxNum){
        $(`.box:eq(${boxNum})`).show();
      }

      function progressBarProgress(progressWidth){
        $('.progress-bar').css('width', `${progressWidth}%`)
      }

      function logic(point){
        if(point){
          let questionNum = [...point][0];
          let optionNum = [...point][1];
          let winNum = [...point][2];
          let found = [...totalPoint].find( x =>  x == questionNum);

          if(found){
            let index = totalPoint.indexOf(found);
            let newPoint = [...totalPoint];
            newPoint[index] = questionNum;
            newPoint[index + 1] = optionNum;
            newPoint[index + 2] = winNum;
            totalPoint = newPoint.join("");
            progressDone++;
            if(progressDone > 0){
              progressDone = 0;
            }
          }else{
            totalPoint += point;
          }
        }
      }

      function awardCalculation() {
        let filtereds = [...totalPoint]
        .filter(function(el, index) {
          return el !== el.toLowerCase()
        }).forEach(function (x) { counts[x] = (counts[x] || 0) + 1; });
        let sortable = Object.fromEntries(
            Object.entries(counts).sort(([,a],[,b]) => a-b)
        );

        if( [...totalPoint][[...totalPoint].length - 1]  == 'v' ){
          
                return products[0];
        }
        else{
          if( !sortable[Object.keys(sortable)[Object.keys(sortable).length - 2]] || sortable[Object.keys(sortable)[Object.keys(sortable).length - 1]] > sortable[Object.keys(sortable)[Object.keys(sortable).length - 2]] ) { 
            switch(Object.keys(sortable)[Object.keys(sortable).length - 1]) {
              case 'P':
                return products[1];

              case 'T':
                return products[2];
                
              case 'S':
                return products[3];
                
              case 'V':
                return products[2];
              }
          }else{
                return products[2];
          }

        }

      }

      $('.quiz-card').click( function () {
        $(this).parent().parent().find("input:checkbox").prop('checked', false);
        $(this).find("input:checkbox").prop('checked', true); 
        if($(this).find("input:checkbox").prop('checked', true)[0].id != prevClcickId){ 
          prevClcickId = $(this).find("input:checkbox").prop('checked', true)[0].id;
         $(this).parent().parent().find('.quiz-card').css('background', "#ce452b");
          boxNum++;
          if(boxNum > total_qus){
            boxNum = total_qus;
          }

          if(boxNum <= total_qus){
            $(this).css('background', "#038183");
          }
          setTimeout(() => {
            whichBoxToShow(boxNum);
            onImageclick();
            checkBackNextButtonAvailability();
            showResultButton()
            prevClcickId = ""; 
          }, 300);
        }
      })

      function checkBackNextButtonAvailability() {
        if(boxNum < 1){
          $('#prev_button').prop('disabled', true);
        }else{
          $('#prev_button').prop('disabled', false);
        }

        if(boxNum > (total_qus - 2) || progressDone == 0){
          $('#next_button').prop('disabled', true);
        }else{
          $('#next_button').prop('disabled', false);
        }
      }

      function showResultButton() {
        if(boxNum == total_qus){
          $("#result_button").show();
        }else{
          $("#result_button").hide();
        }
      }

      function whichBoxToShow(boxNum) {
        if(boxNum < total_qus){
          $(".box").hide();
        }
        // else if(boxNum == total_qus){
        //   $('.form-check-input').attr("disabled", true);
        // }
        else{ 
          return;
        }
      }

      $('#prev_button').click( function () {
        if(boxNum < 1){
          return;
        }
        if(boxNum == total_qus){
          boxNum = total_qus - 1;
        }
        boxNum--;
        progressDone--;
        
        if(boxNum == total_qus - 1){
          $("#result_button").show();
        }else{
          $("#result_button").hide();
        }
        whichBoxToShow(boxNum);
        contentBoxShow(boxNum)
        checkBackNextButtonAvailability();
      })

      $('#next_button').click( function () {
        if(boxNum > (total_qus - 2)){
          return;
        } 
        
        boxNum++;
        progressDone++;
        if(progressDone > 0){
          progressDone = 0;
        }
        
        if(boxNum == total_qus - 1){
          $("#result_button").show();
        }else{
          $("#result_button").hide();
        }

        whichBoxToShow(boxNum);
        contentBoxShow(boxNum)
        checkBackNextButtonAvailability();
      })

      function onImageclick() {
        point = $(`input:checkbox[name=${checkboxNames[boxNum-1]}]:checked`).val();
        logic(point);
        progressWidth = progressWidth + progressBarPortion;
        progressBarProgress(progressWidth)
        contentBoxShow(boxNum);
      }

      $('#result_button').click( () => {
        $(".box").hide();
        $('.quiz-body').hide();
        $("#result_button").hide();
        $('.quiz-gift').show();
        $('.progress').hide();
        let prizeTag = awardCalculation();
        $.get(`/reward_pack/${prizeTag}`, function(data, status){
          prize = data;
          $('#gift_name').html(`the ${prize.name}`);
          $('#gift_details').html(prize.details);
          $('#gift_img').attr("src", `{{asset('img/prize/${prize.img_source}')}}`);
        });
      })

      $('#go_to_quiz').click( () => {
        $('.home-page').hide();
        $('.main-card').show();
        $('.quiz-form').show();
        $('.progress').hide();
      })

      $('#customerForm').submit( (event) => {
        event.preventDefault();
        $('#customer_submit').prop('disabled', true);
        $('#quiz_start').addClass('spinner-border spinner-border-sm');
        $('.alert').hide();
        
        $.ajax({
          type: "POST",
          url: '/check_validation',
          data:{
          "_token": "{{ csrf_token() }}",
          "customerName": $('#customerName').val(),
          "customerEmail": $('#customerEmail').val(),
          "customerPhone": $('#customerPhone').val(),
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
              $('.alert').show();
              $('#message').html(`<li> ${output.message} </li>`).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger');
              $('#quiz_start').removeClass('spinner-border spinner-border-sm');
            }
            
            $('#customer_submit').prop('disabled', false);
          },
          error:function (response){
            let list = '';
              $.each(response.responseJSON.errors,function(field_name,error){
                list +=`<li> ${error} </li>`;
              })
              $('.alert').show();
              $('#message').html(list).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger')
              $('#quiz_start').removeClass('spinner-border spinner-border-sm');
              
              $('#customer_submit').prop('disabled', false);
            }
        });
      })

      $('#coupon_button').click( (event) => {
        event.preventDefault();
        
        $('#coupon_button').prop('disabled', true);
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
            
            $('#coupon_button').prop('disabled', false);
          },
          error:function (response){
            let list = '';
              $.each(response.responseJSON.errors,function(field_name,error){
                list +=`<li> ${error} </li>`;
              })
              $('#message').html(list).removeClass('alert-success').removeClass('alert-danger').addClass('alert-danger');
              $('#coupon_button_loading').removeClass('spinner-border spinner-border-sm');
              
              $('#coupon_button').prop('disabled', false);
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