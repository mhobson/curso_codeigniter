<fieldset>
    <legend>Cadastro</legend>
    <?php echo form_open('new_user', 'id="sign" '); ?>

    <input type="text" name="name" id="name" placeholder="Nome:">
    <input type="text" name="email" id="email" placeholder="E-mail:">
    <input type="text" name="birth" id="birth" class="date" placeholder="Nascimento">
    <input type="text" name="cpf" id="cpf" maxlength="18" onkeypress="mascaraMutuario(this,cpfCnpj)" placeholder="CPF:">
    <select name="gender" id="gender">
        <option value="0">Gênero</option>
        <option value="1">Masculino</option>
        <option value="2">Feminino</option>
    </select>
    <select name="state" id="state">
        <option disabled selected value="0">Selecione o Estado</option>
        <?php foreach ($states as $state) { ?>
            <option value="<?php echo $state->id; ?>"> <?php echo $state->initials; ?> </option>
        <?php } ?>
    </select>
    <select name="city" id="city">
        <option disabled selected value="0">Selecione a cidade</option>
    </select>
    <input type="password" name="password" id="password" placeholder="Senha:">
    <input type="submit" id="register" class="botao-a" value="Cadastrar"></input>
    <div id="resp-sign"></div>

    <?php echo form_close(); ?>
</fieldset>