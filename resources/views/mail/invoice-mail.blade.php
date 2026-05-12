<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800&family=Roboto:wght@400;500&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Helvetica, Arial, sans-serif;
            color: #1e293b;
            line-height: 1.6;
            background-color: #f8fafc;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1d4ed8;
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            font-size: 32px;
            letter-spacing: 2px;
            font-weight: 800;
            text-transform: uppercase;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-family: 'Montserrat', sans-serif;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
            color: #1d4ed8;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table th {
            text-align: left;
            border-bottom: 2px solid #eff6ff;
            padding: 12px 0;
            font-size: 11px;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.1em;
            font-family: 'Montserrat', sans-serif;
        }

        .table td {
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .service-name {
            font-weight: 500;
            color: #1e293b;
            display: block;
        }

        .service-type {
            font-family: 'Montserrat', sans-serif;
            font-size: 9px;
            color: #1d4ed8;
            background: #eff6ff;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 700;
            display: inline-block;
            margin-top: 4px;
        }

        .summary-section {
            margin-top: 25px;
            padding: 20px;
            background-color: #f8fafc;
            border-radius: 12px;
        }

        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .summary-label {
            display: table-cell;
            font-size: 13px;
            color: #64748b;
        }

        .summary-value {
            display: table-cell;
            text-align: right;
            font-size: 14px;
            font-weight: 500;
        }

        .total-row {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px solid #e2e8f0;
        }

        .total-label {
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            color: #1e293b;
            font-weight: 800;
            text-transform: uppercase;
        }

        .total-amount {
            font-family: 'Montserrat', sans-serif;
            font-size: 22px;
            font-weight: 800;
            color: #1d4ed8;
            text-align: right;
        }

        .discount-text {
            color: #ef4444;
            font-weight: 600;
        }

        .status-pill {
            display: inline-block;
            margin-top: 25px;
            padding: 8px 18px;
            background-color: #1d4ed8;
            color: #ffffff;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer {
            background-color: #ffffff;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
        }

        .footer p {
            font-size: 12px;
            color: #94a3b8;
            margin: 5px 0;
        }

        .social-link {
            color: #1d4ed8;
            text-decoration: none;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo-area">
                <img src="https://iili.io/Bb0dKMu.png" alt="KickCare Logo" border="0" style="width: 250px; height: auto;">
            </div>
            <div style="margin-top: 15px; font-family: 'Montserrat', sans-serif; font-size: 11px; font-weight: 700; background: rgba(255,255,255,0.15); display: inline-block; padding: 5px 15px; border-radius: 50px; border: 1px solid rgba(255,255,255,0.3);">
                ORDER ID: #{{ $transaction->transaction_code }}
            </div>
        </div>

        <div class="content">
            <div class="greeting">Halo, {{ $transaction->transaction_item->first()->customer_name ?? 'Pelanggan' }}!</div>
            <p style="color: #475569; font-size: 14px;">Terima kasih telah memilih KickCare. Berikut adalah rincian pembayaran untuk perawatan sepatu Anda:</p>

            <table class="table">
                <thead>
                    <tr>
                        <th>Item & Layanan</th>
                        <th style="text-align: right;">Harga Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $subtotal = 0;
                        // Logic untuk mendapatkan harga dasar berdasarkan service
                        $basePrices = ['wash' => 65000, 'unyellowing' => 80000, 'repaint' => 150000];
                    @endphp
                    @foreach ($transaction->transaction_item as $item)
                        @php
                            $itemBasePrice = $basePrices[$item->service] ?? $item->price;
                            $subtotal += $itemBasePrice;
                        @endphp
                        <tr>
                            <td>
                                <span class="service-name">{{ $item->shoes_name }}</span>
                                <span class="service-type">{{ strtoupper($item->service) }}</span>
                            </td>
                            <td style="text-align: right; font-weight: 500; color: #1e293b;">
                                Rp {{ number_format($itemBasePrice, 0, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="summary-section">
                <div class="summary-row">
                    <span class="summary-label">Subtotal</span>
                    <span class="summary-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                @if($subtotal > $transaction->total_price)
                <div class="summary-row">
                    <span class="summary-label">Diskon Member ({{ strtoupper($transaction->user->status_member ?? 'User') }})</span>
                    <span class="summary-value discount-text">- Rp {{ number_format($subtotal - $transaction->total_price, 0, ',', '.') }}</span>
                </div>
                @endif

                <div class="summary-row total-row">
                    <table width="100%">
                        <tr>
                            <td class="total-label">Total Pembayaran</td>
                            <td class="total-amount">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div style="text-align: center;">
                <div class="status-pill">
                    Payment Status: {{ $transaction->detail_transaction->payment_status ?? 'PAID' }}
                </div>
            </div>
        </div>

        <div class="footer">
            <p style="color: #1e293b; font-weight: 600; font-size: 13px; margin-bottom: 8px;">KickCare Indonesia</p>
            <p>Jl. Boulevard Raya Gading Serpong, Tangerang</p>
            <p>Follow us on Instagram <a href="#" class="social-link">@kickcare.id</a></p>
            <p style="margin-top: 15px; font-size: 10px; opacity: 0.6;">© 2026 KickCare. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
