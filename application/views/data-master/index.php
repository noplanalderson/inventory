<div class="container-fluid">
    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('message'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Manufacture</h3>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#dynamicModal" data-type="manufacture" data-action="add">Add Manufacture</button>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable" id="manufactureTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Manufacture Name</th>
                                        <th>Group Name</th>
                                        <th style="width: 16%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($manufactures) && is_array($manufactures)): ?>
                                        <?php foreach ($manufactures as $index => $manufacture): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $manufacture['manuName']; ?></td>
                                                <td><?= $manufacture['group']['groupName']; ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <button class="btn btn-info btn-sm mx-2" data-toggle="modal"
                                                        data-target="#dynamicModal" data-type="manufacture" data-action="update"
                                                        data-id="<?= $manufacture['manuId']; ?>"
                                                        data-name="<?= $manufacture['manuName']; ?>"
                                                        data-group-id="<?= $manufacture['group']['groupId']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm mx-2" data-toggle="modal"
                                                        data-target="#deleteModal" data-id="<?= $manufacture['manuId']; ?>"
                                                        data-type="manufacture">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Device Model</h3>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#dynamicModal" data-type="device_model" data-action="add">Add Device Model</button>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable" id="deviceModelTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Model Name</th>
                                        <th>Manufacture Name</th>
                                        <th style="width: 16%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($deviceModels) && is_array($deviceModels)): ?>
                                        <?php foreach ($deviceModels as $index => $device_model): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $device_model['modelName']; ?></td>
                                                <td><?= $device_model['manufacture']['manuName']; ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <button class="btn btn-info btn-sm mx-2" data-toggle="modal"
                                                        data-target="#dynamicModal" data-type="device_model"
                                                        data-action="update" data-id="<?= $device_model['modelId']; ?>"
                                                        data-name="<?= $device_model['modelName']; ?>"
                                                        data-description="<?= $device_model['description']; ?>"
                                                        data-manufacture-id="<?= $device_model['manufacture']['manuId']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm mx-2" data-toggle="modal"
                                                        data-target="#deleteModal" data-id="<?= $device_model['modelId']; ?>"
                                                        data-type="device_model">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-4 text-dark bg-dark">

        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>Device Group</h3>
                    <button type="button" class="btn btn-primary float-right" data-toggle="modal"
                        data-target="#dynamicModal" data-type="device_group" data-action="add">Add Device Group</button>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered dataTable" id="deviceGroupTable" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Device Group Name</th>
                                        <th>Icon</th>
                                        <th style="width: 16%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($deviceGroups) && is_array($deviceGroups)): ?>
                                        <?php foreach ($deviceGroups as $index => $device_group): ?>
                                            <tr>
                                                <td><?= $index + 1; ?></td>
                                                <td><?= $device_group['groupName']; ?></td>
                                                <td><?= $device_group['groupIcon']; ?></td>
                                                <td class="d-flex justify-content-center">
                                                    <button class="btn btn-info btn-sm mx-2" data-toggle="modal"
                                                        data-target="#dynamicModal" data-type="device_group"
                                                        data-action="update" data-id="<?= $device_group['groupId']; ?>"
                                                        data-name="<?= $device_group['groupName']; ?>"
                                                        data-icon="<?= $device_group['groupIcon']; ?>">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm mx-2" data-toggle="modal"
                                                        data-target="#deleteModal" data-id="<?= $device_group['groupId']; ?>"
                                                        data-type="device_group">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="dynamicModal" tabindex="-1" role="dialog" aria-labelledby="dynamicModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="dynamicModalLabel">Add/Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dynamicForm" method="post" action="">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <div id="dynamicFields">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus Data Ini?
            </div>
            <div class="modal-footer">
                <form id="deleteForm" method="post" action="">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        $('#dynamicModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var type = button.data('type');
            var action = button.data('action');
            var id = button.data('id');
            var modal = $(this);
            var modalTitle = (action === 'add' ? 'Add ' : 'Edit ') + type.replace('_', ' ');
            modal.find('.modal-title').text(modalTitle);

            var dynamicFields = $('#dynamicFields');
            dynamicFields.empty();

            var formattedType;
            var fields;
            switch (type) {
                case 'manufacture':
                    formattedType = 'Manufacture';
                    fields = `
                        <div class="form-group">
                            <label for="manuName">Manufacture Name</label>
                            <input type="text" class="form-control" id="manuName" name="manuName" required>
                        </div>
                        <div class="form-group">
                            <label for="groupId">Group Name</label>
                            <select class="form-control" id="groupId" name="groupId" required>
                                <option value="" disabled selected>Select Group</option>
                                <?php foreach ($deviceGroups as $group): ?>
                                <option value="<?= $group['groupId']; ?>"><?= $group['groupName']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    `;
                    break;
                case 'device_model':
                    formattedType = 'DeviceModel';
                    fields = `
                        <div class="form-group">
                            <label for="modelName">Model Name</label>
                            <input type="text" class="form-control" id="modelName" name="modelName" required>
                        </div>
                        <div class="form-group">
                            <label for="manuId">Manufacture Name</label>
                            <select class="form-control" id="manuId" name="manuId" required>
                                <option value="" disabled selected>Select Manufacture</option>
                                <?php foreach ($manufactures as $manufacture): ?>
                                <option value="<?= $manufacture['manuId']; ?>"><?= $manufacture['manuName']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    `;
                    break;
                case 'device_group':
                    formattedType = 'DeviceGroup';
                    fields = `
                        <div class="form-group">
                            <label for="groupName">Device Group Name</label>
                            <input type="text" class="form-control" id="groupName" name="groupName" required>
                        </div>
                        <div class="form-group">
                            <label for="groupIcon">Icon</label>
                            <input type="text" class="form-control" id="groupIcon" name="groupIcon" required>
                        </div>
                    `;
                    break;
            }

            var formAction = '<?php echo base_url(); ?>' + `DataMaster/${action === 'add' ? 'add' : 'update'}${formattedType}`;
            dynamicFields.append(fields);

            if (action === 'update') {
                $('#dynamicForm #manuName').val(button.data('name'));
                $('#dynamicForm #groupId').val(button.data('group-id'));
                $('#dynamicForm #modelName').val(button.data('name'));
                $('#dynamicForm #description').val(button.data('description'));
                $('#dynamicForm #manuId').val(button.data('manufacture-id'));
                $('#dynamicForm #groupName').val(button.data('name'));
                $('#dynamicForm #groupIcon').val(button.data('icon'));

                formAction += "/" + id;
            }
            $('#dynamicForm').attr('action', formAction);

        });

        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var type = button.data('type');
            var formattedType = type.charAt(0).toUpperCase() + type.slice(1).replace('_', '');
            console.log(formattedType);
            var formAction = '<?php echo base_url(); ?>' + `DataMaster/delete${formattedType}/` + id;
            $('#deleteForm').attr('action', formAction);
        });
    });
</script>