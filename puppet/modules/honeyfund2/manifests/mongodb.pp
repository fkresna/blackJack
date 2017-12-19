class honeyfund2::mongodb {

    exec { "mongodb-key":
      command => "apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv 0C49F3730359A14518585931BC711F9BA15703C6",
      unless  => 'apt-key  list  | grep "MongoDB 3.4"',
      path    => "/usr/bin:/bin",
      user    => "root",
    }

    exec { "mongodb-sources":
      command =>
        'echo "deb [ arch=amd64,arm64 ] http://repo.mongodb.org/apt/ubuntu xenial/mongodb-org/3.4 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.4.list'
      ,
      creates => '/etc/apt/sources.list.d/mongodb-org-3.4.list',
      path    => "/usr/bin:/bin",
      user    => "root",
      require => Exec["mongodb-key"],
      notify  => Class['apt::update']
    }

    package { [
      'mongodb-org',
    ]:
      ensure  => 'present',
      require => Exec['mongodb-sources']
    }

    # Add mongod.conf
    file { 'mongod.conf':
      path   => '/etc/mongod.conf',
      ensure => file,
      audit  => 'content',
      source => 'puppet:///modules/honeyfund2/etc/mongod.conf',
      notify => Service['mongod']
    }

    # Start the service
    service { 'mongod':
      ensure  => running,
      require => [ Package['mongodb-org'], File['mongod.conf'] ]
    }

}