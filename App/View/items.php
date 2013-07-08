
<h2><?php _e($category) ?></h2>
<?php if($itemcount): ?>
    <table id="items">
        <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <?php if(empty($item['thumb'])): ?>
                        <a href="<?php echo UpMvc\Container::get()->site_path ?>/Item/show/<?php echo $item['id'] ?>">
                            Ingen bild finns...
                        </a>
                    <?php else: ?>
                        <a href="<?php echo UpMvc\Container::get()->site_path ?>/Item/show/<?php echo $item['id'] ?>">
                            <img src="<?php echo UpMvc\Container::get()->site_path ?>/App/View/img/items/<?php echo $item['thumb'] ?>" alt="<?php _e($item['name']) ?>" />
                        </a>
                    <?php endif ?>
                </td>
                <td>
                    <h3><?php _e($item['name']) ?></h3>
                    <p class="pricetag"><span><?php echo number_format($item['price'], 2, ',', ' ') ?> kr</span></p>
                    
                    <form action="<?php echo UpMvc\Container::get()->site_path ?>/Cart/add/<?php echo $item['id'] ?>" method="post">
                        <?php if ($item['count'] - $cart->getItemCount($item['id']) >= 2) : ?>
                            <p>
                                <input type="submit" name="submit" value="köp" />
                                <input type="text" name="count" value="1" size= "1" maxlength="2" />
                                <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />                    
                                <input type="hidden" name="urlref" value="<?php echo str_replace('/index.php', '', $_SERVER['PHP_SELF']) ?>" />
                                (<?php echo $item['count'] - $cart->getItemCount($item['id'])  ?> st. kvar)
                            </p>
                        <?php elseif ($item['count'] - $cart->getItemCount($item['id']) == 1): ?>
                            <p>
                                <input type="submit" name="submit" value="köp" />
                                <input type="hidden" name="count" value="1" />
                                <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                                <input type="hidden" name="urlref" value="<?php echo str_replace('/index.php', '', $_SERVER['PHP_SELF']) ?>" />
                                (<?php echo $item['count'] - $cart->getItemCount($item['id'])  ?> st. kvar)
                            </p>
                        <?php elseif ($item['count'] - $cart->getItemCount($item['id']) == 0) : ?>
                            <p>Artikeln är slutsåld...</p>
                        <?php endif ?>
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php else: ?>
    <p>Det finns inga artiklar i denna kategorin.</p>
<?php endif ?>
