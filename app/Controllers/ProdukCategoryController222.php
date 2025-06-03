<?php

namespace App\Controllers;

use App\Models\ProductModel;

class ProdukController extends BaseController
{
    protected $product; 

    function __construct()
    {
        $this->product = new ProductModel();
    }

    public function index()
    {
        $product = $this->product->findAll();
        $data['product'] = $product;

        return view('v_produk', $data);
    }

    public function create()
{
    $dataFoto = $this->request->getFile('foto');

    $dataForm = [
        'nama' => $this->request->getPost('nama'),
        'harga' => $this->request->getPost('harga'),
        'jumlah' => $this->request->getPost('jumlah'),
        'created_at' => date("Y-m-d H:i:s")
    ];

    if ($dataFoto->isValid()) {
        $fileName = $dataFoto->getRandomName();
        $dataForm['foto'] = $fileName;
        $dataFoto->move('img/', $fileName);
    }

    $this->product->insert($dataForm);

    return redirect('produk category')->with('success', 'Data Berhasil Ditambah');
} 

    public function edit($id)
{
    $dataProduk = $this->product->find($id);

    $dataForm = [
        'name' => $this->request->getPost('name'),
        'description' => $this->request->getPost('description'),
        'updated_at' => date("Y-m-d H:i:s")
    ];

    

    $this->product->update($id, $dataForm);

    return redirect('produk category')->with('success', 'Data Berhasil Diubah');
}

public function delete($id)
{
    $dataProduk = $this->product->find($id);

    if ($dataProduk['foto'] != '' and file_exists("img/" . $dataProduk['foto'] . "")) {
        unlink("img/" . $dataProduk['foto']);
    }

    $this->product->delete($id);

    return redirect('produk category')->with('success', 'Data Berhasil Dihapus');
}
}
