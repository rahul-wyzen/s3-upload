<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $data = new \AppBundle\Entity\Image;
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder($data)
                ->add('imageFile', 'file')
                ->add('imageName', 'text')
                ->add('submit', 'submit')
                ->getForm();
        $form->handleRequest($request);
        if($form->isValid()) {
            $time = time();
            $em->persist($data);
            $em->flush();
            $time = (time() - $time);
            print_r("Time Taken: ". $time.'sec');
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
            'form' => $form->createView(),
        ));
    }
}
