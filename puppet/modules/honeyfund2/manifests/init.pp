class honeyfund2 {
  include honeyfund2::apparmor
  include honeyfund2::kernel
  # include honeyfund2::users
  include honeyfund2::php
  include honeyfund2::nginx
  include honeyfund2::mysql
  # include honeyfund2::redis
  include honeyfund2::nodejs
  # include honeyfund2::mongodb
  include honeyfund2::phpmyadmin
  include honeyfund2::ntp
  # include honeyfund2::maxmind

}
