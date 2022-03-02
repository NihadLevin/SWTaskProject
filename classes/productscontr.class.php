<?php 

class ProductsContr extends Products
{
    public $error;
    public $success;
    
    // Get post data from $_POST and validate input fields
    public function getNewProductData()
    {
        if (isset($_POST['save_product']))
        {
            if (empty($_POST['product_sku']) || empty($_POST['product_name']) || empty($_POST['product_price']) || empty($_POST['product_cattegory']) || empty($_POST['product_attribute']))
            {
                $this->error = 'Please fill out all fields';
            }
            else
            {
                // Getting the post data
                $product_sku       = strtoupper(trim($_POST['product_sku']));
                $product_name      = trim($_POST['product_name']);
                $product_price     = trim($_POST['product_price']);
                $product_cattegory = trim($_POST['product_cattegory']);
                $product_attributes = array_filter($_POST['product_attribute']);
                // Data validation
                $attributes = '';
                foreach ($product_attributes as $attribute)
                {
                    if (!strpos($attribute, ',')) {
                        if (intval(trim($attribute)) !== 0)
                        {
                            if ($product_cattegory == '3')
                            {
                                if (count($product_attributes) == 3)
                                {
                                    $attributes .= $attribute. 'x';
                                }
                                else
                                {
                                    $this->error = 'Please input all requested product attribute values';
                                }
                            }
                            else
                            {
                                $attributes .= $attribute;
                            }
                        }
                        else
                        {
                            $this->error = 'Product attribute value needs to be number and it can\'t be 0';
                        }
                    }
                    else
                    {
                        $this->error = 'Product attribute value needs to be number and it can\'t be 0, and for decimal values you need to use dot "." ';
                    }
                }
                $product_attributes_value = trim($attributes, 'x');
            
                if (strlen($product_sku) > '6')
                {
                    if (!strpos($product_price, ','))
                    {
                        if (floatval($product_price) != 0)
                        {
                            if (intval($product_cattegory) == 0)
                            {
                                $this->error = 'Please choose product cattegory';
                            }
                        }
                        else
                        {
                            $this->error = 'Product price needs to bee number and it can\'t be 0, and for decimal values you need to use dot "."';
                        }
                    }
                    else
                    {
                        $this->error = 'Product price needs to bee number and it can\'t be 0, and for decimal values you need to use dot "."';
                    }
                }
                else
                {
                    $this->error = 'Product SKU needs to have eight caracters';
                }           
            }
            if (isset($this->error))
            {
                // Checking if we have any errors
                return $this->error;
            }
            else
            {
                // If no errors while compiling data for input
                // $input_data = "'". $product_sku ."', '". $product_name ."', '". $product_price ."', '". $product_attributes_value ."', '". $product_cattegory ."'";
                $input_data = $product_sku .", ". $product_name .", ". $product_price .", ". $product_attributes_value .", ". $product_cattegory;
                $this->inputProductData($input_data);

            }
        }      
    }

    
    // Get necessary product data to delete product
    public function getProductDataForDeleting($post)
    {
        if (isset($_POST['delete_products']) && !empty($_POST['delete_product']))
        {
            $delete_data = $_POST['delete_product'];
            $this->deleteProductData($delete_data);
        }        
    }
    
}