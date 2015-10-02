<?php
/**
 * Created by PhpStorm.
 * User: gmanner
 * Date: 02/10/15
 * Time: 11:29
 */

$_POST['action'] = 'bet_request';
$_POST['game_state'] = file_get_contents('sample_gamestate.json');


ob_start();
require_once('index.php');
$output = ob_get_clean();

echo 'Game bets: ' . $output . ' -> ' . (is_numeric($output)? 'OK' : 'FAIL') . "\n";

