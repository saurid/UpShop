
<h2>Din varukorg</h2>

<?php if ($cart->getCount() > 0): ?>
    <table id="cart">
        <tr>
            <th>antal</th>
            <th>artikel</th>
            <th>á pris</th>
            <th>pris</th>
            <th></th>
        </tr>
        <?php foreach ($cart->getItems() as $item): ?>
            <tr>
                <td>
                    <form action="<?php echo UpMvc\Container::get()->site_path ?>/Cart/edit" method="post">
                        <p>
                            <input type="text" name="count" value="<?php echo $item->getCount() ?>" size= "1" maxlength="2" />
                            <input type="hidden" name="id" value="<?php echo $item->getId() ?>" />
                            <input type="hidden" name="urlref" value="<?php echo UpMvc\Container::get()->site_path ?>/Cart/show" />
                            <input type="submit" name="submit" value="ändra" />
                        </p>
                    </form>
                </td>
                <td class="item-name"><a href="<?php echo UpMvc\Container::get()->site_path ?>/Item/show/<?php echo $item->getId() ?>"><?php _e($item->getName()) ?></a></td>
                <td class="price"><?php echo number_format($item->getPriceIncl(), 2, ',', ' ') ?> kr</td>
                <td class="price"><?php echo number_format($item->getSumIncl(), 2, ',', ' ') ?> kr</td>
                <td>
                    <form action="<?php echo UpMvc\Container::get()->site_path ?>/Cart/delete" method="post">
                        <p>
                            <input type="hidden" name="id" value="<?php echo $item->getId() ?>" />
                            <input type="hidden" name="urlref" value="<?php echo UpMvc\Container::get()->site_path ?>/Cart/show" />
                            <input type="submit" name="submit" value="ta bort" onclick="return confirm('Du har valt att ta bort artikeln &quot;<?php _e($item->getName()) ?>&quot; från varukorgen. Är du säker på att det är det du vill?');" />
                        </p>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        
        <tr>
            <td>&nbsp;</td>
            <td>Frakt &amp; emballage</td>
            <td class="price"><?php echo number_format($shipping->getIncl(), 2, ',', ' ') ?> kr</td>
            <td class="price"><?php echo number_format($shipping->getIncl(), 2, ',', ' ') ?> kr</td>
            <td></td>
        </tr>
        
        <tr>
            <td colspan="5">&nbsp;</td>
        </tr>
        
        <tr class="sums">
            <td></td>
            <th colspan="2">summa:</th>
            <td class="price"><?php echo number_format($order->getSumIncl(), 2, ',', ' ') ?> kr</td>
            <td>
                <form action="<?php echo UpMvc\Container::get()->site_path ?>/Cart/deleteAll" method="post">
                    <p>
                        <input type="submit" name="submit" value="töm korgen" onclick="return confirm('Du har valt att tömma varukorgen helt. Är du säker på att det är det du vill?');" />
                        <input type="hidden" name="urlref" value="<?php echo UpMvc\Container::get()->site_path ?>/Cart/show" />
                    </p>
                </form>
            </td>
        </tr>
        <tr class="sums">
            <td></td>
            <th colspan="2">varav moms:</th>
            <td class="price"><?php echo number_format($order->getSumIncl() - $order->getSumExcl(), 2, ',', ' ') ?> kr</td>
            <td></td>
        </tr>
        <tr class="sums">
            <td></td>
            <th colspan="2">att betala:</th>
            <td class="price"><?php echo number_format($order->getSumIncl(), 2, ',', ' ') ?> kr</td>
            <td></td>
        </tr>
    </table>
    
    <h2>Kontaktuppgifter</h2>
    <form action="<?php echo UpMvc\Container::get()->site_path ?>/Cart/order" method="post">

    <?php if($user->isIn()): ?>
    
        <dl>
            <dt>leveransadress:</dt>
            <dd><?php _e($user->get('contact')) ?></dd>
            <dt>e-postadress:</dt>
            <dd><?php _e($user->get('email')) ?></dd>
            <dt>telefonnummer:</dt>
            <dd><?php _e($user->get('phone')) ?></dd>
        </dl>
    
    <?php else: ?>
    
        <p>Dina uppgifter lagras inte, utan används bara för att för att skicka din beställning och en bekräftelse till din epostadress.
        <small>* = Obligatoriska fält</small></p>
        <p>
            <label for="contact">Namn och postadress (dit dina varor ska skickas) *</label>
            <textarea name="contact" id="contact" rows="3" cols="30"><?php _e($request->get('contact')) ?></textarea>
            <?php echo $error->get('contact') ?>
        </p>
        <p>
            <label for="email">E-postadress *</label>
            <input type="text" name="email" id="email" size="32" value="<?php _e($request->get('email')) ?>" />
            <?php echo $error->get('email') ?>
        </p>
        <p>
            <label for="phone">Telefonnummer *</label>
            <input type="text" name="phone" id="phone" value="<?php _e($request->get('phone')) ?>" />
            <?php echo $error->get('phone') ?>
        </p>
        
    <?php endif ?>
    
        <p class="orderbutton"><input type="submit" name="submit" value="Skicka din beställning och gå till kassan" /></p>
        <?php echo $error->get('general') ?>
        <p>Din beställning kommer att skickas till oss via epost. Du kommer också att få ett epostmeddelande med bekräftelse på vad du har beställt till den adress du skrivit in ovan.</p>
    </form>
    
<?php else: ?>
    <p>Varukorgen är tom.</p>
<?php endif; ?>
