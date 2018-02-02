    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Detail pembelian</h1>
            <h4>No Faktur: <span id="detail_id_faktur_pembelian"><?php echo $id_faktur_pembelian ?> </span></h4>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">detail_pembelian</li>
            </ol>
        </section>
        <section class="content">
          <div class="" id="page_content">
        </div>
</section>


<script type="text/javascript">

$(document).ready(function(){
  var request = $.get("<?php echo base_url(); ?>detail_pembelian/data");
  request.done(function(data) {
      $("#page_content").html(data);
  });
})
</script>
