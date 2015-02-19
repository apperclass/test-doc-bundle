<?php

namespace Apperclass\TestDocBundle\Listener;

use Apperclass\TestDocBundle\Entity\Test;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\FinishRequestEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Profiler\Profiler;

/**
 * Class TestDocListener
 *
 * @package Apperclass\TestDocBundle\Listener
 */
class TestDocListener
{

    protected $entityManager;
    protected $environment;
    protected $profiler;

    /**
     * @param EntityManager $entityManager
     * @param string        $environment
     * @param Profiler      $profiler
     */
    public function __construct(EntityManager $entityManager, $environment, $profiler)
    {
        $this->entityManager = $entityManager;
        $this->environment = $environment;
        $this->profiler = $profiler;
    }

    /**
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($this->environment!=='test') {
            return;
        }

        if ($event->getRequestType() !== HttpKernelInterface::MASTER_REQUEST) {
            return;
        }

        $request = $event->getRequest();
        $response = $event->getResponse();

        $test = new Test();
        $test->setRequestBody($request->getContent());
        $test->setMethod($request->getMethod());
        $test->setUrl($request->getRequestUri());
        $test->setRequestHeader(json_encode($request->headers->all()));
        $test->setResponseBody($response->getContent());
        $test->setStatusCode($response->getStatusCode());
        $test->setResponseHeader(json_encode($response->headers->all()));
        $profile = array(
            'queryCount' => $this->profiler->get('db')->getQueryCount(),
            'queryTime' => $this->profiler->get('db')->getTime(),
            'memory' => $this->profiler->get('memory')->getMemory()
        );
        $test->setProfile(json_encode($profile));

        $testRepository = $this->entityManager->getRepository(Test::SHORTCUT_CLASS_NAME);
        $oldTest = $testRepository->findOneBy(array('url'=> $test->getUrl()));
        if ($oldTest) {
            $test->setId($oldTest->getId());
            $this->entityManager->merge($test);
        } else {
            $this->entityManager->persist($test);
        }

        $this->entityManager->flush();
    }
}