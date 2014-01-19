<?php use UpMvc\Container as Up; ?>

<h3>Användare (<?php echo $usercount ?>)</h3>

<p><a href="<?php echo Up::site_path() ?>/Admin/User/insert">Lägg till en ny användare</a></p>

<?php if($usercount): ?>
    <table>
        <tr>
            <th>adress</th>
            <th>telefon</th>
            <th>e-postadress</th>
            <th>roll</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr class="<?php _e($user['userrole']) ?>">
                <td><?php _e($user['contact']) ?></td>
                <td><?php _e($user['phone']) ?></td>
                <td><a href="mailto:<?php _e($user['email']) ?>"><?php _e($user['email']) ?></a></td>
                <td><?php echo $user['userrole'] ?></td>
                <td><a href="<?php echo Up::site_path() ?>/Admin/User/update/<?php echo $user['id'] ?>">ändra</a></td>
                <td><a href="<?php echo Up::site_path() ?>/Admin/User/delete/<?php echo $user['id'] ?>" onclick="return confirm('Du har valt att ta bort kontakten &quot;<?php _e($user['email']) ?>&quot;. Är du säker på att det är det du vill?');">radera</a></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif ?>
