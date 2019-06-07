<?php
/* classe permmetant d'afficher les derniers dons DULAN saisi, cela permet à l'utilisateur de vérifier que sa saisie à bien été enregistrée en BDD */

namespace Kalaweit\Controller\Component\Asso_donation_dulan;

class Table_last_donation_dulan
{
    public function render(){

    /* instanciation de la connexion à la BDD */

    $bdd = new \Kalaweit\Manager\Connexion();
    $bdd = $bdd->getBdd();

    /* récupéraiton des données via le manager asso_donation_dulan dans un array */

    $data   = (new \Kalaweit\Manager\asso_donation_dulan($bdd))->get_last();

    /* définition des éléménts de paramétrage à passer au composant TABLE WITHOUT PAGINATION */

    $link = '/www/Kalaweit/member/get?cli_id=';
    $update = '/www/Kalaweit/asso_donation_dulan/update?donation_dulan_id=';
    $delete = '/www/Kalaweit/asso_donation_dulan/delete?donation_dulan_id=';
    $add = '/www/Kalaweit/asso_donation_dulan/add';

    /* instanciation de l'objet Table_without_pagination en lui passant les elements précedement défini */

    $table_last_donation_dulan = (new \Kalaweit\htmlElement\Table_without_pagination("Les derniers don Dulan",$data,'Table_last_donation_dulan',$link,$update,$delete,$add))->render();

    /* renvoi de l'objet pour affichage */

    return  $table_last_donation_dulan;

    }

}
