

let uri = window.location.pathname.split('/');

console.log(uri);

go_previous();
go_next();

console.log(uri);


    function go_previous(){

        console.log(uri[3]);

        if (uri[3] < 2) {

            document.getElementById("previous").firstChild.setAttribute('href', '');
            document.getElementById("previous").className = 'page-item disabled';

        };

    };

    function go_next(){

        if (uri[3] >= (document.getElementById('nb_page').textContent)){

            document.getElementById("next").firstChild.setAttribute('href', '');

            document.getElementById("next").className = 'page-item disabled'

            document.getElementById("previous").className = 'page-item'

        };
    };
