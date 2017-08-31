*******Documentation********

 ###  Step1 : create google plus client id  from https://console.developers.google.com/apis/credentials

 ###  Step2 : Run below command to install from composer

```php

composer require kapilpatel20/bvi-googleplus dev-master

```

Add bundle in AppKernel.php in registerBundles function

```php


new FOS\UserBundle\FOSUserBundle(),
new GplusBundle\GplusBundle(),

```

### Step3 : General Settings
3.1 app/config/config.yml

```yaml

imports:
    - { resource: '@GplusBundle/Resources/config/services.yml' }

parameters:
    google_client_id       : YOUR_GOOGLE_CLIENT_ID
    google_client_secret   : YOUR_GOOGLE_SECERT
    google_client_domain   : YOUR_DOMAIN_PATH
    google_client_redirect : REDIRECT_URI/gplus/
    google_client_after_login_redirect : REDIRECT_URI_POST_LOGIN

fos_user:
    db_driver: orm # other valid values are 'mongodb' and 'couchdb'
    firewall_name: main
    user_class: GplusBundle\Entity\User

in Global Settings param

twig:
     globals:
         google_url: 'https://accounts.google.com/o/oauth2/auth?redirect_uri=%google_client_domain%%google_client_redirect%&response_type=code&client_id=%google_client_id%&scope=https://www.googleapis.com/auth/plus.login+https://www.googleapis.com/auth/userinfo.email&access_type=offline'

```
3.2 app/config/security.yml

```yaml

security:
	
	encoders:
        FOS\UserBundle\Model\UserInterface: bcrypt
    
    providers:
        chain_provider:
            chain:
                providers: [fos_userbundle]
        fos_userbundle:
            id: fos_user.user_provider.username_email

```
3.3 app/config/routing.yml

```yml

gplus:
    resource: "@GplusBundle/Resources/config/routing.yml"
    prefix:   /gplus/

```

### Step4: Add Google plus button in html twig file


```jinja

<a href="{{ google_url }}">Connect with Google</a>

```

### Step5: Generate tables with following command 

```php

php app/console doctrine:schema:update --force

```