<?php $adminlte = '../../../../vendor/almasaeed2010/adminLte';

$bdd = new \Kalaweit\Manager\Connexion();
$bdd = $bdd->getBdd();

if (!isset($_SESSION["user_login"])){ header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in");};

if ( (new \Kalaweit\Manager\Users($bdd))->get_id_from_Login($_SESSION['user_login']) == false){header("location:http://localhost:8888/www/Kalaweit/app_connexion/log_in");}

$user = (new \Kalaweit\Manager\Users($bdd))->get_id_from_Login($_SESSION['user_login']);
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | General Form Elements</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->


    <link rel="stylesheet" href="<?php echo $adminlte ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $adminlte ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo $adminlte ?>/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $adminlte ?>/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo $adminlte ?>/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo $adminlte ?>/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="<?php echo $adminlte ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="/Css/perso.css">

</head>

<?php



 ?>

<body class="hold-transition skin-blue sidebar-mini" style="min-height:auto;">
    <div class="wrapper" style="height: auto; min-height:2000px;">
        <aside class="main-sidebar">
            <section class="sidebar" style="min-height: 100%; height:100%;">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo $user['user_avatar'] ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $user['user_first_name'].' '.$user['user_last_name'] ?></p>
                        <a href="/www/Kalaweit/app_connexion/log_out" id="log_out"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <form action="#" method="get" class="sidebar-form">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <ul class="sidebar-menu tree" data-widget="tree">
                    <li class="header">MENU
                    </li>
                    <li class=" active treeview">
                        <a href="/www/Kalaweit/home/">
                            <i class="fa fa-home"></i> <span>Accueil</span>
                        </a>
                    </li>
                    <li class=" treeview " style="border-left:3px solid #3c8dbc;">

                        <a href="#">
                            <i class="fa fa-users"></i> <span>Membres</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu ">
                            <li><a href="/www/Kalaweit/member/add"><i class="fa fa-user-plus"></i> Ajouter un membre</a></li>
                            <li><a href="/www/Kalaweit/member/list/1"><i class="fa fa-users"></i> Liste des membres</a></li>
                        </ul>
                    </li>
                    <li class=" treeview" style="border-left:3px solid #3c8dbc; ">
                        <a href="#"><i class="fa  fa-paw"></i> <span>Animaux</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="/www/Kalaweit/asso_cause/add"><i class="fa  fa-plus-square"></i> Ajouter un animal</a></li>
                            <li><a href="/www/Kalaweit/asso_cause/list/1"><i class="fa  fa-folder-open"></i> Tous les animaux</a></li>
                            <li><a href="/www/Kalaweit/asso_cause/list/1?actd_8=oui"><i class="fa fa-home"></i> Les animaux à adopter</a></li>
                            <li><a href="/www/Kalaweit/asso_cause/list/1?actd_7=2"><i class="fa fa-ambulance"></i> Les animaux morts</a></li>
                            <li><a href="/www/Kalaweit/asso_cause/list/1?actd_9=non"><i class="fa  fa-tree"></i> Les animaux libérés</a></li>
                        </ul>
                    </li>
                    <li class=" treeview " style="border-left:3px solid #3c8dbc;" >
                        <a href="#"><i class="fa  fa-euro"></i> <span>Adhésion</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="/www/Kalaweit/asso_adhesion/add"><i class="fa  fa-plus-square"></i> Ajouter une ahésion</a></li>
                            <li><a href="/www/Kalaweit/asso_adhesion/list/1"><i class="fa  fa-folder-open"></i> Toutes les ahésions</a></li>

                        </ul>
                    </li>
                    <li class=" treeview " style="border-left:3px solid #3c8dbc; ">
                        <a href="#"><i class="fa  fa-gift"></i> <span>Les dons animaux</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="/www/Kalaweit/asso_donation/add"><i class="fa  fa-plus-square"></i> Ajouter un don</a></li>
                            <li><a href="/www/Kalaweit/asso_donation/list/1"><i class="fa  fa-folder-open"></i> Tous les dons</a></li>
                            <ul class="treeview-menu">
                                    <li><a href="/www/Kalaweit/Annual_report/list?y=2019"><i class="fa fa-circle-o"></i> Rapport Annuel</a></li>
                                    <li><a href="monthly_report"><i class="fa fa-circle-o"></i> Rapport Mensuel</a></li>
                                    <li><a href="gift_search"><i class="fa fa-circle-o"></i> Rechercher</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class=" treeview " style="border-left:3px solid #3c8dbc; ">
                        <a href="#"><i class="fa  fa-gift"></i> <span>Les dons Foret</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="/www/Kalaweit/asso_donation_forest/add"><i class="fa  fa-plus-square"></i> Ajouter un don</a></li>
                            <li><a href="/www/Kalaweit/asso_donation_forest/list/1"><i class="fa  fa-folder-open"></i> Tous les dons</a></li>
                        </ul>
                    </li>
                    <li class=" treeview " style="border-left:3px solid #3c8dbc;">
                        <a href="#"><i class="fa  fa-gift"></i> <span>Les dons Dulan</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li><a href="/www/Kalaweit/asso_donation_dulan/add"><i class="fa  fa-plus-square"></i> Ajouter un don</a></li>
                            <li><a href="/www/Kalaweit/asso_donation_dulan/list/1"><i class="fa  fa-folder-open"></i> Tous les dons</a></li>
                        </ul>
                    </li>

                    <li class=" treeview " style="border-left:3px solid #3c8dbc; ">
                        <a href="#"><i class="fa  fa-bar-chart"></i> <span>Statistique</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="treeview"><a href="#"><i class="fa fa-thumbs-up"></i> Recapitulatif des dons <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    <li><a href="/www/Kalaweit/Annual_report/list?y=2019"><i class="fa fa-circle-o"></i> Rapport Annuel</a></li>
                                    <li><a href="monthly_report"><i class="fa fa-circle-o"></i> Rapport Mensuel</a></li>
                                    <li><a href="gift_search"><i class="fa fa-circle-o"></i> Rechercher</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li class=" treeview" style="border-left:3px solid #3c8dbc; ">
                        <a href="#"><i class="fa  fa-euro"></i> <span>Paiements et reçus</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="treeview"><a href="#"><i class="fa  fa-eur"></i> Gestion des paiements <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    <li><a href="monthly_deduction"><i class="fa fa-circle-o"></i> Les prélèvements mensuels</a></li>
                                    <li><a href="payment_history"><i class="fa fa-circle-o"></i> Historique des prélèvements</a></li>
                                </ul>
                            </li>
                            <li class="treeview"><a href="index3.html"><i class="fa fa-file-text"></i> Reçus Fiscaux <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    <li><a href="receipt_generation"><i class="fa fa-circle-o"></i> Génération des reçus</a></li>
                                    <li><a href="receipt_print"><i class="fa fa-circle-o"></i> Impression des reçus</a></li>
                                    <li><a href="receipt_email"><i class="fa fa-circle-o"></i> Email des reçus</a></li>
                                    <li><a href="receipt_list"><i class="fa fa-circle-o"></i> Liste des reçus</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class=" treeview" style="border-left:3px solid #3c8dbc; ">
                        <a href="#"><i class="fa  fa-cog"></i> <span>Administration</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                        <ul class="treeview-menu">
                            <li class="treeview"><a href="#"><i class="fa  fa-users"></i> Gestion des utilisateurs <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    <li><a href="/www/Kalaweit/users/add"><i class="fa fa-plus"></i> Ajouter un utilisateur</a></li>
                                    <li><a href="/www/Kalaweit/users/list/1"><i class="fa fa-edit"></i> Modifier un utilisateur</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper row" action="" method="post" style="min-height: 1100px;">
