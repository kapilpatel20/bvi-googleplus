<?php
namespace GplusBundle\Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use GplusBundle\Entity\Gmail;
use GplusBundle\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface as Encoder;

class CreateUser 
{
    
    private $container;
    

    public function __construct(Container $container) {
        $this->container = $container;
    }

    public function manageUser(Request $request) {
        
        $client_id = $this->container->getParameter('google_client_id');
        $client_secret = $this->container->getParameter('google_client_secret');
        $client_domain = $this->container->getParameter('google_client_domain');
        $url = $this->container->get('router')->generate('gplus_homepage');
    
        $em = $this->container->get('doctrine')->getEntityManager();
        $gClient = new \Google_Client(array('client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $client_domain . $url));
       
        $user = $this->container->get('security.context')->getToken()->getUser();


        $httpClient = $gClient->authorize();
        $token = $gClient->fetchAccessTokenWithAuthCode($request->query->get('code'));
        
        if (isset($token['access_token'])) {
            $url = 'https://www.googleapis.com/oauth2/v1/userinfo?alt=json';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url . '&access_token=' . $token['access_token']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, '20');
            $result = curl_exec($ch);

            $userinfo = json_decode($result);

            if (!is_object($user)) {
                // check for email exist or not
                $user = $em->getRepository('GplusBundle:User')->findOneBy(array('email' => $userinfo->email));
                if (!$user) {

                    // generate password
                     $plainPassword = $userinfo->id;
                     $user1 = new \GplusBundle\Entity\User();
                    $encoded = $this->container->get("security.password_encoder")->encodePassword($user1, $plainPassword);
                    // Insert data in fos_user table
                    $objUser = new User();
                    $objUser->setUsername($userinfo->id)
                            ->setUsernameCanonical($userinfo->id)
                            ->setEmail($userinfo->email)
                            ->setEmailCanonical($userinfo->email)
                            ->setEnabled(1)
                            ->setLastLogin(new \DateTime())
                            ->setLocked(0)
                            ->setExpired(0)
                            ->setConfirmationToken(NULL)
                            ->setPasswordRequestedAt(NULL)
                            ->addRole("ROLE_USER")
                            ->setCredentialsExpired(0)
                            ->setPassword($encoded);
                    $em->persist($objUser);
                    $em->flush();
                    $token = new UsernamePasswordToken($objUser, $objUser->getPassword(), 'main', $objUser->getRoles());
                    $context =  $this->container->get('security.context');
                    $context->setToken($token);
                } else {
                    $token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());
                    $context = $this->container->get('security.context');
                    $context->setToken($token);
                }
            }
            $user = $this->container->get('security.context')->getToken()->getUser();

            if (is_object($user)) {
                $user->setGmailId($userinfo->id);
            }
            $em->persist($user);
            $em->flush();

            // get data to gmail
           $objGmail = $em->getRepository('GplusBundle:Gmail')->findOneBy(array('userId' => $user->getId()));
           if (!$objGmail) {
                $objGmail = new Gmail();
           }
            $objGmail->setUserId($user)
                    ->setGmailId($userinfo->id)
                    ->setGoogleEmail($userinfo->email)
                    ->setVerifiedEmail($userinfo->verified_email)
                    ->setName($userinfo->name)
                    ->setGivenName($userinfo->given_name)
                    ->setFamilyName($userinfo->family_name)
                    ->setPicture($userinfo->picture)
                    ->setLocale($userinfo->locale);
            if (isset($userinfo->hd)) {
                $objGmail->setDomain($userinfo->hd);
            } else {
                $objGmail->setDomain('gmail');
            }
            $em->persist($objGmail);
            $em->flush();
        }
        
        return true;
    }

}