<?php

$master = '';
$transaksi = '';
$laporan = '';

if ($menu != null){
        if ($menu == 'user' || $menu == 'item') $master = 'active';
		if ($menu == 'inbound' || $menu == 'outbound') $transaksi = 'active';
		if ($menu == 'inboundhis' || $menu == 'outboundhis') $laporan = 'active';
}

?>