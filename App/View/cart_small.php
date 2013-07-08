<div id="cart_small">
    <form action="#">
        <p>
            <select onchange="JavaScript:window.location = this.options[this.selectedIndex].value">
            <?php if ($cart->getCount() > 0): ?>
                <option>
                    <?php echo $cart->getCount() ?> artiklar 
                    för totalt <?php echo number_format($cart->getSumIncl(), 2, ',', ' ') ?> kr
                </option>
                <option disabled="disabled">----------</option>
                <?php foreach ($cart->getItems() as $item): ?>
                    <option value="<?php echo UpMvc\Container::get()->site_path ?>/Item/show/<?php echo $item->getId() ?>">
                        <?php echo $item->getCount() ?> st <?php _e($item->getName()) ?>
                        á <?php echo number_format($item->getPriceIncl(), 2, ',', ' ') ?> kr
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option>Varukorgen är tom</option>
            <?php endif; ?>
            </select>
        </p>
    </form>
    <?php if ($cart->getCount() > 0): ?>
        <a href="<?php echo UpMvc\Container::get()->site_path ?>/Cart/show">Till varukorgen</a>
    <?php endif; ?>
</div>
