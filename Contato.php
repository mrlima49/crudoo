<?php

class Contato{
    private $pdo;

    public function __construct(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=crudpoo", "root", "");
    }

    public function create($nome, $email){
        if($this->existsEmail($email) == false){
            $sql = "INSERT INTO contatos(nome, email) VALUES(?,?)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $email);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                echo "<p>Contato inserido com sucesso.</p>";
            }
        }else{
            echo "<p>Já existe um usuario cadastrado com essa conta de email</p>";
        }
    }

    public function read(){
        $sql = "SELECT * FROM contatos";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $dados = $stmt->fetchAll();
        }else{
            echo "<p>Não existe contatos cadastrados</p>";
        }
    }

    public function update($nome, $email, $id){
        $sql = "UPDATE contatos SET nome = ?, email = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $nome);
            $stmt->bindValue(2, $email);
            $stmt->bindValue(3, $id);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                echo "<p>Contato editado com sucesso</p>";
            }else{
                echo "<p>Erro ao editar contato</p>";
            }
    }

    public function delete($email){
        if($this->existsEmail($email)){
            $sql = "DELETE FROM contatos WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(1, $email);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                echo "<p>Contato excluido com sucesso</p>";
            }
        }
    }

    private function existsEmail($email){
        $sql = "SELECT email FROM contatos WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(1, $email);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        }else{
            return false;
        }
    }

}