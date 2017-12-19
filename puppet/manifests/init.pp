#

package { [
  'lynx',
  'wget',
  'git',
  'zip',
  'build-essential'
  ]:
  ensure => present
}


file { '/var/www/test-php.honeyfund.com':
  ensure => 'directory'
}


host { 'hf2-dev.honeyfund.com':
  ip => '192.168.56.56'
}


class { 'apt':
  update => {
    frequency => 'daily',
  },
}


class { 'honeyfund2':
  require => Class['apt::update']
}
