<?php

$mahasiswa = [
    ["nama" => "Anton", "nilai" => 85, "kelas" => "A"],
    ["nama" => "Budi", "nilai" => 75, "kelas" => "A"],
    ["nama" => "Cece", "nilai" => 92, "kelas" => "A"],
    ["nama" => "Dimas", "nilai" => 70, "kelas" => "B"],
    ["nama" => "Elok", "nilai" => 89, "kelas" => "B"], 
];

$mahasiswa[0] = 

function tentukanNilaiMahasiswa($dataMahasiswa, $batasNilai=80){
    $output = "";
    foreach ($dataMahasiswa as $key => $mahasiswa){ 
        $output .= ($key + 1) . ". " . $mahasiswa['nama'] . " - Nilai : " . $mahasiswa['nilai'] . " - " . (($mahasiswa['nilai'] > $batasNilai) ? "lulus":"tidak lulus") . "<br/>";
    }

    return $output;
}

$mahasiswa[5] = ["nama" => "Faris", "nilai" => 60, "kelas" => "B"];
$mahasiswa[6] = ["nama" => "Ryan", "nilai" => 90, "kelas" => "B"];
$mahasiswa[7] = ["nama" => "Agus", "nilai" => 95, "kelas" => "C"];

echo tentukanNilaiMahasiswa($mahasiswa);
