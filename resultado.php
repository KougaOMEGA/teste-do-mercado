<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initinal-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="js/validar.js" type="text/javascript"></script>
	<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

	<?php 

	$codMerca = $_POST["hcodMerca"];
	$tipMerca = $_POST["htipMerca"];
	$nomeMerca = $_POST["hnomeMerca"];
	$tipNegocio = $_POST["htipoNegocio"];


	$qtd = Getfloat($_POST["hqtd"]);
	$preco = Getfloat($_POST["hpreco"]);
	$total = $qtd * $preco;

	function Getfloat($str) { 
  		if(strstr($str, ",")) { 
    		$str = str_replace(".", "", $str); // TROCA "." POR VAZIO
    		$str = str_replace(",", ".", $str); // TROCA ',' POR '.' 
  		} 
  		return $str;
  	}

  	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
  	$servidor = 'mysql.hostinger.com.br';
  	$banco = 'u365136324_merca';
  	$usuario = 'u365136324_user';
  	$senha = 'cadastro';
  	$link = mysql_connect($servidor, $usuario, $senha);
  	$db = mysql_select_db($banco,$link);
  	if(!$link){
  		echo "erro ao conectar ao banco de dados!";exit();
  	}

  	$sql = "INSERT INTO `PEDIDO_CLIENTE`(`cod_mercadoria`, `tip_mercadoria`, `nom_mercadoria`, `qtd_mercadoria`, `vrl_mercadoria`, `tip_negocio`) 
  			VALUES ('$codMerca','$tipMerca','$nomeMerca','$qtd','$total','$tipNegocio')";
  	
  	mysql_query($sql,$link);

	$total = number_format($total, 2, ',', '.');
	
	mysql_close($link);

	?>

	<nav><p>Valores Recebidos</p></nav>
	
  	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form name="form_mercado" id="form_mercado" class="form-horizontal" method="get" oninput="codMerca.value=hcodMerca" >
			    	<div class="form-group">
			    		<label for="codMerca" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Código da Mercadoria:</label>
			    		<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
			    			<output type="text" class="form-control" name="codMerca" readonly><?php echo $_POST["hcodMerca"]?></output>
			    		</div>
			    	</div>
			 
			    	<div class="form-group">
						<label class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label" for="tipMerca">Tipo da Mercadoria:</label>
						<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
					  		<output type="text" class="form-control" id="tipMerca" readonly><?php echo $_POST["htipMerca"]?></output>
						</div>
					</div>

			    	<div class="form-group">
			    		<label for="nomeMerca" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Nome da Mercadoria:</label>
			    		<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
			    			<output type="text" class="form-control" id="nomeMerca" readonly><?php echo $_POST["hnomeMerca"]?></output>
			    		</div>
			    	</div>

			    	<div class="form-group">
			    		<label for="qtd" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Quantidade:</label>
			    		<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3">
			    			<output type="text" class="form-control" id="qtd" readonly><?php echo $_POST["hqtd"]?></output>
			    		</div>
			    	</div>

			    	<div class="form-group"> 
			    		<label for="preco" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Preço:</label>
			    		<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3">
			    			<output type="text" class="form-control" id="preco" readonly>R$ <?php echo $total?></output>
			    		</div>
			    	</div>

					<div class="form-group">
						<label class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label" for="tipo_negocio">Tipo do Negócio:</label>
						<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3"> 
							<output type="text" class="form-control" id="tipo_negocio" readonly><?php echo $_POST["htipoNegocio"]?></output>
					 	</div>
					</div>

					<div class="form-group">
						<label class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label" for="javascript">JavaScript Ativado:</label>
						<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3"> 
							<output type="text" class="form-control" id="javascript" readonly><?php echo $_POST["hJsActive"]?></output>
					 	</div>
					</div>
		    	
			    	<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
			    		<button type="button" class="btn btn-primary" onClick="history.go(-1)">Voltar</button> 
			    	</div>

			    </form>
	    	</div>
	    </div>
    </div>



    <div class="table-responsive">

    	<h2>Pedidos Cadastrados</h2>

    	<?php 

    	error_reporting (E_ALL & ~ E_NOTICE & ~ E_DEPRECATED);
  		$servidor = 'mysql.hostinger.com.br';
  		$banco = 'u365136324_merca';
  		$usuario = 'u365136324_user';
  		$senha = 'cadastro';
  		$link = mysql_connect($servidor, $usuario, $senha);
  		$db = mysql_select_db($banco,$link);
  		if(!$link){
  			echo "erro ao conectar ao banco de dados!";exit();
  		}

    	$sql = "SELECT * FROM PEDIDO_CLIENTE";
		$result = mysql_query($sql, $link) or die ('Ocorreu um erro ao obter os dados');
			
		if (mysql_num_rows($result) > 0) {

			echo "<table class='table table-striped table-bordered table-hover table-condensed'>";
			echo "    <tr>";
			echo "        <td>";
			echo "            Código da Mercadoria";
			echo "        </td>";
			echo "        <td>";
			echo "            Tipo da Mercadoria";
			echo "        </td>";
			echo "        <td>";
			echo "            Nome da Mercadoria";
			echo "        </td>";
			echo "        <td>";
			echo "            Quantidade da Mercadoria";
			echo "        </td>";
			echo "        <td>";
			echo "            Tipo da Mercadoria";
			echo "        </td>";
			echo "        <td>";
			echo "            Tipo do Negócio";
			echo "        </td>";
			echo "    </tr>";

    		while($dados = mysql_fetch_assoc($result)) {

    			echo "<tr>";
    			echo "   <td>";
    			echo        $dados["cod_mercadoria"];
    			echo "   </td>";
    			echo "   <td>";
    			echo        $dados["tip_mercadoria"];
    			echo "   </td>";
    			echo "   <td>";
    			echo        $dados["nom_mercadoria"];
    			echo "   </td>";
    			echo "   <td>";
    			echo        $dados["qtd_mercadoria"];
    			echo "   </td>";
    			echo "   <td>";
    			echo        $dados["vrl_mercadoria"];
    			echo "   </td>";
    			echo "   <td>";
    			echo        $dados["tip_negocio"];
    			echo "   </td>";
    			echo "</tr>";

    		}
		} else {
    		echo "0 results";
		}

		mysql_close($link);


    	?>


    </div>

</body>
</html>
