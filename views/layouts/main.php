<?php

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

/* @var $this \yii\web\View */

/* @var $content string */

// use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\assets\AppAsset;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use aryelds\sweetalert\SweetAlert;
use hail812\adminlte\widgets\Menu;
use app\modules\rbac\components\Helper;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script>
        const baseUrl = '<?= Yii::$app->request->baseUrl ?>';
    </script>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed" style="font-size:0.8em">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <h5 class="mt-2" style="color:green">DATA MASTER RSUD AA</h5>
            </ul>

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->request->baseUrl ?>/images/rsudaa.png" class="user-image img-circle elevation-2" alt=" User Image">
                        <span class="hidden-xs"><?php // Yii::$app->user->identity->username 
                                                ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/rsudaa.png" class="img-circle elevation-2" alt="User Image">

                            <p>
                                <h8><?= Yii::$app->user->identity->nama; ?> - <?= Yii::$app->user->identity->roles; ?></h8>
                                <!-- <small>Member since Nov. 2012</small> -->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                </div>
                                <div class="col-6 text-right ">
                                    <a href="<?= Yii::$app->urlManager->createUrl('keluar') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->

                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= Yii::$app->urlManager->createUrl('site/index') ?>" class="brand-link">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/rsudaa.png" alt="RSUD LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= Yii::$app->params['name-aplikasi'] ?></span>
            </a>

            <div class="sidebar">

                <nav class="mt-2">


                    <?php

                    $menuItems = [
                        
                        ['label' => 'Home', 'icon' => 'home', 'url' => ['./site']],

                        [
                            'label' => 'Master SDM',
                            'icon' => 'user',
                            'items' => [

                                ['label' => 'Negara', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/negara/index']],

                                ['label' => 'Provinsi', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/provinsi/index']],

                                ['label' => 'Kabupaten', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kabupaten/index']],

                                ['label' => 'Kecamatan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kecamatan/index']],

                                ['label' => 'Kelurahan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kelurahan/index']],

                                ['label' => 'Suku', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/suku/index']],

                                ['label' => 'Golongan Darah', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/golongan-darah/index']],

                                ['label' => 'Penghasilan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/penghasilan/index']],

                                ['label' => 'Jenis Identitas', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/jenis-identitas/index']],

                                ['label' => 'Jenis Kelamin', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/jenis-kelamin/index']],

                                ['label' => 'Status Kedudukan Keluarga', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/status-kedudukan-keluarga/index']],

                                ['label' => 'Pegawai', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai/index']],

                                ['label' => 'Hari Libur', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-hari-libur/index']],

                                ['label' => 'Agama', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-agama/index']],

                                ['label' => 'Unit Penempatan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-unit-penempatan/index']],

                                ['label' => 'Jabatan Penempatan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-unit-sub-penempatan/index']],

                                ['label' => 'Pendidikan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-pendidikan-umum/index']],

                                ['label' => 'Jurusan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-jurusan/index']],

                                ['label' => 'Status Kepegawaian', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-status-kepegawaian/index']],
                            ]
                        ],

                        [
                            'label' => 'Master Pendaftaran',
                            'icon' => 'file',
                            'items' => [

                                ['label' => 'Mode Pengiriman Antrol', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/antrol-pengiriman-mode/index']],

                                ['label' => 'Mapping DPJP BPJS', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/mapping-dpjp/index']],

                                ['label' => 'Mapping Poli BPJS', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/mapping-poli-bpjs/index']],

                                ['label' => 'Cara Keluar', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-cara-keluar/index']],

                                ['label' => 'Status Keluar', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-status-keluar/index']],

                                ['label' => 'Kelompok Unit Layanan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-kelompok-unit-layanan/index']],

                                ['label' => 'Kelas Rawat', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-kelas-rawat/index']],

                                ['label' => 'Debitur', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-debitur/index']],

                                ['label' => 'Debitur Detail', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-debitur-detail/index']],

                                ['label' => 'Kiriman', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-kiriman/index']],

                                ['label' => 'Kiriman Detail', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-kiriman-detail/index']],

                                // ['label' => 'Loket', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['./pendaftaran-loket'],'active' => in_array(\Yii::$app->controller->id, ['pendaftaran-loket'])],

                                // ['label' => 'Loket Unit', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['./pendaftaran-loket-unit'],'active' => in_array(\Yii::$app->controller->id, ['pendaftaran-loket-unit'])],

                                ['label' => 'Cara Masuk Unit', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pendaftaran-cara-masuk-unit/index']],
                            ]
                        ],

                        [
                            'label' => 'Master Kasbank',
                            'icon' => 'cash-register',
                            'items' => [

                                ['label' => 'Loket', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kasbank-loket/index']],
                            ]
                        ],

                        [
                            'label' => 'Master MEDIS',
                            'icon' => 'notes-medical',
                            'items' => [

                                ['label' => 'Tindakan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-tindakan/index']],

                                ['label' => 'SK Tarif', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-sk-tarif/index']],

                                // ['label' => 'Tarif Tindakan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['./medis-tarif-tindakan'],'active' => in_array(\Yii::$app->controller->id, ['medis-tarif-tindakan'])],

                                ['label' => 'Tarif Tindakan Unit', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-tarif-tindakan-unit/index']],

                                ['label' => 'Kamar', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-kamar/index']],

                                ['label' => 'Tarif Kamar', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-tarif-kamar/index']],

                                ['label' => 'Masalah Keperawatan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-masalah-keperawatan/index']],

                                ['label' => 'Intervensi Keperawatan', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-intervensi-keperawatan/index']],

                                // ['label' => 'ICD 9 CM', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-icd9cm'],'active' => in_array(\Yii::$app->controller->id, ['medis-icd9cm'])],

                                // ['label' => 'ICD 10 CM', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-icd10cm'],'active' => in_array(\Yii::$app->controller->id, ['medis-icd10cm'])],

                                ['label' => 'ICD 9 CM 2010', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-icd9cm2010/index']],

                                ['label' => 'ICD 10 CM 2010', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-icd10cm2010/index']],

                                ['label' => 'Anatomi', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/medis-anatomi/index']],

                                // ['label' => 'Poli BPJS', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['./bpjs-poli'],'active' => in_array(\Yii::$app->controller->id, ['bpjs-poli'])],

                                ['label' => 'Mapping Poli BPJS', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/bpjskes-mapping-poli-new/index']]    

                            ]
                        ],

                        [
                            'label' => 'Master KSM',
                            'icon' => 'user-md',
                            'items' => [
                                ['label' => 'Kelompok Ksm', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kelompok-ksm/index']],
                                ['label' => 'Kelompok Sub Ksm', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kelompok-sub-ksm/index']],
                                ['label' => 'Kategori Dokter', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/kategori-dokter/index']],
                                ['label' => 'Dokter KSM', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/pegawai-ksm-detail/index']],
                            ]
                        ],

                        [
                            'label' => 'Data Paket MCU',
                            'icon' => 'cube',
                            'items' => [

                                ['label' => 'Paket MCU', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/mcu-paket/index']],

                                ['label' => 'Paket Tindakan MCU', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/mcu-paket-tindakan-mcu/index']],

                                ['label' => 'Dokter Paket Tindakan MCU', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/mcu-dokter-paket-tindakan-mcu/index']],
                            ]
                        ],

                        // ['label' => 'Mapping Kode Jenis Tindakan', 'icon' => 'chart-pie', 'url' => ['/tind-kel/mapping-kode-jenis'], 'active' => in_array(\Yii::$app->controller->id,['tind-kel/mapping-kode-jenis'])],

                        [
                            'label' => 'Master Rumah Sakit',
                            'icon' => 'hospital',
                            'items' => [

                                ['label' => 'Data Rumah Sakit', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/master-data-dasar-rs/index']],

                                ['label' => 'Komputer Rumah Sakit', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/komputer-rs/index']],

                            ]
                        ],

                        [
                            'label' => 'Manajemen User',
                            'icon' => 'users',
                            'items' => [

                                ['label' => 'Aplikasi', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/aplikasi/index']],

                                ['label' => 'Pengguna', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/user/index']],

                                ['label' => 'Akses Unit Pengguna', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/akses-unit/index']],


                            ]
                        ],

                        [
                            'label' => 'RBAC',
                            'icon' => 'users',
                            'items' => [

                                // ['label' => 'User', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/rbac/user/index']],

                                ['label' => 'Route', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/rbac/route/index']],

                                ['label' => 'Permission', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/rbac/permission/index']],

                                ['label' => 'Role', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/rbac/role/index']],

                                ['label' => 'Assignment', 'iconStyle' => 'far', 'icon' => 'dot-circle','url' => ['/rbac/assignment/index']],

                            ]
                        ],
                    ];

                    $menuItems = Helper::filter($menuItems);

                    echo Menu::widget([
                        'items' => $menuItems,
                        'class' => 'nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent text-sm'
                    ]);

                    ?>

                    <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">   -->

                        <!-- <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                            <i class="nav-icon far fa fa-th"></i>
                            <p>
                                Data Tindakan Kelas
                                <i class="fas fa-angle-left right"></i>
                            </p>
                            </a>
                            <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="<?= Yii::$app->urlManager->createUrl('/tind-kel') ?>" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Tindakan Kelas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= Yii::$app->urlManager->createUrl('/tind-kelas') ?>" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Tindakan Kelas Detail</p>
                                </a>
                            </li>
                            </ul>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-cara-keluar') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Cara Keluar</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-cara-masuk-unit') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Cara Masuk Unit</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-jenis-identitas') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Jenis Identitas</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-kebiasaan') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Kebiasaan</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-kelas') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Kelas</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-kelompok-unit') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Kelompok Unit</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-pekerjaan') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Pekerjaan</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-pendidikan') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Pendidikan</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-penyakit') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Penyakit</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-riwayat') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>RIwayat</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-smf') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>SMF</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-status-kawin') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Status Kawin</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/master-status-keluar') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Status Keluar</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('site/about') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-info-circle"></i>
                                <p>About</p>
                            </a>
                        </li> -->
                    <!-- </ul> -->
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5><?= Html::encode($this->title) ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <?= Breadcrumbs::widget([
                                    'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
                                    'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </section> -->

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                             <?php
                                foreach (Yii::$app->session->getAllFlashes() as $message) {
                                    echo SweetAlert::widget([
                                        'options' => [
                                            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : '',
                                            'text' => (!empty($message['text'])) ? Html::encode($message['text']) : '',
                                            'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
                                            'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
                                            'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
                                        ]
                                    ]);
                                }
                            ?>
                            
                            <?= $content ?>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">           
            <div class="float-right d-none d-sm-inline">
                RSUD Arifin Ahmad Provinsi Riau
            </div>           
            <strong>Copyright &copy; <?= date('Y') ?> <a href="#"><?= Yii::$app->params['name-aplikasi'] ?></a>.</strong>
            All rights reserved.
        </footer>

    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>