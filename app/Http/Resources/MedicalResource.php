<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'barcode'     => $this->barcode,
            'name_ar'     => $this->name_ar,
            'name_en'     => $this->name_en,
            'indication'  => $this->indication,
            'dosage'      => $this->dosage,
            'composition' => $this->composistion,
            'strength'    => $this->strength,
            'company'     => $this->company,
            'net'         => $this->net,
            'public'      => $this->public,
            'pregnancy'   => $this->pregnancy,
        ];
    }
}
