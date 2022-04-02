<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    
    public function couponCodeUpdate(Request $request)
    {
        $request->validate([
            'productOne' => 'required|max:15|min:3',
            'productTwo' => 'required|max:15|min:3',
            'productThree' => 'required|max:15|min:3',
            'productFour' => 'required|max:15|min:3',
        ]);
        
        try{
            $coupon_update = Product::where('tag', 'veggie_melt')->update(['coupon'=> $request->productOne]);
            $coupon_update = Product::where('tag', 'pesto_chicken')->update(['coupon'=> $request->productTwo]);
            $coupon_update = Product::where('tag', 'chicken_tikka')->update(['coupon'=> $request->productThree]);
            $coupon_update = Product::where('tag', 'spicy_meatball')->update(['coupon'=> $request->productFour]);

            return response()->json(array("result" => "success", "message" => "The Coupon Updated Successfully"));

        }catch(Exception $e){
        	return response()->json(array("result" => "failed", "message" => $e));
        }  
    }

    public function getCoupons()
    {
        $coupons = Product::select('tag', 'name', 'coupon')->get();

        return view('Admin.coupon_codes')->with('data', $coupons);
    }

    public function getReward($tag)
    {

        $prod = Product::all();

        $productOne = new \stdClass();
        $productOne->tag = "veggie_melt";
        $productOne->name = "Veggie Melt Sandwich";
        $productOne->img_source = "Veggie_Melt_sandwich.webp";
        $productOne->details = "Pure, healthy, and fresh, your soul sandwich is </br> <b> the Veggie Melt sandwich!</b> </br> Made with the freshest ingredients, this sandwich is our best selling vegetarian sandwich. Do you like doing things differently, so do we! We added a little bit of cheese to this classic vegetarian sandwich to give it an exciting twist 👌";

        $productTwo = new \stdClass();
        $productTwo->tag = "pesto_chicken";
        $productTwo->name = "Pesto Chicken Sandwich";
        $productTwo->img_source =  "pesto_chicken_sandwich.webp";
        $productTwo->details = "It’s-a </br> <b>  Pesto Chicken Sandwich  </b> </br> for you. You like the finer things in life, just like our delicious pesto sauce made with the freshest and finest ingredients. A quick getaway for you is not a vacation. You like long 3, 4, or 5 week vacations 🤷‍♂️ The Pesto Chicken sandwich is just the vacation that your taste buds need.";
        
        $productThree = new \stdClass();
        $productThree->tag = "chicken_tikka";
        $productThree->name = "Chicken Tikka Baguette";
        $productThree->img_source =  "Tikka_sandwich.webp";
        $productThree->details = "Your soul sandwich is </br><b>the Chicken Tikka Baguette!</b> </br>You’re down to earth and always up for an adventure. You are also loved by everyone around you just like our Chicken Tikka that’s found its way to the top of the best selling sandwich at delicious 💯This Chicken Tikka sandwich is just the adventure that your taste buds need.";

        $productFour = new \stdClass();
        $productFour->tag = "spicy_meatball";
        $productFour->name = "Spicy Meatball Sandwich";
        $productFour->img_source =  "Spicy_Meatball_sandwich.webp";
        $productFour->details = "Your soul sandwich is </br> <b>the Spicy Meatball! </b></br> To you food is comfort and there's no better comfort food than our Spicy Meatball sandwich. Made with fresh home made meatballs, this sandwich will keep you happy & satisfied the whole day 🌞 Crafted with Aarabiatta Sauce to add a little spice twist to a wholesome sandwich.";

        foreach($prod as $element){
            if($element->tag == $productOne->tag){
                $productOne->coupon_code = $element->coupon;
            }
            else if($element->tag == $productTwo->tag){
                $productTwo->coupon_code = $element->coupon;
            }
            else if($element->tag == $productThree->tag){
                $productThree->coupon_code = $element->coupon;
            }
            else if($element->tag == $productFour->tag){
                $productFour->coupon_code = $element->coupon;
            }
        }
        
        $products = [$productOne, $productTwo, $productThree, $productFour];

        foreach ( $products as $element ) {
            if ( $tag == $element->tag ) {
                return $element;
            }
        }
        return response()->json(array("result" => "failed", "message" => "No match found"));
    }
}
