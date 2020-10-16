<?php

class Money
{
    protected $_bilangan = [
        '',
        'Satu',
        'Dua',
        'Tiga',
        'Empat',
        'Lima',
        'Enam',
        'Tujuh',
        'Delapan',
        'Sembilan',
        'Sepuluh',
        'Sebelas'
    ];

    /**
     * konversi angka menjadi format rupiah
     * @param integer $angka
     * @return string $rupiah
     */
    function rupiah($angka)
    {
        return number_format($angka, 0, ',', '.');
    }

    /**
     * konversi format angka menjadi terbilang
     * @param int $angka
     * @return string $terbilang;
     */
    function terbilang($angka)
    {
        $angka = floatval($angka);
        if ($angka < 12) {
            return $this->_bilangan[$angka];
        } elseif ($angka < 20) {
            return $this->_bilangan[$angka - 10] . ' Belas';
        } elseif ($angka < 100) {
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $this->_bilangan[$hasil_bagi], $this->_bilangan[$hasil_mod]));
        } elseif ($angka < 200) {
            return sprintf('Seratus %s', self::terbilang($angka - 100));
        } elseif ($angka < 1000) {
            $hasil_bagi = (int)($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s Ratus %s', $this->_bilangan[$hasil_bagi], self::terbilang($hasil_mod)));
        } elseif ($angka < 2000) {
            return trim(sprintf('Seribu %s', self::terbilang($angka - 1000)));
        } elseif ($angka < 1000000) {
            $hasil_bagi = intval($angka / 1000);
            $hasil_mod = $angka % 1000;
            return sprintf('%s Ribu %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod));
        } elseif ($angka < 1000000000) {
            $hasil_bagi = intval($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s Juta %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } elseif ($angka < 1000000000000) {
            $hasil_bagi = intval($angka / 1000000000);
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s Milyar %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } elseif ($angka < 1000000000000000) {
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s Triliun %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } else {
            return false;
        }
    }
}

$money = new Money();
$input = 150000;
$rupiahOutput = $money->rupiah($input);
$terbilangOutput = $money->terbilang($input);

print_r([
    'input' => $input,
    'rupiah' => $rupiahOutput,
    'terbilang' => $terbilangOutput
]);

/* output
Array
(
    [input] => 150000
    [rupiah] => 150.000
    [terbilang] => Seratus Lima Puluh Ribu 
)
 */
