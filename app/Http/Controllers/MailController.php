<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    public function sendEmail(Request $request)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'boutglimtihsane@gmail.com';
            $mail->Password   = 'dskx iaag yybl wvko';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Sender
            $mail->setFrom('boutglimtihsane@gmail.com');

            // Recipient
            $mail->addAddress("boutglimtihsane@gmail.com");

            // Email content
            $mail->isHTML(true);
            $mail->Subject = "Nouveau message de ENZO'S!";
            $mail->Body    = "
                <!DOCTYPE html>
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Email Message</title>
                </head>
                <body>
                    <div style='width: 100%; display: flex; justify-content: center; padding: 20px;'>
                        <table style='width: 100%; max-width: 600px; border-collapse: collapse;'>
                            <tr>
                                <td colspan='2' style='text-align:center;padding:16px;'>
                                    <h3>ENZO'S</h3>
                                </td>
                            </tr>
                            <tr>
                                <td style='padding: 8px;'><b>Nom:</b></td>
                                <td style='padding: 8px;'>{$request->name}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px;'><b>Telephone:</b></td>
                                <td style='padding: 8px;'>{$request->phone}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px;'><b>Email:</b></td>
                                <td style='padding: 8px;'>{$request->email}</td>
                            </tr>
                            <tr>
                                <td style='padding: 8px;'><b>Message:</b></td>
                                <td style='padding: 8px;'>{$request->message}</td>
                            </tr>
                        </table>
                    </div>
                </body>
                </html>
            ";

            // Send email
            $mail->send();

            return response()->json(['message' => 'Email sent successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Failed to send email', 'error' => $mail->ErrorInfo], 500);
        }
    }
}
