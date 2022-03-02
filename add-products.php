<?php require_once 'inc/functions.php';
$data = new ProductsContr;
$data->getNewProductData($_POST);

include_once 'header.php';
?>
<form id="product_form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="min-height: 91vh;">
    <div id="form-head" class="row pt-2">
        <div class="col-lg-9">
            <h1>Product Add</h1>
        </div>
        <div class="col-lg-3 text-end mt-2 mb-3">
            <input type="submit" class="btn btn-md btn-success" value="Save" name="save_product">
            <a href="index.php" class="btn btn-md btn-primary">Cancel</a>
        </div>
        <hr>
    </div>
    <div class="row m-auto mt-3" style="max-width: 800px;">
        <div class="row mb-3">
            <div class="row mb-3">
                <label for="sku" class="col-md-2 col-form-label">SKU</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control" id="sku"
                        placeholder="Stock keeping unit number" name="product_sku">
                </div>
            </div>
            <div class="row mb-3">
                <label for="name" class="col-md-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" placeholder="Product name" name="product_name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="price" class="col-md-2 col-form-label">Price ($)</label>
                <div class="col-md-10">
                    <input type="text" class="form-control form-control" id="price" placeholder="Product price"
                        name="product_price">
                </div>
            </div>
            <div class="row mb-3">
                <label for="productType" class="col-md-2 col-form-label">Type Switcher</label>
                <div class="col-md-10">
                    <select id="productType" class="form-control form-select" name="product_cattegory">
                        <option value="0">Type Switcher</option>
                        <?php 
                                $results = new ProductsView();
                                foreach ($results->showProductCategories() as $result) {
                                    echo '<option id="'. $result->product_cattegory_name .'" value="'. $result->id .'">'. $result->product_cattegory_name .'</option>';
                                }
                            ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="input-field" class="row input-group mb-3">
            <div id="Default" class="row mb-3" style="display:none;">
                <p class="lead">Please chose cattegory of product above.</p>
            </div>
            <div id="BookCat" class="row mb-3" style="display:none;">
                <p><i><b>Book is selected</b></i></p>
                <label for="weight" class="col-md-2 col-form-label">Weight (KG)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control" id="weight"
                        placeholder="Please enter book weight" name="product_attribute[]">
                </div>
                <p class="text-center text-secondary"><i>* Please provide Book weight in KG (kilograms).</i></p>
            </div>
            <div id="DVDCat" class="row mb-3" style="display:none;">
                <p><i><b>DVD is selected</b></i></p>
                <label for="size" class="col-md-2 col-form-label">Size (MB)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control form-control" id="size" placeholder="Please enter dvd size"
                        name="product_attribute[]">
                </div>
                <p class="text-center text-secondary"><i>* Please provide DVD size in MB (megabytes).</i></p>
            </div>
            <div id="FurnitureCat" class="row mb-3" style="display:none;">
                <p><i><b>Furniture is selected</b></i></p>
                <label for="height" class="col-md-2 col-form-label">Height (CM)</label>
                <div class="col-sm-10 mb-2">
                    <input type="text" class="form-control form-control" id="height" placeholder="Height of the product"
                        name="product_attribute[]">
                </div>
                <label for="width" class="col-md-2 col-form-label">Width (CM)</label>
                <div class="col-sm-10 mb-2">
                    <input type="text" class="form-control form-control" id="width" placeholder="Width of the product"
                        name="product_attribute[]">
                </div>
                <label for="length" class="col-md-2 col-form-label">Length (CM)</label>
                <div class="col-sm-10 mb-2">
                    <input type="text" class="form-control form-control" id="length" placeholder="Lenght of the product"
                        name="product_attribute[]">
                </div>
                <p class="text-center text-secondary"><i>* Please provide dimensions in HxWxL format.</i></p>
            </div>
        </div>
    </div>
</form>
<div class="container">
    <div class="row">
        <p class="text-danger text-center fw-bold">
            <?php 
                if (isset($data->error))
                {
                    echo $data->error;
                }
                else if (isset($data->success))
                { 
                    echo $data->success;
                }
                ?>
        </p>
    </div>
</div>


<?php include_once 'footer.php';