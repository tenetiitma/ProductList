<?php 
    require_once('./config/dbconfig.php');
    $db = new Product();
    $result = $db->view_Record();

   $action = filter_input(INPUT_POST, 'delete-product-btn', FILTER_SANITIZE_STRING);
   if($action === 'delete'){
        $db->delete_Record();
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Product page</title>
</head>
<body class="bg-light">

<form action="" method="POST">
    <nav class="navbar">
        <div class="container-xl border-bottom border-dark">
            <a href="index.php" class="navbar-brand h1 text-dark">Product List</a>
            <ul class="nav justify-content-end gap-4 m-3">
                <li><a href="addproduct.php" class="btn btn-outline-dark shadow-sm">ADD</a></li>
                <li><button type="submit" id="delete-product-btn" value="delete" name="delete-product-btn" class="btn btn-outline-dark shadow-sm">MASS DELETE</button></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="col mt-5 justify-content-start">
            <div class="row justify-content-evenly">
                <?php
                   
                ?>
                <?php foreach($result as $resData) {?>
                    <div class='card border-dark text-center mb-4' style='max-width: 14rem;'>
                    <input class='delete-checkbox form-check-input m-2' type='checkbox' name="delete-checkbox[]" value="<?= $resData['id'];?>">
                        <div class='card-body'>
                            <p><?php echo $resData['sku']?></p>
                            <p><?php echo $resData['name']?></p>
                            <p><?php echo '$ ' . $resData['price']?></p>
                            <p><?php echo $resData['value']?></p>
                        </div>
                    </div>
                <?php }?>
            </div>
        </div>
    </div>
</form>

<?php include('templates/footer.php'); ?>

</body>
</html>
