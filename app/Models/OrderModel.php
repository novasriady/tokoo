<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $primaryKey = 'order_id';

    protected $fillable = array(
        'order_id',
        'order_user_id',
        'order_address',
        'order_shippingservice',
        'order_shippingcost',
        'order_totalpayment',
        'order_proofpayment',
        'order_rejectednotes',
        'order_status',
    );

    protected $casts = array(
        'order_id' => 'string',
        'order_user_id' => 'string'
    );

    public function order_details (): HasMany {
        return $this->hasMany(OrderDetailModel::class, 'detail_order_id', 'order_id');
    }

    public function user (): HasOne {
        return $this->hasOne(User::class, 'id', 'order_user_id');
    }

    public static function getAllOrder () {
        $orders = self::with('user')
        ->with('order_details')
        ->with('order_details.product')
        ->with('order_details.product.category')
        ->whereNotNull('order_status')
        ->get();

        return $orders;
    }

    public static function getCartsByUserId (string $user_id) {
        $cart = self::with('order_details')
        ->with('order_details.product')
        ->with('order_details.product.category')
        ->where('order_user_id', $user_id)
        ->whereNull('order_status')
        ->first();

        if ($cart) {
            $orderDetailsFormatted = array();

            foreach ($cart->order_details as $detail) {
                $orderDetailsFormatted[] = [
                    'detail_id' => $detail->detail_id,
                    'detail_order_id' => $detail->detail_order_id,
                    'detail_product_id' => $detail->detail_product_id,
                    'detail_product_name' => $detail->product->product_name,
                    'detail_product_description' => $detail->product->product_description,
                    'detail_product_category' => $detail->product->category->category_name,
                    'detail_product_img' => $detail->product->product_img,
                    'detail_quantity' => $detail->detail_quantity,
                    'detail_weight' => $detail->detail_weight,
                    'detail_totalprice' => $detail->detail_totalprice,
                    'created_at' => $detail->created_at,
                    'updated_at' => $detail->updated_at,
                ];
            }
            
            $cartFormatted = [
                'order_id' => $cart->order_id,
                'order_user_id' => $cart->order_user_id,
                'order_details' => $orderDetailsFormatted,
                'created_at' => $cart->created_at,
                'updated_at' => $cart->updated_at,
            ];

            return $cartFormatted;
        }
    
        return $cart;
    }

    public static function getOrderByUserId(string $user_id) {
        $orders = self::where('order_user_id', $user_id)
            ->whereNotNull('order_status')
            ->get();
    
        return $orders;
    }

    public static function getOrderById(string $order_id) {
        $order = self::with('order_details')
        ->with('order_details.product')
        ->with('order_details.product.category')
        ->where('order_id', $order_id)
        ->first();

        return $order;
    }

    public static function saveOrderWhenLogout(array $data) {
        $order = self::updateOrCreate(
            array(
                'order_id' => $data['order_id'],
                'order_user_id' => Auth::user()->id
            ),
            Arr::except($data, ['order_details'])
        );

        return $order;
    }

    public static function createOrder(array $data) {
        $order = self::updateOrCreate(
            array(
                'order_id' => $data['order_id'],
                'order_user_id' => Auth::user()->id,
            ),
            Arr::except($data, ['order_details'])
        );

        return $order;
    }

    public static function payOrder(array $data, string $order_id) {
        $order = self::find($order_id);

        if ($order) {
            $order->update($data);
        }

        return $order;
    }

    public static function updateOrderStatus (string $order_id, string $order_status, ?string $order_rejectednotes = null) {
        $order = self::find($order_id);

        if ($order) {
            $order->update([
                'order_status' => $order_status,
                'order_rejectednotes' => $order_rejectednotes
            ]);
        }

        return $order;
    }
}
