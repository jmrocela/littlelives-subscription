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

<div class="container" style="margin:20px auto;width:600px;">

    <form action="http://local.littlelives.com/payment/confirm" method="post">
        <input type="hidden" value="<?php echo $_token; ?>" name="_token">
        
        <input type="text" name="Sale[first_name]" value="Jamoy" />
        <input type="text" name="Sale[last_name]" value="Rocela" />
        <input type="text" name="Sale[card_type]" value="Visa" />
        <input type="text" name="Sale[exp][month]" value="10" />
        <input type="text" name="Sale[exp][year]" value="2018" />
        <input type="text" name="Sale[cvv2]" value="" />
        <input type="text" name="Sale[amount]" value="<?php echo $price; ?>" />
        <input type="text" name="Sale[card_number]" value="4813058277337777" />

        <input type="text" name="duration" value="6 Months" />

        <input type="text" name="return_url" value="<?php echo $return_url; ?>" />
        <input type="text" name="error_url" value="<?php echo $error_url; ?>" />

        <input type="hidden" value="<?php echo $store_id; ?>" name="store_id">
        <input type="hidden" value="<?php echo $store_type; ?>" name="store_type">
        <input type="hidden" value="<?php echo $price; ?>" name="price">

        <p><input type="checkbox" name="cancellation_allowed" value="1" /> Allow Cancellation?</p>
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