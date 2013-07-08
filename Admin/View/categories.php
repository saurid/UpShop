
<h3>Kategorier (<?php echo $categorycount ?>)</h3>

<form action="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Category/insert" method="post">
    <label for="name">Lägg till ny kategori</label>
    <input type="text" name="name" />
    <input type="submit" value="spara kategori" />
</form>

<?php if($categorycount): ?>
    <ul>
    <?php foreach ($categories as $row): ?>
        <li>
            <form action="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Category/update/<?php echo $row['id'] ?>" method="post">
                <input type="text" name="name" value="<?php _e($row['name']) ?>" />
                <input type="submit" value="ändra" />
                <a href="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Category/delete/<?php echo $row['id'] ?>" onclick="return confirm('Du har valt att ta bort kategorin &quot;<?php _e($row['name']) ?>&quot;. Är du säker på att det är det du vill?');">radera</a>
            </form>
        </li>
    <?php endforeach ?>
    </ul>
<?php endif ?>
