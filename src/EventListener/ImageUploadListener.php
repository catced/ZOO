<?php
namespace App\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use App\Entity\Animal;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImageUploadListener
{
    private $uploaderHelper;
    private $slugger;

    public function __construct(UploaderHelper $uploaderHelper, SluggerInterface $slugger)
    {
        $this->uploaderHelper = $uploaderHelper;
        $this->slugger = $slugger;
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $this->checkAndRenameFile($args);
    }

    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $this->checkAndRenameFile($args);
    }

    private function checkAndRenameFile($args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Animal) {
            return;
        }

        $File = $entity->getFile();

        if ($File instanceof File) {
            $uploadDir = 'public/images/animal'; // chemin relatif au dossier public
            $originalFilename = pathinfo($File->getClientOriginalName(), PATHINFO_FILENAME);
            $safeFilename = $this->slugger->slug($originalFilename);
            $newFilename = $safeFilename . '-' . uniqid() . '.' . $File->guessExtension();

            while (file_exists($uploadDir . '/' . $newFilename)) {
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $File->guessExtension();
            }

            $entity->setName($newFilename);
        }
    }
}
