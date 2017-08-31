<?php

namespace GplusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $client_id = $this->container->getParameter('google_client_id');
        $client_domain = $this->container->getParameter('google_client_domain');
        $client_redirect = $this->container->getParameter('google_client_redirect');
        $client_afterlogin_redirect = $this->container->getParameter('google_client_after_login_redirect');
        
        $googleUrlDynamic = "https://accounts.google.com/o/oauth2/auth?redirect_uri=".$client_domain.$client_redirect."&response_type=code&client_id=".$client_id."&scope=https://www.googleapis.com/auth/plus.login+https://www.googleapis.com/auth/userinfo.email&access_type=offline";
        
        if ($request->query->get('code')) {
            $messageGenerator = $this->container->get('gplus.create_user');
            $message = $messageGenerator->manageUser($request);
             return $this->redirect($client_domain.$client_afterlogin_redirect);
        }
        return $this->render('GplusBundle:Default:index.html.twig');
    }
}
