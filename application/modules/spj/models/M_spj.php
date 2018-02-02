<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_spj extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_data($search,$from_page,$per_page){
      $where = " where id_spj like '%".$search."%' or id_booking like '%".$search."%' or id_unit like '%".$search."%' or id_sopir like '%".$search."%' or id_crew like '%".$search."%' or km_awal like '%".$search."%' or km_akhir like '%".$search."%' or biaya_sopir like '%".$search."%' or biaya_crew like '%".$search."%' or biaya_solar like '%".$search."%' or biaya_tol like '%".$search."%' or biaya_parkir like '%".$search."%' or biaya_tips like '%".$search."%' or biaya_penyebrangan like '%".$search."%' or biaya_lain like '%".$search."%' or biaya_total like '%".$search."%' or tipe_bus like '%".$search."%' or jam_jemput like '%".$search."%' or tanggal_spj like '%".$search."%' ";
      $where = ($search == '') ? '' : $where;
      $query = $this->db->query("SELECT id_spj,(select CONCAT_WS(' - ',nama_penyewa,tujuan) from booking where id_booking = spj.id_booking) Penyewa,
        DATE_FORMAT((select min(tanggal) from detail_booking det where det.id_booking = spj.id_booking), '%d/%m/%Y') Tanggal,
        (select seri from unit where unit.id_unit = spj.id_unit) Bus,
        (select nama from pegawai where pegawai.id_pegawai = spj.id_sopir) Sopir,
        format(biaya_total,0) Total FROM spj $where LIMIT $from_page,$per_page") ;

      #tambahkan nomor
      $result = $query->result_array();
      $nomor = $from_page;
      foreach ($result as $key => $value) {
        $nomor++;
        $result[$key] = array('Aksi' => $nomor) + $result[$key];
      }

      $total_data = $this->db->query("select count(*) total from spj $where")->result_array()[0]['total'];
      return array('total'=> $total_data,
                   'data' => $result);
    }

    public function get($id){
        $this->db->where('id_spj', $id);
        $this->db->limit(1);
        $query = $this->db->get('spj');
        return $query->result_array();
    }


    public function insert($data){
        $query = $this->db->insert('spj',$data);
        return $query;
    }

    public function update_by_id($data, $id){
        $this->db->where('id_spj',$id);
        $query = $this->db->update('spj',$data);
    }

    public function delete_by_id($id){
        $this->db->where('id_spj',$id);
        $query = $this->db->delete('spj');
    }

    public function get_detail_spj($id = null)
    {
        $this->db->where('id_spj', $id);
        $this->db->select('
        (select seri from unit where id_unit = spj.id_unit) unit,
        (select nama from pegawai where id_pegawai = spj.id_sopir) nama_sopir,
        (select nama from pegawai where id_pegawai = spj.id_crew) nama_crew,
        spj.km_awal,
        spj.km_akhir,
        bk.alamat_jemput,
        bk.tujuan,
        bk.nama_penyewa,
        bk.no_telepon,
        DATE_FORMAT(tanggal_spj,"%d %M %Y") tanggal_spj,
        DATE_FORMAT((select min(tanggal) from detail_booking det where det.id_booking = bk.id_booking and id_unit = spj.id_unit), "%d/%m/%Y") tanggal_dari,
        DATE_FORMAT((select max(tanggal) from detail_booking det where det.id_booking = bk.id_booking and id_unit = spj.id_unit), "%d/%m/%Y") tanggal_sampai,
        spj.jam_jemput,
        spj.tipe_bus,
        format(spj.biaya_sopir,0) biaya_sopir,
        format(spj.biaya_crew,0) biaya_crew,
        format(spj.biaya_solar,0) biaya_solar,
        format(spj.biaya_tol,0) biaya_tol,
        format(spj.biaya_parkir,0) biaya_parkir,
        format(spj.biaya_tips,0) biaya_tips,
        format(spj.biaya_penyebrangan,0) biaya_penyebrangan,
        format(spj.biaya_lain,0) biaya_lain,
        format(biaya_total,0) biaya_total
        '
        );
        $this->db->join('booking bk', 'id_booking');

        $query = $this->db->get('spj');

        // print_r($query->result_array()[0]);
        // die;
        return $query->result_array()[0];
    }


}
