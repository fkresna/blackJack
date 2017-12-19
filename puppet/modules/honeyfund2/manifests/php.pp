
class honeyfund2::php {

  apt::ppa { 'ppa:ondrej/php':
    notify => Class['apt::update']
  }->package { [
      'php7.1-cli',
      'php-common',
      'php7.1-bcmath',
      'php7.1-common',
      'php7.1-curl',
      'php7.1-dev',
      'php7.1-fpm',
      'php7.1-gmp',
      'php7.1-mbstring',
      'php7.1-mysql',
      'php7.1-xml',
      'php-gmagick',
      'php-mongodb',
      'php-redis',
      'php-xdebug',
      'composer'
    ]:
    ensure => 'present',
    require => Class['apt::update']
  }

  # Add php.ini for fpm
  file { 'fpm-php-ini':
    path => '/etc/php/7.1/fpm/php.ini',
    ensure => file,
    audit => 'content',
    require => Package['php7.1-fpm'],
    source => 'puppet:///modules/honeyfund2/etc/php/7.1/fpm/php.ini',
    notify => Service['php7.1-fpm']
  }

  # Add www.conf for fpm
  file { 'php-fpm-wwww.conf':
    path => '/etc/php/7.1/fpm/pool.d/www.conf',
    ensure => file,
    audit => 'content',
    require => Package['php7.1-fpm'],
    source => 'puppet:///modules/honeyfund2/etc/php/7.1/fpm/pool.d/www.conf',
    notify => Service['php7.1-fpm']
  }

  # Add xdebug.ini
  file { 'xdebug.ini':
    path => '/etc/php/7.1/mods-available/xdebug.ini',
    ensure => file,
    audit => 'content',
    require => Package['php-xdebug'],
    source => 'puppet:///modules/honeyfund2/etc/php/7.1/mods-available/xdebug.ini',
    notify => Service['php7.1-fpm']
  }

  # Create a log directory
  file { '/var/log/php':
    ensure => 'directory',
    owner => 'www-data',
    group => 'www-data',
    mode => 2775
  }

  # Start the service
  service{'php7.1-fpm':
    ensure => running,
    require => [ Package['php7.1-fpm'], File['/var/log/php'] ]
  }

}