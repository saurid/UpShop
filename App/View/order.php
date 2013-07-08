
<p>Ordernummer: <?php echo $order->getNumber() ?></p>

<table>
    <tr>
        <th>antal</th>
        <th>artikel</th>
        <th>á pris</th>
        <th>pris</th>
    </tr>
    <?php foreach ($cart->getItems() as $item): ?>
        <tr>
            <td><?php echo $item->getCount() ?></td>
            <td><?php _e($item->getName()) ?></td>
            <td class="price"><?php echo number_format($item->getPriceIncl(), 2, ',', ' ') ?> kr</td>
            <td class="price"><?php echo number_format($item->getSumIncl(), 2, ',', ' ') ?> kr</td>
        </tr>
    <?php endforeach; ?>
    
    <tr>
        <td>1</td>
        <td>Frakt &amp; emballage</td>
        <td><?php echo number_format($shipping->getIncl(), 2, ',', ' ') ?> kr</td>
        <td><?php echo number_format($shipping->getIncl(), 2, ',', ' ') ?> kr</td>
    </tr>
    
    <tr>
        <td colspan="5">&nbsp;</td>
    </tr>
    
    <tr>
        <th colspan="3">summa:</th>
        <td><?php echo number_format($order->getSumIncl(), 2, ',', ' ') ?> kr</td>
    </tr>
    <tr>
        <th colspan="3">varav moms:</th>
        <td><?php echo number_format($order->getSumIncl() - $order->getSumExcl(), 2, ',', ' ') ?> kr</td>
    </tr>
    <tr>
        <th colspan="3">att betala:</th>
        <td><?php echo number_format($order->getSumIncl(), 2, ',', ' ') ?> kr</td>
    </tr>
</table>

<dl>
    <dt>leveransadress:</dt>
    <dd><?php _e($contact) ?></dd>
    <dt>e-postadress:</dt>
    <dd><?php echo $email ?></dd>
    <dt>telefonnummer:</dt>
    <dd><?php echo $phone ?></dd>
</dl>
