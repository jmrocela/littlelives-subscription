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

    <div class="row">
        <div class="small-3 columns">
            <div class="panel">
                <h4 style="margin:0;"><?php echo $organization[0]['name']; ?></h4>
                <hr>
                <div id="subscriptions" style="min-height:200px;">
                    <?php
                        $subscriptions = array();

                        if ($subscriptions) {

                        } else {
                            ?>
                            <p class="text-center">No Subscriptions Yet</p>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <ul style="margin-left:20px;font-size:12px;">
                <li>Figure out Model Association</li>
                <li>Add product information associated to a Package</li>
            </ul>
        </div>
        <div class="small-6 columns">
            <h1 style="margin:0;">Subscriptions</h1>
            <p>Select which products and services you'd like to subscribe to.</p>
            <hr>
            <h3>Packages</h3>
            <div class="row" style="margin-top:40px;">
                <?php 
                    foreach ($package as $object) {
                ?>
                    <div class="small-6 columns text-center" style="margin-bottom:30px;">
                        <div style="border-radius:5px;background:#f0f0f0;color:#888;padding:10px;font-size:18px;">
                            <div style="height:80px;">
                                <span class="glyphicon glyphicon-ok-circle"></span> <br/> <?php echo $object['name']; ?>
                            </div>
                            <div style="padding:10px 0 0;font-size:11px;">
                                <?php
                                    $catalogs = array('Test', 'Hey');
                                ?>
                                <!-- Includes <?php echo join(', ', $catalogs); ?>--> 
                                Available for $<?php echo number_format($object['price']); ?>
                            </div>
                            <div style="padding:10px 0 0;">
                                <?php if (@$object['subscribed']) { ?>
                                <button class="button radius success">Subscribe</button>
                                <?php } else { ?>
                                <button class="button radius secondary" disabled>Subscribed</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>
            <hr>
            <h3>Catalog</h3>
            <div class="row" style="margin-top:40px;">
                <?php 
                    foreach ($catalog as $object) {
                ?>
                    <div class="small-6 columns text-center" style="margin-bottom:30px;">
                        <div style="border-radius:5px;background:#f0f0f0;color:#888;padding:10px;font-size:18px;">
                            <div style="height:80px;">
                                <span class="glyphicon glyphicon-ok-circle"></span> <br/> <?php echo $object['name']; ?>
                            </div>
                            <div style="padding:10px 0 0;font-size:11px;">
                                Available for $<?php echo number_format($object['price']); ?>
                            </div>
                            <div style="padding:10px 0 0;">
                                <?php if (@$object['subscribed']) { ?>
                                <button class="button radius success">Subscribe</button>
                                <?php } else { ?>
                                <button class="button radius secondary" disabled>Subscribed</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
            </div>

        </div>
        <div class="small-3 columns">
            <div class="panel text-center">
                <div id="subscribed" style="min-height:200px;">

                </div>
                <h5>Total $<span>0.00</span></h5>
                <button class="button radius">Finalize Subscriptions</button>
            </div>
        </div>
    </div>

</div>

</main>
<script src="js/vendor/jquery.min.js"></script>
<script src="js/vendor/underscore.js"></script>
<script src="js/vendor/backbone.js"></script>
<script src="js/foundation.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>