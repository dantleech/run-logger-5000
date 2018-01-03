<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Route;
use Symfony\Component\Routing\Annotation\Route as R;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Run;
use App\Form\LogRunType;

class RunController extends Controller
{
    /**
     * @R("/routes/{id}/runs/log", name="log_run")
     * @ParamConverter("route", class="App\Entity\Route")
     */
    public function logRun(Request $request, Route $route)
    {
        $form = $this->createForm(LogRunType::class);

        if ($form->handleRequest($request) && $form->isSubmitted() && $form->isValid()) {
            $run = $form->getData();
            $run->setRoute($route);
            $this->getDoctrine()->getManager()->persist($run);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('route_view', [
                'id' => $route->getId()
            ]);
        }

        return $this->render('run/log_run.html.twig', [
            'route' => $route,
            'form' => $form->createView(),
        ]);
    }
}
