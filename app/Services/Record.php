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
                'temperature' => encrypt($data['temperature']),
            ];

            if(isset($data['symptoms']))
            {
                $item['has_cough'] = encrypt((int)in_array('has_cough', $data['symptoms']));
                $item['has_hard_breath'] = encrypt((int)in_array('has_hard_breath', $data['symptoms']));
                $item['has_sore_throat'] = encrypt((int)in_array('has_sore_throat', $data['symptoms']));
                $item['has_diarrhea'] = encrypt((int)in_array('has_diarrhea', $data['symptoms']));
                $item['has_tiredness'] = encrypt((int)in_array('has_tiredness', $data['symptoms']));
            }

            $result[] = $item;
        }

        return $result;
    }
}
