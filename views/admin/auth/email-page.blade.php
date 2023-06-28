<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <link rel="icon" href="{{ asset('public/dist/img/IPFSLogo.jpg') }}">
  <title></title>
  <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;">
        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td style="border-bottom: outset;">
              <img src="https://infograinsdevelopment.com/Littlest-Precious/public/dist/img/IPFSLogo.jpg" alt="" width="100" style="height:auto;display:block;" />
            </td>
          </tr>
          <tr>
            <td style="padding:36px 30px 42px 30px;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                  <td style="padding:0 0 36px 0;color:#4c4c4c;">
                    <h1 style="font-size:24px;font-family:Arial,sans-serif;">Dear Admin</h1>
                    <br>
                    <p style="font-size:16px;line-height:24px;font-family:Arial,sans-serif;">We have received a request to reset your password.</p>
                    <p style="font-size:16px;line-height:24px;font-family:Arial,sans-serif;">Click on the button below to reset your password. If you ignore this message, your password won’t be changed.</p>
                    <br>
                    <p align="center" style="margin:0;font-size:16px;line-height:24px;font-family:Arial,sans-serif;"><a href="{{ url('admin/email/'.$data['token'].'?email='.$data['email']) }}" target="_blank"  style="background: linear-gradient(270deg, #8AB6FF 0%, #BDB2FF 100%);rder: none; color: #ffffff; padding: 10px 32px; text-align: center; text-decoration: none; display: inline-block; margin: 4px 2px; cursor: pointer; border-radius: 4px; border-width: 10px 15px; cursor: pointer;">Reset password</a></p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>

          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
