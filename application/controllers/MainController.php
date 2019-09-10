<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;
use application\models\Account;
use DateInterval;
use DatePeriod;
use DateTime;

class MainController extends Controller
{
    public function indexAction () {

        $Account = new Account();
        $users = $Account->getUsers();


        $hours40 = 144000;
        $hours80 = 288000;

        $work_time_start = 0;
        $work_time_end = 24;
        $work_days = 5;

        $work_time = ($work_time_end - $work_time_start) * 3600;
        $days = round($hours40 / $work_time);
        $hours = $hours40 % $work_time;

        echo '<pre>';
        echo $days;
        echo '</pre>';

        echo '<pre>';
        echo $hours;
        echo '</pre>';

        $date_c = strtotime('2019-09-05 20:09:49');

        $deadline = strtotime('2019-09-05 20:09:49');
        $deadline += ($days * 86400) + $hours;





        var_dump(date('Y-m-d G:i:s', $date_c));
        var_dump(date('Y-m-d G:i:s', $deadline));

        $date_range = $this->getDatesFromRange(date('Y-m-d', $date_c), date('Y-m-d', $deadline));

        echo '<pre>';
        var_dump($date_range);
        echo '</pre>';

        foreach ($date_range as $date) {
            if ($this->checkHolidayDate($date) || $this->checkOutputDate($date, $work_days)) {
                $deadline += 86400;
            }
        }

        var_dump(date('Y-m-d G:i:s', $deadline));

        exit();
        debug();

        $vars = [
            'users' => $users
        ];

        $this->view->render('Главная страница', $vars);
    }




    private function checkOutputDate($date, $mode) {
        $day = date('w', strtotime($date));
        if ($mode == 5) {
            if ($day == 0 || $day == 6) {
                return true;
            } else {
                return false;
            }
        } else if ($mode == 6) {
            if ($day == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    private function checkHolidayDate($date) {
        $holidays = ['2019-09-06', '2019-09-07'];
        if (in_array($date, $holidays)) {
            return true;
        } else {
            return false;
        }
    }

    private function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }
}