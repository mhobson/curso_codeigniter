<fieldset>
    <legend>Editar Cadastro</legend>
    <?php echo form_open('edit_user', 'id="edit_user" '); ?>

    <input type="text" name="name" id="name" placeholder="Nome:" value="<?php echo $user[0]->name; ?>">
    <input type="text" name="email" id="email" placeholder="E-mail:" value="<?php echo $user[0]->email; ?>">
    <input type="text" name="birth" id="birth" class="date" placeholder="Nascimento" value="<?php echo $user[0]->birth; ?>">
    <input type="text" name="cpf" id="cpf" maxlength="18" onkeypress="mascaraMutuario(this,cpfCnpj)" placeholder="CPF:" value="<?php echo $user[0]->cpf; ?>">
    <select name="gender" id="gender">
        <option disabled selected value="0">Gênero</option>
        <option value="1" <?php if ($user[0]->gender == 1) {
                                echo 'selected';
                            } ?>>Masculino
        </option>
        <option value="2" <?php if ($user[0]->gender == 2) {
                                echo 'selected';
                            } ?>>Feminino
        </option>
    </select>
    <select name="state" id="state">
        <option disabled selected value="0">Selecione o Estado</option>
        <?php foreach ($states as $state) { ?>
            <?php if ($user[0]->state == $state->id) { ?>
                <option selected value="<?php echo $state->id; ?>"> <?php echo $state->initials; ?> </option>
            <?php } else { ?>
                <option value="<?php echo $state->id; ?>"> <?php echo $state->initials; ?> </option>
            <?php } ?>
        <?php } ?>
    </select>
    <select name="city" id="city">
        <option disabled selected value="0">Selecione a cidade</option>
        <?php foreach ($cities as $city) { ?>
            <?php if ($user[0]->city == $city->id) { ?>
                <option selected value="<?php $city->id; ?>"> <?php echo $city->city; ?> </option>
            <?php } else { ?>
                <option value="<?php $city->id; ?>"> <?php echo $city->city; ?> </option>
            <?php } ?>
        <?php } ?>
    </select>

    <input type="submit" id="update" class="botao-a" value="Atualizar"></input>
    <div id="resp-edit"></div>

    <?php echo form_close(); ?>
</fieldset>