function go_next(target_next,nb_result_by_page_next){

    let current_page_next = document.getElementById('current_'+ target_next).textContent;

    let current_nb_page_next = document.getElementById('nb_'+ target_next).textContent;

    if (Number(current_page_next) < Number(current_nb_page_next)) {

        let start_next = Number(Number(current_page_next)* Number(nb_result_by_page_next));

        document.getElementById('current_'+target_next).textContent = Number(current_page_next) + 1;

        var    xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('table_'+ target_next).innerHTML = this.responseText;

            }
        };

        let search_next = window.location.search;

        let cli_id_next = search_next.replace("?cli_id=", "");

        let url_next = 'http://localhost:8888/www/Kalaweit/ajax_get/'+target_next+'?cli_id='+cli_id_next+'&p='+start_next;

        xhttp.open("GET", url_next, true);

        xhttp.send();

    };

};

function go_previous(target,nb_result_by_page){

    let current_page_previous = document.getElementById('current_' + target).textContent;

    let current_nb_page_previous = document.getElementById('nb_' + target).textContent;

    if (document.getElementById('current_'+ target).textContent > 1) {

        let start_previous = ((Number(current_page_previous) - 1) * Number(nb_result_by_page))- Number(nb_result_by_page);

        document.getElementById('current_'+ target).textContent = document.getElementById('current_'+ target).textContent - 1;

        var    xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                document.getElementById('table_'+ target).innerHTML = this.responseText;

            }
        };

        let search_previous = window.location.search;

        let cli_id_previous = search_previous.replace("?cli_id=", "");

        let url_previous = 'http://localhost:8888/www/Kalaweit/ajax_get/'+target+'?cli_id='+cli_id_previous+'&p='+start_previous;

        xhttp.open("GET", url_previous, true);

        xhttp.send();

    };

};
var url = window.location.pathname.split('/');;

if (url[4] == 'list'){
    document.getElementById('export_table_'+target).addEventListener('click' , tableXls );
}
//document.getElementById('next_donation_animal_by_member').addEventListener('click', function () {go_next("donation_animal_by_member",5);});
//document.getElementById('previous_donation_animal_by_member').addEventListener('click', function () {go_previous("donation_animal_by_member",5);});
//document.getElementById('next_donation_forest_by_member').addEventListener('click', function () {go_next("donation_forest_by_member",5);});
//document.getElementById('previous_donation_forest_by_member').addEventListener('click', function () {go_previous("donation_forest_by_member",5);});
document.getElementById('next_donation_dulan_by_member').addEventListener('click', function () {go_next("donation_dulan_by_member",5);});
document.getElementById('previous_donation_dulan_by_member').addEventListener('click', function () {go_previous("donation_dulan_by_member",5);});
