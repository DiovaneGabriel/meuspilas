<?php $this->load->view('includes/head');?>
<body>
	<div style="width: 350px; height: 300px;">
		<form action="<?php echo base_url('movimentos/salvar') ?>" method="POST" enctype="multipart/form-data">
			<input name="movimento_id" type="hidden">
			<input name="movimento_entrada_saida" type="hidden" value="<?php echo $entradaSaida;?>">
			<input name="movimento_valor" type="text" class="form-control" placeholder="Quanto?">
			<input name="movimento_descricao" class="form-control" placeholder="O que?">
			<input name="movimento_data" type="date" class="form-control" placeholder="Quando?">
		</form>
	</div>
<?php $this->load->view('includes/footer'); ?>
</body>
</html>