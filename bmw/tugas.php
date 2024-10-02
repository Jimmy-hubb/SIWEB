<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Produk Pakaian</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-image {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
        }
        .color-indicator {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            margin-left: 10px;
            border: 1px solid #000;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center mb-5">Informasi Produk Pakaian</h1>
    
    <div class="row">

        <?php
        // Class dasar ItemProduk menggunakan konsep inheritance dan encapsulation
        class ItemProduk {
            private $ukuran;
            private $warna;
            private $nama;
            private $gambar;

            public function __construct($nama, $ukuran, $warna, $gambar) {
                $this->nama = $nama;
                $this->ukuran = $ukuran;
                $this->warna = $warna;
                $this->gambar = $gambar;
            }

            public function getNama() {
                return $this->nama;
            }

            public function getUkuran() {
                return $this->ukuran;
            }

            public function getWarna() {
                return $this->warna;
            }

            public function getGambar() {
                return $this->gambar;
            }

            public function tampilkanInformasiProduk() {
                echo "Nama Produk: " . $this->getNama() . "<br>";
                echo "Ukuran: " . $this->getUkuran() . "<br>";
                echo "Warna: " . $this->getWarna() . "<span class='color-indicator' style='background-color:" . strtolower($this->getWarna()) . ";'></span><br>";
            }
        }

        class Topi extends ItemProduk {
            private $model;

            public function __construct($nama, $ukuran, $warna, $model, $gambar) {
                parent::__construct($nama, $ukuran, $warna, $gambar);
                $this->model = $model;
            }

            public function getModel() {
                return $this->model;
            }

            public function tampilkanInformasiTopi() {
                $this->tampilkanInformasiProduk();
                echo "Model Topi: " . $this->getModel() . "<br>";
            }
        }

        class Celana extends ItemProduk {
            private $tipe;
            private $model;

            public function __construct($nama, $ukuran, $warna, $tipe, $model, $gambar) {
                parent::__construct($nama, $ukuran, $warna, $gambar);
                $this->tipe = $tipe;
                $this->model = $model;
            }

            public function getTipe() {
                return $this->tipe;
            }

            public function getModel() {
                return $this->model;
            }

            public function tampilkanInformasiCelana() {
                $this->tampilkanInformasiProduk();
                echo "Tipe Celana: " . $this->getTipe() . "<br>";
                echo "Model Celana: " . $this->getModel() . "<br>";
            }
        }

        class Baju extends ItemProduk {
            private $tipe;

            public function __construct($nama, $ukuran, $warna, $tipe, $gambar) {
                parent::__construct($nama, $ukuran, $warna, $gambar);
                $this->tipe = $tipe;
            }

            public function getTipe() {
                return $this->tipe;
            }

            public function tampilkanInformasiBaju() {
                $this->tampilkanInformasiProduk();
                echo "Tipe Baju: " . $this->getTipe() . "<br>";
            }
        }

        // Membuat objek Topi dengan gambar dan informasi
        $topi = new Topi("Topi Baseball", "M", "Black", "Snapback", "https://dynamic.zacdn.com/IsyCp10htEXdXu8JJCNcXcHxfYw=/filters:quality(70):format(webp)/https://static-id.zacdn.com/p/snapback-7408-6373443-1.jpg");

        // Membuat objek Celana dengan gambar dan informasi
        $celana = new Celana("Celana Jeans", "32", "Navy", "Panjang", "Slim Fit", "https://cutoff.id/cdn/shop/files/INDIGO.jpg?v=1686984909");

        // Membuat objek Baju dengan gambar dan informasi
        $baju = new Baju("Baju Kemeja", "L", "LightBlue", "Formal", "https://jobb.co.id/wp-content/uploads/2023/10/rug-1681182716140-4.jpg");

        // Menggunakan Bootstrap Card untuk menampilkan produk dengan gambar
        function tampilkanProduk($objek, $jenis) {
            echo '
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="' . $objek->getGambar() . '" class="product-image" alt="' . $objek->getNama() . '">
                    <div class="card-body">
                        <h5 class="card-title text-center">' . $jenis . '</h5>
                        <p class="card-text">';
                            $objek->tampilkanInformasiProduk();
                            if ($jenis === "Topi") {
                                echo "Model Topi: " . $objek->getModel() . "<br>";
                            } elseif ($jenis === "Celana") {
                                echo "Tipe Celana: " . $objek->getTipe() . "<br>";
                                echo "Model Celana: " . $objek->getModel() . "<br>";
                            } elseif ($jenis === "Baju") {
                                echo "Tipe Baju: " . $objek->getTipe() . "<br>";
                            }
                        echo '</p>
                    </div>
                </div>
            </div>';
        }

        // Menampilkan produk dalam card Bootstrap
        tampilkanProduk($topi, "Topi");
        tampilkanProduk($celana, "Celana");
        tampilkanProduk($baju, "Baju");
        ?>

    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
