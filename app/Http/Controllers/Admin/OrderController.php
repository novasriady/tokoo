<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index () {
        $orders = OrderModel::getAllOrder();

        return view('pages/admin/order', array(
            'orders' => $orders
        ));
    }
}
