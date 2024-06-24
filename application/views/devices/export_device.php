<html>
    <head>
        <style>
            body {
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
            }
            .table-bordered {
                border: 1px solid #000;
            }
            .table thead {
                border: 1px solid #000;
                padding: .4rem;
            }
            .table tr th {
                height: 50px;
                color: #fff;
                background-color: #4e73df ;
                border: 1px solid #000;
            }
            .table tr td {
                color: #000;
                padding: .3rem;
                border: 1px solid #000;
            }
            .title {
                margin-top:2rem;
                text-align:center;
                display: block;
            }
            p {
                margin-bottom: 3rem;
            }
            .generate {
                font-size:13px;
                margin-bottom:2rem;
                display:block;
                text-align:right;
            }
            .text {
                margin-top:2rem;
                margin-bottom: 2rem;
            }
            .text-center {
                text-align: center
            }
            .h-200 {
                height:200px
            }
        </style>
    </head>
    <body>
        <div class="generate">
            <small><?= indonesian_date(date('Y-m-d H:i:s'), true, true, true) ?></small>
        </div>
        <div class="title">
            
            <h1>Device List <?= $group ?></h1>
            <p>Export Date: <?= indonesian_date(date('Y-m-d H:i:s'), TRUE, TRUE, TRUE) ?></p>
        </div>
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">Hostname</th>
                    <th class="text-center">Serial Number</th>
                    <th class="text-center">Manufacture & Model</th>
                    <th class="text-center">Processor</th>
                    <th class="text-center">Specification</th>
                    <th class="text-center">Location</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($devices as $dev): ?>
                    <tr>
                        <td><?= $dev['hostname'] ?></td>
                        <td><?= $dev['serialNumber'] ?></td>
                        <td>
                            Manufacture: <?= $dev['model']['manufacture']['manuName'] ?>
                            <br>
                            Model: <?= $dev['model']['modelName'] ?>
                        </td>
                        <td><?= $dev['processor'] ?></td>
                        <td>
                            Cores: <?= $dev['cores'] ?>
                            <br>
                            RAM: <?= $dev['memoryCap'] ?>
                            <br>
                            Storage (GB): <?= $dev['storageCap'] ?>
                        </td>
                        <td>
                            Location: <?= $dev['location'] ?>
                            <br>
                            Rack Number: <?= $dev['rackNumber'] ?>
                        </td>
                    </tr>

                    <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>