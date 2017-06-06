<div class="container">
    <div class="row">
        <div class="col-md-12">
    <h3>Usuarios</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr data-id="<?= $user->id ?>">
                <td><?= $user->id ?></td>
                <td><?= $user->first_name ?></td>
                <td><?= $user->last_name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->phone ?></td>
                <td>
                    <?php if ($user->active): ?>
                        <input type="checkbox" name="active" checked>
                    <?php else: ?>
                        <input type="checkbox" name="active">
                    <?php endif ?>
                </td>
                <td>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
        </div>
    </div>
</div>

<script>
    $("[name='active']").bootstrapSwitch({
        'onText': 'Si',
        'offText': 'No',
        'onColor': 'success',
        'offColor': 'danger'
    });
    $('input[name="active"]').on('switchChange.bootstrapSwitch', function(event, state) {
        var row = $(this).parents('tr');
        var id = row.data('id');
        var data = {
            'id': id,
            'active': state == true ? 1 : 0
        };
        var url = basePath + 'users/updateStatus';

        $.post(url, data, function(result) {
            var obj = $.parseJSON(result);
        }).fail(function () {
            alert('Ocurrio un error :-(');
        });
    });
</script>
