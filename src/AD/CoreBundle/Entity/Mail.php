<?php

namespace AD\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mail
 *
 * @ORM\Table(name="mail")
 * @ORM\Entity(repositoryClass="AD\CoreBundle\Repository\MailRepository")
 */
class Mail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;
    
    /**
     * @var string|null
     *
     * @ORM\Column(name="object", type="string", length=255, nullable=true)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="body", type="text")
     */
    private $body;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var bool
     *
     * @ORM\Column(name="opened", type="boolean")
     */
    private $opened;

    
    public function __construct(){
    	$this->opened = false;
    	$this->date = new \Datetime("now");
    }
    

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set object.
     *
     * @param string|null $object
     *
     * @return Mail
     */
    public function setObject($object = null)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object.
     *
     * @return string|null
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return Mail
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Mail
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return Mail
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set opened.
     *
     * @param bool $opened
     *
     * @return Mail
     */
    public function setOpened($opened)
    {
        $this->opened = $opened;

        return $this;
    }

    /**
     * Get opened.
     *
     * @return bool
     */
    public function getOpened()
    {
        return $this->opened;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Mail
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Mail
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
