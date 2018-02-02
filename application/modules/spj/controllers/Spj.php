<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Spj extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_spj');
    }

    // view
    function index(){
    $data['page'] = 'v_spj';
    $this->load->view('v_main',$data);
    }

    function data(){
    $this->load->view('v_spj_data');
    }

    function editor(){
    $this->load->view('v_spj_editor');
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

      $data = $this->M_spj->get_data($search,$from_page,$per_page); // ambil data
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
      $data = $this->M_spj->get($id);
      echo json_encode($data);
    }

    // tambah data
    function add(){
        $data = array();
        parse_str($_POST['data'], $data);
        // jika fieldnya auto increment
        if (isset($data['id_spj'])) {
          $data['id_spj'] = NULL;
        };
        $data['tanggal_spj'] = DateTime::createFromFormat('d/m/Y',   $data['tanggal_spj'])->format('Y-m-d');
        $insert = $this->M_spj->insert($data);
        if (!$insert) {
            $msg = $this->db->_error_message();
            $num = $this->db->_error_number();
          }
    }

    // fungsi update
    function update(){
      $data = array();
      parse_str($_POST['data'], $data);
      $id = $data['id_spj'];
      $update = $this->M_spj->update_by_id($data,$id);
    }

    // fungsi hapus
    function delete(){
      $id = $this->input->post('id');
      $delete = $this->M_spj->delete_by_id($id);
    }

    function cetak(){
    $data['page'] = 'v_spj_cetak';
    $id = $this->input->get('id');
    $data['spj'] = $this->M_spj->get_detail_spj($id);
    $this->load->view('v_main',$data);

    }

    function kode_booking_spj()
  {
    $tanggal = $this->input->get('tanggal');
    $header = '<select class="form-control" name="id_booking" id="id_booking">';
    $select_item = '';
    $footer = '</select>';

    $tanggal = ($tanggal !== '') ? $tanggal :  date('d/m/Y') ;
    $tanggal = DateTime::createFromFormat('d/m/Y',   $tanggal)->format('Y-m-d');
    $data = $this->db->select('distinct(id_booking), nama_penyewa, tujuan')->join('detail_booking','id_booking')->where('tanggal', $tanggal)->get('booking')->result_array();

    foreach ($data as $key => $value) {
      $select_item .= '<option value="'.$value['id_booking'].'">'.$value['id_booking'].' ('.$value['nama_penyewa'].' - '.$value['tujuan'].')</option>'  ;
      $select_item .= '<option value="'.$value['id_booking'].'">'.$value['id_booking'].' ('.$value['nama_penyewa'].' - '.$value['tujuan'].')</option>'  ;
      $select_item .= '<option value="'.$value['id_booking'].'">'.$value['id_booking'].' ('.$value['nama_penyewa'].' - '.$value['tujuan'].')</option>'  ;
    }

    if ($select_item == ''){
      $select_item .= '<option>Tidak ada data Booking pada tanggal ini</option>'  ;
      // echo ' <span style="font-size:12px; color:red"> Tidak ada data Booking pada tanggal ini </span>';
      // die;
    };

    $footer = '</select>';
    $cb_unit = $header.$select_item.$footer;
    echo $cb_unit;
  }






}
?>
