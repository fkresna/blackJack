class honeyfund2::kernel {


  # Add rc.local
  file { 'rc.local':
    path => '/etc/rc.local',
    ensure => file,
    mode   => 755,
    owner => 'root',
    group => 'root',
    audit => 'content',
    source => 'puppet:///modules/honeyfund2/etc/rc.local',
  }

  # Add sysctl.conf
  file { 'sysctl.conf':
    path => '/etc/sysctl.conf',
    ensure => file,
    owner => 'root',
    group => 'root',
    mode => 644,
    audit => 'content',
    source => 'puppet:///modules/honeyfund2/etc/sysctl.conf',
  }

  # # Add queue-workers.conf
  # file { 'queue-workers.conf':
  #   path => '/etc/init/queue-workers.conf',
  #   ensure => file,
  #   owner => 'root',
  #   group => 'root',
  #   mode => 644,
  #   audit => 'content',
  #   source => 'puppet:///modules/honeyfund2/etc/init/queue-workers.conf',
  # }

  # Add qworkers.service
  file { 'qworkers.service':
    path => '/lib/systemd/system/qworkers.service',
    ensure => file,
    owner => 'root',
    group => 'root',
    mode => 644,
    audit => 'content',
    source => 'puppet:///modules/honeyfund2/lib/systemd/system/qworkers.service'
  }

}