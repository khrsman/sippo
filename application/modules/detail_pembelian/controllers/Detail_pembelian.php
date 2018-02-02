<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Detail_pembelian extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_detail_pembelian');
    }

    // view
    function index(){
      $id = $this->input->post('data');
    $data['id_faktur_pembelian'] = $id;
    $data['page'] = 'v_detail_pembelian';
    $this->load->view('v_main',$data);
    }

    function data(){
    $id = $this->input->get('id_faktur_pembelian');
    $this->load->view('v_detail_pembelian_data');
    }

    function editor(){
    $this->load->view('v_detail_pembelian_editor');
    }

    public function page()
    {
      #--------------------------------------------------------------------------------------------------->
      #------------------------------------- Konfigurasi  ------------------------------------------------>
      #--------------------------------------------------------------------------------------------------->
      $id_faktur_pembelian = $this->input->get('id_faktur_pembelian');
      $per_page = 10; // jumlah data per halaman
      $from_page = $this->input->get('from') ?  $this->input->get('from'): 0; //data dimulai dari ...
      $search = $this->input->get("query") ? $this->input->get("query") : ''; // query pencarian

      #--------------------------------------------------------------------------------------------------->
      #------------------------------------- Ambil data  ------------------------------------------------->
      #--------------------------------------------------------------------------------------------------->

      $data = $this->M_detail_pembelian->get_data($search,$from_page,$per_page,$id_faktur_pembelian); // ambil data
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
      $data = $this->M_detail_pembelian->get($id);
      echo json_encode($data);
    }

    // tambah data
    function add(){
        $data = array();
        parse_str($_POST['data'], $data);
        // jika fieldnya auto increment
        if (isset($data['id_pembelian_sparepart'])) {
          $data['id_pembelian_sparepart'] = NULL;
        };
        $insert = $this->M_detail_pembelian->insert($data);
        if (!$insert) {
            $msg = $this->db->_error_message();
            $num = $this->db->_error_number();
          }
    }

    // fungsi update
    function update(){
      $data = array();
      parse_str($_POST['data'], $data);
      $id = $data['id_pembelian_sparepart'];
      $update = $this->M_detail_pembelian->update_by_id($data,$id);
    }

    // fungsi hapus
    function delete(){
      $id = $this->input->post('id');
      $delete = $this->M_detail_pembelian->delete_by_id($id);
    }




}
?>
