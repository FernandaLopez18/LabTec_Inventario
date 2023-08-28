<?php

include_once 'api/models/modelCompras.php';
include_once 'api/database/db.php';

class controllerCompras
{
    private $model;

    public function __CONSTRUCT()
    {
        $this->model = new modelCompras();
    }

    public function Register($data = [])
    {
        $data = $this->model->Register($data);
        return $data;
    }

    public function List()
    {
        $data = $this->model->List();
        return $data;
    }

    public function ListById($id = "")
    {
        $data = $this->model->ListById($id);
        return $data;
    }

    
    public function DeleteById($id = "")
    {
        $data = $this->model->DeleteById($id);
        return $data;
    }

    public function UpdateById($data = [])
    {
        $data = $this->model->UpdateById($data);
        return $data;
    }
}
