<?php

namespace App\Controllers;


use App\Models\ProductModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    private $model;

    public function index(): string
    {
        return view('UrunEkle');
    }

   
    public function __construct(){
        $this->model = new \App\Models\ProductModel();
    }
    public function ekle(){
       
    $image = $this->request->getFile('image');

    if ($image && $image->isValid() && !$image->hasMoved()) {
       
         $newName = $image->getName(); 
         $image->move(FCPATH . 'public/uploads', name: $newName);
         $imageUrl = base_url('project-root/public/uploads/' . $newName);
      
    } else {
          $imageUrl = null;
    }
        try {
         
            $data = [
                "urunBaslik" => $this->request->getPost('urunBaslik'),
                "urunEkBilgiBasligi" => $this->request->getPost('urunEkBilgiBasligi'),
                "urunEkBilgiAciklama" =>$this->request->getPost('urunEkBilgiAciklama'),
                "metaTitle" =>$this->request->getPost('metaTitle') ,  
                "metaKeyword" =>$this->request->getPost('metaKeyword')  ,
                'product_code' => $this->request->getPost('product_code'),
                'quantity' => $this->request->getPost('quantity'),
              //  'unit' => $this->request->getPost('unit'),
                'extra_discount_percentage' => $this->request->getPost('extra_discount_percentage'),
                'tax_rate_percentage' => $this->request->getPost('tax_rate_percentage'),
                'sale_price' => $this->request->getPost('sale_price'),
                'musteriGrubu' => $this->request->getPost('musteriGrubu'),
                'oncelik'=> $this->request->getPost('oncelik'),
                'price' => $this->request->getPost('price'),
                'currency'=> $this->request->getPost('currency'),
                'baslangicTarihi'=> $this->request->getPost('baslangicTarihi'),
                'bitisTarihi'=> $this->request->getPost('bitisTarihi'),
                'image_url' => $imageUrl  

               
            ];
    
            $this->model->insert($data);
            echo "Ürün başarıyla eklendi!";
        } catch (\Exception $e) {
            echo "Hata: " . $e->getMessage();
        }
        
    }

    public function getir()
    {
      
        
        $model = new ProductModel();

        try {
            $products = $model->findAll(); 

            if (!$products) {
                throw new \Exception('Veriler getirilemedi.');
            }

            $data['products'] = $products;
            
            return view('EkleDuzenle', $data); 
        } catch (\Exception $e) {
         
            $data['error'] = $e->getMessage();
            return view('EkleDuzenle', $data);
        }  
    }




    public function update($id): ResponseInterface
{
    $model = new ProductModel();
    $data = $this->request->getJSON(); 

    if (!$data) {
        return $this->response->setStatusCode(400, 'Geçersiz veri'); 
    }

    $updateData = [
        'urunBaslik' => isset($data->urunBaslik) ? $data->urunBaslik : null,
        'urunEkBilgiBasligi' => isset($data->urunEkBilgiBasligi) ? $data->urunEkBilgiBasligi : null,
        'urunEkBilgiAciklama' => isset($data->urunEkBilgiAciklama) ? $data->urunEkBilgiAciklama : null,
        'metaKeyword' => isset($data->metaKeyword) ? $data->metaKeyword : null,
        'product_code' => isset($data->product_code) ? $data->product_code : null,
        'quantity' => isset($data->quantity) ? $data->quantity : null,
        'extra_discount_percentage' => isset($data->extra_discount_percentage) ? $data->extra_discount_percentage : null,
        'tax_rate_percentage' => isset($data->tax_rate_percentage) ? $data->tax_rate_percentage : null,
        'sale_price' => isset($data->sale_price) ? $data->sale_price : null,
        'musteriGrubu' => isset($data->musteriGrubu) ? $data->musteriGrubu : null,
        'oncelik' => isset($data->oncelik) ? $data->oncelik : null,
        'price' => isset($data->price) ? $data->price : null,
        'currency' => isset($data->currency) ? $data->currency : null,
        'baslangicTarihi' => isset($data->baslangicTarihi) ? $data->baslangicTarihi : null,
        'bitisTarihi' => isset($data->bitisTarihi) ? $data->bitisTarihi : null
    ];

    if ($model->update($id, $updateData)) {
        return $this->response->setStatusCode(200, 'Güncelleme başarılı'); 
    } else {
        return $this->response->setStatusCode(500, 'Güncelleme başarısız'); 
    }
}


public function delete($id)
{
    $model = new ProductModel();
    
    if ($model->delete($id)) { 
        return $this->response->setJSON(['success' => true]);
    } else {
        return $this->response->setJSON(['success' => false]);
    }
}



   

}
