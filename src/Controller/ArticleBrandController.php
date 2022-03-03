<?php
namespace App\Controller;

use App\Entity\Articles;



use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\addArticleType;
use App\Entity\Brand;
use App\Entity\Catagory;

/*class ArticleBrandController extends AbstractController{
    
   #[Route('/home/brand', name: 'brand')]
    public function index(ManagerRegistry $doctrine ): Response{
    
        $brands_list = $doctrine
        ->getRepository(Brand::class)
        ->findAll();

        return $this->render('pages/articleBrand.html.twig', [
         'brands_list'=>$brands_list
            
             
             
        ]);
    


     }

     #[Route ('/home/createArticle', name:  'create_article')]
    public function create_Article(Request $request,ManagerRegistry $doctrine):Response{
      $article=new Articles();

      
      $form=$this->createForm(addArticleType::class,$article);
   
    
     

      /*return $this->render('pages/createArticle.html.twig', [
        'formArticle' => $form->createView(),
    ]);*/
   /* $form->handleRequest($request);
    if($form->isSubmitted()&& $form->isValid()){
        $data=$form->getData();
        
        
     $em= $doctrine->getManager();
     $em->persist($article);
     $em->flush();

     return $this->redirectToRoute('listing', [], Response::HTTP_SEE_OTHER);

      
     
     



    }
    return $this->render('pages/createArticle.html.twig',['formArticle'=>$form->createView()

]);    
          }

} 
*/



