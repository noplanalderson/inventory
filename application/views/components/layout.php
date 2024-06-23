<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title : 'Default Title'; ?></title>
    <link href="<?php echo base_url('assets/templates/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet"
        type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?php echo base_url('assets/templates/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        .page-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php $this->load->view('components/sidebar'); ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php $this->load->view('components/topbar'); ?>
                <?php $this->load->view($content); ?>
            </div>
            <?php $this->load->view('components/footer'); ?>
        </div>
    </div>
    <script src="<?php echo base_url('assets/templates/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/templates/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/templates/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/templates/js/sb-admin-2.min.js'); ?>"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#userTable').DataTable({
                "pagingType": "simple_numbers",
                "order": [],
                "columnDefs": [{
                    "targets": "_all",
                    "orderable": true
                }]
            });
        });

        $('#manufactureTable').DataTable({
            "pagingType": "simple_numbers",
            "order": [],
            "columnDefs": [{
                "targets": "_all",
                "orderable": true
            }]
        });

        $('#deviceModelTable').DataTable({
            "pagingType": "simple_numbers",
            "order": [],
            "columnDefs": [{
                "targets": "_all",
                "orderable": true
            }]
        });

        $('#deviceGroupTable').DataTable({
            "pagingType": "simple_numbers",
            "order": [],
            "columnDefs": [{
                "targets": "_all",
                "orderable": true
            }]
        });
    </script>
</body>

</html>