<?php

$erroNome = "";
$erroEmail = "";
$erroSenha = "";
$erroRepeteSenha = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      //Verifica se está vazio o post nome
      if (empty($_POST['nome'])){  //empty = vazio
          $erroNome = "Por favor, preencha o nome.";
      }else{
        //pegar o valor do post e limpar
          $nome = limpaPost($_POST['nome']);

          //verifica se tem somente letra
          if(!preg_match("/^[a-zA-Z-' ]*$/", $nome)){ // aceita letra minuscular e maiuscula de a-Z e apóstrofe
            $erroNome = "Apenas aceitamos letras e espaços!";
          }
      }

    //Verifica se está vazio o post email
    if (empty($_POST['email'])){
      $erroEmail = "Por favor, preencha o e-mail";
    }else{
      $email = limpaPost($_POST['email']);
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $erroEmail = "E-mail invalido!";
      }
    }

    //VERIFICA SE ESTÁ VAZIO O POST SENHA
    if (empty($_POST['senha'])){
      $erroSenha = "Por favor, preencha a senha.";
    }else{
      $senha = limpaPost($_POST['senha']);
      if(strlen($senha) < 6){     /*strlen() - conta quantos caracteres tem em uma string*/
        $erroSenha = "A senha precisa ter no mínimo 6 digitos!";
      }
    }

    //VERIFICA SE ESTÁ VAZIO O POST REPETE SENHA
    if (empty($_POST['repete_senha'])){
      $erroRepeteSenha = "Por favor, preencha a repetição da senha.";
    }else{
      $repete_senha = limpaPost($_POST['repete_senha']);
      if($repete_senha !== $senha){     
        $erroRepeteSenha = "A repetição da senha precisa ser igual a senha!";
      }
    }
 
    //SE NÃO TIVER NENHUM ERRO, ENVIAR PARA PAG OBRIGADO.
    if(($erroNome=="") && ($erroEmail=="") && ($erroSenha=="") && ($erroRepeteSenha=="")){
      header('Location: obrigado.php');
    }

  }

    function limpaPost($valor){
      $valor = trim($valor);
      $valor = stripslashes($valor);
      $valor = htmlspecialchars($valor);
      return $valor;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Formulário</title>
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
    <main>
    <h1><span>Aprendndo fazer validação em PHP</span><br>Validação de Formulário</h1>

     <form method="post">

        <!-- NOME COMPLETO -->
        <label> Nome Completo </label>
        <input type="text" <?php if(!empty($erroNome)){echo "class='invalido'";} ?> name="nome" <?php if (isset($_POST['nome'])){ echo "value='".$_POST['nome']."'";} ?> placeholder="Digite seu nome">
        <br><span class="erro"><?php echo $erroNome; ?></span>

        <!-- EMAIL -->
        <label> E-mail </label>
        <input type="email" <?php if(!empty($erroEmail)){echo "class='invalido'";} ?> name="email" <?php if (isset($_POST['email'])){ echo "value='".$_POST['email']."'";} ?> placeholder="email@provedor.com">
        <br><span class="erro"><?php echo $erroEmail; ?></span>

        <!-- SENHA -->
        <label> Senha </label>
        <input type="password" <?php if(!empty($erroSenha)){echo "class='invalido'";} ?> name="senha" <?php if (isset($_POST['senha'])){ echo "value='".$_POST['senha']."'";} ?> placeholder="Digite uma senha">
        <br><span class="erro"><?php echo $erroSenha; ?></span>

        <!-- REPETE SENHA -->
        <label> Repete Senha </label>
        <input type="password" <?php if(!empty($erroRepeteSenha)){echo "class='invalido'";} ?> name="repete_senha" <?php if (isset($_POST['repete_senha'])){ echo "value='".$_POST['repete_senha']."'";} ?> placeholder="Repita a senha">
        <br><span class="erro"><?php echo $erroRepeteSenha; ?></span>

        <button type="submit"> Enviar Formulário </button>

      </form>
    </main>
</body>
</html>