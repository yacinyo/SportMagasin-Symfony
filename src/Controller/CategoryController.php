<?php

namespace App\Controller;
use App\Entity\Catagory;

use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CrudCategoryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class CategoryController extends AbstractController{

    #[Route('/category', name: 'category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/addCategory', name: 'add_category')]
    public function addCategory(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $category = new Catagory();
        $category->setName('Tennis');

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('La catégorie a été ajoutée '.$category->getName());
    }

    #[Route('/displayCategory/{id}', name: 'display_category')]
    public function displayCategory(ManagerRegistry $doctrine, $id) : Response
    {
        $category = $doctrine
                    ->getRepository(Catagory::class)
                    ->find($id);

        dd($category );

   
}
#[Route('/category/edit/{id}', name: 'category_edit')]
 public function update(ManagerRegistry $doctrine, int $id): Response
 {
 $entityManager = $doctrine->getManager();
 $category = $entityManager->getRepository(Catagory::class)->find($id);
 if(!$category){
 return $this->render('category/error.html.twig',['error' => 'La
categorie n\'existe pas'] );
 } 
 $category->setName('Nouveau nom de la categorie');
 $entityManager->flush();
 return $this->redirectToRoute('display_category',[
 'id' => $category->getId()
 ]);

 return $this->render('base.twig.html',['id'=>'id']);

 

}
  //creation d'une nouvelle (cliquer sur le boutton ajouter un article route create_category)
#[Route('/home/createCategory', name:  'create_category')]
 public function create_category(Request $request,ManagerRegistry $doctrine){
     $category=new Catagory();
     $form=$this->createForm(CrudCategoryType::class, $category);
     $form->handleRequest($request);
     if($form->isSubmitted()&& $form->isValid()){
        $em= $doctrine->getManager();
        $em->persist($category);
        $em->flush();
     }
return $this->render('bo/createCategory.html.twig',['formCategory'=>$form->createView()

    ]);

 }
  //creation d'une nouvelle category par la route 'category_new
 #[Route('/new', name: 'category_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Catagory();
        $form = $this->createForm(CrudCategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data=$form->getData();

            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('category_index', [], Response::HTTP_SEE_OTHER);
        }else {
            
        }

        return $this->renderForm('bo/createCategory.html.twig', [
            'category' => $category,
            'formCategory' => $form,
        ]);
   } 

   //affichage du listing des gatagories une fois submited
 #[Route('/categoryIndex', name: 'category_index', methods: ['GET'])]
 public function CategoryListing (ManagerRegistry $doctrine ): Response
 {   $category_list = $doctrine
     ->getRepository(Catagory::class)
     ->findAll();

  /*dd($articles_list );*/
  return $this->render('bo/CategoryListing.html.twig', [
         
    'category_list'=>$category_list]);
    

} 


}
