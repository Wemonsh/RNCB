<h1>РНКБ</h1>

<form class="ajax" action="/api/set-deadline" method="post">
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="time" value="144000">
        <label class="form-check-label" for="inlineRadio1">40 hours</label>
    </div>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="time" value="288000">
        <label class="form-check-label" for="inlineRadio2">80 hours</label>
    </div>
    <button type="submit" class="btn btn-primary">Confirm</button>
</form>

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

<table class="table">
    <caption>Requests</caption>
    <thead>
    <tr>
        <th scope="col">id</th>
        <th scope="col">title</th>
        <th scope="col">date_entered</th>
        <th scope="col">date_end</th>
        <th scope="col">name</th>
        <th scope="col">work_time_c</th>
        <th scope="col">work_time_end_c</th>
        <th scope="col">week_days_graph_c</th>
    </tr>
    </thead>
    <tbody>
    <? foreach ($requests as $request):?>
        <tr>
            <td><?= $request['id']?></td>
            <td><?= $request['title']?></td>
            <td><?= $request['date_entered']?></td>
            <td><?= $request['date_end']?></td>
            <td><?= $request['name']?></td>
            <td><?= $request['work_time_c']?></td>
            <td><?= $request['work_time_end_c']?></td>
            <td><?= $request['week_days_graph_c']?></td>
        </tr>
    <? endforeach;?>
    </tbody>
</table>