<?php

namespace FollowMeBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use FollowMeBundle\Entity\Dating;
use FollowMeBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Exception;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAction(Request $request)
    {
        try {
            $page =
            (int) $request->get("page") > 1
            ?  (int) $request->get("page")
            : 1;
            $maxResults = 4;
            $this->get("session")->start();
            
//             if (!$this->get("session")->get("id")) 
//             {
//                 return $this->redirectToRoute("main");
//             }
            $criteria = new Criteria;
            $criteria->setMaxResults($maxResults);
            
            if ($page) 
            {
                $criteria->setFirstResult(
                    ($page -1) * $maxResults
                    );
            }
            
            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(User::class)->matching($criteria);
            
            if (!$user[0] && $page > 1) {
                return $this->redirectToRoute("admin");
            } 
        } catch (Exception $e) {
            
        }
        $id = (int) $request->get("e") ;
        return $this->render('FollowMeBundle:Admin:index.html.twig', 
            [
                "id" => $id,
                "users" => $user,
                "page" => $page,
                "max" => $maxResults
            ]);
    }
    
    
    /**
     * @Route("/admin/user/{id}", name="admin_user")
     */
    public function removeUserAction($id)
    {
        $url = $this->generateUrl("admin");
        try { 
           if (!($user = $this->getDoctrine()->getManager()->find(User::class, $id)))
           {
               return $this->redirect($url . "?e");
           }
           
           if (($dating = $this->getDoctrine()->getManager()
                   ->getRepository(\FollowMeBundle\Entity\Dating::class)
                   ->findBy(["user" => $user]))
                   && 0 !== count($dating)) 
           {
               foreach ($dating as $date) {
                   $this->getDoctrine()->getManager()->remove($date);
               }
               $this->getDoctrine()->getManager()->flush();
           }
           $this->getDoctrine()->getManager()->remove($user);
           $this->getDoctrine()->getManager()->flush();
           return $this->redirect($url . "?e=" . $id);
            
        } catch (\Throwable $e) {

       }
    } 
} 
