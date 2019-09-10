<?php

namespace application\models;


use application\core\Model;

class Account extends Model
{
    public function getUsers() {
       $result = $this->db->row('SELECT users.id, users.name, users_cstm.work_time_c, users_cstm.work_time_end_c, users_cstm.week_days_graph_c 
FROM users LEFT JOIN users_cstm ON users.id = users_cstm.id_c');
        return $result;
    }
}
