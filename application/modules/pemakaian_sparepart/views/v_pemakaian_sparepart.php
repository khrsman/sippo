    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Pemakaian Sparepart</h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">pemakaian sparepart</li>
            </ol>
        </section>
        <section class="content">
          <button class="btn bg-orange" id="page_data" style="margin-bottom:10px"><span class="fa fa-bars"></span> Data Pemakaian Sparepart</button>
          <button class="btn bg-orange" id="page_tambah" style="margin-bottom:10px"><span class="fa fa-plus"></span> Tambah Pemakaian Sparepart</button>
          <div class="" id="page_content">
        </div>
</section>

<script type="text/javascript">

$(document).ready(function(){
editor_page();
})

$("#page_tambah").click(function(){
  editor_page();
})
$("#page_data").click(function(){
data_page();
})
</script>
