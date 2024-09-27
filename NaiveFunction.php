<?php

require 'NaiveBayes.php';

function NaiveBys($red, $green, $blue){
    $NB = new NaiveBayes();
    $sumDaun = $NB->sumDaun();
    $sumBunga = $NB->sumBunga();
    $sumPohon = $NB->sumPohon();
    $sumData = $NB->sumData();

    /* 
    /=====================\
     Keterangan Sum Warna
    /=====================\
    $sRD = Jumlah warna merah yang ada pada Daun
    $sRB = Jumlah warna merah yang ada pada Bunga
    $sRP = Jumlah warna merah yang ada pada Pohon
    $sGD = Jumlah warna hijau yang ada pada Daun
    $sGB = Jumlah warna hijau yang ada pada Bunga
    $sGP = Jumlah warna hijau yang ada pada Pohon
    $sBD = Jumlah warna biru yang ada pada Daun
    $sBB = Jumlah warna biru yang ada pada Bunga
    $sBP = Jumlah warna biru yang ada pada Pohon
    */ 
    $sRD = $NB->sumR($red, 1);
    $sGD = $NB->sumG($green, 1);
    $sBD = $NB->sumB($blue, 1);
    
    $sRB = $NB->sumR($red, 2);
    $sGB = $NB->sumG($green, 2);
    $sBB = $NB->sumB($blue, 2);
    
    $sRP = $NB->sumR($red, 3);
    $sGP = $NB->sumG($green, 3);
    $sBP = $NB->sumB($blue, 3);

    // echo $sRD;
    // echo $sGD;
    // echo $sBD;
    // echo '<br>';
    // echo $sRB;
    // echo $sGB;
    // echo $sBB;
    // echo '<br>';
    // echo $sRP;
    // echo $sGP;
    // echo $sBP;
    // echo '<br>';
    /* 
    |========================================\
     Keterangan Menghitung Hasil Probabilitas
    |========================================\
    $hslpD = Hasil Probabilitas Daun  
    $hslpB = Hasil Probabilitas Bunga
    $hslpP = Hasil Probabilitas Pohon
    */
    $hslpD = $NB->HasilDaun($sRD, $sGD, $sBD, $sumData, $sumDaun);
    $hslpB = $NB->HasilBunga($sRB, $sGB, $sBB, $sumData, $sumBunga);
    $hslpP = $NB->HasilPohon($sRP, $sGP, $sBP, $sumData, $sumPohon);

    // echo $hslpD;
    // echo '<br>';
    // echo $hslpB;
    // echo '<br>';
    // echo $hslpP;
    // echo '<br>';

    /* 
    |===========================\
     Menentukan Tipe untuk Warna
    |===========================\
    */

    $result = $NB->Decision($hslpD, $hslpB, $hslpP);
    return $result;
}
?>