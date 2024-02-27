<?php

namespace App\Models;

use CodeIgniter\Model;
use Codeigniter\Database\BaseBuilder;

class TransaksiModel extends Model
{
    protected $table            = 'detailpenjualan';
    protected $primaryKey       = 'DetailID';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['PenjualanID','ProdukID','JumlahProduk','Subtotal'];

    protected bool $allowEmptyInserts = true;

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

    public function getTransaksi()
    {
        return $this->db->table('detailpenjualan')
        ->select('detailpenjualan.DetailID as detailId, TanggalPenjualan, NamaProduk, NamaPelanggan, Subtotal, JumlahProduk, TotalHarga, penjualan.PenjualanID as JualId, detailpenjualan.PenjualanID as JualDetail')
        ->join('penjualan', 'penjualan.PenjualanID = detailpenjualan.DetailID')
        ->join('pelanggan', 'pelanggan.PelangganID = penjualan.PelangganID')
        ->join('produk', 'produk.ProdukID = detailpenjualan.ProdukID')
        ->get()->getResultArray();

    }

     public function getDetailPenjualanById($id)
    {
        return $this->find($id);
    }

    public function insertDetailPenjualan($data)
    {
        return $this->insert($data);
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
