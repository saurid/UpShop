<?php use UpMvc\Container as Up; ?>

<h3>Lägg till en ny användare</h3>

<form action="<?php echo Up::site_path() ?>/Admin/User/insert" method="post">
    <label for="contact">Adress</label>
    <textarea name="contact" rows="5" cols="40"></textarea>

    <label for="email">E-postadress <small>(Används även som användarnamn)</small></label>
    <input type="text" name="email" size="40" />

    <label for="password">Lösenord</label>
    <input type="password" name="password" size="20" />

    <label for="phone">Telefonnummer</label>
    <input type="text" name="phone" size="20" />

    <label for="userrole_id">Roll</label>
    <select name="userrole_id">
        <?php foreach ($userroles as $row): ?>
            <option value="<?php echo $row['id'] ?>"><?php _e($row['name']) ?></option>
        <?php endforeach ?>
    </select>

    <p><input type="submit" name="submit" value="spara" /></p>
</form>
