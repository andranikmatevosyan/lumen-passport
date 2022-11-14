<?php

namespace App\Components;

use Illuminate\Support\Collection;

class DataTransferObject
{
    /**
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect($this);
    }

    /**
     * @param $keys
     * @return Collection
     */
    public function only($keys): Collection
    {
        return $this->collect()->only($keys);
    }

    /**
     * @param $keys
     * @return Collection
     */
    public function except($keys): Collection
    {
        return $this->collect()->except($keys);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->collect()->all();
    }


}
