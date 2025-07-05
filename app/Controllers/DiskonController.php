<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskon;

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->diskon = new DiskonModel();
    }

    public function index()
    {
        if (session()->get('role') !== 'admin') {
            return redirect()->to('/')->with('failed', 'Akses ditolak.');
        }

        $data['diskon'] = $this->diskon->orderBy('tanggal', 'ASC')->findAll();
        return view('v_diskon', $data);

    }

    public function create()
    {
        $tanggal = $this->request->getPost('tanggal');
        $existing = $this->diskon->where('tanggal', $tanggal)->first();

        if ($existing) {
            return redirect()->back()->with('failed', 'Diskon untuk tanggal ini sudah ada.');
        }

        $this->diskon->save([
            'tanggal' => $tanggal,
            'nominal' => $this->request->getPost('nominal')
        ]);

        return redirect()->to('/diskon')->with('success', 'Data diskon berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->diskon->update($id, [
            'nominal' => $this->request->getPost('nominal'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/diskon')->with('success', 'Data diskon berhasil diubah.');
    }

    public function delete($id)
    {
        $this->diskon->delete($id);
        return redirect()->to('/diskon')->with('success', 'Data diskon berhasil dihapus.');
    }
}
