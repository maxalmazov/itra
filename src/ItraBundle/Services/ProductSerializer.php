<?php
namespace ItraBundle\Services;


use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;

class MySerializer
{
    /**
     * Lists all category entities.
     *
     * @Route("/", name="category_index")
     * @Method("GET")
     */
    public function serializ()
    {
        $encoders = new JsonEncoder();
        $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
        $normalizer = new ProductNormalizer($classMetadataFactory);
        /*$normalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });*/

        $serializer = new Serializer(array($normalizer), array($encoders));

        return $serializer;
    }
}