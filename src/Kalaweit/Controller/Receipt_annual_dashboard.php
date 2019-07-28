<?php

namespace Kalaweit\Controller ;

class Receipt_annual_dashboard{

    function run(){

        //exec("cd /kunden/homepages/12/d744344652/htdocs/p5/src/Kalaweit/Controller ; php test.php > /dev/null &");
        //exec("cd /kunden/homepages/12/d744344652/htdocs/p5/src/Kalaweit/Controller ; php5 ./test.log &");
        //echo 'toto';

        exec("cd /kunden/homepages/12/d744344652/htdocs/p5/src/Kalaweit/Controller ; /usr/bin/php7.2-cli test.php > ./test.log &");

        //exec("cd /Users/damienblaison/Desktop/projet6/src/Kalaweit/Controller ; php test.php > /dev/null &");

    }

    function dashboard(){
        //echo'<pre>';
        //    var_dump($_SERVER);
        //echo'</pre>';
        //var_dump(getcwd());

        $content =[

            "Receipt_generation_progress" => (new \Kalaweit\htmlElement\Progress_bar())->render(0,100,"Receipt_annual_generation_progress")

        ];

        (new \Kalaweit\View\Receipt\Receipt_annual_dashboard())->render($content);
    }

};
