<?php 
require('top.inc.php');
$name = '';
$mrp = '';
$price = '';
$qty = '';
$image = '';
$short_description = '';
$description = '';
$meta_title = '';
$meta_description = '';
$meta_keyword = '';

$msg = '';
if(isset($_GET['id']) && $_GET['id'] != ''){
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM products WHERE id='$id'");
    $check = mysqli_num_rows($res);
        if($check > 0) {
            $row = mysqli_fetch_assoc($res);
            $categories_id = $row['categories_id'];
            $mrp = $row['mrp'];
            $price = $row['price'];
            $qty = $row['qty'];
            $short_description = $row['short_description'];
            $description = $row['description'];
            $meta_title = $row['meta_title'];
            $meta_description = $row['meta_description'];
            $meta_keyword = $row['meta_keyword'];
           


        }else {
            header('location:product.php');
            die();

    }

  
}

if(isset($_POST['submit'])){
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $qty = get_safe_value($con, $_POST['qty']);
    $short_description = get_safe_value($con, $_POST['short_description']);
    $description = get_safe_value($con, $_POST['description']);
    $meta_title = get_safe_value($con, $_POST['meta_title']);
    $meta_description = get_safe_value($con, $_POST['meta_description']);
    $meta_keyword = get_safe_value($con, $_POST['meta_keyword']);

    
    $res = mysqli_query($con, "SELECT * FROM products WHERE name='$name'");
    $check = mysqli_num_rows($res);
    if($check > 0){
        if(isset($_GET['id']) && $_GET['id'] != ''){
            $getData = mysqli_fetch_assoc($res);
            if($id == $getData['id']){

            }else {
                $msg = " Product Already Exists";

            }
        
        }else{
            $msg = " Product Already Exists";

        }
        
    } 
    if($msg == '') {
        if(isset($_GET['id']) && $_GET['id'] != ''){
            mysqli_query( $con, "UPDATE products SET categories_id = '$categories_id', name = '$name', mrp = '$mrp',
            price = '$price', qty = '$qty', short_description = '$short_description',
            description = '$description', meta_title = '$meta_title',
            meta_description = '$meta_description', meta_keyword = '$meta_keyword'
             WHERE id = '$id'");
    
        } else {
            mysqli_query( $con, "INSERT INTO products(categories_id, name, mrp, price,
             qty, short_description, description, meta_title, meta_description, meta_keyword, status) 
             values('$categories_id', '$name', '$mrp', '$price',
             '$qty', '$short_description', '$description', '$meta_title',
              '$meta_description', '$meta_keyword','1')");
    

        }
        header('location:product.php');
        die();
  }
    }
?>

<div class="content pb-0">
  <div class="animated fadeIn">
      <div class="row">
        <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><strong>Product </strong><small> Form</small></div>
              <div class="card-body card-block">
                  <form action="" method="POST">
                  <div class="form-group">
                    <label for="categories" class=" form-control-label">Category</label>
                    <select name="categories_id" class="form-control">
                        <option> Select Category</option>
                        <?php
                        $res = mysqli_query($con, "SELECT id, categories FROM categories ORDER BY categories asc");
                        while ($row = mysqli_fetch_assoc($res)) {
                            echo "<option value=".$row['id'].">".$row['categories']."</option>";
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group">
                      <input type="text" name="name" placeholder="Enter your product name" class="form-control" required value="<?php echo $name; ?>">
                    </div>  
                    <div class="form-group">
                      <input type="text" name="mrp" placeholder="Enter your MRP " class="form-control" required value="<?php echo $mrp; ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" name="price" placeholder="Enter your Selling Price" class="form-control" required value="<?php echo $price; ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" name="qty" placeholder="Enter Quantity" class="form-control" required value="<?php echo $qty; ?>">
                    </div> 
                    <div class="form-group">
                      <input type="file" name="image" class="form-control">
                    </div> 
                    <div class="form-group">
                        <textarea name="short_description" cols="30" rows="10" class="form-control" placeholder="Enter Short Description" required ><?php echo $short_description; ?></textarea>
                      
                    </div> 
                    <div class="form-group">
                    <textarea name="description" cols="30" rows="10" class="form-control" placeholder="Enter Description" required ><?php echo $description; ?></textarea>
                    </div> 
                    <div class="form-group">
                      <input type="text" name="meta_title" placeholder="Enter your meta-title" class="form-control" required value="<?php echo $meta_title; ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" name="meta_description" placeholder="Enter your meta-description" class="form-control" required value="<?php echo $meta_description; ?>">
                    </div> 
                    <div class="form-group">
                      <input type="text" name="meta_keyword" placeholder="Enter your meta-keyword" class="form-control" required value="<?php echo $meta_keyword; ?>">
                    </div> 

                    
                    <button id="payment-button" name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                    <span id="payment-button-amount" name="submit">Submit</span>
                    </button>
                    <div class="field_error">
                      <?php echo $msg; ?>
                    </div>
                  </form>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>
      
<?php 
require('footer.inc.php');

?>      