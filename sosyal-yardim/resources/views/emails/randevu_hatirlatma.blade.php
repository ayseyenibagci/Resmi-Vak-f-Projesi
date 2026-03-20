<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Randevu Hatırlatma</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">
    <div style="max-width: 600px; margin: auto; background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h2 style="color: #013B73;">Merhaba {{ $randevu->user->name }},</h2>

        <p style="font-size: 16px;">
            Bu bir hatırlatmadır. <strong>Randevunuz 1 saat sonra başlayacak.</strong>
        </p>

        <table style="width: 100%; margin-top: 20px;">
            <tr>
                <td><strong>Yardım Türü:</strong></td>
                <td>{{ $randevu->yardim_turu }}</td>
            </tr>
            <tr>
                <td><strong>Uzman:</strong></td>
                <td>{{ $randevu->uzman_adi }}</td>
            </tr>
            <tr>
                <td><strong>Tarih:</strong></td>
                <td>{{ $randevu->tarih }}</td>
            </tr>
            <tr>
                <td><strong>Saat:</strong></td>
                <td>{{ $randevu->saat }}</td>
            </tr>
        </table>

        <p style="margin-top: 30px;">
            Lütfen zamanında hazır olun.  
            <br><br>
            Saygılarımızla, <br>
            <strong>Sosyal Yardım Sistemi</strong>
        </p>
    </div>
</body>
</html>
