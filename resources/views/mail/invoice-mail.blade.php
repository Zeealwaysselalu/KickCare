<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="header">
        <h2 style="text-align: center">INVOICE PEMBELIAN</h2>
        <p style="text-align: center">Kode Transaksi: KC2026000001</p>
    </div>
    <br>
    <table border="1" width="25%" style="margin: 0 auto; border: 1px solid black;">
        <thead>
            <tr>
                <th>Jenis Sepatu</th>
                <th>Jenis Pelayanan</th>
                <th>Harga</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Nike Air Force 1</td                 >
                <td>Deep Clean</td>
                <td>50,000</td>
                <td>50,000</td>
            </tr>
        </tbody>
    </table>

    <div class="footer" style="text-align: center">
        <h3>Total: Rp </h3>
        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
            {!! DNS1D::getBarcodeHTML('KC2026000001', 'C128') !!}
            <p>KC2026000001</p>
        </div>
    </div>
</body>

</html>
