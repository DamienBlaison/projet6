<?php

 namespace Kalaweit\Controller\Component\Asso_cause;

 /**
  *
  */

 class Asso_cause_info
 {
     function render()
     {

         $config = \Kalaweit\Core\Config::getInstance();

         $bddM = new \Kalaweit\Manager\Connexion();
         $bddM = $bddM->getBdd();


         //$asso_cause            = new \Kalaweit\Model\Asso_cause();
         $asso_causeM           = new \Kalaweit\Manager\Asso_cause($bddM);

         $url = explode('/',$_SERVER['REQUEST_URI']);

         if ($url[4]=='add'){
                     $desc_asso_cause    = $asso_causeM->add();
         } else {
                     $desc_asso_cause    = $asso_causeM->get($_GET['cau_id']);
         };

         /**
         *      box info générale sur la cause
         */

         $ac_sexeM = (new \Kalaweit\Manager\Sexe)->getAll();
         $ac_specieM = (new \Kalaweit\Manager\Specie)->getAll();

         $name = (new \Kalaweit\htmlElement\Form_group_input("ac_name","Nom",$desc_asso_cause['ac_name'],'fa fa-user'));
         $sexe = (new \Kalaweit\htmlElement\Form_group_select("actd_2",$ac_sexeM,$desc_asso_cause['actd_2'],'fa fa-user',"config"));
         $year_birth = (new \Kalaweit\htmlElement\Form_group_input("actd_4","yyyy",$desc_asso_cause['actd_4'],"fa fa-calendar"));
         $year_death = (new \Kalaweit\htmlElement\Form_group_input("actd_7","yyyy",$desc_asso_cause['actd_7'], 'fa  fa-plus-square'));
         $specie = (new \Kalaweit\htmlElement\Form_group_select("actd_3",$ac_specieM,$desc_asso_cause['actd_3'],'fa fa-paw',"config"));

         $content_info_1 =
         [
             $name->render(),
             $sexe->render(),
             $year_birth->render(),
             $year_death->render(),
             $specie->render()

         ];

         $bootstrap_info_1 = [6,6,6,6,12];


         $box_asso_cause_info    = new \Kalaweit\htmlElement\Box('Informations animal','box-primary',$content_info_1,$bootstrap_info_1);


         /**
         *      box autres infos sur la cause
         */

         $localisationM = (new \Kalaweit\Manager\Ile)->getAll();
         $captivityM = (new \Kalaweit\Manager\Captivity)->getAll();
         $adoptionM = (new \Kalaweit\Manager\Adoption)->getAll();
         $visibilityM = (new \Kalaweit\Manager\Visibility)->getAll();

         $localisation = (new \Kalaweit\htmlElement\Form_group_select("actd_1",$localisationM,$desc_asso_cause['actd_1'],'fa fa-map',"config"));
         $captivity = (new \Kalaweit\htmlElement\Form_group_select("actd_9",$captivityM,$desc_asso_cause['actd_9'],'fa fa-chain',"config"));
         $adoption = (new \Kalaweit\htmlElement\Form_group_select("actd_8",$adoptionM,$desc_asso_cause['actd_8'],'fa fa-users',"config"));
         $visibility = (new \Kalaweit\htmlElement\Form_group_select("ac_site",$visibilityM,$desc_asso_cause['ac_site'],'fa  fa-internet-explorer',"config"));

         $photo1 = (new \Kalaweit\htmlElement\Form_group_input("acm_1","Photo1",$desc_asso_cause['acm_1'],'fa  fa-photo'));
         $photo2 = (new \Kalaweit\htmlElement\Form_group_input("acm_2","Photo2",$desc_asso_cause['acm_2'],'fa  fa-photo'));

         $content_box_autres_infos =

         [
             $localisation->render(),
             $captivity->render(),
             $adoption->render(),
             $visibility->render(),
             $photo1->render(),
             $photo2->render()
         ];

         $bootstrap_info_2 = [6,6,6,6,6,6];
         $box_asso_cause_autres_infos = new \Kalaweit\htmlElement\Box('Autres infos','box-primary',$content_box_autres_infos,$bootstrap_info_2);

         /**
         *      boxs desciption
         */

        //francais

         $description_fr = (new \Kalaweit\htmlElement\Form_group_textarea('acm_3',$desc_asso_cause['acm_3']));
         $description_en = (new \Kalaweit\htmlElement\Form_group_textarea('acm_4',$desc_asso_cause['acm_4']));
         $description_es = (new \Kalaweit\htmlElement\Form_group_textarea('acm_5',$desc_asso_cause['acm_5']));

        // box francais

         $content_box_desc_fr = [
             $description_fr->render()
         ];

         $box_description_fr = (new \Kalaweit\htmlElement\Box('Description en français','box-primary',$content_box_desc_fr,[12]));

        // box anglais

        $content_box_desc_en = [
            $description_en->render()
        ];

        $box_description_en = (new \Kalaweit\htmlElement\Box('Description en anglais','box-primary',$content_box_desc_en,[12]));

        // box en espagnol

        $content_box_desc_es = [
            $description_es->render()
        ];

        $box_description_es = (new \Kalaweit\htmlElement\Box('Description en espagnol','box-primary',$content_box_desc_es,[12]));

         /**
         *     Synthese des elements à passer a la vue
         */

         $param = [

             "info_générale" => $box_asso_cause_info,
             "autres_infos"  => $box_asso_cause_autres_infos,
             "description_fr" => $box_description_fr,
             "description_en" => $box_description_en,
             "description_es" => $box_description_es,
         ];

         return (new \Kalaweit\View\Asso_cause\Asso_cause_info)->render($param);
     }

 }
