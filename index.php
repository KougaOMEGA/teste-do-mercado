<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="js/validar.js" type="text/javascript"></script>
	<script src="js/progress.js" type="text/javascript"></script>
	<script src="js/jquery.maskMoney.js" type="text/javascript"></script>
	<link rel="stylesheet" href="css/style.css">

</head>
<body>

	<nav><p>Teste do Mercado</p></nav>

	<div class="container">

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<form name="form_mercado" id="form_mercado" class="form-horizontal" method="post" onsubmit="return validarCampos();" action="resultado.php">
					<div class="form-group">
						<label for="codMerca" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Código da Mercadoria:</label>
						<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
							<input type="text" class="form-control required" id="codMerca" placeholder="Digite o código da mercadoria"/>
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label" for="tipMerca">Tipo da Mercadoria:</label>
						<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
							<select id="tipMerca" name="tipMerca" class="form-control required">
								<option value="0">--Selecione um tipo--</option>
								<option value="1">Tipo 1</option>
								<option value="2">Tipo 2</option>
								<option value="3">Tipo 3</option>
								<option value="4">Tipo 4</option>
								<option value="5">Tipo 5</option>
								<option value="6">Tipo 6</option>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label for="nomeMerca" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Nome da Mercadoria:</label>
						<div class="col-xs-9 col-sm-9 col-md-5 col-lg-5">
							<input type="text" class="form-control required" id="nomeMerca" placeholder="Digite o nome da mercadoria" />
						</div>
					</div>

					<div class="form-group">
						<label for="qtd" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Quantidade:</label>
						<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3">
							<input type="number" class="form-control required" id="qtd" placeholder="1" min="1" />
						</div>
					</div>

					<div class="form-group">
						<label for="preco" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label">Preço:</label>
						<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3">
							<input type="text" class="form-control required" id="preco" placeholder="R$ 0,00" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-xs-3 col-sm-3 col-md-3 col-lg-3 control-label" for="tipo_negocio">Tipo do Negócio:</label>
						<div class="col-xs-9 col-sm-7 col-md-3 col-lg-3"> 
							<label class="radio-inline" for="tipo_negocio-0">
								<input type="radio" name="tipo_negocio" id="tipo_negocio-0" value="COMPRA" checked="checked">COMPRA
							</label> 
							<label class="radio-inline" for="tipo_negocio-1">
								<input type="radio" name="tipo_negocio" id="tipo_negocio-1" value="VENDA">VENDA
							</label>
					 	</div>
					</div>

					<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3 col-sm-offset-3 col-md-offset-3 col-lg-offset-3">
						<button type="submit" class="btn btn-primary">Enviar</button> <button type="reset" onClick="clearErrors();" class="btn btn-default">Limpar</button>
					</div>

					<!-- VARIÁVEIS OCULTAS QUE SERÃO PASSADAS COMO PARÂMETRO -->
					<input name="hcodMerca"		value="0"		type="hidden" />
					<input name="htipMerca"		value="0"		type="hidden" />
					<input name="hnomeMerca"	value="0"		type="hidden" />
					<input name="hqtd"			value="0"		type="hidden" />
					<input name="hpreco"		value="0"		type="hidden" />
					<input name="htipoNegocio"	value="0"		type="hidden" />
					<input name="hJsActive"		value="Nao"		type="hidden" />
					<!-- A VARIÁVEL hJsActive É IMPORTANTE POIS COM ELA É POSSÍVEL SABER SE O JAVASCRIPT ESTÁ DESATIVADO, NESSE 
					CASO O SERVIDOR PODE REALIZAR UMA NOVA VALIDAÇÃO DOS CAMPOS EVITANDO QUE O USUÁRIO BURLE O SISTEMA -->

				</form>
			</div>
		</div>

		<fieldset>
			<div  id="errors"></div>
		</fieldset>
	</div>

	<script>
		// FUNÇÃO PARA DEIXAR OS CAMPOS EM CAIXA ALTA
		$(document).ready(function () { 
			$("input[type=text]").blur(function () {
				$(this).val($(this).val().toUpperCase());
			});
		})

		// FUNÇÃO PARA MOSTRAR O PROGRESS BAR DE ACORDO COM O PREENCHIMENTO DO FORM
		$(document).ready(function() {
			$('#form_mercado').showProgress();
		});

		// FUNÇÃO PARA FORMATAR O CAMPO PREÇO
		$(function() {
			$("#preco").maskMoney({prefix:'R$ ', allowNegative: false, thousands:'.', decimal:',', affixesStay: false});
		})
	</script>

</body>
</html>