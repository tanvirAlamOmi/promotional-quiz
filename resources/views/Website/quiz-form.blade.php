<section class="quiz-form">
    <div class="container">
        <div class="row">
            <div class="col-12">
              <h1>Win a free sandwich - everyone is a winner!</h1>
                <form id="customerForm">
                  <div class="alert">
                      <ul id="message" style="margin: 0px;">
                      </ul>
                  </div>
                  @csrf
                    <div class="mb-3">
                      <label for="customerName" class="form-label">Name</label>
                      <input type="text" placeholder="Ahmad Tariq" class="form-control" id="customerName" name="customerName" aria-describedby="emailHelp">
                    </div>
                  <div class="mb-3">
                    <label for="customerEmail" class="form-label">Email</label>
                    <input type="email" placeholder="ahmad@gmail.com" class="form-control" id="customerEmail" name="customerEmail" aria-describedby="emailHelp">
                  </div>
                  <div class="mb-3">
                    <label for="customerPhone" class="form-label">Phone</label>
                    <input type="number" placeholder="0551234567" class="form-control" id="customerPhone" name="customerPhone" aria-describedby="emailHelp">
                  </div>
                  <button type="submit" class="btn btn-primary">
                    <span class="" role="status" aria-hidden="true" id="quiz_start" ></span>
                    start quiz</button>
                </form>
            </div>
              <div class="col-12">
                <div class="term">
                  <h1>Terms & Conditions:</h1>
                  <ul>
                    <!-- <li>Coupon codes & Prizes are subject to change without any notice.</li> -->
                    <li>Please enter the email that you check regularly as the coupon code will be sent to your email. Please enter the phone number that you use to place the order as the coupon code will be linked to your phone number.</li>
                    <li>Coupon code only valid when ordering via our Website, Facebook, Instagram & WhatsApp.</li>
                    <li>Coupon code expires after 14 days of being issued. You can enter this competition once every month.</li>
                    <li>Minimum basket order value & Delivery charges are still valid with the coupon code.</li>
                    <li>Not applicable on purchases of detox plans.</li>
                    <!-- <li>You can win a coupon code for your sandwich only once a month.</li> -->
                    <li>By entering your details, you agree to receive SMS & Email communication by the Delicious team - we send communication on discounts & offers; twice a month.</li>
                    <li>Management reserves the right to pause or end the campaign, as needed.</li>
                  </ul>
                </div>
              </div>
        </div>
    </div>
  </section>