<?php

interface ICrud
{
    public function create($obj);

    public function getAll();

    public function update($id, $obj);

    public function delete($id);
}

?>
