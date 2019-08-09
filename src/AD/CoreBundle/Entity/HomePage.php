<?php

namespace AD\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * HomePage
 *
 * @ORM\Table(name="ad_home_page")
 * @ORM\Entity(repositoryClass="AD\CoreBundle\Repository\HomePageRepository")
 * @Vich\Uploadable
 */
class HomePage
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
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="enabled", type="boolean")
     */
    private $enabled;

    /**
     * @var string
     *
     * @ORM\Column(name="main_text_fr", type="text")
     */
    private $mainTextFr;
    
    /**
     * @var string
     *
     * @ORM\Column(name="main_text_en", type="text")
     */
    private $mainTextEn;
    
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $mainImage;
    
    /**
     * @Vich\UploadableField(mapping="home_images", fileNameProperty="mainImage")
     * @var File
     */
    private $mainImageFile;
    
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $secondaryImage;
    
    /**
     * @Vich\UploadableField(mapping="home_images", fileNameProperty="secondaryImage")
     * @var File
     */
    private $secondaryImageFile;


    public function __construct(){
    	$this->updatedAt = new \Datetime("now");
    	$this->enabled = false;
    }
    
    public function setMainImageFile(File $image = null)
    {
    	$this->mainImageFile = $image;
    	
    	// VERY IMPORTANT:
    	// It is required that at least one field changes if you are using Doctrine,
    	// otherwise the event listeners won't be called and the file is lost
    	if ($image) {
    		// if 'updatedAt' is not defined in your entity, use another property
    		$this->updatedAt = new \Datetime('now');
    	}
    }
    
    public function getMainImageFile()
    {
    	return $this->mainImageFile;
    }
    
    public function setMainImage($image)
    {
    	$this->mainImage = $image;
    }
    
    public function getMainImage()
    {
    	return $this->mainImage;
    }
    
    
    
    
    
    
    
    public function setSecondaryImageFile(File $image = null)
    {
    	$this->secondaryImageFile = $image;
    	
    	// VERY IMPORTANT:
    	// It is required that at least one field changes if you are using Doctrine,
    	// otherwise the event listeners won't be called and the file is lost
    	if ($image) {
    		// if 'updatedAt' is not defined in your entity, use another property
    		$this->updatedAt = new \Datetime('now');
    	}
    }
    
    public function getSecondaryImageFile()
    {
    	return $this->secondaryImageFile;
    }
    
    public function setSecondaryImage($image)
    {
    	$this->secondaryImage = $image;
    }
    
    public function getSecondaryImage()
    {
    	return $this->secondaryImage;
    }
    
    
    
    
    
    
    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return HomePage
     */
    public function setUpdatedAt($updatedAt)
    {
    	$this->updatedAt = $updatedAt;
    	
    	return $this;
    }
    
    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
    	return $this->updatedAt;
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
     * Set mainTextFr.
     *
     * @param string $mainTextFr
     *
     * @return HomePage
     */
    public function setMainTextFr($mainTextFr)
    {
        $this->mainTextFr = $mainTextFr;

        return $this;
    }

    /**
     * Get mainTextFr.
     *
     * @return string
     */
    public function getMainTextFr()
    {
        return $this->mainTextFr;
    }
    
    
    
    
    /**
     * Set mainTextEn.
     *
     * @param string $mainTextEn
     *
     * @return HomePage
     */
    public function setMainTextEn($mainTextEn)
    {
    	$this->mainTextEn = $mainTextEn;
    	
    	return $this;
    }
    
    /**
     * Get mainTextEn.
     *
     * @return string
     */
    public function getMainTextEn()
    {
    	return $this->mainTextEn;
    }
    
    /**
     * Set enabled
     *
     * @param boolean $enabled
     *
     * @return HomePage
     */
    public function setEnabled($enabled)
    {
    	$this->enabled = $enabled;
    	
    	return $this;
    }
    
    /**
     * Get enabled
     *
     * @return boolean
     */
    public function getEnabled()
    {
    	return $this->enabled;
    }
    
    public function getMainText($locale){
    	switch ($locale){
    		case "fr":
    			return $this->getMainTextFr();
    		case "en":
    			return $this->getMainTextEn();
    		default:
    			return $this->getMainTextFr();
    	}
    }
}
