<?php

namespace App;


use App\Entity\InscritManifestationEntity;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class CSVConverter
{
    /**
     * @throws \Exception
     */
    public static function generateFromData($data)
    {
        if($data == null) {throw new \Exception("Error : no data received (passing a null pointer ?)");}

        $fileName = $data['header'].'.csv';
        $file = fopen($fileName, 'w');
        $d = ',';
        $e = '"';

        foreach($data['data'] as $entity)
        {
            /** @var InscritManifestationEntity $entity */
            fputcsv($file, array($entity->getIDuser()), $d, $e);
        }

        fclose($file);
    }
}