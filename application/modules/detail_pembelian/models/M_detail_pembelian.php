<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_detail_pembelian extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_data($search,$from_page,$per_page,$id_faktur_pembelian){
      $where = " and id_pembelian_sparepart like '%".$search."%' or id_faktur_pembelian like '%".$search."%' or id_sparepart like '%".$search."%' or jumlah like '%".$search."%' or harga_satuan like '%".$search."%' or total like '%".$search."%' ";
      $where = ($search == '') ? '' : $where;
      $query = $this->db->query("SELECT id_pembelian_sparepart,(select nama from sparepart where id_sparepart = detail_pembelian.id_sparepart) 'Nama Sparepart',format(jumlah,0) Jumlah,format(harga_satuan,0) Harga, format(total,0) Total FROM detail_pembelian where id_faktur_pembelian = '$id_faktur_pembelian' $where LIMIT $from_page,$per_page");

      #tambahkan nomor
      $result = $query->result_array();
      $nomor = $from_page;
      foreach ($result as $key => $value) {
        $nomor++;
        $result[$key] = array('No' => $nomor) + $result[$key];
      }

      $total_data = $this->db->query("select count(*) total from detail_pembelian $where")->result_array()[0]['total'];
      return array('total'=> $total_data,
                   'data' => $result);
    }

    public function get($id){
        $this->db->where('id_pembelian_sparepart', $id);
        $this->db->limit(1);
        $query = $this->db->get('detail_pembelian');
        return $query->result_array();
    }


    public function insert($data){
      $jumlah = $data['jumlah'];
      $id_sparepart = $data['id_sparepart'];
      $this->db->trans_start();
      $query = $this->db->insert('detail_pembelian',$data);
      $this->db->query('update sparepart set  stok  = stok + '.$jumlah.' where id_sparepart = '.$id_sparepart );
      $this->db->trans_complete();
      return $query;
    }

    public function update_by_id($data, $id){

      $result = $this->db->query("select id_sparepart,jumlah from detail_pembelian where id_pembelian_sparepart = $id")->result_array();
      $jumlah = $data['jumlah'];
      $id_sparepart = $result[0]['id_sparepart'];
      $jumlah_stok = $result[0]['jumlah'];
      $jumlah_baru = $jumlah_stok - $jumlah;

      $this->db->trans_start();
      $this->db->where('id_pembelian_sparepart',$id);
      $query = $this->db->update('detail_pembelian',$data);
      $this->db->query('update sparepart set  stok  = stok - '.$jumlah_baru.' where id_sparepart = '.$id_sparepart );
      $this->db->trans_complete();

    }

    public function delete_by_id($id){
      $result = $this->db->query("select id_sparepart,jumlah from detail_pembelian where id_pembelian_sparepart = $id")->result_array();
      $jumlah = $result[0]['jumlah'];
      $id_sparepart = $result[0]['id_sparepart'];

      $this->db->trans_start();
      $this->db->where('id_pembelian_sparepart',$id);
      $query = $this->db->delete('detail_pembelian');
      $this->db->query('update sparepart set  stok  = stok - '.$jumlah.' where id_sparepart = '.$id_sparepart );
      $this->db->trans_complete();

    }


}
