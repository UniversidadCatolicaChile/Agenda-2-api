<?php

define('SITE_TITLE','Testing Agenda');
define('SITEURL','/');
define('SITEWEB','/test/');
define('VERSION',mt_rand(0,9999));
$site_description = SITE_TITLE;
$site_title = SITE_TITLE;
$site_image = 'https://agenda.uc.cl/wp-content/themes/agendauc/images/logo.png';
$curl = 'http://'.$_SERVER['SERVER_NAME'].''.$_SERVER['REQUEST_URI'];

?><!DOCTYPE html>
<html lang="es_CL">
<head>
    <meta charset="utf-8">
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo SITE_TITLE ?></title>

    <meta name="abstract" content="<?php echo $site_description ?>">
    <meta name="language" content="es">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="<?php echo $site_title ?>">
    <meta property="og:description" content="<?php echo $site_description ?>">
    <meta property="og:type" content="website">
    <meta property="og:image" content="<?php echo $site_image ?>">
    <meta property="og:url" content="<?php echo $curl ?>">
    <meta property="og:locale" content="es_CL">

    <meta name="description" content="<?php echo $site_description ?>">

    <!--
    <link rel="icon" type="image/png" href="<?php echo SITEWEB ?>/icon/favicon-32x32.png?ver=<?php echo VERSION ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Saira:200,300,400,500,700">
    -->

    <script type="text/javascript">
        window.SITEWEB = '<?php echo SITEWEB ?>';
        window.SITEURL = '<?php echo SITEURL ?>';
    </script>
</head>
<body>

<script>
    window.VERSION = '<?php echo VERSION ?>';
</script>
<script src="<?php echo SITEWEB ?>/js/base.js?ver=<?php echo VERSION ?>"></script>
<script src="<?php echo SITEWEB ?>/js/index.js?ver=<?php echo VERSION ?>"></script>

</body>
</html>
