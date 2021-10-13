<?php

namespace App\Imports;

use App\Question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionImport implements ToModel,WithHeadingRow
{
    public function model(array $row)
    {
        return new Question([
            'question'     => $row['question'],
            'option_one'    => $row['option_one'],
            'option_two'    => $row['option_two'],
            'option_three'    => $row['option_three'],
            'option_four'    => $row['option_four'],
            'answer'    => $row['answer'],
        ]);
    }
}
