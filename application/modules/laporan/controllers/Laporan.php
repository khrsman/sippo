<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Laporan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_laporan');
    }

    // view
    function index(){
    $data['page'] = 'v_proses';
    $this->load->view('v_main',$data);
    }

    function pengeluaran(){
      $input = array();
      parse_str($_POST['data'], $input);

    $tanggal_dari = $input['tanggal_dari'];

    $tanggal_dari = DateTime::createFromFormat('d/m/Y',  $tanggal_dari)->format('Y-m-d');
    $tanggal_sampai = $input['tanggal_sampai'];
    $tanggal_sampai = DateTime::createFromFormat('d/m/Y', $tanggal_sampai)->format('Y-m-d');

    $kategori = '';
    if($input['id_kategori_pengeluaran']){
    foreach ($input['id_kategori_pengeluaran']  as $key => $value) {
      $kategori .= $value.",";
    }
  }
    $kategori = rtrim($kategori,',');
    $data['data'] = $this->M_laporan->get_laporan_pengeluaran($tanggal_dari,$tanggal_sampai,$kategori);


    $this->load->view('v_lap_pengeluaran',$data);
    }

    function pendapatan(){

      $input = array();
      parse_str($_POST['data'], $input);

    $tanggal_dari = $input['tanggal_dari'];
    $tanggal_dari = DateTime::createFromFormat('d/m/Y',  $tanggal_dari)->format('Y-m-d');
    $tanggal_sampai = $input['tanggal_sampai'];
    $tanggal_sampai = DateTime::createFromFormat('d/m/Y', $tanggal_sampai)->format('Y-m-d');

    $unit = '';
    if($input['id_unit']){
    foreach ($input['id_unit']  as $key => $value) {
      $unit .= $value.",";
    }
  }
    $unit = rtrim($unit,',');
    $data['data'] = $this->M_laporan->get_laporan_pendapatan($unit,$tanggal_dari,$tanggal_sampai);

// die($this->db->last_query());

    $this->load->view('v_lap_pendapatan',$data);
    }

    function rekap_pengeluaran(){
      $input = array();
      parse_str($_POST['data'], $input);
    $tanggal_dari = $input['tanggal_dari'];
    $tanggal_dari = DateTime::createFromFormat('d/m/Y',  $tanggal_dari)->format('Y-m-d');
    $tanggal_sampai = $input['tanggal_sampai'];
    $tanggal_sampai = DateTime::createFromFormat('d/m/Y', $tanggal_sampai)->format('Y-m-d');

    $data['data_rekap'] = $this->M_laporan->get_laporan_rekap_pengeluaran($tanggal_dari,$tanggal_sampai);
    $this->load->view('v_lap_rekap_pengeluaran',$data);
    }

    function rekap_pendapatan(){
      $input = array();
      parse_str($_POST['data'], $input);
    $tanggal_dari = $input['tanggal_dari'];
    $tanggal_dari = DateTime::createFromFormat('d/m/Y',  $tanggal_dari)->format('Y-m-d');
    $tanggal_sampai = $input['tanggal_sampai'];
    $tanggal_sampai = DateTime::createFromFormat('d/m/Y', $tanggal_sampai)->format('Y-m-d');

    $data['data_rekap'] = $this->M_laporan->get_laporan_rekap_pendapatan($tanggal_dari,$tanggal_sampai);
    $this->load->view('v_lap_rekap_pendapatan',$data);
    }

    function rekap_total(){
      $input = array();
        parse_str($_POST['data'], $input);
      // $data['page'] = 'v_lap_rekap_total';
      $tanggal_dari = $input['tanggal_dari'];
      $tanggal_dari = DateTime::createFromFormat('d/m/Y',  $tanggal_dari)->format('Y-m-d');
      $tanggal_sampai = $input['tanggal_sampai'];
      $tanggal_sampai = DateTime::createFromFormat('d/m/Y', $tanggal_sampai)->format('Y-m-d');
       $pendapatan_bis= $this->M_laporan->get_laporan_rekap_pendapatan($tanggal_dari,$tanggal_sampai);

      $data['data_rekap_pemasukan'] = $pendapatan_bis;
      $data['data_rekap_pengeluaran'] = $this->M_laporan->get_laporan_rekap_pengeluaran($tanggal_dari,$tanggal_sampai);
      // print_r(  $data['data_rekap_pengeluaran']);
      // die;

      $this->load->view('v_lap_rekap_total',$data);
    }

    function pemakaian_sparepart(){
      $input = array();
      parse_str($_POST['data'], $input);
//
//       print_r($_POST);
//
// die;

    $tanggal_dari = $input['tanggal_dari'];

    $tanggal_dari = DateTime::createFromFormat('d/m/Y',  $tanggal_dari)->format('Y-m-d');
    $tanggal_sampai = $input['tanggal_sampai'];
    $tanggal_sampai = DateTime::createFromFormat('d/m/Y', $tanggal_sampai)->format('Y-m-d');

    $unit = '';
    $sparepart = '';
    if($input['id_unit']){
    foreach ($input['id_unit']  as $key => $value) {
      $unit .= $value.",";
      }
    }
    if($input['id_sparepart']){
    foreach ($input['id_sparepart']  as $key => $value) {
      $sparepart .= $value.",";
      }
    }


    $unit = rtrim($unit,',');
    $sparepart = rtrim($sparepart,',');
    $data['data'] = $this->M_laporan->get_laporan_pemakaian_sparepart($tanggal_dari,$tanggal_sampai,$unit,$sparepart);

    $this->load->view('v_lap_pemakaian_sparepart',$data);
    }


}
?>
