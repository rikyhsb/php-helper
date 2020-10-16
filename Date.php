<?php

class Date
{
    /**
     * menampilkan daftar bulan dalam format bahasa indonesia
     * @return array $month
     */
    function generateIntegerMonth()
    {
        $month = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];
        return $month;
    }

    /**
     * menampilkan daftar tahun dari tahun sekarang hingga tahun yang diinginkan
     * @param  string $end
     * @return array $year
     */
    function generateYear($end)
    {
        $currentYear = date('Y');
        $year = [];
        for ($i = $currentYear; $i <= $currentYear + $end; $i++) {
            array_push($year, $i);
        }
        return $year;
    }

    /**
     * Konversi format date dari MySQL menjadi format tanggal indonesia
     * @param  string $date
     * @return string
     */
    function generateIndonesiaDate($date)
    {
        $month = self::generateIntegerMonth();
        $timestamp = strtotime($date);
        return date('j', $timestamp) .' '. $month[date('n', $timestamp)] . date(' Y', $timestamp);
    }
}

$date = new Date();
$currentDate = date('Y-m-d');
$convertDate = $date->generateIndonesiaDate($currentDate);

print_r(['input' => $currentDate, 'output' => $convertDate]);

/* output
Array
(
    [input] => 2020-10-17
    [output] => 17 Oktober 2020
)
*/
