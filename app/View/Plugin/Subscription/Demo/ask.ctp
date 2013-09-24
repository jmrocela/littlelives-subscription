<!DOCTYPE html>
<html class="no-js">
<head>
<?php echo $this->Html->charset(); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Demo</title>
<meta name="viewport" content="width=device-width">
<?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('foundation.min');
    echo $this->Html->css('main');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
?>
<script src="js/vendor/modernizr.min.js"></script>
</head>
<body>
<main id="main" role="main">

<div class="container" style="margin:20px auto;">

    <form action="http://local.littlelives.com/mock/confirm" method="post">
        <input type="hidden" value="<?php echo $_token; ?>" name="_token">
        <input type="hidden" value="<?php echo $store_id; ?>" name="store_id">
        <input type="hidden" value="<?php echo $store_type; ?>" name="store_type">
        <input type="hidden" value="<?php echo $price; ?>" name="price">
        <button type="submit">Confirm Subscription</button>
    </form>

</div>

</main>
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/underscore.js"></script>
<script src="js/vendor/backbone.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>