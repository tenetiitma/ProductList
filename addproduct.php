<?php
require_once('./config/dbconfig.php'); 
$db = new Product();

$action = filter_input(INPUT_POST, 'save', FILTER_SANITIZE_STRING);

if (isset($action) && $action === 'save') {
    $db->Store_Record();
}
?>
<style type="text/css">
    form {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $('select').on('change', function() {
        if (this.value == 'DVD') {
            DVD.style.display = 'block';
        } else {
            DVD.style.display = 'none';
        }
        if (this.value == 'Book') {
            Book.style.display = 'block';
        } else {
            Book.style.display = 'none';
        }
        if (this.value == 'Furniture') {
            Furniture.style.display = 'block';
        } else {
            Furniture.style.display = 'none';
        }
    });
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Add Product</title>
</head>
<body class="bg-light">

  <nav class="navbar">
    <div class="container-xl border-bottom border-dark">
        <a href="index.php" class="navbar-brand h1 text-dark">Product Add</a>
        <ul class="nav justify-content-end gap-4 m-3">
          <li><a href="index.php" class="btn btn-outline-dark shadow-sm">Cancel</a></li>
        </ul>
    </div>
  </nav>

<div class="container-xl">
    <form id="product_form" method="POST" action="" name="product_form" class="form-control form-control-sm">
        <label for="sku" class="form-label">SKU</label>
            <input id="sku" type="text" name="sku" class="form-control" onkeyup="this.value = this.value.toUpperCase();">
        <label for="name" class="form-label">Name</label>
            <input id="name" type="text" name="name" class="form-control form-control-sm">
        <label for="price" class="form-label">Price ($)</label>
            <input id="price" type="text" name="price" class="form-control form-control-sm">
        <label class="form-label">Type Switcher</label>
            <select id="productType" name="type" class="form-select" value="productType">
                <option disabled selected value=""></option>
                <option value="DVD">DVD-disc</option>
                <option value="Book">Book</option>
                <option value="Furniture">Furniture</option>
            </select>
            <br />
        <div style="display:none" id="DVD">
            <input id="size" type="text" name="size" class="form-control form-control-sm" placeholder="Size (MB)">
                <p>Please, provide size! (numbers only)</p>
        </div>
        <div style="display:none" id="Book">
            <input id="weight" type="text" name="weight" class="form-control form-control-sm" placeholder="Weight (KG)">
                <p>Please, provide weight (numbers only)!</p>
        </div>
        <div style="display:none" id="Furniture">
            <input id="height" type="text" name="height" class="form-control form-control-sm mb-3" placeholder="Height (CM)">
            <input id="width" type="text" name="width" class="form-control form-control-sm mb-3" placeholder="Width (CM)">
            <input id="length" type="text" name="length" class="form-control form-control-sm mb-3" placeholder="Length (CM)">
                <p>Please, provide dimensions (numbers only)!</p>
        </div>
        <div class="d-flex justify-content-center mx-auto">
                <button type="submit" name="save" value="save" class="btn btn-outline-dark shadow-sm ">Save</button>
            </div>
    </form>
</div>
<?php include('templates/footer.php');?>
</body>
</html>