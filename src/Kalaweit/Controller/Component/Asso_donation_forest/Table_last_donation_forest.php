<?php

/* classe permmetant d'afficher les derniers dons FOREST saisi, cela permet à l'utilisateur de vérifier que sa saisie à bien été enregistrée en BDD */


namespace Kalaweit\Controller\Component\Asso_donation_forest;

class Table_last_donation_forest
{

    public function render(){

        /* instanciation de la connexion à la BDD */

        $bdd = new \Kalaweit\Manager\Connexion();
        $bdd = $bdd->getBdd();

        /* récupéraiton des données via le manager asso_donation_forest dans un array */

        $data   = (new \Kalaweit\Manager\asso_donation_forest($bdd))->get_last();

        /* définition des éléménts de paramétrage à passer au composant TABLE WITHOUT PAGINATION */

        $link = '/www/Kalaweit/member/get?cli_id=';
        $update = '/www/Kalaweit/asso_donation_forest/update?donation_forest_id=';
        $delete = '/www/Kalaweit/asso_donation_forest/delete?donation_forest_id=';
        $add = '/www/Kalaweit/asso_donation_forest/add';

        /* instanciation de l'objet Table_without_pagination en lui passant les elements précedement défini */

        $table_last_donation_forest = (new \Kalaweit\htmlElement\Table_without_pagination("Les derniers dons Foret",$data,'Table_last_donation_forest',$link,$update,$delete,$add))->render();

        /* renvoi de l'objet pour affichage */

        return  $table_last_donation_forest;

    }

}
