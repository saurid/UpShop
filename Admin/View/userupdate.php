<?php use UpMvc\Container as Up; ?>

<h3>Ändra en användare i registret</h3>

<?php foreach ($users as $user): ?>
    <form action="<?php echo Up::site_path() ?>/Admin/User/update/<?php echo $user['id'] ?>" method="post">
        <label for="contact">Adress</label>
        <textarea name="contact" rows="5" cols="40"><?php echo $user['contact'] ?></textarea>

        <label for="email">E-postadress <small>(Används även som användarnamn)</small></label>
        <input type="text" name="email" size="40" value="<?php _e($user['email']) ?>" />

        <label for="password">Lösenord <small>(Lämna tomt för att bevara, fyll i för att ändra)</small></label>
        <input type="password" name="password" size="20" />

        <label for="phone">Telefonnummer</label>
        <input type="text" name="phone" size="20" value="<?php _e($user['phone']) ?>" />

        <label for="userrole_id">Roll</label>
        <select name="userrole_id">
            <?php foreach ($userroles as $row): ?>
                <?php $selected = ''; if($row['id'] == $user['userrole_id']) $selected = 'selected="selected"' ?>
                <option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php _e($row['name']) ?></option>
            <?php endforeach ?>
        </select>
        
        <p><input type="submit" name="submit" value="spara ändringar" /></p>
    </form>
<?php endforeach ?>
