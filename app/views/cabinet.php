<div>

    <table class="table ">
        <tr>
            <th colspan="4"><h1>RSS ресурси</h1></th>
        </tr>
        <tr class="success">
            <th class="text-center">Назва ресурсу</th>
            <th class="text-center">URL адреса</th>
            <th class="text-center">Змінити</th>
            <th class="text-center">Видалити</th>
        </tr>
        <?php foreach ($items as $item): ?>
        <tr class="success">
            <form method="POST" action="<?= $item['id'] ?>">
                <input type="hidden" id="_method" name="_method" value="PUT" />
            <td>
                <input type="text" class="form-control" id="name" name="name" value="<?= $item['name'] ?>" required>
            </td>
            <td>
                <input type="url" class="form-control" id="url" name="url" value="<?= $item['url'] ?>" required>
            </td>
            <td class="text-center">
                    <input type="hidden" class="form-control" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" class="btn btn-info btn-md"><span class="glyphicon glyphicon-pencil"></span></button>
            </td>
            </form>
            <td class="text-center">
                <form method="POST" action="<?= $item['id'] ?>">
                    <input type="hidden" id="_method" name="_method" value="DELETE" />
                    <input type="hidden" class="form-control" name="id" value="<?= $item['id'] ?>">
                    <button type="submit" class="btn btn-danger btn-md"><span class="glyphicon glyphicon-remove"></span></button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

        <tr>
            <th colspan="4"><h1><small>Новий ресурс</small></h1></th>
        </tr>
        <tr class="info">
            <th class="text-center">Назва ресурсу:</th>
            <th colspan="2" class="text-center">URL адреса:</th>
            <th></th>
        </tr>
        <form class="form-horizontal" method="POST">
        <tr class="info">
            <td>
                <input type="text" class="form-control" name="name" required>
            </td>
            <td colspan="2">
                <input type="url" class="form-control" name="url" required>
            </td>
            <td class="text-center">
                <button type="submit" class="btn btn-primary btn-md">Додати</button>
            </td>
        </tr>
        </form>

    </table>

</div>
