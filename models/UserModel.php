<?php


class UserModel extends Model
{
    public function checkAdmin()
    {
        $login = $_POST['login'];
        $password = $_POST['password'];


        $sql = "SELECT * FROM users WHERE login = :login AND password = :password AND admin=true";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}
