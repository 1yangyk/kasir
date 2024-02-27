<?php

namespace App\Controllers;

use App\Models\BarangModel;

class barang extends BaseController
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
		$users = new BarangModel();

		if ($search == '') {
			$paginateData = $users->paginate(6, 'produk');
		} else {
			$paginateData = $users->select('*')
				->orLike('NamaProduk', $search)
				->orLike('ProdukID', $search)    			
				->paginate(6, 'produk');
		}

		$data = [
			'barang' => $paginateData,
			'pager' => $users->pager,
			'search' => $search,
            'currentPage' => $currentPage
		];

        return view('barang/index', $data);
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

        $validation = \Config\Services::validation();
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'namaProduk' => [
                    'rules' => 'required|is_unique[produk.NamaProduk]',
                    'errors' => [
                        'required' => 'Nama produk harus diisi.',
                        'is_unique' => 'Produk sudah tersedia.'
                    ]
                ],
                'hargaBeli' => [
                    'rules' => 'required|is_natural_no_zero|min_length[3]',
                    'errors' => [
                        'required' => 'Harga beli harus diisi.',
                        'is_natural_no_zero' => 'Kolom ini hanya boleh berisi angka dan harus lebih dari 0(nol)',
                        'min_length' => 'Angka harus berisi 3 atau lebih karakter'
                    ]
                ],
                'hargaJual' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'required' => 'Harga jual harus diisi.',
                        'is_natural_no_zero' => 'Kolom ini hanya boleh berisi angka dan harus lebih dari 0(nol)'
                    ]
                ],
                'jml' => [
                    'rules' => 'required|is_natural_no_zero',
                    'errors' => [
                        'required' => 'Stock harus diisi.',
                        'is_natural_no_zero' => 'Kolom ini hanya boleh berisi angka dan harus lebih dari 0(nol)'
                    ]
                ],
            ];
            if (!$this->validate($rules)) {
                session()->setFlashdata('errors', $validation->getErrors());
                return redirect()->to('barang/tambah')->withInput()->with('errors', $validation->getErrors());
            }
        }

        $this->barangModel->save([
            'NamaProduk' => $this->request->getVar('namaProduk'),
            'HargaBeli' => $this->request->getVar('hargaBeli'),
            'HargaJual' => $this->request->getVar('hargaJual'),
            'Stok' => $this->request->getVar('jml')
        ]);

        session()->setFlashdata('berhasil', 'Data Berhasil Ditambahkan.');

        return redirect('barang');
    }

    public function edit($produkid)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'barang' => $this->barangModel->getBarang($produkid)
        ];

        return view('barang/edit', $data);
    }

    public function update($ProdukID)
    {

        // cek Nama

        $barangLama = $this->barangModel->getBarang($this->request->getVar('dummy'));

        if ($barangLama['NamaProduk'] == $this->request->getVar('namaProduk')) {
            $ruleNama = 'required';
        } else {
            $ruleNama = 'required|is_unique[produk.NamaProduk]';
        }
        // dd($this->request->getVar());

        if (!$this->validate([

            'namaProduk' => $ruleNama,
            'hargaBeli' => 'required|is_natural_no_zero',
            'hargaJual' => 'required|is_natural_no_zero',
            'jml' => 'required|is_natural_no_zero',

        ])) {

            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('barang/edit/' . $ProdukID)->withInput()->with('validation', $validation);
        }

        $this->barangModel->save([
            'ProdukId' => $this->request->getVar('dummy'),
            'NamaProduk' => $this->request->getVar('namaProduk'),
            'HargaBeli' => $this->request->getVar('hargaBeli'),
            'HargaJual' => $this->request->getVar('hargaJual'),
            'Stok' => $this->request->getVar('jml')
        ]);

        session()->setFlashdata('berhasil', 'Data Berhasil Edit.');

        return redirect('barang');
    }

    public function delete($produkid)
    {

        $this->barangModel->delete($produkid);

        session()->setFlashdata('berhasil', 'Data Berhasil Dihapus.');

        return redirect()->to('/barang');
    }
}
