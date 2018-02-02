<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pembayaran extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_pembayaran');
    }

    // view
    function index(){
    $data['page'] = 'v_pembayaran';
    $this->load->view('v_main',$data);
    }

    function data(){
    $this->load->view('v_pembayaran_data');
    }

    function editor(){
    $this->load->view('v_pembayaran_editor');
    }

    public function page()
    {
      #--------------------------------------------------------------------------------------------------->
      #------------------------------------- Konfigurasi  ------------------------------------------------>
      #--------------------------------------------------------------------------------------------------->
      $per_page = 10; // jumlah data per halaman
      $from_page = $this->input->get('from') ?  $this->input->get('from'): 0; //data dimulai dari ...
      $search = $this->input->get("query") ? $this->input->get("query") : ''; // query pencarian

      #--------------------------------------------------------------------------------------------------->
      #------------------------------------- Ambil data  ------------------------------------------------->
      #--------------------------------------------------------------------------------------------------->

      $data = $this->M_pembayaran->get_data($search,$from_page,$per_page); // ambil data
      $data_table = $data['data']; // data
      $total_rows = $data['total']; // jumlah data
      $total_page = $total_rows/$per_page; //jumlah halaman

      #--------------------------------------------------------------------------------------------------->
      #-------------------------------- Pagination button ------------------------------------------------>
      #--------------------------------------------------------------------------------------------------->
        $link = array();
        $from = 0;
        $count = 0;
        $awal_page = $from_page/$per_page >= 0 ? $from_page/$per_page : 1;
        $awal_page = ($awal_page - 5) > 0? $awal_page-5: 0;

        // looping untuk halaman
        for ($i=$awal_page; $i < $total_page; $i++) {
            if ($count >= 10 || $i >= $total_page) {
                break;
            }
            $from = $i * $per_page;
            $link[$i] = array("page" => $i+1, "from" => $from );
            $count++;
        }
        $first = array("page" => "<<", "from" => 0 );
        $last = array("page" => ">>", "from" => (ceil($total_page)-1) * $per_page );
        $next =   (ceil($total_page)-1) == 0? array("page" => ">", "from" => 0 ): array("page" => ">", "from" => $from_page+$per_page );
        $prev =   array("page" => "<", "from" => $from_page-$per_page );

        if(($awal_page > 2)){
        $link = array( 0 => $first) + array( 1 => $prev) + $link;
        }
        $link = $link + array( "next" => $next) + array( "last" => $last);

        #--------------------------------------------------------------------------------------------------->
        #------------------------------------- Return JSON  ------------------------------------------------>
        #--------------------------------------------------------------------------------------------------->
        $data['value'] = $data_table;
        $data['page'] = $link;

         echo json_encode($data, JSON_PRETTY_PRINT);
    }

    function get_for_edit(){
      $id = $this->input->get('id');
      $data = $this->M_pembayaran->get($id);
      echo json_encode($data);
    }

    // tambah data
    function add(){
        $data = array();
        parse_str($_POST['data'], $data);

        $data['tanggal'] = DateTime::createFromFormat('d/m/Y',   $data['tanggal'])->format('Y-m-d');
        $insert = $this->M_pembayaran->insert($data);
        if (!$insert) {
            $msg = $this->db->_error_message();
            $num = $this->db->_error_number();
          }
    }

    // fungsi update
    function update(){
      $data = array();
      parse_str($_POST['data'], $data);
      $id = $data['id_pembayaran'];
      $update = $this->M_pembayaran->update_by_id($data,$id);
    }

    // fungsi hapus
    function delete(){
      $id = $this->input->post('id');
      $delete = $this->M_pembayaran->delete_by_id($id);
    }
    function ajax_terbilang(){
         $jumlah =   $this->input->post('jumlah');
          echo $this->Terbilang($jumlah);
        }


        function Terbilang($x)
        {
          $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
          if ($x < 12)
            return " " . $abil[$x];
          elseif ($x < 20)
            return  $this->Terbilang($x - 10) . "belas";
          elseif ($x < 100)
            return  $this->Terbilang($x / 10) . " puluh" .  $this->Terbilang($x % 10);
          elseif ($x < 200)
            return " seratus" .  $this->Terbilang($x - 100);
          elseif ($x < 1000)
            return  $this->Terbilang($x / 100) . " ratus" .  $this->Terbilang($x % 100);
          elseif ($x < 2000)
            return " seribu" . $this->Terbilang($x - 1000);
          elseif ($x < 1000000)
            return $this->Terbilang($x / 1000) . " ribu" .  $this->Terbilang($x % 1000);
          elseif ($x < 1000000000)
            return $this-> Terbilang($x / 1000000) . " juta" .  $this->Terbilang($x % 1000000);
        }


        function by_id_booking(){
  $data['page'] = 'v_pembayaran_by_id_booking';
  $data['kode_bayar'] = $this->M_pembayaran->get_kode_bayar();
  $kode_booking = $this->input->get('id_booking');
  $data_booking = $this->M_pembayaran->get_detail_booking($kode_booking);
  $data['data_booking'] = $data_booking;
  $data['sisa_bayar'] = $data_booking[0]['total'] - $this->M_pembayaran->get_sisa_bayar($kode_booking)['jumlah'];
  $this->load->view('v_main',$data);
  }

  function kwitansi(){
  $data['page'] = 'v_kwitansi';
  $id_pembayaran = $this->input->get('id_pembayaran');
  $data['inv'] = $this->M_pembayaran->get_kwitansi($id_pembayaran);
  $data['harga_unit'] =   $this->M_pembayaran->get_harga_unit($data['inv']['id_booking']);
  $data['terbilang'] = $this->terbilang(str_ireplace(",","",$data['inv']['jumlah_bayar']))." rupiah";

  $this->load->view('v_main',$data);
  }
  
  function invoice(){
  $data['page'] = 'v_invoice';
  $id_booking = $this->input->get('id_booking');
  $data['inv'] = $this->M_pembayaran->get_invoice($id_booking);
    $data['harga_unit'] =   $this->M_pembayaran->get_harga_unit($data['inv']['id_booking']);
  $this->load->view('v_main',$data);
  }



}
?>
