<div class="container-fluid">
<?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
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
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-gray-800">Users</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUserModal">
            <i class="fas fa-user-plus"></i> Add User
        </button>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Add User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm" action="<?php echo base_url('user/add'); ?>" method="post">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                            value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="form-group">
                            <label for="userName">Name</label>
                            <input type="text" class="form-control" id="userName" name="userName" required>
                        </div>
                        <div class="form-group">
                            <label for="userPassword">Password</label>
                            <input type="password" class="form-control" id="userPassword" name="userPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="userPicture">Picture URL</label>
                            <input type="text" class="form-control" id="userPicture" name="userPicture">
                        </div>
                        <div class="form-group">
                            <label for="userLevel">Level</label>
                            <select class="form-control" id="userLevel" name="userLevel" required>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userStatus">Status</label>
                            <select class="form-control" id="userStatus" name="userStatus" required>
                                <option value="_1">Active</option>
                                <option value="_0">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" id="userTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>User Level</th>
                            <th>Status</th>
                            <th style="width: 8%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users) && is_array($users)): ?>
                            <?php foreach ($users as $index => $user): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo $user['userName']; ?></td>
                                    <td><?php echo $user['userLevel']; ?></td>
                                    <td>
                                        <?php if ($user['userStatus'] == '_1'): ?>
                                            <span class="text-success"><i class="fas fa-check-circle"></i> Active</span>
                                        <?php else: ?>
                                            <span class="text-danger"><i class="fas fa-times-circle"></i> Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <a href="<?php echo base_url('user/detail/' . $user['userId']); ?>"
                                            class="btn btn-info btn-sm">Detail</a>
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