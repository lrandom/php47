<?php
session_start();
/*unset($_SESSION['cart']);
exit();*/

if ($_SESSION['cart'] && $_GET['id']) {
    $id = $_GET['id'];
    $cartItems = $_SESSION['cart'];

    if ($_GET['action'] === 'delete') {
        $cartItemsTmp = [];
        foreach ($cartItems as $cartItem) {
            if ($cartItem['item']['id'] != $id) {
                $cartItemsTmp[] = $cartItem;
            }
        }
        $_SESSION['cart'] = $cartItemsTmp;
    }

    if ($_GET['action'] === 'update') {
        $quantity = $_GET['quantity'];
        for ($i = 0; $i < count($cartItems); $i++) {
            if ($cartItems[$i]['item']['id'] == $id) {
                $cartItems[$i]['quantity'] += $quantity;
                if ($cartItems[$i]['quantity'] <= 0) {
                    header('Location:?id='.$id.'&action=delete');
                }
                break;
            }
        }
        $_SESSION['cart'] = $cartItems;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_SESSION['cart'])) {
    $cartItems = $_SESSION['cart'];
    ?>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Price/Item</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>
                Action
            </th>
        </tr>
        </thead>


        <tbody>
        <?php foreach ($cartItems as $cartItem) { ?>
            <tr>
                <td><?php echo $cartItem['item']['name']; ?></td>
                <td><?php echo $cartItem['item']['price'] ?></td>
                <td>
                    <a href="?id=<?php echo $cartItem['item']['id']; ?>&action=update&quantity=-1">-</a>
                    <?php echo $cartItem['quantity'] ?>
                    <a href="?id=<?php echo $cartItem['item']['id']; ?>&action=update&quantity=1">+</a>
                </td>
                <td>
                    <?php echo $cartItem['item']['price'] * $cartItem['quantity']; ?>
                </td>
                <td>
                    <a href="?id=<?php echo $cartItem['item']['id']; ?>&action=delete"
                       onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

<?php } ?>
</body>
</html>
