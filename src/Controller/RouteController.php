<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as R;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Route;

class RouteController extends Controller
{
    /**
     * @R("/routes")
     */
    public function list(Request $request)
    {
        $routes = $this->get('doctrine')->getRepository(Route::class)->findAll();

        return $this->render('routes/list.html.twig', [
            'routes' => $routes,
        ]);
    }
}
