<?php
session_start();
$products = [
    [
        'id' => 1,
        'name' => 'iphone 6',
        'price' => 10000000,
    ],
    [
        'id' => 2,
        'name' => 'iphone 7',
        'price' => 10000000,
    ],
    [
        'id' => 3,
        'name' => 'iphone 8',
        'price' => 10000000,
    ],
    [
        'id' => 4,
        'name' => 'iphone 9',
        'price' => 15000000,
    ]
];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    //tìm sản phẩm trong mảng $products -> tiìm trong DB
    for ($i = 0; $i < count($products); $i++) {
        if ($products[$i]['id'] == $id) {
            $cartItems = [];//chưa có giỏ hàng
            //đã có giỏ hàng
            if (isset($_SESSION['cart'])) {
                $cartItems = $_SESSION['cart'];//bốc sp trong giỏ hàng vào biến $cartItems
            }

            $foundProductInCart = false;
            for ($j = 0; $j < count($cartItems); $j++) {
                if ($id == $cartItems[$j]['item']['id']) {
                    //tăng số lượng lên
                    $cartItems[$j]['quantity'] += 1;
                    $foundProductInCart = true;
                    break;
                }
            }

            if (!$foundProductInCart) {
                $product = $products[$i];//lấy product ra
                $cartItems[] =
                    [
                        'item' => $product,
                        'quantity' => 1
                    ];
            }
            $_SESSION['cart'] = $cartItems;
            break;
        }//end if
    }//end for
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
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="mx-auto container">
    <div class="grid grid-cols-4">
        <?php
        foreach ($products as $product) {
            ?>
            <div>
                <h4><?php echo $product['name'] ?></h4>
                <p>Price: <?php echo $product['price'] ?></p>
                <a href="?id=<?php echo $product['id']; ?>"
                   class="bg-green-500 text-white mt-2 inline-block rounded p-2">Add To Cart</a>
            </div>
            <?php
        }
        ?>
    </div>
</div>
</body>
</html>
