<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if (!function_exists('rupiah')) 
{

 	function rupiah($rupiah)
 	{
		 $hasil_rupiah = number_format($rupiah,0,',','.');
		 return $hasil_rupiah;
 	}

}

	function penyebut($nilai) 
	{
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = penyebut($nilai/1000) . " ribu" . penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) 
	{
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil.' rupiah';
	}

	function tanggal($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim(penyebut($nilai));
		} else {
			$hasil = trim(penyebut($nilai));
		}     		
		return $hasil;
	}

	function hari_ini(){
		$hari = date ("D");
 
	    switch($hari){
	        case 'Sun':
	            $hari_ini = "Minggu";
	        break;
	 
	        case 'Mon':         
	            $hari_ini = "Senin";
	        break;
	 
	        case 'Tue':
	            $hari_ini = "Selasa";
	        break;
	 
	        case 'Wed':
	            $hari_ini = "Rabu";
	        break;
	 
	        case 'Thu':
	            $hari_ini = "Kamis";
	        break;
	 
	        case 'Fri':
	            $hari_ini = "Jumat";
	        break;
	 
	        case 'Sat':
	            $hari_ini = "Sabtu";
	        break;
	        
	        default:
	            $hari_ini = "Tidak di ketahui";     
	        break;
	    }
	 
	    return $hari_ini;
	}

	function angka_romawi($angka)
	{
	    $hsl = "";
	    if ($angka < 1 || $angka > 5000) { 
	        // Statement di atas buat nentuin angka ngga boleh dibawah 1 atau di atas 5000
	        $hsl = "Batas Angka 1 s/d 5000";
	    } else {
	        while ($angka >= 1000) {
	            // While itu termasuk kedalam statement perulangan
	            // Jadi misal variable angka lebih dari sama dengan 1000
	            // Kondisi ini akan di jalankan
	            $hsl .= "M"; 
	            // jadi pas di jalanin , kondisi ini akan menambahkan M ke dalam
	            // Varible hsl
	            $angka -= 1000;
	            // Lalu setelah itu varible angka di kurangi 1000 ,
	            // Kenapa di kurangi
	            // Karena statment ini mengambil 1000 untuk di konversi menjadi M
	        }
	    }


	    if ($angka >= 500) {
	        // statement di atas akan bernilai true / benar
	        // Jika var angka lebih dari sama dengan 500
	        if ($angka > 500) {
	            if ($angka >= 900) {
	                $hsl .= "CM";
	                $angka -= 900;
	            } else {
	                $hsl .= "D";
	                $angka-=500;
	            }
	        }
	    }
	    while ($angka>=100) {
	        if ($angka>=400) {
	            $hsl .= "CD";
	            $angka -= 400;
	        } else {
	            $angka -= 100;
	        }
	    }
	    if ($angka>=50) {
	        if ($angka>=90) {
	            $hsl .= "XC";
	            $angka -= 90;
	        } else {
	            $hsl .= "L";
	            $angka-=50;
	        }
	    }
	    while ($angka >= 10) {
	        if ($angka >= 40) {
	            $hsl .= "XL";
	            $angka -= 40;
	        } else {
	            $hsl .= "X";
	            $angka -= 10;
	        }
	    }
	    if ($angka >= 5) {
	        if ($angka == 9) {
	            $hsl .= "IX";
	            $angka-=9;
	        } else {
	            $hsl .= "V";
	            $angka -= 5;
	        }
	    }
	    while ($angka >= 1) {
	        if ($angka == 4) {
	            $hsl .= "IV"; 
	            $angka -= 4;
	        } else {
	            $hsl .= "I";
	            $angka -= 1;
	        }
	    }

	    return ($hsl);
	}
 ?>