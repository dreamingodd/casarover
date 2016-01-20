<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="../../website/css/bootstrap-responsive.min.css" rel="stylesheet" />
<link href="../../website/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<link href="css/all.css" rel="stylesheet" media="screen" />
<script src="../js/integration/bootstrap.min.js"></script>
<script src="../js/integration/jquery.min.js"></script>
<script src="js/all.js"></script>
<title>Error</title>
</head>

<body>
<br/>
<div class="alert alert-danger" role="alert">
    <?php 
    echo 'ERROR: '.$_GET['info'];
    ?>
</div>
</body>
</html>