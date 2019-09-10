# RNCB
Тестовое задание к собеседованию в RNCB

## Текст задания

Даны таблицы: 
1. users - таблица пользователей
2. users_cstm - таблица пользователей (связь с users через id=id_c) с доп. данными - режимом работы
3. sd_servicedesk - таблица заявок. date_end  - дедлайн, assigned_user_id - связь с users

Рассчитать дедлайн для всех заявок, в зависимости от режима работы каждого сотрудника, исключая праздничные и выходные дни. Праздничные дни хранятся в виде массива.
Режим работы каждого сотрудника - 5 дней в неделю (выходные суббота, воскресенье), 6 дней в неделю (выходной воскресенье), может быть режим работы 24/7.
Изначально заданные параметры наступления дедлайна: 40 часов, 80 часов.

### MainController

``` PHP

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

```

### Request Model

``` PHP
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
```

### Account Model

``` PHP
class Account extends Model
{
    public function getUsers() {
       $result = $this->db->row('SELECT users.id, users.name, users_cstm.work_time_c, users_cstm.work_time_end_c, users_cstm.week_days_graph_c 
FROM users LEFT JOIN users_cstm ON users.id = users_cstm.id_c');
        return $result;
    }
}
```

### SQL на создание бд
``` SQL

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `rncb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `sd_servicedesk`
--

CREATE TABLE `sd_servicedesk` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_entered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_end` datetime DEFAULT NULL,
  `assigned_user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sd_servicedesk`
--

INSERT INTO `sd_servicedesk` (`id`, `name`, `date_entered`, `date_end`, `assigned_user_id`) VALUES
(1, 'Не работает компьютер', '2019-09-05 20:09:49', '2019-09-20 04:09:49', 1),
(2, 'Сломался манипулятор типа мышь', '2019-09-05 20:09:49', '2019-09-19 04:09:49', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`) VALUES
(1, 'Олег'),
(2, 'Константин');

-- --------------------------------------------------------

--
-- Структура таблицы `users_cstm`
--

CREATE TABLE `users_cstm` (
  `id_c` int(11) UNSIGNED NOT NULL,
  `work_time_c` int(11) UNSIGNED DEFAULT NULL,
  `work_time_end_c` int(11) UNSIGNED DEFAULT NULL,
  `week_days_graph_c` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users_cstm`
--

INSERT INTO `users_cstm` (`id_c`, `work_time_c`, `work_time_end_c`, `week_days_graph_c`) VALUES
(1, 9, 18, 5),
(2, 9, 18, 6);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `sd_servicedesk`
--
ALTER TABLE `sd_servicedesk`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users_cstm`
--
ALTER TABLE `users_cstm`
  ADD PRIMARY KEY (`id_c`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `sd_servicedesk`
--
ALTER TABLE `sd_servicedesk`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
```

#### Использовано

- php 7.2, MySql 5.7
- MVC (Самописный), ООП
- Bootstrap 4.0, Jquary (Для ajax запроса на обновление данных)
