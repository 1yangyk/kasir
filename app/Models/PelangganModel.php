<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\Database\BaseBuilder;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'PelangganID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['NamaPelanggan','Alamat','NomorTelephone'];

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

    public function getPelanggan($pelangganid = false)
    {

        if ($pelangganid == false) {
            return $this->findAll();
        }

        return $this->where(['PelangganID' => $pelangganid])->first();

    }

    public function search($keyword)
    {
        if(!$keyword){
            return null;
        }
        $this->db->table('pelanggan')->like('PelangganID', $keyword);
        $this->db->table('pelanggan')->orlike('NamaPelanggan', $keyword);
        $this->db->table('pelanggan')->orlike('Alamat', $keyword);
        $this->db->table('pelanggan')->orlike('NomorTelephone', $keyword);
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
