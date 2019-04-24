
document.getElementById('next_table_donator').addEventListener('click', Next);
document.getElementById('previous_table_donator').addEventListener('click', Previous);


function Next() {

    if (document.getElementById('next_table_donator').className != 'page-item disabled'){

        let maxPage = '<?php echo ceil($count[0]/15) ?>';

    console.log(maxPage);

        let    xhttp = new XMLHttpRequest();
        let     currentPage = document.getElementById('current_table_donator').textContent;
        let     start = (Number(currentPage)*15 + 1) ;

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("table_table_donator").innerHTML = this.responseText;

            }
        };

        var url = 'http://localhost:8888/www/Kalaweit/ajax_get/table_table_donator?cau_id=6311&p='+start;

        console.log(url);

        xhttp.open("GET", url, true);

        xhttp.send();

        document.getElementById('current_table_donator').innerHTML = Number(currentPage)+1;
        document.getElementById('previous_table_donator').className = 'page-item';

        if(document.getElementById('current_table_donator').innerHTML == maxPage ){

            document.getElementById('next_table_donator').className = 'page-item disabled';

        }

    }

}

function Previous() {

    if (document.getElementById('previous_donation_animal_by_member').className != 'page-item disabled'){

        let    xhttp = new XMLHttpRequest();
        let     currentPage = document.getElementById('current_donation_animal_by_member').textContent;

        var    start_previous = ((Number(currentPage)-1)*5)-5;

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("donation_animal_by_member").innerHTML = this.responseText;

            }
        }

        var url = 'http://localhost:8888/www/Kalaweit/ajax_get/donation_animal_by_member?cli_id=6311&p='+start_previous;

        xhttp.open("GET", url, true);

        xhttp.send();

        document.getElementById('current_donation_animal_by_member').innerHTML = Number(currentPage)-1;

        if (document.getElementById('current_donation_animal_by_member').innerHTML == 1){

            document.getElementById('previous_donation_animal_by_member').className = 'page-item disabled' ;

        }

        document.getElementById('next_donation_animal_by_member').className = 'page-item';


    };
}
