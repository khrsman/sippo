<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemakaian_sparepart extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_data($search,$from_page,$per_page){
      $where = " where id_pemakaian_sparepart like '%".$search."%' or id_sparepart like '%".$search."%' or jumlah like '%".$search."%' or id_unit like '%".$search."%' or tanggal like '%".$search."%' ";
      $where = ($search == '') ? '' : $where;
      $query = $this->db->query("SELECT id_pemakaian_sparepart,(select nama from sparepart where id_sparepart = pemakaian_sparepart.id_sparepart) nama,jumlah, (select seri from unit where id_unit = pemakaian_sparepart.id_unit) Kendaraan, DATE_FORMAT(tanggal, '%d/%m/%Y') tanggal FROM pemakaian_sparepart $where LIMIT $from_page,$per_page");

      #tambahkan nomor
      $result = $query->result_array();
      $nomor = $from_page;
      foreach ($result as $key => $value) {
        $nomor++;
        $result[$key] = array('No' => $nomor) + $result[$key];
      }

      $total_data = $this->db->query("select count(*) total from pemakaian_sparepart $where")->result_array()[0]['total'];
      return array('total'=> $total_data,
                   'data' => $result);
    }

    public function get($id){
        $this->db->where('id_pemakaian_sparepart', $id);
        $this->db->limit(1);
        $query = $this->db->get('pemakaian_sparepart');
        return $query->result_array();
    }


    public function insert($data){

        $jumlah = $data['jumlah'];
        $id_sparepart = $data['id_sparepart'];
        $this->db->trans_start();
        $query = $this->db->insert('pemakaian_sparepart',$data);
        $this->db->query('update sparepart set  stok  = stok - '.$jumlah.' where id_sparepart = '.$id_sparepart );
        $this->db->trans_complete();
    }

    public function update_by_id($data, $id){



        $result = $this->db->query("select id_sparepart,jumlah from pemakaian_sparepart where id_pemakaian_sparepart = $id")->result_array();
        $jumlah = $data['jumlah'];
        $id_sparepart = $result[0]['id_sparepart'];
        $jumlah_stok = $result[0]['jumlah'];
        $jumlah_baru = $jumlah_stok - $jumlah;

        $this->db->trans_start();
        $this->db->where('id_pemakaian_sparepart',$id);
        $query = $this->db->update('pemakaian_sparepart',$data);
        $this->db->query('update sparepart set  stok  = stok + '.$jumlah_baru.' where id_sparepart = '.$id_sparepart );
        $this->db->trans_complete();

    }

    public function delete_by_id($id){


        $result = $this->db->query("select id_sparepart,jumlah from pemakaian_sparepart where id_pemakaian_sparepart = $id")->result_array();
        $jumlah = $result[0]['jumlah'];
        $id_sparepart = $result[0]['id_sparepart'];

        $this->db->trans_start();
        $this->db->where('id_pemakaian_sparepart',$id);
        $query = $this->db->delete('pemakaian_sparepart');
        $this->db->query('update sparepart set  stok  = stok + '.$jumlah.' where id_sparepart = '.$id_sparepart );
        $this->db->trans_complete();
    }


}
