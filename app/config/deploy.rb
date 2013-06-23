set :application,           "benjamin.leveque.me"
set :domain,                "odin.leveque.me"
set :deploy_to,             "/var/www/benjamin.leveque.me"
set :group_writable,        true
set :writable_dirs,         [app_path + "/cache", app_path + "/logs"]
set :webserver_user,        "www-data"
set :permission_method,     :acl
set :use_set_permissions,   true

set :scm_username,          "git"
set :repository,            "git@github.com:benji07/benjamin.leveque.me.git"
set :scm,                   :git
set :user,                  "deployer"
set :deploy_via,            :remote_cache
set :branch,                "develop"
set :scm_verbose,           true

set :shared_files,          [app_path + "/config/parameters.yml"]
set :shared_children,       [app_path + "/logs", web_path + "/uploads", "vendor"]

set :model_manager, "doctrine"

set :use_sudo,              false
set :keep_releases,         3
set :use_composer,          true
set :dump_assetic_assets,   false

role :web,                  domain                         # Your HTTP server, Apache/etc
role :app,                  domain                         # This may be the same as your `Web` server
role :db,                   domain, :primary => true       # This is where Symfony2 migrations will run

default_run_options[:pty]   = true
ssh_options[:forward_agent] = true


#############################################################
# TASKS
#############################################################

after :deploy, 'deploy:cleanup'

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL
