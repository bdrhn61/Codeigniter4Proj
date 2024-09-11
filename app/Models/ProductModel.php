<?php

// app/Models/ProductModel.php
namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'products'; 
    protected $primaryKey = 'id';  
    protected $allowedFields = ['urunBaslik', 
    'urunEkBilgiBasligi', 
    'urunEkBilgiAciklama', 
    'metaTitle',
    'metaKeyword',
    'product_code',  
    'quantity', 
    'extra_discount_percentage', 
    'tax_rate_percentage', 
    'sale_price',
    'musteriGrubu',
    'oncelik',
    'price',	
    'currency'	,
    'baslangicTarihi',
    'bitisTarihi',
    'image_url'
]; 

  
}

