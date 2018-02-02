<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_booking');
    }

    // view
    function index(){
    $data['page'] = 'v_booking';
    $this->load->view('v_main',$data);
    }

    function data(){
    $this->load->view('v_booking_data');
    }

    function editor(){
      $kode_booking = $this->M_booking->get_kode_booking();
      if (is_null($kode_booking)){
        $data['kode_booking'] = 1;
      } else{
        $data['kode_booking'] = $kode_booking;
      }
    $this->load->view('v_booking_editor',$data);
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

      $data = $this->M_booking->get_data($search,$from_page,$per_page); // ambil data
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
      $data = $this->M_booking->get($id);
      echo json_encode($data);
    }

    function add(){

        $data = array();
        parse_str($_POST['data'], $data);

        $id_booking = $data['id_booking'];
        $detail_booking = array();
        $data_perunit = array();

        #data untuk tabel booking_detail
        $tanggal_unit = $data['tanggal_unit'];
        foreach ($tanggal_unit as $key => $value) {
          foreach ($value as $keyy => $valuee) {
            $detail_booking[$key]['id_booking'] = $id_booking;
            $detail_booking[$key]['tanggal'] =  DateTime::createFromFormat('d-m-Y', $keyy)->format('Y-m-d');
            $detail_booking[$key]['id_unit'] = $valuee;
          }
        }

        $data_harga = $data['harga_perunit'];

      #data untuk tabel detail harga perunit
        foreach ($data_harga as $key => $value) {
          $data_perunit[$key]['id_unit'] = $key;
          $data_perunit[$key]['harga'] = $value;
          $data_perunit[$key]['id_booking'] = $id_booking;

        }
        #keluarkan data dari array data yang akan diinsert ke tabel booking
        unset($data['harga_perunit']);
        unset($data['tanggal_unit']);


        $insert = $this->M_booking->insert($data,$data_perunit,$detail_booking);

    }

    // fungsi update
    function update(){
      $data = array();
      parse_str($_POST['data'], $data);
      $id = $data['id_booking'];
      $update = $this->M_booking->update_by_id($data,$id);
    }

    // fungsi hapus
    function delete(){
      $id = $this->input->post('id');
      $delete = $this->M_booking->delete_by_id($id);
    }

    function select_unit(){
      $date = $this->input->get('date');
      $header = '<select multiple class="form-control tanggal_unit " name="tanggal_unit[]['.$date.']" id="tanggal_unit">';
      $select_item = '';
      $footer = '</select>';
      $data = $this->db->get('unit')->result_array();
      foreach ($data as $key => $value) {
        $select_item .= '<option value="'.$value['id_unit'].'" class="disabledunit">'.$value['seri'].'</option>'  ;
      }
      $footer = '</select>';
      $cb_content = $header.$select_item.$footer;
      echo $cb_content;
    }

    function jadwal(){
      $data['page'] = 'v_jadwal';
      $this->load->view('v_main',$data);
    }

    function view_jadwal(){
    // print_r($this->input->post());
    // die;
    $data['bulan'] = $this->input->post('bulan');
    $data['tahun'] = $this->input->post('tahun');
    $this->load->view('v_jadwal_table',$data);
  }

  function detail_jadwal(){
    $id = $this->input->get('id');
    $data = $this->M_booking->get_detail_jadwal($id);
    echo json_encode($data);
  }

  function get_unit_booking(){

    $id = $this->input->get('id');

    $header = '<select class="form-control input_validation" name="id_unit" id="id_unit">
    <option selected="">--- PILIH ---</option>';
  $select_item = '';
  $footer = '</select>';

  $this->db->join('unit','id_unit');
  $this->db->where('id_booking',$id);
  $data = $this->db->get('detail_booking_unit')->result_array();
  foreach ($data as $key => $value) {
    $select_item .= '<option value="'.$value['id_unit'].'">'.$value['seri'].'</option>'  ;
  }
  // echo $this->db->last_query();
  $footer = '</select>';
  $cb_unit = $header.$select_item.$footer;
  $this->db->select('DATE_FORMAT(min(tanggal), "%d/%m/%Y") tanggal_dari,
                    DATE_FORMAT(max(tanggal), "%d/%m/%Y") tanggal_sampai');
   $query =   $this->db->where('id_booking',$id)->get('detail_booking')->result_array()[0];
  $tanggal = $query['tanggal_dari']." - ". $query['tanggal_sampai']  ;
  echo json_encode(array('select' => $cb_unit, 'tanggal' => $tanggal));


  }




}
?>
