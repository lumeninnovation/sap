<?php
namespace LumenInnovation\SAP\Illuminate\Orders\Traits;
use Carbon\Carbon;

trait InterfacesWithWorkOrderDates
{
    public function getActualStartDate(): ?Carbon
    {
        if ($this->order['ES_HEADER']['ACTUAL_START_DATE'] !== '00000000')
            return Carbon::createFromFormat('Ymd', $this->order['ES_HEADER']['ACTUAL_START_DATE']);
        return null;
    }

    public function getActualStartDateAndTime(): ?Carbon
    {
        if ($this->order['ES_HEADER']['ACTUAL_START_DATE'] !== '00000000' && $this->order['ES_HEADER']['ACTUAL_START_TIME'] !== '000000')
            return Carbon::createFromFormat('YmdHis', $this->order['ES_HEADER']['ACTUAL_START_DATE'] . $this->order['ES_HEADER']['ACTUAL_START_TIME']);
        return null;
    }

    public function getBasicFinishDate(): ?Carbon
    {
        if ($this->order['ES_HEADER']['FINISH_DATE'] !== '00000000')
            return Carbon::createFromFormat('Ymd', $this->order['ES_HEADER']['FINISH_DATE']);
        return null;
    }

    public function getBasicFinishTime(): ?Carbon
    {
        if ($this->order['ES_HEADER']['BASIC_FIN'] !== '000000')
            return Carbon::createFromFormat('His', $this->order['ES_HEADER']['BASIC_FIN']);
        return null;
    }

    public function getBasicFinishDateAndTime(): ?Carbon
    {
        if ($this->order['ES_HEADER']['FINISH_DATE'] !== '00000000' && $this->order['ES_HEADER']['BASIC_FIN'] !== '000000')
            return Carbon::createFromFormat('YmdHis', $this->order['ES_HEADER']['FINISH_DATE'] . $this->order['ES_HEADER']['BASIC_FIN']);
        return null;
    }

    public function getBasicStartDate(): ?Carbon
    {
        if ($this->order['ES_HEADER']['START_DATE'] !== '00000000')
            return Carbon::createFromFormat('Ymd', $this->order['ES_HEADER']['START_DATE']);
        return null;
    }

    public function getBasicStartTime(): ?Carbon
    {
        if ($this->order['ES_HEADER']['BASICSTART'] !== '000000')
            return Carbon::createFromFormat('His', $this->order['ES_HEADER']['BASICSTART']);
        return null;
    }

    public function getBasicStartDateAndTime(): ?Carbon
    {
        if ($this->order['ES_HEADER']['START_DATE'] !== '00000000' && $this->order['ES_HEADER']['BASICSTART'] !== '000000')
            return Carbon::createFromFormat('YmdHis', $this->order['ES_HEADER']['START_DATE'] . $this->order['ES_HEADER']['BASICSTART']);
        return null;
    }

    public function setBasicStartDateAndTime($date): self
    {
        $this->setBasicStartDate($date);
        $this->setBasicStartTime($date);

        return $this;
    }

    public function setBasicStartDate($date): self
    {
        $this->update->setParameter('IT_HEADER', 'START_DATE', Carbon::parse($date)->roundMinute(15)->format('Ymd'));

        return $this;
    }

    public function setBasicStartTime($time): self
    {
        $this->update->setParameter('IT_HEADER', 'BASICSTART', Carbon::parse($time)->floorUnit('minute', 15)->format('His'));

        return $this;
    }

    public function setBasicFinishDateAndTime($date): self
    {
        $this->setBasicFinishDate($date);
        $this->setBasicFinishTime($date);

        return $this;
    }

    public function setBasicFinishDate($date): self
    {
        $this->update->setParameter('IT_HEADER', 'FINISH_DATE', Carbon::parse($date)->roundMinute(15)->format('Ymd'));

        return $this;
    }

    public function setBasicFinishTime($time): self
    {
        $this->update->setParameter('IT_HEADER', 'BASIC_FIN', Carbon::parse($time)->floorUnit('minute', 15)->format('His'));

        return $this;
    }
}
