$().ready(function(){
  var page = $("#page").attr("value");

  // inisiasi data table,
  // jika undefined maka tidak load data table
  if(typeof page != 'undefined'){
    var url_get = page+'/get';
    var url_simpan = page+'/add';
    var url_edit =  page+'/get_for_edit';
    var url_update =  page+'/update';
    var url_hapus =  page+'/delete';
    loadDataTable(url_get);
  } else{
    var page = $("#page_custom").attr("value");
    var url_simpan = page+'/add';
    var url_edit =  page+'/get_for_edit';
    var url_update =  page+'/update';
    var url_hapus =  page+'/delete';
    var url_get = page+'/get';
  }

  $(".input_number").keypress(function(event){
    // alert(event.which);
    return (event.which >= 48 && event.which <= 57) || (event.which >= 96 && event.which <= 105) || event.which == 8 || event.which == 0 ;
  })


// Menampilkan form tambah data
  $('#tambah').click(function(){
    if($('#tabel').is(':visible')){
      $('.add_page').show();
      $('.edit_page').hide();
      $('.edit_protection').prop('readonly', false);
      $('#tabel').toggle( "slide", 'slow', function(){$('#form_tambah').toggle( "slide");});
    } else{
      $('#form_tambah').toggle( "slide", 'slow', function(){$('#tabel').toggle( "slide");});
    }
  });
  $('#cancel').click(function(){
    $('#form_tambah').toggle( "slide", 'slow', function(){$('#tabel').toggle( "slide");});
  });

  // Aksi pada saat tombol edit di klik
  $('body').on('click', '.edit', function() {
    var id = $(this).val();
    edit(id,url_edit);
  });
  // Aksi pada saat tombol hapus di klik
  $('body').on('click', '.hapus', function() {
    var id = $(this).val();
    if (confirm("Yakin untuk menghapus data?")) {
     
      hapus(id,url_hapus,url_get);
   }
  });

  // Aksi pada saat tombol simpan di klik
  $('#simpan').click(function(){
    var valid = true;
    $('.input_validation').each(function() {
      if(!this.value){
        valid = false;
        var lbl = $(this).parent().prev("label").text();
        $.notify({
          title: "Error :",
          message: lbl+" harus diisi!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      $(this).addClass("focus");
   }
  });

  if(valid){
    var data = $('form').serialize();
    simpan(data,url_simpan,url_get);
  }

  });
 // Aksi pada saat tombol update di klik
  $('#update').click(function(){
    // kirim data form berdasarkan nama(property name) inputannya
    var valid = true;
    $('.input_validation').each(function() {
      if(!this.value){
        valid = false;
        var lbl = $(this).parent().prev("label").text();
        $.notify({
          title: "Error :",
          message: lbl+" harus diisi!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      $(this).addClass("focus");
   }
  });

  if(valid){
    var data = $('form').serialize();
    update(data,url_update,url_get);
  }
  });
});

// Aksi pada saat tombol enter ditekan
    $("form").keypress(function (e) {
     if (e.which == 13) {
       e.preventDefault()
       var data = $('form').serialize();;
       if($("#simpan").is(":visible")){
         simpan(data,url_simpan,url_get)
       }
       if($("#update").is(":visible")){
         update(data,url_update,url_get);
       }
     }
 });


 // fungsi inisiasi data table
function loadDataTable(url){
  // $('#dt').DataTable().clear();

$('#dt').dataTable({
  // "bRetrieve":true,
    "destroy": true,
  // "fnClearTable": true,
  "bLengthChange": false,
  "displayLength":10,
  "language": {
          "lengthMenu": "Tampilkan _MENU_ data per halaman ",
          "search": "Cari ",
          "zeroRecords": "Nothing found - sorry",
          "info": "Menampilkan halaman _PAGE_ dari _PAGES_ ",
          "infoEmpty": "Tidak ada data",
          "infoFiltered": "(filtered from _MAX_ total records)"
      },
  "ajax": {
    "url": url,
    "dataSrc": function ( json ) {
      // tambahkan button aksi
      var index_action = json[0].length;
      for ( var i=0, ien=json.length ; i<ien ; i++ ) {
        // masukan aksi kedalam data json
        json[i][index_action] = '<button value="'+json[i][0]+'" class="btn btn-primary edit" ><i class="fa fa-pencil"></i> Edit</button> '+
        '<button value="'+json[i][0]+'" class="btn btn-danger hapus"><i class="fa  fa-trash"></i> Hapus</button>';
        json[i].splice(0,1); // hapus kolom index
      }
      return json;
    }
  },
  "fnInitComplete": function() {
    // this.fnAdjustColumnSizing(true);
    $("#aksi").css("width", "10%");
    // this.fnAdjustColumnSizing(true);
    // aksi setelah berhasil inisiasi data table
  }
});
// $("#aksi").css("width", "10%");
}




// -----------------------------------------------------------------------------------------------------------
// --------------------------------------- DAFTAR FUNGSI -----------------------------------------------------
// -----------------------------------------------------------------------------------------------------------

function edit(id,url_edit){
  $.ajax({
      type: "GET",
      url: url_edit,
      data: {id: id},
      success: function (resdata) {
        $('.edit_page').show();
        $('.edit_protection').prop('readonly', true);
        $('.add_page').hide();
      $('#tabel').toggle( "slide", 'slow', function(){$('#form_tambah').toggle( "slide");});
      var arr = JSON.parse(resdata);
      $.each(arr[0], function(key, value){
        var id_val = key;
        $("#"+id_val).val(value);
      });

      },
      error: function (jqXHR, exception) {
        // pesan error menggunakan notify.js
        $.notify({
          title: "Error :",
          message: "Telah terjadi kesalahan!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      }
  });
}

// fungsi update
function update(data,url_update,url_get){
  $.ajax({
      type: "POST",
      url: url_update,
      data: {data: data},
      success: function (resdata) {
        $.notify({
          title: "Berhasil : ",
          message: "Data telah diupdate",
          icon: 'fa fa-check'
        },{
          type: "success"
        });
          $(".xform")[0].reset();
          loadDataTable(url_get);
          $('#form_tambah').toggle( "slide", 'slow', function(){$('#tabel').toggle( "slide");});
            // location.reload();
      },
      error: function (jqXHR, exception) {
        // pesan error menggunakan notify.js
        $.notify({
          title: "Error :",
          message: "Telah terjadi kesalahan!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      }
  });
}

// fungsi hapus
function hapus(id,url_hapus,url_get){
  $.ajax({
      type: "GET",
      url: url_hapus,
      data: {id: id},
      success: function (resdata) {
        $.notify({
          title: "Berhasil : ",
          message: "Data berhasil dihapus",
          icon: 'fa fa-check'
        },{
          type: "success"
        });
        loadDataTable(url_get);
        //  location.reload();
      },
      error: function (jqXHR, exception) {
        // pesan error menggunakan notify.js
        $.notify({
          title: "Error :",
          message: "Telah terjadi kesalahan!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      }
  });
}

// fungsi simpan
function simpan(data, url_simpan, url_get){
  $.ajax({
      type: "POST",
      url: url_simpan,
      data: {data: data},
      success: function (resdata) {
        $.notify({
          title: "Berhasil : ",
          message: "Data telah ditambahkan",
          icon: 'fa fa-check'
        },{
          type: "success"
        });
          $(".xform")[0].reset();
          loadDataTable(url_get);
          $('#form_tambah').toggle( "slide", 'slow', function(){$('#tabel').toggle( "slide");});
            // location.reload();
      },
      error: function (jqXHR, exception) {
        // pesan error menggunakan notify.js
        $.notify({
          title: "Error :",
          message: "Telah terjadi kesalahan!",
          icon: 'fa fa-check'
        },{
          type: "danger"
        });
      }
  });
}
