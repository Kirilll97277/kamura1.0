<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Form\UserListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Command\UserPasswordEncoderCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminUserController extends AdminBaseController
{
    #[Route('admin/user', name: 'admin_user')]
    public function index(Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        $form = $this->createForm(UserListType::class, null, ['userList' => $users]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
        }
        return $this->render('admin/user/index.html.twig', array(
            'form' => $form->createView(),
            'users' => $users,
        ));
    }

    #[Route('admin/user/create', name: 'admin_user_create')]
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);

        if(($form->isSubmitted()) && ($form->isValid()))
        {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            $user->setRoles(["ROLE_ADMIN"]);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('admin_user');
        }
        $forRender = parent::renderDefault();
        $forRender['title'] = 'форма создания пользователя';
        $forRender['form'] = $form->createView();
        return $this->render('admin/user/form.html.twig', $forRender);
    }

    #[Route('admin/user/block', name: 'admin_user_block')]
    public function blockUsers(Request $request): JsonResponse
    {
        $ids = json_decode($request->getContent(), true)['ids'];
        $doctrine = $this->getDoctrine();
        $users = $doctrine->getRepository(User::class)->getUsersByIds($ids);

        try{
//            foreach ($users as $user) {
//                $doctrine->getManager()->remove($user);
//            }
//            $doctrine->getManager()->flush();

            return new JsonResponse(json_encode(['success' => true]));

        } catch (\Exception $exception)
        {
            return new JsonResponse(json_encode(['success' => false]));
        }
    }
}
