<?php
include "conexao.php";

// Inserir novo pedido/recado
if(isset($_POST['cadastra'])){
    $nome  = mysqli_real_escape_string($conexao, $_POST['nome']);
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $msg   = mysqli_real_escape_string($conexao, $_POST['msg']);

    $sql = "INSERT INTO recados (nome, email, mensagem) VALUES ('$nome', '$email', '$msg')";
    mysqli_query($conexao, $sql) or die("Erro ao inserir dados: " . mysqli_error($conexao));
    header("Location: mural.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8"/>
<title>Mural de recados</title>
<link rel="stylesheet" type="text/css" href="mural.css">
<script src="scripts/jquery.js"></script>
<script src="scripts/jquery.validate.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<script>
$(document).ready(function() {
    $("#mural").validate({
        rules: {
            nome: { required: true, minlength: 4 },
            email: { required: true, email: true },
            msg: { required: true, minlength: 10 }
        },
        messages: {
            nome: { required: "Digite o seu nome", minlength: "O nome deve ter no mínimo 4 caracteres" },
            email: { required: "Digite o seu e-mail", email: "Digite um e-mail válido" },
            msg: { required: "Digite sua mensagem", minlength: "A mensagem deve ter no mínimo 10 caracteres" }
        }
    });
});
</script>
</head>
<a href="index.php" id="btn-voltar">
    <i class="fa-solid fa-arrow-left"></i>
</a>

<body>
    <div class="background-blur"></div>
<div id="main">
<div id="geral">
<div id="header">
    <h1>Mural de Recados</h1>
</div>

<div id="formulario_mural">
<form id="mural" method="post">
    <label>Nome:</label>
    <input type="text" name="nome"/><br/>
    <label>Email:</label>
    <input type="text" name="email"/><br/>
    <label>Mensagem:</label>
    <textarea name="msg"></textarea><br/>
    <input type="submit" value="Publicar no Mural" name="cadastra" class="btn"/>
</form>
</div>

<?php
$seleciona = mysqli_query($conexao, "SELECT * FROM recados ORDER BY id DESC");
while($res = mysqli_fetch_assoc($seleciona)){
    echo '<ul class="recados">';
    echo '<li><strong>ID:</strong> ' . $res['id'] . '</li>';
    echo '<li><strong>Nome:</strong> ' . htmlspecialchars($res['nome']) . '</li>';
    echo '<li><strong>Email:</strong> ' . htmlspecialchars($res['email']) . '</li>';
    echo '<li><strong>Mensagem:</strong> ' . nl2br(htmlspecialchars($res['mensagem'])) . '</li>';
    echo '</ul>';
}
?>

<footer class="footer">
    <div class="footer-content">
        ★ Algo a nos reportar? Contate-nos!<br>
        <p><i class="fa-solid fa-envelope"></i> Email: contato@muralmagico.com</p>
        </p>
        <p>&copy; 2025 Mural Mágico ★ Todos os direitos reservados.</p>
        </div>
</footer>
</div>
</div>
</div>
</body>
</html>
