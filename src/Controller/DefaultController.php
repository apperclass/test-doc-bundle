<?php

namespace Apperclass\TestDocBundle\Controller;

use Apperclass\TestDocBundle\Entity\Test;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class DefaultController
 *
 * @package Apperclass\TestDocBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {

        $testRepository = $this->getDoctrine()->getManager()->getRepository(Test::CLASS_NAME);
        $tests = $testRepository->getAll();

        return $this->render('ApperclassTestDocBundle:Default:index.html.twig', array('tests' => $tests));
    }
}
