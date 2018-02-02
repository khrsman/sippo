<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_booking extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_data($search,$from_page,$per_page){
      $where = " where id_booking like '%".$search."%' or tujuan like '%".$search."%' or total like '%".$search."%' or id_marketing like '%".$search."%' or alamat_jemput like '%".$search."%' or nama_penyewa like '%".$search."%' or no_telepon like '%".$search."%' ";
      $where = ($search == '') ? '' : $where;
      $query = $this->db->query("SELECT id_booking,id_booking,DATE_FORMAT((select min(tanggal) from detail_booking where id_booking = booking.id_booking), '%d/%m/%Y') Tanggal,nama_penyewa 'Nama',no_telepon 'Telepon', alamat_jemput 'Alamat',tujuan Tujuan,
      (select max(status) from pembayaran where id_booking = booking.id_booking) Status
       FROM booking $where LIMIT $from_page,$per_page");

      #tambahkan nomor
      $result = $query->result_array();
      $nomor = $from_page;
      foreach ($result as $key => $value) {
        $nomor++;
        $result[$key] = array('Aksi' => $nomor) + $result[$key];
      }

      $total_data = $this->db->query("select count(*) total from booking $where")->result_array()[0]['total'];
      return array('total'=> $total_data,
                   'data' => $result);
    }

    public function get($id){
        $this->db->where('id_booking', $id);
        $this->db->limit(1);
        $query = $this->db->get('booking');
        return $query->result_array();
    }


    public function insert($data, $data_perunit, $detail_booking)
    {

        $this->db->trans_start();
        $query = $this->db->insert('booking', $data);
        $query2 = $this->db->insert_batch('detail_booking_unit', $data_perunit);
        $query3 = $this->db->insert_batch('detail_booking', $detail_booking);
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            // die;  // generate an error... or use the log_message() function to log your error
        }
        return $query;
    }

    public function update_by_id($data, $id){
        $this->db->where('id_booking',$id);
        $query = $this->db->update('booking',$data);
    }

    public function delete_by_id($id){
      $this->db->trans_start();
      $query = $this->db->where('id_booking', $id)->delete('booking');
      $query2 = $this->db->where('id_booking', $id)->delete('detail_booking');
      $query4 = $this->db->where('id_booking', $id)->delete('spj');
      $query5 = $this->db->where('id_booking', $id)->delete('pembayaran');
      $this->db->trans_complete();
    }
    public function get_kode_booking($id = null)
    {
        $this->db->select('max(id_booking)+1 kode_booking');
        $query = $this->db->get('booking');
        return $query->result_array()[0]['kode_booking'];
    }

    public function get_detail_jadwal($id){
         $this->db->select("
          nama_penyewa detail_nama,
          no_telepon detail_telepon, id_marketing detail_marketing,
          (select max(status) from pembayaran where id_booking = bk.id_booking) detail_status,
          tujuan detail_tujuan, alamat_jemput detail_alamat_jemput,
          DATE_FORMAT((select min(tanggal) from detail_booking where id_booking = bk.id_booking),'%d %M %Y') detail_tanggal,
          total harga_pokok")->where('id_booking',$id);
          $query =  $this->db->get('booking bk');
        return $query->result_array()[0];
      }


}
