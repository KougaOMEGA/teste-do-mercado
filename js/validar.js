/*-----------------------------------------------------------------------*/
/*                                                                       */
/* Nome:           DANIEL SILVA DA CONCEICAO                             */
/*                                                                       */
/*-----------------------------------------------------------------------*/


/*---------------------- função validarCampos() -------------------------*/
/*                                                                       */
/* A função validarCampos() é chamada quando o usuário clica no botão    */
/* Enviar, realizando a chamada de outras funções                        */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarCampos() {

	var msg_error = "";							// DEFINE A VARIÁVEL msg_error COMO VAZIA

	msg_error += validarCodigo();				// CHAMA A FUNÇÃO validarCodigo() E ARMAZENA O ERRO, SE EXISTIR
	msg_error += validarTipo();					// CHAMA A FUNÇÃO validarTipo() E ARMAZENA O ERRO, SE EXISTIR
	msg_error += validarNome();					// CHAMA A FUNÇÃO validarNome() E ARMAZENA O ERRO, SE EXISTIR
	msg_error += validarQuantidade();			// CHAMA A FUNÇÃO validarQuantidade() E ARMAZENA O ERRO, SE EXISTIR
	msg_error += validarPreco();				// CHAMA A FUNÇÃO validarPreco() E ARMAZENA O ERRO, SE EXISTIR

	document.form_mercado.hJsActive.value = "Sim";	// DEFINE A VARIÁVEL OCULTA hJsActive COM O VALOR Sim INDICANDO QUE O JAVASCRIPT ESTÁ FUNCIONANDO
	document.form_mercado.htipoNegocio.value = validarNegocio();	// DEFINE A VARIÁVEL OCULTA htipoNegocio

	if (msg_error.length == 0){					// VERIFICA SE EXISTE ALGUM ERRO
		clearErrors();							// CHAMA A FUNÇÃO clearErrors()
		return true;							// RETORNA TRUE PARA O FORMULÁRIO
	}
	else{
		showErrors(msg_error);					// CHAMA A FUNÇÃO showErrors(msg_error) PASSANDO OS ERROS COMO PARÂMETRO
		return false;							// RETORNA FALSE PARA O FORMULÁRIO
	}

} // Fim da função validarCampos()


/*=======================================================================*/
/*==================  INICIO DA VALIDACAO DOS CAMPOS  ===================*/
/*=======================================================================*/


/*----------------------- funçãoo validarCodigo() -----------------------*/
/*                                                                       */
/* A função validarCodigo() é chamada pela função validarCampos().       */
/* Verifica se o usuário digitou apenas números e a quantidade mínima e  */
/* máxima caracteres de acordo com a regra de negócios (exemplo)		 */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarCodigo() {

	var msg_error = "";		// DEFINE A VARIÁVEL msg_error COMO VAZIA

	var codigo = document.getElementById('codMerca').value.trim(); // RECUPERA O ELEMENTO codMerca E RETIRA OS ESPAÇOS DO INÍCIO E DO FIM
	document.form_mercado.hcodMerca.value = codigo;		// DEFINE A VARIÁVEL OCULTA

	if(codigo.length === 0) {  // VALIDAÇÃO DE EXISTÊNCIA
		msg_error = "<p class='error'><mark>Código da Mercadoria: </mark> # Não pode estar vazio</p>";
	}
	else {
		var specialCharacter = 0;	// DEFINE A VARIÁVEL specialCharacter PARA 0

		for (var i = 0; i < codigo.length; i++) { // FAZ A VALIDAÇÃO DOS CARACTERES DIGITADOS
			if (! ( (codigo.charCodeAt(i) > 47 ) && (codigo.charCodeAt(i) < 58 ) )  ) {
				specialCharacter++;
				break;	
			}
		};

		if (specialCharacter){ // VERIFICA SE FORAM ENCONTRADO CARACTERES ESPECIAIS
			msg_error = "<p class='error'><mark>Código da Mercadoria:</mark># Digite apenas números</p>";
		}
		else{
			if (codigo.length < 5){ // O CODIGO DEVE TER NO MÍNIMO 5 CARACTERES
				msg_error = "<p class='error'><mark>Código da Mercadoria:</mark># Deve ter no mínimo 5 dígitos</p>";
			}
			else{
				if (codigo.length > 10){ // O CODIGO DEVE TER NO MÁXIMO 10 CARACTERES
					msg_error = "<p class='error'><mark>Código da Mercadoria:</mark># Deve ter no máximo 10 dígitos</p>";
				}
			}
		}
	}

	return msg_error; // RETORNA O ERRO, CASO EXISTA

} // Fim da função validarCodigo()


/*----------------------- funcao validarTipo() --------------------------*/
/*                                                                       */
/* A função validarTipo() é chamada pela função validarCampos().         */
/* Verifica se a opção escolhida tipMerca é válida                       */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarTipo() {

	var msg_error = "";		// DEFINE A VARIÁVEL msg_error COMO VAZIA

	var tipo = document.getElementById('tipMerca').value.trim(); // RECUPERA O ELEMENTO tipMerca E RETIRA OS ESPAÇOS DO INÍCIO E DO FIM
	document.form_mercado.htipMerca.value = tipo;		// DEFINE A VARIÁVEL OCULTA

	if (tipo == 0){
		msg_error = "<p class='error'><mark>Tipo da Mercadoria: </mark> # Opção inválida</p>";
	}

	return msg_error; // RETORNA O ERRO, CASO EXISTA

} // Fim da função validarTipo()


/*---------------------- função validarNome() ---------------------------*/
/*                                                                       */
/* A função validarNome() é chamada pela função validarCampos().		 */
/* Verifica se existem números e/ou caracteres especias 				 */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarNome() {

	var msg_error = ""; // DEFINE A VARIÁVEL msg_error COMO VAZIA

	var nome = document.getElementById('nomeMerca').value.trim(); // RECUPERA O ELEMENTO nomeMerca E RETIRA OS ESPAÇOS DO INÍCIO E DO FIM
	document.form_mercado.hnomeMerca.value = nome;		// DEFINE A VARIÁVEL OCULTA
	
	if(nome.length === 0) {  // VALIDAÇÃO DE EXISTÊNCIA
		msg_error = "<p class='error'><mark>Nome da Mercadoria: </mark> # Não pode estar vazio</p>";
	}
	else {
		nome = nome.toLowerCase(); // DEFINE A VARIÁVEL nome PARA CAIXA BAIXA
		var specialCharacter = 0;  // DEFINE A VARÁVEL specialCharacter PARA 0

		for (var i = 0; i < nome.length; i++) { // VALIDAÇÃO DOS CARACTERES
			if (! ( (nome.charCodeAt(i) > 96 ) && (nome.charCodeAt(i) < 123 ))) {
				if (!(nome.charCodeAt(i) == 32)){
					specialCharacter++;
					break;
				}
			}
		};

		if (specialCharacter){ // VERIFICA SE FORAM ENCONTRADO CARACTERES ESPECIAIS
			msg_error = "<p class='error'><mark>Nome da Mercadoria:</mark><br /># Apenas caracteres alfabéticos são permitidos</p>";
		}
		else{
			if (nome.length < 4){ // VERIFICA SE EXISTE AO MENOS 4 CARACTERES
				msg_error = "<p class='error'><mark>Nome da Mercadoria:</mark><br /># Deve ter no mínimo 4 caracteres alfabéticos</p>";
			}
			else{
				if (nome.length > 45){ //VERIFICA SE EXISTE MAIS DO QUE 45 CARACTERES
					msg_error = "<p class='error'><mark>Nome da Mercadoria:</mark><br /># Deve ter no máximo 45 caracteres alfabéticos</p>";
				}
			}
		}
	}

	return msg_error; // RETORNA O ERRO, CASO EXISTA

} // Fim da função validarNome()


/*-------------------- função validarQuantidade() -----------------------*/
/*                                                                       */
/* A função validarQuantidade() é chamada pela função validarCampos()    */
/* Verifica a quantidade digitada										 */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarQuantidade() {

	var msg_error = ""; // DEFINE A VARIÁVEL msg_error COMO VAZIA

	var qtd = document.getElementById('qtd').value.trim(); // RECUPERA O ELEMENTO qtd E RETIRA OS ESPAÇOS DO INÍCIO E DO FIM
	document.form_mercado.hqtd.value = qtd;		// DEFINE A VARIÁVEL OCULTA

	if(qtd.length === 0) { // VALIDAÇÃO DE EXISTÊNCIA
		msg_error = "<p class='error'><mark>Quantidade: </mark> # Não pode estar vazio</p>";
	}
	else {

		var specialCharacter = 0;  // DEFINE A VARÁVEL specialCharacter PARA 0
		for (var i = 0; i < qtd.length; i++) { // VALIDAÇÃO DOS CARACTERES
			if (! ( (qtd.charCodeAt(i) > 47 ) && (qtd.charCodeAt(i) < 58 ) )  ) {
				specialCharacter++;
				break;
			}
		};

		if (specialCharacter){ // VERIFICA SE FORAM ENCONTRADO CARACTERES ESPECIAIS
			msg_error = "<p class='error'><mark>Quantidade:</mark># Digite apenas números</p>";
		}
		else{
			if (qtd < 1){ // VERIFICA SE A QUANTIDADE DIGITADA É NEGATIVA
				msg_error = "<p class='error'><mark>Quantidade:</mark># Deve ser maior do que 0</p>";
			}
			else{
				if (qtd > 30){ // VERIFICA SE A QUANTIDADE DIGITADA É MAIOR QUE 30
					msg_error = "<p class='error'><mark>Quantidade:</mark># Deve ser menor que 30</p>";
				}
			}
		}	
	}

	return msg_error; // RETORNA O ERRO, CASO EXISTA

} // Fim da função validarQuantidade()


/*----------------------- função validarPreco() -------------------------*/
/*                                                                       */
/* A função validarPreco() é chamada pela função validarCampos()         */
/* Valida a existência													 */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarPreco() {

	var msg_error = ""; // DEFINE A VARIÁVEL msg_error COMO VAZIA

	var preco = document.getElementById('preco').value.trim(); // RECUPERA O ELEMENTO preco E RETIRA OS ESPAÇOS DO INÍCIO E DO FIM
	document.form_mercado.hpreco.value = preco;		// DEFINE A VARIÁVEL OCULTA

	if(preco.length === 0) { // VALIDAÇÃO DE EXISTÊNCIA
		msg_error = "<p class='error'><mark>Preço: </mark> # Não pode estar vazio</p>";
	}

    return msg_error; // RETORNA O ERRO, CASO EXISTA

} // Fim da função validarPreco()


/*-------------------- função validarNegocio() --------------------------*/
/*                                                                       */
/* A função validarNegocio() é chamada pela função validarCampos()       */
/* Verifica qual opção foi selecionada COMPRA ou VENDA		     		 */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function validarNegocio(){
	var rads = document.getElementsByName("tipo_negocio");

	for(var i = 0; i < rads.length; i++){
		if(rads[i].checked){
			return rads[i].value;
		}
	}

}// Fim da função validarNegocio()

/*=======================================================================*/
/*=================  FIM DA VALIDAÇÃO DOS CAMPOS     ====================*/
/*=======================================================================*/


/*----------------------- função showErrors() ---------------------------*/
/*                                                                       */
/* A função showErrors() mostra todos os erros, quando existentes        */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function showErrors(msg) { 

	document.getElementById('errors').innerHTML=  "<legend>ATENÇÃO!</legend> <br /> VERIFIQUE O(S) SEGUINTE(S) CAMPO(S) <br /><br />" + msg ; // INSERE OS ERROS DENTRO DA DIV ID="errors"

} // Fim da função showErrors()


/*----------------------- função clearErrors() --------------------------*/
/*                                                                       */
/* A função clearErrors() limpa todos os erros, quando existentes        */
/*                                                                       */
/*-----------------------------------------------------------------------*/
function clearErrors() { 

	document.getElementById('errors').innerHTML=  "" ; // APAGA TODOS OS ERROS

} // Fim da função clearErrors()