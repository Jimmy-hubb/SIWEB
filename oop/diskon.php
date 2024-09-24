<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalBayar = $_POST['totalBayar'];
    $diskon = $_POST['diskon'];

    $payment = new Diskon($totalBayar, $diskon);
    $totalBersih = $payment->hitungTotalBersih();
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 300px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 16px;
            color: #333;
        }

        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .result {
            margin-top: 20px;
            text-align: center;
        }

        h3 {
            color: #4CAF50;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Hitung Total Pembayaran</h2>
    <form method="post" action="">
        <label for="totalBayar">Total Bayar:</label><br>
        <input type="number" id="totalBayar" name="totalBayar" step="0.01" required><br>

        <label for="diskon">Diskon (%):</label><br>
        <input type="number" id="diskon" name="diskon" step="0.01" required><br>

        <input type="submit" value="Hitung Total Bersih">
    </form>

    <?php
    if (isset($totalBersih)) {
        echo "<div class='result'><h3>Total Bersih Pembayaran: Rp " . number_format($totalBersih, 2, ',', '.') . "</h3></div>";
    }
    ?>
</div>

</body>
</html>
