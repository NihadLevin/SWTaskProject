<?php

class ProductsView extends Products
{
    public $data;
    public function showAllProducts()
    {
        $values = $this->getAllProducts();
        // return $values;
        if (!empty($values)) {
            $this->data = true;
            return $values;
        } else {
            $this->data = false;
            return $this->data;
        }
    }


    public function showProductCategories()
    {
        $values = $this->getProductCategories();
        return $values;
    }

}