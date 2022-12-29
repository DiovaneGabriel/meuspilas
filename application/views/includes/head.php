<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="icon" href="<?php echo base_url(); ?>favicon.ico" type="image/gif">
    <link href="<?php echo base_url('assets/css/main.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/plugins/morris.css'); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('assets/css/plugins/sb-admin-2.css'); ?>" rel="stylesheet" type="text/css">

	<?php if($currentArea != 'login'):?>
    	<link href="<?php echo base_url('assets/css/plugins/metisMenu.min.css'); ?>" rel="stylesheet" type="text/css">
    	<link href="<?php echo base_url('assets/font-awesome-4.4.0/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">
    	<link href="<?php echo base_url('assets/css/plugins/timeline.css'); ?>" rel="stylesheet" type="text/css">
    	<link href="<?php echo base_url('assets/fancyapps-fancyBox-18d1712/jquery.fancybox.css?v=2.1.5'); ?>" rel="stylesheet" type="text/css">
    	<link href="<?php echo base_url('assets/fancyapps-fancyBox-18d1712/helpers/jquery.fancybox-buttons.css?v=1.0.5'); ?>" rel="stylesheet" type="text/css">
    	<link href="<?php echo base_url('assets/fancyapps-fancyBox-18d1712/helpers/jquery.fancybox-thumbs.css?v=1.0.7'); ?>" rel="stylesheet" type="text/css">
    <?php endif;?>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    
    <title>Meus Pilas</title>
</head>