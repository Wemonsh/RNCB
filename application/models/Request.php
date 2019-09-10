<?php


namespace application\models;


use application\core\Model;

class Request extends Model
{
    public function getRequests() {
        $result = $this->db->row('SELECT sds.id, sds.name as title, sds.date_entered, sds.date_end, u.name, ucstm.work_time_c, ucstm.work_time_end_c, ucstm.week_days_graph_c
FROM sd_servicedesk as sds
LEFT JOIN users as u ON u.id = sds.assigned_user_id
LEFT JOIN users_cstm as ucstm ON ucstm.id_c = u.id');
        return $result;
    }

    public function updateDeadline($id, $date) {
        $result = $this->db->row('UPDATE sd_servicedesk SET date_end = :date WHERE id = :id',
            ['id' => $id, 'date' => $date]);
        return $result;
    }
}