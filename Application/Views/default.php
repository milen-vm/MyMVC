<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo \MyMVC\Library\Config::get('siteName'); ?></title>
    </head>
    <body>
        <h3>Header</h3>
        <?php echo $data['content']; ?>
        <h3>Footer</h3>
    </body>
</html>