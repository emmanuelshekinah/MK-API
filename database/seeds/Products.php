<?php

use Illuminate\Database\Seeder;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'product_name' => 'Huawei P30',
            'product_description' => 'Huawei P30 Lite 4GB+128GB Dual SIM - Peacock Blue',
            'product_image_url' => 'https://cdn.shopify.com/s/files/1/1374/6193/products/001263-huawei-p30-pro-aurora-2_2000x.jpg?v=1575102347',
            'product_price' => 5000,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s')
        ]);

    }
}
