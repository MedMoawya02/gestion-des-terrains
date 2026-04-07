<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date'=>'required|after_or_equal:today',
            'heure_debut'=>['required','date_format:G:i',
                function($att,$value,$fail){
                    if($this->date===date('Y-m-d')){
                        $heureSaisie=(int) explode(':',$value)[0];
                        $heureActuelle=(int)date('H');
                        if($heureSaisie<$heureActuelle){
                            $fail("L'heure choisie est déjà passée pour aujourd'hui.");
                        }
                    }
                }
            ],
            
        ];
    }
}
