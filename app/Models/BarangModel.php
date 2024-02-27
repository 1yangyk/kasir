<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\Database\BaseBuilder;

class BarangModel extends Model
{
    protected $table            = 'produk';
    protected $primaryKey       = 'ProdukID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['NamaProduk','HargaBeli','HargaJual','Stok'];

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

    public function getBarang($produkid = false)
    {

        if ($produkid == false) {
            return $this->findAll();
        }

        return $this->where(['ProdukID' => $produkid])->first();

    }

    public function getProdukById($id)
    {
        return $this->find($id);
    }

    public function getHargaProduk($id)
    {
        $produk = $this->find($id);

        return $produk ? $produk['HargaJual'] : null;
    }

    public function search($keyword)
    {
        if(!$keyword){
            return null;
        }
        $this->db->table('produk')->like('NamaProduk', $keyword);
        $this->db->table('produk')->orlike('ProdukID', $keyword);
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
