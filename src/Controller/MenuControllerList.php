<?php
    namespace App\Controller;
    use App\Entity\Catagory;
    use Doctrine\ORM\EntityManagerInterface;
    use Doctrine\Persistence\ManagerRegistry;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    
    use Symfony\Component\Routing\Annotation\Route;
    

    use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
    use App\Service\CallApiService;
    use App\Repository\CatagoryRepository;
       
       
    
    
    
class MenuControllerList extends AbstractController {
       
       
       
       
        public function list (ManagerRegistry $doctrine ): Response{
             
            
            $category_list = $doctrine
            ->getRepository(Catagory::class)
            ->findAll();

            return $this->render('_menu.html.twig',[
            'menu'=>$category_list]);

            
        
          }
        
    
     
    }
       
       
       
       
       ?>