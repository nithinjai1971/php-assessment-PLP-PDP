
<?php include "pagination.php"; ?>
<?php
session_start();
if (!empty($_GET['action']))
{
    switch ($_GET['action'])
    {
        case 'Add':
            if (!empty($_POST['quantity']))
            {

                $id = $_GET['Id'];
                $query = "SELECT * FROM products WHERE Id=" . $id;
                $result = mysqli_query($connection, $query);
                while ($product = mysqli_fetch_array($result))
                {
                    $itemArray = [$product['Sku'] => ['Name' => $product['Name'], 'Sku' => $product['Sku'], 'quantity' => $_POST['quantity'], 'Price' => $product['Price'], 'image' => $product['image']]];
                    if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
                    
                    {
                        if (in_array($product['Sku'], array_keys($_SESSION['cart_item'])))
                        {
                            foreach ($_SESSION['cart_item'] as $key => $value)
                            {
                                if ($product['Sku'] == $key)
                                {
                                    if (empty($_SESSION['cart_item'][$key]["quantity"]))
                                    {
                                        $_SESSION['cart_item'][$key]['quantity'] = 0;
                                    }
                                    $_SESSION['cart_item'][$key]['quantity'] += $_POST['quantity'];
                                }
                            }
                        }
                        else
                        {
                            $_SESSION['cart_item'] += $itemArray;
                        }
                    }
                    else
                    {
                        $_SESSION['cart_item'] = $itemArray;
                    }
                }
            }
        break;
        case 'remove':
            if (!empty($_SESSION['cart_item']))
            {
                foreach ($_SESSION['cart_item'] as $key => $value)
                {
                    if ($_GET['Sku'] == $key)
                    {
                        unset($_SESSION['cart_item'][$key]);
                    }
                    if (empty($_SESSION['cart_item']))
                    {
                        unset($_SESSION['cart_item']);
                    }
                }
            }
        break;
        case 'empty':
            unset($_SESSION['cart_item']);
        break;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>plp and pdp</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >

</head>
<body class="body">
    <div class="container">
        <div>
        <img class="logoMain" src="images/Logo.jpg" width="150" height="100">
        <h1 align="center">discountsale.com</h1>
        </div>
        <div>
        <h3> Cart </h3>
        </div>
        <table class="table">
            <tbody>
             
            <?php
            $total_quantity=0;
            $total_Price=0;
if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
{
    foreach ($_SESSION['cart_item'] as $item)
    {
        $item_Price = $item['quantity'] * $item['Price'];
?>
                    <tr>
                        <td class="text-left">
                            <img src="<?=$item['image'] ?>" alt="<?=$item['Name'] ?>" class="img-fluid" width="100">
                            <?=$item['Name'] ?>
                        </td>
                        <td class="text-left"><?=$item['Sku'] ?></td>
                        <td class="text-right"><?=$item['quantity'] ?></td>
                        <td class="text-right">₹<?=number_format($item['Price'], 2) ?></td>
                        <td class="text-right">₹<?=number_format($item_Price, 2) ?></td>
                        <td class="text-center">
                            <a href="index.php?action=remove&Sku=<?=$item['Sku']; ?>" class="btn btn-danger">X</a>
                        </td>
                    </tr>

                    <?php
        
        $total_quantity += $item["quantity"];
        $total_Price += ($item["Price"] * $item["quantity"]);
    }
}

if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
{
?>
                <tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><strong><?=$total_quantity
?></strong></td>
                    <td></td>
                    <td align="right"><strong>₹<?=number_format($total_Price, 2); ?></strong></td>
                    <td></td>
                </tr>

            <?php
}

?>
            </tbody>
        </table>
    </div>
    
            <table class="table  ">
                <tr >
                    <th>Product</th>
                    <th>Name</th>
                    <th>Sku</th>
                    <th>Price</th>

                   
                </tr>
                <select class="categorise" onChange="window.location.href=this.value"> 
    <option value="none">None</option>
    <option value="http://localhost/php-assessment-main/phpAssessment/index.php?page=1">Default</option>
    <option value="http://localhost/php-assessment-main/phpAssessment/index.php?page=1">Men's Accessories</option> 
    <option value="http://localhost/php-assessment-main/phpAssessment/index.php?page=2">Wires</option> 
    <option value="http://localhost/php-assessment-main/phpAssessment/index.php?page=3">Shirts</option> 
    <option value="http://localhost/php-assessment-main/phpAssessment/index.php?page=4">Home Appliances</option> 
</select>
<tr>
                <th text-align="right">Name</th>
                <th class="text-left">Sku</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Item Price</th>
                <th class="text-right">Price</th>
                <th class="text-center">Remove</th>
            </tr>
                <hr> 
                
                <?php
                pagination();

                ?>
                




    
        </table> 
        

    
</body>
</html>
