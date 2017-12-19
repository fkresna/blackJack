class honeyfund2::phpmyadmin {

  package { 'phpmyadmin':
    ensure => 'present',
    # install_options => '--ignore-depends'
    require => Package['php7.1-fpm']
  }

  # Add mysql host
  file { 'phpmyadmin-config':
    path => '/etc/phpmyadmin/config.inc.php',
    ensure => file,
    audit => 'content',
    require => Package['phpmyadmin'],
    source => 'puppet:///modules/honeyfund2/etc/phpmyadmin/config.inc.php',
  }

  # Add mysql host
  file { 'phpmyadmin-config-db':
    path => '/etc/phpmyadmin/config-db.php',
    ensure => file,
    audit => 'content',
    require => Package['phpmyadmin'],
    source => 'puppet:///modules/honeyfund2/etc/phpmyadmin/config-db.php',
  }

  # Add a host template
  file { 'phpmyadmin-nginx':
    path => '/etc/nginx/sites-available/phpmyadmin.conf',
    ensure => file,
    audit => 'content',
    require => Package['nginx'],
    notify => Service['nginx'],
    source => 'puppet:///modules/honeyfund2/etc/nginx/sites-available/phpmyadmin.conf',
  }

  # Symlink our vhost in sites-enabled to enable it
  file { 'phpmyadmin-nginx-enable':
    path => '/etc/nginx/sites-enabled/phpmyadmin.conf',
    target => '/etc/nginx/sites-available/phpmyadmin.conf',
    ensure => link,
    notify => Service['nginx'],
    require => [
      File['phpmyadmin-nginx'],
    ]
  }

  # Disable Apache from starting up
  # exec { 'systemd-sysv-install disable apache2':
  #   path    => ['/bin:/usr/bin:/lib/systemd'],
  #   require => Package['phpmyadmin']
  # }

  # Make sure that the apache2 service is NOT running
  # service { 'apache2':
  #   ensure => stopped,
  #   require => Package['phpmyadmin']
  # }

  
}