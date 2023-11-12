<?php 

function edit_tanggal($tanggal){
    $pisah = explode('-', $tanggal);
    $mulai = array($pisah[2], $pisah[1], $pisah[0]);
    $satukan = implode("/", $mulai);

    return $satukan;
}


?>