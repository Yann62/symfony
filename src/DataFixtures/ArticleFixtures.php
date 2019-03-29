<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Article;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 1; $i < 10;$i++){
            $article = new Article();
            $article->setTitle("article n°$i")
                    ->setContent("<p>contenu de l'article n°$i</p>")
                    ->setImage("https://via.placeholder.com/300x150")
                    ->setCreatedAt(new \DateTime());

            $manager->persist($article);
        }

        $manager->flush();
    }
}
