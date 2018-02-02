<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_laporan_pengeluaran($tanggal_dari,$tanggal_sampai,$kategori){
        $query = $this->db->query('select (select nama from kategori_pengeluaran kat where kat.id_kategori_pengeluaran = lap.id_kategori_pengeluaran) kategori,
        keterangan, jumlah,  DATE_FORMAT(tanggal, "%d/%m/%Y") tanggal  from pengeluaran lap
        where lap.id_kategori_pengeluaran in('.$kategori.')
        and tanggal BETWEEN "'.$tanggal_dari.'" and "'.$tanggal_sampai.'"');
        return $query->result_array();
    }
    public function get_laporan_rekap_pengeluaran($tanggal_dari,$tanggal_sampai){
        $query = $this->db->query('select (select nama from kategori_pengeluaran kat where kat.id_kategori_pengeluaran = lap.id_kategori_pengeluaran) kategori,
        sum(jumlah) jumlah from pengeluaran lap
        where tanggal BETWEEN "'.$tanggal_dari.'" and "'.$tanggal_sampai.'"
        group by id_kategori_pengeluaran');
        return $query->result_array();
    }
    public function get_laporan_pendapatan($unit,$tanggal_dari,$tanggal_sampai){
        $query = $this->db->query('select * from unit where id_unit in('.$unit.')')->result_array();
        $data_unit = array();
        foreach ($query as $key => $value) {
            $id_unit = $value['id_unit'];
            $seri =       $value['seri'];
           $data_unit[$seri] =  $this->db->query("select bk.id_booking, bk.nama_penyewa, bk.alamat_jemput, bk.tujuan,
           DATE_FORMAT(detail.tanggal, '%d/%m/%Y') tanggal, detail.jumlah_hari, detail.harga,
           jumlah_bayar, status_bayar,
          IFNULL((select biaya_total from spj where spj.id_booking = bk.id_booking and spj.id_unit = detail.id_unit),0) kas_jalan

  from booking bk join
         (
         select det.id_booking id_booking, det.id_unit, min(tanggal) tanggal, count(tanggal) jumlah_hari, harga
         from detail_booking det
         join detail_booking_unit dtl on (dtl.id_booking = det.id_booking and dtl.id_unit = det.id_unit)
         where det.id_unit = $id_unit and (tanggal >= '$tanggal_dari' and tanggal <= '$tanggal_sampai')
         group by det.id_booking
         ) detail using(id_booking)
  left join
  (select id_booking, sum(jumlah) jumlah_bayar, GROUP_CONCAT(status) status_bayar from pembayaran group by id_booking)
  byr using(id_booking)")->result_array();
        }


        return $data_unit;
    }
    public function get_laporan_rekap_pendapatan($tanggal_dari,$tanggal_sampai){
        $query = $this->db->query("select id_booking, id_unit,
        (select seri from unit where dtl_unit.id_unit = id_unit) seri,
        sum(IFNULL((select biaya_total from spj where id_booking = dtl_unit.id_booking and id_unit = dtl_unit.id_unit),0)) kas_jalan,
        sum(harga) total,
        sum((select count(tanggal) tanggal from detail_booking where id_booking = dtl_unit.id_booking and id_unit = dtl_unit.id_unit)) jumlah_hari
        from detail_booking_unit dtl_unit
        where
        (select min(tanggal) tanggal from detail_booking where id_booking = dtl_unit.id_booking) >= '$tanggal_dari' and
        (select min(tanggal) tanggal from detail_booking where id_booking = dtl_unit.id_booking) <= '$tanggal_sampai'
        group by id_unit
        ");
         return $query->result_array();
        //  die($this->db->last_query());

    }
    public function get_laporan_pemakaian_sparepart($tanggal_dari,$tanggal_sampai,$unit,$sparepart){
      $where = '';
      if($unit)
        $where .= " and id_unit in($unit)";
      if ($sparepart)
          $where .= " and id_sparepart in($sparepart)";
        $query = $this->db->query("select
        DATE_FORMAT(tanggal, '%d/%m/%Y') tanggal,
        (select seri from unit where id_unit = pemakaian_sparepart.id_unit) unit,
        (select nama from sparepart where id_sparepart = pemakaian_sparepart.id_sparepart) nama_sparepart,
        jumlah,
        (select stok from sparepart where id_sparepart = pemakaian_sparepart.id_sparepart) stok
        from pemakaian_sparepart where tanggal BETWEEN '$tanggal_dari' and '$tanggal_sampai' $where");
        // echo $this->db->last_query();
        //  die;
        return $query->result_array();
    }

}
