# vagrant/puppet/modules/node/manifests/init.pp

class honeyfund2::nodejs{

  # Install the npm package. This relies on apt-get update
  package { [
      'npm',
      'nodejs'
    ]:
    ensure => 'present',
  }

  # Fix node
  file { 'nodeln':
    path => '/usr/bin/node',
    target => '/usr/bin/nodejs',
    ensure => link,
    require => [
      Package['nodejs']
    ]
  }

  # Install Gulp globally
  exec { 'npm install gulp -g':
    creates => '/usr/local/bin/gulp',
    path    => ['/usr/bin'],
    require => Package['npm']
  }

  # Install Bower globally
  exec { 'npm install bower -g':
    creates => '/usr/local/bin/bower',
    path    => ['/usr/bin'],
    require => Package['npm']
  }


}
