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
      let point;
      let prize;
      let progressBarPortion = 16.66; //6 question so (100/6) = 16.66
      let progressDone = 0;
      const counts = {};
      let winResult = "";
      let prevClcickId = '';

      (function () {
        $(".box").hide();
        $("#result_button").hide();
        $('.quiz-form').hide();
        $('.quiz-gift').hide();
        $('.thank-you').hide();
        $('.main-card').hide();
        $('.quiz-body').hide();
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
        if( !sortable[Object.keys(sortable)[Object.keys(sortable).length - 2]] || sortable[Object.keys(sortable)[Object.keys(sortable).length - 1]] > sortable[Object.keys(sortable)[Object.keys(sortable).length - 2]] ) { 
          
          switch(Object.keys(sortable)[Object.keys(sortable).length - 1]) {
          case 'P':
            return {
              "name" : "Pesto Chicken Sandwich",
              "coupon_code" : "PPDE1FREE",
              "img_source" : "pesto_chicken_sandwich.webp",
              "details": "It’s-a Pesto Chicken Sandwich for you. You like the finer things in life, just like our delicious pesto sauce made with the freshest and finest ingredients. A quick getaway for you is not a vacation. You like long 3, 4, or 5 week vacations 🤷‍♂️ The Pesto Chicken sandwich is just the vacation that your taste buds need."
            };

          case 'T':
            return {
              "name" : "Tikka Sandwich",
              "coupon_code" : "CT14FREE",
              "img_source" : "Tikka_sandwich.webp",
              "details": "Your soul sandwich is the Chicken Tikka Baguette! You’re down to earth and always up for an adventure. You are also loved by everyone around you just like our Chicken Tikka that’s found its way to the top of the best selling sandwich at delicious 💯This Chicken Tikka sandwich is just the adventure that your taste buds need."
            };
            
          case 'S':
            return {
              "name" : "Spicy Meatball Sandwich",
              "coupon_code" : "SM98FREE",
              "img_source" : "Spicy_Meatball_sandwich.webp",
              "details": "Your soul sandwich is the Spicy Meatball! To you food is comfort and there's no better comfort food than our Spicy Meatball sandwich. Made with fresh home made meatballs, this sandwich will keep you happy & satisfied the whole day 🌞 Crafted with Aarabiatta Sauce to add a little spice twist to a wholesome sandwich."
            };
            
          case 'V':
            return {
              "name" : "Veggie Melt Sandwich",
              "coupon_code" : "VM77FREE",
              "img_source" : "Veggie_Melt_sandwich.webp",
              "details": "Pure, healthy, and fresh, your soul sandwich is the Veggie Melt sandwich! Made with the freshest ingredients, this sandwich is our best selling vegetarian sandwich. Do you like doing things differently, so do we! We added a little bit of cheese to this classic vegetarian sandwich to give it an exciting twist 👌"
            };
        }
        }else{
          if( [...totalPoint][[...totalPoint].length - 1]  == 'n' ){
            return {
              "name" : "Tikka Sandwich",
              "coupon_code" : "Pesto Chicken",
              "img_source" : "Tikka_sandwich.webp",
              "details": "Your soul sandwich is the Chicken Tikka Baguette! You’re down to earth and always up for an adventure. You are also loved by everyone around you just like our Chicken Tikka that’s found its way to the top of the best selling sandwich at delicious 💯This Chicken Tikka sandwich is just the adventure that your taste buds need."
            };
          }
          else{
            return {
              "name" : "Veggie Melt Sandwich",
              "coupon_code" : "VM77FREE",
              "img_source" : "Veggie_Melt_sandwich.webp",
              "details": "Pure, healthy, and fresh, your soul sandwich is the Veggie Melt sandwich! Made with the freshest ingredients, this sandwich is our best selling vegetarian sandwich. Do you like doing things differently, so do we! We added a little bit of cheese to this classic vegetarian sandwich to give it an exciting twist 👌"
            };
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
          if(boxNum > 6){
            boxNum = 6;
          }

          if(boxNum <= 6){
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

        if(boxNum > 4 || progressDone == 0){
          $('#next_button').prop('disabled', true);
        }else{
          $('#next_button').prop('disabled', false);
        }
      }

      function showResultButton() {
        if(boxNum == 6){
          $("#result_button").show();
        }else{
          $("#result_button").hide();
        }
      }

      function whichBoxToShow(boxNum) {
        if(boxNum < 6){
          $(".box").hide();
        }
        // else if(boxNum == 6){
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
        if(boxNum == 6){
          boxNum = 5;
        }
        boxNum--;
        progressDone--;
        
        if(boxNum == 5){
          $("#result_button").show();
        }else{
          $("#result_button").hide();
        }
        whichBoxToShow(boxNum);
        contentBoxShow(boxNum)
        checkBackNextButtonAvailability();
      })

      $('#next_button').click( function () {
        if(boxNum > 4){
          return;
        } 
        
        boxNum++;
        progressDone++;
        if(progressDone > 0){
          progressDone = 0;
        }
        
        if(boxNum == 5){
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
        prize = awardCalculation();
        $('#gift_name').html(`the ${prize.name}`);
        $('#gift_details').html(prize.details);
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