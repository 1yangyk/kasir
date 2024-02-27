<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\Database\BaseBuilder;

class PenggunaModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username','email'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPengguna($penggunaid = false)
    {

        if ($penggunaid == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $penggunaid])->first();

    }

    public function search($keyword)
{
	if(!$keyword){
		return null;
	}
	$this->db->table('users')->like('id', $keyword);
	$this->db->table('users')->orlike('username', $keyword);
	$this->db->table('users')->orlike('email', $keyword);
	$query = $this->db->table('produk')->get($this->_table);
	return $query->getResult();
}

    // protected $db;

    // public function __construct()
    // {
    //     $this->db = db_connect();
    // }

    // public function get()
    // {
    //     $builder = $this->db->table('produk');
    //     $query = $builder->get();
    //     return $query;
    // }

    // public function get_data()
    // {
    //     $builder = $this->builder();
    // }

}
