
<div id="item">
    <h2><?php _e($item['name']) ?></h2>
    
    <?php if(empty($item['image'])): ?>
        <p>(Ingen bild finns...)</p>
    <?php else: ?>
        <p><img src="<?php echo UpMvc\Container::get()->site_path ?>/App/View/img/items/<?php echo $item['image'] ?>" alt="<?php _e($item['name']) ?>" /></p>
    <?php endif ?>
    
    <p><?php _e($item['description']) ?></p>
    <p class="pricetag"><span><?php echo number_format($item['price'], 2, ',', ' ') ?> kr</span></p>
    
    <form action="<?php echo UpMvc\Container::get()->site_path ?>/Cart/add/<?php echo $item['id'] ?>" method="post">
        <?php if ($item['count'] - $cart->getItemCount($item['id']) >= 2) : ?>
            <p>
                <input type="submit" name="submit" value="köp" />
                <input type="text" name="count" value="1" size= "1" maxlength="2" />
                <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />                    
                <input type="hidden" name="urlref" value="<?php echo UpMvc\Container::get()->site_path ?>/Item/show/<?php echo $item['id'] ?>" />
                (<?php echo $item['count'] - $cart->getItemCount($item['id'])  ?> st. kvar)
            </p>
        <?php elseif ($item['count'] - $cart->getItemCount($item['id']) == 1): ?>
            <p>
                <input type="submit" name="submit" value="köp" />
                <input type="hidden" name="count" />
                <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                <input type="hidden" name="urlref" value="<?php echo UpMvc\Container::get()->site_path ?>/Item/show/<?php echo $item['id'] ?>" />
                (<?php echo $item['count'] - $cart->getItemCount($item['id'])  ?> st. kvar)
            </p>
        <?php elseif ($item['count'] - $cart->getItemCount($item['id']) == 0) : ?>
            <p>Artikeln är slutsåld...</p>
        <?php endif ?>
    </form>
</div>
