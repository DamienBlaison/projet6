
let uri = window.location.pathname.split('/');

let target = uri[3];

    let name = 'export_table_'+target;


    function tableXls(){

    let search = '&'+ window.location.search.substr(1);

    let    xhttp = new XMLHttpRequest();

    var url = 'http://localhost:8888/www/Kalaweit/ajax_get/export_excel/'+target+'?export_name='+target+search;

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            window.location='/www/'+target+'.xlsx';
        }
    };

    xhttp.open("GET", url, true);

    xhttp.send();

    };

    document.getElementById('export_table_'+target).addEventListener('click' , tableXls );
