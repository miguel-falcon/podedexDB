<?php
require_once '../models/PokemonModel.php';

class PokemonController {
    private $model;

    public function __construct() {
        $this->model = new PokemonModel();
    }

    public function handleRequest() {
        $action = $_POST['action'] ?? '';
        switch ($action) {
            case 'create':
                $name = $_POST['name'];
                $type = $_POST['type'];
                $level = $_POST['level'];
                $this->model->createPokemon($name, $type, $level);
                break;
            case 'read':
                echo json_encode($this->model->getAllPokemon());
                break;
            case 'update':
                $id = $_POST['id'];
                $name = $_POST['name'];
                $type = $_POST['type'];
                $level = $_POST['level'];
                $this->model->updatePokemon($id, $name, $type, $level);
                break;
            case 'delete':
                $id = $_POST['id'];
                $this->model->deletePokemon($id);
                break;
        }
    }
}

$controller = new PokemonController();
$controller->handleRequest();
?>