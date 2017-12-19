
class honeyfund2::maxmind {

  apt::ppa { 'ppa:maxmind/ppa':
    notify => Class['apt::update']
  }->package { [
      'libmaxminddb0',
      'libmaxminddb-dev',
      'mmdb-bin',
      'geoipupdate'
    ]:
    ensure => 'present'
  }

  #copy in /etc/GeoIP.conf
  file { 'GeoIP.conf':
    path => '/etc/GeoIP.conf',
    ensure => file,
    owner => 'root',
    group => 'root',
    audit => 'content',
    source => 'puppet:///modules/honeyfund2/etc/GeoIP.conf',
  }

  # create a symbolic link for Mac dev
  file { '/usr/local/share/GeoIP':
    ensure => link,
    target => '/usr/share/GeoIP',
  }

  # Update the GeoIP DB
  exec { 'geoipupdate':
    command => '/usr/bin/geoipupdate',
    creates => '/usr/share/GeoIP/GeoIP2-City.mmdb',
    path    => ['/usr/bin:/usr/sbin'],
    user    => 'root',
    require => [ Package['geoipupdate'], File['GeoIP.conf'] ]
  }

  #copy maxminddb.ini to /etc/php/7.1/mods-available
  # file { 'maxminddb.ini':
  #   path => '/etc/php/7.1/mods-available/maxminddb.ini',
  #   ensure => file,
  #   audit => 'content',
  #   source => 'puppet:///modules/honeyfund2/etc/php/7.1/mods-available/maxminddb.ini',
  #   require => Package['php7.1-fpm'],
  # }

  # exec { 'maxminddb-ext':
  #   command => '/bin/bash _bin/build_maxminddb_ext.sh',
  #   creates => '/var/www/honeyfund.com/vendor/maxmind-db/reader/ext/modules/maxminddb.so',
  #   cwd     => '/var/www/honeyfund.com',
  #   path    => ['/usr/bin:/usr/sbin'],
  #   user    => 'root',
  #   require => [ Package['geoipupdate'], File['GeoIP.conf'] ],
  #   notify  => Package['php7.1-fpm']
  # }

  # /var/www/honeyfund.com/vendor/maxmind-db/reader/ext
  # phpize
  # ./configure
  # sudo make install
  # phpenmod -v 7.1 maxminddb

}