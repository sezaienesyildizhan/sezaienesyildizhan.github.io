<?php

    // Kullanıcıdan gelen verileri güvenli bir şekilde al
    $to = "zmeyadev@gmail.com";  // Alıcı e-posta adresi
    $from = filter_var($_REQUEST['email'], FILTER_SANITIZE_EMAIL);
    $name = htmlspecialchars($_REQUEST['name'], ENT_QUOTES, 'UTF-8');
    $subject = htmlspecialchars($_REQUEST['subject'], ENT_QUOTES, 'UTF-8');
    $number = htmlspecialchars($_REQUEST['number'], ENT_QUOTES, 'UTF-8');
    $cmessage = htmlspecialchars($_REQUEST['message'], ENT_QUOTES, 'UTF-8');

    // E-posta başlıklarını oluştur
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Mail konusunu tanımla
    $email_subject = "Yeni İletişim Formu Mesajı";

    // Mail içeriğini oluştur
    $body = "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Yeni Mesaj</title>
    </head>
    <body>
        <table style='width: 100%; border-collapse: collapse;'>
            <thead>
                <tr>
                    <td style='border:none; text-align:center;' colspan='2'>
                        <img src='img/logo.png' alt='Furkan Hukuk' style='max-width:150px;'><br><br>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style='border:none;'><strong>Adı:</strong> {$name}</td>
                    <td style='border:none;'><strong>E-Posta:</strong> {$from}</td>
                </tr>
                <tr>
                    <td style='border:none;'><strong>Konu:</strong> {$subject}</td>
                </tr>
                <tr>
                    <td style='border:none;'><strong>Telefon Numarası:</strong> {$number}</td>
                </tr>
                <tr>
                    <td colspan='2' style='border:none; padding-top:10px;'><strong>Mesaj:</strong><br>{$cmessage}</td>
                </tr>
            </tbody>
        </table>
    </body>
    </html>";

    // Mail gönder ve sonucu kontrol et
    if (mail($to, $email_subject, $body, $headers)) {
        echo "success";  // JavaScript tarafında başarıyı kontrol etmek için
    } else {
        echo "error";  // Hata durumunda
    }

?>