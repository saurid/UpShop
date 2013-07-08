
<h3>Skapa en ny artikel</h3>

<form action="<?php echo UpMvc\Container::get()->site_path ?>/Admin/Item/insert" method="post" enctype="multipart/form-data">
    <label for="file">Ladda upp bild</label>
    <input type="file" name="file" id="file" />
    <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
        
    <label for="name">Namn</label>
    <input type="text" name="name" size="40" />

    <label for="description">Beskrivning</label>
    <textarea name="description" rows="5" cols="40"></textarea>

    <label for="price">Pris <small>(inkl moms)</small></label>
    <input type="text" name="price" size="10" />

    <label for="weight">Vikt</label>
    <input type="text" name="weight" size="10" />
        
    <label for="count">Antal</label>
    <input type="text" name="count" size="10" value="1" />

    <label for="category_id">Kategori</label>
    <select name="category_id">
        <?php foreach ($categories as $row): ?>
            <option value="<?php echo $row['id'] ?>"><?php _e($row['name']) ?></option>
        <?php endforeach ?>
    </select>

    <label for="vat_id">Momssats</label>
    <select name="vat_id">
        <?php foreach ($vat as $row): ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['vat'] ?>%, <?php _e($row['name']) ?></option>
        <?php endforeach ?>
    </select>
    
    <p><input type="submit" name="submit" value="spara artikeln" /></p>
</form>
