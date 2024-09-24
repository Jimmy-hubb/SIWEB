Source code ini adalah sebuah aplikasi berbasis web sederhana yang dibuat menggunakan PHP untuk menghitung total pembayaran setelah diskon. Berikut adalah penjelasan per bagian dari kode:

### Class Diskon
```php
Salin kode
class Diskon {
    private $totalBayar;
    private $diskon;

    // Konstruktor untuk inisialisasi nilai
    public function __construct($totalBayar, $diskon) {
        $this->totalBayar = $totalBayar;
        $this->diskon = $diskon;
    }

    public function hitungTotalBersih() {
        $totalDiskon = $this->totalBayar * ($this->diskon / 100);
        $totalBersih = $this->totalBayar - $totalDiskon;
        return $totalBersih;
    }
}
```
Class Diskon bertanggung jawab untuk menghitung total pembayaran setelah diskon.
Atribut:

$totalBayar: Menyimpan nilai total pembayaran awal.

$diskon: Menyimpan persentase diskon.

Constructor menerima dua parameter ($totalBayar dan $diskon) untuk menginisialisasi properti kelas.

Method hitungTotalBersih():
Menghitung nilai diskon dengan rumus: totalDiskon = totalBayar * (diskon / 100).

Mengurangi total bayar dengan total diskon: totalBersih = totalBayar - totalDiskon.

Mengembalikan hasil dari total bersih.

2. ### Bagian Pengolahan Data di PHP
```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalBayar = $_POST['totalBayar'];
    $diskon = $_POST['diskon'];

    $payment = new Diskon($totalBayar, $diskon);
    $totalBersih = $payment->hitungTotalBersih();
}
```
Menggunakan metode POST untuk menerima input dari form.

Data dari form (totalBayar dan diskon) dikirim menggunakan metode POST.

Membuat objek Diskon baru berdasarkan data dari form, kemudian memanggil method hitungTotalBersih() untuk menghitung hasilnya.