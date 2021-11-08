<?php include 'conn.php' ?>
<?php
function pagination()
{
    global $connection;
    $results_per_page = 5;
    $query = 'SELECT * FROM products';
    $result = mysqli_query($connection, $query);
    $resultArr=[];
    array_push($resultArr,...$result);
    $number_of_results = mysqli_num_rows($result);
    $number_of_pages = $number_of_results / $results_per_page;
    $page = 1;

if (isset($_GET['page'])) {
	$page = $_GET['page'];
}
$this_page_first_result = ($page - 1) * $results_per_page;
$resultArr = array_slice($resultArr, $this_page_first_result, $results_per_page);


    
    foreach($resultArr as $row)
    { ?>
        <form action="index.php?action=Add&Id=<?=$row['Id']; ?>" method="post">
          <tr>
                  <td id="product-image"><img src="<?php echo $row["image"]; ?>"width="100" height="100"> </td>
                  <td><?=$row['Name']; ?></td>
                  <td><?php echo $row['Sku']; ?></td>
                  <td>₹<?=number_format($row['Price'], 2); ?></td>
                  <td> <input type="number" Name="quantity" value="1" min=1 max=1000 class="number"></td>
                  <td><input type="submit" value="Add to Cart" ></td>

                       <td><a href="details.php?Id=<?=$row['Id']; ?>" >View details</a></td>

                  
              </div>
          </div>
    </form>  
    <center>

    <?php
    }
    for ($page = 1;$page <= $number_of_pages;$page++)
    {
        echo '<a "  href="index.php?page=' . $page . '">' . $page . '</a> ';
    }
    

    }

    
?>
    </center>
