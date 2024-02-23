<?php

namespace App\Controller;

use App\Entity\Pret;
use App\Entity\Remboursement;
use App\Form\PretType;
use App\Form\RemboursementType;
use App\Repository\PretRepository;
use App\Repository\RemboursementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaffdashController extends AbstractController
{
    #[Route('/staffdash', name: 'app_staffdash')]
    public function index(): Response
    {
        return $this->render('staffdash/index.html.twig', [
            'controller_name' => 'StaffdashController',
        ]);
    }

    #[Route('/staff',name:'staff_app')]
    public function indexastaff():Response
    {
        return $this->render('staffdash/staff/staff.html.twig');
    }

    #[Route('/staffPro',name:'staffPro_app')]
    public function indexstaffPro():Response
    {
        return $this->render('staffdash/profile/staff-profile.html.twig');
    }

    #[Route('/staffCon',name:'staffCon_app')]
    public function indestaffContact():Response
    {
        return $this->render('staffdash/contact/satff-contact.html.twig');
    }



    #[Route('/Listt', name: 'prett')]
    public function list(PretRepository $emm)
    {

            $author = $emm->findAll();

        return $this->render('staffdash/Pret/pret.html.twig', [
            'pret' =>$author,

        ]);
    }

#[Route('/accepte/{id}', name: 'accepte')]
public function accepte( PretRepository $em,$id){

  $pret=$em->find($id);
        $pret->setAccepte(true);
        $pret->setRefuse(false);
        $em=$this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('prett');
}

#[Route('/refuse/{id}', name: 'refuse')]
public function refuse(PretRepository $em,$id)
{
    $pret=$em->find($id);
    $pret->setRefuse(true);
    $pret->setAccepte(false);
    $em=$this->getDoctrine()->getManager();
    $em->flush();
    return $this->redirectToRoute('prett');
}




    #[Route('/listr', name: 'listr')]
    public function lister(RemboursementRepository $emm)
    {

        $author = $emm->findAll();

        return $this->render('staffdash/Rembourssement/list.html.twig', [
            'pret' =>$author,

        ]);
    }
    #[Route('/listra', name: 'listra')]
    public function listera(PretRepository $emm)
    {

        $author = $emm->findAll();

        return $this->render('staffdash/Pret/accepte.html.twig', [
            'pret' =>$author,

        ]);
    }
    #[Route('/listrr', name: 'listrr')]
    public function listerr(PretRepository $emm)
    {

        $author = $emm->findAll();

        return $this->render('staffdash/Pret/refuse.html.twig', [
            'pret' =>$author,

        ]);
    }





    #[Route('/addr', name: 'adddr')]
    public function add(Request $request){
        $prett=new Remboursement();


        $form=$this->createForm(RemboursementType::class, $prett);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($prett);
            $em->flush();
            return $this->redirectToRoute('listr');
        }
        return $this->render('staffdash/Rembourssement/add.html.twig' ,[
            'form' =>$form->createView(),
        ]);

    }


    #[Route('/updater/{id}', name: 'updateer')]
    public function updater(RemboursementRepository $em ,Request $request,$id ){
        $pret=$em->find($id);
        $form=$this->createForm(RemboursementType::class, $pret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em=$this->getDoctrine()->getManager();
            $em->persist($pret);
            $em->flush();
            return $this->redirectToRoute('listr');
        }
        return $this->render('staffdash/Rembourssement/update.html.twig'   ,[
            'form'=>$form->createView(),

        ]);




    }

    #[Route('/deleter/{id}', name: 'deleter')]
    public function delete($id,PretRepository $repo)
    {
        $pret=new Remboursement();

        $data=$repo->find($id);
        $em=$this->getDoctrine()->getManager();
        $em->remove($data);
        $em->flush();
        return $this->redirectToRoute(('listr'));
    }



}
