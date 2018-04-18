<?php

namespace App;

use App\Entity\InscritManifestationEntity;
use setasign\Fpdi\Fpdi;

class PDFConverter
{
    /**
     * @throws \Exception
     */
    public static function generateFromData($data)
    {
        if($data == null) {throw new \Exception("Error : no data received (passing a null pointer ?)");}

        $pdf = new Fpdi();
        $pdf->AddPage();

        $pdf->SetFont("helvetica", "B", 25);
        $pdf->SetTextColor(0, 0, 0);

        $y = 20;

        $pdf->Text(10, $y+=20, 'Manifestation : '.$data['header']);

        foreach($data['data'] as $entity)
        {
            /** @var InscritManifestationEntity $entity */
            $pdf->Text(30, $y+=20, 'IDUser : '.$entity->getIDuser());
        }

        $fileName = $data['header'].'.pdf';
        $pdf->Output($fileName, 'D');
    }
}