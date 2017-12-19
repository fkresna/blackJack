class honeyfund2::users {

  # create a group with a specific GID.
  group { "hfdev":
    gid    => 10001,
  }

  #
  # hgdeploy
  #

  user { "hfdeploy":
    uid => 9002,
    groups => ['hfdev','www-data']
  }

  #
  # mikep
  #

  group { "mikep":
    gid    => 9001,
  }

  user { "mikep":
    uid => 9001,
    gid => 9001,
    groups => ["hfdev", "sudo"],
    ensure => "present",
    shell => "/bin/bash",
    managehome => true,
    password => '$6$Cuz4H4lE$nYwt7pa7NrTK97X6y4iuc8jg0kWlOewE34382inuxm7wVAtpv4vFO2tOZ9kpg99lnUWiISbS7W8N5uoeaUOb3/',
    require => [ Group['hfdev'] ]

  }

  ssh_authorized_key { 'mike@honeyfund.com':
    user => 'mikep',
    type => 'ssh-rsa',
    key  => 'AAAAB3NzaC1yc2EAAAADAQABAAABAQDKpt241H1+hxgiYe2y+BC5/3sSLm6L/uUw/IWL3N2sfa/xuBySQc3/a4LwOvZNnAsQBQF3+/HkOxoDJxoTqzUE9fljiNuB5sMOe+k3RcutLjNGPF5RvN7KCB/gAqz1tSIl2PrBtkF53bIherPCWtp3DuEMc4vetdBe3p4cDKZUMNbIqYXWHdbx0+8cgcZRjolvyziwNU6v2ZUQWnJK/Hu4eKxgDKnxHs1u7HQA8fiNcXlqffr985HW1q1CxE6rF3HUZG9+sWBSHLkZwTYtIyn9DUt2kb0fKWanSeKgfXqkUVIrqKcRuYO+RSsbCGg5JcmXPt6wbarYpLM+m0yXBmvf',
    require => User['mikep']
  }


  #
  # vagrant
  #

  #file { '.my.cnf':
  # owner => 'vagrant',
  #  group => 'vagrant',
  #  audit => 'content',
  #  mode => 640,
  #  path => '/home/vagrant/.my.cnf',
  #  ensure => file,
  #  source => 'puppet:///modules/honeyfund2/home/vagrant/.my.cnf'
  # }

  #file { 'hg_vagrant_key':
  #  owner => 'vagrant',
  #  group => 'vagrant',
  #  audit => 'content',
  #  mode => 600,
  #  path => '/home/vagrant/.ssh/hg_vagrant',
  #  ensure => file,
  #  source => 'puppet:///modules/honeyfund2/home/vagrant/.ssh/hg_vagrant'
  #}

  # file { 'db_refesh_from_gi.sh':
  #  owner => 'vagrant',
  #  group => 'vagrant',
  #  audit => 'content',
  #  mode => 750,
  #  path => '/home/vagrant/db_refresh_from_gi.sh',
  #  ensure => file,
  #  source => 'puppet:///modules/honeyfund2/home/vagrant/db_refresh_from_gi.sh'
  # }

  #
  # root
  #

  # Copy over root user files
  file { 'prep-box.sh':
   owner => 'root',
   group => 'root',
   audit => 'content',
   mode => 755,
   path => '/root/prep-box.sh',
   ensure => file,
   source => 'puppet:///modules/honeyfund2/root/prep-box.sh'
  }


}