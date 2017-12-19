class honeyfund2::nginx {

  package { 'nginx':
    ensure => 'present'
  }

  # Add a host template
  file { 'vagrant-nginx':
    path => '/etc/nginx/sites-available/test-php_honeyfund_com.conf',
    ensure => file,
    audit => 'content',
    require => Package['nginx'],
    notify => Service['nginx'],
    source => 'puppet:///modules/honeyfund2/etc/nginx/sites-available/test-php_honeyfund_com.conf',
  }

  # Disable the default nginx vhost
  file { 'default-nginx-disable':
    path => '/etc/nginx/sites-enabled/default',
    ensure => absent,
    require => Package['nginx'],
  }

  # Symlink our vhost in sites-enabled to enable it
  file { 'vagrant-nginx-enable':
    path => '/etc/nginx/sites-enabled/test-php_honeyfund_com.conf',
    target => '/etc/nginx/sites-available/test-php_honeyfund_com.conf',
    ensure => link,
    notify => Service['nginx'],
    require => [
      File['vagrant-nginx'],
      File['default-nginx-disable']
    ]
  }

  # Make sure that the nginx service is running
  service { 'nginx':
    ensure => running,
    require => Package['nginx']
  }



}