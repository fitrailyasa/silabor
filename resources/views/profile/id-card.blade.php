<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Card - {{ $user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .id-card {
            width: 400px;
            height: 250px;
            background: linear-gradient(135deg, #111da2 0%, #15055d 100%);
            border-radius: 15px;
            padding: 20px;
            color: white;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        .id-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            transform: rotate(45deg);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        .header h1 {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 11px;
            opacity: 0.9;
        }

        .content {
            display: flex;
            gap: 20px;
            position: relative;
            z-index: 1;
        }

        .photo-section {
            flex-shrink: 0;
        }

        .photo {
            width: 80px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            border: 3px solid rgba(255, 255, 255, 0.3);
        }

        .info-section {
            flex: 1;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-label {
            font-size: 9px;
            opacity: 0.8;
            font-weight: bold;
            text-transform: uppercase;
        }

        .info-value {
            font-size: 11px;
            font-weight: 500;
            margin-top: 2px;
        }

        .footer {
            position: absolute;
            bottom: 15px;
            left: 20px;
            right: 20px;
            text-align: center;
            font-size: 10px;
            opacity: 0.7;
            z-index: 1;
        }

        .qr-code {
            position: absolute;
            top: 15px;
            right: 15px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            z-index: 1;
        }

        @media print {
            body {
                background: white;
            }

            .id-card {
                box-shadow: none;
                border: 1px solid #ccc;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .id-card::before {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }

            .qr-code {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                color-adjust: exact;
            }
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .print-button:hover {
            background: #0056b3;
        }

        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>

<body>
    <button class="print-button" onclick="window.print()">Cetak ID Card</button>

    <div class="id-card">
        <div class="header">
            <h1>KARTU TANDA ANGGOTA</h1>
            <p>LABORATORIUM TEKNIK BIOMEDIS</p>
        </div>

        <div class="content">
            <div class="photo-section">
                @if ($user->img)
                    <img src="{{ asset('storage/' . $user->img) }}" alt="Foto" class="photo">
                @else
                    <img src="{{ asset('assets/profile/default.png') }}" alt="Foto" class="photo">
                @endif
            </div>

            <div class="info-section">
                <div class="info-row">
                    <div class="info-label">Nama</div>
                    <div class="info-value">{{ $user->name }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">NIM</div>
                    <div class="info-value">{{ $user->nim ?? '-' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Program Studi</div>
                    <div class="info-value">{{ $user->prodi ?? '-' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Angkatan</div>
                    <div class="info-value">{{ $user->angkatan ?? '-' }}</div>
                </div>

                <div class="info-row">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $user->email }}</div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
