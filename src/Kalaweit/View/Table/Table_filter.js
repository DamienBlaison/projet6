

let uri = window.location.pathname.split('/');

go_previous();
go_next();

console.log(uri);

let target = uri[3];

    let name = 'export_table_'+target;

    console.log(target);


    function tableXls(){

    let search = '&'+ window.location.search.substr(1);

    let    xhttp = new XMLHttpRequest();

    var url = 'http://localhost:8888/www/Kalaweit/ajax_get/export_excel/'+target+'?export_name='+target+search;

    console.log(url);

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location='/www/'+target+'.xlsx';
        }
    };

    xhttp.open("GET", url, true);

    xhttp.send();

    };

    document.getElementById('export_table_'+target).addEventListener('click' , tableXls );

    function go_previous(){

        console.log(uri[5]);

        if (uri[5] < 2) {

            document.getElementById("previous_member").firstChild.setAttribute('href', '');

        };

    };

    function go_next(){

        console.log(document.getElementById('nb_page').textContent);
        console.log(uri[5]);

        if (uri[5] >= (document.getElementById('nb_page').textContent)){

            document.getElementById("next_member").firstChild.setAttribute('href', '');

            document.getElementById("next_member").className = 'page-item disabled'

            document.getElementById("previous_member").className = 'page-item'

        };
    };
