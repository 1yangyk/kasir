<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PelangganModel;
use App\Models\PenjualanModel;
use App\Models\transaksiModel;

class transaksi extends BaseController
{

    public function index(): string
    {

        $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;

        $detail = $this->transaksiModel->findAll();
        $jual = $this->penjualanModel->findAll();

        $request = service('request');
		$searchData = $request->getGet(); // OR $this->request->getGet();

		$search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

		// Get data 
		$prdk = new BarangModel();

		if ($search == '') {
			$paginateData = $prdk->paginate(3, 'produk');
		} else {
			$paginateData = $prdk->select('*')
				->orLike('NamaProduk', $search)
				->orLike('ProdukID', $search)    			
				->paginate(3, 'produk');
		}

        if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

        $db      = \Config\Database::connect();
        $builder = $db->table('penjualan')
        ->select('detailpenjualan.DetailID as detailId, TanggalPenjualan, NamaProduk, NamaPelanggan, Subtotal, JumlahProduk, TotalHarga, penjualan.PenjualanID as JualId, detailpenjualan.PenjualanID as JualDetail')
        ->join('detailpenjualan', 'detailpenjualan.PenjualanID = penjualan.PenjualanID')
        ->join('pelanggan', 'pelanggan.PelangganID = penjualan.PelangganID')
        ->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID');
        $query = $builder->get();
        
        //barang join
        $db      = \Config\Database::connect();
        $builder = $db->table('detailpenjualan')
        ->select('detailpenjualan.DetailID as detailId, NamaProduk, Subtotal, JumlahProduk, produk.ProdukID as IDproduk')
        ->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID');
        $burungs = $builder->get();
        //join

        $model = new TransaksiModel();

		// Get data 

		$plg = $this->pelangganModel->paginate(3, 'pelanggan');
		$jual = new PenjualanModel();

		$data = [
			'barang' => $paginateData,
            'burung' => $burungs,
			'pelanggan' => $plg,
			'detail' => $detail,
			'pager' => $prdk->pager,
			'search' => $search,
            'currentPage' => $currentPage
		];
        $data ['plg'] = $query->getResult();
        $data ['jual'] = $jual->getPenjualan();

         $penjualanModel = new PenjualanModel();
    $detailPenjualanModel = new TransaksiModel();

    // Get data from the models
    $data['penjualan'] = $penjualanModel->findAll();
    $data['detailPenjualan'] = $detailPenjualanModel->findAll();

        // if (empty($data['barang'])) {

        //     throw new \codeigniter\Exceptions\PageNotFoundException('Menu Yang Anda Cari Tidak Ada');


        // }

        return view('transaksi/index', $data);
    }

    public function tambah()
    {

        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('barang/add', $data);
    }

    public function simpan()
    {

        $pelangganID = $this->request->getPost('opt'); // Ambil ID pelanggan dari formulir
    $produkID = $this->request->getPost('produkID'); // Ambil ID produk dari formulir
    $jumlahProduk = $this->request->getPost('jumlahProduk'); // Ambil jumlah produk dari formulir

    // Ambil data harga produk dari database (contoh: menggunakan model ProdukModel)
    $jumlahProduk = (int) $jumlahProduk;

    // Get the hargaProduk as a numeric value
    $hargaProduk = (float) $this->barangModel->getHargaProduk($produkID);

    // Hitung subtotal
    $subtotal = $hargaProduk * $jumlahProduk;

    // Simpan data transaksi ke tabel penjualan
    $penjualanData = [
        'TanggalPenjualan' => date('Y-m-d H:i:s'),
        'PelangganID' => $pelangganID,
        // Tambahan data lain sesuai kebutuhan
    ];

    $penjualanID = $this->penjualanModel->insert($penjualanData);

    // Simpan data transaksi ke tabel detailpenjualan
    $detailPenjualanData = [
        'PenjualanID' => $penjualanID,
        'ProdukID' => $produkID,
        'JumlahProduk' => $jumlahProduk,
        'Subtotal' => $subtotal,
    ];

    $this->transaksiModel->insert($detailPenjualanData);

        // session()->setFlashdata('berhasil', 'Data Berhasil Ditambahkan.');

        return redirect('transaksi');
    }

    public function deleteRecords()
{
    // Assuming you are using a framework like CodeIgniter or similar
    $commonId = $this->request->getPost('PenjualanID');

    // Perform deletion from table1
    $this->penjualanModel->where('PenjualanID', $commonId)->delete();

    // Perform deletion from table2
    $this->transaksiModel->where('PenjualanID', $commonId)->delete();

    // Redirect back to the page or wherever you want
    return redirect()->to('/transaksi');
}
}
