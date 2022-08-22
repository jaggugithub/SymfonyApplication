<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EchoController extends AbstractController
{
    const INVALID_JSON = 'the provided json is not valid';

    /**
     * @Route("/echo", methods={"POST"})
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        // Content type is not JSON
        if ($request->getContentType() !== 'json') {
            return $this->json([ 'error' => self::INVALID_JSON], Response::HTTP_BAD_REQUEST);
        }

        try {
            return $this->json(
                json_decode($request->getContent(), flags: JSON_THROW_ON_ERROR),
                Response::HTTP_OK
            );
        } 
        
        catch (\Exception) {
            return $this->json(['error' => self::INVALID_JSON], Response::HTTP_BAD_REQUEST);
        }
    }
}
