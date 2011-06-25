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

    public function addCliente($nombre, $correo, $telefono, $clave)
    {
        $data = array(
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'clave' => $title,
            );
            $this->insert($data);
    } 

    public function updateCliente($nombre, $correo, $telefono, $clave)
    {
        $data = array(
            'nombre' => $nombre,
            'correo' => $correo,
            'telefono' => $telefono,
            'clave' => $title,
            );
            $this->update($data, 'id = '. (int)$id);
    } 

    public function deleteCliente($id)
    {
        this->delete('id =' . (int)$id);
    }

}
