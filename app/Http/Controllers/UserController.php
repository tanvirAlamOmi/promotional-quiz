<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;

class UserController extends Controller
{
    public function userListDataTable()
    {
        // if ($req->ajax()) {
			$data = User::All();
			return Datatables::of($data)
            ->addColumn('created_at', function ($row){
                return $row->created_at->format('d-M-Y h:m:s');
            }) 
			->make(true);
			return $data;
		// } 
    }
}
