<?php

namespace App\Imports;

use App\Models\Usuario;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    private $rows = 0;

    public function model(array $row)
    {
        ++$this->rows;

        return new User([
            'name' => $row[0],
        ]);
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }
}
