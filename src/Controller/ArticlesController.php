<?php

namespace App\Controller;

use App\Entity\Brand;

use App\Entity\Articles;
use App\Entity\Catagory;

use App\Form\addArticleType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CallApiService;
use App\Repository\ArticlesRepository;






class ArticlesController extends AbstractController
{
    #[Route('/home', name: 'home_page')]
     public function index(ManagerRegistry $doctrine ): Response
        {   
         $articles_list = $doctrine
         ->getRepository(Articles::class)
            ->findAll();

     /*dd($articles_list );*/
            return $this->render('pages/home.html.twig', [
            'controller_name' => 'ArticlesController',
            'articles_list'=>$articles_list
              ]);
    }

    #[Route('/addArticle', name: 'add_article')]
 public function addArticle(ManagerRegistry $doctrine): Response
 {
 $entityManager = $doctrine->getManager();
 $article = new Articles();
 $article->setTitre('Sneakers homme Air Max Limited 3');
 $article->setImage('//media.intersport.fr/is/image/intersportfr/BV1171_FH3_Q1');
 $entityManager->persist($article);
 $entityManager->flush();
 return new Response('Larticle a été ajoutée'.$article->getTitre());
 }

 
 
/* #[Route('/displayArticle/{id}', name: 'display_article')]
 public function displayArticleDetail(ManagerRegistry $doctrine, $id) : Response
   {
     $article = $doctrine
                 ->getRepository(Articles::Class)
                 ->find($id);

     dd($article );
      }

}*/
 #[Route('/show/{id}', name: 'show')]
   function show (ManagerRegistry $doctrine,$id){
     
     $repo=$doctrine->getRepository(Articles::class);
     $article=$repo->find($id);
    return $this->render('pages/showArticle.html.twig',[
        
        'article'=>$article
    ]);
          }

          #[Route('/home/listing', name: 'listing')]
          public function lister(ManagerRegistry $doctrine ): Response{
             session_start();
             dd($_SESSION);
        $articles_list = $doctrine
        ->getRepository(Articles::class)
        ->findAll();
              
      
           /*dd($articles_list );*/
              return $this->render('bo/ArticlesListing.html.twig',[
                  
                  'articles'=>$articles_list
                  
                   
                   
              ]);
          } 
        //ACCES FORMULAIRE ajout d'un article
  #[Route ('/home/createArticle', name:  'create_article')]
    public function create_Article(Request $request,ManagerRegistry $doctrine,SluggerInterface $slugger):Response{
      $article=new Articles();

      
      $form=$this->createForm(addArticleType::class,$article);
      
     

      /*return $this->render('pages/createArticle.html.twig', [
        'formArticle' => $form->createView(),
    ]);*/
    $form->handleRequest($request);
    if($form->isSubmitted()&& $form->isValid()){
        $data=$form->getData();
        //Traitement de l'image    
            //1. Récpération de l'image
            $pictureFile = $form->get('image')->getData();

            //Verification image non vide
            if ($pictureFile) {
                
                //2. Récupérer le nom du fichier TMP 
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                
                //creer une url de fichier valide
                $safeFilename = $slugger->slug($originalFilename);

                //On créé le nouveau nom du fichier
                $newFilename = $safeFilename.'_'.uniqid().'.'.$pictureFile->guessExtension();
                
                //Copie le fichier temporaire dans notre reprtoire definitif (en le renommant)
                $pictureFile->move(
                    $this->getParameter('picture_directory'),
                    $newFilename
                );
            
                //Ajout de valeur à la priopriété
                $article->setImage($newFilename);
            }
            //Fin traitement image
        
    $em= $doctrine->getManager();
    $em->persist($article);   
    $em->flush();
    return $this->redirectToRoute('listing', [], Response::HTTP_SEE_OTHER);

      
     
     



    }
    return $this->render('bo/createArticle.html.twig',['formArticle'=>$form->createView()

    ]);    
          }

         
          #[Route('/home/brand', name: 'brand')]
          public function brand(ManagerRegistry $doctrine ): Response{
          
              $brands_list = $doctrine
              ->getRepository(Brand::class)
              ->findAll();
      
              return $this->render('pages/articleBrand.html.twig', [
               'brands_list'=>$brands_list
                  
                   
                   
              ]);
          
      
      
           }

     #[Route('/displayDepartement', name: 'display_departement', methods: ['GET'])]
     public function callDepartemant(ArticlesRepository $articlesRepository, CallApiService $callApiService): Response {
        $departements_list = $callApiService->getDepartement();
        
        //dd($aDepartement);
            return $this->render('pages/displayDepartement.html.twig', [
            'departements_list'=>$departements_list
        ]);
    }
      
    #[Route('/{id}/addToCard', name: 'add_toCard', methods: ['GET', 'POST'])]
    public function edit(Request $request, Articles $article, EntityManagerInterface $entityManager): Response
        {
                session_start();
                 $_SESSION['panier'][]=$article;
                return $this->redirectToRoute('listing', [], Response::HTTP_SEE_OTHER);
           

        }
   

    
} 

