<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <style>
        .container {
            width: 900px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        .flex-container-logo{
            display: flex;
            width:600px
        }
        .container-logo{
            width:100px
        }
        .logo{
            width:80px
        }
        .toko{
            width:500px;
            text-align:left;
            margin:auto;
            margin-left:0;
        }
        .faktur{
            text-align:right;
            margin:auto;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
        }
        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container-1 .info {
            width: 350px;
        }
        .flex-container-2 {
            display: flex;
            margin-top: 5px;
        }
        .flex-container-2 > div {
            text-align : center;
        }
        .flex-container-2 .number {
            width: 25px;
        }
        .flex-container-2 .product {
            width: 500px;
        }
        .flex-container-2 .price {
            width: 125px;
        }
        .flex-container-2 .qty {
            width: 50px;
        }
        .flex-container-2 .pricetotal {
            width: 150px;
        }
        .flex-container {
            width: 900px;
            display: flex;
        }
        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="flex-container">
            <div class="header">
                <div class="flex-container">
                    <div class="flex-container-logo">
                        <div class="container-logo">
                            <img class="logo" src="{{ asset('assets/logo.png') }}" alt="">
                        </div>
                        <div class="toko">
                            <h2>SMART ELEKTRONIK NASIONAL</h2>
                            <h5 style="margin:0">Jalan Gunung Latimojong No.110 Makassar 90145</h5>
                            <h5 style="margin:0">Telp 0821-8778-3798</h5>
                        </div>
                        <div class="faktur">
                            <h2>FAKTUR PENJUALAN</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>No Order</li>
                    <li>Pelanggan</li>
                </ul>
            </div>
            <div class="info">
                <ul>
                    <li>: {{ $transaction->transaction_id }} </li>
                    <li>: {{ $transaction->customer }} </li>
                </ul>
            </div>
            <div class="left">
                <ul>
                    <li>Tanggal</li>
                    <li>Kasir</li>
                </ul>
            </div>
            <div class="info">
                <ul>
                    <li>: {{ $transaction->date }} </li>
                    <li>: {{ $transaction->admin_id }} </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="text-align:right;">
            <div class="flex-container-2">
                <div class="number" style="text-align:left;">No.</div>
                <div class="product">Nama Product</div>
                <div class="price">Harga</div>
                <div class="qty">Qty</div>
                <div class="qty">Disc</div>
                <div class="pricetotal">Total</div>
            </div>
        </div>
        <!-- {{ $i=1 }} -->
        @foreach ($transactiondetail as $item)
            <div class="flex-container" style="text-align: right;">
                <div class="flex-container-2">
                    <div class="number" style="text-align:left;">{{ $i++ }}.</div>
                    <div class="product" style="text-align:left;">{{$item->brand}} {{ $item->name }}</div>
                    <div class="price">Rp {{ number_format($item->price) }} </div>
                    <div class="qty">{{ $item->qty }} </div>
                    <div class="qty">{{ $item->discount }} %</div>
                    <div class="pricetotal" style="text-align:right;">Rp {{ number_format($item->total) }} </div>
                </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right;">
            <div class="flex-container-2">
                <div style="text-align: right; width: 750px">
                    <ul>
                        <li>Total</li>
                        <li>Diskon</li> 
                        <li>Grand Total</li>
                    </ul>
                </div>
                <div style="text-align: right; width: 150px">
                    <ul>
                        <li>Rp {{ number_format($transaction->total) }} </li>
                        <li>{{ $transaction->discount }} %</li>
                        <li>Rp {{ number_format($transaction->grandtotal) }} </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr>
        <div class="header">
            <div class="flex-container">
                <div class="left">
                    <h3 style="margin:0">Pembeli</h3>
                    <p></p>
                </div>
                <div class="right">
                    <h3 style="margin:0">Penjual</h3>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>