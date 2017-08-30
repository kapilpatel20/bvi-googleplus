<?php

namespace GplusBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gplus_info")
 */
class Gmail
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
    
    
    /**
     * @ORM\OneToOne(targetEntity="GplusBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
     
    protected $userId;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="google_email", type="string", nullable=true)
	*/
    protected $googleEmail;
    
    /**
     *
     * @ORM\Column(name="verified_email", type="boolean" ,nullable=false, options={"default":false})
	*/
    protected $verifiedEmail;
   
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
	*/
    protected $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="given_name", type="string", nullable=true)
	*/
    protected $givenName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="family_name", type="string", nullable=true)
	*/
    protected $familyName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", nullable=true)
	*/
    protected $picture;
    
    /**
     * @var string
     *
     * @ORM\Column(name="locale", type="string", length=10, nullable=true)
	*/
    protected $locale;
   
     /**
     * @var string
     *
     * @ORM\Column(name="domain", type="string", nullable=true)
	*/
    protected $domain;



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set gmailId
     *
     * @param string $gmailId
     *
     * @return Gmail
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

    /**
     * Set googleEmail
     *
     * @param string $googleEmail
     *
     * @return Gmail
     */
    public function setGoogleEmail($googleEmail)
    {
        $this->googleEmail = $googleEmail;

        return $this;
    }

    /**
     * Get googleEmail
     *
     * @return string
     */
    public function getGoogleEmail()
    {
        return $this->googleEmail;
    }

    /**
     * Set verifiedEmail
     *
     * @param boolean $verifiedEmail
     *
     * @return Gmail
     */
    public function setVerifiedEmail($verifiedEmail)
    {
        $this->verifiedEmail = $verifiedEmail;

        return $this;
    }

    /**
     * Get verifiedEmail
     *
     * @return boolean
     */
    public function getVerifiedEmail()
    {
        return $this->verifiedEmail;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Gmail
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set givenName
     *
     * @param string $givenName
     *
     * @return Gmail
     */
    public function setGivenName($givenName)
    {
        $this->givenName = $givenName;

        return $this;
    }

    /**
     * Get givenName
     *
     * @return string
     */
    public function getGivenName()
    {
        return $this->givenName;
    }

    /**
     * Set familyName
     *
     * @param string $familyName
     *
     * @return Gmail
     */
    public function setFamilyName($familyName)
    {
        $this->familyName = $familyName;

        return $this;
    }

    /**
     * Get familyName
     *
     * @return string
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Gmail
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set locale
     *
     * @param string $locale
     *
     * @return Gmail
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;

        return $this;
    }

    /**
     * Get locale
     *
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Gmail
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set userId
     *
     * @param \GplusBundle\Entity\User $userId
     *
     * @return Gmail
     */
    public function setUserId(\GplusBundle\Entity\User $userId = null)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \GplusBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->userId;
    }
}
