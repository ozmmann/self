<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email</title>
    <style>
        .blue-link:hover {
            text-decoration: none;
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #edf1fc;">
<table width="100%" bgcolor="#edf1fc" cellpadding="0" cellspacing="0">
    <tr>
        <td align="center">

            <table width="100%" bgcolor="#131a26" cellpadding="0" cellspacing="0">
                <tr valign="middle">
                    <td align="center" height="70">
                        <b><font face="Arial" color="#ffffff" size="6" style="font-variant: small-caps; font-size: 30px;">Pokupon &
                                SuperDeal</font></b>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <tr valign="middle">
                    <td align="center" height="70">
                        &nbsp;
                    </td>
                </tr>
            </table>

            <table width="550" bgcolor="#fff" cellpadding="0" cellspacing="0">
                <tr valign="bottom">
                    <td align="center">
                        <?php //todo check img on prod ?>
                        <img alt="Получилось" src="<?= \yii\helpers\Url::home(true)?>img/email-header.jpg">
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center" height="50">
                        &nbsp;
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center">
                        <b><font face="Arial" color="#0f204b" size="6" style="font-size: 30px;">
                                <?= $title ?>
                            </font>
                        </b>
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center" height="40">
                        &nbsp;
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <div><!--[if mso]>
                            <v:roundrect xmlns:v="urn:schemas-microsoft-com:vml"
                                         xmlns:w="urn:schemas-microsoft-com:office:word" href="<?= $link ?>"
                                         style="height:40px;v-text-anchor:middle;width:120px;" arcsize="10%" stroke="f"
                                         fillcolor="#70bafc">
                                <w:anchorlock/>
                                <center>
                            <![endif]-->
                            <a href="<?= $link ?>"
                               style="background-color:#70bafc;border-radius:4px;color:#ffffff;display:inline-block;font-family:sans-serif;font-size:13px;font-weight:bold;line-height:40px;text-align:center;text-decoration:none;width:120px;-webkit-text-size-adjust:none;">
                                Перейти
                            </a>
                            <!--[if mso]>
                            </center>
                            </v:roundrect>
                            <![endif]-->
                        </div>
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center" height="50">
                        &nbsp;
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center">
                        <font face="Arial" color="#9daac2" size="2" style="font-size: 12px;">
                            <? $body ?>
                        </font>
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center" height="50">
                        &nbsp;
                    </td>
                </tr>
                <tr valign="middle">
                    <td align="center" bgcolor="#66b3ff" height="120">
                        <font face="Arial" color="#ffffff" size="2" style="font-size: 12px;">
                            Вы получили это письмо, потому что оставили заявку на нашем сайте. <br>
                            Если это были не вы пожалуйста <a href="mailto:<?= Yii::$app->params['adminEmail'] ?>"
                                                              class="blue-link"
                                                              style="text-decoration: underline; color: #fff;">свяжитесь с нами</a>
                        </font>
                    </td>
                </tr>
            </table>

            <table width="100%" cellpadding="0" cellspacing="0">
                <tr valign="middle">
                    <td align="center" height="100">
                        &nbsp;
                    </td>
                </tr>
            </table>

        </td>
    </tr>
</table>
<div style="display:none; white-space:nowrap; font:15px courier; line-height:0;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </div>
</body>
</html>