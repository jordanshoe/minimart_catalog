<?php

require 'connection.php';

function getAllProducts(){
    $conn = connection();

    $sql = "SELECT products.id AS id, products.name AS name, products.description AS description, products.price AS price, sections.name AS section 
    FROM products 
    INNER JOIN sections
    ON products.section_id = sections.id ORDER BY products.id DESC";

    if($result = $conn->query($sql)){
        return $result;
    } else {
        die('Error retrieving all products: ' . $conn->error);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
</head>
<body>
    <main class="container">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-light">Products</h2>
            </div>
            <div class="col text-end">
                <a href="add-product.php" class="btn btn-success">
                    <i class="fas fa-plus-circle"></i> New Product
                </a>
            </div>
        </div>

        <table class="table table-hover align-middle border">
            <thead class="small table-success">
                <tr>
                    <th>ID</th>
                    <th style="width: 250px;">NAME</th>
                    <th>DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>SECTION</th>
                    <th style="width: 95px;"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $all_products = getAllProducts();
                    while($product = $all_products->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['description'] ?></td>
                        <td>$ <?= $product['price'] ?></td>
                        <td><?= $product['section'] ?></td>
                        <td>
                            <a href="edit-product.php" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <a href="delete-product.php" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>