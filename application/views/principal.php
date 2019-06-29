<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>SIGERE-2019</title>
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/js/plugins/dataTable/datatables.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css">
	
	<!--<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/styles.css?">-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/main.css?">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

</head>
<body>
	<script src="<?php echo base_url() ?>assets/js/jquery-3.3.1.min.js" type="text/javascript"></script>
	<!--<script>var active = '<?echo $view ?>';  var base_url = '<?echo base_url() ?>'; ?></script>-->
	<script> var base_url = '<?echo base_url() ?>'</script>
	<nav class="navbar navbar-dark fixed-top  flex-md-nowrap p-0 shadow" style="background-color:#7cb342;" >
		<!-- <span class="navbar-brand col-sm-3 col-md-2 mr-0 titleMenu">Academia Eddy Music</span> -->
		<span class="navbar-brand pl-2 pr-3 titleMenu">Ecopoop Cali SAS</span>
		<!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Buscar" aria-label="Search"> -->
		<form class="form-inline my-2 my-lg-0">
      		<input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Search">
      		<button class="btn btn-outline-dark my-2 my-sm-0 bg-light" type="submit">Buscar</button>
    	</form>
		<button class="navbar-toggler" style="background-color:grey;" id="toggleMenu" data-status="0">
			<span class="navbar-toggler-icon"></span>
		</button>
	</nav>
	<div class="container-fluid">
		<div class="row">
			<?php require __DIR__.'/sidebar.php'; ?>
			<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 px-sm-1">
			 <?php require __DIR__.'/'.$view.'.php'; ?>
			</main>
		</div>
	</div>
	<!--<script>
	var level = '<? echo $level ?>';
	</script>-->
	<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/dataTable/datatables.min.js"></script>
	<script src="<?php echo base_url() ?>assets/js/plugins/jquery-number/jquery.number.min.js"></script>
	
	</body>
</html>