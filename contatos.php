<?php
$nome="";
$telefone="";
$celular="";
$email="";
$obs="";
$botao="Inserir";

//programação para inserir no xml
if (isset($_GET["btnsalvar"]))
{  
	//variaveis que vieram via 
	//GET no botao Salvar
	$nome=$_GET["txtnome"];
	$telefone=$_GET["txttelefone"];
	$celular=$_GET["txtcelular"];
	$email=$_GET["txtemail"];
	$obs=$_GET["txtobs"];
    
    $nome_arquivo = "dados.json";
    
    //abre para escrita um arquivo de dados, caso ele não exista a biblioteca fopen cria
    $arquivo = fopen($nome_arquivo, "w");
    
    
    //Criamos uma variavel do tipo matriz para guardar os dados do formulario
    //OBS: poderia ser um select com varios dados do banco (loop)
    
    $array_dados = array(
        'nome' => $nome,
        'telefone' => $telefone,
        'celular' => $celular,
        'email' => $email,
        'obs' => $obs        
    );
    
    
    //o fwrite permite escrever dentro de um arquivo
    //o json_encode converte de uma matris para o formato json
    fwrite($arquivo,json_encode($array_dados));
    
    fclose($arquivo);
	
	
    

}	

?>


<html>

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div id="principal">
	
    
     <div id="conteudo">
    	<div id="cadastro">
        	
            <form name="frmcontatos" method="get" action="contatos.php">
            
                <table id="tblcadastro">
                  <tr>
                    <td colspan="2">Gerando JSON</td>
                  </tr>
                  <tr>
                    <td>Nome:</td>
                    <td><input class="caixa" name="txtnome" type="text"   value="<?php echo($nome) ?>" required /></td>
                  </tr>
                  <tr>
                    <td>Telefone:</td>
                    <td><input class="caixa" name="txttelefone" type="text"  value="<?php echo($telefone) ?>" /></td>
                  </tr>
                  <tr>
                    <td>Celular:</td>
                    <td><input class="caixa" name="txtcelular" type="text" value="<?php echo($celular) ?>" /></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><input class="caixa" name="txtemail" type="text" value="<?php echo($email) ?>" required /></td>
                  </tr>
                  <tr>
                    <td>Obs:</td>
                    <td><textarea name="txtobs" cols="20" rows="5"><?php echo($obs) ?></textarea></td>
                  </tr>
                  <tr>
                    <td><input name="btnsalvar" type="submit" value="<?php echo($botao) ?>" /></td>
                    <td><input name="btnlimpar" type="reset" value="Limpar" /></td>
                  </tr>
                </table>
            
            </form>

        </div>
        <div id="consulta">
        	<table id="tblconsulta">
              <tr>
                <td colspan="5">Consulta JSON</td>
              </tr>
              <tr>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Celular</td>
                <td>Email</td>
				<td>Obs</td>
               
              </tr>
			  <?php 
                $url = "http://localhost/inf3m20182/TURMAB/Leonardo/XML_JSON/JSon/dados.json";
                            
                //executa uma requisição http para obter dados de um arquivo json               
                $arquivo_json = file_get_contents($url);
                               
                //pegar o json e converte para matriz                
                $dados_array = json_decode($arquivo_json);
                               
                var_dump($dados_array);
                
                $i = 0;                       
                while($i < count($dados_array)){
			  ?>
				  <tr>
					<td><?php echo($dados_array -> nome)?></td>
					<td><?php  echo($dados_array -> telefone)?></td>
					<td><?php  echo($dados_array -> celular)?></td>
					<td><?php  echo($dados_array -> email)?></td>
					<td><?php  echo($dados_array -> obs)?></td>
					
				  </tr>
            <?php 
                    //faz o array ir pra proxima linha
                    next($dados_array);
                    $i++; 
                }
			?>
            </table>

        </div>
           
    </div>
    

    
</div>

</body>
</html>



