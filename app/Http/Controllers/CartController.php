<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CartController extends Controller
{
    public function all_products()
    {
        $data = DB::select('SELECT * FROM products');
        return $data;
    }

    public function add_cart(Request $request)
    {
        $order_id=false;
        $data = DB::select('SELECT * FROM orders WHERE is_paid=0 AND user_id='.$request->user_id);
       
        if(is_array($data)>0){
            $order_id=$data[0]->id;
        }else{
            
        }
       
        if($request->order_id==false)
        {
            $order_id = DB::table('orders')
            ->insertGetId(
                [
                'user_id' => $request->user_id, 
                'is_paid' =>0,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
                ]
            ); 

        }
        else
        {
            $order_id=$request->order_id;
        }
       
        $id = DB::table('carts')
                ->insertGetId(
                    [
                    'product_id' => $request->product_id, 
                    'orders_id' => $order_id,
                    'quantity' => $request->quantity,
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s')
                    ]
                ); 
               
                if($id>0)
                {
                    return $this->respose("true", "Item added to cart");
                }
                else
                {
                    return $this->respose("false", "Failed to add Cat Item");
                }
    }

    public function remove_cart_item(Request $request)
    {
        $data=DB::table('carts')->where('id', '=', $request->order_id)->delete();

        if($data)
        {
            return $this->respose("true", "Cart Item is Successfully Removed");
        }
        else
        {
            return $this->respose("false", "failed to remove cart item");
        }
    }

    public function my_cart(Request $request){
        $data = DB::select('SELECT products.id as product_id, products.product_name, products.product_description, products.product_image_url, products.product_price, carts.quantity FROM products, carts, orders WHERE orders.user_id='.$request->user_id.' AND orders.is_paid=0 AND orders.id=carts.orders_id AND products.id=carts.product_id');
        return $data;
    }

    public function respose($respose, $message)
    {
        return '
            {
              "response":"'.$respose.'",
              "message":"'.$message.'"
            }
            ';
    }
}
