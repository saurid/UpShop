<?php use UpMvc\Container as Up; ?>

<h3>Ändra på en artikel</h3>

<?php foreach ($items as $item): ?>
    <p>
        <?php if(empty($item['image'])): ?>
            Ingen bild är uppladdad...
        <?php else: ?>
            <a href="<?php echo Up::site_path() ?>/App/View/img/items/<?php echo $item['image'] ?>" class="single_image"><img src="<?php echo Up::site_path() ?>/App/View/img/items/<?php echo $item['thumb'] ?>" /></a>
        <?php endif ?>
    </p>

    <form action="<?php echo Up::site_path() ?>/Admin/Item/update/<?php echo $item['id'] ?>" method="post" enctype="multipart/form-data">
        <label for="file">Ladda upp bild</label>
        <input type="file" name="file" id="file" />
        <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />

        <label for="name">Namn</label>
        <input type="text" name="name" size="40" value="<?php _e($item['name']) ?>" />

        <label for="description">Beskrivning</label>
        <textarea name="description" rows="7" cols="50"><?php echo $item['description'] ?></textarea>

        <label for="price">Pris <small>(inkl moms)</small></label>
        <input type="text" name="price" size="10" value="<?php echo $item['price'] ?>" />

        <label for="weight">Vikt</label>
        <input type="text" name="weight" size="10" value="<?php echo $item['weight'] ?>" />

        <label for="count">Antal</label>
        <input type="text" name="count" size="10" value="<?php echo $item['count'] ?>" />

        <label for="category_id">Kategori</label>
        <select name="category_id">
            <?php foreach ($categories as $row): ?>
                <?php $selected = ''; if($row['id'] == $item['category_id']) $selected = 'selected="selected"' ?>
                <option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php _e($row['name']) ?></option>
            <?php endforeach ?>
        </select>

        <label for="vat_id">Momssats</label>
        <select name="vat_id">
            <?php foreach ($vat as $row): ?>
                <?php $selected = ''; if($row['id'] == $item['vat_id']) $selected = 'selected="selected"' ?>
                <option value="<?php echo $row['id'] ?>" <?php echo $selected ?>><?php echo $row['vat'] ?>%, <?php _e($row['name']) ?></option>
            <?php endforeach ?>
        </select>

        <p><input type="submit" name="submit" value="spara ändringar" /></p>
    </form>
<?php endforeach ?>
