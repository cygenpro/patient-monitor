<?php

namespace App\Services;

class Record
{
    /**
     * @param array $data
     * @return array
     */
    public static function mapRequest(array $data): array
    {
        $result = [];

        foreach ($data['doctors'] as $doctorId)
        {
            $item = [
                'to_id' => $doctorId,
                'from_id' => $data['patient_id'],
                'temperature' => $data['temperature'],
            ];

            if(isset($data['symptoms']))
            {
                $item['has_cough'] = in_array('has_cough', $data['symptoms']);
                $item['has_hard_breath'] = in_array('has_hard_breath', $data['symptoms']);
                $item['has_sore_throat'] = in_array('has_sore_throat', $data['symptoms']);
                $item['has_diarrhea'] = in_array('has_diarrhea', $data['symptoms']);
                $item['has_tiredness'] = in_array('has_tiredness', $data['symptoms']);
            }

            $result[] = $item;
        }

        return $result;
    }
}
