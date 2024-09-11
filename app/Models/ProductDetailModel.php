<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductDetailModel extends Model
{
    protected $table = 'product_details';  // Tablo adını belirtiyoruz
    protected $primaryKey = 'id';  // Birincil anahtar olarak 'id' sütununu belirtiyoruz

    protected $allowedFields = [
        'product_id', 
        'product_code', 
        'quantity', 
        'extra_discount_percentage', 
        'tax_rate_percentage', 
        'sale_price'
    ];  

 
}