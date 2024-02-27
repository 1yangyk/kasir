<?php

namespace App\Controllers;

use App\Models\PenggunaModel;

use \Myth\Auth\Entities\User;
use \Myth\Auth\Authorization\GroupModel;
use \Myth\Auth\Config\Auth as AuthConfig;

class users extends BaseController
{
    public function index(): string
    {
        return view('user/index');
    }
    public function manage(): string
    {
        // $users = new \Myth\Auth\Models\UserModel();
        
        $db      = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, username, email, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $builder->get();
        $users = new PenggunaModel();

        $data = [
            'pager' => $users->pager,
            'users' => $query->getResult()
                ];
        
        return view('user/manage', $data);
    }

    public function delete($penggunaid)
    {

        $this->penggunaModel->delete($penggunaid);

        session()->setFlashdata('berhasil', 'Data Berhasil Dihapus.');

        return redirect()->to('/manage');
    }

    public function edit($penggunaid)
    {
        $data = [
            'validation' => \Config\Services::validation(),
            'pengguna' => $this->penggunaModel->getPengguna($penggunaid)
        ];

        return view('user/edit', $data);
    }

    public function update($id)
    {

        // cek Nama

        $barangLama = $this->penggunaModel->getPengguna($this->request->getVar('dummy'));

        if ($barangLama['username'] == $this->request->getVar('Username')) {
            $ruleNama = 'required';
        } else {
            $ruleNama = 'required|is_unique[users.username]';
        }
        
        if ($barangLama['email'] == $this->request->getVar('Email')) {
            $ruleEmail = 'required';
        } else {
            $ruleEmail = 'required|is_unique[users.email]';
        }
        // dd($this->request->getVar());

        if (!$this->validate([

            'username' => $ruleNama,
            'email' => $ruleEmail,

        ])) {

            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('manage/edit/' . $id)->withInput()->with('validation', $validation);
        }

        $this->penggunaModel->save([
            'userid' => $this->request->getVar('dummy'),
            'username' => $this->request->getVar('Username'),
            'email' => $this->request->getVar('Email'),
        ]);

        session()->setFlashdata('berhasil', 'Data Berhasil Edit.');

        return redirect('manage');
    }

}


