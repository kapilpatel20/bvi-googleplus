*******Documentation********

Step1 : create google plus client id  from https://console.developers.google.com/apis/credentials

 ###  Step2 : Run below command to install from composer

composer require kapilpatel20/bvi-googleplus dev-master

Add bundle in AppKernel.php in registerBundles function

new GplusBundle\GplusBundle(),

### Step3 : General Settings
app/config/config.yml

```yaml
 parameters:
    google_client_id       : YOUR_GOOGLE_CLIENT_ID
    google_client_secret   : YOUR_GOOGLE_SECERT
    google_client_domain   : YOUR_DOMAIN_PATH
    google_client_redirect : REDIRECT_URI
    google_client_after_login_redirect : REDIRECT_URI_POST_LOGIN

in Global Settings param
twig:
     globals:
         google_url: 'https://accounts.google.com/o/oauth2/auth?redirect_uri=%google_client_domain%%google_client_redirect%&response_type=code&client_id=%google_client_id%&scope=https://www.googleapis.com/auth/plus.login+https://www.googleapis.com/auth/userinfo.email&access_type=offline'

 php app/console doctrine:schema:update --force

```

### Step4: Add Google plus button in html twig file


```jinja
<a href="{{ google_url }}">Connect with Google</a>
```