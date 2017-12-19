class honeyfund2::ntp {

  package { [
    'ntp',
    'ntpstat',
    'ntpdate',
    'fake-hwclock'
  ]:
    ensure => 'present'
  }

  # Add ntp.comf
  file { 'timezone':
    path => '/etc/timezone',
    ensure => file,
    audit => 'content',
    notify => Service['ntp'],
    source => 'puppet:///modules/honeyfund2/etc/timezone',
  }

  # Add ntp.comf
  file { 'ntp.conf':
    path => '/etc/ntp.conf',
    ensure => file,
    audit => 'content',
    require => Package['ntp'],
    notify => Service['ntp'],
    source => 'puppet:///modules/honeyfund2/etc/ntp.conf',
  }

  # Make sure that the nginx service is running
  service { 'ntp':
    ensure => running,
    require => Package['ntp']
  }

  # Update the time
  # exec { 'ntp-update-time':
  #   command => 'ntpd -gq',
  #   path    => ['/usr/bin:/usr/sbin'],
  #   user    => 'root',
  #   require => Package['ntp']
  # }

}