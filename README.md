testTask
========

A Symfony project created on August 24, 2018, 11:38 am.


How to install
====

### Step1: Clone the project
```ssh

git clone git@github.com:asimonyan/testTask.git
```

### Step2: Add permission

```ssh
HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1` 

sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache/ && sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/cache/
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/logs/ && sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/logs/
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/sessions/ && sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var/sessions/
```

### Step3: Install bower for frontend dependency
```ssh
bower install
```

### Step4: Update composer for backend dependency
```ssh
composer update
```

### Step5: create database and update schema
```ssh
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
```

### Step6: install assets
```ssh
bin/console assets:install --symlink
```