@servers([ 'local' => 'vagrant@domain.com', 'live' => '-A user@dev.domain.com', 'root' => '-A root@domain.com' ])

@setup
    $now = new DateTime();
    $date = $now->format('Ymd-His');
    $username = shell_exec('git config user.name | tr -d "\n"');
    $git_log = shell_exec('git log -n 1 --pretty=format:"%h %s [%an]"');
    $branch = isset($branch) ? $branch : "master";
    $env = isset($env) ? $env : "dev";
    $path = "/usr/www/users/cityfc/{$env}/";
    $current_dir = "/usr/www/users/cityfc/dev/current/";
    $release_dir = $path . 'releases/' . $date . '/';
    $shared_dir = $path . 'shared/';
    $repo = 'git@github.com:username/XXX.git';
@endsetup

@task('update_phar_files', ['on' => ['local'], 'parallel' => true])
    # WP-CLI
    curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar

    # Composer
    curl -sS https://getcomposer.org/installer | php -d allow_url_fopen=On;
@endtask


@macro('deploy')
    git
    create_release
    cleanup
@endmacro

@task('create_release', ['on' => ['live'], 'parallel' => true])
    cd {{ $path }}releases;

    # Create Release
    cp -rf {{ $path }}shared/repository/ {{ $release_dir }};
    rm -rf {{ $release_dir }}.git/;
    rm -rf {{ $release_dir }}.gitignore;

    # Add Symlinks
    ln -sfn {{ $release_dir }}public/content/ {{ $shared_dir }}content;
    ln -s {{ $shared_dir }}uploads/ {{ $release_dir }}public/content/uploads;
    ln -s {{ $shared_dir }}storage/ {{ $release_dir }}storage;
    ln -s {{ $shared_dir }}public.htaccess {{ $release_dir }}public/.htaccess;
    ln -s {{ $shared_dir }}wp-config.php {{ $release_dir }}public/wp-config.php;

    # Composer
    cd {{ $release_dir }} && curl -sS https://getcomposer.org/installer | php -d allow_url_fopen=On;
    cd {{ $release_dir }} && php -d allow_url_fopen=On composer.phar install --no-interaction;

    # Change Symlink Pointer To The New Release
    ln -sfn {{ $release_dir }} {{ $path }}current;
@endtask

@task('git', ['on' => ['live'], 'parallel' => true])
    cd {{ $path }}shared/repository/;
    git fetch;
    git reset --hard origin/{{ $branch }};
    git submodule update;
@endtask

@task('cleanup')
    cd {{ $path }}releases;
    # find . -maxdepth 1 -name "2*" -mmin +2880 | head -n 5 | xargs rm -Rf;
    ls -dt */ | tail -n +4 | xargs rm -rf;
    echo "Cleaned up old deploments";
@endtask

@task('refresh_images', ['on' => ['local'], 'parallel' => true])
    echo "Starting rsync to local";
    rsync -rc --delete -e "ssh -p 22" user@dev.domain.com:{{ $current_dir}}public/content/uploads public/content;
    echo "Rsync to local was successfully!";
@endtask

@after
    @slack('URL', '#channel', "'$task'-Task ran by $username - Last commit: $git_log", ['icon_emoji'=>':octocat:', 'username'=>'Envoy']);
@endafter