<?php
use Workerman\Worker;
require_once __DIR__.'/Workerman/Autoloader.php';

$ws = new Worker("websocket://0.0.0.0:8181");

$ws->onConnect = function($connection) {
    $connection->onWebSocketConnect = function($connection) {
        #$ip = $connection->getRemoteIp();
        $connection->ip = $connection->getRemoteIp();
#        echo $ip.' has connected.'.PHP_EOL;
        echo "┌".$connection->ip." has connected.".PHP_EOL;
        echo "└".'Connection ID: '.$connection->id.PHP_EOL;

    };
};

$ws->onMessage = function($connection,$data) {



#    echo '['.$connection->id.']'." says: ".$data.PHP_EOL;
##    $connection->send('receive success');
#    foreach ($GLOBALS['ws']->connections as $conn) {
#        if ($connection != $conn) {
#            $conn->send($data);
#        };
#    };
    $mes = explode(",",$data);
    if ($mes[1] == null) {
        $connection->name = $mes[0];
        echo "ID ".$connection->id." is named: ".$connection->name.PHP_EOL;
    } else {
        echo $connection->name." says: ".$mes[1].PHP_EOL;
        foreach ($GLOBALS['ws']->connections as $conn) {
#            if ($connection != $conn) {
                $conn->send($mes[0]." says: ".$mes[1]);
#            };
        }
    }

};

$ws->onClose = function($connection) {
    echo $connection->ip.": Connection closed".PHP_EOL;
};

Worker::runAll();

?>
