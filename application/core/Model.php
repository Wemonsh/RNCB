<?php
/**
 * Created by PhpStorm.
 * User: wemonsh
 * Date: 28.04.2018
 * Time: 12:30
 */

namespace application\core;

use application\lib\Db;

abstract class Model
{
    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }
}