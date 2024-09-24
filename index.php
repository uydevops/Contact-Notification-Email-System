<?php

function autoRegex($input)
{
    return htmlspecialchars(stripslashes(trim($input)), ENT_QUOTES, 'UTF-8');
}

function generateTableRow($label, $value)
{
    return '
        <tr>
            <td style="font-weight: bold; text-align: right; background-color: #f4f4f4; border-bottom: 1px solid #ccc;">' . autoRegex($label) . ':</td>
            <td style="border-bottom: 1px solid #ccc; text-align: left;">' . autoRegex($value) . '</td>
        </tr>';
}

require "formlar/mail/class.phpmailer.php";

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->Host = '';
$mail->Port = 587;
$mail->Username = '';
$mail->Password = ''; // Şifrenizi güvenli bir şekilde saklayın
$mail->SetFrom($mail->Username, autoRegex($_POST['company_name']));
$mail->AddAddress('uydevp@gmail.com');

$mail->CharSet = 'UTF-8';
$mail->Subject = autoRegex($_POST['title']) . ' - ' . autoRegex($_POST['company_name']);

$content = '
    <div style="font-family: Arial, Helvetica, sans-serif; background: #f4f4f4; padding: 20px;">
        <div style="background: #0e76a8; color: #fff; padding: 20px; border-radius: 8px; text-align: center;">
            <h1 style="font-size: 24px; margin: 0;">' . autoRegex($_POST['company_name']) . '</h1>
            <p style="font-size: 14px;">İletişim Bildirimi</p>
        </div>
        <div style="background: #fff; border: 1px solid #ccc; padding: 20px; border-radius: 8px; margin-top: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <table width="100%" border="0" cellpadding="10" cellspacing="0">
                ' . generateTableRow('İşlem Tarihi ve Saati', date("d.m.Y H:i:s")) . '
';

// Alt çizgi ile ayrılmış parametreleri büyük harfle başlatma
foreach ($_POST as $key => $value) {
    if ($key !== 'title' && $key !== 'return_url') {
        $formattedKey = ucfirst(str_replace('_', ' ', $key)); // Alt çizgileri boşlukla değiştir ve ilk harfi büyük yap
        $content .= generateTableRow($formattedKey, $value);
    }
}

$content .= '
            </table>
        </div>
        <div style="margin-top: 20px; text-align: center; font-size: 12px; color: #888;">
            <p>&copy; ' . date('Y') . ' ' . autoRegex($_POST['company_name']) . '</p>
        </div>
    </div>';

$mail->MsgHTML($content);

// E-posta gönderiminde hata yönetimi
try {
    if ($mail->Send()) {
        $returnUrl = isset($_POST['return_url']) ? $_POST['return_url'] : 'default_return_url.php';
        header("Location: " . $returnUrl);
        exit();
    } else {
        throw new Exception("Mail gönderilemedi: " . $mail->ErrorInfo);
    }
} catch (Exception $e) {
    error_log($e->getMessage());
    echo "Bir hata oluştu: " . $e->getMessage();
}
