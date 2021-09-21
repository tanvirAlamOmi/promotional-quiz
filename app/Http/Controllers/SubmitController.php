<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Submit;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;

class SubmitController extends Controller
{

    public function validationChcekForCustomer(Request $request)
    {
        $request->validate([
            'customerName' => 'required|max:50|min:3',
            'customerEmail' => 'required|email:rfc,dns|max:255',
            'customerPhone' => 'required|numeric',
        ]);
        
        try{
            $delayDays = 30;
            $newDateTime = Carbon::now()->subDays($delayDays);
            // START check if already took the code in given period of time 

            $result = Submit::where('created_at', ">", $newDateTime)
            ->where(function ($query) use ( $request) {
                $query->where('email', $request->customerEmail)
                ->orWhere('phone', $request->customerPhone);
            })
            ->first();

            if($result){
                $remainintTime = $result->created_at->diff($newDateTime)->format('%D day(s) %H:%i:%s');
                return response()->json(array("result" => "failed", "message" => "You can try again after $remainintTime hour(s).")); 
            }

            return response()->json(array("result" => "success", "message" => "The User is Valid"));

        }catch(Exception $e){
        	return response()->json(array("result" => "failed", "message" => $e));
        }
       
    }
    
    public function onSubmit(Request $request ){

        $request->validate([
            'prizeWon' => 'required',
        ]);

        try{
            // $delayDays = 30;
            // $newDateTime = Carbon::now()->subDays($delayDays);
            // // START check if already took the code in given period of time 

            // $result = Submit::where('created_at', ">", $newDateTime)
            // ->where(function ($query) use ( $request) {
            //     $query->where('email', $request->customerEmail)
            //     ->orWhere('phone', $request->customerPhone);
            // })
            // ->first();

            // if($result){
            //     $remainintTime = $result->created_at->diff($newDateTime)->format('%D day(s) %H:%i:%s');
            //     return response()->json(array("result" => "failed", "message" => "You can try again after $remainintTime hour(s).")); 
            // }

            // END check if already took the code in given period of time 
            // DB::transaction(function() {

                // START store request
                $submit = new Submit;
                $submit->name = $request->customerName;
                $submit->email = $request->customerEmail;
                $submit->phone = $request->customerPhone;
                $submit->reward = $request->prizeWon;
        
                $submit->save();
                // END store request

                // START mail send 
                $mail_to = $request->customerEmail;
                $name = $request->customerName;
                $mail_template = "Admin.emails.test";
                $data = [
                    // 'restaurant_name'=> $restaurant->name,
                    // 'restaurant_email'=> $restaurant->email,
                    'customer'=> $request->customerName,
                    // 'phone'=>  $request->phone,
                    // 'email'=> $request->customerEmail,
                    // 'comment'=> $request->comment,
                    // 'reply'=> $request->reply,
                ];
                // Mail::send($mail_template, $data, function($message) use ($mail_to, $name) {
                //     $message->to($mail_to, $name )->subject('Resonse to your query');
                // }); 
                // END mail send
            // });


            return response()->json(array("result" => "success", "message" => "The Request submitted sucessfully."));

        }catch(Exception $e){
        	return response()->json(array("result" => "failed", "message" => $e));
        }

    }
    
    public function orderListDataTable()
    {
			$data = Submit::All();
			return Datatables::of($data)
            ->addColumn('created_at', function ($row){
                return $row->created_at->format('d-M-Y h:m:s');
            })
			->make(true);
			return $data;
    }

    public function rewardListDataTable()
    {
            $product_count = Submit::select('reward', DB::raw('count(reward) as count'))
            ->groupBy('reward')->get();
			return Datatables::of($product_count)
			->make(true);

            return $product_count;
    }
    
    public function rewardStatChart()
    {
            $product_count = Submit::select('reward', DB::raw('count(reward) as count'))
            ->groupBy('reward')->get(); 

            return $product_count;
    }
}
