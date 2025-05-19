<?php

   $utm_source = isset($_GET['utm_source']) ? $_GET['utm_source'] : '';
   $utm_campaign = isset($_GET['utm_campaign']) ? $_GET['utm_campaign'] : '';
   $utm_medium = isset($_GET['utm_medium']) ? $_GET['utm_medium'] : '';
   $utm_content = isset($_GET['utm_content']) ? $_GET['utm_content'] : '';
   $utm_term = isset($_GET['utm_term']) ? $_GET['utm_term'] : '';

   $pageTitle = "Scopri il potenziale di Amazon: l’opportunità di trading che non puoi perdere";
   $pageContent = __DIR__ . '/content.php';

   $headExtras = <<<HTML
       <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel=" icon" href="assets/favicon.ico">
      <title></title>
      <link rel="stylesheet" href="assets/style.css?011">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous"
         referrerpolicy="no-referrer"></script>
      <link rel="stylesheet"
         href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
      <script type="text/javascript"
         src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <script type="text/javascript" src="//widget.trustpilot.com/bootstrap/v5/tp.widget.bootstrap.min.js" async></script>
   HTML;

   include __DIR__ . '/../layout.php';

?>
