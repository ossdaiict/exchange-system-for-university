<!DOCTYPE html>
<html>
    <head>
        <title>Marked as Bought[to seller]</title>
    </head>
    <style>
    p {
        font-family: 'Calibri';
        font-size: 18px;
    }
    </style>
    <body>
        <p><b>Dear User,</b> <br>Your product <?=$name?> has been marked as bought by <?=$buyer_name?>.Please accept or reject by clicking on the following link </p>
        <br>
        <a href="<?=site_url('product/'.$id)?>" style="background-color: DodgerBlue; text-decoration: none; font-family: 'Calibri'; font-size: 18px; color: white; padding: 10px; border-radius: 4px;">Click to update product status</a>
        <br>
        <br>
        <p><b>Regards,</b><br>Campus Exchange System</p>
    </body>
</html>