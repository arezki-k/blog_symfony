<?php

namespace App\DataFixtures;


use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        for($i = 0; $i<10; $i++){
            $Article = new Article();
            $Article->setTitle("article".$i);
            $Article->setAuthor("email".$i."@mail.com");
            $Article->setUrlAlias($Article->getId());
            $Article->setContent("Lorem ipsum dolor sit amet, c
            onsectetur adipiscing elit. Sed non risus. Suspendisse 
            lectus tortor, dignissim sit amet, adipiscing nec, 
            ultricies sed, dolor. Cras elementum ultrices diam. 
            est eleifend mi, non fermentum diam nisl sit amet erat. 
            Duis semper. Duis arcu massa, scelerisque vitae, consequat 
            in, pretium a, enim. Pellentesque congue. Ut in risus volutpat ");
            $Article->setPublishedDate(date("Y-m-d"));
            $Article->setUpdatedDate(date("Y-m-d"));
            $Article->setCategory($i);
            $manager->persist($Article);
        }

        $manager->flush();
    }
}
