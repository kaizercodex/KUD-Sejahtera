<?php

if (! function_exists('format_rupiah')) {
    function format_rupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (! function_exists('umur_dari_tanggal')) {
    function umur_dari_tanggal($tanggal)
    {
        return \Carbon\Carbon::parse($tanggal)->age;
    }
}
