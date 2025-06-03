<?php

namespace App\Controllers;

use App\Models\ProdukCategoryModel;

class ProdukCategoryController extends BaseController
{
    protected $product_category; 

    function __construct()
    {
        $this->product_category = new ProdukCategoryModel();
    }

    public function index()
    {
        $product_category = $this->product_category->findAll();
        $data['product_category'] = $product_category;

        return view('v_produkcategory', $data);
    }

    public function create()
{
    $dataFoto = $this->request->getFile('foto');

    $dataForm = [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'created_at' => date("Y-m-d H:i:s")
    ];

   
    $this->product_category->insert($dataForm);

    return redirect('produk_category')->with('success', 'Data Berhasil Ditambah');
} 

    public function edit($id)
{
    $dataProduk = $this->product_category->find($id);

    $dataForm = [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'updated_at' => date("Y-m-d H:i:s")
    ];

    

    $this->product_category->update($id, $dataForm);

    return redirect('produk_category')->with('success', 'Data Berhasil Diubah');
}

public function delete($id)
{
    $dataProduk = $this->product_category->find($id);


    $this->product_category->delete($id);

    return redirect('produk_category')->with('success', 'Data Berhasil Dihapus');
}
}
