<?php
include 'bootstrap.php';
$cart = new Cart();
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Emir test for paylogic</title>
    <style type="text/css">
        body {
            padding: 10px;
            font-family: verdana, Arial, sans-serif;
            font-size: 12px;
        }
        h1 {
            font-size: 16px;
        }
        h2 {
            font-size: 14px;
        }
    </style>
</head>
<body>
<h1>Your Cart (<a href="clearcart.php">clear</a>)</h1>
<table>
    <tr>
        <th width="100">Product</th>
        <th width="100">Amount</th>
        <th width="100">Fee</th>
        <th width="100">Subtotal</th>
    </tr>
    <?php foreach ($cart->getItems() as $cartItem) { ?>
        <tr>
            <td><?php echo $cartItem->getProduct()->getName() ?></td>
            <td><?php echo $cartItem->getCount() ?></td>
            <td><?php echo $cartItem->getProduct()->getReadablePrice() ?></td>
            <td><?php echo $cartItem->getReadableSubTotal() ?></td>
        </tr>
    <?php } ?>

    <tr>
        <td colspan="3">
            TOTAL
        </td>
        <td>
            <?php echo $cart->getReadableTotal() ?>
        </td>
    </tr>

</table>

<hr />

<?php
$eventFactory = new EventFactory();
$allEvents = $eventFactory->getAll();

foreach ($allEvents as $event) {
    $productFactory = new ProductFactory($event);
    $event->setProducts($productFactory->getAll());
    ?>

    <h2>Event <?php echo $event->getName()?> has following products for sale</h2>
    <table>
        <?php foreach ($event->getProducts() as $product) { ?>
            <tr>
                <td width="120"><?php echo $product->getName()?></td>
                <td width="100"><?php echo $product->getReadablePrice($event)?></td>
                <td width="100">
                    <a href="addtocart.php?product=<?php echo $product->getId()?>">Add to cart</a>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } ?>

</body>
</html>

