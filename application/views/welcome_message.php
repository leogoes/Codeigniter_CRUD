<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="<?php echo base_url('DoctorCRUD/assets/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('DoctorCRUD/assets/css/nav-bar.css'); ?>">
	<title>Relação de doutores</title>
</head>
<body>
	<!--INICIO Barra de navegação para consulta e CRUD -->
	<div class="box-one">
		<?php $this->load->view('nav-bar') ?>
	</div>
	<!--FIM Barra de navegação para consulta e CRUD -->
	<!--INICIO Barra de navegação para consulta e CRUD -->
	<div class="box-two">
		<?php $this->load->view('layout-page') ?>
	</div>
	<!--FIM Barra de navegação para consulta e CRUD -->

</body>
</html>