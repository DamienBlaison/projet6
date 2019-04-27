
document.getElementById('next_donation_animal_by_member').addEventListener('click', memberNext);
document.getElementById('previous_member').addEventListener('click', memberPrevious);


function memberNext(url) {

    if (document.getElementById('next_member').className != 'page-item disabled'){

        let maxPage = '<?php echo ceil($count[0]/15) ?>';

        let    xhttp = new XMLHttpRequest();
        let     currentPage = document.getElementById('current_member').textContent;
        let     start = (Number(currentPage)*15 + 1) ;

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table_member").innerHTML = this.responseText;

            }
        };

        var adresseActuelle = window.location;
        var url = adresseActuelle + '?p=' + start;

        xhttp.open("GET", url, true);

        xhttp.send();

        document.getElementById('current_member').innerHTML = Number(currentPage)+1;
        document.getElementById('previous_member').className = 'page-item';

        if(document.getElementById('current_member').innerHTML == maxPage ){

            document.getElementById('next_member').className = 'page-item disabled';

        }

    }

}

function memberPrevious() {

    if (document.getElementById('previous_member').className != 'page-item disabled'){

        let    xhttp = new XMLHttpRequest();
        let     currentPage = document.getElementById('current_member').textContent;

        var    start_previous = ((Number(currentPage-1)*15)+1)-16 ;

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table_member").innerHTML = this.responseText;

            }
        }

        var url = 'http://localhost:8888/www/Kalaweit/member/ajax?start=' + start_previous +'&end=15';

        xhttp.open("GET", url, true);

        xhttp.send();

        document.getElementById('current_member').innerHTML = Number(currentPage)-1;

        if (document.getElementById('current_member').innerHTML == 1){

            document.getElementById('previous_member').className = 'page-item disabled' ;

        }

        document.getElementById('next_member').className = 'page-item';


    };
}
