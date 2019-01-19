<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture {
    /**
     * Load data fixtures with the passed EntityManager
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager) {
        $blogPost = new BlogPost();
        $blogPost->setTitle('A new post from fixtures');
        $blogPost->setPublished(new \DateTime('2019-01-19 14:00:00'));
        $blogPost->setContent('Lorem  ipsum');
        $blogPost->setAuthor('Admin');
        $blogPost->setSlug('fixtures-post');
        $manager->persist($blogPost);

        $blogPost = new BlogPost();
        $blogPost->setTitle('A new post from fixtures 2');
        $blogPost->setPublished(new \DateTime('2019-01-19 14:00:00'));
        $blogPost->setContent('Lorem  ipsum2');
        $blogPost->setAuthor('Admin');
        $blogPost->setSlug('fixtures-post-2');

        $manager->persist($blogPost);

        $manager->flush();
    }
}
