<?php

class Application_Model_DbTable_Clientes extends Zend_Db_Table_Abstract
{

    protected $_name = 'clientes';

    public function getCliente($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addCliente($nombre, $email, $telefono, $clave)
    {
        $data = array(
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'clave' => $clave,
            );
            $this->insert($data);
    } 

    public function updateCliente($nombre, $email, $telefono, $clave)
    {
        $data = array(
            'nombre' => $nombre,
            'email' => $email,
            'telefono' => $telefono,
            'clave' => $clave,
            );
            $this->update($data, 'id = '. (int)$id);
    } 

    public function deleteCliente($id)
    {
        $this->delete('id =' . (int)$id);
    }
}
