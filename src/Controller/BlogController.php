<?php
/**
 * Created by PhpStorm.
 * User: Pepeg
 * Date: 01/01/2019
 * Time: 17:50
 */

namespace App\Controller;

use App\Entity\BlogPost;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BlogController
 * @package App\Controller
 * @Route("/blog")
 */
class BlogController extends AbstractController {

    /**
     * @Route("/{page}", name="blog_list", defaults={"page": 1}, requirements={"page"="\d+"}, methods={"GET"})
     * @param int $page
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function list($page, Request $request) {
        // Give access to http headers and stuff from the request.
        $limit = $request->get('limit', 10);

        // Fetch data from repository.
        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
        $items = $repository->findAll();

        return $this->json(
            [
                'page' => (int)$page,
                'limit' => $limit,
                'data' => array_map(function (BlogPost $item) {
                    return $this->generateUrl('blog_by_slug', ['slug' => $item->getSlug()]);
                },$items)
            ]
        );
    }

    /**
     * @Route("/post/{id}", name="blog_by_id", requirements={"id"="\d+"}, methods={"GET"})
     * @ParamConverter("post", class="App:BlogPost")
     * @param $post
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function post($post) {
//        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
//
//        return $this->json(
//            $repository->find($id)
//        );
        return $this->json($post);
    }

    /**
     * @Route("/post/{slug}", name="blog_by_slug", methods={"GET"})
     * @ParamConverter("post", class="App:Blogpost", options={"mapping": {"slug": "slug"}})
     * @param $post
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function postBySlug($post) {
//        $repository = $this->getDoctrine()->getRepository(BlogPost::class);
//
//        return $this->json(
//            $repository->findOneBy(['slug' => $slug])
//        );
        return $this->json($post);
    }

    /**
     * @Route("/add", name="blog_add", methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function add(Request $request) {
        $serializer = $this->get('serializer');

        $blogPost = $serializer->deserialize($request->getContent(), BlogPost::class, 'json');

        // Store the data to the database
        $em = $this->getDoctrine()->getManager();
        $em->persist($blogPost);
        $em->flush();

        return $this->json($blogPost);
    }

    /**
     * @Route("/delete/{id}", name="blog_delete", methods={"DELETE"})
     * @param BlogPost $post
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function delete(BlogPost $post){
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}