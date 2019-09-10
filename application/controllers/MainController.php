<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Db;
use application\models\Account;
use application\models\Request;
use DateInterval;
use DatePeriod;
use DateTime;

class MainController extends Controller
{
    public function indexAction () {
        // get a list of users
        $Account = new Account();
        $users = $Account->getUsers();

        // get a list of requests
        $Request = new Request();
        $requests = $Request->getRequests();

        $vars = [
            'users' => $users,
            'requests' => $requests
        ];

        $this->view->render('Главная страница', $vars);
    }

    public function setDeadlineAction() {
        // get a list of requests
        $Request = new Request();
        $requests = $Request->getRequests();

        foreach ($requests as $request) {
            $deadline = $this->deadlineCalculate($request['date_entered'], $_POST['time'], $request["work_time_c"], $request['work_time_end_c'], $request['week_days_graph_c']);
            $Request->updateDeadline($request['id'], $deadline);
        }
        return $this->view->location('/');
    }

    private function deadlineCalculate($date, $time, $work_time_start, $work_time_end, $work_days) {
        $deadline = strtotime($date);

        $work_time = ($work_time_end - $work_time_start) * 3600;
        $days = round($time / $work_time);
        $hours = $time % $work_time;

        $date_c = strtotime($date);
        $deadline += ($days * 86400) + $hours;

        $date_range = $this->getDatesFromRange(date('Y-m-d', $date_c), date('Y-m-d', $deadline));

        foreach ($date_range as $date) {
            if ($this->checkHolidayDate($date) || $this->checkOutputDate($date, $work_days)) {
                $deadline += 86400;
            }
        }

        return date('Y-m-d G:i:s', $deadline);
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