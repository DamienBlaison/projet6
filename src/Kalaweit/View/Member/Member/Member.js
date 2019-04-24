

const target = 'donation_animal_by_member';

var next = 'next_';
var previous = 'previous_';
var current = 'current_';
var table = 'table_';
var nb_page = 'nb_';

const nb_result_by_page = '5';

let current_page = document.getElementById(current+target).textContent;

let current_nb_page = document.getElementById(nb_page+target).textContent;

function go_next(){

    if (Number(current_page) < Number(current_nb_page)) {

        let start = Number(Number(current_page)* Number(nb_result_by_page));

        document.getElementById(current+target).textContent = Number(current_page) + 1;

        let    xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(table+target).innerHTML = this.responseText;

            }
        };

        let search = window.location.search;

        let cli_id = search.replace("?cli_id=", " ");

        var url = 'http://localhost:8888/www/Kalaweit/ajax_get/'+target+'?cli_id='+cli_id+'&p='+start;

        xhttp.open("GET", url, true);

        xhttp.send();

    };






};

function go_previous(){

    console.log(current_page);

    if (document.getElementById(current+target).textContent > 1) {


        let start_previous = (Number(current_page) - 1) * Number(nb_result_by_page);

        console.log(start_previous);

        document.getElementById(current+target).textContent = document.getElementById(current+target).textContent - 1;

        let    xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(table+target).innerHTML = this.responseText;

            }
        };

        let search = window.location.search;

        let cli_id = search.replace("?cli_id=", " ");

        var url = 'http://localhost:8888/www/Kalaweit/ajax_get/'+target+'?cli_id='+cli_id+'&p='+start_previous;

        xhttp.open("GET", url, true);

        xhttp.send();

    }

};


    document.getElementById(next+target).addEventListener('click', go_next);
    document.getElementById(previous+target).addEventListener('click', go_previous);
