<?php
require_once 'DB.php';
require_once 'ICrud.php';

class ProductDal extends DB implements ICrud
{
    public function create($obj)
    {
        // TODO: Implement create() method.
        try {
            $this->pdo->query('INSERT INTO products (name) VALUES ("' . $obj->getName() . '")');
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAll()
    {
        // TODO: Implement getAll() method.
        try {
            $rs = $this->pdo->query('SELECT * FROM products');
            return $rs->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return null;
        }
    }

    public function update($id, $obj)
    {
        // TODO: Implement update() method.
        try {
            $this->pdo->query('UPDATE products SET name = "' . $obj->getName() . '" WHERE id = ' . $id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
        try {
            $this->pdo->query('DELETE FROM products WHERE id = ' . $id);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

