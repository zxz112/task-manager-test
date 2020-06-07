<?php

class TaskModel extends Model
{
    public function getPage($numPage, $itemsOnPage, $sortBy, $orderBy)
    {

        $sql = "SELECT * FROM tasks ORDER BY $sortBy $orderBy LIMIT $numPage, $itemsOnPage";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function count()
    {
        $sql = "SELECT COUNT(*) FROM tasks";
        $stmt = $this->db->query($sql);
        $res = $stmt->fetchColumn();
        return $res;
    }

    public function insert($data)
    {
        $currentData = implode(',' , array_map(function($value) {
            return $this->db->quote($value);
        }, $data));
        $sql = "INSERT INTO tasks (name, email, content, status) VALUES ($currentData , false)";
        $stmt = $this->db->exec($sql);
    }

    public function updateStatus($id)
    {
        $sql = "UPDATE tasks SET status = 1 WHERE id = $id";
        $stmt = $this->db->exec($sql);
    }

    public function update($id, $content)
    {
        $sql = "UPDATE tasks SET content = '$content', updated = 1 WHERE id = '$id'";
        $stmt = $this->db->exec($sql);
    }
}
