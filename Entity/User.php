<?php

namespace GplusBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
  
     /**
     * @var string
     *
     * @ORM\Column(name="gmail_id", type="string", nullable=true)
     */
    protected $gmail_id;
    
    
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

   

    /**
     * Set gmailId
     *
     * @param string $gmailId
     *
     * @return User
     */
    public function setGmailId($gmailId)
    {
        $this->gmail_id = $gmailId;

        return $this;
    }

    /**
     * Get gmailId
     *
     * @return string
     */
    public function getGmailId()
    {
        return $this->gmail_id;
    }
}
