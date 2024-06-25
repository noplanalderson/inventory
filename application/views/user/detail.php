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

    <h1 class="h3 mb-4 text-gray-800">User Detail</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                    <div>
                        <button id="deleteButton" type="button" class="btn btn-danger" data-toggle="modal"
                            data-target="#deleteModal">Delete</button>
                        <button type="button" class="btn btn-primary" id="editButton">Edit</button>
                    </div>
                </div>
                <div class="card-body">
                    <?php echo form_open_multipart(base_url('user/update/' . $user['userId']), 'id="editUserForm" method="post"');?>
                        <div class="form-group">
                            <label for="userName"><strong>Username:</strong></label>
                            <input type="text" class="form-control" id="userName" name="userName"
                                value="<?php echo $user['userName']; ?>" disabled required>
                        </div>
                        <div class="form-group">
                            <label for="userPassword"><strong>Password:</strong></label>
                            <input type="password" class="form-control" id="userPassword" name="userPassword"
                                placeholder="********" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="passwordRepeat"><strong>Repeat Password:</strong></label>
                            <input type="password" class="form-control" id="passwordRepeat" name="passwordRepeat"
                                placeholder="********" required disabled>
                        </div>
                        <div class="form-group">
                            <label for="userLevel"><strong>User Level:</strong></label>
                            <select class="form-control" id="userLevel" name="userLevel" disabled required>
                                <option value="admin" <?php echo $user['userLevel'] == 'admin' ? 'selected' : ''; ?>>Admin
                                </option>
                                <option value="user" <?php echo $user['userLevel'] == 'user' ? 'selected' : ''; ?>>User
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userStatus"><strong>User Status:</strong></label>
                            <select class="form-control" id="userStatus" name="userStatus" disabled required>
                                <option value="_1" <?php echo $user['userStatus'] == '_1' ? 'selected' : ''; ?>>Active
                                </option>
                                <option value="_0" <?php echo $user['userStatus'] == '_0' ? 'selected' : ''; ?>>Inactive
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userPicture"><strong>Picture URL:</strong></label>
                            <input type="hidden" name="userPictureOld" value="<?= $user['userPicture']; ?>" required>
                            <input type="file" class="form-control" id="userPicture" name="userPicture" disabled>
                        </div>
                        <button type="button" class="btn btn-secondary" id="cancelButton"
                            style="display:none;">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="saveButton" style="display:none;">Save
                            Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                </div>
                <div class="card-body text-center">
                    <?php if (!empty($user['userPicture']) && @getimagesize(FCPATH . 'assets/uploads/users/' . $user['userPicture'])): ?>
                        <img src="<?php echo site_url('assets/uploads/users/'.$user['userPicture']); ?>" alt="User Picture" class="img-fluid rounded-circle" style="height:200px;width:200px;">
                    <?php else: ?>
                        <i class="fas fa-user-circle fa-10x text-gray-300"></i>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Menghapus User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Untuk Menghapus User Ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <form action="<?php echo base_url('user/delete/' . $user['userId']); ?>" method="post"
                    style="display:inline;">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('editButton').addEventListener('click', function () {
        document.getElementById('userName').disabled = false;
        document.getElementById('userPassword').disabled = false;
        document.getElementById('passwordRepeat').disabled = false;
        document.getElementById('userLevel').disabled = false;
        document.getElementById('userStatus').disabled = false;
        document.getElementById('userPicture').disabled = false;
        document.getElementById('saveButton').style.display = 'inline';
        document.getElementById('cancelButton').style.display = 'inline';
        document.getElementById('deleteButton').style.display = 'none';
        this.style.display = 'none';
    });

    document.getElementById('cancelButton').addEventListener('click', function () {
        location.reload();
    });
</script>