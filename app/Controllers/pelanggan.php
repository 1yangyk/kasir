<?php

namespace App\Controllers;

use App\Models\PelangganModel;

class pelanggan extends BaseController
{

    public function index(): string
    {

        
        $currentPage = $this->request->getVar('page_produk') ? $this->request->getVar('page_produk') : 1;
        
        // $keyword = $this->request->getVar('keyword');
        // // d($keyword);
        
        // if ($keyword) {
        //     $produk = $this->barangModel->search('keyword');
        // } else {
        //     $produk = $this->barangModel;
        // }
        
        // $barang = $produk->paginate(6, 'produk');
        // $pager = $this->barangModel->pager;

        // $data = [
        //     'barang' => $barang,
        //     'pager' => $pager,
        //     'currentPage' => $currentPage
        // ];

        // if (empty($data['barang'])) {

        //     throw new \codeigniter\Exceptions\PageNotFoundException('Menu Yang Anda Cari Tidak Ada');


        // }

        $request = service('request');
		$searchData = $request->getGet(); // OR $this->request->getGet();

		$search = "";
		if (isset($searchData) && isset($searchData['search'])) {
			$search = $searchData['search'];
		}

		// Get data 
		$users = new PelangganModel();

		if ($search == '') {
			$paginateData = $users->paginate(6, 'pelanggan');
		} else {
			$paginateData = $users->select('*')
				->orLike('PelangganID', $search)
				->orLike('NamaPelanggan', $search)    			
				->orLike('NomorTelephone', $search)    			
				->orLike('Alamat', $search)    			
				->paginate(6, 'pelanggan');
		}

		$data = [
			'pelanggan' => $paginateData,
			'pager' => $users->pager,
			'search' => $search,
            'currentPage' => $currentPage
		];

        return view('pelanggan/index', $data);
    }

    public function tambah()
    {

        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('pelanggan/add', $data);
    }

    public function simpan()
    {

        // dd($this->request->getVar());

        if (!$this->validate([

            'namaPelanggan' => 'required|is_unique[produk.NamaProduk]',
            'alamat' => 'required',
            'noHP' => 'required|is_natural|min_length[12]|max_length[13]',

        ])) {

            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('pelanggan/tambah')->withInput()->with('validation', $validation);
        }

        $this->pelangganModel->save([
            'NamaPelanggan' => $this->request->getVar('namaPelanggan'),
            'Alamat' => $this->request->getVar('alamat'),
            'NomorTelephone' => $this->request->getVar('noHP'),
        ]);
        

        session()->setFlashdata('berhasil', 'Data Berhasil Ditambahkan.');

        return redirect('pelanggan');
    }

    public function edit($produkid)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'pelanggan' => $this->pelangganModel->getPelanggan($produkid)
        ];

        return view('pelanggan/edit', $data);
    }

    public function update($PelangganID)
    {

        // cek Nama

        $barangLama = $this->pelangganModel->getPelanggan($this->request->getVar('dummy'));

        if ($barangLama['NamaPelanggan'] == $this->request->getVar('namaPelanggan')) {
            $ruleNama = 'required';
        } else {
            $ruleNama = 'required|is_unique[pelanggan.NamaPelanggan]';
        }
        // dd($this->request->getVar());

        if (!$this->validate([

            'namaPelanggan' => $ruleNama,
            'alamat' => 'required',
            'noHP' => 'required|is_natural|min_length[12]|max_length[13]',

        ])) {

            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('pelanggan/edit/' . $PelangganID)->withInput()->with('validation', $validation);
        }

        $this->pelangganModel->save([
            'PelangganID' => $this->request->getVar('dummy'),
            'NamaPelanggan' => $this->request->getVar('namaPelanggan'),
            'Alamat' => $this->request->getVar('alamat'),
            'NomorTelephone' => $this->request->getVar('noHP'),
        ]);

        session()->setFlashdata('berhasil', 'Data Berhasil Edit.');

        return redirect('pelanggan');
    }

    public function delete($produkid)
    {

        $this->pelangganModel->delete($produkid);

        session()->setFlashdata('berhasil', 'Data Berhasil Dihapus.');

        return redirect()->to('/pelanggan');
    }
}
