<?php $this->load->view('includes/head');?>
<body>
	<div align="center" style="width: 350px; height: 300px;">
		<h3><?php echo $titulo;?></h3>
		<form action="<?php echo base_url('movimentos/salvar') ?>" method="POST" enctype="multipart/form-data">
			<input name="movimento_id" type="hidden">
			<input name="movimento_entrada_saida" type="hidden" value="<?php echo $entradaSaida;?>">
			<input name="movimento_valor" type="text" class="form-control" placeholder="Quanto?"></br>
			<input name="movimento_descricao" class="form-control" placeholder="O que?"></br>
			<input name="movimento_data" type="date" class="form-control" placeholder="Quando?"></br>
			<select name="movimento_conta_id" class="form-control" required="required">
			  <option value=""></option>
			  <?php foreach ($contas as $conta):?>
				  <option value="<?php echo $conta->id?>"><?php echo $conta->descricao;?></option>
			  <?php endforeach;?>
			</select></br>
			<button type="submit" class="btn btn-default" onclick="javascript:parent.jQuery.fancybox.close();">Submit Button</button>
		</form>
	</div>
<?php $this->load->view('includes/footer'); ?>
</body>
</html>