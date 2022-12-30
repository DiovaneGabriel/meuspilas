<form action="" method="POST">
    <input placeholder="Nome" name="nome" type="text" autofocus required>
    <input placeholder="Sobremone" name="sobrenome" type="text" required>
    <input placeholder="E-mail" name="email" type="email" required>
    <input placeholder="Senha" name="senha" type="password" value="" required>
    <input type="submit" value="Criar">
    <a href="<?= base_url(); ?>">Já possuo uma conta</a>
</form>