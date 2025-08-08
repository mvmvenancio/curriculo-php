<?php
$mensagem_sucesso = ""; // Mensagem de sucesso
$mensagem_erro = "";   // Mensagem de erro

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $nome = htmlspecialchars(trim($_POST["nome"]));
    $sobrenome = htmlspecialchars(trim($_POST["sobrenome"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $proposta = htmlspecialchars(trim($_POST["proposta"]));

    // Validação básica dos dados
    if (!empty($nome) && !empty($sobrenome) && !empty($email) && !empty($proposta) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Endereço de e-mail para onde a mensagem será enviada
        $destinatario = "seu_email@exemplo.com"; 
        $assunto = "Nova Proposta de Emprego de " . $nome . " " . $sobrenome;
        $corpo_email = "Nome: " . $nome . " " . $sobrenome . "\n"
                     . "Email: " . $email . "\n"
                     . "Proposta:\n" . $proposta;

        $headers = "From: " . $email . "\r\n" .
                   "Reply-To: " . $email . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        // Envia o e-mail
        if (mail($destinatario, $assunto, $corpo_email, $headers)) {
            $mensagem_sucesso = "Sua proposta foi enviada com sucesso!";
        } else {
            $mensagem_erro = "Ocorreu um erro ao enviar a mensagem. Por favor, tente novamente.";
        }
    } else {
        $mensagem_erro = "Por favor, preencha todos os campos corretamente.";
    }
}
?>

<section class="contato" id="contato">
  <form id="contato-form" action="index.php#contato" method="post">
    <h2><b>Contato</b><br></h2>
    <?php if ($mensagem_sucesso): ?>
      <p style="color: green;"><?php echo $mensagem_sucesso; ?></p>
    <?php endif; ?>
    <?php if ($mensagem_erro): ?>
      <p style="color: red;"><?php echo $mensagem_erro; ?></p>
    <?php endif; ?>

    <label for="nome">Nome:</label><br>
    <input type="text" id="nome" name="nome" required>
    <br>
    <label for="sobrenome">Sobrenome:</label><br>
    <input type="text" id="sobrenome" name="sobrenome" required>
    <br>
    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required>
    <br>
    <label for="proposta">Proposta de Emprego:</label><br>
    <textarea id="proposta" name="proposta" required></textarea>
    <br>
    <button class="azul" type="submit">Enviar</button>
  </form>
</section>