<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_marketing extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_data($search,$from_page,$per_page){
      $where = " where id_marketing like '%".$search."%' or keterangan like '%".$search."%' or warna like '%".$search."%' ";
      $where = ($search == '') ? '' : $where;
      $query = $this->db->query("SELECT id_marketing ,id_marketing 'Kode',keterangan Keterangan, CONCAT('<div style=background-color:',warna,'> ',warna,' </div>' ) Warna FROM marketing $where LIMIT $from_page,$per_page");

      #tambahkan nomor
      $result = $query->result_array();
      $nomor = $from_page;
      foreach ($result as $key => $value) {
        $nomor++;
        $result[$key] = array('No' => $nomor) + $result[$key];
      }

      $total_data = $this->db->query("select count(*) total from marketing $where")->result_array()[0]['total'];
      return array('total'=> $total_data,
                   'data' => $result);
    }

    public function get($id){
        $this->db->where('id_marketing', $id);
        $this->db->limit(1);
        $query = $this->db->get('marketing');
        return $query->result_array();
    }


    public function insert($data){
        $query = $this->db->insert('marketing',$data);
        return $query;
    }

    public function update_by_id($data, $id){
        $this->db->where('id_marketing',$id);
        $query = $this->db->update('marketing',$data);
    }

    public function delete_by_id($id){
        $this->db->where('id_marketing',$id);
        $query = $this->db->delete('marketing');
    }


}
