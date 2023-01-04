<?php
// require('../fpdf/fpdf.php');
require('../fpdf/WriteHTML.php');
require_once 'koneksi.php';

class PDF extends FPDF
{
// Page header
// function Header()
// {
    // Logo
    // $this->Image('../img/logo.png',2,2,2.3);
    // Arial bold 15
    // $this->SetFont('Times','B',15);
    // Move to the right
    
    // $this->ln(1);
    // $this->Cell(3.5);
    // Title
    // $this->Cell(12.7,1,'LEMBAR PENGETESAN AKHIR GENSET KERETA',0,0,'');
    // Line break
    // $this->Ln(0.5);
    
// }

//Page footer
// function Footer()
// {
//     // Position at 1.5 cm from bottom
//     $this->SetY(-15);
//     // Arial italic 8
//     $this->SetFont('Arial','I',8);
//     // Page number
//     $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
// }
}

$id = filter_input(INPUT_GET, "id");
$stmnt = $dbh->prepare("SELECT idform, ltg, dipo, sifat_perawatan, jenis_kereta, seri_kereta, nogenset, typegenset, tgl_masuk, tgl_test, waktu_mulai, waktu_selesai FROM form WHERE idform = $id");
$stmnt->execute();
$row = $stmnt->fetch();

// Instanciation of inherited class
$pdf = new PDF_HTML('P', 'cm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->ln(0.5);
$pdf->Cell(1,1);
$pdf->Image('../img/logo.png',2,1.5,3,1);
$pdf->Cell(3.4,1,'',0);
$pdf->SetFont('Times','B',12);
$pdf->Cell(9.5, 0.5, 'LEMBAR PENGETESAN AKHIR',0,0,'C');
// $pdf->Cell(11,1,'LEMBAR PENGETESAN AKHIR GENSET KERETA '. $row["jenis_kereta"],1,0,'C');
$pdf->SetFont('Times','',10);  
$pdf->Cell(4.5,1.5,'UNIT QUALITY CONTROL',0,0,'');
$pdf->Cell(0.1,0.5,'',0,1,'');
$pdf->Cell(1,0.5);
$pdf->Cell(3.4,0.5,'');
$pdf->SetFont('Times','B',12);
$pdf->Cell(9.5, 0.5, 'ENGINE GENSET KERETA '.  $row["jenis_kereta"],0,0,'C');
$pdf->ln();
$pdf->SetFont('Times','',9); 
$pdf->Cell(1,0.5);
$pdf->cell(3.2,0.5,'UPT BalaiYasa Manggarai',0,0,'R');
$pdf->SetFont('Times','',12); 
$pdf->Cell(9.5,0.5,'LTG NO '. $row["ltg"], 0, 0, 'C');

$pdf->ln(1);
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Seri Kereta', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["seri_kereta"], 0, 1, 'L');
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Dipo', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["dipo"], 0, 1, 'L');
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'No Genset', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["nogenset"], 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Type Genset', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["typegenset"], 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Tanggal Masuk', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["tgl_masuk"], 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Tanggal Test', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["tgl_test"], 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Waktu Test', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["waktu_mulai"], 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(1.5);
$pdf->Cell(4,0.6,'Sifat Perawatan', 0, 0, 'L');
$pdf->Cell(1, 0.6,': '. $row["sifat_perawatan"], 0, 1, 'L');
$pdf->Ln();

$pdf->Cell(3);
$pdf->Cell(2,1,'No', 1, 0, 'C');
$pdf->Cell(5,1,'Tanggal/Waktu', 1, 0, 'C');
$pdf->Cell(5,1,'Suhu (Celcius)', 1, 1,'C');

$stmnt2 = $dbh->prepare("SELECT
`engine`.waktu, 
`engine`.datasensor
FROM
`engine`
WHERE
`engine`.waktu LIKE '%".$row["tgl_test"]."%' AND
DATE_FORMAT(`engine`.waktu, '%T') >= '".$row["waktu_mulai"]."' AND DATE_FORMAT(`engine`.waktu, '%T') <= '".$row["waktu_selesai"]."'");
$stmnt2->execute();

$no=1;
// $stmnt2->debugDumpParams();
print_r($stmnt2->errorInfo()[2]);
while($row2 = $stmnt2->fetch()){
    $pdf->Cell(3);
    $pdf->Cell(2,0.8,$no, 1, 0, 'C');
    $pdf->Cell(5,0.8,$row2["waktu"], 1, 0, 'C');
    $pdf->Cell(5,0.8,$row2["datasensor"], 1, 1, 'C');
    $no++;
}

$pdf->Ln();
// $pdf->Cell(1.2);
// $pdf->Cell(16,11,'', 0, 1);

date_default_timezone_set("Asia/Jakarta");
// teknisi
$stmnt3 = $dbh->prepare ("SELECT
users.nama,
users.nipp,
users.img, 
users.base64
FROM
validasi
INNER JOIN
users
ON 
    validasi.iduser = users.id
    WHERE validasi.idform = $id and users.type = 'teknisi'");
$stmnt3->execute();
$row3 = $stmnt3->fetch();

// val1-atasan
$stmnt4 = $dbh->prepare ("SELECT
users.nama,
users.nipp,
users.img, 
users.base64
FROM
validasi
INNER JOIN
users
ON 
    validasi.iduser = users.id
    WHERE validasi.idform = $id and users.type = 'validator'AND users.divisi = 'Assman Final Test'");
$stmnt4->execute();
$row4 = $stmnt4->fetch();


// val2-principal
$stmnt5 = $dbh->prepare ("SELECT
users.nama,
users.nipp,
users.img, 
users.base64
FROM
validasi
INNER JOIN
users
ON 
    validasi.iduser = users.id
    WHERE validasi.idform = $id and users.type = 'validator'AND users.divisi = 'Principal'");
$stmnt5->execute();
$row5 = $stmnt5->fetch();

// val3-produksi
$stmnt6 = $dbh->prepare ("SELECT
users.nama,
users.nipp,
users.img, 
users.base64
FROM
validasi
INNER JOIN
users
ON 
    validasi.iduser = users.id
    WHERE validasi.idform = $id and users.type = 'validator'AND users.divisi = 'SPV Kereta 4'");
$stmnt6->execute();
$row6 = $stmnt6->fetch();
// $stmnt3->debugDumpParams();
// print_r($stmnt3->errorInfo()[2]);
$pdf->Cell(2);
    $pdf->Cell(9,0.6,'Mengetahui,', 0, 0);
    $pdf->Cell(7,0.6,'Jakarta, '. date("d-m-Y"), 0, 1, '');
    $pdf->Cell(2);
    if($row4 != null){
        $pdf->Cell(9,0.6,'Atasan', 0, 0, '');
    }
    if($row3 != null){
        $pdf->Ln(0);
        $pdf->Cell(11);
        $pdf->Cell(7,0.6,'Pemeriksa', 0, 1, '');
    }
    
// $pdf->ln(2);
$pdf->Cell(2);

// val1-atasan
$pic = "";
if ($row4 != null){
    $filename = $row4['img'];
    $image = $row4['base64'];
    $pecah = explode(",", $image);
    $pic = 'data:image/jpeg;base64,'. $pecah[1];
}

// teknisi
$pic1 = "";
if ($row3 != null){
    $filename1 = $row3['img'];
    $image1 = $row3['base64'];
    $pecah1 = explode(",", $image1);
    $pic1 = 'data:image/jpeg;base64,'. $pecah1[1];
}


//CREATE NEW IMAGE
    $pdf->Ln();
    if($row4 != null){
        $validator = file_put_contents("val1.png",file_get_contents($pic));
        $pdf->Cell(2);
        $pdf->Cell(9, 2, $pdf->Image('val1.png', $pdf->GetX(), $pdf->GetY(), 12,2), 0, 0, 'L', false );
    }
    
    if($row3 != null){
        $pdf->Ln(0);
        $pdf->Cell(11);
        $teknisi = file_put_contents("tek.png",file_get_contents($pic1));
        $pdf->Cell(7, 2, $pdf->Image('tek.png', $pdf->GetX(), $pdf->GetY(), 12,2), 0, 1, 'L', false );
        $pdf->Ln(1);
    }
//REMOVE IMAGE
if (file_exists("val1.png")){
    unlink("val1.png");
}
if (file_exists("tek.png")){
    unlink("tek.png");
}
$pdf->Cell(2);
if($row4 != null){
    $pdf->Cell(9,0.4,$row4["nama"], 0, 0);
    $pdf->Ln();
    $pdf->Cell(2);
    $pdf->Cell(9,0.4,'NIPP. '.$row4["nipp"], 0, 0);
}
$pdf->Cell(10);
if($row3 != null){
    $pdf->Ln(-0.4);
    $pdf->Cell(11);
    $pdf->Cell(7,0.4,$row3["nama"], 0, 1,'');
    $pdf->Ln(0);
    $pdf->Cell(11);
    $pdf->Cell(7,0.4,'NIPP. '.$row3["nipp"], 0, 1,'');
}


$pdf->Ln(1);

$pdf->Cell(2);
if ($row5 != null){
    $pdf->Cell(9,0.6,'Principal', 0, 0);
}
if ($row6 != null){
    $pdf->Ln(0);
    $pdf->Cell(11);
    $pdf->Cell(7,0.6,'Produksi', 0, 1,'');
}

// val2-principal
$pic2 = "";
if ($row5 != null){
    $filename2 = $row5['img'];
    $image2 = $row5['base64'];
    $pecah2 = explode(",", $image2);
    $pic2 = 'data:image/jpeg;base64,'. $pecah2[1];
}

// val3-produksi
$pic3 = "";
if ($row6 != null){
    $filename3 = $row6['img'];
    $image3 = $row6['base64'];
    $pecah3 = explode(",", $image3);
    $pic3 = 'data:image/jpeg;base64,'. $pecah3[1];
}
//CREATE NEW IMAGE
// $pdf->Ln();
if($pic2 != null){
    $validator = file_put_contents("val2.png",file_get_contents($pic2));
    $pdf->Cell(2);
    $pdf->Cell(9, 2, $pdf->Image('val2.png', $pdf->GetX(), $pdf->GetY(), 12,2), 0, 0, 'L', false );
}

if($pic3 != null){
    $pdf->Ln(0);
    $pdf->Cell(11);
    $teknisi = file_put_contents("val3.png",file_get_contents($pic3));
    $pdf->Cell(5, 2, $pdf->Image('val3.png', $pdf->GetX(), $pdf->GetY(), 12,2), 0, 1, 'L', false );
}

//REMOVE IMAGE
if (file_exists("val2.png")){
unlink("val2.png");
}
if (file_exists("val3.png")){
unlink("val3.png");
}
// $pdf->Cell(2);
// $pdf->Cell(9,1.5,'', 0, 0);
// $pdf->Cell(7,1.5,'', 0, 1);

$pdf->Cell(2);
if($row5 != null){
    $pdf->Cell(9,0.4,$row5["nama"], 0, 0);
    $pdf->Ln();
    $pdf->Cell(2);
    $pdf->Cell(9,0.4,'', 0, 0);
}
if($row6 != null){
    $pdf->Ln(-0.4);
    $pdf->Cell(11);
    $pdf->Cell(7,0.4,$row6["nama"], 0, 1,'L');
    $pdf->Ln(0);
    $pdf->Cell(11);
    $pdf->Cell(7,0.4,'NIPP. '.$row6["nipp"], 0, 1,'L');
}
$pdf->Output();
?>