<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_faktur_pembelian extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_data($search,$from_page,$per_page){
      $where = " where id_faktur_pembelian like '%".$search."%' or id_supplier like '%".$search."%' or tanggal like '%".$search."%' ";
      $where = ($search == '') ? '' : $where;
      $query = $this->db->query("SELECT id_faktur_pembelian, (select nama from supplier where id_supplier = faktur_pembelian.id_supplier) 'Nama Supplier',
        DATE_FORMAT(tanggal, '%d/%m/%Y') Tanggal,id_faktur_pembelian 'No Faktur' FROM faktur_pembelian $where LIMIT $from_page,$per_page");

      #tambahkan nomor
      $result = $query->result_array();
      $nomor = $from_page;
      foreach ($result as $key => $value) {
        $nomor++;
        $result[$key] = array('Detail' => $nomor) + $result[$key];
      }

      $total_data = $this->db->query("select count(*) total from faktur_pembelian $where")->result_array()[0]['total'];
      return array('total'=> $total_data,
                   'data' => $result);
    }

    public function get($id){
        $this->db->where('id_faktur_pembelian', $id);
        $this->db->limit(1);
        $query = $this->db->get('faktur_pembelian');
        return $query->result_array();
    }


    public function insert($data){
        $query = $this->db->insert('faktur_pembelian',$data);
        return $query;
    }

    public function update_by_id($data, $id){
        $this->db->where('id_faktur_pembelian',$id);
        $query = $this->db->update('faktur_pembelian',$data);
    }

    public function delete_by_id($id){
        $this->db->where('id_faktur_pembelian',$id);
        $query = $this->db->delete('faktur_pembelian');
    }


}
