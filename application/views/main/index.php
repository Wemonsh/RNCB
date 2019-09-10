<h1>РНКБ</h1>

<table class="table">
    <caption>Users</caption>
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">name</th>
        <th scope="col">work_time_c</th>
        <th scope="col">work_time_end_c</th>
        <th scope="col">week_days_graph_c</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($users as $user):?>
        <tr>
            <td><?= $user['id']?></td>
            <td><?= $user['name']?></td>
            <td><?= $user['work_time_c']?></td>
            <td><?= $user['work_time_end_c']?></td>
            <td><?= $user['week_days_graph_c']?></td>
        </tr>
    <? endforeach;?>
    </tbody>
</table>