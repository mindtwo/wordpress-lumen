@servers([
    'local' => 'vagrant@domain.com'
    'dev' => 'user@dev.domain.com'
    'live' => 'user@domain.com'
])

@task('deploy_live', ['on' => ['dev']])

@endtask

@task('deploy_live', ['on' => ['live']])

@endtask