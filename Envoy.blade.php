@setup

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

@endsetup

@servers([
    'production' => $user . '@35.198.166.193',
    'orangepi' => $user . '@192.168.1.248',
])


@task('clone', ['on' => $on])
    mkdir -p {{ $release }}
    git clone --depth 1 -b {{ $branch }} "{{ $repo }}" {{ $release }}
    echo "#1 - Repostory has been cloned"
@endtask



@task('composer', ['on' => $on])
    sudo composer self-update
    cd {{ $release }}
    composer install --no-interaction  --no-dev  --prefer-dist
    echo "#2 - Composer dependencies have been installed"

@endtask


@task('artisan', ['on' => $on])
    cd {{ $release }}

    ln -nfs {{ $path }}/.env  .env;

    chgrp -h www-data .env;

    php artisan config:clear

    php artisan migrate
    php artisan clear-compiled  --env=production;
    echo "#3 - Production dependencies have been installed"
@endtask

@task('chmod', ['on' => $on])
    chgrp -R www-data {{ $release }};
    chmod -R ug+rwx {{ $release }};

    @foreach($chmods as $file)
        chmod -R 775 {{ $release }}/{{ $file }}

        chown -R {{ $user }}:www-data {{ $release }}/{{ $file }}

        echo "Permissions have been set for {{ $file }}"
    @endforeach

    echo "#4 - Permission has been set"
@endtask

@task('update_symlinks')
   ln -nfs {{ $release }} {{ $current }};
    chgrp -h www-data {{ $current }};

    echo "#5 - Symliink has been set"
@endtask

@task('yarn', ['on' => $on])
    cd {{ $release }}

    yarn install
    yarn run prod
    echo "#6 - Frontend have been builded"
@endtask


@macro('deploy', ['on' => 'production'])
    clone
    composer
    artisan
    chmod
    update_symlinks
    yarn
@endmacro