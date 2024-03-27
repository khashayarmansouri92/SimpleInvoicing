<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function all_customer()
    {
        $customers = Customer::orderby('id', 'DESC')->get();

        return response()->json(array('customers' => $customers), 200);
    }
}
