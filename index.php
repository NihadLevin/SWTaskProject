<?php require_once 'inc/functions.php';
$data = new ProductsContr;
$data->getProductDataForDeleting($_POST);

include_once 'header.php';
?>
<form id="product_view_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="min-height: 91vh;">
    <div class="section-header">
        <div class="header-title">
            <h1>Product List</h1>
        </div>
        <div class="header-links">
            <a href="add-products.php" class="cbtn cbtn-primary">ADD PRODUCT</a>
            <input id="delete-product-btn" type="submit" class="cbtn cbtn-danger" value="MASS DELETE"
                name="delete_products">
        </div>
    </div>
    <div class="section-products">
        <?php
        $products = new ProductsView;
        $products->showAllProducts();
        if ($products->data) 
        {
        foreach ($products->showAllProducts() as $product) : ?>
        <div class="product-card">
            <input type="checkbox" class="delete-checkbox" name="delete_product[<?php echo $product->sku; ?>]">
            <a href="#">
                <div class="product-id">
                    <h3><?php echo $product->sku; ?></h3>
                </div>
                <div class="product-name">
                    <h2><?php echo $product->product_name; ?></h2>
                </div>
                <div class="product-price">
                    <h3><?php echo $product->product_price; ?><span>$</span></h3>
                </div>
                <div class="product-atrr">
                    <span><?php echo $product->product_attribute; ?>:</span>
                    <span><?php echo $product->product_attribute_value; ?></span>
                    <span><?php echo $product->product_attribute_measurement; ?></span>
                </div>
            </a>
        </div>
        <?php
            endforeach;
        }
        else
        {
            echo '<p class="lead fw-bold text-center"><i>There is no products in database</i></p>';
        }
        ?>

    </div>

</form>

<?php include_once 'footer.php';