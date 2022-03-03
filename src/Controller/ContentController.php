<?php 

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ContentController extends AbstractController
{
    #[Route('/content', name: 'content')]
    public function cgv(): Response
    {
        return $this->render('content/cgv.html.twig', [
            
            
            'title'=>'conditions générales de vente'
        ]);

    }
}

?>