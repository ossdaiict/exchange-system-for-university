<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>
    <style>
    p {
        font-family: 'Calibri';
        font-size: 18px;
    }
    </style>
    <body>
        <p><b>Dear User,</b> <br>You have been successfully registered. Kindly verify your account by clicking on the following link. </p>
        <br>
        <a href="<?=site_url('Register/verify/'.$id.'/'.$key)?>" style="background-color: DodgerBlue; text-decoration: none; font-family: 'Calibri'; font-size: 18px; color: white; padding: 10px; border-radius: 4px;">Click here to verify</a>
        <br>
        <br>
        <p>Regards,<br>Campus Exchange System</p>
    </body>
</html>