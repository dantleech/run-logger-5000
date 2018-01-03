<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as R;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Route;
use App\Form\RouteType;

class RouteController extends Controller
{
    /**
     * @R("/routes", name="route_list")
     */
    public function list(Request $request)
    {
        $routes = $this->get('doctrine')->getRepository(Route::class)->findAll();

        return $this->render('routes/list.html.twig', [
            'routes' => $routes,
        ]);
    }

    /**
     * @R("/routes/add", name="route_add")
     */
    public function add(Request $request)
    {
        $form = $this->createForm(RouteType::class);

        if ($form->handleRequest($request) && $form->isValid()) {
            $this->get('doctrine')->getManager()->persist($form->getData());
            $this->get('doctrine')->getManager()->flush();

            return $this->redirectToRoute('route_list');
        }

        return $this->render('routes/add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @R("/routes/{id}/view", name="route_view")
     */
    public function view(Request $request)
    {
        $routeId = $request->attributes->get('id');

        $route = $this->get('doctrine')
            ->getRepository(Route::class)
            ->find($routeId);

        if (null === $route) {
            throw new NotFoundHttpException(sprintf(
                'Could not find route with ID "%s"',
                $routeId
            ));
        }

        return $this->render('routes/view.html.twig', [
            'route' => $route
        ]);
    }
}
