<body class="hold-transition skin-purple-light sidebar-mini fixed">
<div class="wrapper" style="overflow:auto">
<?php $this->load->view('template_body_header'); ?>
  <!-- Left side column. contains the logo and sidebar -->
<?php $this->load->view('template_body_sidebar'); ?>
  <!-- Content Wrapper. Contains page content -->
<?php $this->load->view($page); ?>

</div>

<!-- jQuery 3 -->


<script src="<?php echo base_url() ?>/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>/AdminLTE/dist/js/adminlte.min.js"></script>

   <script src="<?php echo base_url() ?>js/bootstrap-notify.min.js"></script>
   <script src="<?php echo base_url() ?>js/khrsman-pagination.js"></script>
   <script src="<?php echo base_url() ?>js/khrsman-process.js"></script>
   <!-- <script src="<?php echo base_url() ?>js/process.js"></script> -->


      <script src="<?php echo base_url() ?>js/jquery.dataTables.min.js"></script>
   <link href="<?php echo base_url() ?>css/jquery.dataTables.min.css" rel="stylesheet">
</body>
