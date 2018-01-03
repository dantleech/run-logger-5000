<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class RouteController extends Controller
{
    /**
     * @Route("/routes")
     */
    public function list(Request $request)
    {
        return new Response('Hello World');
    }
}
