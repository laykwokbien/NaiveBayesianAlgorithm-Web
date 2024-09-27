<?php 

class NaiveBayes
{
    private $train = 'train.json';

    /* 
    Keterangan:
    Daun = 1;
    Bunga = 2;
    Pohon = 3;
    */

    public function sumDaun(){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);

        $s = 0;
        foreach($results as $result){
            if($result['type'] == 1){
                $s += 1;
            }
        }
        return $s;
    }
    public function sumBunga(){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);

        $s = 0;
        foreach($results as $result){
            if($result['type'] == 2){
                $s += 1;
            }
        }
        return $s;
    }
    
    public function sumPohon(){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);

        $s = 0;
        foreach($results as $result){
            if($result['type'] == 3){
                $s += 1;
            }
        }
        return $s;
    }

    public function sumData(){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);
        return count($results);
    }

    /*
    |=========|
    | SUM RGB |
    |=========|
    */

    public function sumR($red, $type){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);

        $s = 0;
        foreach ($results as $result){
            if($result['R'] == $red && $result['type'] == $type){
                $s += 1;
            }
        }
        $s += 1;
        return $s;
    }

    public function sumB($blue, $type){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);
        
        $s = 0;
        foreach ($results as $result){
            if($result['B'] == $blue && $result['type'] == $type){
                $s += 1;
            }
        }
        $s += 1;
        return $s;
    }

    public function sumG($green, $type){
        $data = file_get_contents($this->train);
        $results = json_decode($data, true);
        
        $s = 0;
        foreach ($results as $result){
            if($result['G'] == $green && $result['type'] == $type){
                $s += 1;
            } else if($result['G'] == $green && $result['type'] == $type){
                $s += 1;
            } else if($result['G'] == $green && $result['type'] == $type){
                $s += 1;
            }
        }
        $s += 1;
        return $s;
    }

    /* 
    |======================\
     Penghitung Probabilitas
    |======================\
      Keterangan Parameter
    |======================\
    $sR = Jumlah warna Merah
    $sB = Jumlah warna Biru
    $sG = Jumlah warna Hijau
    $sData = Jumlah Total Data
    $sD = Jumlah Daun
    $sBg = Jumlah Bunga 
    $sP = Jumlah Pohon
    |======================\
      Keterangan Function
    |======================\
    $pD = Probabilitas Jumlah Daun
    $pBg = Probabilitas Jumlah Bunga
    $pP = Probabilitas Jumlah Pohon
    $pR = Probabilitas Warna Merah
    $pG = Probabilitas Warna Hijau
    $pB = Probabilitas Warna Biru
    $pHasil = Hasil Dari Probabil
    */

    public function HasilDaun($sR, $sB, $sG, $sData, $sD){
        $pD = $sD / $sData;
        $pR = $sR / $sD;
        $pB = $sB / $sD;
        $pG = $sG / $sD;
        $pHasil = $pD * $pR * $pB * $pG;
        return $pHasil;
    }

    public function HasilBunga($sR, $sB, $sG, $sData, $sBg){
        $pBg = $sBg / $sData;
        $pR = $sR / $sBg;
        $pB = $sB / $sBg;
        $pG = $sG / $sBg;
        $pHasil = $pBg * $pR * $pB * $pG;
        return $pHasil;
    }

    public function HasilPohon($sR, $sB, $sG, $sData, $sP){
        $pP = $sP / $sData;
        $pR = $sR / $sP;
        $pB = $sB / $sP;
        $pG = $sG / $sP;
        $pHasil = $pP * $pR * $pB * $pG;

        return $pHasil;
    }

    /*
    Keterangan Pemilihan
    $pHasil = Persentase Hasil
    */

    function Decision($HasilDaun, $HasilBunga, $HasilPohon){
        $hasil = 'Tidak Diketahui';
        $hitung = null;
        $pHasil = null;

        if($HasilDaun > $HasilBunga && $HasilDaun > $HasilPohon){
            $hasil = 'Daun';
            $hitung = ($HasilDaun / ($HasilDaun + $HasilBunga + $HasilPohon) * 100);
            $pHasil = 100 - $hitung;
        }
        if($HasilBunga > $HasilDaun && $HasilBunga > $HasilPohon){
            $hasil = 'Bunga';
            $hitung = ($HasilBunga / ($HasilDaun + $HasilBunga + $HasilPohon) * 100);
            $pHasil = 100 - $hitung;
        }
        if($HasilPohon > $HasilDaun && $HasilPohon > $HasilBunga){
            $hasil = 'Pohon';
            $hitung = ($HasilPohon / ($HasilDaun + $HasilBunga + $HasilPohon) * 100);
            $pHasil = 100 - $hitung;
        }
        $result = array('hasil' => $hasil, 'hitung' => $hitung, 'pHasil' => $pHasil);
        return $result;
    }
}
?>
