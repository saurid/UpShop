<?php use UpMvc\Container as Up; ?>

<h3>Artiklar (<?php echo $itemcount ?>)</h3>

<p><a href="<?php echo Up::site_path() ?>/Admin/Item/insert">Lägg till en ny artikel</a></p>

<?php if($itemcount): ?>
    <p>Sida: <?php echo $nav ?></p>
    <table>
        <tr>
            <th>id</th>
            <th>bild</th>
            <th>namn</th>
            <th>pris</th>
            <th>antal</th>
            <th>kategori</th>
        </tr>
        <?php foreach ($items as $item): ?>
            <tr title="<?php _e($item['description']) ?>">
                <td><?php echo $item['id'] ?></td>
                <td>
                    <?php if(empty($item['image'])): ?>
                        ...
                    <?php else: ?>
                        <a href="<?php echo Up::site_path() ?>/Admin/Item/update/<?php echo $item['id'] ?>">
                            <img src="<?php echo Up::site_path() ?>/App/View/img/items/<?php echo $item['thumb'] ?>" width="40" />
                        </a>
                    <?php endif ?>
                </td>
                <td><?php _e($item['name']) ?></td>
                <td class="price"><?php echo number_format($item['price'], 2, ',', ' ') ?></td>
                <td><?php echo $item['count'] ?></td>
                <td><?php _e($item['category']) ?></td>
                <td><a href="<?php echo Up::site_path() ?>/Admin/Item/update/<?php echo $item['id'] ?>">ändra</a></td>
                <td><a href="<?php echo Up::site_path() ?>/Admin/Item/delete/<?php echo $item['id'] ?>" onclick="return confirm('Du har valt att ta bort artikeln &quot;<?php _e($item['name']) ?>&quot;. Är du säker på att det är det du vill?');">radera</a></td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif ?>
