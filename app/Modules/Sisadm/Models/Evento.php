<?php

namespace App\Modules\Sisadm\Models;

use App\Models\BaseModel;
use MaddHatter\LaravelFullcalendar\IdentifiableEvent;
use Carbon\Carbon;

class Evento extends BaseModel implements IdentifiableEvent
{

    protected $table = 'spoa_portal.evento';
    protected $primaryKey = 'id_evento';

    protected $dates = ['dt_inicio', 'dt_fim'];
    //protected $dateFormat = 'd/m/Y H:i:s'; 

    protected $fillable = [
        'no_evento', 'ds_evento', 'id_usuario', 'dt_inicio', 'dt_fim'
    ];

    /**
     * Get the event's id number
     *
     * @return int
     */
    public function getId() {
		return $this->id_evento;
	}

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        $string = $this->no_evento;        
        $string .= ', criado por ' . $this->usuario->no_usuario;
        return $string;        
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->sn_todo_dia;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        return $this->dt_inicio;
    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->dt_fim;
    }

    public function getEventOptions()
    {
        return [
            'color' => $this->tx_cor,
        ];
    }

    public function usuario(){
        return $this->belongsTo('App\Modules\Sisadm\Models\User', 'id_usuario', 'id_usuario');
    }

    public function getDataInicioAttribute(){
        $data_array = (explode(" ", $this->attributes['dt_inicio']));
        return Carbon::parse($data_array[0])->format('d/m/Y') . " " . $data_array[1];
    }

    public function getDataFimAttribute(){
        $data_array = (explode(" ", $this->attributes['dt_fim']));
        return Carbon::parse($data_array[0])->format('d/m/Y') . " " . $data_array[1];
    }
}