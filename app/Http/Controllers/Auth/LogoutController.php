<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrderDetailModel;
use App\Models\OrderModel;
use App\Models\ProductModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LogoutController extends Controller
{
    public function logout()
    {
        DB::beginTransaction();
            $carts = session()->get('cart');

            if (!empty($carts) && isset($carts['order_details'])) {
                OrderModel::saveOrderWhenLogout($carts);

                foreach ($carts['order_details'] as $orderDetail) {
                    $data = array(
                        'order_id' => $carts['order_id'],
                        'detail_product_id' => $orderDetail['detail_product_id'],
                        'order_details' => $orderDetail
                    );

                    OrderDetailModel::saveOrderDetailsWhenLogout($data);
                }
            }
        DB::commit();
        
        session()->forget('cart');

        Auth::logout();

        return redirect()->route('user.home');
    }
}
