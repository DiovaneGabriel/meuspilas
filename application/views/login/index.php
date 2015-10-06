<?php $this->load->view('includes/head'); ?>
<body>
<div class="centralizar">
	<div>
		<div class='notifications top-center' ></div>
	</div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login</h3>
                    </div>
                    <div class="panel-body">
                        <form action="<?php echo base_url('login/entrar'); ?>" method="POST">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

   <?php $this->load->view('includes/footer'); ?>
    
    <?php if(isset($_SESSION['message'])):?>
    
    	<script>
    	$.notify({
    		// options
    		message: '<?php echo $_SESSION['message'];?>',
//     		url: 'https://github.com/mouse0270/bootstrap-notify',
    		target: '_blank'
    	},{
    		// settings
    		type: "danger",
    		placement: {
    			from: "top",
    			align: "center"
    		},
    		mouse_over: 'pause'
    	});
    	</script>
  	
    <?php unset($_SESSION['message']);
    	endif;?>
</body>

</html>
