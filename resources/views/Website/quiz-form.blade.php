<section class="quiz-form">
    <div class="container">
        <div class="row">
            <div class="col-12">
              
                <form id="customerForm">
                  <div class="alert">
                      <ul id="message" style="margin: 0px;">
                      </ul>
                  </div>
                  @csrf
                    <div class="mb-3">
                      <label for="customerName" class="form-label">Name</label>
                      <input type="text" placeholder="Please enter your name" class="form-control" id="customerName" name="customerName" aria-describedby="emailHelp">
                    </div>
                  <div class="mb-3">
                    <label for="customerEmail" class="form-label">Email</label>
                    <input type="email" placeholder="Please enter your email" class="form-control" id="customerEmail" name="customerEmail" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="customerPhone" class="form-label">Phone</label>
                    <input type="number" placeholder="Please enter your mobile" class="form-control" id="customerPhone" name="customerPhone" aria-describedby="emailHelp">
                  </div>
                  {{-- <button type="submit" class="btn btn-primary">start quiz</button> --}}

                  <button class="btn btn-primary" type="submit">
                    <span class="" role="status" aria-hidden="true" id="quiz_start"></span>
                    start quiz
                  </button>
                </form>
            </div>
              <div class="col-12">
                <div class="term">
                  <h1>Terms & Conditions:</h1>
                  <ul>
                    <li>Coupon codes & Prizes are subject to change without any notice</li>
                    <li>Coupon code only valid when ordering via our Website, Facebook, Instagram & WhatsApp.</li>
                    <li>Coupon code can only be used once and is only valid for 2 weeks.</li>
                    <li>Minimum basket order value & Delivery charges are still valid with the coupon code</li>
                    <li>Not applicable on purchases of detox plans</li>
                    <li>You can win a coupon code for your sandwich only once a month.</li>
                    <li>By entering your details, you agree to receive SMS & Email communication by the Delicious team - we send communication on discounts & offers max; twice a month.</li>
                  </ul>
                </div>
              </div>
        </div>
    </div>
  </section>