<?php
/**
 * Created by PhpStorm.
 * User: wemonsh
 * Date: 28.04.2018
 * Time: 12:23
 */

namespace application\models;

use application\core\Model;

class Main extends Model
{
    public function getNews() {
        $result = $this->db->row('SELECT news.id, news.title, news.description, news.photo, news.views, news.date, u.id AS user_id, u.first_name, u.last_name, u.middle_name FROM news 
JOIN users AS u ON news.author = u.id ORDER BY news.date DESC');
        return $result;
    }

    public function getStatistics() {
        $result = $this->db->row('SELECT id_statuses AS statuses, COUNT(id_statuses) AS quantity FROM `requests` GROUP BY id_statuses');
        return $result;
    }
}