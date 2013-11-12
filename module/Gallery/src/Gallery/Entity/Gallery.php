<?php
namespace Gallery\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="gallery")
 */
class Gallery{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /** @ORM\Column(type="string") */
    protected $title;

    /** @ORM\Column(type="string") */
    protected $thumburl;

    /** @ORM\Column(type="string") */
    protected $bigurl;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getThumburl()
    {
        return $this->thumburl;
    }

    public function setThumburl($thumburl)
    {
        $this->thumburl = $thumburl;
    }

    public function getBigurl()
    {
        return $this->bigurl;
    }

    public function setBigurl($bigurl)
    {
        $this->bigurl = $bigurl;
    }
}