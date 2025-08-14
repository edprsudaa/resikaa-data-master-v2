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

<body class="hold-transition sidebar-mini sidebar-collapse" style="font-size:0.8em">
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

            <!-- Sidebar -->
            <div class="sidebar">
                 <nav class="mt-2">
      <?php

      $menuItems = [
        //pencarian tracer
        // ['label' => 'Dashboard', 'iconStyle' => 'fas', 'icon' => 'tachometer-alt', 'url' => ['/site/index']],

        // ['label' => 'Layanan', 'header' => true, 'url' => ['/layanan-operasi/']],
        ['label' => 'Home', 'iconStyle' => 'fas', 'icon' => 'user-plus', 'url' => ['/site/index']],
        // [
        //   'label' => 'Operasi',
        //   'icon' => 'syringe',
        //   'items' => [
        //     ['label' => 'OK GROUND (Lt. 1)', 'url' => ['/layanan-operasi/pasien-operasi', 'kamar' => LayananOperasiSearch::KAMAR_OK_GROUND], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
        //     ['label' => 'OK IRD (Lt. 2)', 'url' => ['/layanan-operasi/pasien-operasi', 'kamar' => LayananOperasiSearch::KAMAR_OK_IRD], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
        //     ['label' => 'OK IBS (Lt. 3)', 'url' => ['/layanan-operasi/pasien-operasi', 'kamar' => LayananOperasiSearch::KAMAR_OK_IBS], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
        //     ['label' => 'Ruangan Lainnya', 'url' => ['/layanan-operasi/ruangan-lainnya'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
        //   ]
        // ],
        // ['label' => 'Pasien Selesai Operasi', 'icon' => 'wheelchair', 'url' => ['/layanan-operasi/pasien-selesai-operasi']],

        // ['label' => 'Lainnya', 'header' => true, 'url' => ['/aktifitas-saya/']],
        // ['label' => 'Aktivitas Saya', 'iconStyle' => 'fas', 'icon' => 'history', 'url' => ['/aktifitas-saya/index']],

        // ['label' => 'Jabatan', 'header' => true, 'url' => ['/jabatan-operasi/']],
        // ['label' => 'Jabatan Operasi', 'url' => ['/jabatan-operasi/index'], 'icon' => 'toolbox', 'iconStyle' => 'fas'],

        // ['label' => 'Pengaturan', 'header' => true, 'url' => ['/rbac/']],
        // ['label' => 'Pengguna', 'url' => ['/rbac/user/index'], 'icon' => 'users', 'iconStyle' => 'fas'],
        // ['label' => 'Akses Unit Pengguna', 'url' => ['/akses-unit-pengguna/index'], 'icon' => 'university', 'iconStyle' => 'fas'],
        [
          'label' => 'RBAC',
          'icon' => 'user-cog',
          'items' => [
            ['label' => 'Route', 'url' => ['/rbac/route/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Permission', 'url' => ['/rbac/permission/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Role', 'url' => ['/rbac/role/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
            ['label' => 'Assignment', 'url' => ['/rbac/assignment/index'], 'iconStyle' => 'far', 'icon' => 'dot-circle'],
          ]
        ],
        // ['label' => 'Log Aplikasi', 'iconStyle' => 'fas', 'icon' => 'history', 'url' => ['/semua-aktifitas/index']],
      ];
    //   $menuItems = Helper::filter($menuItems);
      // $menuItems = Helper::filter($menuItems);
      echo \hail812\adminlte\widgets\Menu::widget([
        // 'options' => [
        //   'class' => 'nav nav-pills nav-sidebar flex-column nav-flat nav-compact nav-child-indent text-sm',
        //   'data-widget' => 'treeview',
        //   'role' => 'menu',
        //   'data-accordion' => 'false',
        // ],
        'items' => $menuItems,
      ]);
      ?>
    </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1><?= Html::encode($this->title) ?></h1>
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
                </div><!-- /.container-fluid -->
            </section>

            <section class="content">
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
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                RSUD Arifin Ahmad Provinsi Riau
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= date('Y') ?> <a href="#"><?= Yii::$app->params['name-aplikasi'] ?></a>.</strong>
            All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>