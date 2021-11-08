<?php include 'conn.php' ?>
<!DOCTYPE html>
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


<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/index.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
     
   </head>
   <body class="body">
      <div class="container">
      <h1 align="center">PDP</h1>
      <div class="row">
      <div>
        <h3> Cart </h3>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Sku</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Item Price</th>
                <th class="text-right">Price</th>
                <th class="text-center">Remove</th>
            </tr>
            <?php
            $total_quantity=0;
            $total_Price =0;
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
                            <a href="details.php?action=remove&Sku=<?=$item['Sku']; ?>" class="btn btn-danger">X</a>
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
      <h3>Details</h3>
      <?php
if (isset($_GET['Id']))
{
    $query = "select * from products where Id={$_GET['Id']}";
    $result = mysqli_query($connection, $query);

    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
?>
      <table class="table table-bordered">
      <tr id="tr">
         <td > <img src="<?php echo $row["image"]; ?>" ></td>
      <tr>
         <td>
            <p>Name:<strong><?php echo $row['Name']; ?></p>
            </strong>
      <tr>
         <td>
            <p>Sku:<strong><?php echo $row['Sku']; ?></p>
            </strong>
      <tr>
         <td>
            <p>Description:<strong><?php echo $row['Description']; ?></p>
            </strong>
      <tr>
         <td>
            <p>Price:<strong><?php echo $row['Price']; ?></p>
            </strong>
            <form action="details.php?action=Add&Id=<?=$row['Id']; ?>" method="post">
            <td> <input type="number" Name="quantity" value="1" min=1 max=1000 class="number"></td>

            <td><input type="submit" value="Add to Cart" class="btn btn-success btn-sm"></td>


            </form>
            <?php
    }
    else
    {
        header("location:index.php");
    }
}
else
{
    header("location:index.php");
}
?>

   </body>
</html>
