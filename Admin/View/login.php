
<?php if(!$user->isIn()): ?>
    <h3>Logga in</h3>

    <form action="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Login/login" method="post">
        <p>
            <label for="email">E-postadress <small>(Används även som användarnamn)</small></label>
            <input type="text" name="email" id="email" value="<?php _e($request->get('email')) ?>" size="40" />
        </p>
        <p>
            <label for="password">Lösenord</label>
            <input type="password" name="password" id="password" size="20" />
        </p>
        <p>
            <input type="submit" name="submit" value="logga in" />
            <?php echo $error->get('login') ?>
        </p>
    </form>
<?php else: ?>
    <h3>Du är inloggad</h3>
    <p><a href="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Login/logout">Logga ut</a></p>
<?php endif ?>
