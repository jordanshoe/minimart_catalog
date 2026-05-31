<?php

require 'connection.php';

  function getAllSections(){
      $conn = connection();
      $sql = "SELECT * FROM sections";

      if($result = $conn->query($sql)){
          return $result;
      } else {
          die("Error retrieving all sections: " . $conn->error);
      }
  }

  function createProduct($name, $description, $price, $section_id){
    $conn = connection();

    $sql = "INSERT INTO products (name, description, price, section_id) 
            VALUES ('$name', '$description', $price, $section_id)";

    if($conn->query($sql)){
      header('location: products.php');
      exit;
    } else {
      die('Error adding a new product: ' . $conn->error);
    }
  }


  if(isset($_POST['btn_submit'])){
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $section_id = $_POST['section_id'];

    createProduct($name, $description, $price, $section_id);
  }
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>New Product</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-3">
        <h2 class="fw-light mb-3">New Product</h2>

        <form action="" method="post">
          <div class="mb-3">
            <label for="name" class="form-label small fw-bold">Name</label>
            <input type="text" name="name" id="name" class="form-control" max="50" required autofocus>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label small fw-bold">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
          </div>
          <div class="mb-3">
            <label for="price" class="form-label small fw-bold">Price</label>
            <div class="input-group">
              <div class="input-group-text">$</div>
              <input type="number" name="price" id="price" class="form-control" step="any" required>
            </div>
          </div>
          <div class="mb-4">
            <label for="section-id" class="form-label small fw-bold">Section</label>
            <select name="section_id" id="section-id" class="form-select">
              <option value="" hidden>Select Section</option>
              <?php
              $all_sections = getAllSections();
              while($section = $all_sections->fetch_assoc()){
              ?>
                <option value="<?= $section['id'] ?>"><?= $section['name'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <a href="products.php" class="btn btn-outline-success">Cancel</a>
          <button type="submit" class="btn btn-success fw-bold px-5" name="btn_submit">
            <i class="fas fa-plus"></i> Add
          </button>
        </form>
      </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>