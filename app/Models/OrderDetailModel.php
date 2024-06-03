<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrderDetailModel extends Model
{
    use HasFactory;

    protected $table = 'order_details';
    protected $primaryKey = 'detail_id';

    protected $fillable = array(
        'detail_id',
        'detail_order_id',
        'detail_product_id',
        'detail_quantity',
        'detail_weight',
        'detail_totalprice'
    );

    protected $casts = array(
        'detail_id' => 'string',
        'detail_order_id' => 'string',
        'detail_product_id' => 'string',
    );

    public function product (): HasOne {
        return $this->hasOne(ProductModel::class, 'product_id', 'detail_product_id');
    }

    public static function saveOrderDetailsWhenLogout (array $data) {
        $orderDetail = self::updateOrCreate(
            array(
                'detail_order_id' => $data['order_id'],
                'detail_product_id' => $data['detail_product_id']
            ),
            $data['order_details']);

        return $orderDetail;
    }

    public static function createOrderDetail (array $data) {
        $orderDetail = self::updateOrCreate(
            array(
                'detail_order_id' => $data['detail_order_id'],
                'detail_product_id' => $data['detail_product_id']
            ),
            $data);

        return $orderDetail;
    }

    public static function deleteOrderDetail (string $detail_id) {
        $orderDetail = self::where('detail_id', $detail_id)
        ->first();

        if ($orderDetail) {
            $orderDetail->delete();
        }

        return $orderDetail;
    }
}