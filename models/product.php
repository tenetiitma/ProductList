<?php
ob_start();
require_once('./config/dbconfig.php');
$db = new dbconfig();

class Product extends Dbconfig {

    public function Store_Record() {
 
        global $db;

        if(empty($_POST['type'])) {
            echo '<div class="alert alert-danger"> Please, select product type </div>';
        }

        elseif($_POST['type'] === 'DVD') {
            $sku = $db->check($_POST['sku']);
            $name = $db->check($_POST['name']);
            $price = $db->check($_POST['price']);
            $productType = $db->check($_POST['type']);
            $size = $db->check($_POST['size']);

            if(empty($sku)) {
                echo '<div class="alert alert-danger"> Please, insert SKU! </div>';
            }
            if(empty($name)) {
                echo '<div class="alert alert-danger"> Please, insert name! </div>';
            }
            if(empty($price)) {
                echo '<div class="alert alert-danger"> Please, insert price! </div>';
            }
            if(empty($size)) {
                echo '<div class="alert alert-danger"> Please, insert DVD size! </div>';
            }
            if(!is_numeric($price)) {
                echo '<div class="alert alert-danger"> Please, provide price in numbers </div>';
            }
            if(!is_numeric($size)) {
                echo '<div class="alert alert-danger"> Please, provide size in numbers </div>';
            }

            elseif($this->insert_DVD($sku, $name, $price, $productType, $size)) {
                header("Location:index.php");
            }
        }

       elseif($_POST['type'] === 'Book') {
            $sku = $db->check($_POST['sku']);
            $name = $db->check($_POST['name']);
            $price = $db->check($_POST['price']);
            $productType = $db->check($_POST['type']);
            $weight = $db->check($_POST['weight']);

            if(empty($sku)) {
                echo '<div class="alert alert-danger"> Please, insert SKU! </div>';
            }
            if(empty($name)) {
                echo '<div class="alert alert-danger"> Please, insert name! </div>';
            }
            if(empty($price)) {
                echo '<div class="alert alert-danger"> Please, insert price! </div>';
            }
            if(empty($weight)) {
                echo '<div class="alert alert-danger"> Please, insert weight! </div>';
            }
            if(!is_numeric($price)) {
                echo '<div class="alert alert-danger"> Please, provide price in numbers </div>';
            }
            if(!is_numeric($weight)) {
                echo '<div class="alert alert-danger"> Please, provide weight in numbers </div>';
            }

            elseif($this->insert_Book($sku, $name, $price, $productType, $weight)) {
                header("Location:index.php");
            }
        }

       elseif($_POST['type'] === 'Furniture') {
            $sku = $db->check($_POST['sku']);
            $name = $db->check($_POST['name']);
            $price = $db->check($_POST['price']);
            $productType = $db->check($_POST['type']);

            $value = array(
                $height = $db->check($_POST['height']),
                $width = $db->check($_POST['width']),
                $length = $db->check($_POST['length'])
            );

            $ins = implode('x',$value);

            if(empty($sku)) {
                echo '<div class="alert alert-danger"> Please, insert SKU! </div>';
            }
            if(empty($name)) {
                echo '<div class="alert alert-danger"> Please, insert name! </div>';
            }
            if(empty($price)) {
                echo '<div class="alert alert-danger"> Please, insert price! </div>';
            }
            if(empty($height)) {
                echo '<div class="alert alert-danger"> Please, insert height! </div>';
            }
            if(empty($width)) {
                echo '<div class="alert alert-danger"> Please, insert width! </div>';
            }
            if(empty($length)) {
                echo '<div class="alert alert-danger"> Please, insert length! </div>';
            }
            if(!is_numeric($price)) {
                echo '<div class="alert alert-danger"> Please, provide price in numbers </div>';
            }
            if(!is_numeric($height)) {
                echo '<div class="alert alert-danger"> Please, provide height in numbers </div>';
            }
            if(!is_numeric($width)) {
                echo '<div class="alert alert-danger"> Please, provide width in numbers </div>';
            }
            if(!is_numeric($length)) {
                echo '<div class="alert alert-danger"> Please, provide length in numbers </div>';
            }

            elseif($this->insert_Furniture($sku, $name, $price, $productType, $ins)) {
                header("Location:index.php");
            }
        }
    }

    // Create product in DB

    public function insert_DVD($sku, $name, $price, $productType, $size) {
        global $db;
        
        $skuCheck = "SELECT sku FROM products WHERE sku = '$sku'";
        $result = mysqli_query($db->connection, $skuCheck);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="alert alert-danger"> SKU is already taken! </div>';
        } else {
            $query1 = "INSERT INTO products (sku, name, price) VALUES ('$sku', '$name', '$price')";
            $query2 = "INSERT INTO product_type (type, value) VALUES ('$productType', 'Size: $size MB')";
            $result1 = mysqli_query($db->connection, $query1);
            $result2 = mysqli_query($db->connection, $query2);

            if($result1 && $result2) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insert_Book($sku, $name, $price, $productType, $weight) {
        global $db;
        
        $skuCheck = "SELECT sku FROM products WHERE sku = '$sku'";
        $result = mysqli_query($db->connection, $skuCheck);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="alert alert-danger"> SKU is already taken! </div>';
        } else {
            $query1 = "INSERT INTO products (sku, name, price) VALUES ('$sku', '$name', '$price')";
            $query2 = "INSERT INTO product_type (type, value) VALUES ('$productType', 'Weight: $weight KG')";
            $result1 = mysqli_query($db->connection, $query1);
            $result2 = mysqli_query($db->connection, $query2);

            if($result1 && $result2) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function insert_Furniture($sku, $name, $price, $productType, $ins) {
        global $db;
        
        $skuCheck = "SELECT sku FROM products WHERE sku = '$sku'";
        $result = mysqli_query($db->connection, $skuCheck);

        if (mysqli_num_rows($result) > 0) {
            echo '<div class="alert alert-danger"> SKU is already taken! </div>';
        } else {
            $query1 = "INSERT INTO products (sku, name, price) VALUES ('$sku', '$name', '$price')";
            $query2 = "INSERT INTO product_type (type, value) VALUES ('$productType', 'Dimensions: $ins')";
            $result1 = mysqli_query($db->connection, $query1);
            $result2 = mysqli_query($db->connection, $query2);

            if($result1 && $result2) {
                return true;
            } else {
                return false;
            }
        }
    }
    
    // Read all products in DB

    public function view_Record() {
        global $db;
        $query = "SELECT products.id, sku, name, price, value FROM products LEFT JOIN product_type ON products.id = product_type.id";
        $result = mysqli_query($db->connection, $query);
        return $result;
    }

    // Delete product from DB

    public function delete_Record() {

        if(isset($_POST['delete-product-btn'])) {
            global $db;
            
            $all_id = $_POST['delete-checkbox'] ?? '';
            if (!empty($all_id)) {
                $extract_id = implode(',', $all_id);

                $query = "DELETE products, product_type FROM products INNER JOIN product_type ON products.id = product_type.id WHERE products.id AND product_type.id IN ($extract_id)";
                mysqli_query($db->connection, $query);
                header("Location:index.php");
                exit;
            }
            else {
                  echo '<div class="alert alert-danger"> No products selected! </div>';
            }
        }
    }
}
