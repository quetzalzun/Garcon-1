<?php

class Application_Model_DbTable_Productos extends Zend_Db_Table_Abstract 
{  
    protected $_name = 'productos';

    public function getProducto($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);

        if (!$row) {
            throw new Exception("No puede encontrar el registro $id");
        }
        
        return $row->toArray();
     }

     public function addProducto($name, $description, $price, $quantity)
     {
         $data = array(
         'name' => $name,
         'description' => $description,
         'price' => $price,
         'quantity' => $quantity, );
              	    
          $this->insert($data);
      }

      public function updateProducto($id, $name, $price, $quantity)
      {
          $data = array(
          'name' => $name,
          'description' => $description, 
          'price' => $price,
          'quantity' => $quantity,
          );

          $this->update($data, 'id = '. (int)$id);
      }

     public function deleteProducto($id)
     {
          $this->delete('id =' . (int)$id);
     }
}
