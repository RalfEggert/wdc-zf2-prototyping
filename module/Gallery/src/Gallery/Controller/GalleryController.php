<?php

namespace Gallery\Controller;

use Gallery\Entity\Gallery;
use Zend\Math\Rand;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class GalleryController extends AbstractActionController
{

    public function indexAction()
    {
        $serviceManager = $this->getServiceLocator();
        $objectManager  = $serviceManager->get('Doctrine\ORM\EntityManager');
        $repository     = $objectManager->getRepository('Gallery\Entity\Gallery');

        $galleryList = $repository->findAll();

        return new ViewModel(
            array(
                'galleryList' => $galleryList,
            )
        );
    }

    public function createAction()
    {
        $serviceManager = $this->getServiceLocator();
        $objectManager  = $serviceManager->get('Doctrine\ORM\EntityManager');
        $formManager    = $serviceManager->get('FormElementManager');
        $request        = $this->getRequest();

        if ($request->isPost()) {
            $postData = $request->getPost()->toArray();
            $fileData = $request->getFiles()->toArray();

            $imageDir = realpath(__DIR__ . '/../../../../../public');

            $gallery = new Gallery();

            if ($fileData['thumburl']['error'] == 0) {
                $thumburl = '/img/gallery/' . $fileData['thumburl']['name'];

                move_uploaded_file($fileData['thumburl']['tmp_name'], $imageDir . $thumburl);

                $gallery->setThumburl($thumburl);
            }

            if ($fileData['bigurl']['error'] == 0) {
                $bigurl   = '/img/gallery/' . $fileData['bigurl'  ]['name'];

                move_uploaded_file($fileData['bigurl'  ]['tmp_name'], $imageDir . $bigurl);

                $gallery->setBigurl($bigurl);
            }

            $title = $postData['title'];

            $gallery->setTitle($title);

            $objectManager->persist($gallery);
            $objectManager->flush();

            return $this->redirect()->toRoute('gallery');
        }

        $galleryForm = $formManager->get('Gallery');

        return new ViewModel(
            array(
                'form' => $galleryForm,
            )
        );
    }

    public function updateAction()
    {
        $id = $this->params()->fromRoute('id');

        $serviceManager = $this->getServiceLocator();
        $objectManager  = $serviceManager->get('Doctrine\ORM\EntityManager');
        $formManager    = $serviceManager->get('FormElementManager');
        $request        = $this->getRequest();

        $gallery = $objectManager->find('Gallery\Entity\Gallery', $id);

        if ($request->isPost()) {
            $postData = $request->getPost()->toArray();
            $fileData = $request->getFiles()->toArray();

            $imageDir = realpath(__DIR__ . '/../../../../../public');

            if ($fileData['thumburl']['error'] == 0) {
                $thumburl = '/img/gallery/' . $fileData['thumburl']['name'];

                move_uploaded_file($fileData['thumburl']['tmp_name'], $imageDir .
                    $thumburl);

                $gallery->setThumburl($thumburl);
            }

            if ($fileData['bigurl']['error'] == 0) {
                $bigurl   = '/img/gallery/' . $fileData['bigurl'  ]['name'];

                move_uploaded_file($fileData['bigurl'  ]['tmp_name'], $imageDir . $bigurl);

                $gallery->setBigurl($bigurl);
            }

            $title = $postData['title'];

            $gallery->setTitle($title);

            $objectManager->flush();

            return $this->redirect()->toRoute('gallery');
        }

        $galleryForm = $formManager->get('Gallery');
        $galleryForm->get('id')->setValue($gallery->getId());
        $galleryForm->get('title')->setValue($gallery->getTitle());

        return new ViewModel(
            array(
                'form' => $galleryForm,
                'gallery' => $gallery,
            )
        );
    }

    public function deleteAction()
    {
        $id = $this->params()->fromRoute('id');

        $serviceManager = $this->getServiceLocator();
        $objectManager  = $serviceManager->get('Doctrine\ORM\EntityManager');

        $gallery = $objectManager->find('Gallery\Entity\Gallery', $id);

        $objectManager->remove($gallery);
        $objectManager->flush();

        return $this->redirect()->toRoute('gallery');
    }

    public function showAction()
    {
        $id = $this->params()->fromRoute('id');

        $serviceManager = $this->getServiceLocator();
        $objectManager  = $serviceManager->get('Doctrine\ORM\EntityManager');

        $gallery = $objectManager->find('Gallery\Entity\Gallery', $id);

        return new ViewModel(
            array(
                'gallery' => $gallery,
            )
        );
    }


}

