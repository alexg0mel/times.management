<?php $file = isset($file) ? $file : null; ?>
<?php $on = isset($on) ? $on : null; ?>
<?php $release = isset($release) ? $release : null; ?>
<?php $date = isset($date) ? $date : null; ?>
<?php $chmods = isset($chmods) ? $chmods : null; ?>
<?php $branch = isset($branch) ? $branch : null; ?>
<?php $repo = isset($repo) ? $repo : null; ?>
<?php $current = isset($current) ? $current : null; ?>
<?php $path = isset($path) ? $path : null; ?>
<?php $timezone = isset($timezone) ? $timezone : null; ?>
<?php $user = isset($user) ? $user : null; ?>
<?php

    $user = 'alexgomel';

    $timezone = 'Europe/Moscow';

    $path = '/var/www/alexgomel.ml';

    $current = $path . '/current';

    $repo = "git@github.com:alexg0mel/times.management.git";

    $branch = 'master';

    // 775 dir
    $chmods = [
        'storage/logs'
    ];

    $date = new DateTime('now', new DateTimeZone($timezone));
    $release = $path . '/releases/' . $date->format('YmdHis');

?>

<?php $__container->servers([<?php /*'production' => $user . '@35.198.166.193',*/ ?>'orangepi' => $user . '@192.168.1.248']); ?>


<?php $__container->startTask('clone', ['on' => $on]); ?>
    mkdir -p <?php echo $release; ?>

    git clone --depth 1 -b <?php echo $branch; ?> "<?php echo $repo; ?>" <?php echo $release; ?>

    echo "#1 - Repostory has been cloned"
<?php $__container->endTask(); ?>



<?php $__container->startTask('composer', ['on' => $on]); ?>
    sudo composer self-update
    cd <?php echo $release; ?>

    composer install --no-interaction  --no-dev  --prefer-dist
    echo "#2 - Composer dependencies have been installed"

<?php $__container->endTask(); ?>


<?php $__container->startTask('artisan', ['on' => $on]); ?>
    cd <?php echo $release; ?>


    ln -nfs <?php echo $path; ?>/.env  .env;

    chgrp -h www-data .env;

    php artisan config:clear

    php artisan migrate
    php artisan clear-compiled  --env=production;
    echo "#3 - Production dependencies have been installed"
<?php $__container->endTask(); ?>

<?php $__container->startTask('chmod', ['on' => $on]); ?>
    chgrp -R www-data <?php echo $release; ?>;
    chmod -R ug+rwx <?php echo $release; ?>;

    <?php foreach($chmods as $file): ?>
        chmod -R 775 <?php echo $release; ?>/<?php echo $file; ?>


        chown -R <?php echo $user; ?>:www-data <?php echo $release; ?>/<?php echo $file; ?>


        echo "Permissions have been set for <?php echo $file; ?>"
    <?php endforeach; ?>

    echo "#4 - Permission has been set"
<?php $__container->endTask(); ?>

<?php $__container->startTask('update_symlinks'); ?>
   ln -nfs <?php echo $release; ?> <?php echo $current; ?>;
    chgrp -h www-data <?php echo $current; ?>;

    echo "#5 - Symliink has been set"
<?php $__container->endTask(); ?>

<?php $__container->startTask('yarn', ['on' => $on]); ?>
    cd <?php echo $release; ?>


    yarn install
    yarn run prod
    echo "#6 - Frontend have been builded"
<?php $__container->endTask(); ?>


<?php $__container->startMacro('deploy', ['on' => 'production']); ?>
    clone
    composer
    artisan
    chmod
    update_symlinks
    yarn
<?php $__container->endMacro(); ?>

<?php $__container->startMacro('deploy248', ['on' => 'orangepi']); ?>
clone
composer
artisan
chmod
update_symlinks
yarn
<?php $__container->endMacro(); ?>

