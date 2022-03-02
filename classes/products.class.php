<?php

abstract class Products extends Connection
{
    // Get all products from database
    protected function getAllProducts()
    {
        $stmt = "SELECT *, products.id
                 FROM products_cattegory AS c
                 INNER JOIN products ON products.product_cattegory = c.id
                 ORDER BY products.sku ASC
                ";
        $results = $this->getDataFromDB($stmt);
        if (!empty($results)) {
            return $results;
        }
    }

    // Get all product cattegories from database
    protected function getProductCategories()
    {
        $stmt = "SELECT
                    *
                FROM
                    products_cattegory
                    ";
            $results = $this->getDataFromDB($stmt);
            if (!empty($results)) {
                return $results;
            }
    }

    // Add new product to database 
    protected function inputProductData($input_data) {
        $stmt = $this->conn->prepare("INSERT INTO products (sku, product_name, product_price, product_attribute_value, product_cattegory)
        VALUES (?, ?, ?, ?, ?)");
        
        $input = explode(',', $input_data);
        
        $stmt->bind_param("ssssi", $input[0], $input[1], $input[2], $input[3], $input[4] );
        $this->addProducts($stmt);

    }

    // Delete product from database
    protected function deleteProductData($delete_data)
    {
        foreach ($delete_data as $data => $value)
        {
            $stmt = "DELETE FROM products WHERE sku='$data'";
            $this->deleteProducts($stmt);
        }

    }
}